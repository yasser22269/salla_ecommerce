<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'payment_status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Custom Methods

    /**
     * Mark the payment as successful.
     *
     * @return $this
     */
    public function markAsSuccessful()
    {
        $this->update(['payment_status' => 'success']);

        return $this;
    }

    /**
     * Mark the payment as failed.
     *
     * @return $this
     */
    public function markAsFailed()
    {
        $this->update(['payment_status' => 'failed']);

        return $this;
    }

    /**
     * Check if the payment was successful.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->payment_status === 'success';
    }



    /**
     * Scope a query to only include successful payments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuccessful($query)
    {
        return $query->where('payment_status', 'success');
    }

    /**
     * Get the total amount paid by a specific user.
     *
     * @param  int  $userId
     * @return float
     */
    public static function getTotalAmountPaidByUser($userId)
    {
        return static::where('user_id', $userId)->sum('amount');
    }

}
