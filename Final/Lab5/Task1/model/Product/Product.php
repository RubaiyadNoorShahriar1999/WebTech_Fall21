<?php

class Product
{
    private int $id;
    private string $name;
    private float $buyingprice;
    private float $sellingprice;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setBuyingPrice(float $buyingprice): void
    {
        $this->buyingprice = $buyingprice;
    }

    public function getBuyingPrice(): float
    {
        return $this->buyingprice;
    }

    public function setSellingPrice(float $sellingprice): void
    {
        $this->sellingprice = $sellingprice;
    }

    public function getSellingPrice(): float
    {
        return $this->sellingprice;
    }
}
