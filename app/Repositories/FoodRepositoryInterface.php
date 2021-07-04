<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface FoodRepositoryInterface
{
    public function getMenu(): Collection;
}