@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">STATIONS</h2>
            <span>
                <a href="{{ route('station.index') }}">Stations List</a> 
                <span class="mdi mdi-chevron-right"></span> {{ $station->name }}
            </span>
        </div>
    </div>
</div>

<div class="mt-4 d-flex-column">
    <div class="my-md-3">
        <a
            href = "/station/"
            class="btn btn-primary "
        >
            <span class="mdi mdi-arrow-left pr-2"></span>
            KEMBALI
        </a>
    </div>
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                STATION DETAL
            </h4>
            {{-- Station Delete Modal --}}
            <station-delete-modal class="ml-auto" :station='{{ json_encode($station) }}'></station-delete-modal>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        
        <div class="d-flex">
            <h3 class="text-secondary font-weight-bold my-auto">
                {{ $station->name }}
            </h3>
        </div>

        <div class="row ">
            <div class="col-md-6 rounded border-1 border-dark">
                <div class="d-flex">
                    <div class="col-4 text-secondary">
                        Alamat
                    </div>
                    <div class="col-8">
                        {{ $station->address }}
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-3 text-secondary">
                        Jam Operasional
                    </div>
                    <div class="col-9">
                        <station-schedule-list :station='{{ json_encode($station) }}'></station-schedule-list>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-3 text-secondary">
                        Total Dropbox
                    </div>
                    <div class="col-9">
                        {{ $station->dropboxes_count }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <station-edit-modal :station='{{ json_encode($station) }}'></station-edit-modal>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
                <div class="container py-4">
                    <div class="row">
                        <div class="col-md-7">
                            <h3>
                                {{ $station->name}}
                            </h3>
                            <span class="text-muted">{{ $station->address}}</span>
                            <div class="py-2">
                                Description:
                                <div>
                                    {{ $station->description}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <media-carousel :station-id="{{ $station->id }}"></media-carousel>
                            <station-media-manager class="float-right mt-2" :station='@json($station)'></station-media-manager>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="py-2 d-flex align-items-center justify-content-between">
                                <h3>Dropboxes <span class="badge badge-primary">Total: {{ $station->dropboxes_count }}</span></h3>
                                <dropbox-create-modal :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)'
                                    :models='@json(\App\Models\Dropbox::$availableModels)'></dropbox-create-modal>
                            </div>
                            <div class="py-2">
                                <station-dropbox-list :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)'
                                    :models='@json(\App\Models\Dropbox::$availableModels)'></station-dropbox-list>
                            </div>
                        </div>
                        <div class="col-md-12 py-4">
                            <div class="d-flex flex-column row">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                
            </div>
        </div>
    </div>
@endsection