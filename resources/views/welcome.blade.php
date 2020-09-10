@extends('base')

@section('main')

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-7 mx-auto">
                <div class="jumbotron">
                    <h1 class="display-4">
                        Faceless, but Unique!
                    </h1>
                    <p class="lead">
                        Don't you absolutely hate showing your face on a public forum,
                        but wish you had a unique image to represent you, kinda like
                        <a href="https://github.com" target="_blank">GitHub</a> identicons?
                    </p>
                    <hr class="my-4">
                    <p>
                        Avity gives you the power to do it everywhere,
                        wheter you're a developper integrating identicons in your app
                        or a very privacy conscious user.
                    </p>
                    <br />
                    <br />
                    <a class="btn btn-primary btn-lg" href="{{ Auth::check() ? route('app') : route('login-form') }}" role="button">
                        @if (Auth::check())
                            Go to <strong>Identicon Studio</strong>
                        @else
                            Register or Login
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
