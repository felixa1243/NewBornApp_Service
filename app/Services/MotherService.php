<?php

namespace App\Services;

use App\Repositories\interfaces\IMotherRepository;
use App\Repositories\MotherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    /**
     * @throws ValidationException
     */
    public function create(Request $request): array
    {
        Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "birth_day" => "required|date"
        ])->validate();

        $name = $request->json("name");
        $birthDay = $request->json("birth_day");
        $createdMother = $this->motherRepository->save([
            "name" => $name,
            "birth_day" => $birthDay
        ]);

        return [
            "id" => $createdMother->id,
            "name" => $createdMother->name,
            "birth_day" => $createdMother->birth_day
        ];
    }


}
