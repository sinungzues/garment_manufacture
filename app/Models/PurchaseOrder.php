<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departement(){
        return $this->belongsTo(Departement::class, 'id_dept');
    }
    public function suplier(){
        return $this->belongsTo(Suplier::class, 'id_suplier');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user_in');
    }
    public function userD(){
        return $this->belongsTo(User::class, 'user_delete');
    }
    public function currency(){
        return $this->belongsTo(Currency::class, 'id_currency');
    }
}
