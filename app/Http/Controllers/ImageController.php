<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController extends Controller
{
    public function show (Filesystem $filesystem, Request $request, String $path) {

        dd($path);

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory($request),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'base_url' => 'images',
            'cache_path_prefix' =>  '.cache',
        ]);

        return $server->getImageResponse($path, $request()->all());
    }
}
