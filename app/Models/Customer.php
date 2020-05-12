<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['dob'];

    public function path()
    {
        return '/customers/' . $this->id;
    }

    public function setDobAttribute($dob)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('Y-m-d', $dob);
    }

    protected function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

