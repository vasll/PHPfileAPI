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
            <a href="user_uploads.html">My uploads</a>
            <a href="markdown.html">Markdown</a>&nbsp;&nbsp;
            <a>Nickname: ${response['nickname']}</a>
        `)
    }).fail(function (jqXHR, textStatus, error){
        console.log(textStatus)
        $('#navbar').append(`
        <a href="upload.html">Upload</a>
        <a href="download.html">Download</a>&nbsp;
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>&nbsp;
        <a href="user_uploads.html">My uploads</a>
        <a href="markdown.html">Markdown</a>&nbsp;&nbsp;
        <a>Not logged in.</a>
    `)
    })

})