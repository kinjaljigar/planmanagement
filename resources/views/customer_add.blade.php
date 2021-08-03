{{session()->put('menu',7)}}

@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Customer</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('customer.list')}}">Customer</a>
            </li>

            <li class="active">
                <strong>Add Customer</strong>
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
                      action="{{route('customer.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id">
                    </div>


                    <div class="form-group"><label>Firm Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Firm Name"
                               name="txt_Agencyname"
                               id="txt_Agencyname"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_Agencyname')}}"
                               data-bv-stringlength-max="100"
                               data-bv-stringlength-message="The Firm Name must be 100 Characters or Smaller"
                        required></div>

                    <div>


                        <div class="form-group"><label>Customer Name <span style="color: red">*</span></label>
                            <input type="text"
                                   placeholder="Enter Customer Name"
                                   name="txt_customername"
                                   id="txt_customername"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   value="{{old('txt_customername')}}"
                                   data-bv-stringlength-max="100"
                                   data-bv-stringlength-message="The Customer Name must be 100 Characters or Smaller"
                            required></div>


                        <div class="form-group"><label>Address <span style="color: red">*</span></label> <textarea

                                name="txt_address"

                                placeholder="Enter Address"

                                id="txt_address"

                                class="form-control"

                                data-bv-stringlength="true"

                                data-bv-stringlength-max="500"

                                data-bv-stringlength-message="The Address must be 500 Characters or Smaller"

                            required>{{old('txt_address')}}</textarea></div>

                        <div class="form-group">

                            <label>Area <span style="color: red">*</span></label>

                            <select name="txt_area" id="txt_area" class="form-control" required>

                                <option value="">---Select---</option>

                                @foreach($area as $a)

                                    <option value="{{ $a->Id}}"
                                        {{old('txt_area')==$a->Id?'Selected':''}}> {{$a->Area_Name}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group"><label>Phone No <span style="color: red">*</span></label>
                            <input type="text"
                                   placeholder="Enter Phone No"
                                   name="txt_PhoneNo"
                                   id="txt_PhoneNo"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   value="{{old('txt_PhoneNo')}}"
                                   data-bv-stringlength-max="50"
                                   data-bv-stringlength-message="The Enter Phone No must be 50 Characters or Smaller"
                            required></div>



                        {{--<div class="form-group" id="dt_dob">
                            <label>Date of Birth</label>

                                <input type="date"
                                       value="{{old('dt_dob')}}"
                                       id="datepicker" name="dt_dob"
                                       class="form-control"

                                >
                        </div>--}}

                        <div class="form-group"><label>Date of Birth</label>

                            <input type="date"  name="dt_dob" value="{{old('dt_dob')}}" class="form-control"   />

                        </div>



                        <div class="form-group"><label>GST No</label>
                            <input type="text"
                                   placeholder="Enter GST No"
                                   name="txt_gstno"
                                   id="txt_gstno"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   value="{{old('txt_gstno')}}"
                                   data-bv-stringlength-max="50"
                                   data-bv-stringlength-message="The Enter GST No must be 50 Characters or Smaller"
                            ></div>


                        <div class="form-group"><label>Email ID</label>
                            <input type="email"

                                   placeholder="Enter Office Email ID  valid@email.com"

                                   name="txt_EmailID"

                                   class="form-control"

                                   pattern="[a-zA-Z0-9.!#$%&amp;’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"

                                   title="valid@email.com"

                                   value="{{old("txt_EmailID")}}"

                                   data-bv-stringlength="true"

                                   data-bv-stringlength-max="50"

                                   data-bv-stringlength-message="The Office Email ID must be 50 Characters or Smaller"

                            ></div>

                        <div class="form-group"><label>Sequence No</label>
                            <input type="text"
                                   placeholder="Enter Sequence No"
                                   name="txt_sequenceno"
                                   id="txt_sequenceno"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   value="{{old('txt_sequenceno')}}"
                                   data-bv-stringlength-max="10"
                                   data-bv-stringlength-message="The Enter Sequence No must be 10 Characters or Smaller"
                            ></div>


                        <div class="form-group"><label>Start Date <span style="color: red">*</span></label>

                            <input type="date" id="dt_start" name="dt_start" value="{{old('dt_start')}}" class="form-control" required  />

                        </div>
						<!-- --------------- Code for customer Plan ----------------- -->
                        <div class="form-group">
                            <label>Plan Type<span style="color: red">*</span></label>
    
                            <select name="cmbPlanType" id="cmbPlanType" class="form-control" required>
    
                                <option value="Monthly">Monthly</option>
                                <option value="Daily">Daily</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label>Plan Name <span style="color: red">*</span></label>
    
                            <select name="txt_planid" id="txt_planid" class="form-control" required>
    
                                <option value="">---Select Plan---</option>
    
                                @foreach($plans as $p )
    
                                    <option value="{{ $p->Id}}"
                                        {{old('txt_planid')==$p->Id?'Selected':''}}> {{$p->Name}}</option>
    
                                @endforeach
    
                            </select>
                        </div>
    
    					<div class="form-group">

                            <label>Delivery Boy <span style="color: red">*</span></label>

                            <select name="txt_db" id="txt_db" class="form-control" required>

                                <option value="0">---Select---</option>

         
                            </select>
                        </div>
                        <div class="form-group"><label>No. Of Bottle/Jugs per day<span style="color: red">*</span></label>
                            <input type="number"
                                   placeholder="Enter Number Of Bottle/Jug"
                                   name="txt_bottleno"
                                   id="txt_bottleno"
                                   class="form-control"
                                   value="{{old("txt_bottleno")}}"
                                   required></div>

    
                        <div class="form-group"><label>Rate (Per Bottle/Jug) <span style="color: red">*</span></label>
                            <input type="number"
                                   placeholder="Enter Rate"
                                   name="txt_rate"
                                   id="txt_rate"
                                   class="form-control"
                                   value="{{old('txt_rate')}}"
                                   required></div>
    

                        <div class="form-group">
                            <label>Deposit of Bottles/Jugs</label>
                            <table>
                                @foreach($Bottles as $b)
                                    <tr>
                                        <td>{{$b->Name}}</td>
                                        <td><input type="number" class="form-control" id="txtB{{$b->Id}}"
                                                   name="txtB{{$b->Id}}"
                                            value="txtB{{$b->Id}}"> </td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
<!-- --------------------------------------------------------------------- -->
						
                        <div>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                    type="submit" id="saveRecord"
                            ><strong>Save</strong>

                            </button>

                        </div>
                    </div>


                </form>


                <script type="text/javascript">

                    $(document).ready(function () {

                        $('#stringLengthForm').bootstrapValidator();
                        /*{
                            $('.date').datetimepicker({
                                format: 'DD/MM/YYYY',
                                locale: 'en'
                            });
                        }*/
						
						$('#txt_planid').change(function () {
                            $.get("{{url('getPlanDetails')}}",
                                {option: $(this).val()},
                                function (data) {
									document.getElementById("txt_rate").value=Math.abs(data.Rate);

                                });
                        });
						$('#txt_area').change(function(){
							$.get("{{url('getDBFrmArea')}}",
								{option:$(this).val()},
								function (data){
									var model = $('#txt_db');
                                    model.empty();
									
                                    $.each(data, function (index, element) {
										
                                        	model.append("<option value='" + element.Id + "' >" + element.Boy_Name + "</option>");
										
                                    });
								});
						});
						$('#cmbPlanType').change(function(){
							$.get("{{url('getPlanByType')}}",
								{option:$(this).val()},
								function (data){
									var model = $('#txt_planid');
                                    model.empty();
									
                                    $.each(data, function (index, element) {
										
                                        	model.append("<option value='" + element.Id + "' >" + element.Name + "</option>");
										
                                    });
								});
						});
                    });

				</script>
            </div>
        </div>
    </div>
</div>








@include('footer')
