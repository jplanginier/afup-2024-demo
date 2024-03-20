<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private int $value;

    #[ORM\Column]
    private int $durability;

    public function __construct(
        string $name,
        int $value,
        int $durability
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->durability = $durability;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function durability(): int
    {
        return $this->durability;
    }
}
