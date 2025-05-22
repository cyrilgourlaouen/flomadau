<?php
// Usage: include 'black_button.php'; echo black_button('Valider');
function black_button($text, $type = 'submit', $name = '', $id = '') {
    $name_attr = $name ? " name=\"$name\"" : "";
    $id_attr = $id ? " id=\"$id\"" : "";
    return "<button class=\"button-black\" type=\"$type\"$name_attr$id_attr>$text</button>";
}
?>
