@extends('layouts.dashboard')

@section('content')
    <div class="well span8">

        <legend>Combination Registration</legend>

        <div class="row-fluid">

            <!--<div class="span4">-->
            <?php
            $s=Auth::user()->user;

            $b = Student::where('student_id','=',$s)->first();
            $c=$b->stream_id;

            $d = Stream::where('stream_id','=',$c)->first();
            $ps1 = combination::where('combination_id','=','PS1')->first();
            $ps2 = combination::where('combination_id','=','PS2')->first();
            $ps3 = combination::where('combination_id','=','PS3')->first();
            $ps4 = combination::where('combination_id','=','PS4')->first();
            $ps5 = combination::where('combination_id','=','PS5')->first();
            $ps6 = combination::where('combination_id','=','PS6')->first();
            $ps7 = combination::where('combination_id','=','PS7')->first();
            $ps8 = combination::where('combination_id','=','PS8')->first();
            $bs1 = combination::where('combination_id','=','BS1')->first();
            $bs2 = combination::where('combination_id','=','BS2')->first();
            $bs3 = combination::where('combination_id','=','BS3')->first();
            $bs4 = combination::where('combination_id','=','BS4')->first();

            ?>

            <h5>Stream name  -{{ $d->stream_name}} </h5>
            @if(Session::has('CombinationErrorMessage1'))
                {{--<div class="alert alert-success">--}}
                {{--{{ Session::get('message') }}--}}
                {{--</div>--}}

                <script type="text/javascript">
                    $(window).on('load',function(){
                        $('#myModal').modal('show');
                    });
                </script>

            @endif

            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Alert</h3>
                </div>
                <div class="modal-body">
                    {{ Session::get('CombinationErrorMessage1') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>

                {{Session::forget('CombinationErrorMessage1')}}
            </div>
            @if($c=='BS')
                <form class="form-horizontal" method="post" action="{{ URL::Route('SubmitStudentCourseRegistration') }}" enctype="multipart/form-data">
                    <table align="center" class="table" style="width: auto !important;">
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Student ID')}}
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td>
                                <input type="text" style="text-align: right" value="{{$s}}" name="student_id" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Choice 1')}}
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td>
                                {{Form::select('choice_1',['Select combination ',$bs1->combination_id => $bs1->description,$bs2->combination_id => $bs2->description,$bs3->combination_id => $bs3->description,$bs4->combination_id => $bs4->description])}}
                            </td>
                        </tr>
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Choice 2')}}
                            </td >
                            <td width="50px">
                                :
                            </td>
                            <td>
                                {{Form::select('choice_2',['Select combination ',$bs1->combination_id => $bs1->description,$bs2->combination_id => $bs2->description,$bs3->combination_id => $bs3->description,$bs4->combination_id => $bs4->description])}}
                            </td>
                        </tr>


                        <tr>
                        </tr>
                        <tr>
                        </tr>
                    </table>

                    <div class="row-fluid" style ="margin-left: 45px ; width: auto !important;">

                        <table class="table" align="center" style="width: auto !important;">
                            <tr class="alert-danger">
                                <td>
                                    <button type="submit" style="float: right;" class="btn btn-primary">Submit</button>
                                </td>
                            </tr>
                        </table>

                    </div>
                </form>



            @elseif($c=='PS')
                <form class="form-horizontal" method="post" action="{{ URL::Route('SubmitStudentCourseRegistration') }}" enctype="multipart/form-data">
                    <table align="center" class="table" style="width: auto !important;">
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Student ID')}}
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td>
                                <input type="text" style="text-align: right" value="{{$s}}" name="student_id" readonly>
                            </td>

                        </tr>
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Choice 1')}}
                            </td>
                            <td width="50px">
                                :
                            </td>
                            <td>
                                {{Form::select('choice_1',['Select combination ',$ps1->combination_id => $ps1->description,$ps2->combination_id => $ps2->description,$ps3->combination_id => $ps3->description,$ps4->combination_id => $ps4->description,$ps5->combination_id => $ps5->description,$ps6->combination_id => $ps6->description,$ps7->combination_id => $ps7->description,$ps8->combination_id => $ps8->description] )}}
                            </td>
                        </tr>
                        <tr>
                            <td width="250px">
                                {{Form::label('cstype','Choice 2')}}
                            </td >
                            <td width="50px">
                                :
                            </td>
                            <td>
                                {{Form::select('choice_2',['Select combination ',$ps1->combination_id => $ps1->description,$ps2->combination_id => $ps2->description,$ps3->combination_id => $ps3->description,$ps4->combination_id => $ps4->description,$ps5->combination_id => $ps5->description,$ps6->combination_id => $ps6->description,$ps7->combination_id => $ps7->description,$ps8->combination_id => $ps8->description])}}
                            </td>
                        </tr>


                        <tr>
                        </tr>
                        <tr>
                        </tr>
                    </table>


                    <div class="row-fluid" style ="margin-left: 45px ; width: auto !important;">

                        <table class="table" align="center" style="width: auto !important;">
                            <tr class="alert-danger">
                                <td>
                                    <button type="submit" style="float: right;" class="btn btn-primary">Submit</button>
                                </td>
                            </tr>
                        </table>

                    </div>

                </form>



                <!--</div>-->
            @endif


        </div>
        <div class="row-fluid">
            <h5>Course Description :</h5>

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