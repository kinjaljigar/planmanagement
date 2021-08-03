{{session()->put('menu',10)}}

@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Customer Plan Bottle Allocated</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Customer Plan Bottle Allocated</strong>

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



                        <a href="{{url('AddCustPlanBottleAlloc')}}" class="btn btn-primary btn-sm">ADD NEW</a>



                    </div>

                </div>

                <div class="ibox-content">



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>Customer Plan</th>
                                <th>Bottle Name</th>
                                <th>No Of Bottle</th>
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>

                            </thead>

                            <tbody>



                            @foreach($CustPlanBottleAlloc as $cp)



                                <tr>


                                    <td>{{$cp->Cust_Name}}</td>
                                    <td>{{$cp->Name}}</td>
                                    <td>{{$cp->No_Of_Bottles}}</td>


                                    <td align="center"><a href="{{url('ShowCustPlanBottleAlloc/'.$cp->Id)}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>

                                    <td align="center"><a href="" id="delete_customer_plan_bottle_allocated"
                                                          data-id="{{$cp->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


                                </tr>





                            @endforeach



                            </tbody>

                            <!--<tfoot>

                            <tr>



                                <th>Customer Plan</th>
                                <th>Bottle Name</th>
                                <th>No Of Bottle</th>
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

                        responsive: true,

                        dom: '<"html5buttons"B>lTfgitp',

                        buttons: [

                            { extend: 'copy',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'csv',title:'Customer plan Bottle Allocated List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'excel',title:'Customer plan Bottle Allocated List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'pdf',title:'Customer plan Bottle Allocated List',exportOptions: {
                                    columns: [0,1,2,]
                                }},



                            {extend: 'print',title:'Customer plan Bottle Allocated List',

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

                $(document).on('click', '#delete_customer_plan_bottle_allocated', function (e) {

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

                                url: "{{url('DeleteCustPlanBottleAlloc')}}",

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
