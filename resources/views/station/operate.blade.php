<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('station.index') }}" style="text-decoration: none">{{ __('Stations List') }}</a>
            <span class="mdi mdi-chevron-right"></span>
            <a href="{{ route('station.show', $station) }}" style="text-decoration: none">{{ $station->name }}</a>
            <span class="mdi mdi-chevron-right"></span> Operation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="row py-4">
                        <div class="col-md-2">

                        </div>
                        @foreach ($dropboxes as $dropbox)
                            <div class="col-md-5">
                                <div class="text-center">
                                    Dropbox {{ $dropbox->model }} {{ $dropbox->color }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
