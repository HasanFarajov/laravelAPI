<?php

namespace App\Http\Controllers;

use App\Models\gelendata;
use App\Models\tarix;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Orchestra\Parser\Xml\Facade as XmlParser;

class Tarixgetir extends Controller
{
    public function store(Request $request)
    {
        $request_date = Carbon::parse($request->dataId);
        $tarix = $request_date->format('d.m.Y');
        $tarixYoxlama =tarix::select('id')->where('tarixT', '=', $tarix)->count();
        if ($tarixYoxlama >0){
            return to_route('tarixgetirgoster',$tarix);
        }else{
            $responses = simplexml_load_file('https://www.cbar.az/currencies/'.$tarix.'.xml') or die("Yuklenmedi");   
            tarix::create([
                'tarixT'=>$tarix,
            ]);
            $tarixId =tarix::where('tarixT', $tarix)->first()->id;
            foreach ($responses as $response){
                foreach($response->Valute as $val){
                    gelendata::create([
                        'nominal'=>$val->Nominal,'name'=>$val->Name,'value'=>$val->Value,'tarix'=>$tarix, 'tarixId'=>$tarixId, 
                    ]);
                }
            }
            return to_route('tarixgetirgoster',$tarix);
        }
    }

    public function show($tarix){
        
        $datas = gelendata::where('tarix', $tarix)->get();      
        return view('tarixgetir',compact('datas','tarix'));
    }

    public function edit($gelendataId)
    {  
        $gelenler = gelendata::where('id', $gelendataId)->get();
        return view('tarixgetirEdit', compact('gelenler'));
    }

     public function update(Request $request,$gelendataId)
    {
        gelendata::where('id', $gelendataId)->update([
            'nominal'=>$request->nominal,
            'name'=>$request->name,
            'value'=>$request->value,
        ]);

        $datas = gelendata::where('tarix', $request->tarix)->get();      
        return view('tarixgetir',compact('datas'));
    } 

    public function destroy($gelendataId)
    {   
        $t = DB::select('select tarix from gelendatas where id=?',[$gelendataId]);
        gelendata::where('id', $gelendataId)->delete(); 
        //$tarix = gelendata::select('tarix')->where('id', $gelendataId)->first();
        
        return to_route('tarixgetirgoster',$t[0]->tarix);
    }
}