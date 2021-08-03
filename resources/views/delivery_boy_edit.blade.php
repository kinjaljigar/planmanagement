{{session()->put('menu',13)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Delivery Boy</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('deliveryboy.list')}}">Delivery Boy</a>
            </li>

            <li class="active">
                <strong>Edit Delivery Boy</strong>
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
                      action="{{route('deliveryboy.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" value="{{$deliveryboy->Id}}" name="txt_id" id="txt_id">
                    </div>


                    <div class="form-group"><label>Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Name"
                               name="txt_name"
                               id="txt_name"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$deliveryboy->Boy_Name}}"
                               data-bv-stringlength-max="100"
                               data-bv-stringlength-message="The Enter Name must be 100 Characters or Smaller"
                               required></div>



                    <div class="form-group"><label>Address <span style="color: red">*</span></label> <textarea

                            name="txt_address"

                            placeholder="Enter Address"

                            id="txt_address"

                            class="form-control"

                            data-bv-stringlength="true"

                            data-bv-stringlength-max="500"

                            data-bv-stringlength-message="The Address must be 500 Characters or Smaller"

                            required>{{$deliveryboy->Address}}</textarea></div>



                    <div class="form-group"><label>Phone No <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Phone No"
                               name="txt_PhoneNo"
                               id="txt_PhoneNo"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$deliveryboy->Phone_No}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Phone No must be 50 Characters or Smaller"
                               required></div>


                    <div class="form-group"><label>Vehicle No</label>
                        <input type="text"
                               placeholder="Enter Vehicle No"
                               name="txt_VehicleNo"
                               id="txt_VehicleNo"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$deliveryboy->Vehicle_No}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Vehicle No must be 50 Characters or Smaller"
                        ></div>

                    <div class="form-group"><label>Vehicle Type</label>
                        <input type="text"
                               placeholder="Enter Vehicle Type"
                               name="txt_VehicleType"
                               id="txt_VehicleType"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$deliveryboy->Vehical_Type}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Vehicle Type must be 50 Characters or Smaller"
                        ></div>

                    <div class="form-group">
                    	<label>Deposit of Bottles/Jugs</label>
                        <table>
                            @foreach($bottles as $b)
                                <tr>
                                    <td>{{$b->Name}}</td>
                                    <td><input type="number" class="form-control" id="txtB{{$b->Id}}"
                                               name="txtB{{$b->Id}}"
                                               value="{{$b->Count}}"> </td>
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

                        $('#stringLengthForm').bootstrapValidator();

                    });





                </script>


            </div>
        </div>
    </div>
</div>








@include('footer')
