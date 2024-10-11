<?php

declare(strict_types=1);

namespace App\Repository;

use App\Formatters\Interfaces\FurnitureRequestFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface FurnitureRepositoryInterface extends BaseRepositoryInterface
{
    public function getFilteredFurnitures(FurnitureRequestFormatterInterface $filters): LengthAwarePaginator;
}
