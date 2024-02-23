<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity_available',
    ];

    // Relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Custom Methods

    /**
     * Check if the product is in stock.
     *
     * @return bool
     */
    public function isInStock()
    {
        return $this->quantity_available > 0;
    }

    /**
     * Get the average rating of the product based on reviews.
     *
     * @return float|null
     */
    public function getAverageRatingAttribute()
    {
        $averageRating = $this->reviews->avg('rating');

        return $averageRating ? round($averageRating, 2) : null;
    }

    /**
     * Scope a query to only include products with a specific category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $categoryId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->whereHas('categories', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        });
    }


    /**
     * Get the discounted price of the product.
     *
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        $discount = $this->discounts->first();

        return $discount ? $this->price - ($this->price * ($discount->discount_percentage / 100)) : $this->price;
    }

    /**
     * Get the total sales quantity of the product.
     *
     * @return int
     */
    public function getTotalSalesQuantityAttribute()
    {
        return $this->orderItems->sum('quantity');
    }
}
