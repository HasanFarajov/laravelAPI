<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarix extends Model
{
    use HasFactory;
    protected $fillable = ['tarixT'];

    public function gelendata(){
        return $this->hasMany(gelendata::class);
    }
}
