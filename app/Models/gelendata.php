<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gelendata extends Model
{
    use HasFactory;

    protected $fillable = ['nominal','name','value','tarix','tarixId'];


    public function tarix(){
        return $this->belongsTo(tarix::class);
    }
}
