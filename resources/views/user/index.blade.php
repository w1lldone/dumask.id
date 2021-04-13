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
            <div class="input-group">
                <input type="search" placeholder="Cari nama atau email" name="keywords" class="form-control border-0" aria-label="Cari Station" value="{{ request('keywords') }}" />
                <div class="input-group-append text-primary">
                    <button type="submit" class="btn bg-white border-0">
                        <span class="mdi mdi-magnify"></span>
                    </button>
                </div>
            </div>
        </form>
        {{-- <form @submit.prevent="fetchStations()">
            <div class="input-group shadow">
              <input
                type="text"
                placeholder="Cari Station"
                class="form-control border-0"
                v-model="form.keywords"
                aria-label="Cari Station"
              />
              <div class="input-group-append text-primary">
                <button
                  v-show="form.keywords"
                  type="button"
                  class="btn border-0"
                  @click="form.keywords = null"
                >
                  <span class="mdi mdi-close"></span>
                </button>
                <button type="submit" class="btn border-0">
                  <span class="mdi mdi-magnify"></span>
                </button>
              </div>
            </div>
          </form> --}}


    </div>
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                USERS LIST
            </h4>
            {{-- User Create Modal --}}
            <user-create-modal class="ml-auto"></user-create-modal>
        </div>
        <hr>
        
        {{-- Users list --}}
        <user-list :permissions='@json(\App\Models\User::$permissions)'
                    :initial-users='@json($users->items())'></user-list>
    </div>
    {{ $users->links() }}
</div>
@endsection