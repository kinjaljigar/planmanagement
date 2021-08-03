{{session()->put('menu',31)}}


@include('header')



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Dealer Invoice List</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li class="active">

                <strong>Dealer Collection</strong>

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

                    <!--<div class="ibox-tools">



                        <a href="#" class="btn btn-primary btn-sm"></a>



                    </div>-->

                </div>

                <div class="ibox-content">

					<div class="form-group">
                        <label class="col-md-2">Month <span style="color: red">*</span></label>
                        <div class="col-md-2"><select name="dp_month" id="dp_month" class="form-control" >

                            <option value="">---Select---</option>

                            <option value="01"  {{old("dp_month")=="January"?'Selected':''}}>January</option>
                            <option value="02"  {{old("dp_month")=="Febuary"?'Selected':''}}>Febuary</option>
                            <option value="03"  {{old("dp_month")=="March"?'Selected':''}}>March</option>
                            <option value="04"  {{old("dp_month")=="April"?'Selected':''}}>April</option>
                            <option value="05"  {{old("dp_month")=="May"?'Selected':''}}>May</option>
                            <option value="06"  {{old("dp_month")=="June"?'Selected':''}}>June</option>
                            <option value="07"  {{old("dp_month")=="July"?'Selected':''}}>July</option>
                            <option value="08"  {{old("dp_month")=="August"?'Selected':''}}>August</option>
                            <option value="09"  {{old("dp_month")=="September"?'Selected':''}}>September</option>
                            <option value="10"  {{old("dp_month")=="October"?'Selected':''}}>October</option>
                            <option value="11"  {{old("dp_month")=="November"?'Selected':''}}>November</option>
                            <option value="12"  {{old("dp_month")=="December"?'Selected':''}}>December</option>

                        </select></div>
                    
                        <label class="col-md-2">Year</label>
                        <div class="col-md-2"><input class="form-control" type="number" name="txt_year"
                        id="txt_year"></div>
                        <div class="col-md-1"><br /></div>
                        <div class="col-md-3"><input type="submit" id="btnShow" name="btnShow" class="btn btn-success" /></div>
                    </div>
					<div class="form-group">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover dataTables-example">

                            <thead>

                            <tr>
                            	<th>No</th>
                                
								<th>Month</th>
                                <th>Firm Name</th>
                                <th>Dealer Name</th>
                                <th>Phone No</th>
                                <th>Area</th>
                                <th>Bill Amount</th>
                                <th>is Paid</th>
                                <th>Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($Invoice as $d)

                                <tr>
									<th><?php echo$i; $i=$i+1; ?></th>
                                    <th><input type="checkbox"  /></th>
                                    <th><a href="#">Pay</a></th>
                                    <th></th>
                                    <th></th>
                                    <th> </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>





                            @endforeach



                            </tbody>

                          <!--  <tfoot>

                            <tr>
								<th>No</th>
                                
								<th>Month</th>
                                <th>Firm Name</th>
                                <th>Dealer Name</th>
                                <th>Phone No</th>
                                <th>Area</th>
                               
                                <th>Bill Amount</th>
                                <th>is Paid</th>
                                <th>Pay</th>
                            </tr>

                            </tfoot>-->

                        </table>

                    </div>

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

                            {extend: 'csv',title:'Delivery Boy In Out List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'excel',title:'Delivery Boy In Out List',exportOptions: {
                                    columns: [0,1,2]
                                }},

                            {extend: 'pdf',title:'Delivery Boy In Out list',exportOptions: {
                                    columns: [0,1,2]
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
                                    columns: [0,1,2]
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
