<?php

namespace App\Models\response;

use Exception;

class ErrorResponse extends CommonResponse
{
    public string $error;

    public function __construct($code, string $err)
    {
        parent::__construct("error", $code, null);
        $this->error = $err;
    }
}
