<?php

namespace App\Http\Controllers;

use App\DTO\OrderDTO;
use App\Services\FoodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodController extends Controller
{
    private FoodService $foodService;

    /**
     * FoodController constructor.
     * @param FoodService $foodService
     */
    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMenu(Request $request)
    {
        $menu = $this->foodService->getMenu();

        return new JsonResponse($menu, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param string $foodId
     * @return JsonResponse
     * @throws \App\Exceptions\IngredientFinishedException
     */
    public function order(Request $request, string $foodId)
    {
        $dto = new OrderDTO($request->all());
        $this->foodService->order($dto);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
