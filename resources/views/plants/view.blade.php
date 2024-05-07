@extends('plants.layouts.header')

@section('content')
    <div class="bg-header" style="display: none"></div>
    <div class="fixed-header">
        <div class="back-btn">
            <i data-feather="chevron-left" style="stroke: #b0a1fe"></i>
        </div>
        <div class="title-plant">
            <span>{{ $plant->name }}</span>
        </div>
        <div class="del-btn">
            <i data-feather="sliders" style="stroke: #b0a1fe"></i>
        </div>
    </div>
    <div class="name-plant" style="display: none">
        <h1>{{ $plant->name }}</h1>
    </div>
    <div class="main-content">
        <div class="left-content">
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
                <div class="show-more-content" style="display: none">
                    <div class="heading">Rincian</div>
                    <table class="show-more-table">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>Terhubung</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Udara</td>
                                <td>70%</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Tanah (%)</td>
                                <td>90%</td>
                            </tr>
                            <tr>
                                <td>Kelembaban Tanah</td>
                                <td>4095</td>
                            </tr>
                            <tr>
                                <td>Suhu Celcius</td>
                                <td>70°C</td>
                            </tr>
                            <tr>
                                <td>Suhu Fahrenheit</td>
                                <td>70°F</td>
                            </tr>
                            <tr>
                                <td>Suhu Reamur</td>
                                <td>70°R</td>
                            </tr>
                            <tr>
                                <td>Suhu Kelvin</td>
                                <td>70°K</td>
                            </tr>
                            <tr>
                                <td>Terahir Diperbarui</td>
                                <td>3 Menit yang lalu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="show-more-btn">
                    <span id="show-more-trigger" onclick="openShowMore()">Lihat Selengkapnya</span>
                    <span id="show-less-trigger" onclick="closeShowMore()">Sembuyikan</span>
                    <div class="icon">◢</div>
                </div>
            </div>
            <div class="shower-container">
                <div class="title">Status Penyiraman</div>
                <div class="shower-card active turn-on">
                    <div class="stats">Bersiaga</div>
                    <div class="shower-btn">
                        <button onclick="turnOnShower('{{ $plant->slug }}')">Hidupkan</button>
                    </div>
                </div>
                <div class="shower-card turn-off">
                    <div class="stats">Menyiram</div>
                    <div class="shower-btn">
                        <button>Matikan</button>
                    </div>
                </div>
                <div class="shower-card loading">
                    <div class="stats">Menghubungkan...</div>
                    <div class="shower-btn">
                        <button>
                            <div class="loader"></div>
                        </button>
                    </div>
                </div>
                <div class="shower-card disconnect">
                    <div class="stats">Terputus...</div>
                    <div class="shower-btn">
                        <button>
                            <div class="loader"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-content">

        </div>
        <div class="just-dump" style="height: 1200px"></div>
    </div>
@endsection
@section('scripts')
@endsection
