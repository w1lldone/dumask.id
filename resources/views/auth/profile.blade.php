@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">PROFILE</h2>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="row flex">
        <div class="col-12 my-2">
            <div class="flex card border-0 px-4 py-3" style="border-radius:0.75em">
                <profile-page :user='{{ json_encode($user) }}'></profile-page>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 row">
    <div class="col-md-6">
        <div class="card card-body border-0">
            <h2 class="text-secondary font-weight-bold">Laporan</h2>
            <div class="d-flex justify-content-between">
                <h5>Jumlah Laporan diajukan:</h5>
                <h5>{{ $user->reports_count }}</h5>
            </div>
            <a href="{{ route('profile.report.index') }}" class="btn btn-primary mt-3">Lihat Riwayat Laporan</a>
        </div>
    </div>
</div>
@endsection
