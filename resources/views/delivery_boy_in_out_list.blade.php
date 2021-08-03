{{session()->put('menu',15)}}

@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Delivery Boy In Out</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Delivery Boy In Out</strong>

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



                        <a href="{{url('AddDelBoyInOut')}}" class="btn btn-primary btn-sm">ADD NEW</a>



                    </div>

                </div>

                <div class="ibox-content">



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
								<th>Date</th>
                                <th>Delivery Boy Name</th>
                                <th>Bottle Name</th>
                                <th>In/Out</th>
                                <th>No. of Bottles</th>
                                <th>Edit</th>
                                <th>Delete</th>



                            </tr>

                            </thead>

                            <tbody>



                            @foreach($DelBoyInOut as $d)



                                <tr>

									<td><?php echo date('d-m-Y',strtotime($d->DoT)); ?></td>
                                    <td>{{$d->Boy_Name}}</td>

                                    <td>{{$d->Name}}</td>
									<td>{{$d->In_Out}}</td>
                                    <td>{{$d->Count}}</td>



                                    <td align="center"><a href="{{url('ShowDelBoyInOut/'.$d->Id)}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>


                                    {{--<td align="center"><a href="{{url('DeleteDealerPlanRel/'.$d->Id)}}">
                                            <i class="fa fa-trash" style="font-size: large"></i></a></td>--}}

                                    <td align="center"><a href="" id="delete_delivery_boy_in_out"
                                                          data-id="{{$d->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


                                </tr>





                            @endforeach



                            </tbody>

                            <!--<tfoot>

                            <tr>
								<th>Date</th>
                                <th>Delivery Boy Name</th>
                                <th>Bottle Name</th>
                                <th>In/Out</th>
                                <th>No. of Bottles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            </tfoot>-->

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
						ordering: false,
                        responsive: true,

                        dom: '<"html5buttons"B>lTfgitp',

                        buttons: [

                            { extend: 'copy',exportOptions: {
                                    columns: [0,1,2,3,4]
                                }},

                            {extend: 'csv',title:'Delivery Boy In Out List',exportOptions: {
                                    columns: [0,1,2,3,4]
                                }},

                            {extend: 'excel',title:'Delivery Boy In Out List',exportOptions: {
                                    columns: [0,1,2,3,4]
                                }},

                            {extend: 'pdf',title:'Delivery Boy In Out list',exportOptions: {
                                    columns: [0,1,2,3,4]
                                }},



                            {extend: 'print',title:'Delivery Boy In Out List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    columns: [0,1,2,3,4]
                                }

                            }

                        ]



                    });



                });



            </script>





            <script>

                $(document).on('click', '#delete_delivery_boy_in_out', function (e) {

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

                                url: "{{url('DeleteDelBoyInOut')}}",

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
