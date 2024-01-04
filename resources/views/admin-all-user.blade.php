<x-app-layout>
    @laravelViewsStyles
    @laravelViewsScripts(laravel - views)
    <div class="p-4 sm:ml-64">
        @livewire('users-table-view')

    </div>
    <livewire:scripts />
</x-app-layout>
