// Handles the login form
$(document).ready(()=> {    // When the document is ready
    $("#form-login").submit((event)=> {  // When the form is submitted
        var formData = {
            nickname: $("#nickname").val(),
            password: $("#password").val()
        }
    
        $.ajax({
            type: "POST",
            url: "api/auth/login.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done((response)=> {
            console.log(response)
        })
    
        event.preventDefault()
    })
})