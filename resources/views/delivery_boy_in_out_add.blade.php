{{session()->put('menu',15)}}
@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Delivery Boy In Out</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DelBoyInOut.list')}}">Delivery Boy In Out</a>
            </li>

            <li class="active">
                <strong>Add Delivery Boy In Out</strong>
            </li>
        </ol>

    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12"><h3 class="m-t-none m-b"></h3>

                <form id="stringLengthForm" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"
                      action="{{route('DelBoyInOut.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')



                    <div class="form-group"><label class="col-md-2">Date</label>
						<div class="col-md-4">
                        <input type="date"
                               value="<?php echo date('Y-m-d'); ?>"
                               id="dt_dot" name="dt_dot"
                               class="form-control" required placeholder="dd-mm-yyyy">
						</div>
                    </div>
					<!--<div class="form-group">
                        <label class="col-md-2">In/Out</label>
                        <div class="col-md-4">
                        <select name="txt_inout" id="txt_inout" class="form-control">
                            <option value="-1">---Select---</option>
                            <option {{old('txt_inout')=="In"?'Selected':''}}>In</option>
                            <option {{old('txt_inout')=="Out"?'Selected':''}}>Out</option>

                        </select>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <div class="col-md-1"> &nbsp;</div>
                        <div class="col-md-11">
                            <table class="table">
                                <tr>
                                    <th><p style="color:red">Bottle Type</p></th>
                                    @foreach($bottles as $p)

                                        <th>{{$p->Name}}</th>

                                    @endforeach
                                </tr>
                                    @foreach($deliveryboys as $c )
										<tr>
                                        <td>{{$c->Boy_Name}} - Out</td>
										@foreach($bottles as $p)

                                            <td><input type="text" class="form-control" id="txt_nof[]"
                                                   name="txt_nof[]"
                                                   value="0" requiredx size="15"> </td>
    
                                        @endforeach
                                        <!--<td></td>-->
                                        </tr>
                                        <tr>
                                        <td>{{$c->Boy_Name}} - In</td>
										@foreach($bottles as $p)

                                            <td><input type="text" class="form-control" id="txt_nof[]"
                                                   name="txt_nof[]"
                                                   value="0" requiredx size="15"> </td>
    
                                        @endforeach
                                        <!--<td></td>-->
                                        </tr>
                                        
                                    @endforeach
                                </tr>
                            </table>
                        </div>

                    </div>


                   {{-- <div class="form-group">
                        <label>Delivery boy Name</label>

                        <select name="txt_deliveryboyid" id="txt_deliveryboyid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($deliveryboys as $c )

                                <option value="{{ $c->Id}}"
                                    {{old('txt_deliveryboyid')==$c->Id?'Selected':''}}> {{$c->Boy_Name}}</option>

                            @endforeach

                        </select>
                    </div>
--}}
                    





                    {{--<div class="form-group">
                        <table>
                            @foreach($bottles as $p)
                                <tr>
                                    <td>{{$p->Name}}</td>
                                    <td><input type="text" class="form-control" id="txt_bottleid{{$p->Id}}"
                                               name="txt_bottleid{{$p->Id}}"
                                               value="{{old('txt_bottleid')}}"> </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>--}}




                   {{-- <div class="form-group"><label>Count</label>
                        <input type="number"
                               placeholder="Enter Count"
                               name="txt_count"
                               id="txt_count"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_count')}}"
                        ></div>


                    <div class="form-group"><label>Full Empty</label>
                        <input type="text"
                               placeholder="Enter Full Empty"
                               name="txt_fullempty"
                               id="txt_fullempty"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_fullempty')}}"
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
