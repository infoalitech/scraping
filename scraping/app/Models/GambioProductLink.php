<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambioProductLink extends Model
{
    use HasFactory;

    public function gambioCategory(){
        return $this->belongsTo(GambioCategory::class,'gambio_category_id','id');
    }
}
