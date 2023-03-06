// Handles the download form
$(document).ready(()=> {    // When the document is ready
    $("#form-download").submit((event)=> {  // When the form is submitted
        var formData = {
            path: $("#path").val()
        }
        
        // TODO download ajax thing
        $.ajax({
            type: "GET",
            url: "api/files/download.php"
        }).done((response)=> {
            window.location = 'api/files/download.php';
        })
    
        event.preventDefault()
    })
})