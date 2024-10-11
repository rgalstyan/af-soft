<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Formatters\Interfaces\FurnitureRequestFormatterInterface;
use App\Models\Furniture;
use App\Repository\FurnitureRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class FurnitureRepository extends BaseRepository implements FurnitureRepositoryInterface
{
    public function __construct(
        Furniture $model
    ) {
        parent::__construct($model);
    }

    public function getFilteredFurnitures(FurnitureRequestFormatterInterface $filters): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if($filters->getUserId()) {
            $this->applyUserFilter($query, $filters->getUserId());
        }

        if($filters->getMinPrice()) {
            $this->applyMinPriceFilter($query, $filters->getMinPrice());
        }

        if($filters->getMaxPrice()) {
            $this->applyMaxPriceFilter($query, $filters->getMaxPrice());
        }

        if($filters->getMinQuantity()) {
            $this->applyMinQuantityFilter($query, $filters->getMinQuantity());
        }

        if($filters->getMaxQuantity()) {
            $this->applyMaxQuantityFilter($query, $filters->getMaxQuantity());
        }

        if($filters->getSearch()) {
            $this->applySearchFilter($query, $filters->getSearch());
        }

        return $query->with([
            'category',
        ])->orderBy('created_at', 'DESC')->paginate($filters->getPerPage());

    }

    private function applyUserFilter($query, int $userId): void
    {
        $query->where('user_id', $userId);
    }

    private function applyMinPriceFilter($query, float $minPrice): void
    {
        $query->where('price', '>=', $minPrice);
    }

    private function applyMaxPriceFilter($query, float $maxPrice): void
    {
        $query->where('price', '<=', $maxPrice);
    }

    private function applyMinQuantityFilter($query, float $minQuantity): void
    {
        $query->where('quantity', '>=', $minQuantity);
    }

    private function applyMaxQuantityFilter($query, float $maxQuantity): void
    {
        $query->where('quantity', '<=', $maxQuantity);
    }

    private function applySearchFilter($query, string $search): void
    {
        $search = '%'.$search.'%';

        $query->where(function ($query) use($search) {
            $query->where('title', 'like', $search)
                  ->orWhere('description', 'like', $search);
        });

    }
}
