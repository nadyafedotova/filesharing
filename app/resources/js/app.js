import './bootstrap';
import Alpine from 'alpinejs';
import DetailsTable from './modules/DetailsTable';
import DropBoxOverlay from './modules/DropBoxOverlay';

document.addEventListener('alpine:init', () => {
    if (document.querySelector(".details-table")) {
        Alpine.data('detailsTable', () => ({
            init() {
                new DetailsTable();
            }
        }));
    }

    Alpine.data('dropBoxOverlay', DropBoxOverlay);

    Alpine.data('fileInput', () => ({
        error: '',
        async init() {
            const fileInput = document.querySelector("#file-input");

            if (fileInput) {
                fileInput.addEventListener('change', this.handleFileChange.bind(this));
            }
        },

        async handleFileChange(event) {
            const file = event.target.files[0];
            if (!file) {
                this.error = 'No file selected.';
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch('/upload', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }

                const result = await response.json();
                console.log('Success:', result);
            } catch (error) {
                console.error('Error:', error);
                this.error = 'Upload failed. Please try again.';
            }
        }
    }));

    Alpine.data('mediaElement', () => ({
        init() {
            document.querySelectorAll("audio").forEach((audio) => {
                if (audio.mediaelementplayer) {
                    audio.mediaelementplayer({
                        alwaysShowControls: true,
                        audioVolume: 'horizontal',
                        audioHeight: 40,
                        audioWidth: "40%",
                    });
                }
            });

            document.querySelectorAll("video").forEach((video) => {
                if (video.mediaelementplayer) {
                    video.mediaelementplayer({
                        stretching: "fill",
                    });
                }
            });
        }
    }));

    Alpine.data('deleteItem', () => ({
        async remove(url) {
            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();
                console.log(result);
            } catch (error) {
                console.error('Error:', error);
            }
        }
    }));
});

window.Alpine = Alpine;
Alpine.start();
