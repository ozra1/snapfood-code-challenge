<?php
namespace App\Repositories;

interface IngredientRepositoryInterface
{
    public function updateStock(array $ids): void ;
}