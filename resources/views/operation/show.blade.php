<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('operation.index') }}" style="text-decoration: none">{{ __('Stations List') }}</a>
            <span class="mdi mdi-chevron-right"></span>{{ $station->name }} Dropbox Log
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="row py-4 justify-content-between">
                        @foreach ($dropboxes as $dropbox)
                        <div class="col-md-6">
                            <div class="h3">
                                Dropbox {{ $dropbox->color }} {{ $dropbox->model }}
                            </div>
                            @foreach ($dropbox->dropboxLogs as $key => $log)
                            Pemasangan ke {{ $key+1 }}
                            @if ($log->final_weight)
                            Berat bersih {{ $log->final_weight - $log->weight }}
                            @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Berat</th>
                                        <th>Diukur oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            @endforeach

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
