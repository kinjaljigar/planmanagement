{{session()->put('menu',7)}}

@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Customer</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Customer</strong>

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



                        <a href="{{url('AddCustomer')}}" class="btn btn-primary btn-sm">ADD NEW</a>



                    </div>

                </div>

                <div class="ibox-content">
				<form action="{{route('customer.list.show')}}" method="post" class="form-horizontal">
                {{csrf_field()}}

					 <div class="form-group">

                        <label class="col-md-2">Area <span style="color: red">*</span></label>
						<div class="col-md-6">
                        <select name="cmbArea" class="form-control"   id="txt_area" required>
							<option value="">---Select---</option>
                            @foreach($Area as $p )

                                <option value="{{ $p->Id}}"
                                    {{$Area_Sel==$p->Id?'Selected':''}}> {{$p->Area_Name}}</option>

                            @endforeach
                        </select>
						</div>
                        <div class="col-md-4"><input type="submit" value="Show" name="btnSubmit" class="btn btn-success" /></div>
					</div>

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
								<th>Sequence No</th>
                                <th>Firm Name</th>
                                <th>Customer Name</th>
								<th>20 L Jug Party Stock</th>
                                <th>20 L Bot Party Stock</th>
                                <th>Area</th>
                                <th>Plan</th>
                                <th>No.Of Bottles</th>
                                <th>Rate/Bottle</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>

                            </thead>

                            <tbody>



                            @foreach($customer as $d)



                                <tr>

									<td>{{$d->Sequence_no}}</td>
                                    <td>{{$d->Agency_Name}}</td>

                                    <td>{{$d->Cust_Name}}</td>
									<td>{{$d->Jug_20L}}</td>
                                    <td>{{$d->Bot_20L}}</td>
                                    <td>{{$d->Area_Name}}</td>
									<td>{{$d->Plan}}</td>
                                    <td>{{$d->No_Bottle}}</td>
                                    <td>{{$d->Rate}}</td>
                                    
                                    <td>{{$d->Phone_No}}</td>
                                    <td>{{$d->Address}}</td>
									<td align="center"><a href="{{url('showCustomer/'.$d->Id)}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>


                                    {{-- <td align="center"><a href="{{url('DeleteCustomer/'.$d->Id)}}">
                                             <i class="fa fa-trash" style="font-size: large"></i></a></td>--}}

                                    <td align="center"><a href="" id="delete_customer"
                                                          data-id="{{$d->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


                                </tr>





                            @endforeach


                            </tbody>

                            
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
                                    columns: [0,1,2,3,4,5,6,7,8]
                                }},

                            {extend: 'csv',title:'Customer List',exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8]
                                }},

                            {extend: 'excel',title:'Customer List',exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8]
                                }},

                            {extend: 'pdf',title:'Customer list',exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8]
                                }},



                            {extend: 'print',title:'Customer List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    columns: [0,1,2,3,4,5,6,7,8]
                                }

                            }

                        ]



                    });



                });



            </script>





            <script>

                $(document).on('click', '#delete_customer', function (e) {
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
                                url: "{{url('DeleteCustomer')}}",
                                data: {_token: CSRF_TOKEN, id: id1},
                                dataType: 'JSON',
                                success: function (msg) {
                                    alert('Success');
                                    if (msg.status === 'success') {
                                        toastr.success(msg.msg);

                                        window.location.reload();

                                    }else if(msg.status === 'failed'){

                                        toastr.error(msg.msg);
                                    }

                                },

                                error: function (data) {
                                    alert('fail');
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
