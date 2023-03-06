$(document).ready(()=>{
    $.ajax({
        type: "POST",
        url: "api/get/session-info.php",
        dataType: "json",
        encode: true,
    }).done((response)=> {
        console.log(response)
        $('#navbar').append(`
            <a href="upload.html">Upload</a>
            <a href="download.html">Download</a>&nbsp;
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>&nbsp;
            <a href="markdown.html">Markdown</a>&nbsp;&nbsp;
            <a id="nav-status">Nickname: ${response['nickname']}</a><hr>
        `)
    }).fail(function (jqXHR, textStatus, error){
        console.log(textStatus)
        $('#navbar').append(`
        <a href="upload.html">Upload</a>
        <a href="download.html">Download</a>&nbsp;
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>&nbsp;
        <a href="markdown.html">Markdown</a>&nbsp;&nbsp;
        <a id="nav-status">Not logged in.</a><hr>
    `)
    })

})