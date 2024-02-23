<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
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
     * Check if a product is already in the user's wishlist.
     *
     * @param  int  $productId
     * @return bool
     */
    public function isProductInWishlist($productId)
    {
        return $this->where('product_id', $productId)->exists();
    }

    /**
     * Remove a product from the user's wishlist.
     *
     * @param  int  $productId
     * @return bool
     */
    public function removeProductFromWishlist($productId)
    {
        return $this->where('product_id', $productId)->delete();
    }

    // Add more methods or relationships based on your specific needs

    /**
     * Get the total number of products in the user's wishlist.
     *
     * @return int
     */
    public function getTotalProductsAttribute()
    {
        return $this->user->wishlist->count();
    }

    /**
     * Get the names of products in the user's wishlist.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProductNamesAttribute()
    {
        return $this->user->wishlist->pluck('product.name');
    }

    /**
     * Add a product to the user's wishlist.
     *
     * @param  int  $productId
     * @return Wishlist
     */
    public function addProductToWishlist($productId)
    {
        $wishlistItem = $this->create(['product_id' => $productId]);

        return $wishlistItem;
    }



}
