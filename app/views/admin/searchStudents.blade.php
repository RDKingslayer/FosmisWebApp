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

    <script>
        //Script for Modal View
        $(document).on("click", ".open-infoDialog", function () {
            var s_no = $(this).data('s_no');
            var ssid = $(this).data('ssid');
            var course_of_study=$(this).data('course_of_study');
            var index_number_al=$(this).data('index_number_al');
            var temporary_number=$(this).data('temporary_number');
            var permanent_number=$(this).data('permanent_number');
            //var id = $(this).data('id');
            var initials = $(this).data('initials');
            var last_name = $(this).data('last_name');
            var full_name = $(this).data('full_name');
            //var dob = $(this).data('dob');
            var add1 = $(this).data('add1');
            var add2 = $(this).data('add2');
            var add3 = $(this).data('add3');
            var add4 = $(this).data('add4');
            var email = $(this).data('email');
            var gender = $(this).data('gender');
            var province = $(this).data('province');
            var distric = $(this).data('distric');
            var al_batch = $(this).data('al_batch');
            var current_batch = $(this).data('current_batch');
            var status = $(this).data('status');
            var degree_id = $(this).data('degree_id');
            var combination_id = $(this).data('combination_id');

            $(".modal-body #modal_s_no").html('&nbsp' +s_no );
            $(".modal-body #modal_ssid").html('&nbsp' +ssid );
            $(".modal-body #modal_course_of_study").html('&nbsp' +course_of_study );
            $(".modal-body #modal_index_number_al").html('&nbsp' +index_number_al );
            $(".modal-body #modal_temporary_number").html('&nbsp' +temporary_number );
            $(".modal-body #modal_permanent_number").html('&nbspSC' +permanent_number );
            //$(".modal-body #modal_student_id").html('&nbspSC' +id );
            $(".modal-body #modal_name_with_initials").html('&nbsp' +initials + '&nbsp' + last_name );
            $(".modal-body #modal_full_name").html('&nbsp' +full_name );
            //$(".modal-body #modal_date_of_birth").html('&nbsp' +dob );
            $(".modal-body #modal_permanent_address").html('&nbsp' + add1 + '&nbsp,' + add2 + '&nbsp,' + add3 + '&nbsp,' + add4);
            $(".modal-body #modal_email").html('&nbsp' +email );
            $(".modal-body #modal_gender").html('&nbsp' +gender );
            $(".modal-body #modal_province").html('&nbsp' +province );
            $(".modal-body #modal_distric").html('&nbsp' +distric );
            $(".modal-body #modal_al_batch").html('&nbsp'+al_batch);
            $(".modal-body #modal_current_batch").html('&nbsp'+current_batch);
            $(".modal-body #modal_status").html('&nbsp'+status);
            $(".modal-body #modal_degree_id").html('&nbsp'+degree_id);
            $(".modal-body #modal_combination_id").html('&nbsp'+combination_id);

        });



    </script>
@stop

@section('sidebar')
<li>
    <span class="subtopic">Student Registration</span>
</li>

<ul><i class="icon-list icon-black"></i> &nbsp<a href="{{ URL::Route('register-students')}}">Register Students</a></ul>
<ul><i class="icon-list icon-black"></i> &nbsp<a href="{{ URL::Route('search_students')}}">Search Students</a></ul>

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

                @foreach($students as $row)

                    <tr>
                        <td><a data-toggle="modal" data-target="#infoDialog" class="open-infoDialog" href="#infoDialog"
                               data-s_no="{{$row->s_no}}"
                               data-ssid="{{$row->ssid}}"
                               data-course_of_study="{{$row->course_of_study}}"
                               data-index_number_al="{{$row->index_number_al}}"
                               data-temporary_number="{{$row->temporary_number}}"
                               data-permanent_number="{{$row->permanent_number}}"
                               {{--data-id="{{ $row->student_id }}"--}}
                               data-initials="{{ $row->initials }}"
                               data-last_name="{{ $row->last_name }}"
                               data-full_name="{{ $row->name_in_full }}"
                               {{--data-dob="{{ $row->dob }}"--}}
                               data-add1="{{ htmlspecialchars($row->permanent_address_line1) }}"
                               data-add2="{{ $row->permanent_address_line2 }}"
                               data-add3="{{ $row->permanent_address_line3 }}"
                               data-add4="{{ $row->permanent_address_line4 }}"
                               data-email="{{ $row->email }}"
                               data-gender="{{ $row->gender }}"
                               data-province="{{ $row->province }}"
                               data-distric="{{ $row->distric }}"
                               data-al_batch="{{ $row->al_batch }}"
                               data-current_batch="{{ $row->current_batch }}"
                               data-status="{{ $row->status }}"
                               data-degree_id="{{ $row->degree_id }}"
                               data-combination_id="{{ $row->combination_id }}"
                            >{{$row['student_id']}}</a></td>
                        <td>{{$row['initials'] .' '. $row['last_name'] }}</td>
                        <td>{{$row['gender']}}</td>
                    </tr>

                @endforeach


            </table>
        </div>


    </div>
    </div>

    {{Form::close()}}

    <div class="modal fade" id="infoDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">×</button>
                    <h3>Student Information</h3>
                </div>

                <div class="modal-body">

                    <table>
                        <tr>
                            <td>S_No</td>
                            <td> :</td>
                            <td><div id="modal_s_no"></div></td>
                        </tr>
                        <tr>
                            <td>SSID</td>
                            <td> :</td>
                            <td><div id="modal_ssid"></div></td>
                        </tr>
                        <tr>
                            <td>Course of study</td>
                            <td> :</td>
                            <td><div id="modal_course_of_study"></div></td>
                        </tr>
                        <tr>
                            <td>AL Index Number</td>
                            <td> :</td>
                            <td><div id="modal_index_number_al"></div></td>
                        </tr>
                        <tr>
                            <td>Temporary Number</td>
                            <td> :</td>
                            <td><div id="modal_temporary_number"></div></td>
                        </tr>
                        <tr>
                            <td>Permanent Nuumber</td>
                            <td> :</td>
                            <td><div id="modal_permanent_number"></div></td>
                        </tr>
                        {{--<tr>--}}
                        {{--<td>Student ID</td>--}}
                        {{--<td> :</td>--}}
                        {{--<td><div id="modal_student_id"></div></td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>Name with Initials</td>
                            <td> :</td>
                            <td><div id="modal_name_with_initials"></div></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td> :</td>
                            <td><div id="modal_full_name"></div></td>
                        </tr>
                        {{--<tr>--}}
                        {{--<td>Date Of Birth</td>--}}
                        {{--<td> :</td>--}}
                        {{--<td><div id="modal_date_of_birth"></div></td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>Permanent Address</td>
                            <td> :</td>
                            <td><div id="modal_permanent_address"></div></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> :</td>
                            <td><div id="modal_email"></div></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td> :</td>
                            <td><div id="modal_gender"></div></td>
                        </tr>
                        <tr>
                            <td>Province</td>
                            <td> :</td>
                            <td><div id="modal_province"></div></td>
                        </tr>
                        <tr>
                            <td>District Number</td>
                            <td> :</td>
                            <td><div id="modal_distric"></div></td>
                        </tr>
                        <tr>
                            <td>A/L Batch</td>
                            <td> :</td>
                            <td><div id="email"></div></td>
                        </tr>
                        <tr>
                            <td>Current Batch</td>
                            <td> :</td>
                            <td><div id="modal_current_batch"></div></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> :</td>
                            <td><div id="modal_status"></div></td>
                        </tr>
                        <tr>
                            <td>Degree ID</td>
                            <td> :</td>
                            <td><div id="modal_degree_id"></div></td>
                        </tr>
                        <tr>
                            <td>Combination ID</td>
                            <td> :</td>
                            <td><div id="modal_combination_id"></div></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@stop