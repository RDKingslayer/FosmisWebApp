
@extends('layouts.dashboard')

@section('css')
    <style>
        .modal-body{
            height: 250px;
            overflow-y: auto;
        }
    </style>

    <style>

        ul.pagination {

            list-style: none;
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: #333 !important;
            border: 1px solid transparent;

        }
        ul.pagination li {
            float: left;
            padding-left: 15px;
        }

        ul.pagination a {

        }

    </style>

    @stop
@section('js')

    <script>

        //Script for Single User Registration
        $(document).on("click", ".open-registerDialog", function () {


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
            var district = $(this).data('district');
            var divisional_secretariat = $(this).data('divisional_secretariat');
            var grama_niladari_division = $(this).data('grama_niladari_division');
            var z_score = $(this).data('z_score');
            var nic = $(this).data('nic');
            var telephone_number_home = $(this).data('telephone_number_home');
            var selection_method = $(this).data('selection_method');
            var mother_name = $(this).data('mother_name');
            var mother_occupation = $(this).data('mother_occupation');
            var father_name = $(this).data('father_name');
            var father_occupation = $(this).data('father_occupation');
            var guardian_contact_no = $(this).data('guardian_contact_no');
            var informer_contact_no = $(this).data('informer_contact_no');
            var school = $(this).data('school');
            var village = $(this).data('village');
            var race = $(this).data('race');
            var date_of_registration = $(this).data('date_of_registration');




//            var al_batch = $(this).data('al_batch');
//            var current_batch = $(this).data('current_batch');
//            var status = $(this).data('status');
//            var degree_id = $(this).data('degree_id');
//            var combination_id = $(this).data('combination_id');

            $(".modal-body #modal_s_no").html('&nbsp' +s_no );
            $(".modal-body #modal_ssid").html('&nbsp' +ssid );
            $(".modal-body #modal_course_of_study").html('&nbsp' +course_of_study );
            $(".modal-body #modal_index_number_al").html('&nbsp' +index_number_al );
            $(".modal-body #modal_temporary_number").html('&nbsp' +temporary_number );
            $(".modal-body #modal_permanent_number").html('&nbsp' +permanent_number );
            //$(".modal-body #modal_student_id").html('&nbspSC' +id );
            $(".modal-body #modal_name_with_initials").html('&nbsp' +initials + '&nbsp' + last_name );
            $(".modal-body #modal_full_name").html('&nbsp' +full_name );
            //$(".modal-body #modal_date_of_birth").html('&nbsp' +dob );
            $(".modal-body #modal_permanent_address").html('&nbsp' + add1 + '&nbsp,' + add2 + '&nbsp,' + add3 + '&nbsp,' + add4);
            $(".modal-body #modal_email").html('&nbsp' +email );
            $(".modal-body #modal_gender").html('&nbsp' +gender );
            $(".modal-body #modal_province").html('&nbsp' +province );
            $(".modal-body #modal_distric").html('&nbsp' +distric );
            $(".modal-body #modal_district").html('&nbsp' +district );
            $(".modal-body #modal_divisional_secretariat").html('&nbsp' +divisional_secretariat );
            $(".modal-body #modal_grama_niladari_division").html('&nbsp' +grama_niladari_division );
            $(".modal-body #modal_z_score").html('&nbsp' +z_score );
            $(".modal-body #modal_nic").html('&nbsp' +nic );
            $(".modal-body #modal_telephone_number_home").html('&nbsp' +telephone_number_home );
            $(".modal-body #modal_selection_method").html('&nbsp' +selection_method );
            $(".modal-body #modal_mother_name").html('&nbsp' +mother_name );
            $(".modal-body #modal_mother_occupation").html('&nbsp' +mother_occupation );
            $(".modal-body #modal_father_name").html('&nbsp' +father_name );
            $(".modal-body #modal_father_occupation").html('&nbsp' +father_occupation );
            $(".modal-body #modal_guardian_contact_no").html('&nbsp' +guardian_contact_no );
            $(".modal-body #modal_informer_contact_no").html('&nbsp' +informer_contact_no );
            $(".modal-body #modal_school").html('&nbsp' +school );
            $(".modal-body #modal_village").html('&nbsp' +village );
            $(".modal-body #modal_race").html('&nbsp' +race );
            $(".modal-body #modal_date_of_registration").html('&nbsp' +date_of_registration );





//            $(".modal-body #modal_al_batch").html('&nbsp'+al_batch);
//            $(".modal-body #modal_current_batch").html('&nbsp'+current_batch);
//            $(".modal-body #modal_status").html('&nbsp'+status);
//            $(".modal-body #modal_degree_id").html('&nbsp'+degree_id);
//            $(".modal-body #modal_combination_id").html('&nbsp'+combination_id);

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




<div class="well span8">
    <legend>Register Students</legend>



    <form class="form-horizontal" method="post" action="{{ URL::Route('parse_csv') }}" enctype="multipart/form-data">


        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">

            <div class="row-fluid" style ="margin-left: 45px;" >
                <div class="span4">
                    <label class="control-labelme" >Select the Student CSV File</label>
                </div>
                <div class="span4 row-fluid">
                    <input id="csv_file" type="file" class="form-control" name="csv_file" accept=".csv" required>
                    @if ($errors->has('csv_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('csv_file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


                <div class="row-fluid" style ="margin-left: 45px;">
                    <div class="span4"></div>
                    <div class="span4 row-fluid">
                        <label>CSV file must contain a header row</label>
                    </div>

                </div>



                <div class="row-fluid" style ="margin-left: 45px;">
                    <div class="span4"></div>
                    <div class="span4 row-fluid">
                        <button type="submit" class="btn btn-primary">Add Data from File</button>
                    </div>

                </div>
        </div>
    </form>

    <hr>
    <div class="row-fluid" style ="margin-left: 45px;">
        <div class="span4">
            <label id="rrw" class="control-labelme">Register a Student</label>
        </div>
        <div class="span4 row-fluid" >
            {{--<a data-toggle="modal" data-target="#registerDialog" class="btn btn-danger"  id="registerStu" href="#registerDialog">Register Here</a>--}}
            <a class="btn btn-danger" href="{{ URL::Route('register_a_student')}}">Register Here</a>


        </div>
    </div>

    <hr>

            <div class="row-fluid" style ="margin-left: 45px;">
                <div class="span4"></div>
                <div class="span4 row-fluid" >
                    <a class="btn btn-navbar" href="{{  URL::Route('showTable') }}">Show Table</a>
                </div>
            </div>








    @if(isset($added))
        @if($added == false)
            <div class="alert alert-warning">No new data were added</div>
        @else
            <div class="alert alert-success">New data were added</div>
        @endif
    @endif





    @if(isset($table))

        <div class="row-fluid">
            <table class="table table-striped" id="dbdata">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($table as $row)
                    <tr>
                        <td> <a data-toggle="modal" data-target="#infoDialog" class="open-infoDialog" href="#infoDialog"
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
                                data-district="{{ $row->district }}"
                                data-divisional_secretariat="{{ $row->divisional_secretariat }}"
                                data-grama_niladari_division="{{ $row->grama_niladari_division }}"
                                data-z_score="{{ $row->z_score }}"
                                data-nic="{{ $row->nic }}"
                                data-telephone_number_home="{{ $row->telephone_number_home }}"
                                data-selection_method="{{ $row->selection_method }}"
                                data-mother_name="{{ $row->mother_name }}"
                                data-mother_occupation="{{ $row->mother_occupation }}"
                                data-father_name="{{ $row->father_name }}"
                                data-father_occupation="{{ $row->father_occupation }}"
                                data-guardian_contact_no="{{ $row->guardian_contact_no }}"
                                data-informer_contact_no="{{ $row->informer_contact_no }}"
                                data-school="{{ $row->school }}"
                                data-village="{{ $row->village }}"
                                data-race="{{ $row->race }}"
                                data-date_of_registration="{{ $row->date_of_registration }}"


                                    {{--data-al_batch="{{ $row->al_batch }}"--}}
                                    {{--data-current_batch="{{ $row->current_batch }}"--}}
                                    {{--data-status="{{ $row->status }}"--}}
                                    {{--data-degree_id="{{ $row->degree_id }}"--}}
                                    {{--data-combination_id="{{ $row->combination_id }}"--}}
                            >{{ $row->student_id }}</a></td>

                        <td>{{ $row->initials." ".$row->last_name }}</td>
                        {{--<td>{{ $row->current_batch }}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>



            <div class="modal fade bd-example-modal-lg" id="infoDialog" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <td>District</td>
                            <td> :</td>
                            <td><div id="modal_district"></div></td>
                        </tr>
                        <tr>
                            <td>Divisional Secretariat</td>
                            <td> :</td>
                            <td><div id="modal_divisional_secretariat"></div></td>
                        </tr>
                        <tr>
                            <td>Grama niladari division</td>
                            <td> :</td>
                            <td><div id="modal_grama_niladari_division"></div></td>
                        </tr>
                        <tr>
                            <td>Z Score</td>
                            <td> :</td>
                            <td><div id="modal_z_score"></div></td>
                        </tr>
                        <tr>
                            <td>Nic</td>
                            <td> :</td>
                            <td><div id="modal_nic"></div></td>
                        </tr>
                        <tr>
                            <td>Telephone Number Home</td>
                            <td> :</td>
                            <td><div id="modal_telephone_number_home"></div></td>
                        </tr>
                        <tr>
                            <td>Selection Method</td>
                            <td> :</td>
                            <td><div id="modal_selection_method"></div></td>
                        </tr>
                        <tr>
                            <td>Mother's name</td>
                            <td> :</td>
                            <td><div id="modal_mother_name"></div></td>
                        </tr>
                        <tr>
                            <td>Mother's occupation</td>
                            <td> :</td>
                            <td><div id="modal_mother_occupation"></div></td>
                        </tr>
                        <tr>
                            <td>Father's name</td>
                            <td> :</td>
                            <td><div id="modal_father_name"></div></td>
                        </tr>
                        <tr>
                            <td>Father's occupation</td>
                            <td> :</td>
                            <td><div id="modal_father_occupation"></div></td>
                        </tr>
                        <tr>
                            <td>Guardian's contact number</td>
                            <td> :</td>
                            <td><div id="modal_guardian_contact_no"></div></td>
                        </tr>
                        <tr>
                            <td>Informer's contact number</td>
                            <td> :</td>
                            <td><div id="modal_informer_contact_no"></div></td>
                        </tr>
                        <tr>
                            <td>School</td>
                            <td> :</td>
                            <td><div id="modal_school"></div></td>
                        </tr>
                        <tr>
                            <td>Village</td>
                            <td> :</td>
                            <td><div id="modal_village"></div></td>
                        </tr>
                        <tr>
                            <td>Race</td>
                            <td> :</td>
                            <td><div id="modal_race"></div></td>
                        </tr>
                        <tr>
                            <td>Date of Registration</td>
                            <td> :</td>
                            <td><div id="modal_date_of_registration"></div></td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>A/L Batch</td>--}}
                            {{--<td> :</td>--}}
                            {{--<td><div id="email"></div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Current Batch</td>--}}
                            {{--<td> :</td>--}}
                            {{--<td><div id="modal_current_batch"></div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Status</td>--}}
                            {{--<td> :</td>--}}
                            {{--<td><div id="modal_status"></div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Degree ID</td>--}}
                            {{--<td> :</td>--}}
                            {{--<td><div id="modal_degree_id"></div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Combination ID</td>--}}
                            {{--<td> :</td>--}}
                            {{--<td><div id="modal_combination_id"></div></td>--}}
                        {{--</tr>--}}

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
                </div>
            </div>

        </div>

        @if(!isset($added))
            {{ $table->links() }}
        @endif

    @endif
</div>
<!--<div class="modal fade" id="registerDialog" tabindex="-1" role="dialog">
    <form class="form-horizontal" method="post" action="{{ URL::Route('register_a_student') }}" enctype="multipart/form-data">

        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Register Student</h3>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>Student ID</td>
                    <td> :</td>
                    <td><input type="text" id="stu_id"/></td>
                </tr>
                <tr>
                    <td>Initials</td>
                    <td> :</td>
                    <td><input type="text" id="stu_initials"/></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td> :</td>
                    <td><input type="text" id="stu_last_name"/></td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td> :</td>
                    <td><input type="text" id="stu_full_name"/></td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td> :</td>
                    <td><input type="text" id="stu_dob"/></td>
                </tr>
                <tr>
                    <td>Permanent Address</td>
                    <td> :</td>
                    <td><input type="text" id="stu_address_line1"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td> :</td>
                    <td><input type="text" id="stu_address_line2"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td> :</td>
                    <td><input type="text" id="stu_address_line3"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td> :</td>
                    <td><input type="text" id="stu_address_line4"/></td>
                </tr>
                <tr>
                    <td>A/L Batch</td>
                    <td> :</td>
                    <td><input type="text" id="stu_al_batch"/></td>
                </tr>
                <tr>
                    <td>Current Batch</td>
                    <td> :</td>
                    <td><input type="text" id="stu_current_batch"/></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td> :</td>
                    <td><input type="text" id="stu_status"/></td>
                </tr>
                <tr>
                    <td>Degree ID</td>
                    <td> :</td>
                    <td><input type="text" id="stu_degree_id"/></td>
                </tr>
                <tr>
                    <td>Combination ID</td>
                    <td> :</td>
                    <td><input type="text" id="stu_combination_id"/></td>
                </tr>

            </table>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default" >Submit</button>
        </div>
    </form>
</div>
-->
@stop

