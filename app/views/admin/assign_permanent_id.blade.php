@extends('layouts.dashboard')

@section('css')
   
    @stop

@section('js')

    @stop



@section('content')

    <div class="well span8">
            <legend>Assign Permanent Id's</legend>
            
            <table>    
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
            </table>




    </div>
@stop

 @section('footer')

@stop 