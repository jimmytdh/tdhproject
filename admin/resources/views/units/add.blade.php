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
                    <form method="post" action="{{ url('units/save') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Code</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input autofocus type="text" name="code" required="" placeholder="Unit Code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="name" required="" placeholder="Unit Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Unit Head</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="head_id">
                                    <option value="">Select Unit Head...</option>
                                    @foreach($profiles as $p)
                                        <option value="{{ $p->id }}">{{ $p->lname }}, {{ $p->fname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Section</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="section" required>
                                    <option value="">Select Section...</option>
                                    <?php  $div = \App\Division::orderBy('name','asc')->get(); ?>
                                    @foreach($div as $d)
                                        <?php $sec = \App\Section::where('div_id',$d->id)->get(); ?>
                                        @if(count($sec)>0)
                                        <optgroup label="{{ $d->name }}">

                                            @foreach($sec as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <a href="{{ url('units') }}" class="btn btn-space btn-secondary">&nbsp;&nbsp;Back&nbsp;&nbsp; </a>
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
        });

        @if(\Illuminate\Support\Facades\Input::get('q')=='added')
        lobibox('success','Success','Data successfully added to database!');
        @endif

        @if(session('status')=='added')
        lobibox('success','Added','Unit added successfully!');
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