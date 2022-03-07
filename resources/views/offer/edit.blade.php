<x-app-layout>
	<x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Offer') }}
            </h2>
            <a href="{{ route('offers.index') }}">
                <x-jet-secondary-button>
                    Cancel
                </x-jet-secondary-button>
            </a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-project-form :model="$model" />
            </div>
        </div>
    </div>
</x-app-layout>
