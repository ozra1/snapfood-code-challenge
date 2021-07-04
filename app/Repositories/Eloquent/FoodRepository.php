<?php


namespace App\Repositories\Eloquent;



use App\Models\Food;
use App\Models\Ingredient;
use App\Repositories\FoodRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class FoodRepository extends BaseRepository implements FoodRepositoryInterface
{
    /**
     * FoodRepository constructor.
     *
     * @param Ingredient $model
     */
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
    }

    public function getMenu(): Collection
    {
        return Food::query()->whereHas('ingredients', function (Builder $query) {
            $query->where('stock', '>', 0);
            $query->whereDate('expires_st', '>=', Carbon::now()->timestamp);
            $query->orderBy('best_before');
        })->get();
    }
}