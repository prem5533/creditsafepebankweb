    <!-- ======= Header ======= -->
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light" style="z-index: 112;">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{imageList($version['logo'])}}" style="width: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto topNav">
                @if(isLogged())
                    <li class="nav-item"><a href="{{route('ssvProfile')}}" class="nav-link" data-toggle="modal">Welcome {{$user['first_name']}} {{$user['last_name']}}</a></li>
                    <li class="nav-item"><a href="{{route('ssvMyWallet')}}" class="nav-link" data-toggle="modal"><i class="fas fa-wallet"></i> <i class="fas fa-rupee-sign"></i> {{number_format($user['wallet_amount'],2)}}</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="logoutMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Logout</a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutMenu">
                            <li><a class="dropdown-item" href="{{route('logout')}}" data-toggle="tooltip" data-html="true" title="<em><b>Logout</b></em>" class="nav-link" >Logout</a></li>
                            <li><a class="dropdown-item" href="{{route('logoutAlldevices')}}" data-toggle="tooltip" data-html="true" title="<em><b>Logout</b></em> from all devices" class="nav-link" >Logout from all devices</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link" data-toggle="modal">Welcome Guest</a></li>
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link" data-toggle="modal">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- End Header -->
<style>
  /* Style the links inside the sidenav */
#mySidenav a {
  position: absolute; /* Position them relative to the browser window */
  left: -150px; /* Position them outside of the screen */
  transition: 0.3s; /* Add transition on hover */
  padding: 15px; /* 15px padding */
  width: 250px; /* Set a specific width */
  text-decoration: none; /* Remove underline */
  font-size: 16px; /* Increase font size */
  color: white; /* White text color */
  border-radius: 0 5px 5px 0; /* Rounded corners on the top right and bottom right side */
  text-align: center;
  z-index: 500;
}

#mySidenav a:hover {
  left: 0; /* On mouse-over, make the elements appear as they should */
}
</style>
@if(count($ssvMenuList))
<div id="mySidenav" class="sidenav">
    @php
      if(count($ssvMenuList['drawerList'])){
        $key = 0;
        foreach($ssvMenuList['drawerList'] as $value){
          if($value['status']){
            $key++;
    @endphp
            <a href="/{{$value['activityName']}}" style="top: {{$key * 55}}px;background-color: #{{(555+20*$key)}};"><img class="img img-responsive" src="{{imageList($value['icon'])}}" width="20px">{{$value['name']}}</a>
    @php
          }
        }
      }
    @endphp
</div>
@endif