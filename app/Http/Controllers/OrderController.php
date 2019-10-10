<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store()
    {
        array($route, $errorMessage) = $this->orderService->execOrder();

        if (blank($errorMessage)) {
            return view($route);
        } else {
            return view($route, $errorMessage);
        }
    }
}
