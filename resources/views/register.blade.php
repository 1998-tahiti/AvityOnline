@extends('base')

@section('title', 'Register | Avity')

@section('main')

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <h1 class="display-5">
                    Register
                    <br />
                    <small class="text-muted">To take unlock of your visual privacy.</small>
                </h1>

                <br><br>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" class="form" method="POST" autocomplete="off">
                    @csrf

                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    <div class="form-group">
                        <input type="text" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Email Address" name="email">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" placeholder="Confirm Password"
                            name="confirm">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Register" class="btn btn-success btn-lg w-100 d-block">
                    </div>
                </form>

                <hr>

                <p class="text-center my-4">
                    Login if you already have an account.
                </p>

                <a href="{{ route('login-form') }}" class="btn btn-lg btn-primary w-100 d-block">
                    Login
                </a>
            </div>
        </div>
    </div>

@endsection
