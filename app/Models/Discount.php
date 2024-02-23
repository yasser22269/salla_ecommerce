<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_percentage',
        'start_date',
        'end_date',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessors
    public function getFormattedStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->toDateString();
    }

    public function getFormattedEndDateAttribute()
    {
        return Carbon::parse($this->end_date)->toDateString();
    }

    // Custom Methods

    /**
     * Check if the discount is active.
     *
     * @return bool
     */
    public function isActive()
    {
        $now = Carbon::now();
        return $now->greaterThanOrEqualTo($this->start_date) && $now->lessThanOrEqualTo($this->end_date);
    }

    /**
     * Calculate the discounted price for a given product price.
     *
     * @param float $productPrice
     * @return float
     */
    public function calculateDiscountedPrice($productPrice)
    {
        return $productPrice - ($productPrice * ($this->discount_percentage / 100));
    }

    /**
     * Check if the discount can be applied to a product.
     *
     * @param Product $product
     * @return bool
     */
    public function canBeAppliedToProduct(Product $product)
    {
        return $this->isActive() && $product->price > 0;
    }
}

