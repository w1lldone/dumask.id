@extends('layouts.app')

@section('title', 'Laporkan kondisi dropbox')

@section('content')

<div class=" d-flex-column my-4 mx-auto w-md-50">
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <report-create-form
            :station='{{ json_encode($station) }}'
            :conditions='@json(\App\Models\Report::$conditions)'
        ></report-create-form>
    </div>
</div>

@endsection
