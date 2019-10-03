
<div class="side-bar position-fixed border rounded">
     <h3 class="bg-primary p-2 text-dark"> Followers <span class="fa fa-user-friends float-right"></span></h3>
    <ul>
        <div class="text-light">
     @foreach (Auth::user()->followings as $follower)
     
        <li><a class="btn text-light d-block" href="{{route('user.profile.other',$follower->id)}}"><img src="{{$follower->avatar}}" style="width: 30px;height: 30px;" class="rounded"> {{$follower->name}}</a></li>
   
               @endforeach 
        </div>     
    </ul>
</div>

   
