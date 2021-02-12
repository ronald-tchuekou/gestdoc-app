<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
    /**
     * Fonction qui peremt d'afficher une image dans une page avec glide.
     */
    public function show (Filesystem $filesystem, String $path): StreamedResponse 
    {
        
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' =>  '.cache',
            'base_url' => 'images',
        ]);
        
        return $server->getImageResponse($path, request()->all());
    }
}
