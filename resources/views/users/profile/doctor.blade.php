@extends('home')
@section('home')


<div class="">
<img src="{{Auth::user()->avatar}}"  style="width:200px; height:200px; border-width:3px !important;" class="rounded-circle border border-success border-10"  alt="profie">
<h2 class="text-success">Dr/ {{Auth::user()->name}}</h2>

<form action="{{route('update.user',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
 @csrf
  <div class="form-group-light text-light d-flex d-flex-row">
  <input type="file" class="form-control-file" name="avatar" id="" placeholder="" aria-describedby="fileHelpId">
  <button type="submit" class=" btn btn-success">Upload</button>  
</div>
</form>
</div>
<hr color="white">
<div>
  @foreach ($consultations as $consultation)     
 <div class="card">
   @if($consultation->image !=null)
   <img class="card-img-top" src="{{$consultation->image}}" >
   @endif
   <div class="card-body">
     <div class="d-flex d-flex-row">
     <h4 class="card-title text-success">Dr/{{$consultation->user->name}} &nbsp;</h4> <h4 class="card-title"> and {{$consultation->doctor->user->name}}  </h4>
    </div>
     <p class="card-text">{{$consultation->body}}</p>
   </div>
 </div>
 @endforeach
</div>

@endsection