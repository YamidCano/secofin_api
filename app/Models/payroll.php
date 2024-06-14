<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payroll extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function functionary()
    {
        return $this->belongsTo('App\Models\functionary', 'id_functionary');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\position', 'id_position');
    }
}
