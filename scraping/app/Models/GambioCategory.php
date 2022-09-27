<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambioCategory extends Model
{
    use HasFactory;

    public function gambioProject(){
        return $this->belongsTo(GambioProject::class,'gambio_project_id','id');
    }
    public function gambioProductLinks(){
        return $this->hasMany(GambioProductLink::class,'gambio_category_id','id');
    }


}
