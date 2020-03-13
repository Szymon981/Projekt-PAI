<?php

class PrzegladSportowyParser {
    
    public static function getDivWithContent(DOMElement $mainDiv) {
        $allDives = $mainDiv->getElementsByTagName("div");
    
        foreach($allDives as $div){
            if($div->getAttribute("class") === 'itemLead hyphenate'){
                return $div;
            }
        }
        return null;
    }
    
    public static function getImg(DOMElement $mainDiv) {
        $allDives = $mainDiv->getElementsByTagName("img");
    
        foreach($allDives as $div){
            if($div->getAttribute("class") === 'itemImage'){
                return $div;
            }
        }
        return null;
    }
    
}