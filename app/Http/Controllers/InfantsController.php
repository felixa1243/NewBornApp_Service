<?php

namespace App\Http\Controllers;

use App\Models\response\SuccessResponse;
use App\Services\InfantsService;
use App\Services\interfaces\IinfantsService;
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
        $response = new SuccessResponse("201", $data);
        return response()->json($response, 201);
    }

    public function getAllByDateRange(Request $request)
    {
        $infants = $this->infantsService->findByDateRange($request);
        return response()->json($infants);
    }

    public function update($id, Request $request)
    {
        $data = $this->infantsService->update($id, $request);
        $response = new SuccessResponse("201", $data);
        return response()->json($response);
    }

    public function getById($id)
    {
        $data = $this->infantsService->findById($id);
        $response = new SuccessResponse("200", $data);
        return response()->json($response);

    }

    public function delete($id)
    {
        $response = new SuccessResponse("204", [
            "message" => "infants with id: " . $id . " successfully deleted"
        ]);
        $this->infantsService->remove($id);
        return response()->json($response);
    }

    public function getYearlyAnalytics(Request $request)
    {
        $data = $this->infantsService->getAnalytics($request);
        $response = new SuccessResponse("200", $data);
        return response()->json($response);
    }

}
