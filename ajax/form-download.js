// Handles the download form
$(document).ready(()=> {    // When the document is ready
    $("#form-download").submit((event)=> {  // When the form is submitted
        const filename = $("#filename").val()

        $.ajax({
            type: "GET",
            url: `api/files/download.php?path=${encodeURIComponent(filename)}`,
            headers: {
                Accept: 'application/octet-stream',
            }
        }).done((response)=>{
            const a = document.createElement('a');
            a.style = 'display: none';
            document.body.appendChild(a);
            const blob = new Blob([response], {type: 'octet/stream'});
            const url = URL.createObjectURL(blob);
            a.href = url;
            a.download = filename;
            a.click();
            URL.revokeObjectURL(url);
        }).fail(function (err) {
            oonsole.log('error')
        });
    
        event.preventDefault()
    })
})