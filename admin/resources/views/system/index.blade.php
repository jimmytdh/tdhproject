@extends('app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
@endsection

@section('body')
    <div class="row email">
        @include('reports.system_menu')
        <div class="col-md-9 email-content">
            <div class="email-inbox-header">
                <div class="row">
                    <div class="col-md-8">
                        <div class="email-title"><span class="icon s7-cloud-upload"></span> System Request  </div>
                    </div>
                    <div class="col-md-4">
                        <div class="email-search mt-2">
                            <div class="input-group input-search input-group-sm">
                                <input type="text" placeholder="Search mail..." class="form-control"><span class="input-group-btn">
                                <button type="button" class="btn btn-secondary"><i class="icon s7-search"></i></button></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="email-filters">
                <div class="email-filters-left">

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary"><i class="icon s7-box1"></i> Archived</button>
                        <button type="button" class="btn btn-secondary"><i class="icon s7-shield"></i> Maintenance</button>
                        <button type="button" class="btn btn-secondary"><i class="icon s7-trash"></i> Remove</button>
                    </div>
                </div>
                <div class="email-filters-right"><span class="email-pagination-indicator">1-50 of 253</span>
                    <div class="btn-group email-pagination-nav">
                        <button type="button" class="btn btn-secondary"><i class="s7-angle-left"></i></button>
                        <button type="button" class="btn btn-secondary"><i class="s7-angle-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="email-list">
                <div class="email-list-item email-list-item-unread">
                    <div class="email-list-actions">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label><a href="#" class="favorite active"><span class="s7-star"></span></a>
                    </div>
                    <div class="email-list-detail"><span class="from">CSR Monitoring</span>
                        <p class="msg">Count all supplies per shift.</p>
                        <span class="date"><i class="icon s7-paperclip"></i> 03/21</span>
                    </div>
                </div>
                <div class="email-list-item">
                    <div class="email-list-actions">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label><a href="#" class="favorite"><span class="s7-star"></span></a>
                    </div>
                    <div class="email-list-detail"><span class="from">eSOA</span>
                        <p class="msg">Electronic summary of charges.</p>
                        <span class="date"><i class="icon s7-paperclip"></i> 03/20</span>
                    </div>
                </div>
                <div class="email-list-item">
                    <div class="email-list-actions">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
                        </label><a href="#" class="favorite"><span class="s7-star"></span></a>
                    </div>
                    <div class="email-list-detail"><span class="from">Referral System</span>
                        <p class="msg">Automated referral system used by Government Hospitals.</p>
                        <span class="date"><i class="icon s7-paperclip"></i> 03/18</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script type="text/javascript">

        @if(session('status')=='deleted')
        lobibox('success','Deleted','Section/Department deleted successfully!');
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