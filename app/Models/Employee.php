<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departement(){
        return $this->belongsTo(Departement::class, 'id_dept');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'id_position');
    }
}
