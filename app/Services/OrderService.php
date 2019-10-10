<?php

namespace App\Services;

use App\Cart;
use App\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderService
{
    private $cart;
    private $order;
    private $paymentService;

    public function __construct(Cart $cart, Order $order, PaymentService $paymentService)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->paymentService = $paymentService;
    }

    public function execOrder(): array
    {
        $cartItems = $this->cart->getCartItemByUserId(Auth::id());
        if ($cartItems->isEmpty()) {
            return ['cart.index', 'カートの中に商品がありません。'];
        }

        if ($this->isStockEmpty($cartItems)) {
            return ['cart.index', '商品の在庫がない商品がありました。'];
        }

        $amount = $this->calculateAmount($cartItems);

        $result = $this->paymentService->pay($amount);
        if ($result === false) {
            return ['cart.index', 'カード決済に失敗しました。'];
        }

        # 注文確定情報を保存
        $this->order->store($amount);

        return ['orders.thanksPage', null];
    }

    public function calculateAmount(Collection $cartItems) : Int
    {
        $sum = 0;

        foreach($cartItems as $cartItem){
            $sum += $cartItem;
        }

        return $sum;
    }

    public function isStockEmpty($cartItems): bool
    {
        // TODO: 在庫があるかどうか調べる仕組みを実装
        return true;
    }
}
