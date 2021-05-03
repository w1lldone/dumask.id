@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">STATIONS</h2>
            <span>
                <a href="{{ route('station.index') }}">Stations List</a> 
                <span class="mdi mdi-chevron-right"></span> Detail Station
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
                STATION DETAIL
            </h4>
            {{-- Station Delete Modal --}}
            <div class="ml-auto">
                <station-delete-modal :station='{{ json_encode($station) }}'></station-delete-modal>
            </div>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        
        <div class="d-flex mb-4">
            <h3 class="text-secondary font-weight-bold my-auto">
                {{ $station->name }}
            </h3>
        </div>

        <div class="row ">
            <div class="col-md-7">
                <div class="col-12 px-0 rounded" style="border: 1px solid #c4c4c4;">
                    <div class="d-flex my-3" >
                        <div class="col-4 text-secondary">
                            Alamat
                        </div>
                        <div class="col-8">
                            {{ $station->address }}
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="col-4 mt-3 text-secondary">
                            Jam Operasional
                        </div>
                        <div class="col-8 px-0">
                            <station-schedule-list :station='{{ json_encode($station) }}'></station-schedule-list>
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="col-4 text-secondary">
                            Total Dropbox
                        </div>
                        <div class="col-8">
                            {{ $station->dropboxes_count }}
                        </div>
                    </div>
                    <div class="col-12 mb-3 text-right">
                        <station-edit-modal :station='{{ json_encode($station) }}'></station-edit-modal>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <media-carousel :station-id="{{ $station->id }}"></media-carousel>
                <station-media-manager class="float-right mt-2" :station='@json($station)'></station-media-manager>
            </div>
        </div>

        <hr class="my-4" style="border-bottom: 1px solid #c4c4c4;">

        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                DROPBOX LIST
            </h4>
            {{-- Station Delete Modal --}}
            <div class="ml-auto">
                <dropbox-create-modal :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)'
                    :models='@json(\App\Models\Dropbox::$availableModels)'></dropbox-create-modal>      
            </div>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">

        <div class="">
            <station-dropbox-list class="w-100" :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)'
                :models='@json(\App\Models\Dropbox::$availableModels)'></station-dropbox-list>          
        </div>

    </div>
</div>

@endsection