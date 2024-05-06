<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payroll extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo('App\Models\employee', 'id_employee');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\position', 'id_position');
    }
}
