{{session()->put('menu',23)}}
@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Attendance</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Dealer Date Wise Transaction Report</strong>

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

					<form id="frmEntry" method="post" action="{{route('rptDealerDateWiseTrans.list.Show')}}" role="form">
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
							<?php $cnt=0; ?>
                            <tr>
                                <th>Dealer Name</th>
                                @foreach($Bottle as $b)
                                	<th>{{$b->Name}}</th>
                                    <?php $cnt = $cnt+1; ?>
                                @endforeach
                            </tr>

                            </thead>

                            <tbody>

                           
							@if(is_null($Att))
                            	
                            @else
                            
	
							@foreach($Att as $a)
                                <tr>
									
                                    	<td><?php echo $a[0]; ?></td>
                                        <?php //$i=1; 
											for($i=1;$i<=$cnt;$i++)
                                        		echo '<td>' . $a[$i] . '</td>';
                                       // echo '<td><a href="ShowAttendance/' .$a[$i*2 ] . '">' . $a[$i*2-1] . ' - ' . $a[$i*2 ] .'</a> </td>';
                                   		?>
                                </tr>





                            @endforeach
							@endif


                            </tbody>

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
