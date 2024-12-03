<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileTrait
{
    public static function uploadImage($image, $path)
    {
        $hashName = $image->hashName();

        Storage::disk('public')->put($path . '/' . $hashName, file_get_contents($image));

        return $hashName;
    }

    public function deleteImage(string $fileUrl, string $disk = "public")
    {
        $filePath = Str::afterLast($fileUrl, 'storage');

        return Storage::disk($disk)->delete($filePath);
    }
}
