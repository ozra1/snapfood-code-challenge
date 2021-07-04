<?php


namespace App\Services;


use App\DTO\OrderDTO;
use App\Exceptions\IngredientFinishedException;
use App\Repositories\Eloquent\FoodRepository;
use App\Repositories\Eloquent\IngredientRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\FoodRepositoryInterface;
use App\Repositories\IngredientRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FoodService
{
    private FoodRepositoryInterface $foodRepository;
    private IngredientRepositoryInterface $ingredientRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(FoodRepositoryInterface $foodRepository, IngredientRepositoryInterface $ingredientRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->foodRepository = $foodRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMenu()
    {
        return $this->foodRepository->getMenu();
    }

    /**
     * @param OrderDTO $dto
     * @throws IngredientFinishedException
     */
    public function order(OrderDTO $dto)
    {
        $ingredients = $this->ingredientRepository->getByFood($dto->getFoodId());

        foreach ($ingredients as $ingredient) {
            if ($ingredient->stock == 0) {
                throw new IngredientFinishedException();
            }
        }

        DB::transaction(function () use ($dto, $ingredients) {

            $this->orderRepository->create(['food_id' => $dto->getFoodId()]);

            $this->ingredientRepository->updateStock($ingredients->get('id')->toArray());
        });
    }
}