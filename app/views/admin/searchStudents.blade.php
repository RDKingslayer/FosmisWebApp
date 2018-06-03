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

        #stu_table_filter
        {
            display: none;
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
            $("#stu_table").dataTable().$('tr', {"filter":"applied"});

            $("#stu_id").on('keyup change',function(){

                table.column(0).search(this.value).draw();
            });

            $("#stu_name").on('keyup change',function(){

                table.column(1).search(this.value).draw();
            });

        });

    </script>
@stop

@section('content')
    <div class="well span9">

        <legend>Search Students</legend>
        {{Form::open(array('id'=>'frmstudentsearch','route'=>'search_students'))}}
        <div class="row-fluid">

            <div class="span3">

                {{Form::label('stu_id','Search By ID')}}
                {{Form::text('stu_id','',array('id'=>'stu_id','placeholder'=>'Search'))}}
            </div>
            <div class="offset1 span3">
                {{Form::label('stu_name','Search By Name')}}
                {{Form::text('stu_name','',array('id'=>'stu_name','placeholder'=>'Search'))}}
            </div>
            <div class="offset1 span3">

            </div>
        </div>


        <hr style="border-top:5px double #e3e3e3"></hr>

        <div id="students_table" class="row fluid">

            <table id="stu_table" class="display">
                <thead>
                <tr>
                    <th>Permanent Number</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                </tr>
                </thead>

                @foreach($students as $student)

                    <tr>
                        <td>{{$student['student_id']}}</td>
                        <td>{{$student['initials'] .' '. $student['last_name'] }}</td>
                        <td>{{$student['gender']}}</td>
                    </tr>

                @endforeach


            </table>
        </div>


    </div>
    </div>

    {{Form::close()}}
@stop