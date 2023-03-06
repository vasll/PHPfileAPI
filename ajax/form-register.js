// Handles the register form
$(document).ready(()=> {    // When the document is ready
    $("#form-register").submit((event)=> {  // When the form is submitted
        var formData = {
            email: $("#email").val(),
            nickname: $("#nickname").val(),
            password: $("#password").val()
        }
    
        $.ajax({
            type: "POST",
            url: "api/auth/register.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done((response)=> {
            console.log(response)
            $('#register-status').text('Register successful.')
        }).fail((jqXHR, textStatus, error)=>{
            console.log(response)
            $('#register-status').text('Register failed.')
        })
    
        event.preventDefault()
    })
})