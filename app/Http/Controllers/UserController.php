<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Doctor;
use App\Follower;
class UserController extends Controller
{
    public function __construct()
    {
       
        $this->middleware('auth');
    }

    public function showProfile()
    {
        if (Auth::user()->type =='user')
        {
        return view('users.profile.user');
        }
        else if (Auth::user()->type =='doctor')
        {
            $doctor=Doctor::where('user_id','=',Auth::user()->id)->first();
            $consultations=$doctor['consultations'];
            return view('users.profile.doctor')->with('consultations',$consultations);
        }
        else if (Auth::user()->type =='admin')
        {
            $users=User::all();
            return view('users.profile.admin')->with('users',$users);
        }
    }
    public function makeAdmin(Request $request ,$id)
    {
         $user=User::find($id);
         $user->type='admin';
         $user->update();
        return redirect()->back();
    }
    public function makeDoctor(Request $request ,$id)
    {
        if(!Doctor::where('user_id','=',$id)->exists())
        {
            $doctor=new Doctor();
            $doctor->rate=0;
            $doctor->user_id=$id;
            $doctor->save();
        }
        
        $user=  User::find($id);
        $user->type='doctor';
        $user->update();
        return redirect()->back();
    }
    public function makeUser(Request $request ,$id)
    {
         $user=User::find($id);
         $user->type='user';
         $user->update();
        return redirect()->back();
    }
    public function updateUser(Request $request,$id)
     {
         if (!$request->hasFile('avatar')) {
            return back()->with('status', 'Choose a file ');
        }
          
          $fileContents=$request->avatar;
          Storage::disk('s3')->putFileAs('avatars/users/'.$id, $fileContents,'avatar','public');

          $user= User::find($id);    
          $user->avatar=Storage::disk('s3')->url('avatars/users/'.Auth::user()->id.'/avatar');
          $user->update();
        return redirect()->back();
    }
    
    public function otherProfile($other_id)
    {
        if ($other_id==Auth::user()->id) {
          return  $this->showProfile();
        }

       
        if (Follower::where('user_id','=',Auth::user()->id)->where('leader_id','=',$other_id)->exists()) {
            $followed='true';
        }else
        {
            $followed='false';
        }

        $other=User::find($other_id);
        return view('users.profile.other')->with('other',$other)->with('followed',$followed);
    }
}
