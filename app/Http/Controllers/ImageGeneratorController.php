<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client; // Добавляем импорт класса Client
use Illuminate\Support\Facades\Storage;

class ImageGeneratorController extends Controller
{
    public static $AI_models = [
        'sd-community/sdxl-flash',
        'stabilityai/stable-diffusion-xl-base-1.0',
    ];


    public function index()
    {
        return view('image_generator');
    }

    public function generate(Request $request)
    {
        $description = $request->input('description');
        $apiKey = env('HUGGING_FACE_API_KEY');
        $model = ImageGeneratorController::$AI_models[1]; // Замените на имя или идентификатор выбранной вами модели
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post("https://api-inference.huggingface.co/models/{$model}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' => [
                    'inputs' => 'mystical creature, ' . $description,
                ],
            ]);

            \Log::info('API Response Headers: ' . json_encode($response->getHeaders()));


            $imageBytes = $response->getBody()->getContents();

            return view('image_generator', ['imageBytes' => $imageBytes, 'description' => $description]);
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function save(Request $request)
    {
        $imageUrl = $request->input('image_url');
        $description = $request->input('description');

        // Декодируем баз64-кодированное изображение
        $imageContents = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageUrl));
        $imageName = 'generated_image_' . time() . '.png';
        Storage::put('public/images/' . $imageName, $imageContents);

        return back()->with('success', 'Image saved successfully!');
    }

    public function regenerate(Request $request)
    {
        $description = $request->input('description');
        $apiKey = env('HUGGING_FACE_API_KEY');
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post('https://api-inference.huggingface.co/models/CompVis/stable-diffusion-v1-4', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' => [
                    'inputs' => $description,
                ],
            ]);

            $imageBytes = $response->getBody()->getContents();

            return view('image_generator', ['imageBytes' => $imageBytes, 'description' => $description]);
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
