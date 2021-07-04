<?php


namespace App\Repositories\Eloquent;


use App\Models\Ingredient;
use App\Repositories\IngredientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    /**
     * IngredientRepository constructor.
     *
     * @param Ingredient $model
     */
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $foodId
     * @return Collection
     */
    public function getByFood(string $foodId): Collection
    {
        return $this->model->whereHas('foods', function (Builder $query) use ($foodId) {
            $query->where('id', $foodId);
        })->get();
    }

    /**
     * @param array $ids
     */
    public function updateStock(array $ids): void
    {
        $ids = implode(',', $ids);

        DB::raw('
            UPDATE ingredients 
            SET stock = stock - 1
            WHERE id IN (?)
            ', [$ids]);
    }
}