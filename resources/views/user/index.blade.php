@extends('layouts.template')
@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">USERS</h2>
            <span>
                User List
            </span>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="my-md-3">
        <form action="{{ route('user.index') }}" method="GET">
            <div class="input-group mb-4">
                <input type="search" placeholder="Cari nama atau email" name="keywords" class="form-control border-0" aria-label="Cari Station" value="{{ request('keywords') }}" />
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
                USERS LIST
            </h4>
            {{-- User Create Modal --}}
            <user-create-modal :permissions='@json(\App\Models\User::$permissions)' class="ml-auto"></user-create-modal>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        
        {{-- Users list --}}
        <user-list :permissions='@json(\App\Models\User::$permissions)'
                    :initial-users='@json($users->items())'></user-list>
    </div>
    <div class="d-flex text-center pt-3">
        {{ $users->links() }}
    </div>
</div>

@endsection