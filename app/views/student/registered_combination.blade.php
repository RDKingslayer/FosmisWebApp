@extends('layouts.dashboard')

@section('sidebar')
    <br>
    <li>
        <span class="subtopic">Course</span>
    </li>

    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>View Attendence</a></ul>
    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>Register Courses</a></ul>
    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>View Examination Eligibility</a></ul>

    <br>
    <li>
        <span class="subtopic">Examination</span>
    </li>

    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>View Results/GPA</a></ul>
    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>Register Examination</a></ul>

    <br>
    <li>
        <span class="subtopic">Degree Requirements</span>
    </li>

    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>View Requirements</a></ul>
    <ul><i class="icon-list icon-black"></i> &nbsp;<a href=#>Degree Status</a></ul>
@stop

@section('content')
    <div class="well span8">

        <legend>Selected Combinations</legend>

        <div class="row-fluid">

            <div class="row-fluid">

                <!--<div class="span4">-->
                <?php
                $s=Auth::user()->user;

                $b = Student::where('student_id','=',$s)->first();
                $c=$b->stream_id;

                ?>

            <form class="form-horizontal" method="get" action="{{ URL::Route('EditCombinationRegistration') }}" enctype="multipart/form-data">
                <table align="center" class="table" style="width: auto !important;">
                        <tr class="info">
                            <td width="250px">
                                Choice 1
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td width="250px">
                                {{$ch1->description}}
                            </td>
                        </tr>
                        <tr class="info">
                            <td width="250px">
                                Choice 2
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td width="250px">
                                {{$ch2->description}}
                            </td>
                        </tr>
                    </table>

                <div class="row-fluid" style ="margin-left: 45px ; width: auto !important;">

                    <table class="table" align="center" style="width: auto !important;">
                        <tr class="alert-danger">
                            <td>
                                <button type="submit" style="float: right;" class="btn btn-primary">Edit</button>
                            </td>
                        </tr>
                    </table>

                </div>

            </form>
        </div>

    </div>

        <div class="row-fluid">
            <h5 style="text-align:center">Subjects & Codes </h5>

            @if($c=='BS')
                <table class="table" align="center" style="width: auto !important;">
                    @foreach($bs_subject_table as $row)
                        <tr class="info">
                            <td width="250px">
                                {{ $row->short_form }}
                            </td>
                            <td width="50">:</td>
                            <td  width="250px">
                                {{ $row->subject_name }}
                            </td>
                        </tr>
                    @endforeach
                </table>

            @elseif($c=='PS')
                <table class="table" align="center" style="width: auto !important;">
                    @foreach($ps_subject_table as $row)
                        <tr class="info">
                            <td width="250px">
                                {{ $row->short_form }}
                            </td>
                            <td width="50">:</td>
                            <td  width="250px">
                                {{ $row->subject_name }}
                            </td>
                        </tr>
                    @endforeach
                </table>

            @endif

        </div>
    </div>
@endsection