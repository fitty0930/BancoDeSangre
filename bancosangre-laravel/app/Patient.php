<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // TENGO QUE AVISARLE A LARAVEL QUE MI PRIMARY KEY SE LLAMA patient_id
    protected $primaryKey = 'patient_id';
    //
}
