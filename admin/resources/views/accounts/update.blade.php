@extends('app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/fuelux/css/wizard.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/select2/css/select2.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/bootstrap-slider/css/bootstrap-slider.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
@endsection

@section('body')
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row wizard-row">
        <div class="col-md-12 fuelux">
            <div class="block-wizard">
                <div id="wizard1" class="wizard wizard-ux">
                    <div class="steps-container">
                        <ul class="steps">
                            <li data-step="1" class="active">Basic Info<span class="chevron"></span></li>
                            <li data-step="2">Identification No.<span class="chevron"></span></li>
                            <li data-step="3">Designation<span class="chevron"></span></li>
                            <li data-step="4">Emergency<span class="chevron"></span></li>
                            <li data-step="5">Account<span class="chevron"></span></li>
                        </ul>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-xs btn-prev btn-secondary"><i class="icon s7-angle-left"></i>Prev</button>
                        <button type="button" data-last="Finish" class="btn btn-xs btn-next btn-secondary">Next<i class="icon s7-angle-right"></i></button>
                    </div>
                    <div class="step-content">
                        <div data-step="1" class="step-pane active">
                            <div class="container pl-sm-5">
                                <form method="post" enctype="multipart/form-data" action="{{ url('accounts/upload/'.$data->id) }}">
                                    <input type="hidden" name="prof_id" value="{{ $data->id }}" />
                                    <input type="hidden" name="hospital_id" value="{{ $data->hospital_id }}" />
                                    {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-6">
                                        <?php
                                            $picture = isset($data->picture) ? $data->picture: 'default.png';
                                        ?>
                                        <h3>Update Picture:</h3><br />
                                        <img id="prof_pic" src="{{ asset('upload/pictures/'.$picture) }}" width="150px" />
                                        <br />
                                        <input accept="image/jpeg" class="mt-3 form-control col-sm-6" type='file' name="prof_pic" onchange="readProfURL(this);" />
                                        <button type="submit" class="btn btn-success col-sm-6">Update Picture</button>
                                    </div>
                                </div>
                                <hr />
                                </form>
                                <form action="#" id="basicInfo" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <h3 class="wizard-title">Basic Information</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">First Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="First Name" value="{{ $data->fname }}" name="fname" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Middle Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="Middle Name" value="{{ $data->mname }}" name="mname" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Last Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="Last Name" value="{{ $data->lname }}" name="lname" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Suffix</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="Sr., Jr., III" value="{{ $data->ext }}" name="ext" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Gender</label>
                                        <div class="col-12 col-sm-8 col-lg-6 form-check mt-3">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="sex" @if($data->sex=='Male') checked="" @endif value="Male" class="custom-control-input"><span class="custom-control-label">Male</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="sex" @if($data->sex=='Female') checked="" @endif class="custom-control-input" value="Female"><span class="custom-control-label">Female</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Complete Address</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <textarea placeholder="House No./Street/Barangay/City/Province" name="address" class="form-control" required="" rows="5" style="resize: none;">{{ $data->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Contact</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" data-mask="phone" placeholder="(0912) 345 6789" name="contact" value="{{ $data->contact }}" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Blood Type</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="Blood Type" name="blood_type" value="{{ $data->blood_type }}" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Date of Birth</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" data-mask="date" name="dob" value="{{ date('m/d/Y',strtotime($data->dob)) }}" required placeholder="MM/DD/YYYY" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row pt-3">
                                        <div class="offset-sm-3 col-sm-9">
                                            <a href="{{ url('accounts') }}" class="btn btn-secondary btn-space">Back</a>
                                            <button type="submit" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Proceed</button>
                                            <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div data-step="2" class="step-pane">
                            <form action="#" id="idNo" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="group-border-dashed">
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <h3 class="wizard-title">Identification Numbers</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Hospital ID</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="Hospital ID" name="hospital_id" value="{{ $data->hospital_id }}"  id="hospital_id" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">TIN</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="TIN" name="tin" value="{{ $data->tin }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">GSIS</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="GSIS" name="gsis" value="{{ $data->gsis }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">PhilHealth</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="PhilHealth" name="phic" value="{{ $data->phic }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">PAGIBIG</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="PAGIBIG" name="pagibig" value="{{ $data->pagibig }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row pt-3">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="button" data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button type="submit" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Proceed</button>
                                        <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div data-step="3" class="step-pane">
                            <form action="#" id="designation" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="group-border-dashed">
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <h3 class="wizard-title">Designation and Section</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Designation</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="Designation" name="designation" value="{{ $data->designation }}" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Section</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select class="select2" id="filterSection" name="section" required>
                                            <option value="">No Section...</option>
                                            <?php  $div = \App\Division::orderBy('name','asc')->get(); ?>
                                            @foreach($div as $d)
                                                <?php $sec = \App\Section::where('div_id',$d->id)->get(); ?>
                                                @if(count($sec)>0)
                                                    <optgroup label="{{ $d->name }}">
                                                        @foreach($sec as $s)
                                                            <option @if($s->id==$data->sec_id) selected @endif value="{{ $s->id }}">{{ $s->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Unit <em class="text-danger">(if applicable)</em></label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select class="select2" name="unit" id="filterUnit">
                                            <option value="">No Unit...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row pt-3">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="button" data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button type="submit" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Proceed</button>
                                        <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div data-step="4" class="step-pane">
                            <form action="#" id="emergency" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="group-border-dashed">
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <h3 class="wizard-title">In Case of Emergency</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">First Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="First Name" name="e_fname" value="{{ $data->e_fname }}" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Middle Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="Middle Name" name="e_mname" value="{{ $data->e_mname }}" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Last Name</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="Last Name" name="e_lname" value="{{ $data->e_lname }}" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Complete Address</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <textarea placeholder="House No./Street/Barangay/City/Province" name="e_address" class="form-control" required="" rows="5" style="resize: none;">{{ $data->e_address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Contact</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" data-mask="phone" placeholder="(0912) 345 6789" name="e_contact" value="{{ $data->e_contact }}" class="form-control" required="">
                                    </div>
                                </div>

                                <div class="form-group row pt-3">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="button" data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button type="submit" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Proceed</button>
                                        <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div data-step="5" class="step-pane">
                            <form action="#" id="account" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="group-border-dashed">
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <h3 class="wizard-title">Account</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Username</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" placeholder="Username" name="username" id="username" value="{{ $data->username }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Email</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="email" placeholder="Email" name="email" value="{{ $data->email }}" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Password</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input data-parsley-minlength="4" type="password" placeholder="Password Unchanged" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row pt-3">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="button" data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button type="submit" data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Complete</button>
                                        <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="md-confirmation" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="mb-3">Delete Confirmation</h4>
                        <p>Are you sure you want to delete this profile?</p>
                        <hr />
                        <div class="mt-2">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>
                            <a href="{{ url('accounts/delete/'.$data->id) }}" class="btn btn-sm btn-space btn-primary">&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            App.wizard();
            App.masks();

            $('form').parsley();

            $('#wizard1').on('actionclicked.fu.wizard', function (evt, data) {
                var step = data.step;

                if(step==1){
                    if( !$("#basicInfo").parsley().validate() ){
                        evt.preventDefault();
                    }
                }

                if(step==2){
                    var hospital_id = $('#hospital_id').val();
                    $('#username').val(hospital_id);
                    if( !$("#idNo").parsley().validate() ){
                        evt.preventDefault();
                    }
                }

                if(step==3){
                    if( !$("#designation").parsley().validate() ){
                        evt.preventDefault();
                    }
                }

                if(step==4){
                    if( !$("#emergency").parsley().validate() ){
                        evt.preventDefault();
                    }
                }

                if(step==5){
                    if( !$("#account").parsley().validate() ){
                        evt.preventDefault();
                    }else{
                        var basicInfo = $("#basicInfo").serializeArray();
                        var idNo = $("#idNo").serializeArray();
                        var emergency = $("#emergency").serializeArray();
                        var designation = $("#designation").serializeArray();
                        var account = $("#account").serializeArray();


                        var data = {};

                        $.map(basicInfo, function(n, i){
                            data[n.name] = n.value;
                        });

                        $.map(idNo, function(n, i){
                            data[n.name] = n.value;
                        });
                        $.map(emergency, function(n, i){
                            data[n.name] = n.value;
                        });
                        $.map(designation, function(n, i){
                            data[n.name] = n.value;
                        });
                        $.map(account, function(n, i){
                            data[n.name] = n.value;
                        });
                        var id = "{{ $data->id }}";
                        data['prof_id'] = id;
                        data['_token'] = "{{ csrf_token() }}";
                        console.log(data);
                        $("#loader-wrapper").css('visibility','visible');

                        $.ajax({
                            url: "{{ url('accounts/update') }}",
                            type: "POST",
                            data: data,
                            success: function(data){
                                url = "{{ url('accounts/update/') }}/"+id+"?q=updated";
                                if(data==='userUpdateDenied')
                                {
                                    url = "{{ url('accounts/update/') }}/"+id+"?q=userUpdateDenied";
                                }

                                window.location = url;
                            }
                        });
                    }
                }
            });
        });

        @if(\Illuminate\Support\Facades\Input::get('q')=='updated')
        lobibox('success','Success','Data successfully updated!');
        @endif

        @if(\Illuminate\Support\Facades\Input::get('q')=='userUpdateDenied')
        lobibox('info','Info','Data successfully updated but ID No. is already taken. Please assign different ID No.');
        @endif

        @if(session('status')=='unitHead')
        lobibox('error','Deletion Denied','The current profile is a Unit Head!');
        @endif

        @if(session('status')=='sectionHead')
        lobibox('error','Deletion Denied','The current profile is a Section Head!');
        @endif

        @if(session('status')=='divisionHead')
        lobibox('error','Deletion Denied','The current profile is a Division Head!');
        @endif


        function lobibox(status,title,msg)
        {
            Lobibox.notify(status, {
                delay: false,
                title: title,
                msg: msg,
                img: "{{ url('img/logo.png') }}",
                sound: false
            });
        }
    </script>

    <script type="text/javascript">
        function readProfURL(input)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#prof_pic').attr('src', e.target.result);
                    $('#prof_pic').addClass('img-responsive');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        @if($data->sec_id)
            var sec_id = "{{ $data->sec_id }}";
            var data = getUnits(sec_id);
            var unit = "{{ $data->unit_id }}";
            populateUnits(data,unit);
        @endif

        $('#filterSection').on('change',function (data) {
            var sec_id = $(this).val();
            var data = getUnits(sec_id);
            populateUnits(data);
        });

        function populateUnits(data,unit)
        {
            $("#loader-wrapper").css('visibility','visible');
            $('#filterUnit').empty()
                .append($('<option>', {
                    value: "",
                    text : "No Unit..."
                }));
            jQuery.each(data, function(i,val){
                $('#filterUnit').append($('<option>', {
                    value: val.id,
                    text : val.name
                }));
            });

            if(unit){
                $('#filterUnit').val(unit).trigger('changed');
            }
            $("#loader-wrapper").css('visibility','hidden');
        }

        function getUnits(sec_id)
        {
                <?php echo 'var url = "'.url('units/json/').'/";';?>
            var tmp;
            $.ajax({
                url: url+sec_id,
                type: 'get',
                async: false,
                success : function(data){
                    tmp = data;
                }
            });
            return tmp;
        }
    </script>
@endsection