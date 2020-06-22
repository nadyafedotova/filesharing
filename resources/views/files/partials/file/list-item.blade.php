<li class="list-group-item file-list__item">
    <div class="media">
        <div class="media-body">
            <div class="file-info file-info--margin-bot">
                <div class="file-info__file-name">
                    <span>{{ $file->original_name }}</span>
                    <form action="{{ route('delete', $file->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                        <a class="btn btn-primary" href="/download/{{ $file->id }}/{{ $file->original_name }}" role="button">Скачать</a>
                        <button id="remove" title="Remove file" class="btn btn-danger btn-secondary"><i class="fas fa-trash-alt"></i><span class="hidden-xs">Удалить</span></button>
                    </form>
                </div>
            </div>
            @if (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "image")
                <div class="image mb-2">
                  <img class="img-fluid" src="{{ asset("storage/images/$file->storage_name") }}" alt="{{ $file->original_name }}">
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "audio")
                <div class="audio mb-2">
                    <audio src="/download/{{ $file->id }}/{{ $file->original_name }}"></audio>
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "video")
                <div>
                    <video-link>
                        <source src="/download/{{ $file->id }}/{{ $file->original_name }}" type="{{ $file->meta_data["mime_type"] }}">
                    </video-link>
                </div>
            @endif
            @include("files.partials.file.card")
        </div>
    </div>
</li>
