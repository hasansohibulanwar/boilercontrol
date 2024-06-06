{{-- resources/views/dashboard/editDevice.blade.php --}}
@extends('kerangka.master')
@section('title', 'Edit Device')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Device</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('device.update', $device->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Device Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $device->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Device Type</label>
                            <input type="text" id="type" name="type" class="form-control" value="{{ old('type', $device->type) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="active" {{ old('status', $device->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $device->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Device</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
