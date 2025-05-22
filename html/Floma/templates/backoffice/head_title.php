<?php
    // Pass $head_title, $head_subtitle, $head_svg from include
    $head_title = $head_title ?? 'Default Title';
    $head_subtitle = $head_subtitle ?? 'Default Subtitle';
    $head_svg = $head_svg ?? '/assets/icons/account_white.svg';
    ?>
    <link rel="stylesheet" type="text/css" href="back.css">
    <div class="headContainer">
        <div class="headContent">
            <div class="boxIcon">
                <img src="<?php echo htmlspecialchars($head_svg); ?>" alt="Account Icon" class="icon">
            </div>
            <div class="flexColumn">
                <h1><?php echo htmlspecialchars($head_title); ?></h1>
                <h2><?php echo htmlspecialchars($head_subtitle); ?></h2>
            </div>
        </div>
    </div>