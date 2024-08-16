<li class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-50">
    <div class="flex-1">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-4">
                <div class="text-lg font-semibold text-gray-900">
                    {{ $file->original_name }}
                </div>
                <form action="{{ route('delete', $file->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="flex space-x-2">
                        <a href="/download/{{ $file->id }}/{{ $file->original_name }}"
                           class="px-6 py-2.5 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Скачать
                        </a>
                        <button type="submit" title="Удалить файл"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt"></i>
                            <span>Удалить</span>
                        </button>
                    </div>
                </form>
            </div>
            @if (isset($file->meta_data["mime_type"]))
                @php
                    $mimeType = explode("/", $file->meta_data["mime_type"])[0];
                @endphp
                @if ($mimeType === "image")
                    <div class="mb-2">
                        <img class="w-full h-auto rounded-lg" src="{{ asset("storage/images/$file->storage_name") }}"
                             alt="{{ $file->original_name }}">
                    </div>
                @elseif ($mimeType === "audio")
                    <div class="mb-2">
                        <audio class="w-full" controls>
                            <source src="/download/{{ $file->id }}/{{ $file->original_name }}"
                                    type="{{ $file->meta_data["mime_type"] }}">
                            Ваш браузер не поддерживает элемент <code>audio</code>.
                        </audio>
                    </div>
                @elseif ($mimeType === "video")
                    <div class="mb-2">
                        <video class="w-full h-auto" controls>
                            <source src="/download/{{ $file->id }}/{{ $file->original_name }}"
                                    type="{{ $file->meta_data["mime_type"] }}">
                            Ваш браузер не поддерживает элемент <code>video</code>.
                        </video>
                    </div>
                @endif
            @endif
            @include("files.partials.file.card")
        </div>
    </div>
</li>
