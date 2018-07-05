
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="" >
    <meta name="generator" content="">

    <!-- CSS -->
    <link rel="shortcut icon" href="/img/Ruhuna.ico" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
    <style type="text/css">

    </style>

    <!-- Extra CSS -->



<!-- JavaScript -->
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootbox.min.js"></script>
    <script>
    </script>
</head>
<body style="background-color:whitesmoke;">
<div class="w3-container">

<div class=row-fluid">
    <h1 align="center"style="color:black;"><b><u>View Photo</u></b></h1>
</div>
</div>


<div class="w3-container">
    <div class=row-fluid">

        {{--<p align="center"><img src="http://localhost/My_Programs/FosmisWebApp-master/students_photos/sample.png" alt="Upload a Photo" style="width:198px;height:255px;border:10px;"></p>--}}

        {{--<p align="center"><img src="http://localhost/My_Programs/FosmisWebApp-master/students_photos/{{Input::get('sc_number')}}" alt= style="width:198px;height:255px;border:10px;"></p>--}}

        <p align="center"><img src="{{ URL::asset('temp/students_photos/'.Input::get('sc_number').'.jpg')}}" onerror="this.src='http://localhost/My_Programs/FosmisWebApp-master/public/temp/students_photos/sample.png';" style="width:198px;height:255px;border:10px;"></p>

    </div>


    {{--<div class=row-fluid">--}}
        {{--<p align="center"><a class="btn btn-navbar" href="{{URL::Route('update_photo')}}">Update Photo</a></p>--}}

    {{--</div>--}}

    <table align="center">
        <tr>
            <td>
    <form action="{{URL::Route('update_photo')}}" method="post" onsubmit="setScNumber()">
        <input type="hidden" id="sc_number" name="sc_number" value=""/>
        <input type="submit" value="Update Photo">
    </form>
            </td>
        </tr>
    </table>

</div>

<script>
    //assign sc number to the hidden field
    function setScNumber() {
        document.getElementById('sc_number').value='{{Input::get('sc_number')}}';
    }
</script>



</body>
</html>