@extends('plants.layouts.header')

@section('content')
    <div class="bg-header"></div>
    <div class="fixed-header">
        <div class="title-plant">
            <span>{{ $plant->name }}</span>
        </div>
    </div>
    <div class="main-content">
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
        <div class="main-card">
            <div class="top">

            </div>
            <hr class="lineup-plant" id="lineup-1">
            <div class="bottom">
                <div class="air content-bottom">
                    <div class="icon">
                        <i data-feather="wind" style="stroke: #d2d2d2; width: 18px"></i>
                    </div>
                    <div class="title">
                        <span>%{{ $plant->air }}</span>
                    </div>
                </div>
                <hr class="lineup-plant lineup-2">
                <div class="temp content-bottom">
                    <div class="icon">
                        <i data-feather="thermometer" style="stroke: #d2d2d2; width: 18px"></i>
                    </div>
                    <div class="title">
                        <span>{{ intval($plant->fahrenheit) }} °F</span>
                    </div>
                </div>
                <hr class="lineup-plant lineup-2">
                <div class="soil content-bottom">
                    <div class="icon">
                        <i data-feather="archive" style="stroke: #d2d2d2; width: 18px"></i>
                    </div>
                    <div class="title">
                        <span>%{{ $plant->soil }}</span>
                    </div>
                </div>
            </div>
            <div class="show-more-btn">
                <span id="show-more-trigger">Lihat Selengkapnya</span>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
