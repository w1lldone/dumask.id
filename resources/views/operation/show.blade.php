@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-12 flex px-md-0 pt-sm-0 w-100">
            <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
                <h2 class="text-secondary font-weight-bold">OPERATIONS</h2>
                <span>
                    <a href="{{ route('operation.index') }}">Operations List</a> 
                    <span class="mdi mdi-chevron-right"></span> Detail Operation
                </span>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex-column">
        <div class="my-3">
            <a
                href = "/operation/"
                class="btn btn-primary "
            >
                <span class="mdi mdi-arrow-left pr-2"></span>
                KEMBALI
            </a>
        </div>
        <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
            <div class="d-flex">
                <h4 class="text-dark font-weight-bold my-auto">
                    {{ $station->name }}
                </h4>
            </div>
            <hr style="border-bottom: 2px solid #c4c4c4;">

            <div class="row py-2 justify-content-between">
                @foreach ($dropboxes as $dropbox)
                <div class="col-md-6 my-3">
                    <div class="p-3" style="border: 1px solid #c4c4c4; border-radius:0.75em">
                        <h5 class="text-secondary font-weight-bold my-auto">
                            Dropbox {{ $dropbox->color }} {{ $dropbox->model }}
                        </h5>
                        <hr style="border-bottom: 2px solid #c4c4c4;">
    
                        @foreach ($dropbox->dropboxLogs as $key => $log)
                        <div class="p-3 my-3" style="border: 1px solid #c4c4c4; border-radius:0.75em">
                            <h5 class="text-dark font-weight-bold my-auto">
                                Pemasangan ke {{ $key+1 }}
                            </h5>
                            @if ($log->final_weight)
                            <div class="my-2">
                                Berat bersih <span class="text-secondary">{{ $log->final_weight - $log->weight }} gram</span>
                            </div>
                            @endif
                            <hr style="border-bottom: 2px solid #c4c4c4;">
                            <table class="table table-borderless table-responsive d-md-table">
                                <thead style="border-bottom: 1px solid #c4c4c4;">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Berat (gram)</th>
                                        <th>Diukur oleh</th>
                                    </tr>
                                </thead>
                                <tbody class="text-secondary">
                                    <tr>
                                        <td>{{ $log->starts_at->format('j F Y') }}</td>
                                        <td>{{ $log->weight }}</td>
                                        <td>{{ optional($log->user)->name }}</td>
                                    </tr>
                                    @foreach ($log->children as $child)
                                    <tr>
                                        <td>{{ $child->ends_at->format('j F Y') }}</td>
                                        <td>{{ $child->final_weight }}</td>
                                        <td>{{ optional($child->user)->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
