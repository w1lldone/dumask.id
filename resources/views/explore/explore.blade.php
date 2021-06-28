@extends('layouts.app')

@section('title', 'Temukan Dumask disekitarmu!')

@section('content')

<div class="container w-md-75 my-4">
    <explore-map></explore-map>
    <div class="row justify-content-between py-5 mt-3">
        <div class="col-md-5 px-0 mb-2">
            <div class="card shadow rounded border-0 p-4" style="border-radius: 0.5rem">
                <div class="row">
                    <div class="col-10">
                        <h5 class="text-secondary font-weight-bold">Total Stasiun DUMASK.ID</h5>
                        <h3 class="text-primary font-weight-bold">{{ $stats['total_stations'] }}</h3>
                    </div>
                    <div class="col-2">
                        <img class="img-fluid" width="100%" src="{{ asset('/img/location.svg') }}" alt="">
                    </div>
                    <div class="col-12">
                        <h5 class="text-muted">unit lokasi</h5>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-5 px-0 mb-2">
            <div class="card shadow rounded border-0 p-4" style="border-radius: 0.5rem">
                <div class="row">
                    <div class="col-10">
                        <h5 class="text-secondary font-weight-bold">Total Limbah Terkumpul
                        </h5>
                    </div>
                    <div class="col-2">
                        <img class="img-fluid" width="100%" src="{{ asset('/img/scale.svg') }}" alt="">
                    </div>
                    <div class="col-12">
                        <h3 class="text-primary font-weight-bold">{{ $stats['total_weight'] }}</h3>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-muted">Kilogram</h5>
                            <small class="text-muted">Updated {{ $stats['last_operation_at'] }}</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-5 pr-4 mb-4">
            <img class="mt-2 pr-4 w-100" src="{{ asset('img/ilus_dumask.svg')}}" alt="ilus-dumask">
        </div>
        <div class="col-md-7 pr-0">
            <h3 class="text-primary text-left pl-4 font-weight-bold">
                YUK, KENALAN DULU SAMA DUMASK.ID
            </h3>
            <div class="px-4 pt-2 mb-4" style="border-radius: 0.5rem">
                <div class="my-3">
                    <h5 class="text-secondary font-weight-bold">
                       Siapa pengelola Dumask.id?
                    </h5>
                    <h6>
                        Dumask.id dikelola secara kolaboratif oleh peneliti UGM bekerja sama dengan beberapa universitas lain.
                    </h6>
                </div>
                <div class="my-3">
                    <h5 class="text-secondary font-weight-bold">
                       Sampah apa yang bisa dibuang di dropbox Dumask?
                    </h5>
                    <h6>
                        Sampah masker dan sarung tangan bekas pakai dari masyarakat.
                        <b>Dropbox bukan untuk limbah medis dari RS/Klinik</b>.
                    </h6>
                </div>
                <div class="my-3">
                    <h5 class="text-secondary font-weight-bold">
                       Apa perbedaan dari variasi warna dan model dropbox Dumask?
                    </h5>
                    <h6>
                        Semua variasi warna dan model dropbox berfungsi sama, silahkan bebas pilih salah satu.
                        Pengelola melakukan variasi hanya untuk keperluan penelitian.
                    </h6>
                </div>
                <div class="my-3">
                    <h5 class="text-secondary font-weight-bold">
                       Sampah Dumask akan dikelola menjadi apa?
                    </h5>
                    <h6>
                        Sampah masker dan sarung tangan akan dimusnahkan menggunakan teknologi termal yang aman.
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
