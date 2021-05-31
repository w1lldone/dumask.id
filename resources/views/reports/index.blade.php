@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">REPORT</h2>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                REPORT LIST
            </h4>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        <div class="custom-control custom-switch">
            <form id="form-show-all" action="{{ route('station.report.index', ['station' => $station->id])  }}" method="GET">
                <div class="input-group mb-4">
                    <input
                        type="checkbox"
                        class="custom-control-input"
                        id="show_all"
                        name="show_all"
                        value="true"
                        @if (request('show_all'))
                            checked
                        @endif
                        onchange="this.form.submit()"
                    >
                    <label class="custom-control-label text-secondary" for="show_all">Tampilkan laporan yang sudah selesai diproses.</label>
                </div>
            </form>
        </div>
        <div>
            @if ($reports->count())
                <report-list
                    :station='@json($station)'
                    :reports='@json($reports)'
                    :conditions='@json(\App\Models\Report::$conditions)'
                >
                </report-list>
            @endif
        </div>
    </div>
</div>


@endsection
