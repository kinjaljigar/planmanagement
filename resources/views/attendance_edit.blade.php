{{session()->put('menu',11)}}
@include('header')

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Attendance</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('attendance.list')}}">Attendance</a>
            </li>

            <li class="active">
                <strong>Edit Attendance</strong>
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
                      action="{{route('attendance.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <input type="hidden" name="txt_id" id="txt_id" value="{{$attendanc->Id}}" />
					<div class="form-group">
                        <label>Date <span style="color: red">*</span></label>

                        <input type="date" id="dtDoT" name="dtDoT" value="{{$attendanc->DoT}}" disabled="disabled"  class="form-control" placeholder="dd-mm-yyyy"/>
                    </div>

                    <div class="form-group">
                        <label>Customer Name</label>

                        <select name="txt_customerid" id="txt_customerid" class="form-control"  disabled="disabled">

                            <option value="">---Select---</option>

                            @foreach($customers as $d )

                                <option value="{{ $d->Id}}"
                                    {{$attendanc->Cust_Id==$d->Id?'Selected':''}}> {{$d->Cust_Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bottle Type</label>

                        <select name="txt_bottletype" id="txt_bottletype" class="form-control" disabled>

                            <option value="">---Select---</option>

                            @foreach($bottles as $d )

                                <option value="{{ $d->Id}}"
                                    {{$attendanc->Bottle_Type==$d->Id?'Selected':''}}> {{$d->Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>No of Bottles</label>
                        <input class="form-control" type="number" name="txt_bottlesno"
                               id="txt_bottlesno" value="{{$attendanc->No_Of_Bottle}}">
                    </div>
					<div class="form-group">
                        <label>Change On</label>
                        <select id="cmbChangeOn" name="cmbChangeOn" class="form-control">
                        	<option value="All Days">All Days</option>
                            <option value="Current Day">Current Day</option>
                        </select>
                    </div>
					<div class="form-group">
                        <label>Deposit Bottles/jugs</label>
                        <table>
                            @foreach($bottles as $b)
                                <tr>
                                    <td>{{$b->Name}}</td>
                                    <td><input type="number" class="form-control" id="txtB{{$b->Id}}"
                                               name="txtB{{$b->Id}}"
                                        value="{{$b->No_Of_Bottles}}"> </td>
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

                <script>
                    $('.date-own').datepicker({
                        minViewMode: 2,
                        format: 'yyyy'
                    });
                </script>


            </div>
        </div>
    </div>
</div>








@include('footer')
