{{session()->put('menu',11)}}
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

						<a href="{{url('AddCustDailyTransaction')}}" class="btn btn-primary btn-sm">Daily Transaction</a>

                        <a href="{{url('AddAttendance')}}" class="btn btn-primary btn-sm">Monthly Transaction</a>



                    </div>

                </div>

                <div class="ibox-content">
					<form id="stringLengthForm" class="form-horizontal"

                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"

                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"

                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"

                      action="{{route('attendance_list.show')}}" method="post">

                    {{csrf_field()}}

                    

                    

                    <div class="form-group">

                        <label class="col-md-2">Area <span style="color: red">*</span></label>
						<div class="col-md-6">
                        <select name="txt_area" class="form-control"   id="txt_area" required>
							<option value="">---Select---</option>
                            @foreach($area as $p )

                                <option value="{{ $p->Id}}"
                                    {{$Area_Id==$p->Id?'Selected':''}}> {{$p->Area_Name}}</option>

                            @endforeach
                        </select>
						</div>
                        <div class="col-md-4">&nbsp;</div>
					</div>

                    <div class="form-group">

                        <label class="col-md-2">Transaction Date From:<span style="color: red">*</span></label>
						<div class="col-md-2"><input type="date" name="dtFrom" id="dtFrom" value="{{$dtFrom}}" />
                        </div>
                        <div class="col-md-1">To :
                        </div>
                        <div class="col-md-2"><input type="date" name="dtTo" id="dtTo" value="{{$dtTo}}" />
                        </div>
                        <div class="col-md-5"><input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-default" value="Show" /></div>
					</div>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Bottle Type</th>
                                <th>No Of bottle</th>
                                <th>Edit</th>
                                <th>Delete</th>



                            </tr>

                            </thead>

                            <tbody>


							@if($attendance!=null)
                            @foreach($attendance as $d)



                                <tr>


                                    <td>{{$d->Cust_Name}}</td>
									<td><?php echo date('d-m-Y',strtotime($d->DoT)); ?></td>
                                    <td>{{$d->Name}}</td>

                                    <td>{{$d->No_Of_Bottle}}</td>



                                    <td align="center"><a href="{{url('ShowAttendance/'.$d->Id . '/ListAttendance_1')}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>



                                    <td align="center"><a href="" id="delete_attendance"
                                                          data-id="{{$d->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


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
