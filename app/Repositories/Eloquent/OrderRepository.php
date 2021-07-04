<?php


namespace App\Repositories;



use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements EloquentRepositoryInterface
{
    public static function getModel(): Model
    {
        return new Order();
    }

    public function create(string $foodId)
    {

    }
}