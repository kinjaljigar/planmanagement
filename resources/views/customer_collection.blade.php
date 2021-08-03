{{session()->put('menu',30)}}


@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Customer Collection</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('CustInvAreaWise.list')}}">Customer Invoice</a>
            </li>

            <li class="active">
                <strong>Customer Collection</strong>
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
                      action="{{route('CustomerPaymentCollection.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <?php //$Inv_Details = $Inv_Details1[0];?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id" value="{{$Inv_Details->Id}}">
                    </div>


                    <div class="form-group"><label class="col-md-2">Agency Name <span style="color: red">*</span></label>
                    <label class="col-md-4" >{{$Inv_Details->Agency_Name}}</label>
                        
						<div class="col-md-6">&nbsp;</div>
					</div>
                    <div class="form-group"><label class="col-md-2">Customer Name <span style="color: red">*</span></label>
                    	<label class="col-md-4">{{$Inv_Details->Cust_Name}}</label>
                        <div class="col-md-6">&nbsp;</div>
                    </div>

					<div class="form-group"><label class="col-md-2">Bill Amount</label>
                    	<label class="col-md-4">{{$Inv_Details->Amount}}</label>
                        <div class="col-md-6">&nbsp;</div>
                    </div>
                    <div class="form-group"><label class="col-md-2">Total Pending</label>
                    	<label class="col-md-4">{{$Total_Pending}}</label>
                        <div class="col-md-6">&nbsp;</div>
                    </div>
                    <div class="form-group"><label class="col-md-2">Date</label>
                    	<div class="col-md-4"><input type="date" id="txt_Date" name="txt_Date" value="{{$DoT}}" /></div>
                        <div class="col-md-6">&nbsp;</div>
                    </div>
                    <div class="form-group"><label class="col-md-2">Amount to Pay</label>
                    	<div class="col-md-4"><input type="number" class="form-control" name="txtAmount" id="txtAmount" required /></div>
                        <div class="col-md-6">&nbsp;</div>
                    </div>
                    <div class="form-group"><label class="col-md-2">Kasar</label>
                    	<div class="col-md-4"><input type="number" class="form-control" name="txtDiscount" id="txtDiscount" value="0"/></div>
                        <div class="col-md-6">&nbsp;</div>
                    </div>

                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                            type="submit" id="saveRecord"><strong>Collect</strong>
                                    </button>





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
