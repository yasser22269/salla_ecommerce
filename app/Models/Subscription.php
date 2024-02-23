<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'plan',
        'billing_cycle',
        'subscription_status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Custom Methods

    /**
     * Activate the subscription.
     *
     * @return $this
     */
    public function activate()
    {
        $this->update(['subscription_status' => 'active']);

        return $this;
    }

    /**
     * paused the subscription.
     *
     * @return $this
     */
    public function paused()
    {
        $this->update(['subscription_status' => 'paused']);

        return $this;
    }

    /**
     * Cancel the subscription.
     *
     * @return $this
     */
    public function cancel()
    {
        $this->update(['subscription_status' => 'canceled']);

        return $this;
    }


    /**
     * Scope a query to only include active subscriptions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('subscription_status', 'active');
    }

    /**
     * Check if the subscription is in a specific billing cycle.
     *
     * @param  string  $billingCycle
     * @return bool
     */
    public function isInBillingCycle($billingCycle)
    {
        return $this->billing_cycle === $billingCycle;
    }
}
