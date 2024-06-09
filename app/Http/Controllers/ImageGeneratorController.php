<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Stichoza\GoogleTranslate\GoogleTranslate;


class ImageGeneratorController extends Controller
{
    public static $AI_models = [
        'sd-community/sdxl-flash', 
        'stabilityai/stable-diffusion-xl-base-1.0', 
        'CompVis/stable-diffusion-v1-4', 
        'SG161222/Realistic_Vision_V4.0_noVAE', 
        'fluently/Fluently-XL-v4',
    ];

    public function index()
    {
        return view('image_generator');
    }

    public function generate(Request $request)
    {
        $description = $request->input('description');
        $width = $request->input('width', 100); // Default width 512
        $height = $request->input('height', 100); // Default height 512
        $numInferenceSteps = $request->input('num_inference_steps', 50); // Default 50
        $guidanceScale = $request->input('guidance_scale', 7.5); // Default 7.5
        $seed = $request->input('seed', random_int(0, 9999999)); // Generate random seed if not provided

        $translator = new GoogleTranslate();
        $translator->setSource('ru');
        $translator->setTarget('en');
        $translatedDescription = $translator->translate($description);

        // dd($translatedDescription);

        $apiKey = env('HUGGING_FACE_API_KEY');
        $model = self::$AI_models[0];
        $client = new Client();

        $jsonPayload = [
            'inputs' => $description,
            'options' => [
                'width' => $width,
                'height' => $height,
                'num_inference_steps' => $numInferenceSteps,
                'guidance_scale' => $guidanceScale,
                'seed' => $seed,
            ]
        ];

        try {
            $response = $client->post("https://api-inference.huggingface.co/models/{$model}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' =>  $jsonPayload,
            ]);

            Log::info('API Response Headers: ' . json_encode($response->getHeaders()));

            // dd($response->getBody()->getContents());

            // dd($response->getHeaders()['Content-Type'][0]);

            $imageBytes = $response->getBody()->getContents();

            return view('image_generator', ['imageBytes' => $imageBytes, 'description' => $description]);
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function save(Request $request)
    {
        $imageUrl = $request->input('image_url');
        $description = $request->input('description');


        return view('home');
        //return redirect()->back()->with('success', 'Image saved successfully!');
    }
}
