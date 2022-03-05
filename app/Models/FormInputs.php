<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormInputs extends Model
{
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    public function formInputOptions()
    {
        return $this->hasMany(FormInputOptions::class, 'form_input_id');
    }
}
