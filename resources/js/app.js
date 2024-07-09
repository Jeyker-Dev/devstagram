import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener('DOMContentLoaded', function() 
{
    iniciarApp();
});
function iniciarApp() 
{
    dropzone();
}

function dropzone()
{
    const dropzone = new Dropzone('#myDropzone', 
        {
            dictDefaultMessage: "Sube tu Imagen",
            acceptedFiles: ".png,.jpg,.jpeg,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar Imagen",
            maxFiles: 4,
            uploadMultiple: false,
            init: function() 
            {
                if( document.querySelector('[name="imagen"]').value.trim() )
                    {
                        const imagenPublicada = {};
                        imagenPublicada.size = 1234;
                        imagenPublicada.name = document.querySelector('[name="imagen"]').value;

                        this.options.addedfile.call(this, imagenPublicada );
                        this.options.thumbnail.call( this, imagenPublicada, `/public/uploads/${imagenPublicada.name}`);

                        imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
                    }
            }
    
        });
        
        dropzone.on('sending', function(file, xhr, formData)
        {
            console.log(file);
        });

        dropzone.on('error', function(file, message)
        {
            console.log(message);
        });

        dropzone.on('removedfile', function()
        {
            console.log('Archivo Eliminado');
        });

        dropzone.on('success', function(file, response)
        {
            document.querySelector('[name="imagen"]').value = response.imagen;
        });

        dropzone.on('removedfile', function() 
        {
            document.querySelector('[name="imagen"]').value = '';
        });
}