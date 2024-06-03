<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }
}
