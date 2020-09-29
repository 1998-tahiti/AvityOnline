@extends('base')

@section('main')

    <div class="container my-5">
        <div class="row">
            @foreach ($idcs as $idc)
                <div class="col-sm-3 p-3">

                    <div class="card" style="width: 15em;">
                        <div class="card-header">
                            <strong>
                                {{ $idc->name }}
                            </strong>
                        </div>
                        <div class="card-body">
                            <img src="{{ route('show-identicon', $idc->id) }}"
                                style="width: 100%; height: 15em; object-fit: contain;">
                        </div>
                        <div class="card-footer">
                            <div class="btn-group w-100">
                                <a href="{{ route('show-identicon', $idc->id) }}" download="{{ $idc->name }}.png" class="btn btn-outline-primary">Download</a>
                                <a href="{{ route('delete-identicon', $idc->id) }}" class="btn btn-outline-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    </div>

@endsection
