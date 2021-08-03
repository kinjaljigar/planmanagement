{{session()->put('menu',32)}}
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

					<form id="frmEntry" method="post" action="{{route('rptMontAtte.list.Show')}}" role="form">
                    {{csrf_field()}}
                    <div class="form-group">
                    	<div class="col-md-2"><label>Month</label></div>
                        <div class="col-md-2"><select id="cmbMonth" name="cmbMonth" class="form-control" required>
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
                        <div class="col-md-2"><input type="number" id="txtYear" name="txtYear" class="form-control" maxlength="4" minlenght="4" placeholder="Year" required value="{{$Year1}}" /></div>
                        <div class="col-md-6" ><br /></div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-1"></div>
                        <div class="col-md-4">
                        	<select id="cmbArea" name="cmbArea">
                            	<option value="0">Select Area</option>
                                @foreach($Area as $a)
                                	<option value="{{$a->Id}}" {{$a->Id==$selArea?'Selected':''}}>{{$a->Area_Name}}</option>
                                @endforeach
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
                                <th>20 L Jug</th>
                                <th>20 L Bottle</th>
                                <?php
									for($i=1;$i<=31;$i++)
										echo '<th>' . $i . '</th>';
								?>
                                
                            </tr>

                            </thead>

                            <tbody>

                           
							@if(is_null($Att))
                            	
                            @else
                            
	
							@foreach($Att as $a)
                                <tr>
									
                                    <td><?php echo $a[1]; ?></td>
                                    <td style="width:100px"><?php echo $a[0]; ?></td>
                                    <td style="width:150px"><?php echo $a[2]; ?></td>
                                    <td style="width:150px"><?php echo $a[3]; ?></td>
                                        <?php $i=1; 
											for($i=1;$i<=31;$i++)
                                        		echo '<td>' . $a[$i*2-1 + 3]  .'</td>';
                                       // echo '<td><a href="ShowAttendance/' .$a[$i*2 ] . '">' . $a[$i*2-1] . ' - ' . $a[$i*2 ] .'</a> </td>';
                                   		?>
                                </tr>





                            @endforeach
							@endif


                            </tbody>

                           <tfoot>

                            <tr>
                                <th>Seq. No</th>
                                <th>Customer Name</th>
                                <th>20 L Jug</th>
                                <th>20 L Bottle</th>
                                <?php
									for($i=1;$i<=31;$i++)
										echo '<th>' . $i . '</th>';
								?>
                                
                            </tr>
                            </tfoot>

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

                        pageLength: 25,

                        responsive: true,

                        dom: '<"html5buttons"B>lTfgitp',

                        buttons: [

                            { extend: 'copy',exportOptions: {
                                    //columns: [0,1,2]
                                }},

                            {extend: 'csv',title:'Delivery Boy List',exportOptions: {
                                    //columns: [0,1,2]
                                }},

                            {extend: 'excel',title:'Delivery Boy List',exportOptions: {
                                    //columns: [0,1,2]
                                }},

                            {extend: 'pdf',title:'Delivery Boy list',exportOptions: {
                                    //columns: [0,1,2]
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
                                    //columns: [0,1,2]
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
