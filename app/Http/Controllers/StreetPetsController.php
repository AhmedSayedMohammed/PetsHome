<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Streetpet;
use Illuminate\Support\Facades\Auth;

class StreetPetsController extends Controller
{
    public function index()
    {
        $streetpets=Streetpet::all();
        return view('sections.streetpet.show')->with('streetpets',$streetpets);
    }
    public function store(Request $request)
    {
        $pet=new Streetpet();
        $pet->address=$request->address;
        $pet->telephone=$request->telephone;
        $pet->image='';
        $pet->user_id=Auth::user()->id;
        $pet->save();

        if ($request->hasFile('image')) 
         {
            $fileContents=$request->image;
            Storage::disk('s3')->putFileAs('streetpets/'.$pet->id, $fileContents,'streetpet','public');
            $pet->image=Storage::disk('s3')->url('streetpets/'.$pet->id.'/streetpet');
            $pet->update();
          }
        $streetpets=Streetpet::all();
        return view('sections.streetpet.show')->with('streetpets',$streetpets);
    }
}
