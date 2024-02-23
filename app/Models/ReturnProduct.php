<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'reason',
        'status',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Custom Methods

    /**
     * Approve the return request.
     *
     * @return $this
     */
    public function approve()
    {
        $this->update(['status' => 'approved']);

        return $this;
    }

    /**
     * Reject the return request.
     *
     * @return $this
     */
    public function reject()
    {
        $this->update(['status' => 'rejected']);

        return $this;
    }

    /**
     * Check if the return request is approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    // Add more methods or relationships based on your specific needs

    /**
     * Scope a query to only include approved return requests.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Get the reason for return in a formatted way.
     *
     * @return string
     */
    public function getFormattedReasonAttribute()
    {
        return ucfirst($this->reason);
    }
}
