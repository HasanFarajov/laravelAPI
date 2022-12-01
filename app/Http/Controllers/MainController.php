<?php

namespace App\Http\Controllers;

use App\Models\gelendata;
use App\Models\Tarix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Orchestra\Parser\Xml\Facade as XmlParser;

class MainController extends Controller
{
    public function index(){

    $datas = gelendata::all();
    return view('welcome',compact('datas'));

    }

    
 

}