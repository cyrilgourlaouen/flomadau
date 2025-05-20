<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php if (isset($data['seo']['title'])) echo $data['seo']['title'] . ' - '; ?>
			PACT
		</title>
		<?php if (isset($data['seo']['description'])) { ?>
			<meta name="description" content="<?= $data['seo']['description'] ?>">
		<?php } ?>
	</head>
	<body>
		<main>
			<?php require $templatePath ?>
		</main>
	</body>
</html>