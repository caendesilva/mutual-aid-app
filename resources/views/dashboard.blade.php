<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @can('manageUsers')
                <livewire:user-table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
