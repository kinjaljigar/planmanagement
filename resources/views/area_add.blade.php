{{session()->put('menu',6)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Add Area</h2>



        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>



            <li>

                <a href="{{route('area.list')}}">Area</a>

            </li>



            <li class="active">

                <strong>Add Area</strong>

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

                      action="{{route('area.store')}}" method="post">

                    {{csrf_field()}}



                    @include('flash-message')





                    <div class="form-group">
                        <label>City <span style="color: red">*</span></label>

                        <select name="txt_cityid" class="form-control"   id="txt_cityid" required>


                            <option value="">---Select---</option>


                            @foreach($city as $p )

                                <option value="{{ $p->Id}}"
                                    {{old('txt_cityid')==$p->Id?'Selected':''}}> {{$p->City_Name}}</option>

                            @endforeach


                        </select>

                    </div>



                    <div class="form-group"><label>Area <span style="color: red">*</span></label> <input type="text"

                                                                                                         placeholder="Enter Area"

                                                                                                         name="txt_areaname"

                                                                                                         class="form-control"

                                                                                                         value="{{old('txt_areaname')}}"

                                                                                                         id="txt_areaname"

                                                                                                         data-bv-stringlength="true"

                                                                                                         data-bv-stringlength-max="50"

                                                                                                         data-bv-stringlength-message="The Area must be 50 Characters or Smaller"

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
