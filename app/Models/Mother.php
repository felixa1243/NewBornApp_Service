<?php
namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
class Mother extends Model
{
    use Uuids;
    protected $fillable = ["name", "birth_day"];
}
