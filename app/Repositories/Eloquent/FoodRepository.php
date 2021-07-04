<?php


namespace App\Repositories;


use App\Models\Order;
use Illuminate\Support\Facades\DB;

class FoodRepository
{
    public function updateStock(array $ingredientsId)
    {
        DB::raw('
            UPDATE ingredients 
            SET stock = stock - 1
            WHERE id IN (?)
            ', [$ingredientsId]);
    }
}