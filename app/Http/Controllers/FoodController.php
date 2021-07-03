<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    private FoodService $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    public function getMenu(Request $request)
    {
        $this->foodService->getMenu();
    }

    public function order(Request $request, Food $food)
    {
        $this->foodService->getMenu();
    }
}
