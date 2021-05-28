@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">REPORT</h2>
            <span>
                
            </span>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                REPORT LIST
            </h4>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        
        <div>
            <report-list
                :reports='@json($reports)'
                :conditions='@json(array_keys(\App\Models\Report::$conditions))'
                :detail='@json(\App\Models\Report::$conditions)'
            >
            </report-list>
        </div>
    </div>
</div>

@endsection
