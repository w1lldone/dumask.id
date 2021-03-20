<x-default-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- User Create Modal --}}
            <user-create-modal class="py-3"></user-create-modal>

            {{-- Users list --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <user-list :initial-users='@json($users->items())'></user-list>
                </div>
            </div>

            <div class="p-6">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-default-layout>