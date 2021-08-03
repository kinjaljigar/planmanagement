{{session()->put('menu',21)}}
@include('header')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Dealer Daily Transaction</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DeaDailyTran.list')}}">Dealer Daily Transaction</a>
            </li>

            <li class="active">
                <strong>Edit Dealer Daily Transaction</strong>
            </li>
        </ol>

    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-6"><h3 class="m-t-none m-b"></h3>

                <form id="stringLengthForm" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"
                      action="{{route('DeaDailyTran.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <input type="hidden" name="txt_id" value="{{$Dealerdailytrans->Id}}">

                    <div class="form-group"><label>Date Of Transaction</label>

                        <input type="date"
                               value="{{$Dealerdailytrans->DoT}}"
                               id="dt_dot" name="dt_dot"
                               class="form-control">

                    </div>

                    <div class="form-group">
                        <label>Dealer Name</label>

                        <select name="txt_dealerid" id="txt_dealerid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($dealers as $d )

                                <option value="{{ $d->Id}}"
                                    {{$Dealerdailytrans->Dealer_Id==$d->Id?'Selected':''}}> {{$d->Dealer_Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bottle Name</label>

                        <select name="txt_bottleid" id="txt_bottleid" class="form-control" required>

                            <option value="">---Select---</option>

                            @foreach($bottles as $b )

                                <option value="{{ $b->Id}}"
                                    {{$Dealerdailytrans->Bottle_Type==$b->Id?'Selected':''}}> {{$b->Name}}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group"><label>No Of Bottle</label>
                        <input type="number"
                               placeholder="Enter No Of Bottle"
                               name="txt_noofbottle"
                               id="txt_noofbottle"
                               class="form-control"
                               value="{{$Dealerdailytrans->No_Of_Bottle}}"
                        ></div>

                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit" id="saveRecord"><strong>Save</strong>
                        </button>

                    </div>



                </form>
                <script type="text/javascript">


                    $(document).ready(function () {
                        document.getElementById("saveRecord").disabled = false;
                        $('#stringLengthForm').bootstrapValidator();
                        $("#saveRecord").prop('enabled', true);

                    });

                </script>


            </div>
        </div>
    </div>
</div>








@include('footer')
