{{session()->put('menu',8)}}
@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Customer Plan</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('CustomerPlan.list')}}">Customer Plan</a>
            </li>

            <li class="active">
                <strong>Edit Customer Plan</strong>
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
                      action="{{route('CustomerPlan.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control"  value="{{$customerplan->Id}}" name="txt_id">
                    </div>


                    <div class="form-group">
                        <label>Customer Name</label>

                        <select name="txt_custid" id="txt_custid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($customers as $c )

                                <option value="{{ $c->Id}}"
                                    {{$customerplan->Cust_Id==$c->Id?'Selected':''}}> {{$c->Cust_Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Plan Name</label>

                        <select name="txt_planid" id="txt_planid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($plans as $p )

                                <option value="{{ $p->Id}}"
                                    {{$customerplan->Plan_Id==$p->Id?'Selected':''}}> {{$p->Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group"><label>Number Of Bottle</label>
                        <input type="number"
                               placeholder="Enter Number Of Bottle"
                               name="txt_bottleno"
                               id="txt_bottleno"
                               class="form-control"
                               value="{{$customerplan->No_Bottle}}"
                               required></div>
{{--
                    <div class="form-group"><label>Deposit bottle</label>
                        <input type="number"
                               placeholder="Enter Deposit bottle"
                               name="txt_depositbottle"
                               id="txt_depositbottle"
                               class="form-control"
                               value="{{$customerplan->Deposit_Bottle}}"
                        ></div>--}}


                    <div class="form-group"><label>Rate</label>
                        <input type="number"
                               placeholder="Enter Rate"
                               name="txt_rate"
                               class="form-control"
                               value="{{$customerplan->Rate}}"
                               required></div>


                    <div class="form-group"><label>Address</label> <textarea

                            name="txt_address"

                            placeholder="Enter Address"

                            id="txt_address"

                            class="form-control"

                            data-bv-stringlength="true"

                            data-bv-stringlength-max="500"

                            data-bv-stringlength-message="The Address must be 500 Characters or Smaller"

                            required>{{$customerplan->Address}}</textarea></div>


                    <div class="form-group">
                        <label>Area</label>

                        <select name="txt_area" class="form-control"   id="txt_area" >


                            <option value="-1">---Select---</option>


                            @foreach($areas as $c )

                                <option value="{{ $c->Id}}"
                                    {{$customerplan->Area_Id==$c->Id?'Selected':''}}> {{$c->Area_Name}}</option>

                            @endforeach



                        </select>

                    </div>


                    <div class="form-group"><label>Phone No</label>
                        <input type="text"
                               placeholder="Enter Phone No"
                               name="txt_PhoneNo"
                               id="txt_PhoneNo"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$customerplan->Phone_No}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Phone No must be 30 Characters or Smaller"
                        ></div>

                    <div class="form-group">
                        <label>Deposit Bottles/jugs</label>
                        <table>
                            @foreach($Bottles as $b)
                                <tr>
                                    <td>{{$b->Name}}</td>
                                    <td><input type="number" class="form-control" id="txtB{{$b->Id}}"
                                               name="txtB{{$b->Id}}"
                                               value="txtB{{$customerplan->Id}}"> </td>
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

                        $('#txt_dealerid').change(function () {
                            $.get("{{ url('getDealerBottles')}}",
                                {option: $(this).val()},
                                function (data) {
                                    var model = $('#txt_bottleid');
                                    model.empty();

                                    $.each(data, function (index, element) {
                                        model.append("<option value='" + element.Id + "'>" + element.Name + "</option>");
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
