<?php

namespace App\Models\response;

use Illuminate\Database\Eloquent\Model;

class SuccessResponse extends CommonResponse
{
    public function __construct(string $code, $data)
    {
        parent::__construct("ok", $code, $data);
    }
}
