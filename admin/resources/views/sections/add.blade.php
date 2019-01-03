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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">{{ $title }}</div>
                <div class="panel-body pl-sm-5">
                    <form method="post" action="{{ url('sections/save') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Code</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="code" required="" placeholder="Section Code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="name" required="" placeholder="Section Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Section Head</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="head_id">
                                    <option value="">Select Section Head...</option>
                                    @foreach($profiles as $p)
                                        <option value="{{ $p->id }}">{{ $p->lname }}, {{ $p->fname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Division</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="division" required>
                                    <option value="">Select Division...</option>
                                    @foreach($division as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <a href="{{ url('sections') }}" class="btn btn-space btn-secondary">&nbsp;&nbsp;Back&nbsp;&nbsp; </a>
                                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            App.wizard();
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
                        data['_token'] = "{{ csrf_token() }}";
                        console.log(data);
                        $("#loader-wrapper").css('visibility','visible');

                        $.ajax({
                            url: "{{ url('accounts/save') }}",
                            type: "POST",
                            data: data,
                            success: function(data){
                                window.location = "{{ url('accounts/add?q=added') }}";
                            }
                        });
                    }
                }
            });
        });

        @if(\Illuminate\Support\Facades\Input::get('q')=='added')
        lobibox('success','Success','Data successfully added to database!');
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
@endsection