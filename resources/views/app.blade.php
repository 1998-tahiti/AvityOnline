@extends('base')

@section('title', 'Identicon Studio | Avity')

@section('main')

    <div class="container-fluid">
        <form class="row" method="GET" action="{{ route('preview') }}" target="preview">
            <div class="col-sm-3 py-5 px-4">
                <div class="form-group">
                    <label class="form-label">Style</label>
                    <select name="style" class="form-control">
                        <option value="square" selected>Square</option>
                        <option value="circle">Circle</option>
                        <option value="triangle">Triangle</option>
                        <option value="square-circle">Square + Circle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Symmetry</label>
                    <select name="symmetry" class="form-control">
                        <option value="vertical" selected>Vertical</option>
                        <option value="horizontal">Horizontal</option>
                        <option value="diagonal">Diagonal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Color</label>
                    <input data-jscolor="{value:'#8B5BFF'}" name="color" class="form-control form-control-lg">
                </div>

                <div class="form-group px-4">
                    <input type="checkbox" class="form-check-input" id="variance" name="vary" checked>
                    <label class="form-check-label" for="variance">Vary Color</label>
                </div>

                <div class="form-group">
                    <label class="form-label">Background Color</label>
                    <input data-jscolor="{value:'#F0F0F0'}" name="background" class="form-control form-control-lg">
                </div>

                <div class="form-group">
                    <label class="form-label">Unique Data</label>
                    <input type="text" name="data" class="form-control" value="{{ Auth::user()->email }}">
                </div>

                <div class="form-group">
                    <input type="submit" value="Generate" class="btn btn-primary d-block w-100">
                </div>
            </div>
            <div class="col-sm-3 py-5 px-3">
                <div class="form-group">
                    <label class="form-label">Spacing</label>
                    <input type="numeric" name="spacing" class="form-control" value="0">
                </div>

                <div class="form-group">
                    <label class="form-label">Padding</label>
                    <input type="numeric" name="padding" class="form-control" value="32">
                </div>

                <div class="form-group">
                    <label class="form-label">Dimensions</label>
                    <div class="row">
                        <div class="col">
                            <input name="width" type="number" value="256" class="form-control" {{ !Auth::user()->is_upgraded ? 'disabled' : '' }}>
                        </div>
                        <div class="co">
                            X
                        </div>
                        <div class="col">
                            <input name="height" type="number" value="256" class="form-control" {{ !Auth::user()->is_upgraded ? 'disabled' : '' }}>
                        </div>
                    </div>

                    @unless(Auth::user()->is_upgraded)
                        <div class="row pt-2">
                            <p class="text-danger px-3">
                                You need to <a href="{{ route('profile') }}">Upgrade</a> in order to change identicon dimensions.
                            </p>
                        </div>
                    @endunless
                </div>

                <div class="form-group">
                    <label class="form-label">Grid Dimensions</label>
                    <div class="row">
                        <div class="col">
                            <input name="columns" type="number" value="5" class="form-control" {{ !Auth::user()->is_upgraded ? 'disabled' : '' }}>
                        </div>
                        <div class="co">
                            X
                        </div>
                        <div class="col">
                            <input name="rows" type="number" value="5" class="form-control" {{ !Auth::user()->is_upgraded ? 'disabled' : '' }}>
                        </div>
                    </div>

                    @unless(Auth::user()->is_upgraded)
                        <div class="row pt-2">
                            <p class="text-danger px-3">
                                You need to <a href="{{ route('profile') }}">Upgrade</a> in order to change identicon dimensions.
                            </p>
                        </div>
                    @endunless
                </div>
            </div>
            <div class="col-sm-6 py-5 px-5">
                <div class="row">
                    <div class="col">
                        <h3>Your Identicon</h3>
                        <br>
                        <iframe id="t" name="preview" src="{{ $preview_link }}" style="border: 0; width: 100%; height: 25em;"></iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ $preview_link }}" download="identicon.png" class="btn btn-outline-success w-100">
                            Download
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" id="sb" class="btn btn-outline-{{ Auth::user()->is_upgraded ? 'primary' : 'danger' }} w-100">
                            Save
                        </a>

                        @unless(Auth::user()->is_upgraded)
                            <p class="text-danger my-2">
                                You must <a href="{{ route('profile') }}">Upgrade</a> in order to save your identicons.
                            </p>
                        @endunless
                    </div>
                </div>


            </div>
        </form>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.3.3/jscolor.min.js" integrity="sha512-KVabwlnqwMHqLIONPKHQTGzW4C0dg3HEPwtTCVjzGOW508cm5Vl6qFvewK/DUbgqLPGRrMeKL3Ga3kput855HQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>

    <script>
        jscolor.presets.default = {
            format: 'hex', previewSize: 56
        };

        const uped = {{ Auth::user()->is_upgraded ? 'true' : 'false' }};

        if (uped) {
            document.getElementById('sb').addEventListener('click', function () {
                const name = prompt("NAME YOUR IDENTICON", "Untitled Identicon");
                const url = document.getElementById('t').contentWindow.location.href.replace('preview', 'identicons');

                axios.post(url, {
                    name
                }).then(() => {
                    alert(`${name} has been saved.`);
                }).catch(() => {
                    alert('Some error occured.');
                });
            });
        }
    </script>

@endsection
