@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header dashboard">Calendar</div>

                <div class="card-body bg-color-secondary-green">
                    <calendar></calendar>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
