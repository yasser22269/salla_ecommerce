<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Custom Methods

    /**
     * Get the total number of products in the category.
     *
     * @return int
     */
    public function getProductCount()
    {
        return $this->products->count();
    }

    /**
     * Get the average price of products in the category.
     *
     * @return float|null
     */
    public function getAverageProductPrice()
    {
        $totalPrice = $this->products->sum('price');
        $productCount = $this->getProductCount();

        return $productCount > 0 ? $totalPrice / $productCount : null;
    }

    /**
     * Get a list of product names in the category.
     *
     * @return array
     */
    public function getProductNames()
    {
        return $this->products->pluck('name')->toArray();
    }

    /**
     * Check if the category has any products.
     *
     * @return bool
     */
    public function hasProducts()
    {
        return $this->getProductCount() > 0;
    }
}

