<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Doctor as DoctorResource; 
use App\Http\Resources\Consultation as ConsultationResource; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Consultation;
use App\ConsultationComment;
class ConsultationController extends Controller
{
   public function get()
   {
       $users=User::where('type','=','doctor')->get();
       return view('sections.consultation.show')->with('users',$users);
   }
   public function getRoom($id)
   {
       return view('sections.consultation.room')->with('consultation_id',$id);
   }

   public function getConsultation($id)
   {
    $consult=Consultation::find($id);
    
    return new ConsultationResource($consult);
   }
   public function postConsultationComment(Request $request,$id)
   {
   
      $comm=new ConsultationComment();
      $comm->comment=$request->comment;
      $comm->consultation_id=$id;
      $comm->user_id=$request->user_id;
      $comm->save();
    
      $consult=Consultation::find($id);
      return new ConsultationResource($consult);
   }
   
   public function postRoom(Request $request, $id)
   {
    $consultation=new Consultation();
    $consultation->price=$request->price;
    $consultation->image=''; 
    $consultation->price=$request->price;   
    $consultation->body=$request->body; 
    $consultation->doctor_id=$id;
    $consultation->user_id=Auth::user()->id;
    $consultation->save();
    if ($request->hasFile('image')) {
        $fileContents=$request->image;
        Storage::disk('s3')->putFileAs('consultation/room/'.$consultation->id, $fileContents,'consultation','public');
        $consultation->image=Storage::disk('s3')->url('consultation/room/'.$consultation->id.'/consultation');
        $consultation->update();
    }
    
    return redirect('/consultation/room/'.$consultation->id);
   }
}
