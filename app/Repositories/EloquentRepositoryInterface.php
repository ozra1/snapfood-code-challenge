<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface MysqlRepositoryInterface
{
    public static function getModel(): Model;
}