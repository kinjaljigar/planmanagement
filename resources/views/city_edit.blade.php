{{session()->put('menu',5)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Edit Cities</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li>

                <a href="{{route('city.list')}}">Cities</a>

            </li>



            <li class="active">

                <strong>Edit City</strong>

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

                      action="{{route('city.edit')}}" method="post">

                    {{csrf_field()}}

                    <input type="hidden" name="txt_id" id="txt_id" value="{{$city->Id}}">

                    @include('flash-message')

                    <div class="form-group">

                        <label>State <span style="color: red">*</span></label>

                        <select name="txt_state" class="form-control"   id="txt_state" required>


                            <option value="">---Select---</option>


                            @foreach($states as $p )

                                <option value="{{ $p->Id}}"
                                    {{$city->State_Id==$p->Id?'Selected':''}}> {{$p->State_Name}}</option>

                            @endforeach


                        </select>

                    </div>


                    <div class="form-group"><label>City <span style="color: red">*</span></label> <input type="text"

                                                                                                         placeholder="Enter City"

                                                                                                         name="txt_cityname"

                                                                                                         class="form-control"

                                                                                                         value="{{$city->City_Name}}"

                                                                                                         id="txt_cityname"

                                                                                                         data-bv-stringlength="true"

                                                                                                         data-bv-stringlength-max="25"

                                                                                                         data-bv-stringlength-message="The City must be 25 Characters or Smaller"

                                                                                                         required></div>





                    <div>

                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" >
                            <strong>Save</strong>

                        </button>



                    </div>

                </form>



                <script type="text/javascript">





                    $(document).ready(function () {

                        $('#stringLengthForm').bootstrapValidator();



                        $('#txt_country').change(function () {

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

                    });

                </script>

            </div>

        </div>

    </div>

</div>





@include('footer')
