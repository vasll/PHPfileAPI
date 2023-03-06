// Handles the login form
$(document).ready(()=> {    // When the document is ready
    $("#form-login").submit((event)=> {  // When the form is submitted
        console.log('click')
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
            $('#nav-status').text(`Nickname: ${response['nickname']}`)
            $('#login-status').text('Login successful.')
        }).fail((jqXHR, textStatus, error)=>{
            console.log(error)
            console.log(textStatus)
            $('#login-status').text('Login failed.')
        })
    
        event.preventDefault()
    })
})