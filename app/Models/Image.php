<?php

// Image.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',
        'caption',
        'path',
    ];

    // Relationships
    public function imageable()
    {
        return $this->morphTo();
    }

    // Custom Methods

    /**
     * Get the full URL of the image.
     *
     * @return string
     */
    public function getFullImageUrl()
    {
        return asset($this->path . '/' . $this->filename);
    }

    /**
     * Set a caption for the image.
     *
     * @param string $caption
     * @return void
     */
    public function setCaption($caption)
    {
        $this->update(['caption' => $caption]);
    }

    /**
     * Get the path where the image is stored.
     *
     * @return string
     */
    public function getStoragePath()
    {
        return storage_path('app/' . $this->path);
    }

    /**
     * Check if the image has a caption.
     *
     * @return bool
     */
    public function hasCaption()
    {
        return !empty($this->caption);
    }


}

