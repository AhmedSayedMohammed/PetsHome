@extends('home')
@section('home')
   <consultation :consultation_id="{{$consultation_id}}" :user="{{Auth::user()}}" ></consultation>
   @endsection