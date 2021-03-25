<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stations Show') }} {{ $station->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex col-md-4">
                <station-edit-modal :station='{{ json_encode($station) }}'></station-edit-modal>
                <station-delete-modal :station='{{ json_encode($station) }}'></station-delete-modal>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container py-4">
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
                    <div class="py-2">
                        Dropboxes
                        <span class="badge badge-primary">Total: {{ $station->dropboxes_count }}</span>
                    </div>
                    <div class="py-2">
                        <station-dropbox-list :station='{{ json_encode($station) }}'></station-edit-modal>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</x-default-layout>