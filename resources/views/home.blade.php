@extends('layouts.app')

@section('content')


    <div class="row ">
        <div class="col-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-6">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
            </div>  
        @endif
          @yield('home')
      
        </div>
          <div class="col-3 float-left d-flex justify-content-end ">
                @include('layouts.sidebarright')
           </div>
        </div>
   
    </div>

@endsection
