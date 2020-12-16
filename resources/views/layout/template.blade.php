@php
	$version = getVersion();
	$ssvMenuList = ssvMenuList();
	$user = Session::get('user');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="notranslate" translate="no">
<head>
    @include('layout.head')
</head>
<body>
<div class="wrap">
    @include('layout.header',['version'=>$version,'ssvMenuList'=>$ssvMenuList,'user'=>$user])
    <div class="container-fluid" style="margin-top: 80px;">
    	@yield('content')
    </div>
    @include('layout.footer',['version'=>$version,'ssvMenuList'=>$ssvMenuList])
</div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    @include('layout.foot')
</body>

</html>