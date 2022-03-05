<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormInputOptions extends Model
{
    public function formInput()
    {
        return $this->belongsTo(FormInputs::class);
    }
}
