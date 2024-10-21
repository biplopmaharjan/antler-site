<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload System</title>
</head>
<body>
    <h1>Upload a File</h1>

    <?php
    // Handle file upload
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $uploadDirectory = 'uploads/';
        $uploadFile = $uploadDirectory . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "<p>File uploaded successfully!</p>";
            echo "<p><a href='$uploadFile' download>Click here to download the file</a></p>";
        } else {
            echo "<p>There was an error uploading the file.</p>";
        }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <h2>Uploaded Files</h2>
    <ul>
        <?php
        // Display uploaded files with download links
        $files = scandir('uploads/');
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                echo "<li><a href='uploads/$file' download>$file</a></li>";
            }
        }
        ?>
    </ul>
</body>
</html>
