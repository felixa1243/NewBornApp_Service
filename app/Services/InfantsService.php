<?php

namespace App\Services;

use App\Repositories\InfantsRepository;
use App\Repositories\interfaces\IinfantsRepository;
use App\Services\interfaces\IinfantsService;
use App\Services\interfaces\IMotherService;
use App\Utils\DateFormater;
use App\Validators\InfantsValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InfantsService implements IinfantsService
{
    private IinfantsRepository $repository;
    private IMotherService $motherService;

    public function __construct(InfantsRepository $repository, MotherService $motherService)
    {
        $this->repository = $repository;
        $this->motherService = $motherService;
    }


    public function findAll(int $pageNumber)
    {
        return $this->repository->findAll($pageNumber);
    }

    public function create(Request $request)
    {
        $newbornInfants = $this->save($request);
        return [
            "id" => $newbornInfants->id,
            "name" => $newbornInfants->name,
            "gender" => $newbornInfants->gender,
            "height" => $newbornInfants->height,
            "weight" => $newbornInfants->height,
            "birth_day" => DateFormater::toLocal($newbornInfants->birth_day),
            "gestational_begin" => DateFormater::toLocal($newbornInfants->gestational_begin)
        ];
    }

    public function findById(string $id)
    {
        $result = $this->repository->findById($id);
        if (!$result) {
            throw new NotFoundHttpException("The infant's with id" . $id . "is not found");
        }
        return [
            "name" => $result->name,
            "gender" => $result->gender,
            "height" => $result->height,
            "weight" => $result->weight,
            "mother_id" => $result->mother_id,
            "birth_day" => $result->birth_day,
            "gestational_begin" => $result->gestational_begin,
            "gestational_age_weeks" => $result->gestational_age_weeks
        ];
    }

    public function findByName(string $name)
    {
        return $this->repository->findByName($name);
    }

    public function findByDateRange(Request $request)
    {
        //separator for formating
        $separator = ["from" => "-", "to" => "-"];
        $dateFrom = $request->get("from") ?? DateFormater::todayToLocal();
        $dateTo = $request->get("to") ?? DateFormater::todayToLocal();
        $page = $request->get("page") ?? 1;
        $startDate = DateFormater::toUtc($dateFrom, $separator);
        $endDate = DateFormater::toUtc($dateTo, $separator);
        return $this->repository->findByRangeOfBirthDay($startDate, $endDate, $page);
    }

    public function remove(string $id): int
    {
        //find the member with id, if not exists throw exception
        $this->repository->findById($id);
        return $this->repository->delete($id);
    }

    public function update(string $id, Request $request)
    {
        //find the member with id, if not exists throw exception
        $this->findById($id);
        $newbornInfants = $this->save($request, "update", $id);
        return [
            "id" => $newbornInfants->id,
            "name" => $newbornInfants->name,
            "gender" => $newbornInfants->gender,
            "height" => $newbornInfants->height,
            "weight" => $newbornInfants->height,
            "birth_day" => DateFormater::toLocal($newbornInfants->birth_day),
            "gestational_begin" => DateFormater::toLocal($newbornInfants->gestational_begin)
        ];
    }

    function save(Request $request, string $action = "create", $id = null)
    {
        // Validate input
        InfantsValidator::validate($request, $this->motherService);
        $birth_day = DateFormater::toUtc($request->json("birth_day"));
        $gestational_begin = DateFormater::toUtc($request->json("gestational_begin"));
        $data = [
            "name" => $request->json("name"),
            "gender" => $request->json("gender"),
            "height" => $request->json("height"),
            "weight" => $request->json("height"),
            "mother_id" => $request->json("mother_id"),
            "birth_day" => $birth_day,
            "gestational_begin" => $gestational_begin
        ];
        if ($action == "update" && $id) {
            return $this->repository->update($id, $data);
        }
        return $this->repository->save($data);
    }
}
