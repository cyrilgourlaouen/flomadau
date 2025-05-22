<?php
    // Usage: include 'button.php'; echo button('Valider');
    function button($text, $id = '', $name = '') {
        $name_attr = $name ? " name=\"$name\"" : "";
        $id_attr = $id ? " id=\"$id\"" : "";
        return "<button type=\"button\" $name_attr$id_attr disabled>$text</button>";
    }
?>