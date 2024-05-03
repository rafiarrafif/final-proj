@extends('plants.layouts.header')

@section('content')
@endsection
@section('scripts')
    <div class="main-content">
        <div class="title-plant">
            <span>{{ $plant->name }}</span>
        </div>
        <div class="main-spot">
            <div class="top-spot">
                <div class="content-main-spot">
                    <h1>{{ intval($plant->temp) }}<sup>°</sup></h1>
                    <span>Celcius</span>
                </div>
                <div class="img-main-spot">
                    <img src="{{ asset('img/plant_icon_2.png') }}">
                </div>
            </div>
        </div>
    </div>
@endsection
