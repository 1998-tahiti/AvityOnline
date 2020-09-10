@extends('base')

@section('main')

    <div class="container my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Actions
                    </th>
                    <th>
                        TRNX ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Address
                    </th>

                    <th>
                        Email
                    </th>
                </tr>
            </thead>
            <tbody>
        @foreach ($users as $user)
            <tr>
                <td>

                    <div class="btn-group">
                        <a href="{{ route('confirm-upgrade', $user->id) }}" class="btn btn-success">
                            Accept
                        </a>

                        <a href="{{ route('reject-upgrade', $user->id) }}" class="btn btn-danger">
                            Reject
                        </a>
                    </div>

                </td>
                <td>
                    <span style="font-size: 1.5em; font-weight: 900;">{{ $user->upgrade_transaction_id }}</span>
                </td>
                <td>{{ $user->name }}</td>
                <td><a href="tel:{{ $user->number }}">{{ $user->number }}</a></td>
                <td>{{ $user->billing_address }}</td>
                <td><a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a></td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>

@endsection
