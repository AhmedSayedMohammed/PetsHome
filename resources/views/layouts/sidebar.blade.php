
<div class="side-bar position-fixed border rounded">
     <h3 class="bg-primary p-2 text-dark"> Sections <span class="fa fa-align-justify float-right"></span></h3>
    <ul>
            @if(Auth::user()->type!='doctor')
            <li>
            <a class="btn text-light d-block"  href="{{route('consultation')}}">Consultation <span class="glyphicon glyphicon-phone-alt pull-right"></span></a>
            </li>
            @endif
            <li>
            <a class="btn text-light d-block"  href="{{route('adoption.get')}}" class="active">Adoption<span class="glyphicon glyphicon-heart pull-right"></span></a>
            </li>
            <li>
            <a class="btn text-light d-block"  href="{{route('section.street.pets.get')}}">Street Pets <span class="glyphicon glyphicon-road pull-right"></span></a>
            </li>
    </ul>

</div>

   
