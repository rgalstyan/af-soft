<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Furniture\FilteredFurnituresRequest;
use App\Http\Requests\Furniture\FurnitureStoreRequest;
use App\Http\Requests\Furniture\FurnitureUpdateRequest;
use App\Http\Resources\Furniture\FurnitureResource;
use App\Models\Furniture;
use App\Services\FurnitureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class FurnitureController extends Controller
{
    public function __construct(
        private readonly FurnitureService $furnitureService
    ) {
    }

    public function index(FilteredFurnituresRequest $request): AnonymousResourceCollection|JsonResponse
    {
        $furnitures = $this->furnitureService->index($request->validated());
        if($furnitures) {
            return FurnitureResource::collection($furnitures);
        }
        return $this->response400();
    }

    public function store(FurnitureStoreRequest $request): FurnitureResource|JsonResponse
    {
        $furnitures = $this->furnitureService->store($request->validated());
        if($furnitures) {
            return FurnitureResource::make($furnitures);
        }
        return $this->response400();
    }

    public function show(int $id): FurnitureResource|JsonResponse
    {
        $furniture = $this->furnitureService->show($id);

        if($furniture) {
            return FurnitureResource::make($furniture);
        }
        return $this->response404();
    }

    public function update(
        FurnitureUpdateRequest $request,
        Furniture $furniture
    ): FurnitureResource|JsonResponse
    {
        $furniture = $this->furnitureService->update($furniture, $request->validated());
        if($furniture) {
            return $this->response200('Furniture updated successfully');
        }
        return $this->response404();
    }

    public function destroy(Furniture $furniture): JsonResponse
    {
        if($this->furnitureService->destroy($furniture)) {
            return $this->response200('Furniture deleted successfully');
        }
        return $this->response404();
    }
}
