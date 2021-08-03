{{session()->put('menu',19)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Dealer</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('dealer.list')}}">Dealer</a>
            </li>

            <li class="active">
                <strong>Add Dealer</strong>
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
                      action="{{route('dealer.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id">
                    </div>


                    <div class="form-group"><label>Agency Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Agency Name"
                               name="txt_AgencyName"
                               id="txt_AgencyName"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_AgencyName')}}"
                               data-bv-stringlength-max="500"
                               data-bv-stringlength-message="The Enter Agency Name must be 500 Characters or Smaller"
                        required></div>


                    <div class="form-group"><label>Dealer Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Name"
                               name="txt_name"
                               id="txt_name"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_name')}}"
                               data-bv-stringlength-max="100"
                               data-bv-stringlength-message="The Enter Name must be 100 Characters or Smaller"
                               required></div>

                    <div class="form-group"><label>Address </label>
                        <input type="text"
                               placeholder="Enter Address"
                               name="txt_address"
                               id="txt_address"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_address')}}"
                               data-bv-stringlength-max="500"
                               data-bv-stringlength-message="The Enter Address must be 500 Characters or Smaller"
                        ></div>


                    <div class="form-group">
                        <label>Area <span style="color: red">*</span></label>

                        <select name="txt_area" class="form-control"   id="txt_area" required>


                            <option value="">---Select---</option>


                            @foreach($area as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_area')==$p->Id?'Selected':''}}> {{$p->Area_Name}}</option>

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


                    <div class="form-group"><label>Vehicle No</label>
                        <input type="text"
                               placeholder="Enter Vehicle No"
                               name="txt_VehicleNo"
                               id="txt_VehicleNo"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_VehicleNo')}}"
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
                               value="{{old('txt_VehicleType')}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Vehicle Type must be 50 Characters or Smaller"
                        ></div>

                    <div class="form-group">
                        <table>

                            <th>Bottle Name</th>
                            <th>Rate</th>


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



                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                            type="submit" id="saveRecord"><strong>Save</strong>
                                    </button>





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
