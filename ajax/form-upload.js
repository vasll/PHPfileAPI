// Handles the upload form
$(document).ready(()=> {    // When the document is ready
    $("#form-upload").submit((event)=> {  // When the form is submitted
        if ($('#fileToUpload').prop('files')) { // If there are any files
            console.log('File selected');

            const formData = new FormData()
            var files = $('#fileToUpload')[0].files // Get file
            formData.append('fileToUpload', files[0]);  // Append it to form
            formData.append('submit', '')
            
            $.ajax({
                url: 'api/files/upload.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
            }).done((response)=>{
                console.log(response)
                $('#upload-status').text('Upload successful.')
            }).fail((jqXHR, textStatus, error)=>{
                $('#upload-status').text('Upload failed.')
                console.log(error)
                console.log(textStatus)
            });
        }else{
            console.log('No files selected')
        }

        event.preventDefault()
    })
})