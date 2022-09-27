<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambioProject extends Model
{
    use HasFactory;

    public function gambioCategories(){
        return $this->hasMany(GambioCategory::class,'gambio_project_id','id');
    }

    


}
