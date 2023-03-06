$(document).ready(()=> {
    var simpleMDE = new SimpleMDE({ 
        element: document.getElementById("markdown-textarea"),
        spellChecker: false
    });

    $('#fileToUpload').on('change', ()=>{
        console.log('change')
        if ($('#fileToUpload').prop('files')) {
            console.log('You selected a file');

            const formData = new FormData()
            var files = $('#fileToUpload')[0].files
            formData.append('fileToUpload', files[0])
            formData.append('submit', '')
            
            $.ajax({
                url: 'api/files/upload.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
            }).done((response)=>{
                console.log(response)
                const jsonResponse = JSON.parse(response)
                var pos = simpleMDE.codemirror.getCursor();
                simpleMDE.codemirror.setSelection(pos, pos);
                simpleMDE.codemirror.replaceSelection(`![](api/files/download.php?path=${jsonResponse['filename']}&submit=download)`);
            }).fail((jqXHR, textStatus, error)=>{
                console.log(jqXHR)
                console.log(textStatus)
                console.log(error)
            })
        }
    })
})