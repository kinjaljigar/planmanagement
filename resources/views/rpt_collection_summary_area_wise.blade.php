@include('header')
<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Bottle Count</h2>

        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Collection Summary</strong>

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

					<form id="frmEntry" method="post" action="{{route('rptCollectionSummaryGroupByArea.list.Show')}}" role="form">
                    {{csrf_field()}}
                    
                    <div class="form-group">
                    <label class="col-md-2">Month <span style="color: red">*</span></label>

                        <div class="col-md-2"><select name="dp_month" id="dp_month" class="form-control" required >

                            <option value="">---Select---</option>

                            <option value="01"  {{$Month1=="01"?'Selected':''}}>January</option>
                            <option value="02"  {{$Month1=="02"?'Selected':''}}>Febuary</option>
                            <option value="03"  {{$Month1=="03"?'Selected':''}}>March</option>
                            <option value="04"  {{$Month1=="04"?'Selected':''}}>April</option>
                            <option value="05"  {{$Month1=="05"?'Selected':''}}>May</option>
                            <option value="06"  {{$Month1=="06"?'Selected':''}}>June</option>
                            <option value="07"  {{$Month1=="07"?'Selected':''}}>July</option>
                            <option value="08"  {{$Month1=="08"?'Selected':''}}>August</option>
                            <option value="09"  {{$Month1=="09"?'Selected':''}}>September</option>
                            <option value="10"  {{$Month1=="10"?'Selected':''}}>October</option>
                            <option value="11"  {{$Month1=="11"?'Selected':''}}>November</option>
                            <option value="12"  {{$Month1=="12"?'Selected':''}}>December</option>

                        </select></div>
                   		<div class="col-md-1">&nbsp;</div>
                        <label class="col-md-2">Year</label>
                        <div class="col-md-2"><input class="form-control" type="number" name="txt_year"
                        id="txt_year" required></div>
                        <div class="col-md-2"><input type="submit" name="btnSubmit" id="btnSubmit" value="Show" class="btn btn-primary" /></div>
                    </div>
                   	<div class="form-group">
                    	<div class="col-md-2"><label >Area</label></div>
                        <div class="col-md-4">
                        	<select id="cmbArea" name="cmbArea">
                            	<option value="0">Select Area</option>
                                @foreach($Area as $a)
                                	<option value="{{$a->Id}}" {{$a->Id==$Area_Id?'Selected';''}}>{{$a->Area_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    <div class="form-group">

                    <div class="table-responsive1">
                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
                            	<th>No</th>
                                <th>Area</th>
                                <th>No. of Cust</th>
                                <th>Bill Generated</th>
                                <th>Collection Done</th>
                                <th>Collection Pending</th>
                            </tr>
                            </thead>
                            <tbody>

                           	<?php $i=1; ?>
							@if(is_null($Cust_List))
                            @else
                            
	
							@foreach($Cust_List as $a)
                                <tr>
										<td><?php echo $i; $i=$i+1; ?></td>
                                    	<td>{{$a->Area_Name}}</td>
                                        <td>{{$a->Cust_Count}}</td>
                                        <td>{{$a->Bill_Generated}}</td>
                                       <td>{{$a->Bill_Paid}}</td>
                                       <td>{{$a->Bill_Pending}}</td>
                                </tr>
                            @endforeach
							@endif
                            </tbody>

                          <!-- <tfoot>
								<tr>
                                    <th>No</th>
                                    <th>Area</th>
                                    <th>No. of Cust</th>
                                    <th>Bill Generated</th>
                                    <th>Collection Done</th>
                                    <th>Collection Pending</th>
                                </tr>
                            </tfoot>
-->
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
