<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IngredientRepositoryInterface
{
    public function getByFood(string $foodId): Collection;

    public function updateStock(array $ids): void ;
}