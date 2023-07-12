<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    public function getRouteKey()
    {
        return $this->slug;
    }

    // belongsTo si usa nel model della tabella che ha la chiave esterna, di conseguenza quella che sta dalla parte del molti
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public static function slugger($title){
        // Project::slugger($title);
        $baseSlug = Str::slug($title);
        $i = 1;
        $slug = $baseSlug;

        while(Project::where('slug', $slug)->first()){
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

}
