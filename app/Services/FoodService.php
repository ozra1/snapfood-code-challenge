<?php


namespace App\Services;


use App\Models\Food;
use App\Repositories\FoodRepository;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class FoodService
{
    private FoodRepository $foodRepository;

    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    public function getMenu()
    {
        return Food::query()->whereHas('ingredients', function (Builder $query) {
            $query->where('stock', '>', 0);
            $query->whereDate('expires_st', '>=', Carbon::now()->timestamp);
            $query->orderBy('best_before');
        })->get();
    }

    public function order(Food $food)
    {
        $finishedIngredients = $this->foodRepository->getFinishedCount($foodId);

    }
}