<?php

namespace Tests\Unit;

use App\DTO\OrderDTO;
use App\Models\Ingredient;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\IngredientRepositoryInterface;
use App\Services\FoodService;
use Tests\TestCase;

class FoodServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_order()
    {
        $dto = new OrderDTO(['food_id' => 1]);

        $ingredient = new Ingredient([
            'id' => 1,
            'stock' => 2,
        ]);


        $ingredientRepositoryMock = \Mockery::mock(IngredientRepositoryInterface::class);
        $ingredientRepositoryMock->shouldReceive('getByFood')
            ->with($dto->getFoodId())
            ->andReturn(collect([$ingredient]))
            ->once();
        $ingredientRepositoryMock->shouldReceive('updateStock')
            ->with($dto->getFoodId())
            ->andReturn([1])
            ->once();
        $this->app->instance(IngredientRepositoryInterface::class, $ingredientRepositoryMock);


        $orderRepositoryMock = \Mockery::mock(OrderRepository::class);
        $orderRepositoryMock->shouldReceive('create')
            ->with(['food_id' => $dto->getFoodId()])
            ->once();
        $this->app->instance(OrderRepository::class, $orderRepositoryMock);


        $foodService = app(FoodService::class);
        $foodService->order($dto);
    }
}
