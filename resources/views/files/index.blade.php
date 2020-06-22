@extends("layouts.master")

@section("content")
    @if ($files->count())
        <ul class="list-group file-list">
            <li class="list-group-item"><h5 class="text-center">Файлы</h5></li>
            @each("files.partials.file.list-item", $files, "file")
        </ul>
        <div class="d-flex justify-content-center">
            {{ $files->links() }}
        </div>

    @else
        @include("files.partials.file.no-files")
    @endif
@endsection
