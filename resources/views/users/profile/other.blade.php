@extends('home')
@section('home')
<div class="d-flex">
<div >
  <img src="{{$other->avatar}}"  style="width:200px; height:200px;" class="rounded-circle border border-dark border-2-improtant"  alt="profile">
  <h2 class="text-light">Dr/ {{$other->name}}</h2>
</div>
 <div class="float-right align-self-center text-light">
 <h4>Follow  &nbsp;&nbsp; | <span class="fa fa-user"></span>  {{$other->followings->count()}}</h4>
 <h4>Follower | <span class="fa fa-user-friends"></span> {{$other->followers->count()}}</h4>
    <h4>Posts  &nbsp; &nbsp; &nbsp; | <span class="fa fa-book"></span>  {{$other->posts->count()}}</h4>
</div>
</div>
<follow :other="{{$other}}" :user="{{Auth::user()}}" :followed="{{$followed}}"></follow>
<hr class="bg-light">

@endsection