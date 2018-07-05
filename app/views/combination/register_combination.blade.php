@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
   	<link href="/css/style.css" rel="stylesheet">    
@stop


@section('js')

<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">

</script>

@stop

@section('content')

<?php
$auth = Auth::attempt(array(
				'user' 	=> Input::get('Username')
				));
$role="student";
if($role=="student"){



}elseif ($role=="admin") {
	# code...
}else{

	echo"You don't have permission to access this area!";
}



?>


@stop