{{-- resources/views/dashboard/heater.blade.php --}}
@extends('kerangka.master')
@section('title', 'Configuration Heater')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4>Configuration Heater</h4>
                </div>
                <div class="card-body">
                    <form>
                        <h5>Mode</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mode" id="modeManual" value="manual" checked>
                            <label class="form-check-label" for="modeManual">
                                Manual
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mode" id="modeAutomatic" value="automatic">
                            <label class="form-check-label" for="modeAutomatic">
                                Otomatis
                            </label>
                        </div>

                        <div id="manualSettings" class="mt-4">
                            <h5>Manual Control</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="heaterSwitch">
                                <label class="form-check-label" for="heaterSwitch">Heater On/Off</label>
                            </div>
                        </div>

                        <div id="automaticSettings" class="mt-4 d-none">
                            <h5>Automatic Control</h5>
                            <div class="mb-3">
                                <label for="maxTemp" class="form-label">Max Temperature</label>
                                <input type="number" class="form-control" id="maxTemp" name="max_temp">
                            </div>
                            <div class="mb-3">
                                <label for="minTemp" class="form-label">Min Temperature</label>
                                <input type="number" class="form-control" id="minTemp" name="min_temp">
                            </div>
                            <div class="mb-3">
                                <label for="maxTempRange" class="form-label">Max Temperature Range</label>
                                <input type="range" class="form-range" id="maxTempRange" name="max_temp_range" min="0" max="100">
                            </div>
                            <div class="mb-3">
                                <label for="minTempRange" class="form-label">Min Temperature Range</label>
                                <input type="range" class="form-range" id="minTempRange" name="min_temp_range" min="0" max="100">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modeManual = document.getElementById('modeManual');
    const modeAutomatic = document.getElementById('modeAutomatic');
    const manualSettings = document.getElementById('manualSettings');
    const automaticSettings = document.getElementById('automaticSettings');

    modeManual.addEventListener('change', function () {
        if (this.checked) {
            manualSettings.classList.remove('d-none');
            automaticSettings.classList.add('d-none');
        }
    });

    modeAutomatic.addEventListener('change', function () {
        if (this.checked) {
            manualSettings.classList.add('d-none');
            automaticSettings.classList.remove('d-none');
        }
    });
});
</script>
@endsection
