{{session()->put('menu',20)}}
@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Dealer Plan Relation</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DealerPlanRel.list')}}">Dealer Plan Relation</a>
            </li>

            <li class="active">
                <strong>Edit Dealer Plan Relation</strong>
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
                      action="{{route('DealerPlanRel.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" value="{{$dlrplanrel->Id}}" name="txt_id">
                    </div>


                    <div class="form-group">
                        <label>Dealer Name</label>

                        <select name="txt_dealerid" id="txt_dealerid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($dealers as $d)

                                <option value="{{ $d->Id}}"
                                    {{$dlrplanrel->Dealer_Id==$d->Id?'Selected':''}}> {{$d->Dealer_Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Bottle Name</label>

                        <select name="txt_bottleid" id="txt_bottleid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($bottles as $p )

                                <option value="{{ $p->Id}}"
                                    {{$dlrplanrel->Bottle_Id==$p->Id?'Selected':''}}>{{$p->Name}}</option>

                            @endforeach

                        </select>
                    </div>


                    <div class="form-group"><label>Rate</label>
                        <input type="number"
                               placeholder="Enter Rate"
                               name="txt_rate"
                               class="form-control"
                               value="{{$dlrplanrel->Rate}}"
                               required></div>

                    <div class="form-group"><label>No Of Bottle</label>
                        <input type="number"
                               placeholder="Enter No Of Bottle"
                               name="txt_noofbotttle"
                               class="form-control"
                               value="{{$dlrplanrel->No_of_bottle}}"
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
