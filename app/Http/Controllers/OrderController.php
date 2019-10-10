<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            # ユーザー情報を取得
            $loginUser = Auth::user();

            # カートからデータを取得
            $cartItem =  collect(Cart::find($loginUser->id));

            if ($cartItem->isEmpty()) {
                return redirect(route('cart.index'))->with('error', 'カートの中に商品がありません。');
            }

            # 商品の在庫チェック
            if (Order::check($cartItem)) {
                return redirect(route('cart.index'))->with('error', '商品の在庫がない商品がありました。');
            }

            # 注文確定情報を保存
            Order::store($loginUser, $cartItem);

            # 金額を計算
            Order::calculateAmount();

            # クレジットカード決済
            $result = Order::pay();

            if ($result === false) {
                return redirect(route('cart.index'))->with('error', 'カード決済に失敗しました');
            }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
        }

        return view('orders.thanksPage', compact());
    }
}
