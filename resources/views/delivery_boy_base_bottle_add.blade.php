{{session()->put('menu',12)}}
@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Delivery Boy Base Bottle</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DeliveryBoyBaseBottle.list')}}">Delivery Boy Base Bottle</a>
            </li>

            <li class="active">
                <strong>Add Delivery Boy Base Bottle</strong>
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
                      action="{{route('DeliveryBoyBaseBottle.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id">
                    </div>


                    <div class="form-group">
                        <label>Delivery boy Name</label>

                        <select name="txt_deliveryboyid" id="txt_deliveryboyid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($deliveryboys as $c )

                                <option value="{{ $c->Id}}"
                                    {{old('txt_deliveryboyid')==$c->Id?'Selected':''}}> {{$c->Boy_Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Bottle Name</label>

                        <select name="txt_bottleid" id="txt_bottleid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($bottletypes as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_bottleid')==$p->Id?'Selected':''}}> {{$p->Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group"><label>Count</label>
                        <input type="number"
                               placeholder="Enter Count"
                               name="txt_count"
                               id="txt_count"
                               class="form-control"
                               value="{{old("txt_count")}}"
                               ></div>

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
