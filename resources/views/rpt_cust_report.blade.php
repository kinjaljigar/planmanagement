{{session()->put('menu',35)}}
@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Attendance</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Attendance</strong>

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

					<form id="frmEntry" method="post" action="{{route('rptCustReport.list.Show')}}" role="form">
                    {{csrf_field()}}
                    
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
                                <th>Customer Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Plan</th>
                                <th>Delivery Boy</th>
                                <th>Area</th>
                            </tr>

                            </thead>

                            <tbody>

                           	<?php $i=1; ?>
							@if(is_null($Cust_List))
                            @else
                            
	
							@foreach($Cust_List as $a)
                                <tr>
										<td><?php echo $i; $i=$i+1; ?></td>
                                    	<td>{{$a->Agency_Name}}</td>
                                        <td>{{$a->Start_Date}}</td>
                                        <td>{{$a->DoD}}</td>
                                        <td>{{$a->Plan}}</td>
                                        <td>{{$a->DeliveryBoy}}</td>
                                        <td>{{$a->Area}}</td>
                                </tr>





                            @endforeach
							@endif
                            </tbody>

                           <!--<tfoot>

                            <tr>
                                <<th>No</th>
                                <th>Customer Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Plan</th>
                                <th>Delivery Boy</th>
                                <th>Area</th>
                            </tr>
                            </tfoot>
-->
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
