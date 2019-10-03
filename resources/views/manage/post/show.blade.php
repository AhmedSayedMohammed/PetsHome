@extends('home')
@section('home')
<posts :user="{{ Auth::user() }}"> </posts>

@endsection