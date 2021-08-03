{{session()->put('menu',14)}}
@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Delivery Boy Area Relation</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DelBoyAraRel.list')}}">Delivery Boy Area Relation</a>
            </li>

            <li class="active">
                <strong>Edit Delivery Boy Area Relation</strong>
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
                      action="{{route('DelBoyAreaRel.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" value="{{$dlrplanrel->Id}}" name="txt_id">
                    </div>


                    <div class="form-group">
                        <label>Delivery boy Name</label>

                        <select name="txt_deliveryboyid" id="txt_deliveryboyid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($deliveryboys as $c )

                                <option value="{{ $c->Id}}"
                                    {{$dlrplanrel->Delivery_Boy_Id==$c->Id?'Selected':''}}> {{$c->Boy_Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group"><label>Date</label>

                        <input type="date"
                               value="{{$dlrplanrel->DoA}}"
                               id="dt_doa" name="dt_doa"
                               class="form-control"/>

                    </div>


                    {{--<div class="form-group">
                        <label>Area Name</label>

                        <select name="txt_areaid" id="txt_areaid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($area as $p )

                                <option value="{{ $p->Id}}"
                                    {{$dlrplanrel->Area_Id==$p->Id?'Selected':''}}> {{$p->Area_Name}}</option>

                            @endforeach

                        </select>
                    </div>--}}


                    <div class="form-group">


                        @foreach($area as $p )

                            <input type="checkbox" name="txt_areaid" id="txt_areaid" class="form-check-input"
                                   value="{{$dlrplanrel->Area_Id}}" {{$p->Id == true ?  : ''}}>

                            <label>{{$p->Area_Name}}</label><br>

                        @endforeach


                    </div>




                    <div class="form-group">


                        <input type="checkbox" id="chk_isActive" name="chk_isActive" {{$dlrplanrel->isActive==true?'checked':''}}/>


                        <label>isActive</label>


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


            </div>
        </div>
    </div>
</div>








@include('footer')
