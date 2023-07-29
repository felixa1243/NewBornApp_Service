<?php

namespace App\Services\interfaces;

use Illuminate\Http\Request;

interface IinfantsService extends BaseService
{
    public function findByDateRange(Request $request);
}
