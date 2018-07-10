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
    </script>

@stop



@section('content')

    <div class="well span8">
            <legend>Assign Permanent Id's</legend>

        <form method="post" action="{{ URL::Route('assign_pid_single') }}">

            <div class="row-fluid"></div>


            <hr style="border-top:5px double #e3e3e3"></hr>

            <div id="students_table" class="row fluid">

                <table id="stu_table" class="display ">
                    <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>Student Name</th>
                        <th>Permanent ID number</th>
                    </tr>
                    </thead>

                    @if(isset($students_table))
                        @foreach($students_table as $row)

                            <tr>
                                <td>{{$row['student_id']}}</td>
                                <td>{{$row['initials'] .' '. $row['last_name'] }}</td>
                                <td align="center"><input type="text" name="ggg"></td>
                            </tr>

                        @endforeach
                    @endif

                </table>
            </div>
            <div class="offset9 span3">

                <br>            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{--@if($students_table != null)--}}
                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                {{--@endif--}}

            </div>

        </form>

            <!--<table>
                <form action="{{ URL::Route('assign_pid_single') }}" method="post">
                        <table cellpadding="5px">

                            @if($errors->has('TemporaryID'))
                                <tr>
                                    <label  for="s_no">
                                        <td></td>
                                        <td></td>
                                        <td style="color: red">
                                            {{$errors->first('TemporaryID')}}
                                        </td>
                                    </label>
                                </tr>
                            @endif

                            <tr>
                            <td><label>Insert Temporary ID </label></td>
                            <td>  </td>
                            <td><input type="text" name="TemporaryID" required="" value="{{ Input::old('TemporaryID') }}" ></td>
                            </tr>

                            <tr>
                            <td><label>Insert Permanent ID </label></td>
                            <td>  </td>
                            <td><input type="text" name="PermanentID" required=""></td>
                            </tr>

                            <tr>    
                            <td></td>
                            <td></td>
                            <td align="right"><button  type="submit" class="btn btn-primary">Submit</button></td>
            
                            </tr>
                        </table>

                </form>    
            </table>-->


    </div>
@stop

@section('footer')

@stop 