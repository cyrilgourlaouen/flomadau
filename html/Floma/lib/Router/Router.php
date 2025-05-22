<?php

namespace Floma\Router;

use Floma\Enum\Layout;

require dirname(__DIR__, 2) . '/config/routes.php';

/**
 * Classe Router
 *
 * – fait correspondre l’URL à une route déclarée dans routes.php  
 * – instancie le contrôleur et appelle l’action
 * – indique au contrôleur quel layout utiliser via setLayout()  
 */
class Router
{
	private array $routes;
	private array $availablePaths;
	private string $requestedPath;

	public function __construct()
	{
		$this->routes = ROUTES;
		$this->availablePaths = array_keys($this->routes);
		$this->requestedPath = $_GET['path'] ?? '/';
		$this->parseRoutes();
	}

	private function parseRoutes(): void
	{
		$parts = $this->explodePath($this->requestedPath);
		$params = [];
		$route = null;

		foreach ($this->availablePaths as $candidatePath) {
			$match = true;
			$candidateSeg = $this->explodePath($candidatePath);

			if (count($candidateSeg) === count($parts)) {
				foreach ($parts as $idx => $segment) {
					$pattern = $candidateSeg[$idx];

					if ($this->isParam($pattern)) {
						$params[trim($pattern, '{}')] = $segment;
					} elseif ($pattern !== $segment) {
						$match = false;
						break;
					}
				}
				if ($match) {
					$route = $this->routes[$candidatePath];
					break;
				}
			}
		}

		if ($route) {
			$view = !isset($route['view']) || $route['view'] !== false;

			if ($_SERVER['REQUEST_METHOD'] === 'GET' && !$view) {
				http_response_code(404);
				exit("Cette route n'est pas accessible directement.");
			}

			$controller = new $route['controller'];

			$layoutEnum = match (true) {
				!isset($route['layout']) => Layout::FRONT,
				$route['layout'] instanceof Layout => $route['layout'],
				default => Layout::tryFrom($route['layout']) ?? Layout::FRONT,
			};

			if (method_exists($controller, 'setLayout')) {
				$controller->setLayout($layoutEnum);
			}

			$controller->{$route['method']}(...$params);

		} else {
			http_response_code(404);
			exit('Page non trouvée.');
		}
	}

	private function explodePath(string $path): array
	{
		return explode('/', trim($path, '/'));
	}

	private function isParam(string $segment): bool
	{
		return str_contains($segment, '{') && str_contains($segment, '}');
	}
}