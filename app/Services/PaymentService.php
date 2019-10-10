<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function pay(int $amount): bool
    {
        try {
            //TODO: 決済のロジックを実装する

        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return true;
    }
}
