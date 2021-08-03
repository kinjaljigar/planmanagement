<?php
//if(!(session()->has('username')) || session()->get('username')=="" || session()->get('username')==0)
//	header("Location:index.php");
?>
<!DOCTYPE html>

<html>

<head>


    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Water Management</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">




    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- Toastr style -->

    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="{{asset('css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">


    <link href="{{asset('css/animate.css')}}" rel="stylesheet">


    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet" type="text/css">


    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet">


    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet" />




</head>


{{--
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Water Management</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/cropper/cropper.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/switchery/switchery.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/dualListbox/bootstrap-duallistbox.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">


</head>
--}}



<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">

        <div class="sidebar-collapse">

            <ul class="nav metismenu" id="side-menu">

                <li class="nav-header">

                    <div class="dropdown profile-element"> <span>

                           {{-- <img alt="image" src="{{asset('img/logo.png')}}" width="70px" height="30px"/>--}}

                             </span>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="clear"> <span class="block m-t-xs"> <strong

                                            class="font-bold"><?php echo session()->get('username'); ?></strong>


                                </span>

                            </span>

                        </a>


                    </div>


                </li>






                <li class="active">
                    <a href="{{url('/')}}">
                        <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>

                    </a>

                </li>
				<?php
					if(session()->get('role')=='admin' or session()->get('role')=='sa')
					{
						?>

                <li <?php
							if(session()->get('menu')==1
                                || session()->get('menu')==2
                                || session()->get('menu')==3
                                || session()->get('menu')==4
                                || session()->get('menu')==5
                                || session()->get('menu')==6
                                
                            )
								echo 'class="active"';
						?> >
                    <a href=""><i class="fa fa-graduation-cap"></i> <span class="nav-label">Master</span>
                        <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php
                                if(session()->get('menu')==1)
                                    echo 'class="active" ';
							?> >
                            <a href="{{route('bottletype.list')}}">Bottle Type Master</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==2)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('plan.list')}}">Plan Master</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==3)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('country.list')}}">Country Master</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==4)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('state.list')}}">State Master</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==5)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('city.list')}}">City Master</a>
                        </li>



                        <li <?php
                                if(session()->get('menu')==6)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('area.list')}}">Area Master</a>
                        </li>


                    </ul>
                </li>


                <li <?php
							if(session()->get('menu')==7
                                || session()->get('menu')==8
                                || session()->get('menu')==9
                                || session()->get('menu')==10
                                || session()->get('menu')==11
                                || session()->get('menu')==46
                                || session()->get('menu')==48
								|| session()->get('menu')==49
								|| session()->get('menu')==50
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-users"></i> <span class="nav-label">Customer Management</span>
                        <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php
                                if(session()->get('menu')==7)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('customer.list')}}">Customer</a>
                        </li>
					<?php if(session()->get('role')=='sa'){ ?>
                        <li <?php
                                if(session()->get('menu')==8)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('CustomerPlan.list')}}">Customer Plan **</a>
                        </li>
                    <?php } ?>
					<?php if(session()->get('role')=='sa'){ ?>
                        <li <?php
                                if(session()->get('menu')==9)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('CusBoyDailyRel.list')}}">Customer - Delivery Boy Relation **</a>
                        </li>
                    <?php } ?>
					<?php if(session()->get('role')=='sa'){ ?>
                        <li <?php
                                if(session()->get('menu')==10)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('CustPlanBottleAlloc.list')}}">Customer Plan Bottle Allocated **</a>
                        </li>
                    <?php } ?>

                        <li <?php
                                if(session()->get('menu')==11)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('attendance.list')}}">Transactions</a>
                        </li>
						<li <?php
                                if(session()->get('menu')==46)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCustLedger.list')}}">Customer Ledger</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==49)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('MontAtte.list')}}">Transaction List Monthly</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==50)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('ListDailyCustMonthlyAtt.list')}}">Transaction List Daily</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==48)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('closed_customer.list')}}">Closed Customer</a>
                        </li>
                    </ul>
                </li>



                <li <?php
							if(session()->get('menu')==12
                                || session()->get('menu')==13
                                || session()->get('menu')==14
                                || session()->get('menu')==15
                                || session()->get('menu')==16
                                || session()->get('menu')==17
                                || session()->get('menu')==18
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-car"></i> <span class="nav-label">Delivery Boy Management</span>
                        <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
					<?php if(session()->get('role')=='sa'){ ?>
                        <li <?php
                                if(session()->get('menu')==12)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DeliveryBoyBaseBottle.list')}}">Delivery Boy Base Bottle</a>
                        </li>
					<?php } ?>
                        <li <?php
                                if(session()->get('menu')==13)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('deliveryboy.list')}}">Delivery Boy Master</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==14)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DelBoyAraRel.list')}}">Delivery Boy Area Relation</a>
                        </li>

                        <li <?php
                                if(session()->get('menu')==15)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DelBoyInOut.list')}}">Delivery Boy In Out</a>
                        </li>
	
                        <li <?php
                                if(session()->get('menu')==16)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('CusBoyDailyRel.list')}}">Customer - Delivery Boy Relation **</a>
                        </li>
						<li <?php
                                if(session()->get('menu')==17)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDBDaily.list')}}"> -- Daily Transaction Report</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==18)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDBMonthly.list')}}">--Monthly Transaction Report</a>
                        </li>
                    </ul>
                </li>


                <li <?php
							if(session()->get('menu')==19
                                || session()->get('menu')==20
                                || session()->get('menu')==21
                                || session()->get('menu')==22
                                || session()->get('menu')==23
                                || session()->get('menu')==44
								|| session()->get('menu')==47
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-user"></i> <span class="nav-label">Dealer Management</span>
                        <span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <li <?php
                                if(session()->get('menu')==19)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('dealer.list')}}">Dealer Master</a>
                        </li>
					<?php if(session()->get('role')=='sa'){ ?>
                        <li <?php
                                if(session()->get('menu')==20)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DealerPlanRel.list')}}">Dealer Plan Relation</a>
                        </li>
					<?php } ?>
                        <li <?php
                                if(session()->get('menu')==21)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DeaDailyTran.list')}}">Dealer Daily Transaction</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==44)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDealerRateCard.list')}}">Dealer Rate Card</a>
                        </li>

<!--                        <li <?php
                                if(session()->get('menu')==22)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DeaDailyTran.add')}}">New Dealer Daily Transaction</a>
                        </li>
-->
						<li <?php
                                if(session()->get('menu')==23)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDealerDateWiseTrans.list')}}">-- Date Wise Transaction Report</a>
                        </li>
						<li <?php
                                if(session()->get('menu')==47)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDealerLedger.list')}}">Dealer Ledger</a>
                        </li>

                    </ul>
                </li>
                <li <?php
							if(session()->get('menu')==24
                                || session()->get('menu')==25
                                || session()->get('menu')==26
                                
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-money"></i> <span class="nav-label">Bill Management</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php
                                if(session()->get('menu')==24)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('Generate.Invoice')}}">Generate Invoice</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==25)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('custInvoice.list')}}">Customer Invoice List</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==26)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DealerInvoice.list')}}">Dealer Invoice List</a>
                        </li>

                    </ul>
                </li>
                <li <?php
							if(session()->get('menu')==27
                                || session()->get('menu')==28
                                || session()->get('menu')==29
                                
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-male"></i> <span class="nav-label">Collectors</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php
                                if(session()->get('menu')==27)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('collector.list')}}">Collectors</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==28)
                                    echo 'class="active" ';
							?>>
                            <a href="#">Assigned Area</a>
                        </li>
						<li <?php
                                if(session()->get('menu')==29)
                                    echo 'class="active" ';
							?>>
                            <a href="#">Assigned Customers</a>
                        </li>

                    </ul>
                </li>
                <li <?php
							if(session()->get('menu')==30
                                || session()->get('menu')==31
                                || session()->get('menu')==45
                            )
								echo 'class="active"';
						?>>
                    <a href=""><i class="fa fa-inr"></i> <span class="nav-label">Collection</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php
                                if(session()->get('menu')==30)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('Custcoll.list')}}">Customer Collection</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==31)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('DealerColl.list')}}">Dealer Collection</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==45)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('CustInvAreaWise.list')}}">Cust. Coll. Are wise</a>
                        </li>

                    </ul>
                </li>
                <li <?php
							if(session()->get('menu')==32
                            || session()->get('menu')==33
                            || session()->get('menu')==34
							|| session()->get('menu')==35
							|| session()->get('menu')==36
							|| session()->get('menu')==37
							|| session()->get('menu')==38
							|| session()->get('menu')==39
							|| session()->get('menu')==40
							|| session()->get('menu')==41
                            )
								echo 'class="active"';
						?> >
                    <a href=""><i class="fa fa-bar-chart"></i> <span class="nav-label">Reports</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php
                                if(session()->get('menu')==32)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptMontAtte.list')}}">Monthly Attendance</a>
                        </li>
                        <!-- not used<li  <?php
                                if(session()->get('menu')==33)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('Dealertrans.list')}}">Dealer Transactions</a>
                        </li>-->
						<li <?php
                                if(session()->get('menu')==34)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptBlankAttSheet.list')}}">Cust Blank Att. Sheet</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==35)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCustReport.list')}}">Cust Report</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==36)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptNextDayBottleCount.list')}}">Next day Bottles <!-- 	For Next day: No. of bottles to be given to Delivery boy on next day. --></a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==37)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDailyBottlesTrans.list')}}">Daily Bottles Trans Report <!--	Daily report: How much bottles delivery boy has to take/ How much he take/ Attendance taken on his route (Sum of customers attendance for that day on that route)--></a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==38)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCollectionSummaryGroupByArea.list')}}">Collection Report Group By Area <!-- By Month/Area/Pending Area Wise/Pendng Group by Area! --></a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==39)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCollectionSummaryAreaWise.list')}}">Collection Report Area Wise <!-- By Month/Area/Pending Area Wise/Pendng Group by Area! --></a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==40)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptDealerCollection.list')}}">Dealer Collection Report<!-- By Month/Area/Pending Area Wise/Pendng Group by Area! --></a>
                        </li>
                        <!--<li <?php
                                if(session()->get('menu')==41)
                                    echo 'class="active" ';
							?>>
                            <a href="#">Monthly Summery Report<!-- 	Daily/Monthly report (No. of parties (Count)/No. of Bottles (count)-Bottle type wise--</a>
                        </li>-->
                        <li <?php
                                if(session()->get('menu')==42)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCustNewStart.list')}}">New Customers</a>
                        </li>
                        <li <?php
                                if(session()->get('menu')==43)
                                    echo 'class="active" ';
							?>>
                            <a href="{{route('rptCustClosed.list')}}">Closed Customers</a>
                        </li>
                    </ul>
                </li>
                <?php
					}
					elseif(session()->get('role')=='collector')
					{
				?>
                <li>
                    <a href="{{route('custInvoice.list')}}"><i class="fa fa-user"></i>
                            Customer Invoice List</a>
                        </li>
                        <li>
                            <a href="{{route('DealerInvoice.list')}}"><i class="fa fa-user"></i>Dealer Invoice List</a>
                        </li>

                    </ul>
                </li>
                <?php
					}
				
					
					elseif(session()->get('role')=='deo')
					{
				?>
                		<li>
                            <a href="{{route('DelBoyInOut.list')}}">Delivery Boy In Out</a>
                        </li>
                        <li>
                            <a href="{{route('DeaDailyTran.list')}}">Dealer Daily Transaction</a>
                        </li>

                    </ul>
                </li>
                <?php
					}
				?>
            </ul>


        </div>

    </nav>


    <div id="page-wrapper" class="gray-bg dashbard-1">

        <div class="row border-bottom">

            <nav class="navbar navbar-top" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">

                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>

                    </a>

                    <form role="search" class="navbar-form-custom"

                          action="http://webapplayers.com/inspinia_admin-v2.7.1/search_results.html">

                        <div class="form-group">



                        </div>

                    </form>

                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <li>

                        <span class="m-r-sm text-muted welcome-message">Welcome to Water Management Admin</span>

                    </li>


                    <li>

                        <a href="{{route('user.logout')}}">

                            <i class="fa fa-sign-out"></i> Log out

                        </a>

                    </li>


                </ul>


            </nav>

        </div>

