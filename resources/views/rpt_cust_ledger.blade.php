{{session()->put('menu',46)}}
@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Customer Ledger</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Customer Ledger</strong>

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

                    <div class="ibox-tools">

						


                    </div>

                </div>

                <div class="ibox-content">

					<form id="frmEntry" method="post" action="{{route('rptCustLedger.Show')}}" role="form" class="form-horizontal"> 
                    {{csrf_field()}}
                    <div class="form-group">
                    	<label class="col-md-2">Area</label>
                    	<div class="col-md-6">
                        	<select name="cmbArea" id="cmbArea" required class="form-control">
                            	<option value="">--- Select Area---</option>
                                @foreach($Area as $a)
                                	<option value="{{$a->Id}}" {{$a->Id==$Area_Sel?'Selected':''}} >{{$a->Area_Name}}</option>
                                @endforeach
                        	</select>
                        </div>
                        <div class="col-md-4"><label></label></div>
                    </div>
                    <div class="form-group">
                    	<label class="col-md-2">Customer</label>
                    	<div class="col-md-6">
                        	<select name="cmbCust" id="cmbCust" required class="form-control">
                            	<option value="">--- Select Customer ---</option>
                                @foreach($cust as $c)
                                	<option value="{{$c->Id}}" {{$c->Id==$Cust_Sel?'Selected':''}} >
                                    {{$c->Agency_Name}} - {{$c->Cust_Name}}</option>
                                @endforeach
                        	</select>
                        </div>
                        <div class="col-md-4"><label></label></div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-2">From Date</div>
                        <div class="col-md-2"><input type="date" id="dtFrom" name="dtFrom" class="from-control" value="{{$dtFrom}}" placeholder="dd/mm/yyyy"/> </div>
                        <div class="col-md-2">&nbsp; To Date:</div>
                        <div class="col-md-2"><input type="date" id="dtTo" name="dtTo" class="from-control" value="{{$dtTo}}" placeholder="dd/mm/yyyy" /> </div>
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-1"><input type="submit" name="btnSubmit" id="btnSubmit" value="Show" class="btn btn-primary" /></div>
                    </div>
                    
                    <div class="form-group">

                    <div class="table-responsive1">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
                            	<th>No</th>
                                <th>Date</th>
                                <th>Remark</th>
                                <th>Dr Amount</th>
                                <th>Cr Amount</th>
                                
                            </tr>

                            </thead>

                            <tbody>

                           	<?php 
								$i=1; 
								$Dr_Total =0;
								$Cr_Total=0;
							?>
							@if(is_null($Cust_List))
                            @else
                            
		
							@foreach($Cust_List as $a)
                                <tr>
										<td><?php echo $i; $i=$i+1; ?></td>
                                    	<td>{{$a->DoT}}</td>
                                        <td>{{$a->Remark}}</td>
                                        <td>{{$a->Dr_Amount}}</td>
                                        <td>{{$a->Cr_Amount}}</td>
                                        <?php
											$Dr_Total = $Dr_Total + $a->Dr_Amount;
											$Cr_Total = $Cr_Total + $a->Cr_Amount;
										?>
                                </tr>





                            @endforeach
							@endif
                            </tbody>

                           <tfoot>
							<tr>
                            	<th></th>
                                <th></th>
                                <th>Total</th>
                                <th><?php echo $Dr_Total; ?></th>
                                <th><?php echo $Cr_Total; ?></th>
                                
                            </tr>
                            <tr>
                            	<th></th>
                                <th></th>
                                <th>Total Pending (Dr - Cr)</th>
                                <th colspan="2"><?php echo $Dr_Total - $Cr_Total; ?></th>
                                
                            </tr>
                            </tfoot>
                        </table>

                    </div>

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
                                    
                                }},

                            {extend: 'csv',title:'Attendance List',exportOptions: {
                                    
                                }},

                            {extend: 'excel',title:'Attendance List',exportOptions: {
                                    
                                }},

                            {extend: 'pdf',title:'Attendance list',exportOptions: {
                                    
                                }},



                            {extend: 'print',title:'Attendance List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    
                                }

                            }

                        ]



                    });



                });



            </script>
			<script type="text/javascript">

                    $(document).ready(function () {

                        $('#stringLengthForm').bootstrapValidator();
                       
						$('#cmbArea').change(function(){
							$.get("{{url('getCustListFrmArea')}}",
								{option:$(this).val()},
								function (data){
									var model = $('#cmbCust');
                                    model.empty();
									
                                    $.each(data, function (index, element) {
										
                                        	model.append("<option value='" + element.Id + "' >" + element.Agency_Name + " - " + element.Cust_Name + "</option>");
										
                                    });
								});
						});
                    });

				</script>




        </div>

    </div>
@include('footer')
