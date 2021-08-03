@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Attendance</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Customer Invoice</strong>

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
                    <table border="1" width="500">
                    	<tr>
                        	<td colspan="3" align="center"><strong>SFOUR</strong></td>
                        </tr>
                        <tr>
                        	<td width="20%">Invoice No : </td>
                            <td width="50%">{{$Invoice->Invoice_No}}</td>
                            <td width="30%">Date : {{$Invoice->DoI}}</td>
                        </tr>
                        <tr>
                        	<td>Dealer Name : </td>
                            <td colspan="2">{{$Cust->Agency_Name}} / {{$Cust->Cust_Name}}</td>
                            
                        </tr>
                        <tr>
                        	<td>GST No : </td>
                            <td colspan="2">{{$Dealer->GST_No}}</td>
                            
                        </tr>
                        <tr>
                        	<td colspan="3"><table width="100%" border="1">
                            	<tr>
                                	<td width="40%">Bottle Type</td>
                                    <td width="20%">Qty</td>
                                    <td width="20%">Rate</td>
                                    <td width="20%">Amount</td>
                                </tr>
                                @foreach($Invoice_Detail as $i)
                            	<tr>
                                	<td>{{$i->Name}}</td>
                                    <td align="center">{{$i->No_Of_Bottles}}</td>
                                    <td align="center">{{$i->Rate}}</td>
                                    <td align="right">{{$i->Amount}}</td>
                                </tr>
                                @endforeach
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr>
                                	<td colspan="3" align="left">Total</td>
                                    <td>{{$Invoice->Amount}}</td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        <tr rowspan="3"><td colspan="3">&nbsp;</td></tr>
                        <!--<tr><td colspan="3">&nbsp;</td></tr>-->
                        <tr><td colspan="3" align="right">&nbsp;</td></tr>
                    </table>
                    
                    

                    </form>

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
