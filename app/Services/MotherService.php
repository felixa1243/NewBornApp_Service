<?php

namespace App\Services;

use App\Repositories\interfaces\IMotherRepository;
use App\Repositories\MotherRepository;
use App\Services\interfaces\IMotherService;
use App\Utils\DateFormater;
use App\Validators\MotherValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MotherService implements IMotherService
{
    private IMotherRepository $motherRepository;

    public function __construct(MotherRepository $motherRepository)
    {
        $this->motherRepository = $motherRepository;
    }

    public function findAll(int $pageNumber)
    {
        return $this->motherRepository->findAll($pageNumber);
    }

    public function create(Request $request): array
    {
        MotherValidator::validate($request);
        return $this->save($request);
    }

    public function findById(string $id)
    {
        $result = $this->motherRepository->findById($id);
        if (!$result) {
            throw new NotFoundHttpException("mother with id " . $id . "is not found");
        }
        return $result;
    }

    public function findByName(string $name)
    {
        return $this->motherRepository->findByName($name)->get();
    }

    public function remove(string $id)
    {
        // find mother by id, if not get the result then throw exception
        $this->findById($id);
        return $this->motherRepository->delete($id);
    }

    public function update(string $id, Request $request)
    {
        // find mother by id, if not get the result then throw exception
        $this->findById($id);
        MotherValidator::validate($request);

        $updatedMother = $this->save($request, "update", $id);

        return [
            "id" => $updatedMother->id,
            "name" => $updatedMother->name,
            "birth_day" => DateFormater::toLocal($updatedMother->birth_day)
        ];
    }

    private function save(Request $request, string $action = "create", $id = null)
    {
        MotherValidator::validate($request);
        $data = [
            "name" => $request->json("name"),
            "birth_day" => DateFormater::toUtc($request->json("birth_day"))
        ];
        $createdMother = $this->motherRepository->save($data);
        if ($action == "update" && $id) {
            return $this->motherRepository->update($id, $data);
        }
        return [
            "id" => $createdMother->id,
            "name" => $createdMother->name,
            "birth_day" => DateFormater::toLocal($createdMother->birth_day)
        ];
    }

}
