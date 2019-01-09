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
    <div class="main-content container">
        <div class="row">
            <div class="col-sm-6">
                <!--Bootstrap Modals-->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">Bootstrap Modals<span class="panel-subtitle">These are the different modal styles using bootstrap modals</span></div>
                    <div class="panel-body">
                        <p>Modals are streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults.</p>
                        <div class="mt-3 mb-2 text-center">
                            <button data-toggle="modal" data-target="#md-default" type="button" class="btn btn-space btn-primary"> Default</button>
                            <button data-toggle="modal" data-target="#md-fullWidth" type="button" class="btn btn-space btn-primary"> Full Width</button>
                            <button data-toggle="modal" data-target="#md-custom" type="button" class="btn btn-space btn-primary"> Custom width</button>
                            <button data-toggle="modal" data-target="#md-fullColor" type="button" class="btn btn-space btn-primary"> Full Color</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider"></div>
                <div class="panel-body pl-sm-5">
                    <form method="post" action="{{ url('divisions/update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="" name="id" />
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Code</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="code" value="" required="" placeholder="Section Code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="name" value="" required="" placeholder="Division Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-left text-sm-right">Division Head</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <select class="select2" name="head_id">
                                    <option value="">Select Division Head...</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <a href="{{ url('divisions') }}" class="btn btn-space btn-secondary">&nbsp;&nbsp;Back&nbsp;&nbsp; </a>
                                <button type="submit" class="btn btn-space btn-primary">Update</button>
                                <button type="button" data-toggle="modal" data-target="#md-default" class="btn btn-space btn-danger"> Delete </button>
                                <button type="button" data-modal="md-scale" class="btn btn-space btn-danger md-trigger"> Delete </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="md-scale" class="modal-container modal-effect-1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="s7-close"></span></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                    <h3 class="mb-5">Awesome!</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    <div class="mt-5">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary modal-close">Cancel</button>
                        <button type="button" data-dismiss="modal" class="btn btn-primary modal-close">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Bootstrap Modals-->
    <div id="md-default" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-fullWidth" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-custom" tabindex="-1" role="dialog" class="custom-width modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-fullColor" tabindex="-1" role="dialog" class="modal modal-full-color modal-full-color-primary fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center"><span class="modal-main-icon s7-info"></span>
                        <h3 class="mb-4">Information!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- --- Default Modals-->
    <!--Modal Alerts-->
    <div id="mod-primary" tabindex="-1" role="dialog" style="" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-info" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-info"><span class="modal-main-icon s7-info"></span></div>
                        <h3 class="mb-4">Information!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-info">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-warning" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-warning"><span class="modal-main-icon s7-attention"></span></div>
                        <h3 class="mb-4">Warning!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-warning">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-danger" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon s7-close-circle"></span></div>
                        <h3 class="mb-4">Danger!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-danger">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Dark Modals-->
    <div id="md-dark-primary" tabindex="-1" role="dialog" style="" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-info" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-info"><span class="modal-main-icon s7-info"></span></div>
                        <h3 class="mb-4">Information!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-info">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-warning" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-warning"><span class="modal-main-icon s7-attention"></span></div>
                        <h3 class="mb-4">Warning!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-warning">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-danger" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon s7-close-circle"></span></div>
                        <h3 class="mb-4">Danger!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                        <div class="mt-6">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">Cancel</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-danger">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- --- Footer Modals-->
    <!--Modal Alerts-->
    <div id="mod-footer-primary" tabindex="-1" role="dialog" style="" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-footer-info" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-info"><span class="modal-main-icon s7-info"></span></div>
                        <h3 class="mb-4">Information!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-info">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-footer-warning" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-warning"><span class="modal-main-icon s7-attention"></span></div>
                        <h3 class="mb-4">Warning!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-warning">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="mod-footer-danger" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon s7-close-circle"></span></div>
                        <h3 class="mb-4">Danger!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-danger">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <!--Dark Modals-->
    <div id="md-dark-footer-primary" tabindex="-1" role="dialog" style="" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-primary"><span class="modal-main-icon s7-check"></span></div>
                        <h3 class="mb-4">Awesome!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-footer-info" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-info"><span class="modal-main-icon s7-info"></span></div>
                        <h3 class="mb-4">Information!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-info">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-footer-warning" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-warning"><span class="modal-main-icon s7-attention"></span></div>
                        <h3 class="mb-4">Warning!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-warning">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <div id="md-dark-footer-danger" tabindex="-1" role="dialog" class="modal modal-dark fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="text-danger"><span class="modal-main-icon s7-close-circle"></span></div>
                        <h3 class="mb-4">Danger!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-secondary">Cancel</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link btn-link-danger">Proceed</button>
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
    <script src="{{ url('/') }}/assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js" type="text/javascript"></script>
    <script type="text/javascript">
        //Set Nifty Modals defaults
        $.fn.niftyModal('setDefaults',{
            overlaySelector: '.modal-overlay',
            contentSelector: '.modal-content',
            closeSelector: '.modal-close',
            classAddAfterOpen: 'modal-show',
            classModalOpen: 'modal-open',
            classScrollbarMeasure: 'modal-scrollbar-measure',
            afterOpen: function(){
                $("html").addClass('mai-modal-open');
            },
            afterClose: function(){
                $("html").removeClass('mai-modal-open');
            }
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            App.init();
            App.wizard();
            $('form').parsley();
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
    <script type="text/javascript">
        $(document).ready(function(){
            App.livePreview();
        });

    </script>
@endsection