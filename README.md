# PHPfileAPI
Example of a very basic PHP API to upload and download files based on a user session

# How does it work?
When a user is logged in, it can upload files to the API. <br>
Files are uploaded into this directory: "../api/uploads/<user_id>/<filename>" <br>
The only way to upload/download files is via two endpoints "../api/files/upload.php" and "../api/files/download.php"<br>
