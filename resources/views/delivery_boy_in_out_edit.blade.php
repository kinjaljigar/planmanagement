{{session()->put('menu',15)}}
@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Delivery Boy In Out</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DelBoyInOut.list')}}">Delivery Boy In Out</a>
            </li>

            <li class="active">
                <strong>Edit Delivery Boy In Out</strong>
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
                      action="{{route('DelBoyInOut.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <input type="hidden" name="txt_id" value="{{$DelBoyinout->Id}}">

                    <div class="form-group"><label>Date</label>

                        <input type="date"
                               value="{{$DelBoyinout->DoT}}"
                               id="dt_dot" name="dt_dot"
                               class="form-control" required placeholder="dd-mm-yyyy">

                    </div>

                    <div class="form-group">
                        <label>Delivery boy Name</label>

                        <select name="txt_deliveryboyid" id="txt_deliveryboyid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($deliveryboys as $c )

                                <option value="{{ $c->Id}}"
                                    {{$DelBoyinout->Delivery_Boy_Id==$c->Id?'Selected':''}}> {{$c->Boy_Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    {{--<div class="form-group">
                        <label>Bottle Name</label>

                        <select name="txt_bottleid" id="txt_bottleid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($bottles as $p )

                                <option value="{{ $p->Id}}"
                                    {{$DelBoyinout->Bottle_Type_Id==$p->Id?'Selected':''}}> {{$p->Name}}</option>

                            @endforeach

                        </select>
                    </div>--}}

                    <div class="form-group">
                        <label>In/Out</label>
                        <select name="txt_inout" id="txt_inout" class="form-control">
                            <option value="-1">---Select---</option>
                            <option {{$DelBoyinout->In_Out=="In"?'Selected':''}}>In</option>
                            <option {{$DelBoyinout->In_Out=="Out"?'Selected':''}}>Out</option>

                        </select>
                    </div>



                    <div class="form-group">
                        <table>
                            @foreach($bottles as $p)
                                <tr>
                                    <td>{{$p->Name}}</td>
                                    <td><input type="text" class="form-control" id="txt_bottleid"
                                               name="txt_bottleid"
                                               value="{{$p->Count}}"> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>





                    {{--<div class="form-group"><label>In Out</label>
                        <input type="text"
                               placeholder="Enter In Out"
                               name="txt_inout"
                               id="txt_inout"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$DelBoyinout->In_Out}}"
                        ></div>

                    <div class="form-group"><label>Count</label>
                        <input type="number"
                               placeholder="Enter Count"
                               name="txt_count"
                               id="txt_count"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$DelBoyinout->Count}}"
                        ></div>



                    <div class="form-group"><label>Full Empty</label>
                        <input type="text"
                               placeholder="Enter Full Empty"
                               name="txt_fullempty"
                               id="txt_fullempty"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$DelBoyinout->Full_Empty}}"
                        ></div>
--}}


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


            </div>
        </div>
    </div>
</div>








@include('footer')
