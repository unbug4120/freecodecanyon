@extends('layouts.app')
@section('title', 'Login')
@section('content')
<section class="min-vh-100 d-flex align-items-center bg-secondary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="card card-tertiary w-100 fmxw-400">
                    <div class="card-header text-center">
                        <span>Sign in to our platform</span>
                    </div>
                    <div class="card-body">
                        <form action="#" class="mt-4">

                            <div class="form-group">
                                <label for="email" class="mb-2">Email</label>
                                <input id="email" type="email" class="form-control" placeholder="Your email" required="">
                            </div>

                            <div class="form-group">

                                <div class="form-group">
                                    <label for="password" class="mb-2">Password</label>
                                    <input id="password" type="password" class="form-control" placeholder="Your password" required="">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-x"></span>
                                            <span class="form-check-sign"></span>
                                            Remember me
                                        </label>
                                    </div>
                                    <p class="m-0"><a href="#" class="text-right" style="font-family: 'Windows 95', sans-serif;font-size: 0.6rem;">Lost password?</a></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </form>
                        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
                            <p class="font-weight-normal" style="font-family: 'Windows 95', sans-serif;font-size: 0.6rem;">
                                Not registered?
                                <a href="/register" class="font-weight-bold" style="font-family: 'Windows 95', sans-serif;font-size: 0.6rem;">Create account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection