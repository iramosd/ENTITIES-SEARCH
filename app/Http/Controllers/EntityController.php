<?php

namespace App\Http\Controllers;

use App\Services\EntityService;

class EntityController extends Controller
{
    public function __construct(
        protected readonly EntityService $service
    ) {}

    public function __invoke()
    {
        return response()->json([
            'data' => $this->service->getEntities('https://www.santanderconsumer.es/prestamos/prestamos-de-ocasion.html', 'Carl')
        ]);
    }
}
