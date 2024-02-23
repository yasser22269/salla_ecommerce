<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'tracking_number',
        'shipping_status',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Custom Methods

    /**
     * Mark the shipping as shipped.
     *
     * @return $this
     */
    public function markAsShipped()
    {
        $this->update(['shipping_status' => 'shipped']);

        return $this;
    }

    /**
     * Mark the shipping as delivered.
     *
     * @return $this
     */
    public function markAsDelivered()
    {
        $this->update(['shipping_status' => 'delivered']);

        return $this;
    }

    /**
     * Check if the shipping is delivered.
     *
     * @return bool
     */
    public function isDelivered()
    {
        return $this->shipping_status === 'delivered';
    }


    /**
     * Scope a query to only include shipped shipments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShipped($query)
    {
        return $query->where('shipping_status', 'shipped');
    }

    /**
     * Get the shipping cost for a specific order.
     *
     * @return float
     */
    public function getShippingCostAttribute()
    {
        // Add your logic to calculate shipping cost based on your business rules
        return 10.00;
    }

}
