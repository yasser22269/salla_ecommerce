<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function delete(User $user, Order $order)
    {
        // Check your logic here to determine if the user can delete the order
        // For example, you might check if the user is the owner of the order
        return $user->id === $order->user_id;
    }
}
