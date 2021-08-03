{{session()->put('menu',1)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Bottle Type Master</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('bottletype.list')}}">Bottle Type Master</a>
            </li>

            <li class="active">
                <strong>Edit Bottle Type Master</strong>
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
                      action="{{route('bottletype.edit')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id" value="{{$bottle->Id}}">
                    </div>


                    <div class="form-group"><label>Bottle Type <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Bottle Type"
                               name="txt_bottlename"
                               id="txt_bottlename"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{$bottle->Name}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Bottle Type must be 50 Characters or Smaller"
                               required></div>

                    <div>


                        <div class="form-group"><label>Rate <span style="color:red">*</span></label>
                            <input type="number"
                                   placeholder="Enter Rate"
                                   name="txt_rate"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   data-bv-stringlength-max="10"
                                   min="0"
                                   step="any"
                                   value="{{$bottle->Rate}}"
                                   data-bv-stringlength-message="The Rate must be 10 Characters or Smaller"
                                   required></div>

						<div class="form-group"><label>Used By <span style="color:red">*</span></label>
                            <select id="txt_user" name="txt_user" class="form-control" required>
                            	<option value="DB" {{$bottle->User=="DB"?'Selected':''}}>Dealivery Boy</option>
                                <option value="Dealer" {{$bottle->User=="Dealer"?'Selected':''}}>Dealer</option>
                            </select>
                        </div>




                        <div>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                    type="submit" id="saveRecord"><strong>Save</strong>
                            </button>

                        </div>

                    </div></form>
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
