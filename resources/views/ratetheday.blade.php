@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header dashboard">Rate your day :)</div>

                    <div class="card-body bg-color-secondary-green">
                        <ratetheday></ratetheday>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
