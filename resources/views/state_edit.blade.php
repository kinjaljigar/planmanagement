{{session()->put('menu',4)}}

@include('header')


<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Edit States</h2>


        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>


            <li>

                <a href="{{route('state.list')}}">States</a>

            </li>


            <li class="active">

                <strong>Edit State</strong>

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

                      action="{{{route('state.edit')}}}" method="post">

                    {{csrf_field()}}



                    @include('flash-message')

                    <input type="hidden" name="txt_id" id="txt_id" value="{{$state->Id}}">


                    <div class="form-group">
                        <label>Country <span style="color: red">*</span></label>

                        <select name="txt_countryid" class="form-control"   id="txt_countryid" required>


                            <option value="">---Select---</option>


                            @foreach($country as $p )

                                <option value="{{ $p->Id}}"
                                    {{$state->Country_Id==$p->Id?'Selected':''}}> {{$p->Country_Name}}</option>

                            @endforeach



                        </select>

                    </div>


                    <div class="form-group"><label>State <span style="color: red">*</span></label> <input
                            type="text"

                            placeholder="Enter State"

                            name="txt_statename"

                            class="form-control"

                            value="{{$state->State_Name}}"

                            data-bv-stringlength="true"

                            data-bv-stringlength-max="50"

                            data-bv-stringlength-message="The State must be 50 Characters or Smaller"

                            required></div>


                    <div>

                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong>

                        </button>


                    </div>

                </form>


                <script type="text/javascript">


                    $(document).ready(function () {

                        $('#stringLengthForm').bootstrapValidator();

                    });


                </script>

            </div>

        </div>

    </div>

</div>


@include('footer')
