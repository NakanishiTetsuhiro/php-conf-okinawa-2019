<?php

namespace App\Services;

class PaymentService
{
    public function pay(int $amount): bool
    {
        try {
            //TODO: 決済のロジックを実装する
                
        } catch(\Exception $e) {

            return false;
        }
        return true;
    }
}
