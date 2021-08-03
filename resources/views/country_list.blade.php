{{session()->put('menu',3)}}

@include('header')







<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Countries</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Countries</strong>

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
                        <a href="{{url('AddCountry')}}" class="btn btn-primary btn-sm">ADD NEW</a>

                    </div>

                </div>

                <div class="ibox-content">



                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>

                                <th>Country</th>
                                <th>Edit</th>
                                <th>Delete</th>



                            </tr>

                            </thead>

                            <tbody>



                            @foreach($country as $c)



                                <tr>

                                    <td>{{$c->Country_Name}}</td>


                        	<td align="center"><a href="{{url('ShowCountry/'.$c->Id)}}" >
                                    <i class="fa fa-edit" style="font-size: large"></i></a></td>

                        	{{--<td align="center"><a href="{{url('DeleteCountry/'.$c->Id)}}">
                                    <i class="fa fa-trash" style="font-size: large"></i></a></td--}}{{-->--}}

                                    <td align="center"><a href="" id="delete_country"
                                                          data-id="{{$c->Id}}"><i
                                                class="fa fa-trash" style="font-size: large"></i></a></td>









                                </tr>





                            @endforeach



                            </tbody>

                           <!-- <tfoot>

                            <tr>

                                <th>Country</th>
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>

                            </tfoot>
-->
                        </table>

                    </div>



                </div>

            </div>



            <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>





            <!-- Page-Level Scripts -->

            <script>

                $(document).ready(function(){

                    $('.dataTables-example').DataTable({

                        pageLength: 25,

                        responsive: true,

                        dom: '<"html5buttons"B>lTfgitp',

                        buttons: [

                            { extend: 'copy',exportOptions: {
                                    columns: [0]
                                }},

                            {extend: 'csv',title:'Countries List',exportOptions: {
                                    columns: [0]
                                }},

                            {extend: 'excel', title:'Countries List',exportOptions: {
                                    columns: [0]
                                }},

                            {extend: 'pdf', title:'Countries List',exportOptions: {
                                    columns: [0]
                                }},



                            {
                                extend: 'print',title:'Countries List',

                                customize: function (win){

                                    $(win.document.body).addClass('white-bg');

                                    $(win.document.body).css('font-size', '10px');



                                    $(win.document.body).find('table')

                                        .addClass('compact')

                                        .css('font-size', 'inherit');

                                },
                                exportOptions: {
                                    columns: [0]
                                }

                            }

                        ]



                    });



                });



            </script>



            <script>

                $(document).on('click', '#delete_country', function (e) {

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

                                url: "{{url('DeleteCountry')}}",

                                data: {_token: CSRF_TOKEN, id: id1},

                                dataType: 'JSON',

                                success: function (msg) {

                                    if (msg.status === 'success') {

                                        toastr.success(msg.msg);


                                            window.location.reload();

                                    }else if(msg.status === 'failed'){


                                        toastr.error(msg.msg);
                                    }

                                },error: function (data) {



                                    toastr.error(data);

                                    alert(data);

                                    console.log(data);



                                }

                            });

                        });

                });



            </script>



        </div>

    </div>





@include('footer')
