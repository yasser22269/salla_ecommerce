<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'subtotal',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Custom Methods

    /**
     * Calculate the subtotal for the order item.
     *
     * @return $this
     */
    public function calculateSubtotal()
    {
        $this->update(['subtotal' => $this->price * $this->quantity]);

        return $this;
    }

    // Add more methods or relationships based on your specific needs

    /**
     * Scope a query to only include order items for a specific product.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $productId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    /**
     * Get the total quantity of items for a specific order.
     *
     * @param  int  $orderId
     * @return int
     */
    public static function getTotalQuantityForOrder($orderId)
    {
        return static::where('order_id', $orderId)->sum('quantity');
    }

}
