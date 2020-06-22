@extends ("layouts.master")

@section ("content")
    <div class="dropbox-overlay">
        <div class="vertical-center justify-content-center">
            <div class="dropbox-overlay__info d-flex flex-column">
                <div class="dropbox-overlay__text">Пожалуйста, перетащите файл сюда.</div>
                <span class="dropbox-overlay__hint">Максимальный размер файла 100 MB.</span>
            </div>
        </div>
    </div>
    <div class="vertical-center">
        <div class="container">
            <form action="/upload" id="file-upload-form" method="post" enctype="multipart/form-data" >
              @csrf
                <div class="form-group">
                    <input id="file-input" name="file" type="file">
                    <div class="file-upload-errors"></div>
                </div>
            </form>
            <div class="filesize-max">Максимальный размер файла 100 MB</div>
        </div>
    </div>
@endsection
