{{session()->put('menu',9)}}
@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Customer Boy Daily Relation</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('CusBoyDailyRel.list')}}">Customer Boy Daily Relations</a>
            </li>

            <li class="active">
                <strong>Edit Customer Boy Daily Relations</strong>
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
                      action="{{route('CusBoyDailyRel.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')


                    <input type="hidden" name="txt_id" value="{{$CusBoyDailyRel->Id}}">


                    {{--<div class="form-group">
                        <label>Customer Name</label>

                        <select name="txt_customerid" id="txt_customerid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($customer as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_customerid')==$p->Id?'Selected':''}}> {{$p->Cust_Name}}</option>

                            @endforeach

                        </select>
                    </div>--}}


                    <div class="form-group">
                        <label>Delivery boy Name</label>

                        <select name="txt_deliveryboyid" id="txt_deliveryboyid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($deliveryboys as $c )

                                <option value="{{ $c->Id}}"
                                    {{$CusBoyDailyRel->Delivery_Boy_Id==$c->Id?'Selected':''}}> {{$c->Boy_Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">


                        @foreach($customer as $p )

                            <input type="checkbox" name="txt_customerid{{$p->Id}}"
                                   id="txt_customerid{{$p->Id}}"
                                   class="form-check-input"
                                   value="{{$CusBoyDailyRel->Customer_Id}}" {{$p->Id == true ?  : ''}}>

                            <label>{{$p->Cust_Name}}</label><br>

                        @endforeach


                    </div>


                    {{--<div class="form-group">


                        @foreach($area as $p )

                            <input type="checkbox" name="txt_areaid" id="txt_areaid" class="form-check-input"
                                   value="{{$p->Id}}" {{$p->Id == true ? 'checked' : ''}}>

                            <label>{{$p->Area_Name}}</label><br>

                        @endforeach


                    </div>--}}






                    <div class="form-group"><label>Date</label>

                        <input type="date"
                               value="{{$CusBoyDailyRel->DoA}}"
                               id="dt_doa" name="dt_doa"
                               class="form-control" required>

                    </div>


                    <div class="form-group">


                        <input type="checkbox" name="chk_isActive" {{old("chk_isActive")==true?'checked':''}}/>

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
