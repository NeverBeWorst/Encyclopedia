<?php

namespace App\Http\Controllers;

use App\Models\AIimage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client; // Добавляем импорт класса Client

use Stichoza\GoogleTranslate\GoogleTranslate;

use Carbon\Carbon;

class ImageGeneratorController extends Controller
{
    public static $AI_models = [
        'stabilityai/stable-diffusion-xl-base-1.0', //качество среднее, быстроват, с багами
        'fluently/Fluently-XL-v4', //Сверхдетализированный, сверхдолгий
        'CompVis/stable-diffusion-v1-4', //очень долгий и детализированный
        
        'SG161222/Realistic_Vision_V4.0_noVAE', //долгий, детализированный
        'sd-community/sdxl-flash', //крцтой но с багами
    ];


    public function index()
    {
        return view('image_generator');
    }

    public function generate(Request $request)
    {
        $description = $request->input('description');
        $model_num = $request->input('model');

        $apiKey = env('HUGGING_FACE_API_KEY');
        $model = ImageGeneratorController::$AI_models[$model_num];
        $client = new \GuzzleHttp\Client();

        $tr = new GoogleTranslate('en'); // Перевод на английский
        $translatedescription = $tr->translate($description);

        //dd($description);

        try {
            $response = $client->post("https://api-inference.huggingface.co/models/{$model}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' => [
                    'inputs' => 'color picture, ' . $translatedescription,
                    'options' => [
                        'seed' => random_int(0, 9999999),
                    ],
                ],
            ]);

            \Log::info('API Response Headers: ' . json_encode($response->getHeaders()));


            $imageBytes = $response->getBody()->getContents();

            return view('image_generator', ['imageBytes' => $imageBytes, 'description' => $description]);
        } 

        catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function save(Request $request)
    {
        $imageUrl = $request->input('image_url'); // Замените 'image' на 'image_url'
        $description = $request->input('description');

        // Декодируем base64-кодированное изображение
        $imageContents = base64_decode($imageUrl);
        $imageName = Auth::user()->login . '_' . Carbon::now()->format('y-m-d') . '_' .  random_int(1000, 9999) . '.png';

        // Сохраняем изображение в директорию public/img
        $filePath = public_path('img/users/custom_creature/carts/' . $imageName);
        file_put_contents($filePath, $imageContents);

        return view('user/custom_creature', ['_habitat' => CreatureController::$_habitat, 'image' => $imageName])->with('success', 'Image saved successfully!');
    }

}

// $image = AIimage::create($req->all());

//         return redirect()->route('user.custom_creature')->with(['image' => $image->id]);