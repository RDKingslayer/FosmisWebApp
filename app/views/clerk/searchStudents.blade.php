@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="/css/redmond/jquery-ui-1.10.3.custom.css" />
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <style type="text/css">
        legend
        {
            font-size: 16px;
            font-weight: bold;
        }

        #frmstudentsearch label
        {
            font-weight: bold;
        }

        #students_table
        {

            margin-left: 0%;
        }

        #stu_table
        {
            width: 100%;
        }



        #stu_table td
        {
            white-space: nowrap;
        }

    </style>
@stop


@section('js')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function()
        {
            var table= $('#stu_table').DataTable();


        });

        function post_submit_check()
        {
            var checkeditems=[];
            $("input:checkbox[name='checkbox[]']:checked").each(function() {
                checkeditems.push($(this).val());

            });
        }

    </script>


@stop




@section('sidebar')
    <span class="subtopic">Combination Registration</span>
    <ul> <i class="icon-list icon-black"></i>  <a href="#" data-toggle="collapse" data-target="#querybox1">&nbspPhysical Science</a></ul>


    <div id="querybox1" class="collapse">
        <ul style="margin-left:90px;">

            <li><a href="{{ URL::Route('stucom-ps1')}}">PS1</a></li>
            <li><a href="{{ URL::Route('stucom-ps2')}}">PS2</a></li>
            <li><a href="{{ URL::Route('stucom-ps3')}}">PS3</a></li>
            <li><a href="{{ URL::Route('stucom-ps4')}}">PS4</a></li>
            <li><a href="{{ URL::Route('stucom-ps5')}}">PS5</a></li>
            <li><a href="{{ URL::Route('stucom-ps6')}}">PS6</a></li>
            <li><a href="{{ URL::Route('stucom-ps7')}}">PS7</a></li>
            <li><a href="{{ URL::Route('stucom-ps8')}}">PS8</a></li>

            <br>
        </ul>
    </div>

    <ul> <i class="icon-list icon-black"></i>  <a href="#" data-toggle="collapse" data-target="#querybox2">&nbspBiological Science</a></ul>
    <br>
    <div id="querybox2" class="collapse">
        <ul style="margin-left:90px;">

            <li><a href="{{ URL::Route('stucom-bs1')}}">BS1</a></li>
            <li><a href="{{ URL::Route('stucom-bs2')}}">BS2</a></li>
            <li><a href="{{ URL::Route('stucom-bs3')}}">BS3</a></li>
            <li><a href="{{ URL::Route('stucom-bs4')}}">BS4</a></li>


            <br>
        </ul>
    </div>
@stop

@section('content')
    <div class="well span9">

        <legend>Assign Combination</legend>

        <h5>Subject Combination code - {{ $comb }}</h5>

        <form method="post" action="{{ URL::Route('search_students1') }}">
        <input type="hidden" name="comb" value=" {{ $comb }}">
        <div class="row-fluid">

        </div>


        <hr style="border-top:5px double #e3e3e3"></hr>

        <div id="students_table" class="row fluid">

            <table id="stu_table" class="display ">
                <thead>
                <tr>
                    <th> Number</th>
                    <th>Student Name</th>
                    <th>Select</th>
                </tr>
                </thead>
                @if(isset($students_combination))
                @foreach($students_combination as $row)

                    <tr>
                        <td>{{$row['student_id']}}</td>
                       <td>{{$row['initials'] .' '. $row['last_name'] }}</td>
                       <td align="center">{{Form::checkbox('checkbox[]',$row->student_id)}}</td>
                    </tr>


                @endforeach
                @endif

            </table>
        </div>
        <div class="offset9 span3">

            <br>            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @if($comb != 'NOT SELECTED')
                <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
            @endif

        </div>

        </form>

     </div>

@stop