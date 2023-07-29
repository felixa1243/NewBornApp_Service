<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mothers extends Model
{
    use Uuids, HasFactory;

    protected $fillable = ["name", "birth_day"];
    protected $perPage = 10;
}
