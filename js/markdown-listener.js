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
            formData.append('fileToUpload', files[0]);
            
            $.ajax({
                url: 'api/upload.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response)
                    var pos = simpleMDE.codemirror.getCursor();
                    simpleMDE.codemirror.setSelection(pos, pos);
                    simpleMDE.codemirror.replaceSelection(`![](api/download.php?path=${response}&submit=download)`);
                }
            });
        }
    })
})