@extends('layouts.master')

@section('content')
    <div class="wrapper wrapper-full-page">
        <div class="full-page register-page" filter-color="black" data-image="{{asset('assets/img/register-bg.png')}}">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <div class="card card-signup">
                                <h2 class="card-title text-center">Register</h2>
                                <div class="row">
                                    <div class="card-content">
                                        <div class="social text-center">
                                            <button class="btn btn-just-icon btn-round btn-twitter">
                                                <i class="fa fa-twitter"></i>
                                            </button>
                                            <button class="btn btn-just-icon btn-round btn-dribbble">
                                                <i class="fa fa-dribbble"></i>
                                            </button>
                                            <button class="btn btn-just-icon btn-round btn-facebook">
                                                <i class="fa fa-facebook"> </i>
                                            </button>
                                            <h4> or be classical </h4>
                                        </div>

                                        <form class="form" method="" action="#">
                                            <div class="card-content">
                                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                                    <input type="text" class="form-control" placeholder="First Name...">
                                                </div>

                                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                                    <input type="text" class="form-control" placeholder="Email...">
                                                </div>

                                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                                    <input type="password" placeholder="Password..." class="form-control" />
                                                </div>
\

                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes" checked>
                                                        I agree to the <a href="#something">terms and conditions</a>.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="footer text-center">
                                                <a href="#pablo" class="btn btn-primary btn-round">Get Started</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
