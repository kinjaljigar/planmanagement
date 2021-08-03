{{session()->put('menu',45)}}
@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Customer List</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Customer List</strong>

            </li>

        </ol>



    </div>

    <div class="col-lg-2">



    </div>

</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    @include('flash-message')

                </div>

                <div class="ibox-content">
					<form id="stringLengthForm" class="form-horizontal"

                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"

                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"

                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"

                      action="{{route('CustInvAreaWise.list.show')}}" method="post">

                    {{csrf_field()}}

                    

                    

                    <div class="form-group">

                        <label class="col-md-2">Area <span style="color: red">*</span></label>
						<div class="col-md-4">
                        <select name="cmbArea" class="form-control"   id="cmbArea" required>
							<option value="0">--- All Areas ----</option>
                            @foreach($Area as $p )

                                <option value="{{$p->Id}}"
                                    {{$Area_Sel==$p->Id?'Selected':''}} >{{$p->Area_Name}}</option>

                            @endforeach
                        </select>
						</div>
                        <div class="col-md-2"><label> </label></div>
                        <div class="col-md-4"><input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-default" value="Show" /></div>
					</div>

                    
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>Firm Name</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Pay</th>
                                
                            </tr>

                            </thead>

                            <tbody>


							@if($Cust_List!=null)
                            @foreach($Cust_List as $d)
                            	<?php
									$Amt=0;
									if($d->Bill_Amt<>null)
										$Amt = $d->Bill_Amt;
									if($d->Paid_Amt<>null)
										$Amt = $Amt - $d->Paid_Amt;
									if($d->Discount_Amt<>null)
										$Amt = $Amt - $d->Discount_Amt;
								?>
                                <tr>
                                    <td>{{$d->Agency_Name}}</td>
									<td>{{$d->Cust_Name}}</td>

                                    <td><?php echo $Amt; ?></td>
									<td align="center"><a href="{{url('CustomerPaymentCollection/'.$d->Id)}}" >
                                            <i class="fa fa-money" style="font-size: large"></i></a></td>

                                </tr>
                            @endforeach
							@endif


                            </tbody>

                            <!--<tfoot>

                            <tr>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Bottle Type</th>
                                <th>No Of bottle</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            </tfoot>
-->
                        </table>

                    </div>

				</form>

                </div>

            </div>



            <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>





            <!-- Page-Level Scripts -->

            <script>

                $(document).ready(function(){

                    $('.dataTables-example').DataTable({

                        "bPaginate": false,

                        responsive: true,

                        dom: '<"html5buttons"B>lTfgitp',

                        buttons: [

                            { extend: 'copy',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'csv',title:'Delivery Boy List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'excel',title:'Delivery Boy List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'pdf',title:'Delivery Boy list',exportOptions: {
                                    columns: [0,1,2]
                                }},



                            {extend: 'print',title:'Delivery Boy List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    columns: [0,1,2]
                                }

                            }

                        ]



                    });



                });



            </script>





            <script>

                $(document).on('click', '#delete_attendance', function (e) {

                    e.preventDefault();

                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    var id1 = $(this).data('id');

                    swal({

                            title: "Are you sure!",

                            type: "error",

                            confirmButtonClass: "btn-danger",

                            confirmButtonText: "Yes!",

                            showCancelButton: true,

                        },

                        function () {

                            $.ajax({



                                type: "POST",

                                url: "{{url('DeleteAttendance')}}",

                                data: {_token: CSRF_TOKEN, id: id1},

                                dataType: 'JSON',

                                success: function (msg) {

                                    if (msg.status === 'success') {

                                        toastr.success(msg.msg);


                                        window.location.reload();


                                    }else if(msg.status === 'failed'){

                                        toastr.error(msg.msg);
                                    }

                                },

                                error: function (data) {

                                    if (data.status === 'failed') {

                                        toastr.error(data.msg);

                                    }

                                }

                            });

                        });

                });


            </script>



        </div>

    </div>





@include('footer')
