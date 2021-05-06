@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">STATIONS</h2>
            <span>
                Station List
            </span>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="my-md-3">
        <form action="{{ route('station.index') }}" method="GET">
            <div class="input-group mb-4">
                <input type="search" placeholder="Cari nama station" name="keywords" class="form-control border-0" aria-label="Cari Station" value="{{ request('keywords') }}" />
                <div class="input-group-append text-primary">
                    <button type="submit" class="btn bg-white border-0">
                        <span class="mdi mdi-magnify"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                STATION LIST
            </h4>
            {{-- Station Create Modal --}}
            <station-create-modal class="ml-auto"></station-create-modal>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        
        {{-- Stations list --}}
        <station-list :initial-stations='@json($stations->items())'></station-list>

        <div class="p-6">
            {{ $stations->links() }}
        </div>
    </div>
</div>

@endsection
