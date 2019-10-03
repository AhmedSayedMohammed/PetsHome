@extends('home')
@section('home')

@foreach ($users as $user)
<div class="btn-group">

        @if ($user->type=='user')
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h2>{{$user->type}} </h2> {{$user->name}}
        </button>
         <div class="dropdown-menu">
          <form  action="{{route('make.doctor',$user->id)}}" method="POST" >
            @csrf
               <button class="dropdown-item" type="submit">Doctor</button>
             </form>    
  
           <form  action="{{route('make.admin',$user->id)}}" method="POST">
            @csrf
               <button class="dropdown-item" type="submit">Admin</button>
             </form>    
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Block</a>
      </div>
    </div>
        @else
        @if ($user->type=='doctor')
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h2>{{$user->type}} </h2> {{$user->name}}
                </button>
                <div class="dropdown-menu">
                  <form  action="{{route('make.admin',$user->id)}}" method="POST">
                    @csrf
                       <button class="dropdown-item" type="submit">Admin</button>
                     </form>    
          
                   <form  action="{{route('make.user',$user->id)}}" method="POST">
                    @csrf
                       <button class="dropdown-item" type="submit">User</button>
                     </form>    
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Block</a>
      </div>
    </div>
         @else
         <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <h2>{{$user->type}} </h2> {{$user->name}}
                </button>
                <div class="dropdown-menu">
         {{-- <a class="dropdown-item"  href="#">Admin</a> --}}
         <form  action="{{route('make.doctor',$user->id)}}" method="POST">
          @csrf
             <button class="dropdown-item" type="submit">Doctor</button>
           </form>    

         <form  action="{{route('make.user',$user->id)}}" method="POST">
          @csrf
             <button class="dropdown-item" type="submit">User</button>
           </form>    
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="#">Block</a>
       </div>
       </div>
         @endif
        @endif
        
     

@endforeach
@endsection