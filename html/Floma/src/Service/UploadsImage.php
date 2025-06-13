<?php

namespace App\Service;

class UploadsImage 
{
  public function uploads()
  {
    foreach($_FILES as $nom => $data) {
      if ($nom === "photo") {
        $target_dir = "./uploads/offers";
      } elseif ($nom === "carte_resto") {
        $target_dir = "./uploads/restaurant";
      } elseif ($nom === "carte_parc") {
        $target_dir = "./uploads/parcAttraction";
      }
    }
    $target_file = $target_dir . basename( $data["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
      $check = getimagesize($data["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    if (strlen($data["name"]) > 100) {
      $_FILES[$nom]["name"] = substr($_FILES[$nom]["name"], 0, 100);
    }
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "svg" && $imageFileType != "jpeg") {
      echo "Sorry, only JPG, JPEG et PNG files are allowed.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file( $data["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
}