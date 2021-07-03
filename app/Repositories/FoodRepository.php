<?php


namespace App\Repositories;


use App\Models\Order;
use Illuminate\Support\Facades\DB;

class FoodRepository
{
    public function getFinishedCount($foodId)
    {
        return DB::selectOne('
            SELECT count(i.id)
            FROM food_ingredient AS fi
            INNER JOIN ingredients AS i ON i.id = fi.ingredient_id
            WHERE fi.food_id = ? i.stock = 0
            ', [$foodId]);
    }

    public function order($foodId)
    {
        if ($food->stock = 0) {
            return;
        }

        DB::transaction(function () use ($food) {


            if ($finishedIngredients) {
                DB::rollBack();
            }

            Order::query()->create([
                'food_id' => $food->id,
            ]);

            foreach ($food->ingredients as $ingredient) {
                $ingredient->update([
                    'stock' => $ingredient->stock - 1
                ]);
            }
        });
    }
}