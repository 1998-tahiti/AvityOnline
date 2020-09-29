@extends('base')

@section('main')

    <div class="container my-5">
        <div class="row">
            <form class="col-sm-6 mx-auto" method="POST" action={{ route('update-profile') }}>
                @csrf
                @method('PATCH')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    <br />
                @endif

                @if (Session::has('message'))
                    <br>
                    <div class="alert alert-{{ Session::has('avity_error') ? 'danger' : 'success' }}">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <h2 class="display-4">
                    Your Profile

                    @if (Auth::user()->is_upgraded)
                        <span class="badge badge-warning">PRO</span>
                    @else
                        <span class="badge badge-secondary">BASIC</span>
                    @endif
                </h2>
                <br />
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="form-control form-control-lg" name="name"
                        placeholder="Your Name" />
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="form-control" name="email"
                        placeholder="Your Email Address" />
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="{{ Auth::user()->number }}" class="form-control" name="number"
                        placeholder="Your Phone Number" />
                </div>
                <div class="form-group">
                    <input type="submit" value="Update Profile" class="btn btn-primary">
                </div>

                <br />
                <hr />
                <br />

                <h4>Update Password</h4>

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" value="{{ Auth::user()->phone }}" class="form-control" name="old_password" />
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" value="{{ Auth::user()->phone }}" class="form-control" name="new_password" />
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" value="{{ Auth::user()->phone }}" class="form-control"
                        name="confirm_new_password" />
                </div>

                <div class="form-group">
                    <input type="submit" value="Update Password" class="btn btn-danger">
                </div>
            </form>

            @if (Auth::user()->is_upgraded)
            @else
                <div class="col-sm-6 p-5" style="background: #fff3cc;">
                    <h2><b>Upgrade</b> Profile</h2>

                    <br />
                    <br />

                    <div class="alert alert-info">
                        You are still using free version,
                        transfer exactly <strong>৳1,200</strong> via bKash to
                        <b>01630655234</b> and enter the <b>TrnxID</b> below
                        to Upgrade.
                    </div>

                    <form method="POST" action="{{ route('upgrade-profile') }}">
                        @csrf

                        <div class="form-group">
                            <label>Transaction ID</label>
                            <input type="text" value="{{ Auth::user()->upgrade_transaction_id }}" class="form-control"
                                name="trnx_id" />
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control form-control-lg"
                                name="name" placeholder="Your Name" />
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" value="{{ Auth::user()->number }}" class="form-control" name="number"
                                placeholder="Your Phone Number" />
                        </div>

                        <div class="form-group">
                            <label>Billing Address</label>
                            <textarea name="billing_address"
                                class="form-control">{{ Auth::user()->billing_address }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="UPGRADE" class="btn btn-warning btn-lg d-block w-100">
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection
