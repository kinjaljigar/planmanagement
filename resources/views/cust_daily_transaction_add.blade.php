{{session()->put('menu',11)}}
@include('header')

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Attendance</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('attendance.list')}}">Attendance</a>
            </li>

            <li class="active">
                <strong>Add Attendance</strong>
            </li>
        </ol>

    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-md-12"><h3 class="m-t-none m-b"></h3>

                <form id="stringLengthForm" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"
                      action="{{route('attendance.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
					<input type="hidden" id="AttType" value="Daily" />
                    <div class="form-group">
                        <label class="col-md-2">Date <span style="color: red">*</span></label>
                        <div class="col-md-4"><input type="date" name="txtDoT" id="txtDoT" value="{{$DoT}}" 
                        		class="form-control"  placeholder="dd-mm-yyyy" />
                   		</div>
                    </div>
                    <!--<div class="form-group">
                    	<label class="col-md-2">Plan</label>
                        <div class="col-md-5"><select name="cmbPlan" id="cmbPlan" class="form-control">
                        	<option value="Daily">Daily</option>
                            <option value="Monthly">Monthly</option>
                        </select></div>
                    </div>
					-->
                    <!--
					<div class="form-group">
                    	<label class="col-md-2">Area</label>
                        <div class="col-md-5"><select name="cmbArea" id="cmbArea" class="form-control">
                        	<option value="0">--- All ---</option>
                            @foreach($Area as $a)
                            	<option value="$a->Id">{{$a->Area_Name}}</option>
                            @endforeach
                        </select></div>
                    </div>-->
					<!--
                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit" id="btnShow" name="btnShow"><strong>Show</strong>
                        </button>

                    </div>
-->
                    <div class="form-group">
                        <table>
                        	<tr>
                            	<th>Customer</th>
                                @foreach($bottles as $b)
                                    	<th>{{$b->Name}}</th>
                                    @endforeach
                                
                            </tr>
                           	@foreach($Cust as $c)
                            	<tr>
                                	<td>{{$c->Agency_Name}} - {{$c->Cust_Name}}</td>
                                    
                                    @foreach($bottles as $b)
                                    	<td><input type="text" class="form-control" id="txt_nob[]"
                                                   name="txt_nob[]"
                                                   value="0"> </td>
                                    @endforeach
                                    
                                    
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit" id="saveRecord"><strong>Save</strong>
                        </button>

                    </div>



                </form>
                <script type="text/javascript">


                    $(document).ready(function () {
                        document.getElementById("saveRecord").disabled = false;
                        $('#stringLengthForm').bootstrapValidator();
                        $("#saveRecord").prop('enabled', true);

                        /*$('#txt_custid').change(function () {
                            $.get("{{ url('selected_planlist')}}",
                                {option: $(this).val()},
                                function (data) {
                                    var model = $('#txt_planid');
                                    model.empty();

                                    $.each(data, function (index, element) {
                                        model.append("<option value='" + element.Id + "'>" + element.Name + "</option>");
                                    });
                                });
                        });*/
                    });

                </script>

                <script>
                    $('.date-own').datepicker({
                        minViewMode: 2,
                        format: 'yyyy'
                    });
                </script>


            </div>
        </div>
    </div>
</div>








@include('footer')
