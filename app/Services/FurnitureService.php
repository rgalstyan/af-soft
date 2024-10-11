<?php

declare(strict_types=1);

namespace App\Services;

use App\Formatters\Interfaces\FurnitureRequestFormatterInterface;
use App\Models\Furniture;
use App\Repository\FurnitureRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class FurnitureService
{
    public function __construct(
        private FurnitureRepositoryInterface       $furnitureRepository,
        private FurnitureRequestFormatterInterface $furnitureRequestFormatter,
    ){
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function index(array $filters): LengthAwarePaginator
    {
        $formatedFilters = ($this->furnitureRequestFormatter)($filters);
        return $this->furnitureRepository->getFilteredFurnitures($formatedFilters);
    }

    /**
     * @param array $data (Validated request)
     * @return object|false
     */
    public function store(array $data): object|false
    {
        try {
            DB::beginTransaction();

            $furniture = $this->furnitureRepository->create($data);

            DB::commit();

            return $furniture;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

        return false;
    }

    /**
     * @param int $id
     * @return Furniture|false
     */
    public function show(int $id): Furniture|false
    {
        try {
            return $this->furnitureRepository->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }
        return false;
    }

    /**
     * @param Furniture $furniture
     * @param array $data (Validated request)
     * @return bool
     */
    public function update(Furniture $furniture, array $data): bool
    {
        try {
            DB::beginTransaction();

            $furniture->update($data);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

        return false;
    }

    public function destroy(Furniture $furniture): bool
    {
        try {
            DB::beginTransaction();

            $furniture->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

        return false;
    }
}
