<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row py-3 justify-content-between">
                <div class="col-md-4">
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
                </div>
                <div class="col-md-2 d-flex">
                    {{-- User Create Modal --}}
                    <user-create-modal class="ml-auto"></user-create-modal>
                </div>
            </div>


            {{-- Users list --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <user-list :permissions='@json(\App\Models\User::$permissions)'
                        :initial-users='@json($users->items())'></user-list>
                </div>
            </div>

            <div class="p-6">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-default-layout>