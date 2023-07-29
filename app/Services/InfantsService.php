<?php

namespace App\Services;

use App\Repositories\InfantsRepository;
use App\Repositories\interfaces\IinfantsRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "gender" => "required|in:male,female",
            "height" => "required|numeric",
            "weight" => "required|numeric",
            "mother_id" => "required",
            "birth_day" => "required|date",
            "gestational_begin" => "required|date",
        ]);
        // validate if gestational age is > 30
        $validator->after(function ($validator) use ($request) {
            $birthday = new DateTime($request->json("birth_day"));
            $gestational = new DateTime($request->json("gestational_begin"));
            // Calculate the difference between gestational begin and birth day in weeks
            $interval = $birthday->diff($gestational);
            $gestationalAgeWeeks = $interval->days / 7;

            // Check if gestational age is greater than 30 weeks
            if ($gestationalAgeWeeks <= 30) {
                $validator->errors()->add('gestational_begin', 'Gestational age must be greater than 30 weeks.');
            }
        });
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $newbornInfants = $this->repository->save($request->all());
        return [
            "id" => $newbornInfants->id,
            "name" => $newbornInfants->name,
            "gender" => $newbornInfants->gender,
            "height" => $newbornInfants->height,
            "weight" => $newbornInfants->height,
            "birth_day" => $newbornInfants->birth_day,
            "gestational_begin" => $newbornInfants->gestational_begin
        ];
    }

    public function findById(string $id)
    {
        return $this->repository->findById($id);
    }

    public function findByName(string $name)
    {
        return $this->repository->findByName($name);
    }

}
