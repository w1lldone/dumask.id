@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">Operate Station</h2>
            <span>
                Operations List
            </span>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="my-md-3">
        <form action="{{ route('operation.index') }}" method="GET">
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group mb-4">
                        <input type="search" placeholder="Cari nama atau alamat" name="keywords" class="form-control border-0"
                            aria-label="Cari Station" value="{{ request('keywords') }}" />
                        <div class="input-group-append text-primary">
                            <button type="submit" class="btn bg-white border-0">
                                <span class="mdi mdi-magnify"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Sort
                            </span>
                        </div>
                        <select name="sort" class="custom-select" id="" onchange="this.form.submit()">
                            @foreach (\App\Models\Station::$sorts as $key => $value)
                            <option value="{{ $key }}" {{ $sort == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                STATIONS LIST
            </h4>

        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        <div>
            @foreach ($stations as $station)
            <div class="mb-5">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <a href="{{ route('operation.show', $station) }}">
                            <h3 class="text-secondary mb-1">{{ $station->name }}</h3>
                        </a>
                        <a title="Kelola Laporan" class="text-{{ $station->reports_count ? 'danger' : 'muted' }}" data-toggle="tooltip" target="_blank" href="{{ route('station.report.index', $station) }}">
                        Laporan diterima: {{ $station->reports_count }} <span class="mdi mdi-open-in-new"></span></a>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('operation.show', $station) }}">
                            Lihat History pemasangan
                        </a>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="row">
                        @forelse ($station->dropboxes as $dropbox)
                        <div class="col-md-6 d-md-flex mb-3">
                            <img src="{{ $dropbox->image_url }}" alt="" style="max-height: 200px">
                            <div class="ml-3">
                                <h5>Dropbox {{ $dropbox->color }} {{ $dropbox->model }}</h5>
                                <operation-actions :initial-dropbox='@json($dropbox)'></operation-actions>
                            </div>
                        </div>
                        @empty
                        <div class="text-muted text-center col">
                            <h4>Dropbox Tidak Tersedia</h4>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex text-center pt-3">
        {{ $stations->links() }}
    </div>
</div>

@endsection
