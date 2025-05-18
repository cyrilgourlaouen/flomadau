<?php
use App\Service\MetricStarsCalculator;

$a = new MetricStarsCalculator();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title><?= $a->calculStars(2) ?></title>
</head>
<body>
    <div>

    </div>
    <div class="infoImage">
        <div class="images">
            <img src="../../../uploads/offers/croisiere.jpg" alt="croisiere">
        </div>
        <div class="info">
            <div class="category">
                <?=  str_repeat("<img src='../../../assets/icons/star_pink.svg' alt='étoile'>", htmlspecialchars($data['offer']->getNoteMoyenne()))?>
                <p>
                    <?=  "(" .  htmlspecialchars($data['offer']->getNombreAvis()) . ")" . " - " .  htmlspecialchars($data['offer']->getCategory()); ?>
                </p>
            </div>
            <h1>
                <?=  htmlspecialchars($data['offer']->getTitre()) ?>
            </h1>
            <div class="resume">
                <div class="subtitle">
                    Résume
                </div>
                <p>
                    <?=  htmlspecialchars($data['offer']->getResume()) ?>
                </p>
            </div>
            

            <div class="contact">
                <div class="subtitle">
                    Contact
                </div>
                <div class="phone">
                    <img src="../../../assets/icons/phone_blue.svg" alt="phone">
                    <p>
                        <?=  htmlspecialchars($data['offer']->getTelephone()) ?>
                    </p>
                </div>
                <div class="site">
                    <img src="../../../assets/icons/earth_blue.svg" alt="earth">
                    <a href="<?=  htmlspecialchars($data['offer']->getSiteWeb()) ?>">
                        <p>
                            <?=  htmlspecialchars($data['offer']->getSiteWeb()) ?>
                        </p>
                    </a>
                </div>
            </div>
            <div>
                Offre proposée par l'Association 
                <div class="italic">
                    <?php echo "br br patapim" ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
echo $data['offer']->getNombreAvis() . " ";

echo $data['offer']->getVille() . " ";
echo $data['offer']->getTitre() . " ";
echo $data['offer']->getResume() . " ";
echo $data['offer']->getNoteMoyenne() . " ";
echo $data['offer']->getId()  . " ";
echo $data['offer']->getCategory() . " ";
echo $data['offer']->getConditionAccessibilite() . " ";
echo $data['offer']->getDescriptionDetaillee() . " ";
echo $data['offer']->getTelephone() . " ";
echo $data['offer']->getAdressePostale() . " ";
echo $data['offer']->getSiteWeb() . " ";
echo $data['offer']->getPrixMinimal() . " ";
echo "\n";
?>
<style>
body {
    background: #F5F7FA;
}

.category {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 0px;
    gap: 3px;
}

.images img{
    width:39.875rem;
    height:24.563rem;
    border-radius: 15px;
}

.infoImage {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 0px;
    gap: 25px;
}

.resume {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 0px;
    gap: 10px;
}

.info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 0px;
    gap: 15px;
}

.phone {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 0px;
    gap: 5px;
}

.site {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 0px;
    gap: 5px;
}

.contact {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 0px;
    gap: 15px;
}
</style>