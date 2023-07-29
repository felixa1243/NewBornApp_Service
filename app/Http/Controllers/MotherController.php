<?php

namespace App\Http\Controllers;

use App\Models\response\SuccessResponse;
use App\Services\interfaces\IMotherService;
use App\Services\MotherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class MotherController extends Controller
{
    private IMotherService $motherService;

    public function __construct(MotherService $motherService)
    {
        $this->motherService = $motherService;
    }

    public function getAll(Request $request)
    {
        $pageNumber = $request->get("page") ?? 1;
        $data = $this->motherService->findAll((int)($pageNumber));
        return response()->json($data);
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->motherService->create($request);
        $response = new SuccessResponse("201", $data);
        return response()->json($response, 201);
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
        return response()->json($response);
    }

    public function update($id, Request $request)
    {
        $data = $this->motherService->update($id, $request);
        $response = new SuccessResponse("201", $data);
        return response()->json($response, 201);
    }

    public function delete($id)
    {
        $response = new SuccessResponse("204", [
            "message" => "mother with id: " . $id . " successfully deleted"
        ]);
        $this->motherService->remove($id);
        return response()->json($response);
    }
}
