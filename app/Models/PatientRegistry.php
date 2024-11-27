<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientRegistry extends Model
{
    protected $table = 'patient_registry';
    protected $fillable = [
        'name',
        'date_of_birth',
        'national_id',
        'address_id',
        ];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
