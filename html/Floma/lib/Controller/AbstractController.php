<?php

namespace Floma\Controller;

use Floma\View\Layout;

/**
 * Class AbstractController
 *
 * @package Floma\Controller
 */
abstract class AbstractController
{
	private Layout $layout = Layout::FRONT;

	public function setLayout(Layout $layout): void
	{
		$this->layout = $layout;
	}

	protected function renderView(string $template, array $data = []): void
	{
		global $templatePath;
		$templatePath = dirname(__DIR__, 2) . '/templates/' . $template;

		$GLOBALS['data'] = $data;

		require dirname(__DIR__, 2) . '/templates/' . $this->layout->value;
		exit;
	}

	/**
	 * @param string $path
	 * @param array $params
	 * @return void
	 */
	protected function redirectToRoute(string $path, array $params = []): void
	{
		$uri = $_SERVER['SCRIPT_NAME'] . "?path=" . $path;

		if (!empty($params)) {
			$strParams = [];
			foreach ($params as $key => $val) {
				array_push($strParams, urlencode((string) $key) . '=' . urlencode((string) $val));
			}
			$uri .= '&' . implode('&', $strParams);
		}

		header("Location: " . $uri);
		die;
	}

}