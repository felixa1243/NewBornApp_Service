<?php
namespace App\Models;

class ErrorResponse extends CommonResponse{

    public function __construct($code,array $data)
    {
        parent::__construct("error",$code,$data);
    }
}