{{-- resources/views/dashboard/lamp.blade.php --}}
@extends('kerangka.master')
@section('title', 'Kontrol Lampu')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Kontrol Lampu</h4>
                    <div>
                        <select class="form-select d-inline-block w-auto" id="deviceSelect">
                            <option value="A001">A001</option>
                            <!-- Tambahkan opsi perangkat lain di sini -->
                        </select>
                        <button class="btn btn-primary"><i class="bi bi-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <h5>Status Lampu</h5>
                    <div class="btn-group mb-3" role="group">
                        <button type="button" class="btn btn-primary active">Otomatis</button>
                        <button type="button" class="btn btn-secondary">Manual</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Batas suhu untuk lampu mati saat ini</p>
                            <h6 class="text-danger">N/A</h6>
                            <p>Batas suhu untuk lampu mati</p>
                            <input type="range" class="form-range" min="0" max="100" value="50" id="rangeLampOff">
                            <span class="d-block text-center">°C</span>
                        </div>
                        <div class="col-md-6">
                            <p>Batas suhu untuk lampu menyala saat ini</p>
                            <h6 class="text-success">N/A</h6>
                            <p>Batas suhu untuk lampu menyala</p>
                            <input type="range" class="form-range" min="0" max="100" value="50" id="rangeLampOn">
                            <span class="d-block text-center">°C</span>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
