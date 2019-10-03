@extends('home')
@section('home')
<div class="d-flex">
<button type="submit" class="btn btn-primary m-3 " data-toggle="modal" data-target="#myModal" >Make street pet form</button>
</div>
<div class="row">
@foreach ($streetpets as $pet)

<div class="col-6">
<div class="card text-left">
<img class="card-img-top" src="{{$pet->image}}" alt="">
     
  <div class="card-body d-flex flex-column bd-highlight mb-3">

    <h5 class="card-title bg-dark text-light border border-primary rounded p-1">Address: {{$pet->address}}	&nbsp;</h5>
    <h5 class="card-title bg-dark text-light border border-primary rounded p-1">Telephone: {{$pet->telephone}}	&nbsp;</h5>
   <h3 class="card-text"><img src="{{$pet->user->avatar}}" style="width:40px; height:40px" class="rounded-circle" alt=""><a href="#">&nbsp;{{$pet->user->name}}</a></h3>
  </div>
</div>
</div>    
@endforeach

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Adoption Form</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{route('section.street.pets.post')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="modal-body">
             <div class="container-viewport">         
                <div class="form-group">
                  <label for="usr">Enter pet details:</label>
                
                  <input type="number" class="form-control  m-1" name="telephone" placeholder="your telephone.." required>
                  <input type="text" class="form-control m-1" name="address" placeholder="your address.."  required>
           
                  <br>
                  <label>Pet Image</label>
                  <input type="file" class="form-control" name="image" required>
                  <input type="number" name="price" value="0" hidden>
                  </div>               
             </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="submit" value="Ok" class="btn btn-primary" >
        </div>       
      </div>
    </form>
    </div>
  </div>
     
@endsection