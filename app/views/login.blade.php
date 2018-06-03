@extends('layouts.popup')

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Fosmis Login</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="{{URL::route('sign-in')}}">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Username" name="Username" id="Username" required>
                  @if($errors->has('Username'))
                     <label  for="Username">
                  {{$errors->first('Username')}}
                     </label>
                  @endif
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" name="Password" id="Password" required>
                  @if($errors->has('Password'))
                     <label  for="Password">
                  {{$errors->first('Password')}}
                     </label>
                  @endif
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <span class="pull-right"><a href="#"></a></span><span><a href="#">help?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         <div class="col-md-12">
               @if(Session::has('message'))
                  <div class="alert alert-danger alert-dismissible">
                     <p><center>{{Session::get('message')}}</center></p>
                  </div>
               @elseif(isset($message))
                  <div class="alert alert-danger alert-dismissible">
                     <p ><center>{{$message}}</center></p>
                  </div>
               @endif
		    </div>	
      </div>
  </div>
  </div>
</div>
	</body>
</html>