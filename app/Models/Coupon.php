<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    // Custom Methods

    /**
     * Check if the coupon is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->valid_to);
    }

    /**
     * Calculate the discount amount for a given order total.
     *
     * @param float $orderTotal
     * @return float
     */
    public function calculateDiscountAmount($orderTotal)
    {
        return $orderTotal * ($this->discount_percentage / 100);
    }

    /**
     * Validate the coupon code format.
     *
     * @param string $code
     * @return bool
     */
    public static function isValidCodeFormat($code)
    {
        // Example: Coupon code must be alphanumeric and have a specific length
        return preg_match('/^[a-zA-Z0-9]{8}$/', $code) === 1;
    }

    /**
     * Check if the coupon can be applied to an order.
     *
     * @param Order $order
     * @return bool
     */
    public function canBeAppliedToOrder(Order $order)
    {
        return !$this->isExpired() && $order->total > 0;
    }
    public function valid_to(){
        return $this->valid_to < now() ? 'تم الانتهاء' : $this->valid_to;
    }
}

