@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">Riwayat Laporan</h2>
            <span>
                <a href="{{ route('profile.index') }}">Profile</a>
                <span class="mdi mdi-chevron-right"></span>
                Riwayat Laporan
            </span>
        </div>
    </div>
</div>
<div class="my-md-3">
    <a href="{{ route('profile.index') }}" class="btn btn-primary "><span class="mdi mdi-arrow-left pr-2"></span>
        KEMBALI
    </a>
</div>
<div class="mt-3 row">
    <div class="col-md-12">
        <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
            <div class="d-flex">
                <h4 class="text-dark font-weight-bold my-auto">
                    LIST LAPORAN
                </h4>
            </div>
            <hr style="border-bottom: 2px solid #c4c4c4;">

            {{-- Stations list --}}
            <table class="table table-borderless table-responsive d-md-table">
                <thead style="border-bottom: 1px solid rgb(196, 196, 196);">
                    <tr>
                        <th>Tanggal Laporan</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Tanggal Diselesaikan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->created_at->format('d F Y') }}</td>
                            <td class="text-primary font-weight-bold">
                                {{ $report->description() }}
                            </td>
                            <td>
                                @if ($report->resolved_at)
                                    <span class="badge badge-success badge-pill">
                                        Resolved
                                    </span>
                                @else
                                    <span class="badge badge-danger badge-pill">
                                        Open
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($report->resolved_at)
                                    {{ $report->resolved_at->format('d F Y') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-6">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
