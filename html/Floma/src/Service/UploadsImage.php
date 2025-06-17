<?php

namespace App\Service;

class UploadsImage
{
    public function uploads()
    {
        foreach ($_FILES as $nom => $data) {
            if ($nom === "photo") {
                $target_dir = "./uploads/offers";
                for ($i = 0; $i < sizeof($data["name"]); $i++) {
                    if (isset($data["size"][$i]) && isset($data["name"][$i])) {
                        $target_file = $target_dir . "/" . basename($data["name"][$i]);
                        if (strlen($data["name"][$i]) > 100) {
                            $data["name"][$i] = substr($data["name"][$i], 0, 100);
                        }
                        move_uploaded_file($data["tmp_name"][$i], $target_file);
                    }
                }
            } elseif ($nom === "url_carte_restaurant") {
                $target_dir = "./uploads/restaurant";
            } elseif ($nom === "url_carte_parc") {
                $target_dir = "./uploads/parcAttraction";
            }
            if ($nom === "url_carte_restaurant" || $nom === "url_carte_parc") {
                if (isset($data["size"]) && isset($data["name"])) {
                    $target_file = $target_dir . "/" . basename($data["name"]);
                    
                    if (strlen($data["name"]) > 100) {
                        $data["name"] = substr($data["name"], 0, 100);
                    }
                    move_uploaded_file($data["tmp_name"], $target_file);
                }
            }
        }
    }
}
