@extends('layouts.app')

@section('title', 'Temukan Dumask disekitarmu!')

@section('content')

<div class="container w-md-75 my-4">
    <explore-map></explore-map>
    <div class="card border-0 shadow p-4 mt-4" style="border-radius: 0.5rem">
        <h3 class="text-primary text-center font-weight-bold mb-3">
            EVERYTHING YOU NEED TO KNOW ABOUT DUMASK.ID
        </h3>
        <div class="my-2">
            <h5 class="text-secondary font-weight-bold">
               Siapa pengelola Dumask.id?
            </h5>
            <h6>
                Dumask.id dikelola secara kolaboratif oleh peneliti UGM bekerja sama dengan beberapa universitas lain.
            </h6>
        </div>
        <div class="my-2">
            <h5 class="text-secondary font-weight-bold">
               Sampah apa yang bisa dibuang di dropbox Dumask?
            </h5>
            <h6>
                Sampah masker dan sarung tangan bekas pakai dari masyarakat. 
                <b>Dropbox bukan untuk limbah medis dari RS/Klinik</b>.
            </h6>
        </div>
        <div class="my-2">
            <h5 class="text-secondary font-weight-bold">
               Apa perbedaan dari variasi warna dan model dropbox Dumask?
            </h5>
            <h6>
                Semua variasi warna dan model dropbox berfungsi sama, silahkan bebas pilih salah satu. 
                Pengelola melakukan variasi hanya untuk keperluan penelitian.
            </h6>
        </div>
        <div class="my-2">
            <h5 class="text-secondary font-weight-bold">
               Sampah Dumask akan dikelola menjadi apa?
            </h5>
            <h6>
                Sampah masker dan sarung tangan akan dimusnahkan menggunakan teknologi termal yang aman.
            </h6>
        </div>
    </div>
</div>

@endsection
