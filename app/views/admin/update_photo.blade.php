
<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>WebcamJS Test Page</title>
    <style type="text/css">
        body { font-family: Helvetica, sans-serif; }
        h1, h2, h3 { margin-top:0; margin-bottom:0; }
        form { margin-top: 15px; }
        form input { margin-right: 15px; }
        #results { display:inline-block; margin:20px; padding:20px; border:1px solid; background:#ccc; }

        .alignment{
            margin:auto;
            background-color: lightgrey;
            width: 320px;
            border: 10px solid grey;
            padding: 10px;
        }

        .button {
            background-color: #499249;
            border: none;
            color: whitesmoke;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 2px 1px;
            cursor: pointer;
        }

        #canvas{
            display: none;
        }
    </style>

    <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('css/bootstrap.css') }}"></script>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script>

</script>
</head>
<body>
<div class=row-fluid">
    <h1 align="center"><u>Upload a Photo</u></h1>
</div>
<div style="margin-top:5px; margin-bottom:20px;"></div>


<div id="my_photo_booth">


    <div  class="alignment" id="my_camera">
        <canvas id="myCanvas" width="360" height="480" style="border:1px solid #000000;">
            <script type="text/javascript" src="{{ URL::asset('js/webcam.js') }}">

                var canvas = document.getElementById('myCanvas');
                var context = canvas.getContext('2d');
            </script>
        </canvas>
    </div>

    <script language="JavaScript">
        Webcam.set({
            // live preview size
            width: 320,
            height: 240,

            // device capture size
            dest_width: 640,
            dest_height: 480,

            // final cropped size
            crop_width: 360,
            crop_height: 480,

            // format and quality
            image_format: 'jpeg',
            jpeg_quality: 90,

            // flip horizontal (mirror mode)
            flip_horiz: true
        });
        Webcam.attach( '#my_camera' );
    </script>
</div>


    <!-- A button for taking snaps -->

        <div id="pre_take_buttons" align="center">
            <!-- This button is shown before the user takes a snapshot -->
            <input type=button class="button" value="Take Snapshot" onClick="preview_snapshot()">
        </div>
        <div id="post_take_buttons" style="display:none" align="center">

            <!-- These buttons are shown after a snapshot is taken -->
<table align="center">
    <tr>
        <td>
            <input type=button class="button" value="Take Another" onClick="cancel_preview()">
        </td>


            <form action="{{ URL::Route('save_photo') }}" method="post" onsubmit="save_photo()">
                <input type="hidden" id="image" name="image" value="" />
                <input type="hidden" id="sc_number" name="sc_number" value="" />
                <td>
            <input type=submit  id="upload"  class="button"  value="Save Photo" style="font-weight:bold;">
                </td>
            </form>

    </tr>
</table>
        </div>



<div id="results" style="display:none">
    <!-- Your captured image will appear here... -->
</div>

<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'js/shutter.ogg' : 'js/shutter.mp3';

    function preview_snapshot() {
        // play sound effect
        try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
        shutter.play();

        // freeze camera so user can preview current frame
        Webcam.freeze();

        // swap button sets
        document.getElementById('pre_take_buttons').style.display = 'none';
        document.getElementById('post_take_buttons').style.display = '';
    }

    function cancel_preview() {
        // cancel preview freeze and return to live camera view
        Webcam.unfreeze();

        // swap buttons back to first set
        document.getElementById('pre_take_buttons').style.display = '';
        document.getElementById('post_take_buttons').style.display = 'none';
    }

    function save_photo() {
        // actually snap photo (from preview freeze) and display it
        Webcam.snap( function(data_uri) {
            // display results in page
//            document.getElementById('results').innerHTML =
//
//                '<img src="'+data_uri+'"/><br/></br>';
//
//            // shut down camera, stop capturing

            Webcam.unfreeze();

            // show results, hide photo booth
            // document.getElementById('results').style.display = '';
            //document.getElementById('pre_take_buttons').style.display = '';
            //document.getElementById('my_photo_booth').style.display = '';
            //document.getElementById('post_take_buttons').style.display = 'none';

            document.getElementById('image').value=data_uri;
            document.getElementById('sc_number').value='{{Input::get('sc_number')}}';
        } );

    }

    {{--$('#upload').on('click', function(){--}}

        {{--// actually snap photo (from preview freeze) and display it--}}
        {{--Webcam.snap( function(data_uri) {--}}
            {{--// display results in page--}}



            {{--//sendAvatar(data_uri);--}}


            {{--Webcam.unfreeze();--}}

            {{--// show results, hide photo booth--}}


            {{--document.getElementById('pre_take_buttons').style.display = '';--}}
            {{--document.getElementById('my_photo_booth').style.display = '';--}}
            {{--document.getElementById('post_take_buttons').style.display = 'none';--}}

        {{--} );--}}


{{--//        var dataURL = canvas.toDataURL();--}}
{{--//        sendAvatar(dataURL);--}}

    {{--});--}}

    {{--function sendAvatar(dataURL){--}}
        {{--document.getElementById('results').innerHTML =--}}

            {{--'<img src="'+dataURL+'"/><br/></br>';--}}

        {{--document.getElementById('results').style.display = '';--}}

{{--//        -----------------------------------------------------------------------------}}



        {{--var url = '{{ URL::to('save_photo') }}';--}}
        {{--var url = '{{ URL::Route('save_photo') }}';--}}
        {{--var token = '{!! csrf_token() !!}';--}}
        {{--$.ajax({--}}
            {{--method: 'POST',--}}
            {{--url: 'save_photo',--}}
            {{--data: {_token:token, img: dataURL},--}}
            {{--success: function(){--}}
                {{--alert(dataURL);--}}
            {{--}--}}

        {{--});--}}

    {{--}--}}


</script>
</body>
</html>