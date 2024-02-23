<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        // Add other fields as needed
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Custom Methods

    /**
     * Check if the review has a comment.
     *
     * @return bool
     */
    public function hasComment()
    {
        return !empty($this->comment);
    }

    /**
     * Get the formatted rating.
     *
     * @return string
     */
    public function getFormattedRatingAttribute()
    {
        return $this->rating . '/5';
    }

    /**
     * Scope a query to only include reviews with a specific rating.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $rating
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }


    /**
     * Get the user's name who left the review.
     *
     * @return string
     */
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Get the product name for which the review was left.
     *
     * @return string
     */
    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
