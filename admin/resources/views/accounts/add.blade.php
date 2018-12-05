@extends('app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/fuelux/css/wizard.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/select2/css/select2.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/bootstrap-slider/css/bootstrap-slider.min.css"/>
@endsection

@section('body')
    <div class="row wizard-row">
        <div class="col-md-12 fuelux">
            <div class="block-wizard">
                <div id="wizard1" class="wizard wizard-ux">
                    <div class="steps-container">
                        <ul class="steps">
                            <li data-step="1" class="active">Step 1<span class="chevron"></span></li>
                            <li data-step="2">Step 2<span class="chevron"></span></li>
                            <li data-step="3">Step 3<span class="chevron"></span></li>
                        </ul>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-xs btn-prev btn-secondary"><i class="icon s7-angle-left"></i>Prev</button>
                        <button type="button" data-last="Finish" class="btn btn-xs btn-next btn-secondary">Next<i class="icon s7-angle-right"></i></button>
                    </div>
                    <div class="step-content">
                        <div data-step="1" class="step-pane active">
                            <div class="container pl-sm-5">
                                <form action="#" id="basicInfo" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <h3 class="wizard-title">Basic Information</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">User Name</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="User name" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">E-Mail</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="text" placeholder="User E-Mail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Password</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="password" placeholder="Enter your password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-left text-sm-right pr-sm-0 pl-sm-0">Verify Password</label>
                                        <div class="col-12 col-sm-8 col-lg-6">
                                            <input type="password" placeholder="Enter your password again" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row pt-3">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button class="btn btn-secondary btn-space">Cancel</button>
                                            <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div data-step="2" class="step-pane">
                            <form action="#" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="group-border-dashed">
                                <div class="form-group row">
                                    <div class="col-sm-7">
                                        <h3 class="wizard-title">Notifications</h3>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-sm-7">
                                        <label class="control-label">E-Mail Notifications</label>
                                        <p>This option allow you to recieve email notifications by us.</p>
                                    </div>
                                    <div class="col-sm-3 xs-pt-15">
                                        <div class="switch-button">
                                            <input type="checkbox" checked="" name="swt1" id="swt1"><span>
                              <label for="swt1"></label></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-sm-7">
                                        <label class="control-label">Phone Notifications</label>
                                        <p>Allow us to send phone notifications to your cell phone.</p>
                                    </div>
                                    <div class="col-sm-3 xs-pt-15">
                                        <div class="switch-button">
                                            <input type="checkbox" checked="" name="swt2" id="swt2"><span>
                              <label for="swt2"></label></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-sm-7">
                                        <label class="control-label">Global Notifications</label>
                                        <p>Allow us to send notifications to your dashboard.</p>
                                    </div>
                                    <div class="col-sm-3 xs-pt-15">
                                        <div class="switch-button">
                                            <input type="checkbox" checked="" name="swt3" id="swt3"><span>
                              <label for="swt3"></label></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row pt-3">
                                    <div class="col-sm-12">
                                        <button data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button data-wizard="#wizard1" class="btn btn-primary btn-space wizard-next">Next Step</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div data-step="3" class="step-pane">
                            <form action="#" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
                                <div class="form-group row">
                                    <div class="col-sm-7">
                                        <h3 class="wizard-title">Configuration</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Buy Credits: <span id="credits">$30</span></label>
                                        <p>This option allow you to buy an amount of credits.</p>
                                        <input id="credit_slider" type="text" value="30" class="bslider form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Change Plan</label>
                                        <p>Change your plan many times as you want.</p>
                                        <select class="select2">
                                            <optgroup label="Personal">
                                                <option value="p1">Basic</option>
                                                <option value="p2">Medium</option>
                                            </optgroup>
                                            <optgroup label="Company">
                                                <option value="p3">Standard</option>
                                                <option value="p4">Silver</option>
                                                <option value="p5">Gold</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Payment Rate: <span id="rate">5%</span></label>
                                        <p>Choose your payment rate to calculate how much money you will recieve.</p>
                                        <input id="rate_slider" data-slider-min="0" data-slider-max="100" type="text" value="5" class="bslider form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Keywords</label>
                                        <p>Write your keywords to do a successful SEO with web search engines.</p>
                                        <select multiple="" class="tags">
                                            <option value="1">Twitter</option>
                                            <option value="2">Google</option>
                                            <option value="3">Facebook</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button data-wizard="#wizard1" class="btn btn-secondary btn-space wizard-previous">Previous</button>
                                        <button data-wizard="#wizard1" class="btn btn-success btn-space wizard-next">Complete</button>
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

@section('js')
    <script src="{{ url('/') }}/assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            App.wizard();
            $('form').parsley();

            $('#wizard1').on('actionclicked.fu.wizard', function (evt, data) {
                if( !$("#basicInfo").parsley().validate() ){
                    evt.preventDefault();
                }

            });
        });
    </script>
@endsection