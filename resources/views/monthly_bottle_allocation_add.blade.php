

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Monthly Bottle Allocation</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('MonBoyAll.list')}}">Monthly Bottle Allocation</a>
            </li>

            <li class="active">
                <strong>Add Monthly Bottle Allocation</strong>
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
                      action="{{--{{route('MonBoyAll.store')}}--}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id">
                    </div>

                    <div>
                        <div>

                            <div class="form-group">
                                <label>Customer <span style="color: red">*</span></label>

                                <select name="txt_customerid" class="form-control"   id="txt_customerid" required>

                                    <option value="">---Select---</option>

                                    <option value="1"  {{old("txt_customerid")=="1"?'Selected':''}}>1</option>
                                    <option value="2"  {{old("txt_customerid")=="2"?'Selected':''}}>2</option>
                                    <option value="3"  {{old("txt_customerid")=="3"?'Selected':''}}>3</option>
                                    <option value="4"  {{old("txt_customerid")=="4"?'Selected':''}}>4</option>
                                    <option value="5"  {{old("txt_customerid")=="5"?'Selected':''}}>5</option>


                                </select>

                            </div>


                            <div class="form-group"><label>Date of Transaction <span style="color: red">*</span></label>

                                <input type="date" value="option1" name="dt_transaction" class="form-control"  required/>

                            </div>

                            <div class="form-group">
                                <label>Number Of Bottle <span style="color: red">*</span></label>

                                <select name="txt_noofbottle" class="form-control"   id="txt_noofbottle" required>

                                    <option value="">---Select---</option>

                                    <option value="1"  {{old("txt_noofbottle")=="1"?'Selected':''}}>1</option>
                                    <option value="2"  {{old("txt_noofbottle")=="2"?'Selected':''}}>2</option>
                                    <option value="3"  {{old("txt_noofbottle")=="3"?'Selected':''}}>3</option>
                                    <option value="4"  {{old("txt_noofbottle")=="4"?'Selected':''}}>4</option>
                                    <option value="5"  {{old("txt_noofbottle")=="5"?'Selected':''}}>5</option>


                                </select>

                            </div>

                            <div class="form-group">
                                <label>Bottle Type <span style="color: red">*</span></label>

                                <select name="txt_bottletype" class="form-control"   id="txt_bottletype" required>

                                    <option value="">---Select---</option>

                                    <option value="1"  {{old("txt_bottletype")=="1"?'Selected':''}}>1</option>
                                    <option value="2"  {{old("txt_bottletype")=="2"?'Selected':''}}>2</option>
                                    <option value="3"  {{old("txt_bottletype")=="3"?'Selected':''}}>3</option>
                                    <option value="4"  {{old("txt_bottletype")=="4"?'Selected':''}}>4</option>
                                    <option value="5"  {{old("txt_bottletype")=="5"?'Selected':''}}>5</option>


                                </select>

                            </div>

                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="submit" id="saveRecord"><strong>Save</strong>
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

                <script type="text/javascript">





                    $(document).ready(function () {

                        $('#stringLengthForm').bootstrapValidator();

                    });





                </script>


            </div>
        </div>
    </div>
</div>








@include('footer')
