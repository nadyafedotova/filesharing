<div class="file mt-4 mb-2">
    <div class="media">
        <div class="media-body">
            <div class="file-info file-info--margin-bot">
                <div class="file-info__file-name">
                    <span>{{ $file->original_name }}</span>
                </div>
            </div>
            @if (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "image")
                <div class="image mb-2">
                    <img class="img-fluid" src="{{ asset("storage/images/$file->storage_name") }}" alt="{{ $file->original_name }}">
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Детали</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>Общие сведения</b></td>
                        </tr>
                        <tr>
                            <td>Формат:</td>
                            <td>{{ strtoupper($file->meta_data["fileformat"]) }}</td>
                        </tr>
                        <tr>
                            <td>Размер:</td>
                            <td>{{ $file->meta_data["video"]["resolution_x"]."x".$file->meta_data["video"]["resolution_y"] }}</td>
                        </tr>
                        <tr>
                            <td>Глубина цвета:</td>
                            <td>{{ $file->meta_data["video"]["bits_per_sample"]."-bit" }}</td>
                        </tr>
                    </table>
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "audio")
                <div class="audio mb-2">
                    <audio src="/download/{{ $file->id }}/{{ $file->original_name }}"></audio>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Детали</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>Общие сведения</b></td>
                        <tr>
                            <td colspan="2"><b>Аудио</b></td>
                        </tr>
                        <tr>
                            <td>Битрейт:</td>
                            <td>{{ round($file->meta_data["audio"]["bitrate"]/1000) . " kbit/s" }}</td>
                        </tr>
                        <tr>
                            <td>Частота выборки:</td>
                            <td>{{ $file->meta_data["audio"]["sample_rate"]/1000 . " kHz" }}</td>
                        </tr>
                        <tr>
                            <td>Количество каналов:</td>
                            <td>{{ $file->meta_data["audio"]["channels_count"] }}</td>
                        </tr>
                    </table>
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "video")
                <div>
                    <video-link>
                        <source src="/download/{{ $file->id }}/{{ $file->original_name }}" type="{{ $file->meta_data["mime_type"] }}">
                    </video-link>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Детали</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>Общие сведения</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Видео</b></td>
                        </tr>
                        <tr>
                            <td>Размер:</td>
                            <td>{{ $file->meta_data["video"]["resolution_x"]."x".$file->meta_data["video"]["resolution_y"] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Аудио</b></td>
                        </tr>
                        <tr>
                            <td>Частота выборки:</td>
                            <td>{{ $file->meta_data["audio"]["sample_rate"]/1000 . " kHz" }}</td>
                        </tr>
                        <tr>
                            <td>Количество каналов:</td>
                            <td>{{ $file->meta_data["audio"]["channels_count"] }}</td>
                        </tr>
                    </table>
                </div>
            @endif
            @include("files.partials.file.card")
            <a class="btn btn-primary" href="/download/{{ $file->id }}/{{ $file->original_name }}" role="button">Скачать</a>
        </div>
    </div>
</div>
