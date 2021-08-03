{{session()->put('menu',21)}}

@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Dealer Daily Transaction</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Dealer Daily Transaction</strong>

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



                        <a href="{{url('AddDeaDailyTran')}}" class="btn btn-primary btn-sm">ADD NEW</a>



                    </div>

                </div>

                <div class="ibox-content">



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>Date</th>
                                <th>Dealer Name</th>
                                <th>Bottle Type</th>
                                <th>No Of Bottle</th>
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>

                            </thead>

                            <tbody>



                            @foreach($DeaDailyTran as $cp)



                                <tr>


                                    <td><?php echo date('d-m-Y',strtotime($cp->DoT)); ?></td>
                                    <td>{{$cp->Dealer_Name}}</td>
                                    <td>{{$cp->Name}}</td>
                                    <td>{{$cp->No_Of_Bottle}}</td>


                                    <td align="center"><a href="{{url('ShowDeaDailyTran/'.$cp->Id)}}" >
                                            <i class="fa fa-edit" style="font-size: large"></i></a></td>


                                    {{--<td align="center"><a href="{{url('DeleteCustomerPlan/'.$cp->Id)}}">
                                            <i class="fa fa-trash" style="font-size: large"></i></a></td>--}}

                                    <td align="center"><a href="" id="delete_dealer_daily_transaction"
                                                          data-id="{{$cp->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>


                                </tr>





                            @endforeach



                            </tbody>

                           <!--<tfoot>

                            <tr>



                                <th>Date</th>
                                <th>Dealer Name</th>
                                <th>Bottle Type</th>
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
                                    columns: [0,1,2,3]
                                }},

                            {extend: 'csv',title:'Dealer Daily Transaction List',exportOptions: {
                                    columns: [0,1,2,3]
                                }},

                            {extend: 'excel',title:'Dealer Daily Transaction List',exportOptions: {
                                    columns: [0,1,2,3]
                                }},

                            {extend: 'pdf',title:'Dealer Daily Transaction list',exportOptions: {
                                    columns: [0,1,2,3]
                                }},



                            {extend: 'print',title:'Dealer Daily Transaction List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    columns: [0,1,2,3]
                                }

                            }

                        ]



                    });



                });



            </script>





            <script>

                $(document).on('click', '#delete_dealer_daily_transaction', function (e) {

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

                                url: "{{url('DeleteDeaDailyTran')}}",

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
