{{session()->put('menu',31)}}


@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Dealer</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DealerInvoice.list')}}">Invoice List</a>
            </li>

            <li class="active">
                <strong>Dealer Collection</strong>
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
                      action="{{route('DealerPaymentCollection.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id" value="{{$Inv_Details->Id}}">
                    </div>


                    <div class="form-group"><label class="col-md-4">Agency Name <span style="color: red">*</span></label>
                    <label class="col-md-4" >{{$Inv_Details->Agency_Name}}</label>
                    <div class="col-md-4">&nbsp;</div>
                        </div>


                    <div class="form-group"><label class="col-md-4">Dealer Name <span style="color: red">*</span></label>
                    	<label class="col-md-4">{{$Inv_Details->Dealer_Name}}</label>
                        </div>

					<div class="form-group"><label class="col-md-4">Bill Amount</label>
                    	<label class="col-md-4">{{$Inv_Details->Amount}}</label>
                    </div>
                    <div class="form-group"><label class="col-md-4">Previous Pending</label>
                    	<label class="col-md-4"><?php $tmp1 = $Total_Pending->amt - $Inv_Details->Amount;
							echo $tmp1; ?></label>
                    </div>
                    <div class="form-group"><label class="col-md-4">Total Pending</label>
                    	<label class="col-md-4">{{$Total_Pending->amt}}</label>
                    </div>
                    <div class="form-group"><label class="col-md-4">Date</label>
                    	<div class="col-md-4"><input type="date" id="txt_Date" name="txt_Date" value=<?php echo date('Y-m-d'); ?> /></div>
                    </div>
                    <div class="form-group"><label class="col-md-4">Amount to Pay</label>
                    	<div class="col-md-4"><input type="number" class="form-control" name="txtAmount" id="txtAmount" required /></div>
                    </div>
                    <div class="form-group"><label class="col-md-4">Kasar</label>
                    	<div class="col-md-4"><input type="number" class="form-control" name="txtDiscount" id="txtDiscount" value="0"/></div>
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
