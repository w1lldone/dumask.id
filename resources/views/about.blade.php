@extends('layouts.app')

@section('title', 'Tentang Dumask.id')

@section('content')

<div class="container w-md-75 my-4">
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
            ABOUT DUMASK.ID
        </h2>
        <hr class="my-2">
        <div class="text-secondary text-center mt-4 mx-auto">
            <h5 style="line-height: 175%">
                Pada masa pandemi saat ini, penduduk dunia memakai
                <b>129 milyar masker dan 65 milyar sarung tangan plastik</b> sekali pakai setiap bulannya.
                Jumlah pemakaian yang luar biasa ini telah terlihat dampaknya di lingkungan sekitar berupa tercemarnya sungai,
                pantai dan lautan serta berbagai macam hewan terjerat oleh limbah ini.
                Mudah sekali saat ini dijumpai limbah masker bekas berserakan di pinggir jalan.
            </h5>
        </div>
    </div>
    <div class="d-flex row text-center my-4 mx-auto">
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_1.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_2.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_8.jpeg')}}" alt="About Dumask.id">
        </div>
    </div>
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <div class="text-secondary text-center my-2 mx-auto">
            <h5 style="line-height: 175%">
                <b>Dumask</b> adalah penelitian kolaboratif yang didanai oleh program PPKI 2021 - 2023.
                Program penelitian ini merupakan kolaborasi antara peneliti PTNBH dari UGM, ITB, UNS dan UNAIR
                yang juga didukung oleh para peneliti dari UAD, Politeknik ATK, UJB, dan UP45. DUMASK bertujuan
                khusus untuk menyediakan jalur pembuangan masker dan sarung tangan bekas dari masyarakat umum yang
                aman dan ramah lingkungan.
            </h5>
        </div>
    </div>
    <div class="d-flex row text-center my-4 mx-auto">
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_4.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_6.jpeg')}}" alt="About Dumask.id">
        </div>
        <div class="col-12 col-md-4 my-2">
            <img class="img img-fluid rounded shadow" src="{{ asset('img/about_7.jpeg')}}" alt="About Dumask.id">
        </div>
    </div>
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <h5 class="text-secondary text-center font-weight-bold my-2 mb-0">
            Kumpulkan masker bekasmu di rumah, simpan dalam kantong plastik/kertas
            tertutup rapi dan buang ke dropbox Dumask terdekat.
        </h5>
    </div>

</div>

@endsection
