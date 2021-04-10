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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <station-media-manager :station='@json($station)'></station-media-manager>
                        </div>
                    </div>
                    
                    <div class="py-2">
                        <div class="d-flex flex-column row">
                            <station-schedule-list :station='{{ json_encode($station) }}'></station-schedule-list>
                        </div>
                    </div>
                    <div class="py-2">
                        Dropboxes
                        <span class="badge badge-primary">Total: {{ $station->dropboxes_count }}</span>
                    </div>
                    <div class="py-2">
                        <dropbox-create-modal :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)' :models='@json(\App\Models\Dropbox::$availableModels)'></dropbox-create-modal>
                        <station-dropbox-list :station='{{ json_encode($station) }}' :colors='@json(\App\Models\Dropbox::$availableColors)' :models='@json(\App\Models\Dropbox::$availableModels)'></station-dropbox-list>
                    </div>
                </div>
            </div>
            <div class="flex">
                <station-delete-modal class="ml-auto" :station='{{ json_encode($station) }}'></station-delete-modal>
            </div>
        </div>
    </div>
</x-default-layout>