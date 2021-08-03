{{session()->put('menu',21)}}
@include('header')
<style>


    .multiselect {
        width: 200px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }
</style>
<script type="text/javascript">
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    //var element = document.getElementById('text');
    if (isMobile) {
        alert('This pade is only accessible on Desktop/Laptop');
        window.location.href = "{{route('rolealloc.list')}}";
    } else {
        //element.innerHTML = "You are using Desktop";
    }
</script>

<script>



    var expanded = false;

    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
</script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Role Allocations</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('rolealloc.list')}}">Role Allocations</a>
            </li>

            <li class="active">
                <strong>Add Role Allocation</strong>
            </li>
        </ol>

    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6"><h3 class="m-t-none m-b"></h3>

                <form id="stringLengthForm" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"
                      action="{{route('rolealloc.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_raID">
                    </div>

                    
                    <div class="form-group">
                        <label>Role Name</label>
                        <select name="txt_roleid" id="txt_roleid" class="form-control" required>
                            <option value="">---Select---</option>
                            @foreach($rolls as $rr )

                                <option value="{{ $rr->Role_Id}}"> {{$rr->Role_Name}}</option>

                            @endforeach

                        </select>
                    </div>



                    <div class="form-group" style="visibility:hidden">
                        <div class="col-md-1"> &nbsp;</div>
                        <div class="col-md-2" style="font-weight:bold;color:red">Dashboard</div>
                        <div class="col-md-9">&nbsp;</div>
                    </div>

                    <div class="form-group" style="visibility:hidden">
                        <div class="col-md-1"> &nbsp;</div>
                        <div class="col-md-2"><input type="checkbox" name="chk1" id="chk1" value="1" checked="checked" />
                            <label for="chk1" >Dashboard</div>
                        <div class="col-md-9">&nbsp;</div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-1"> &nbsp;</div>
                        <div class="col-md-11">
                            <table class="table">
                                <tr>
                                    <th>Functionality</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Masters</td>
                                </tr>
                                <tr>
                                    <td>Program/Skills</td>
                                    <td><input type="checkbox" id="chk5" name="chk5" value="5" /></td>
                                    <td><input type="checkbox" id="chk2" name="chk2" value="2" /></td>
                                    <td><input type="checkbox" id="chk3" name="chk3" value="3" /></td>
                                    <td><input type="checkbox" id="chk4" name="chk4" value="4" /></td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td><input type="checkbox" id="chk9" name="chk9" value="9" /></td>
                                    <td><input type="checkbox" id="chk6" name="chk6" value="6" /></td>
                                    <td><input type="checkbox" id="chk7" name="chk7" value="7" /></td>
                                    <td><input type="checkbox" id="chk8" name="chk8" value="8" /></td>
                                </tr>
                                <tr>
                                    <td>Organization</td>
                                    <td><input type="checkbox" id="chk13" name="chk13" value="13" /></td>
                                    <td><input type="checkbox" id="chk10" name="chk10" value="10" /></td>
                                    <td><input type="checkbox" id="chk11" name="chk11" value="11" /></td>
                                    <td><input type="checkbox" id="chk12" name="chk12" value="12" /></td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td><input type="checkbox" id="chk17" name="chk17" value="17" /></td>
                                    <td><input type="checkbox" id="chk14" name="chk14" value="14" /></td>
                                    <td><input type="checkbox" id="chk15" name="chk15" value="15" /></td>
                                    <td><input type="checkbox" id="chk16" name="chk16" value="16" /></td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td><input type="checkbox" id="chk21" name="chk21" value="21" /></td>
                                    <td><input type="checkbox" id="chk18" name="chk18" value="18" /></td>
                                    <td><input type="checkbox" id="chk19" name="chk19" value="19" /></td>
                                    <td><input type="checkbox" id="chk20" name="chk20" value="20" /></td>
                                </tr>
                                <tr>
                                    <td>Demo</td>
                                    <td><input type="checkbox" id="chk29" name="chk29" value="29" /></td>
                                    <td><input type="checkbox" id="chk26" name="chk26" value="26" /></td>
                                    <td><input type="checkbox" id="chk27" name="chk27" value="27" /></td>
                                    <td><input type="checkbox" id="chk28" name="chk28" value="28" /></td>
                                </tr>
                                <tr>
                                    <td>Evaluation</td>
                                    <td><input type="checkbox" id="chk33" name="chk33" value="33" /></td>
                                    <td><input type="checkbox" id="chk30" name="chk30" value="30" /></td>
                                    <td><input type="checkbox" id="chk31" name="chk31" value="31" /></td>
                                    <td><input type="checkbox" id="chk32" name="chk32" value="32" /></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td><input type="checkbox" id="chk37" name="chk37" value="37" /></td>
                                    <td><input type="checkbox" id="chk34" name="chk34" value="34" /></td>
                                    <td><input type="checkbox" id="chk35" name="chk35" value="35" /></td>
                                    <td><input type="checkbox" id="chk36" name="chk36" value="36" /></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><input type="checkbox" id="chk41" name="chk41" value="41" /></td>
                                    <td><input type="checkbox" id="chk38" name="chk38" value="38" /></td>
                                    <td><input type="checkbox" id="chk39" name="chk39" value="39" /></td>
                                    <td><input type="checkbox" id="chk40" name="chk40" value="40" /></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><input type="checkbox" id="chk45" name="chk45" value="45" /></td>
                                    <td><input type="checkbox" id="chk42" name="chk42" value="42" /></td>
                                    <td><input type="checkbox" id="chk43" name="chk43" value="43" /></td>
                                    <td><input type="checkbox" id="chk44" name="chk44" value="44" /></td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td><input type="checkbox" id="chk49" name="chk49" value="49" /></td>
                                    <td><input type="checkbox" id="chk46" name="chk46" value="46" /></td>
                                    <td><input type="checkbox" id="chk47" name="chk47" value="47" /></td>
                                    <td><input type="checkbox" id="chk48" name="chk48" value="48" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Employees</td>
                                </tr>
                                <tr>
                                    <td>Employee</td>
                                    <td><input type="checkbox" id="chk57" name="chk57" value="57" /></td>
                                    <td><input type="checkbox" id="chk54" name="chk54" value="54" /></td>
                                    <td><input type="checkbox" id="chk55" name="chk55" value="55" /></td>
                                    <td><input type="checkbox" id="chk56" name="chk56" value="56" /></td>
                                </tr>
                                <tr>
                                    <td>Employee Experience</td>
                                    <td><input type="checkbox" id="chk61" name="chk61" value="61" /></td>
                                    <td><input type="checkbox" id="chk58" name="chk58" value="58" /></td>
                                    <td><input type="checkbox" id="chk59" name="chk59" value="59" /></td>
                                    <td><input type="checkbox" id="chk60" name="chk60" value="60" /></td>
                                </tr>
                                <tr>
                                    <td>Qualification</td>
                                    <td><input type="checkbox" id="chk65" name="chk65" value="65" /></td>
                                    <td><input type="checkbox" id="chk62" name="chk62" value="62" /></td>
                                    <td><input type="checkbox" id="chk63" name="chk63" value="63" /></td>
                                    <td><input type="checkbox" id="chk64" name="chk64" value="64" /></td>
                                </tr>
                                <tr>
                                    <td>Attendance</td>
                                    <td><input type="checkbox" id="chk69" name="chk69" value="69" /></td>
                                    <td><input type="checkbox" id="chk66" name="chk66" value="66" /></td>
                                    <td><input type="checkbox" id="chk67" name="chk67" value="67" /></td>
                                    <td><input type="checkbox" id="chk68" name="chk68" value="68" /></td>
                                </tr>
                                <tr>
                                    <td>Skill Data</td>
                                    <td><input type="checkbox" id="chk172" name="chk172" value="172" /></td>
                                    <td><input type="checkbox" id="chk173" name="chk173" value="173" /></td>
                                    <td><input type="checkbox" id="chk174" name="chk174" value="174" /></td>
                                    <td><input type="checkbox" id="chk175" name="chk175" value="175" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Courses</td>
                                </tr>
                                <tr>
                                    <td>Courses <!-- program_Master --></td>
                                    <td><input type="checkbox" id="chk164" name="chk164" value="164" /></td>
                                    <td><input type="checkbox" id="chk165" name="chk165" value="165" /></td>
                                    <td><input type="checkbox" id="chk166" name="chk166" value="166" /></td>
                                    <td><input type="checkbox" id="chk167" name="chk167" value="167" /></td>
                                </tr>
                                <tr>
                                    <td>Batch Session Mapping</td>
                                    <td><input type="checkbox" id="chk168" name="chk168" value="168" /></td>
                                    <td><input type="checkbox" id="chk169" name="chk169" value="169" /></td>
                                    <td><input type="checkbox" id="chk170" name="chk170" value="170" /></td>
                                    <td><input type="checkbox" id="chk171" name="chk171" value="171" /></td>
                                </tr>
                                <tr>
                                    <td>Course College Mapping <!-- college Master --></td>
                                    <td><input type="checkbox" id="chk73" name="chk73" value="73" /></td>
                                    <td><input type="checkbox" id="chk70" name="chk70" value="70" /></td>
                                    <td><input type="checkbox" id="chk72" name="chk72" value="72" /></td>
                                    <td><input type="checkbox" id="chk71" name="chk71" value="71" /></td>
                                </tr>
                                <tr>
                                    <td>Course Session Mapping</td>
                                    <td><input type="checkbox" id="chk77" name="chk77" value="77" /></td>
                                    <td><input type="checkbox" id="chk74" name="chk74" value="74" /></td>
                                    <td><input type="checkbox" id="chk76" name="chk76" value="76" /></td>
                                    <td><input type="checkbox" id="chk75" name="chk75" value="75" /></td>
                                </tr>
                                <tr>
                                    <td>Course Transaction</td>
                                    <td><input type="checkbox" id="chk81" name="chk81" value="81" /></td>
                                    <td><input type="checkbox" id="chk78" name="chk78" value="78" /></td>
                                    <td><input type="checkbox" id="chk80" name="chk80" value="80" /></td>
                                    <td><input type="checkbox" id="chk79" name="chk79" value="79" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Colleges</td>
                                </tr>
                                <tr>
                                    <td>Colleges</td>
                                    <td><input type="checkbox" id="chk85" name="chk85" value="85" /></td>
                                    <td><input type="checkbox" id="chk82" name="chk82" value="82" /></td>
                                    <td><input type="checkbox" id="chk84" name="chk84" value="84" /></td>
                                    <td><input type="checkbox" id="chk83" name="chk83" value="83" /></td>
                                </tr>
                                <tr>
                                    <td>College Before/After Training</td>
                                    <td><input type="checkbox" id="chk89" name="chk89" value="89" /></td>
                                    <td><input type="checkbox" id="chk86" name="chk86" value="86" /></td>
                                    <td><input type="checkbox" id="chk88" name="chk88" value="88" /></td>
                                    <td><input type="checkbox" id="chk87" name="chk87" value="87" /></td>
                                </tr>
                                <!--<tr>
                                    <td>College After Training</td>
                                    <td><input type="checkbox" id="chk91" name="chk91" value="91" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--</td>
                                    <td><input type="checkbox" id="chk93" name="chk93" value="93" /></td>
                                    <td><input type="checkbox" id="chk92" name="chk92" value="92" /></td>
                                </tr>-->
                                <tr>
                                    <td>College During Training</td>
                                    <td><input type="checkbox" id="chk97" name="chk97" value="97" /></td>
                                    <td><input type="checkbox" id="chk94" name="chk94" value="94" /></td>
                                    <td><input type="checkbox" id="chk96" name="chk96" value="96" /></td>
                                    <td><input type="checkbox" id="chk95" name="chk95" value="95" /></td>
                                </tr>
                                <tr>
                                    <td>Students</td>
                                    <td><input type="checkbox" id="chk101" name="chk101" value="101" /></td>
                                    <td><input type="checkbox" id="chk98" name="chk98" value="98" /></td>
                                    <td><input type="checkbox" id="chk100" name="chk100" value="100" /></td>
                                    <td><input type="checkbox" id="chk99" name="chk99" value="99" /></td>
                                </tr>
                                <tr>
                                    <td>Student Feedback</td>
                                    <td><input type="checkbox" id="chk105" name="chk105" value="105" /></td>
                                    <td><input type="checkbox" id="chk102" name="chk102" value="102" /></td>
                                    <td><input type="checkbox" id="chk104" name="chk104" value="104" /></td>
                                    <td><input type="checkbox" id="chk103" name="chk103" value="103" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Interns</td>
                                </tr>
                                <tr>
                                    <td>Intern Evaluations</td>
                                    <td><input type="checkbox" id="chk109" name="chk109" value="109" /></td>
                                    <td><input type="checkbox" id="chk106" name="chk106" value="106" /></td>
                                    <td><input type="checkbox" id="chk108" name="chk108" value="108" /></td>
                                    <td><input type="checkbox" id="chk107" name="chk107" value="107" /></td>
                                </tr>
                                <tr>
                                    <td>Intern Planned Schedule</td>
                                    <td><input type="checkbox" id="chk113" name="chk113" value="113" /></td>
                                    <td><input type="checkbox" id="chk110" name="chk110" value="110" /></td>
                                    <td><input type="checkbox" id="chk112" name="chk112" value="112" /></td>
                                    <td><input type="checkbox" id="chk111" name="chk111" value="111" /></td>
                                </tr>
                                <tr>
                                    <td>Intern Dailly Performance Card</td>
                                    <td><input type="checkbox" id="chk117" name="chk117" value="117" /></td>
                                    <td><input type="checkbox" id="chk114" name="chk114" value="114" /></td>
                                    <td><input type="checkbox" id="chk116" name="chk116" value="116" /></td>
                                    <td><input type="checkbox" id="chk115" name="chk115" value="115" /></td>
                                </tr>
                                <tr>
                                    <td>Placement Drive</td>
                                    <td><input type="checkbox" id="chk121" name="chk121" value="121" /></td>
                                    <td><input type="checkbox" id="chk181" name="chk181" value="181" /></td>
                                    <td><input type="checkbox" id="chk120" name="chk120" value="120" /></td>
                                    <td><input type="checkbox" id="chk119" name="chk119" value="119" /></td>
                                </tr>
                                <tr>
                                    <td>Intern Attendance</td>
                                    <td><input type="checkbox" id="chk125" name="chk125" value="125" /></td>
                                    <td><input type="checkbox" id="chk122" name="chk122" value="122" /></td>
                                    <td><input type="checkbox" id="chk124" name="chk124" value="124" /></td>
                                    <td><input type="checkbox" id="chk123" name="chk123" value="123" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Topics</td>
                                </tr>
                                <tr>
                                    <td>Topics</td>
                                    <td><input type="checkbox" id="chk129" name="chk129" value="129" /></td>
                                    <td><input type="checkbox" id="chk126" name="chk126" value="126" /></td>
                                    <td><input type="checkbox" id="chk128" name="chk128" value="128" /></td>
                                    <td><input type="checkbox" id="chk127" name="chk127" value="127" /></td>
                                </tr>
                                <tr>
                                    <td>Sub Topics</td>
                                    <td><input type="checkbox" id="chk133" name="chk133" value="133" /></td>
                                    <td><input type="checkbox" id="chk130" name="chk130" value="130" /></td>
                                    <td><input type="checkbox" id="chk132" name="chk132" value="132" /></td>
                                    <td><input type="checkbox" id="chk131" name="chk131" value="131" /></td>
                                </tr>
                                <tr>
                                    <td>Topic Evaluations</td>
                                    <td><input type="checkbox" id="chk137" name="chk137" value="137" /></td>
                                    <td><input type="checkbox" id="chk134" name="chk134" value="134" /></td>
                                    <td><input type="checkbox" id="chk136" name="chk136" value="136" /></td>
                                    <td><input type="checkbox" id="chk135" name="chk135" value="135" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Users - Roles</td>
                                </tr>
                                <tr>
                                    <td>Users</td>
                                    <td><input type="checkbox" id="chk141" name="chk141" value="141" /></td>
                                    <td><input type="checkbox" id="chk138" name="chk138" value="138" /></td>
                                    <td><input type="checkbox" id="chk140" name="chk140" value="140" /></td>
                                    <td><input type="checkbox" id="chk139" name="chk139" value="139" /></td>
                                </tr>
                                <tr>
                                    <td>Roles</td>
                                    <td><input type="checkbox" id="chk145" name="chk145" value="145" /></td>
                                    <td><input type="checkbox" id="chk142" name="chk142" value="142" /></td>
                                    <td><input type="checkbox" id="chk144" name="chk144" value="144" /></td>
                                    <td><input type="checkbox" id="chk143" name="chk143" value="143" /></td>
                                </tr>
                                <tr>
                                    <td>User - Role Allocation</td>
                                    <td><input type="checkbox" id="chk149" name="chk149" value="149" /></td>
                                    <td><input type="checkbox" id="chk146" name="chk146" value="146" /></td>
                                    <td><input type="checkbox" id="chk148" name="chk148" value="148" /></td>
                                    <td><input type="checkbox" id="chk147" name="chk147" value="147" /></td>
                                </tr>
                                <tr>
                                    <td>Role - Functionality Allocation</td>
                                    <td><input type="checkbox" id="chk153" name="chk153" value="153" /></td>
                                    <td><input type="checkbox" id="chk150" name="chk150" value="150" /></td>
                                    <td><input type="checkbox" id="chk152" name="chk152" value="152" /></td>
                                    <td><input type="checkbox" id="chk151" name="chk151" value="151" /></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" style="font-weight:bold;color:red">Reports</td>
                                </tr>
                                <tr>
                                    <td>Placement Report</td>
                                    <td><input type="checkbox" id="chk154" name="chk154" value="154" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Student Placement Ratings</td>
                                    <td><input type="checkbox" id="chk155" name="chk155" value="155" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Performance Report</td>
                                    <td><input type="checkbox" id="chk157" name="chk157" value="157" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Attendance Report</td>
                                    <td><input type="checkbox" id="chk158" name="chk158" value="158" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Evaluation Report</td>
                                    <td><input type="checkbox" id="chk159" name="chk159" value="159" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>College Training Summary</td>
                                    <td><input type="checkbox" id="chk160" name="chk160" value="160" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>College Training Details</td>
                                    <td><input type="checkbox" id="chk161" name="chk161" value="161" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Employee Search</td>
                                    <td><input type="checkbox" id="chk162" name="chk162" value="162" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>
                                <tr>
                                    <td>Trainee Report</td>
                                    <td><input type="checkbox" id="chk163" name="chk163" value="163" /></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                    <td><!--<input type="checkbox" id="chk" name="chk" value="" />--></td>
                                </tr>

                            </table>
                        </div>

                    </div>



                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong>
                        </button>

                    </div>



                </form>
                <script type="text/javascript">


                    $(document).ready(function () {
                        $('#stringLengthForm').bootstrapValidator();

                      
 						
						
                    });


function setChk(nm,isAllowed)
{
	var chk2 = "chk" + nm;
	var chk1 = document.getElementById(chk2);
								if('isAllowed'==1)
								{
									chk1.checked=true;
								}
								else
								{
									//chk1.checked=false;
								}
}


                </script>
            </div>
        </div>
    </div>
</div>








@include('footer')
