<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/style.css">
		<link rel="icon" type="image/png" href="/assets/favicon/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg" />
		<link rel="shortcut icon" href="/assets/favicon/favicon.ico" />
		<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png" />
		<meta name="apple-mobile-web-app-title" content="PACT" />
		<link rel="manifest" href="/assets/favicon/site.webmanifest" />
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
		<?php include '_footer.php'; ?>
	</body>
</html>