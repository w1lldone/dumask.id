<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('station.index') }}" style="text-decoration: none">{{ __('Stations List') }}</a> <span class="mdi mdi-chevron-right"></span> {{ $station->name }}
        </h2>
    </x-slot>

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
                            <a href="{{ route('station.dropbox.index', $station) }}">Lihat Log berat Dropbox</a>
                        </div>
                        <div class="col-md-12 py-4">
                            <div class="d-flex flex-column row">
                                <station-schedule-list :station='{{ json_encode($station) }}'></station-schedule-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                <station-delete-modal class="ml-auto" :station='{{ json_encode($station) }}'></station-delete-modal>
            </div>
        </div>
    </div>
</x-default-layout>
