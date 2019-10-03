<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Adoption;
use Illuminate\Support\Facades\Auth;
class AdoptionController extends Controller
{
    public function getAdoption()
    {
        $adoptions =Adoption::all();
        return view('sections.adoption.show')->with('adoptions',$adoptions);
    }
    public function postAdoption(Request $request)
    {
        $adoption=new Adoption();
        $adoption->type=$request->type;
        $adoption->age=$request->age;
        $adoption->price=$request->price;
        $adoption->gender=$request->gender;
        $adoption->address=$request->address;
        $adoption->telephone=$request->telephone;
        $adoption->description=$request->description;
        $adoption->image='';
        $adoption->user_id=Auth::user()->id;
        $adoption->save();

        if ($request->hasFile('image')) 
        {
            $fileContents=$request->image;
            Storage::disk('s3')->putFileAs('adoption/'.$adoption->id, $fileContents,'adoption','public');
            $adoption->image=Storage::disk('s3')->url('adoption/'.$adoption->id.'/adoption');
            $adoption->update();
        }
        $adoptions =Adoption::all();
        return back()->with('adoptions',$adoptions);
    }
}
