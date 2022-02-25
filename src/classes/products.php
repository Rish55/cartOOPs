<?php
namespace App; 

class products{
    public int $id;
    public string $name;
    public float $price;
    public int $quantity;
    public float $tPrice;

    
    public function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = 1;
        $this->tPrice = $price;
    }

}

