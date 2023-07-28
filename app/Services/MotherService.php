<?php

namespace App\Services;

use App\Repositories\interfaces\IMotherRepository;
use App\Repositories\MotherRepository;
use DateTime;
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

    public function create(Request $request): array
    {

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "birth_day" => "required|date"
        ]);

        //Validate birthday if it's age is > 18
        $validator->after(function ($validator) use ($request) {
            $birthDay = $request->json("birth_day");
            $birthDayDate = new DateTime($birthDay);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDayDate)->y;
            if ($age < 18) {
                $validator->errors()->add('birth_day', 'The person must be at least 18 years old.');
            }
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

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

    public function findById(string $id)
    {
        return $this->motherRepository->findById($id);
    }

    public function findByName(string $name)
    {
        return $this->motherRepository->findByName($name)->get();
    }


}
