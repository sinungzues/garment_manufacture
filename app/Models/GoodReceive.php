<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReceive extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function suplier(){
        return $this->belongsTo(Suplier::class, 'id_suplier');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user_in');
    }
    public function po(){
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }
}
