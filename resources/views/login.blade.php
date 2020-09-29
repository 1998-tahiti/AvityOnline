@extends('base')

@section('title', 'Login | Avity')

@section('main')

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <h1 class="display-4">
                    Login
                    <br/>
                    <small class="text-muted">To take control of your privacy.</small>
                </h1>


                @if(Session::has('message'))
                    <br>
                    <div class="alert alert-{{ Session::has('avity_error') ? 'danger' : 'success' }}">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <br>

                <form action="{{ route('login') }}" class="form" method="POST">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Email Address" name="email">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-primary btn-lg d-block w-100">
                    </div>
                </form>

                <hr>

                <p class="text-center my-4">
                    If you don't already have an account, please get registered.
                    It's Free!
                </p>

                <a href="{{ route('registration-form') }}" class="btn btn-lg btn-success w-100 d-block">
                    Register
                </a>
            </div>
        </div>
    </div>

@endsection
