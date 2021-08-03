{{session()->put('menu',27)}}

@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Collector Edit</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('collector.list')}}">Collector</a>
            </li>

            <li class="active">
                <strong>Collector Edit</strong>
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
                      action="{{route('collector.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id" value={{$coll->Id}} >
                    </div>


                    <div class="form-group"><label>Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Name"
                               name="txtName"
                               id="txtName"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$coll->Name}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Name must be 50 Characters or Smaller"
                        required></div>
					
						<div class="form-group"><label>Phone No <span style="color: red">*</span></label>
                            <input type="text"
                                   placeholder="Enter Phone No"
                                   name="txtPhoneNo"
                                   id="txtPhoneNo"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   value="{{$coll->Phone}}"
                                   data-bv-stringlength-max="50"
                                   data-bv-stringlength-message="The Enter Phone No must be 20 Characters or Smaller"
                            required></div>
                        <div class="form-group"><label>Address </label> <textarea

                                name="txt_address"

                                placeholder="Enter Address"

                                id="txt_address"

                                class="form-control"

                                data-bv-stringlength="true"

                                data-bv-stringlength-max="500"

                                data-bv-stringlength-message="The Address must be 500 Characters or Smaller"

                            >{{$coll->Address}}</textarea></div>
                            
                        <div class="form-group"><label>Date of Birth</label>

                            <input type="date"  name="dt_dob" value="{{$coll->DoB}}" class="form-control"   />

                        </div>
                        
                        
                        <div class="form-group"><label>Date of Anniversary</label>

                            <input type="date"  name="dt_doa" value="{{$coll->DoA}}" class="form-control"   />

                        </div>
                        
                        <div class="form-group"><label>Email ID</label>
                            <input type="email"

                                   placeholder="Enter Office Email ID  valid@email.com"

                                   name="txt_EmailID"

                                   class="form-control"

                                   pattern="[a-zA-Z0-9.!#$%&amp;'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"

                                   title="valid@email.com"

                                   value="{{$coll->Email}}"

                                   data-bv-stringlength="true"

                                   data-bv-stringlength-max="50"

                                   data-bv-stringlength-message="The Office Email ID must be 50 Characters or Smaller"

                            ></div>

                       
						
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                    type="submit" id="saveRecord"
                            ><strong>Save</strong>

                            </button>

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
										//if(element.Area_Id==$(this).val())
										//{
										//var aid=document.getElementById("txt_area").value();
										//if(aid==element.Area_Id)
                                        	model.append("<option value='" + element.Id + "' >" + element.Boy_Name + "</option>");
										//}
										//else
										//	model.append("<option value='" + element.Id + "' >" + element.Boy_Name + "</option>");
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
