<?php include_once "../config.php"; ?>

        <input type="file" name="fileToUpload" id="fileToUpload" class="file-input">
        <input type="button" value="Upload Image" name="sumit" id="send_">


<script>
    document.getElementById("send_").addEventListener("click",function () {
        let fileInput = document.querySelector('.file-input');

// Create a new form data instance and append the file to it
        let formData = new FormData();
        formData.append('file', fileInput.files[0]);

// Send the file to the server with AJAX
        let xhr = new XMLHttpRequest();
        xhr.open('POST', "<?php echo site_root."view/test.php"?>");
        xhr.send(formData);

    })
</script>
<?php

//if (!isset($_SESSION["user"])){
//    header("Location: ".site_root."login");
//    die();
//}
$date = new DateTime('2000-01-01');
$result = $date->format('Y-m-d H:i:s');
$target_dir = SAVE_IMAGE_PATH;
$target_file = $target_dir . basename($_SESSION['user'] . "_" . $result . "rand" . random_int(1, 200) . random_int(200, 1234) . $_FILES["fileToUpload"]["name"]);;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 600000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
$imageFileType=$_FILES['file']['type'];
// Allow certain file formats
if ($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        $img = new Imagick($target_file);
        $img->stripImage();
        $img->writeImage($target_file);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
