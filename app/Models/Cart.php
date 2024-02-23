<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Custom Methods

    /**
     * Add a product to the cart.
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, $quantity = 1)
    {
        // Check if the product is already in the cart
        $existingItem = $this->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            // If the product is already in the cart, update the quantity
            $existingItem->update(['quantity' => $existingItem->quantity + $quantity]);
            return $existingItem;
        } else {
            // If the product is not in the cart, create a new cart item
            return $this->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
    }

    /**
     * Calculate the total price of items in the cart.
     *
     * @return float
     */
    public function calculateTotalPrice()
    {
        return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    /**
     * Remove all items from the cart.
     *
     * @return void
     */
    public function clearCart()
    {
        $this->items()->delete();
    }

    /**
     * Check if the cart is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->items->isEmpty();
    }

    /**
     * Get the count of items in the cart.
     *
     * @return int
     */
    public function itemCount()
    {
        return $this->items->sum('quantity');
    }
}
