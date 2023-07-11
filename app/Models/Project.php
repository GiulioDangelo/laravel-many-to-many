<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    // belongsTo si usa nel model della tabella che ha la chiave esterna, di conseguenza quella che sta dalla parte del molti
    public function types(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
