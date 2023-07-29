<?php

namespace App\Validators;

use App\Services\interfaces\IMotherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InfantsValidator
{
    static function validate(Request $request, IMotherService $motherService): void
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "gender" => "required|in:male,female",
            "height" => "required|numeric",
            "weight" => "required|numeric",
            "mother_id" => "required",
            "birth_day" => "required|date_format:d-m-Y",
            "gestational_begin" => "required|date_format:d-m-Y",
        ]);

        // Validate if gestational age is > 29 weeks
        $validator->after(function ($validator) use ($request) {
            $birthday = Carbon::createFromFormat("d-m-Y", $request->input("birth_day"));
            $gestational = Carbon::createFromFormat("d-m-Y", $request->input("gestational_begin"));
            // find the different between first gestational date and birth of the new born infants
            $gestationalAgeWeeks = $birthday->diffInWeeks($gestational);

            if ($gestationalAgeWeeks <= 29) {
                $validator->errors()->add('gestational_begin', 'Gestational age must be greater than 29 weeks.');
            }
        });

        // validate if mother is exists
        $validator->after(function ($validator) use ($request, $motherService) {
            $motherId = $request->json("mother_id");
            $existingMother = $motherService->findById($motherId);

            if (!$existingMother) {
                $validator
                    ->errors()
                    ->add('mother_id', 'Mother with the provided ID does not exist.');
            }
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
