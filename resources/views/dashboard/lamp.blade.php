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
                        <button type="button" class="btn btn-primary" id="modeAutomaticBtn">Otomatis</button>
                        <button type="button" class="btn btn-secondary" id="modeManualBtn">Manual</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Batas suhu untuk lampu mati saat ini</p>
                            <h6 class="text-danger" id="currentLampOff">N/A</h6>
                            <p>Batas suhu untuk lampu mati</p>
                            <input type="range" class="form-range" min="0" max="100" value="50" id="rangeLampOff">
                            <span class="d-block text-center">°C</span>
                        </div>
                        <div class="col-md-6">
                            <p>Batas suhu untuk lampu menyala saat ini</p>
                            <h6 class="text-success" id="currentLampOn">N/A</h6>
                            <p>Batas suhu untuk lampu menyala</p>
                            <input type="range" class="form-range" min="0" max="100" value="50" id="rangeLampOn">
                            <span class="d-block text-center">°C</span>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary" id="saveLampSettings">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modeAutomaticBtn = document.getElementById('modeAutomaticBtn');
    const modeManualBtn = document.getElementById('modeManualBtn');
    const rangeLampOff = document.getElementById('rangeLampOff');
    const rangeLampOn = document.getElementById('rangeLampOn');
    const saveLampSettings = document.getElementById('saveLampSettings');

    modeAutomaticBtn.addEventListener('click', function () {
        modeAutomaticBtn.classList.add('btn-primary');
        modeAutomaticBtn.classList.remove('btn-secondary');
        modeManualBtn.classList.remove('btn-primary');
        modeManualBtn.classList.add('btn-secondary');
    });

    modeManualBtn.addEventListener('click', function () {
        modeManualBtn.classList.add('btn-primary');
        modeManualBtn.classList.remove('btn-secondary');
        modeAutomaticBtn.classList.remove('btn-primary');
        modeAutomaticBtn.classList.add('btn-secondary');
    });

    saveLampSettings.addEventListener('click', function () {
        const mode = modeAutomaticBtn.classList.contains('btn-primary') ? 'automatic' : 'manual';
        const lampOffTemp = rangeLampOff.value;
        const lampOnTemp = rangeLampOn.value;

        const data = {
            mode: mode,
            lampOffTemp: lampOffTemp,
            lampOnTemp: lampOnTemp
        };

        fetch('/api/lamp-control', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
</script>
@endsection
