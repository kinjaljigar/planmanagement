{{session()->put('menu',34)}}
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

					<form id="frmEntry" method="post" action="{{route('rptBlankAttSheet.list.Show')}}" role="form">
                    {{csrf_field()}}
                    
                    <div class="form-group">
                    	<div class="col-md-1">Area</div>
                        <div class="col-md-2">
                        	<select id="cmbArea" name="cmbArea">
                            	<option value="0">Select Area</option>
                                @foreach($Area as $a)
                                	<option value="{{$a->Id}}" {{$a->Id==$Area_Sel?'Selected':''}}>{{$a->Area_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-2"><select id="cmbType" name="cmbType">
                        	<option value="Daily" {{$Type=='Daily'?'Selected':''}} >Daily</option>
                            <option value="Monthly" {{$Type=='Monthly'?'Selected':''}} >Monthly</option>
                            </select>
                        </div>
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-3"><input type="submit" name="btnSubmit" id="btnSubmit" value="Show" /></div>
                    </div>
                    <div class="form-group">

                    <div class="table-responsive1">
						
                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
                                <th>Seq. No</th>
                                <th>Customer Name</th>
                                <?php
									for($i=1;$i<=31;$i++)
										echo '<th>' . sprintf("%02d", $i) . '</th>';
								?>
                                
                            </tr>

                            </thead>

                            <tbody>

                           
							@if(is_null($Cust_List))
                            @else
                            
	
							@foreach($Cust_List as $a)
                                <tr>
										<td>{{$a->Sequence_no}}</td>
                                    	<td>{{$a->Agency_Name}}</td>
                                        <?php $i=1; 
											for($i=1;$i<=31;$i++)
                                        		echo '<td>&nbsp; &nbsp;&nbsp;</td>';
                                        
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
