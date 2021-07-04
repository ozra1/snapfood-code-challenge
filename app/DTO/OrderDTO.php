<?php


namespace App\DTO;



class OrderDTO
{
    private string $foodId;

    public function __construct(array $request)
    {
        $this->foodId = $request['food_id'];
    }

    /**
     * @return mixed
     */
    public function getFoodId()
    {
        return $this->foodId;
    }
}