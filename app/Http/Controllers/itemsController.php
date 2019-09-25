<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
class itemsController extends Controller
{
    
public function index(){

$items = Items::get();
    return view('items',compact('items'));
}


public function show($id){
$items = Items::find($id);
return view('show',compact('items'));
}
}
