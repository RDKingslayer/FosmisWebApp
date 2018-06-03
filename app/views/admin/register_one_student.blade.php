
@extends('layouts.dashboard')

@section('css')

    @stop

@section('js')

    @stop
@section('content')
    @if(Session::has('message'))
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
            {{ Session::get('message') }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

        {{Session::forget('message')}}
    </div>


<div class="wall span8" style="background-color: whitesmoke;color:black;padding:20px;">

    <legend>Register new Student</legend>

    <form method="post" action="{{ URL::Route('register_only_one_student') }}">
        <table align="center" style="width: 400%">

            @if($errors->has('s_no'))
                <tr>
                    <label  for="s_no">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('s_no')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>S_No</td>
                <td> :</td>
                <td><input type="text" name="s_no" id="s_no" value="{{ Input::old('s_no') }}"/></td>
            </tr>

            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('ssid'))
                <tr>
                    <label  for="ssid">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('ssid')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>SSID</td>
                <td> :</td>
                <td><input type="text" name="ssid" id="ssid" value="{{ Input::old('ssid') }}"/></td>
            </tr>

            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('course_of_study'))
                <tr>
                    <label  for="course_of_study">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('course_of_study')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Course of_Study</td>
                <td> :</td>

                <td><select name="course_of_study" id="course_of_study" value="{{ Input::old('course_of_study') }}">
                        <option value="Physical Science">Physical Science</option>
                        <option value="Biological Science">Biological Science</option>
                        <option value="Computer Science">Computer Science</option>
                    </select></td>
            </tr>


            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('index_number_al'))
                <tr>
                    <label  for="index_number_al">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('index_number_al')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>AL Index Number</td>
                <td> :</td>
                <td><input type="text" name="index_number_al" id="index_number_al" maxlength="7" value="{{ Input::old('index_number_al') }}"/></td>
            </tr>

            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('temporary_number'))
                <tr>
                    <label  for="temporary_number">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('temporary_number')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Temporary Number</td>
                <td> :</td>
                <td><input type="text" name="temporary_number" id="temporary_number" value="{{ Input::old('temporary_number') }}"/></td>
            </tr>

            {{---------------------------------------------------------------------------------------------------------}}

            {{--@if($errors->has('permanent_number'))--}}
                {{--<tr>--}}
                    {{--<label  for="permanent_number">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('permanent_number')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>Permanent Number</td>--}}
                {{--<td> :SC</td>--}}
                {{--<td><input type="text" name="permanent_number" id="permanent_number" value="{{ Input::old('permanent_number') }}"/></td>--}}
            {{--</tr>--}}

            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('student_id'))
                <tr>
                    <label  for="student_id">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('student_id')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Student ID</td>
                <td> : </td>
                <td><input type="text" name="student_id" id="student_id" maxlength="13" placeholder="sc/xxxx/XXXXX"/></td>
            </tr>
            {{-----------------------------------------------------------------------------------------------------}}

            @if($errors->has('initials'))
                <tr>
                    <label  for="initials">

                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('initials')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Initials</td>
                <td> :</td>
                <td><input type="text" name="initials" id="initials" value="{{ Input::old('initials') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('last_name'))
                <tr>
                    <label  for="last_name">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('last_name')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Last Name</td>
                <td> : </td>
                <td><input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('name_in_full'))
                <tr>
                    <label  for="name_in_full">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('name_in_full')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Full Name</td>
                <td> :</td>
                <td><input type="text" name="name_in_full" id="name_in_full" value="{{ Input::old('name_in_full') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            {{--@if($errors->has('dob'))--}}
                {{--<tr>--}}
                    {{--<label  for="dob">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('dob')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>Date Of Birth</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="date" name="dob" id="dob"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('email'))
                <tr>
                    <label  for="email">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('email')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Email</td>
                <td> :</td>
                <td><input type="email" name="email" id="email" value="{{ Input::old('email') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            <tr>
                <td>Permanent Address</td>
                <td> :</td>
                <td><input type="text" name="permanent_address_line1" id="stu_address_line1" placeholder="Address Line 1" value="{{ Input::old('permanent_address_line1') }}"/></td>
            </tr>
            <tr>
                <td></td>
                <td> :</td>
                <td><input type="text" name="permanent_address_line2" id="stu_address_line2" placeholder="Address Line 2" value="{{ Input::old('permanent_address_line2') }}"/></td>
            </tr>
            <tr>
                <td></td>
                <td> :</td>
                <td><input type="text" name="permanent_address_line3" id="stu_address_line3" placeholder="Address Line 3" value="{{ Input::old('permanent_address_line3') }}"/></td>
            </tr>
            <tr>
                <td></td>
                <td> :</td>
                <td><input type="text" name="permanent_address_line4" id="stu_address_line4" placeholder="Address Line 4" value="{{ Input::old('permanent_address_line4') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('gender'))
                <tr>
                    <label  for="gender">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('gender')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Gender</td>
                <td> :</td>
                <td>
                    <table>
                        <tr>
                            <td><input type="radio" name="gender" value="male" id="gender" checked> MALE</td>
                            <td>     </td>
                            <td><input type="radio" name="gender" value="female" id="gender"> FEMALE</td>
                        </tr>
                    </table>
                </td>

            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('province'))
                <tr>
                    <label  for="province">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('province')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Province</td>
                <td> :</td>
                <td><select name="province" id="province">
                        <option value="Northern Province">Northern Province</option>
                        <option value="North Western Province">North Western Province</option>
                        <option value="Western Province">Western Province</option>
                        <option value="North Central Province">North Central Province</option>
                        <option value="Central Province">Central Province</option>
                        <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                        <option value="Eastern Province">Eastern	Province</option>
                        <option value="Uva Province">Uva Province</option>
                        <option value="Southern Province">Southern Province</option>
                    </select></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('district'))
                <tr>
                    <label  for="district">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('district')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>District</td>
                <td> :</td>
                <td><input type="text" name="district" id="district" value="{{ Input::old('district') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

                @if($errors->has('distric'))
                    <tr>
                        <label  for="distric">
                            <td></td>
                            <td></td>
                            <td style="color: red">
                                {{$errors->first('distric')}}
                            </td>
                        </label>
                    </tr>
                @endif
                <tr>
                    <td>Distric_Number</td>
                    <td> :</td>
                    <td><input type="text" name="distric" id="distric" value="{{ Input::old('distric') }}"/></td>
                </tr>
                {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('divisional_secretariat'))
                <tr>
                    <label  for="divisional_secretariat">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('divisional_secretariat')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Divisional Secretariat</td>
                <td> :</td>
                <td><input type="text" name="divisional_secretariat" id="divisional_secretariat" value="{{ Input::old('divisional_secretariat') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('grama_niladari_division'))
                <tr>
                    <label  for="grama_niladari_division">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('grama_niladari_division')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Grama niladari division</td>
                <td> :</td>
                <td><input type="text" name="grama_niladari_division" id="grama_niladari_division" value="{{ Input::old('grama_niladari_division') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('z_score'))
                <tr>
                    <label  for="z_score">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('z_score')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Z-Score</td>
                <td> :</td>
                <td><input type="number" name="z_score" id="z_score" step="0.0001" maxlength="6" value="{{ Input::old('z_score') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('nic'))
                <tr>
                    <label  for="nic">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('nic')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>NIC</td>
                <td> :</td>
                <td><input type="text" name="nic" id="nic" maxlength="10" value="{{ Input::old('nic') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('telephone_number_home'))
                <tr>
                    <label  for="telephone_number_home">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('telephone_number_home')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Telephone Number Home</td>
                <td> :</td>
                <td><input type="tel" name="telephone_number_home" id="telephone_number_home" maxlength="10" value="{{ Input::old('telephone_number_home') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('selection_method'))
                <tr>
                    <label  for="selection_method">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('selection_method')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Selection Method</td>
                <td> :</td>
                <td><input type="text" name="selection_method" id="selection_method" value="{{ Input::old('selection_method') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('mother_name'))
                <tr>
                    <label  for="mother_name">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('mother_name')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Mother's name</td>
                <td> :</td>
                <td><input type="text" name="mother_name" id="mother_name" value="{{ Input::old('mother_name') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('mother_occupation'))
                <tr>
                    <label  for="mother_occupation">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('mother_occupation')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Mother's occupation</td>
                <td> :</td>
                <td><input type="text" name="mother_occupation" id="mother_occupation" value="{{ Input::old('mother_occupation') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('father_name'))
                <tr>
                    <label  for="father_name">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('father_name')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Father's name</td>
                <td> :</td>
                <td><input type="text" name="father_name" id="father_name" value="{{ Input::old('father_name') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('father_occupation'))
                <tr>
                    <label  for="father_occupation">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('father_occupation')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Father's occupation</td>
                <td> :</td>
                <td><input type="text" name="father_occupation" id="father_occupation" value="{{ Input::old('father_occupation') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('guardian_contact_no'))
                <tr>
                    <label  for="guardian_contact_no">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('guardian_contact_no')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Guardian's contact number</td>
                <td> :</td>
                <td><input type="tel" name="guardian_contact_no" id="guardian_contact_no" maxlength="10" value="{{ Input::old('guardian_contact_no') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('informer_contact_no'))
                <tr>
                    <label  for="informer_contact_no">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('informer_contact_no')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Informer's contact number</td>
                <td> :</td>
                <td><input type="tel" name="informer_contact_no" id="informer_contact_no" maxlength="10" value="{{ Input::old('informer_contact_no') }}"/></td>
            </tr>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('school'))
                <tr>
                    <label  for="school">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('school')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>School</td>
                <td> :</td>
                <td><input type="text" name="school" id="school" value="{{ Input::old('school') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('village'))
                <tr>
                    <label  for="village">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('village')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Village</td>
                <td> :</td>
                <td><input type="text" name="village" id="village" value="{{ Input::old('village') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('race'))
                <tr>
                    <label  for="race">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('race')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Race</td>
                <td> :</td>
                <td><input type="text" name="race" id="race" value="{{ Input::old('race') }}"/></td>
            {{---------------------------------------------------------------------------------------------------------}}


            {{--@if($errors->has('al_batch'))--}}
                {{--<tr>--}}
                    {{--<label  for="al_batch">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('al_batch')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>A/L Batch</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="number" name="al_batch" id="al_batch" min="1970" max="2070" placeholder="YYYY"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}

            {{--@if($errors->has('current_batch'))--}}
                {{--<tr>--}}
                    {{--<label  for="current_batch">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('current_batch')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>Current Batch</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="number" name="current_batch" id="current_batch" min="1971" max="2071" placeholder="YYYY"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}

            {{--@if($errors->has('status'))--}}
                {{--<tr>--}}
                    {{--<label  for="status">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('status')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>Status</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="number" name="status" min="0" max="1" placeholder="1 or 0" id="status"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}
            {{--<tr>--}}
                {{--<td>Degree ID</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="text" name="degree_id" id="stu_degree_id"/></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>Combination ID</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="text" name="combination_id" id="stu_combination_id"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}

            {{--@if($errors->has('stream_id'))--}}
                {{--<tr>--}}
                    {{--<label  for="stream_id">--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td style="color: red">--}}
                            {{--{{$errors->first('stream_id')}}--}}
                        {{--</td>--}}
                    {{--</label>--}}
                {{--</tr>--}}
            {{--@endif--}}

            {{--<tr>--}}
                {{--<td>Stream ID</td>--}}
                {{--<td> :</td>--}}
                {{--<td><input type="text" name="stream_id"  id="stream_id"/></td>--}}
            {{--</tr>--}}
            {{---------------------------------------------------------------------------------------------------------}}

            @if($errors->has('date_of_registration'))
                <tr>
                    <label  for="date_of_registration">
                        <td></td>
                        <td></td>
                        <td style="color: red">
                            {{$errors->first('date_of_registration')}}
                        </td>
                    </label>
                </tr>
            @endif
            <tr>
                <td>Date of Registration</td>
                <td> :</td>
                <td><input type="date" name="date_of_registration" id="date_of_registration" value="{{ Input::old('date_of_registration') }}"/></td>
            </tr>

        </table>

        <button type="submit" style="float: right;" class="btn btn-primary">Submit</button>
    </form>




    {{--<div class="alert-danger" style="width: 700px" align="center">--}}
        {{--@if(Session::has('validate'))--}}

            {{--@foreach(Session::get('validate')->all() as $error)--}}

                {{--<li align="left">{{$error}}</li>--}}

            {{--@endforeach--}}
            {{--{{Session::forget('validate')}}--}}

        {{--@endif--}}
    {{--</div>--}}

</div>

@stop