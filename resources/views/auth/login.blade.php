@extends('layouts.client')

@section('content')
<div class="login-register-wrapper section-padding">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <!-- Login Content Start -->
                <div>
                    <div class="login-reg-form-wrap">
                        <h5>Sign In</h5>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" name="email" placeholder="Email or Username"/>
                            </div>
                            <div class="single-input-item">
                                <input type="password" name="password" placeholder="Enter your Password"/>
                            </div>
                            <div class="single-input-item">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                        </div>
                                    </div>
                                    <a href="#" class="forget-pwd">Forget Password?</a>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button type="submit" class="btn btn-sqr">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Content End -->

                <!-- Register Content Start -->
                <!-- Register Content End -->
            </div>
        </div>
    </div>
</div>
@endsection