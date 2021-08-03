{{session()->put('menu',27)}}

@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Collectors</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Collector</strong>

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



                        <a href="{{url('AddCollector')}}" class="btn btn-primary btn-sm">ADD NEW</a>



                    </div>

                </div>

                <div class="ibox-content">



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
								<th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>

                                <th>Birth Date</th>
                                <th>Anniversary</th>
                                <th>Email</th>
                                <th>User Name</th>
                                
                                <th>Generate/Delete User</th>
                                
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>

                            </thead>

                            <tbody>



                            @foreach($collector as $d)



                                <tr>

									<td>{{$d->Name}}</td>
                                    <td>{{$d->Phone}}</td>

                                    <td>{{$d->Address}}</td>

                                    <td>{{$d->DoB}}</td>
									<td>{{$d->DoA}}</td>
                                    <td>{{$d->Email}}</td>
                                    <td>{{$d->User_Name}}</td>

                                    <td align="center"><a href="{{url('CreateUserCollector/'.$d->Id)}}" id="create_user1"
                                                          data-id="{{$d->Id}}"><i
                                                class="fa fa-key" style="font-size: large"></i></a></td>
									<td align="center"><a href="{{url('ShowCollector/'.$d->Id)}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>

                                    <td align="center"><a href="" id="delete_collector"
                                                          data-id="{{$d->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


                                </tr>





                            @endforeach


                            </tbody>

                            
                        </table>

                    </div>



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

                $(document).on('click', '#delete_collector', function (e) {
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
				
				$(document).on('click', '#create_user', function (e) {
                    e.preventDefault();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var id1 = $(this).data('id');
                    swal({
                            title: "Are you sure!",
                            type: "error",
                            confirmButtonClass: "btn-default",
                            confirmButtonText: "Yes!",
                            showCancelButton: true,
                        },
                        function () {
                            $.ajax({

                                type: "POST",
                                url: "{{url('CreateUserCollector')}}",
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
