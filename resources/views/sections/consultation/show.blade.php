@extends('home')
@section('home')
<div class="row">
  
  @foreach ($users as $user)
  <div class="col-6">
      <div class="card" style="width: 15rem;">
          <img src="{{$user->avatar}}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">{{$user->name}}</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Start</button>
               
              @for ($i = 0; $i < $user->doctor->rate ; $i++)
                <span class="fa fa-star text-warning float-right"></span>
                @endfor
            </div>
          </div>
           <!-- The Modal -->
 <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Consultation Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <form action="{{route('consultation.room',$user->doctor->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
           <div class="container-viewport">         
              <div class="form-group">
                <label for="usr">Your problem:</label>
                <textarea rows="4" cols="50" name="body" class="form-control" required >
                </textarea>
                <br>
                <label>Pet Image</label>
                <input type="file" class="form-control" name="image">
                <input type="number" name="price" value="0" hidden>
                </div>               
           </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" value="Consult" class="btn btn-primary" >
      </div>       
    </div>
  </form>
  </div>
</div>
    </div>
   @endforeach
</div>

@endsection