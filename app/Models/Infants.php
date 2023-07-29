<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infants extends Model
{
    use Uuids, HasFactory;

    protected $fillable = [
        "name",
        "gender",
        "birth_day",
        "gestational_begin",
        "mother_id",
        "height",
        "weight"
    ];
    protected $perPage = 10;

    public function mother()
    {
        $this->belongsTo(Mothers::class);
    }
}
