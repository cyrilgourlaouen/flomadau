<?php
    // Pass $head_title, $head_subtitle, $head_svg from include
    $head_title = $head_title ?? 'Default Title';
    $head_subtitle = $head_subtitle ?? 'Default Subtitle';
    $head_svg = $head_svg ?? '/assets/icons/account_white.svg';
?>
    <link rel="stylesheet" type="text/css" href="back.css">
    <div id="headContainer_little">
        <div id="headContent_little">
            <div class="flexColumn">
                <h1><?= htmlspecialchars($head_title); ?></h1>
                <h2 id="little_subtittle"><?= htmlspecialchars($head_subtitle); ?></h2>
            </div>
            <div class="boxIcon">
                <img src="<?=htmlspecialchars($head_svg); ?>" alt="Account Icon" class="icon">
            </div>
        </div>
    </div>