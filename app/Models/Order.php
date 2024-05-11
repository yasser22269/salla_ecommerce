<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }


    // Custom Methods

    /**
     * Calculate and set the total amount for the order.
     *
     * @return $this
     */
    public function calculateTotalAmount()
    {
        // Logic to calculate total amount based on order items
        $totalAmount = $this->items->sum('subtotal');
        $this->update(['total_amount' => $totalAmount]);

        return $this;
    }

    /**
     * Check if the order is eligible for return.
     *
     * @return bool
     */
    public function isEligibleForReturn()
    {
        // Logic to determine eligibility for return
        return $this->status === 'delivered';
    }

    /**
     * Get the latest order for a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestForUser($query, $userId)
    {
        return $query->where('user_id', $userId)->latest()->first();
    }

    // Add more methods or relationships based on your specific needs

    /**
     * Get the total number of items in the order.
     *
     * @return int
     */
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Scope a query to only include orders with a specific status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
