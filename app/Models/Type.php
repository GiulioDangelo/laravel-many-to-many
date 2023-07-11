<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    public $timestamps = false; 

    // hasMany si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a molti
    // hasOone si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a uno
    public function projects(){
        return $this->hasMany(Project::class);
    }  
}
