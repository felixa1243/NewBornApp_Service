<?php

namespace App\Http\Controllers;

use App\Models\response\ErrorResponse;
use App\Models\response\SuccessResponse;
use App\Services\IMotherService;
use App\Services\MotherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MotherController extends Controller
{
    private IMotherService $motherService;

    public function __construct(MotherService $motherService)
    {
        $this->motherService = $motherService;
    }

    public function getAll(Request $request)
    {
        $pageNumber = $request->getQueryString() ?? 1;
        return response()->json([
            "data" => $this->motherService->findAll((int)($pageNumber))
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $data = $this->motherService->create($request);
            $response = new SuccessResponse("201", $data);
            return response()->json($response);
        } catch (ValidationException $e) {
            $response = new ErrorResponse("400", $e->getMessage());
            return response()->json($response, 400);
        }
    }

    public function findMotherByName(Request $request)
    {
        $name = $request->get("name");
        $data = $this->motherService->findByName($name)->all();
        $response = new SuccessResponse("200", $data);
        return response()->json($response);
    }

    public function findMotherById($id)
    {
        $data = (array)$this->motherService->findById($id);
        $response = new SuccessResponse("200", $data);
        return response()->json(["data"=>$response]);
    }
}
