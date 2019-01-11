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
                    <form method="post" action="{{ url('units/update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $data->id }}" />
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Code</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="code" value="{{ $data->code }}" required="" placeholder="Section/Department Code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="name" value="{{ $data->name }}" required="" placeholder="Section/Department Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Section/Department Head</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="head_id">
                                    <option value="">Select Section/Department Head...</option>
                                    @foreach($profiles as $p)
                                        <option @if($p->id==$data->head_id) selected @endif value="{{ $p->id }}">{{ $p->lname }}, {{ $p->fname }}</option>
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
                                                    <option @if($s->id==$data->sec_id) selected @endif value="{{ $s->id }}">{{ $s->name }}</option>
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
                                <button type="submit" class="btn btn-space btn-primary">Update</button>
                                <button type="button" data-toggle="modal" data-target="#md-confirmation" class="btn btn-space btn-danger"> Delete </button>
                            </div>
                        </div>
                    </form>
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
                        <p>Are you sure you want to delete this section?</p>
                        <hr />
                        <div class="mt-2">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>
                            <a href="{{ url('units/delete/'.$data->id) }}" class="btn btn-sm btn-space btn-primary">&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</a>
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

        @if(session('status')=='updated')
        lobibox('success','Updated','Unit updated successfully!');
        @endif

        @if(session('status')=='denied')
        lobibox('error','Deletion Denied','Please remove all personnel under this unit first!');
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