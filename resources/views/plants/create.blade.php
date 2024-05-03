@extends('plants.layouts.header')

@section('content')
    <div class="main-content">
        <div class="header-title">
            <h1>Tambahkan Tanaman</h1>
        </div>
        <div class="content-form">
            <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Tanaman</label>
                    <input type="text" class="form-input" id="name" name="name" maxlength="100" required
                        placeholder="Masukkan nama tanaman">
                </div>
                <div class="form-group">
                    <label for="description">Catatan Tanaman</label>
                    <textarea class="form-input" id="description" name="notes" rows="4" maxlength="255"
                        placeholder="Masukkan deskripsi tanaman"></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
                <a href="{{ route('home') }}" class="cancel-btn">Batalkan</a>
            </form>
        </div>
    </div>
@endsection
