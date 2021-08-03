{{session()->put('menu',21)}}
@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Dealer Daily Transaction</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('DeaDailyTran.list')}}">Dealer Daily Transaction</a>
            </li>

            <li class="active">
                <strong>Add Dealer Daily Transaction</strong>
            </li>
        </ol>

    </div>

</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-md-12"><h3 class="m-t-none m-b"></h3>

                <form id="stringLengthForm" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" role="form"
                      action="{{route('DeaDailyTran.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id">
                    </div>

                    <div class="form-group"><label class="col-md-2">Date Of Transaction</label>

                        <div class="col-md-6"><input type="date"
                               value="{{$dot}}"
                               id="dt_dot" name="dt_dot"
                               class="form-control" 
                               size="1"></div>
						<div class="col-md-2">&nbsp;</div>
                    </div>






                    <div class="form-group">
                        <div class="col-md-1"> &nbsp;</div>
                        <div class="col-md-11">
                            <table class="table">
                                <tr>
                                    <th><p style="color:red">Dealer Name</p></th>
                                    @foreach($bottles as $b )

                                        <th>{{$b->Name}}</th>

                                    @endforeach
                                </tr>

                                
                                
                                    @foreach($dealers as $d )
										<tr>
                                        <td>{{$d->Dealer_Name}}</td>
										@foreach($bottles as $b )
                                        <td><input type="text" class="form-control" id="txt_nob[]"
                                                   name="txt_nob[]"
                                                   value="0"> </td>
                                        @endforeach
                                        </tr>
                                    @endforeach
                                
                            </table>
                        </div>

                    </div>





                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong>
                        </button>

                    </div>



                </form>
                <script type="text/javascript">


                    $(document).ready(function () {
                        $('#stringLengthForm').bootstrapValidator();

                        $('#txt_roleid').change(function () {
                            $.get("{{ url('selected_stateList')}}",
                                {option: $(this).val()},
                                function (data) {
                                    var model = $('#txt_state');
                                    model.empty();

                                    $.each(data, function (index, element) {
                                        model.append("<option value='" + element.state_id + "'>" + element.state_name + "</option>");
                                    });
                                });
                        });
						
						//dt_dot
						
                    });





                </script>
            </div>
        </div>
    </div>
</div>








@include('footer')
