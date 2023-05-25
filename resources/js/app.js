import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imgPublic = {};
            imgPublic.size = 1234;
            imgPublic.name = document.querySelector('[name="imagen"]').value

            this.options.addedfile.call(this, imgPublic);
            this.options.thumbnail.call(this, imgPublic, `/uploads/${imgPublic.name}`);

            imgPublic.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }

});

dropzone.on('success', (file, response) => {
    document.querySelector('[name="imagen"]').value = response.img;
});

dropzone.on('removedfile', () => {
    document.querySelector('[name="imagen"]').value = '';
});
