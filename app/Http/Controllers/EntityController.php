<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityRequest;
use App\Services\EntityService;

class EntityController extends Controller
{
    public function __construct(
        protected readonly EntityService $service
    ) {}

    public function __invoke(EntityRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'data' => $this->service->getEntities($data['url'], $data->keyWord ?? ''),
        ]);
    }
}
