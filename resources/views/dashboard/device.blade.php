{{-- resources/views/dashboard/device.blade.php --}}
@extends('kerangka.master')
@section('title', 'Manage Devices')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Manage Devices</h4>
                    <a href="{{ route('device.create') }}" class="btn btn-primary">Tambah Device</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Device</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->description }}</td>
                                <td>
                                    <a href="{{ route('device.edit', $device->id) }}" class="btn btn-warning btn-sm">Update</a>
                                    <form action="{{ route('device.destroy', $device->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
