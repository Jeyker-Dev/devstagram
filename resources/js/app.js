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
            uploadMultiple: false
        });
        
        dropzone.on('sending', function(file, xhr, formData)
        {
            console.log(file);
        });

        dropzone.on('success', function(file, response)
        {
            document.querySelector('[name="imagen"]').value = response.imagen;
        });

        dropzone.on('error', function(file, message)
        {
            console.log(message);
        });

        dropzone.on('removedfile', function()
        {
            console.log('Archivo Eliminado');
        });
}