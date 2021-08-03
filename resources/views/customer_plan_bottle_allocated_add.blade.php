{{session()->put('menu',10)}}
@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Customer Plan Bottle Allocated</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('CustPlanBottleAlloc.list')}}">Customer Plan Bottle Allocated</a>
            </li>

            <li class="active">
                <strong>Customer Plan Bottle Allocated</strong>
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
                      action="{{route('CustPlanBottleAlloc.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')



                    <div class="form-group">
                        <label>Customer Plan Name</label>

                        <select name="txt_customerplanid" id="txt_customerplanid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($customers as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_customerplanid')==$p->Id?'Selected':''}}>{{$p->name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Bottle Name</label>

                        <select name="txt_bottleid" id="txt_bottleid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($bottles as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_bottleid')==$p->Id?'Selected':''}}>{{$p->Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group"><label>Number Of Bottle</label>
                        <input type="number"
                               placeholder="Enter Number Of Bottle"
                               name="txt_bottleno"
                               id="txt_bottleno"
                               class="form-control"
                               value="{{old("txt_bottleno")}}"
                               required></div>



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
