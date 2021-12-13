@extends('layouts.app')

@section('title', 'Survey')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5">
            @if ($surveyUrl)
                <div class="bg-none rounded border-0 d-flex align-items-center h-100">
                    <iframe id="gform" src="{{ $surveyUrl }}" width="100%" height="1500px" frameborder="0" marginheight="0"
                        marginwidth="0" onload="loaded()">Loading…</iframe>
                </div>
            @else
                <div style="height: 50vh" class="py-5">
                    <h1 class="text-primary">Belum ada survey yang diselenggarakan</h1>
                    <h5>Silahkan kembali lain waktu</h5>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    var loadCounter = 0;
   function loaded () {
       console.log('loaded');
       loadCounter += 1;
       if (loadCounter === 2) {
           $("#oc-contact").attr("height", "500px");
           $('#oc-contact').goTo();
       }
   }
</script>

@endsection
