<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
trait Uuids
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model){
            if(!$model->getKey()){
                $model->setAttribute($model->getKeyName(),Str::uuid()->toString());
            }
        });
    }
    // don't auto increment
    public function getIncrementing ()
    {
        return false;
    }
    // help to specify field type
    public function getKeyType ()
    {
        return 'string';
    }
}
