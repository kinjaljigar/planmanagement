{{session()->put('menu',24)}}
@include('header')

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Attendance</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('Generate.Invoice')}}">Generate Invoice</a>
            </li>

            <li class="active">
                <strong>Generate Invoie</strong>
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
                      action="{{route('Ganerate.Invoice.Store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
					<div class="form-group">
                        <label>Month <span style="color: red">*</span></label>

                        <select name="dp_month" id="dp_month" class="form-control" required >

                            <option value="">---Select---</option>

                            <option value="01"  {{$Month1=="01"?'Selected':''}}>January</option>
                            <option value="02"  {{$Month1=="02"?'Selected':''}}>Febuary</option>
                            <option value="03"  {{$Month1=="03"?'Selected':''}}>March</option>
                            <option value="04"  {{$Month1=="04"?'Selected':''}}>April</option>
                            <option value="05"  {{$Month1=="05"?'Selected':''}}>May</option>
                            <option value="06"  {{$Month1=="06"?'Selected':''}}>June</option>
                            <option value="07"  {{$Month1=="07"?'Selected':''}}>July</option>
                            <option value="08"  {{$Month1=="08"?'Selected':''}}>August</option>
                            <option value="09"  {{$Month1=="09"?'Selected':''}}>September</option>
                            <option value="10"  {{$Month1=="10"?'Selected':''}}>October</option>
                            <option value="11"  {{$Month1=="11"?'Selected':''}}>November</option>
                            <option value="12"  {{$Month1=="12"?'Selected':''}}>December</option>

                        </select>
                    </div>


                    <div class="form-group">
                        <label>Year</label>
                        <input class="form-control" type="number" name="txt_year"
                        id="txt_year" required value="{{$Year1}}">
                    </div>
					<div class="form-group">
                    	<div class="col-md-2"><label>Customer/Dealer</label></div>
                        <div class="col-md-6"><select id="cmbCustDealer" name="cmbCustDealer">
                        	<option value="Customer">Customer</option>
                            <option value="Dealer">Dealer</option>
                           </select>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                    <div class="form-group">
                    	<div class="table-responsive">
                       
                        </div>
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
