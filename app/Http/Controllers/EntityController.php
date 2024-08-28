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
        dd($this->service->searchEntities('https://www.santanderconsumer.es/prestamos/prestamos-de-ocasion.html', 'Carl'));
    }
}
