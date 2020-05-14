<?php
function uploadImageChosen($files)
{
    $image = 0;
    if (isset($files["name"]) && $files["name"] != '') {
        $target_dir = "../img/samples/";
        $image = date('YmdHis_');
        $image .= basename($files["name"]);
        $target_file = $target_dir . $image;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($files["size"] > 5000000) {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $okFlag = FALSE;
        } else {
            if (move_uploaded_file($files["tmp_name"], $target_file)) {
                return $image;
            } else {
                $okFlag = FALSE;
            }
        }
    } else {
        $image = '';
        return $image;
    }
}
