import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const inputHiddenValue = document.querySelector('[name="imagen"]');
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Arrastra o sube tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (inputHiddenValue.value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = inputHiddenValue.value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`,

                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
            );
        }
    },
});
dropzone.on("success", function (file, response) {
    inputHiddenValue.value = response.imagen;
});


dropzone.on('removedfile', ()=>{
    inputHiddenValue.value =''
})
