// Handles the download form
$(document).ready(()=> {    // When the document is ready
    $("#form-download").submit((event)=> {  // When the form is submitted
        var formData = {
            path: $("#path").val()
        }
        
        // TODO download ajax thing
        $.ajax({
            type: "GET",
            url: "api/files/download.php",
            data: formData,
            dataType: "json",   // TODO Change this
            encode: true,
        }).done((response)=> {
            console.log(response)
        })
    
        event.preventDefault()
    })
})