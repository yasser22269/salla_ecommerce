<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\trait\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use ImageUploadTrait;
    public function store(ImageRequest $request)
    {
        $validatedData = $request->validated();
        $uploadData = $this->uploadImage($request, 'image');

        $image = Image::create(array_merge($validatedData, $uploadData));

        return response()->json(['message' => 'Image stored successfully', 'data' => $image], 201);
    }

    public function update(ImageRequest $request, Image $image)
    {
        $validatedData = $request->validated();
        $uploadData = $this->uploadImage($request, 'image');

        $this->deleteImage($image);

        $image->update(array_merge($validatedData, $uploadData));

        return response()->json(['message' => 'Image updated successfully', 'data' => $image], 200);
    }

    public function destroy(Image $image)
    {
        // Delete the image file from storage
        $this->deleteImage($image);

        // Delete the image record from the database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully'], 200);
    }
}
