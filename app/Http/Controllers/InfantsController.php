<?php

namespace App\Http\Controllers;

use App\Models\response\SuccessResponse;
use App\Services\IinfantsService;
use App\Services\InfantsService;
use Illuminate\Http\Request;

class InfantsController extends Controller
{
    private IinfantsService $infantsService;

    public function __construct(InfantsService $infantsService)
    {
        $this->infantsService = $infantsService;
    }

    public function getAll(Request $request)
    {
        //if page is not present, then set it 1
        $pageNumber = $request->get("page") ?? 1;
        $data = $this->infantsService->findAll($pageNumber);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = $this->infantsService->create($request);
        $response = new SuccessResponse("201", (array)$data);
        return response()->json($response, 201);
    }
}
