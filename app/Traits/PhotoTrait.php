<?php

namespace App\Traits;

use Buglinjo\LaravelWebp\Exceptions\CwebpShellExecutionFailed;
use Buglinjo\LaravelWebp\Exceptions\DriverIsNotSupportedException;
use Buglinjo\LaravelWebp\Exceptions\ImageMimeNotSupportedException;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait PhotoTrait
{

    function saveImage(UploadedFile $file, string $folder, string $type = 'image')
    {
        Storage::disk('public')->makeDirectory($folder);

        $extension = $file->getClientOriginalExtension();
        $file_name = uniqid() . time() . '.' . $extension;
        $path = $folder . '/' . $file_name;

        $file->move(storage_path('app/public/' . $folder), $file_name);

        return 'storage/' . $path;
    }

    function imageUrl(?string $path, string $fallback = 'assets/uploads/empty.jpg'): string
    {
        if (empty($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'public/')) {
            $path = substr($path, 7);
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }
}
