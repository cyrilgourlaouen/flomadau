<?php

namespace App\Service;

class ManageOption 
{
    public function getTags(array $tagTable): array
    {
        $restaurationOpt = "";
        $restOpt = "";
        foreach($tagTable as $row) {
            $row["tag_restaurant"] ? $restaurationOpt .= '<option value=' . str_replace(" ","_", $row["nom_tag"]) . '>' . $row["nom_tag"] . '</option>' : $restOpt .= '<option value=' .str_replace(" ","_", $row["nom_tag"]) . '>' . $row["nom_tag"] . '</option>';
        }
        return ["isRestauration" => $restaurationOpt, "isNotRestauration" => $restOpt];
    }    

    public function getGuides(array $GuideTable): string
    {
        $GuideOpt = "";
        foreach($GuideTable as $row) {
            $GuideOpt .= '<option value=' . str_replace(" ","_", $row["nom_langue"]) . '>' . $row["nom_langue"] . "</option>" ;
        }
        return $GuideOpt;
    } 
}