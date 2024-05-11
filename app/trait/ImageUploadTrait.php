<?php
namespace App\trait;

use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    protected function uploadImage($request, $attributeName, $storagePath = 'images')
    {
        if ($request->hasFile($attributeName)) {
            $imagePath = $request->file($attributeName)->store($storagePath);
            $filename = $request->file($attributeName)->getClientOriginalName();

            return compact('imagePath', 'filename');
        }

        return [];
    }

    protected function deleteImage($image)
    {
        if ($image && Storage::exists($image->path . '/' . $image->filename)) {
            Storage::delete($image->path . '/' . $image->filename);
        }
    }
}
