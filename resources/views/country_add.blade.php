{{session()->put('menu',3)}}

@include('header')


<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-lg-10">

        <h2>Add Countries</h2>


        <ol class="breadcrumb">

            <li>

                <a href="{{url('/')}}">Dashboard</a>

            </li>


            <li>

                <a href="{{route('country.list')}}">Countries</a>

            </li>


            <li class="active">

                <strong>Add Country</strong>

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

                      action="{{route('country.store')}}" method="post">

                    {{csrf_field()}}



                    @include('flash-message')

                    <input type="hidden" name="txt_countryid" class="form-control" >


                    <div class="form-group"><label>Country <span style="color: red">*</span></label> <input
                            type="text"

                            placeholder="Enter Country"

                            name="txt_countryname"

                            class="form-control"

                            value="{{old('txt_countryname')}}"

                            data-bv-stringlength="true"

                            data-bv-stringlength-max="50"

                            data-bv-stringlength-message="The Country must be 50 Characters or Smaller"

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
