{{session()->put('menu',2)}}

@include('header')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Plan</h2>

        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
            </li>

            <li>
                <a href="{{route('plan.list')}}">Plan</a>
            </li>

            <li class="active">
                <strong>Add Plan</strong>
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
                      action="{{route('plan.store')}}" method="post">
                    {{csrf_field()}}

                    @include('flash-message')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" id="txt_id">
                    </div>


                    <div class="form-group"><label>Plan Name <span style="color: red">*</span></label>
                        <input type="text"
                               placeholder="Enter Plan Name"
                               name="txt_palnname"
                               id="txt_palnname"
                               class="form-control"
                               data-bv-stringlength="true"
                               value="{{old('txt_palnname')}}"
                               data-bv-stringlength-max="50"
                               data-bv-stringlength-message="The Enter Bottle Type must be 50 Characters or Smaller"
                               required></div>

                    <div>

                    <div class="form-group">
                        <label>Plan Type <span style="color: red">*</span></label>

                        <select name="txt_plantype" id="txt_plantype" class="form-control" required>

                            <option value="">---Select---</option>

                            <option value="Daily"  {{old("txt_plantype")=="Daily"?'Selected':''}}>Daily</option>
                            <option value="Monthly"  {{old("txt_plantype")=="Monthly"?'Selected':''}}>Monthly</option>

                        </select>
                    </div>

                        <div class="form-group">
                            <label>Bottle Type <span style="color: red">*</span></label>

                            <select name="txt_bottletype" id="txt_bottletype" class="form-control" required>

                                <option value="">---Select---</option>

                                @foreach($plans as $p )

                                    <option value="{{ $p->Id}}"
                                        {{old('txt_bottletype')==$p->Id?'Selected':''}}> {{$p->Name}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group"><label>Rate <span style="color:red">*</span></label>
                            <input type="number"
                                   placeholder="Enter Rate"
                                   name="txt_rate"
                                   class="form-control"
                                   data-bv-stringlength="true"
                                   data-bv-stringlength-max="10"
                                   min="0"
                                   step="any"
                                   value="{{old('txt_rate')}}"
                                   data-bv-stringlength-message="The Rate must be 10 Characters or Smaller"
                                   required></div>


                        <div class="form-group">

                                <input type="checkbox"
                                       name="chk_sunday"
                                       id="chk_sunday"
                                       class="form-check-input"
                                       {{old('chk_sunday')}}
                                      />

                                <label>Sunday</label><br>


                            <input type="checkbox"
                                   name="chk_monday"
                                   id="chk_monday"
                                   class="form-check-input"
                                   {{old('chk_monday')}}
                                  />

                            <label>Monday</label><br>

                            <input type="checkbox"
                                   name="chk_tuesday"
                                   id="chk_tuesday"
                                   class="form-check-input"
                                   {{old('chk_tuesday')}}
                                  />

                            <label>Tuesday</label><br>

                            <input type="checkbox"
                                   name="chk_wednesday"
                                   id="chk_wednesday"
                                   class="form-check-input"
                                   {{old('chk_wednesday')}}
                                   />

                            <label>Wednesday</label><br>

                            <input type="checkbox"
                                   name="chk_thursday"
                                   id="chk_thursday"
                                   class="form-check-input"
                                   {{old('chk_thursday')}}
                                   />

                            <label>Thursday</label><br>

                            <input type="checkbox"
                                   name="chk_friday"
                                   id="chk_friday"
                                   class="form-check-input"
                                   {{old('chk_friday')}}
                                   />

                            <label>Friday</label><br>

                            <input type="checkbox"
                                   name="chk_saturday"
                                   id="chk_saturday"
                                   class="form-check-input"
                                   {{old('chk_saturday')}}
                                   />

                            <label>Saturday</label><br>

                        </div>



                    <div>
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                type="submit" id="saveRecord"><strong>Save</strong>
                        </button>

                    </div>

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
