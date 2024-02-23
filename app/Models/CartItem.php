<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // Relationships
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Custom Methods

    /**
     * Calculate the total price for this item.
     *
     * @return float
     */
    public function calculateTotalPrice()
    {
        return $this->product->price * $this->quantity;
    }

    /**
     * Increase the quantity of the item in the cart.
     *
     * @param int $quantity
     * @return void
     */
    public function increaseQuantity($quantity = 1)
    {
        $this->update(['quantity' => $this->quantity + $quantity]);
    }

    /**
     * Decrease the quantity of the item in the cart.
     *
     * @param int $quantity
     * @return void
     */
    public function decreaseQuantity($quantity = 1)
    {
        $newQuantity = max(0, $this->quantity - $quantity);
        $this->update(['quantity' => $newQuantity]);

        if ($newQuantity === 0) {
            $this->delete(); // Remove the item if the quantity becomes zero
        }
    }

}

