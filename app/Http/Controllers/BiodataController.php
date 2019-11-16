<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\biodata;
class BiodataController extends Controller
{
  public function getIndex(){
      return view('admin.biodata');
  }
  
   public function getData(){
     return  biodata::all();
   }
   
   public function biodataStore(Request $r){
       biodata::create($r->all());
       return ['success'=>true,'message'=>'inserted sucessfully'];
   }
   
   public function biodataUpdate(Request $r){
        if($r->has('id')){
            biodata::find($r->input('id'))->update($r->all());
            return ['success'=>true,'message'=>'update  sucessfully'];
        }
   }
   
   public function biodataDelete(Request $r){
       if($r->has('id')){
            biodata::find($r->input('id'))->delete();
            return ['success'=>true,'message'=>'Delete  sucessfully'];
        }
   }
   
}
