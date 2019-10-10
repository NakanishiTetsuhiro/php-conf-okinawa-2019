<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public static function getCartItemByUserId(int $userId) {
        return collect(Cart::find($userId));
    }
}
