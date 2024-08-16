<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    @if ($files->count())
        <div class="max-w-8xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <ul class="divide-y divide-gray-200 mx-4 sm:mx-6 lg:mx-8">
                    @each("files.partials.file.list-item", $files, "file")
                </ul>
                <div class="py-4 px-6 bg-gray-100">
                    {{ $files->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    @else
        @include("files.partials.file.no-files")
    @endif
</x-app-layout>
