@if(count($child))
    <ul class="dropdown-menu" aria-labelledby="{{$id}}">
@foreach($child as $value)
        @if(count($value->childrenRecursive))
        <li class="dropdown-submenu">
            <a class="dropdown-item dropleft dropdown-toggle" href="#">{{$value->title}}</a>
            @include('layout.submenu',['child'=>$value->childrenRecursive,'id'=>'navbarDropdownMenuLink'.$value->id])                    
        </li>
        @elseif($value->isModal)
            <li class="nav-item active"><a href="#" class="nav-link" data-toggle="modal" data-target="#{{$value->link}}">{{$value->title}}</a></li>
        @else
            <li><a href="{{url($value->link)}}" class="dropdown-item">{{$value->title}}</a></li>
        @endif
@endforeach
    </ul>
@endif