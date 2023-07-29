<?php

namespace App\Validators;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MotherValidator
{
    static function validate(Request $request): void
    {

        $validator = Validator::make($request->all(), [
            "name" => "required|min:3|max:100",
            "birth_day" => "required|date_format:d-m-Y"
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
    }
}
