<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    public function formInputs()
    {
        return $this->hasMany(FormInputs::class);
    }
}
