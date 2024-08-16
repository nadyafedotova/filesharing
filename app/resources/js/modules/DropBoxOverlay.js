export default function DropBoxOverlay() {
    console.log('File input initialized');
    return {
        showOverlay: false,
        fileInputId: '#file-input',
        files: [],
        init() {
            this.fileInput = document.querySelector(this.fileInputId);
            this.dropZone = document.body;
            this.dropZone.classList.add('dropzone');

            this.dropZone.addEventListener('dragenter', this.preventDefaults.bind(this));
            this.dropZone.addEventListener('dragover', this.preventDefaults.bind(this));
            this.dropZone.addEventListener('dragleave', this.preventDefaults.bind(this));
            this.dropZone.addEventListener('drop', this.handleFileDrop.bind(this));

            this.dropZone.addEventListener('dragenter', () => this.showOverlay = true);
            this.dropZone.addEventListener('dragleave', () => this.showOverlay = false);
            this.dropZone.addEventListener('drop', () => this.showOverlay = false);
        },
        handleFileDrop(e) {
            this.preventDefaults(e);
            const files = Array.from(e.dataTransfer.files);
            if (files.length > 0) {
                this.files = files;
                this.uploadFiles(files);
            }
        },
        uploadFiles(files) {
            const formData = new FormData();
            files.forEach(file => formData.append('files[]', file));

            fetch('/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Upload successful:', data);
                })
                .catch(error => console.error('Error:', error));
        },
        preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
    };
}
