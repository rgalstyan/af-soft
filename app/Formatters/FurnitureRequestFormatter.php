<?php

declare(strict_types=1);

namespace App\Formatters;

use App\Formatters\Interfaces\FurnitureRequestFormatterInterface;

final class FurnitureRequestFormatter implements FurnitureRequestFormatterInterface
{
    private ?int $userId;

    private ?int $categoryId;

    private ?float $minPrice;

    private ?float $maxPrice;

    private ?float $minQuantity;

    private ?float $maxQuantity;

    private ?string $search;

    private ?int $page;

    private ?int $perPage;

    public function __invoke(array $request): self
    {
        $this->userId = !empty($request['user_id']) ? (int) $request['user_id'] : null;
        $this->categoryId = !empty($request['category_id']) ? (int) $request['category_id'] : null;
        $this->minPrice = !empty($request['price']['min']) ? (float) $request['price']['min'] : null;
        $this->maxPrice = !empty($request['price']['max']) ? (float) $request['price']['max'] : null;
        $this->minQuantity = !empty($request['quantity']['min']) ? (float) $request['quantity']['min'] : null;
        $this->maxQuantity = !empty($request['quantity']['max']) ? (float) $request['quantity']['max'] : null;
        $this->search = !empty($request['search']) ? (string) $request['search'] : null;
        $this->page = !empty($request['page']) ? (string) $request['per_page'] : 1;
        $this->perPage = !empty($request['per_page']) ? (int) $request['per_page'] : (int)config('paginationCounts.furniturePerPage');

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    public function getMinQuantity(): ?float
    {
        return $this->minQuantity;
    }

    public function getMaxQuantity(): ?float
    {
        return $this->maxQuantity;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
