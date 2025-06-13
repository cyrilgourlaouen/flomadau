<?php

namespace Floma\Manager;

use PDO;
use PDOStatement;

require dirname(__DIR__, 2) . '/config/database.php';

/**
 * Class AbstractManager
 *
 * @package Floma\Manager
 */
abstract class AbstractManager
{
	/**
	 * @return PDO
	 */
	private function connect(): PDO
	{
		$dsn = sprintf(
			"pgsql:host=%s;port=%s;dbname=%s;options='--search_path=%s'",
			DB_INFOS['host'],
			DB_INFOS['port'],
			DB_INFOS['dbname'],
			DB_INFOS['schema']
		);

		$db = new PDO($dsn, DB_INFOS['username'], DB_INFOS['password']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}


	/**
	 * @param string $query
	 * @param array $params
	 * @return PDOStatement
	 */
	private function executeQuery(string $query, array $params = []): PDOStatement
	{
		$db = $this->connect();
		$stmt = $db->prepare($query);
		foreach ($params as $key => $param)
			$stmt->bindValue($key, $param);
		$stmt->execute();
		return $stmt;
	}

	/**
	 * @param string $class
	 * @return string
	 */
	private function getTableName(string $class): string
	{
		if (defined($class . '::TABLE_NAME')) {
			$table = $class::TABLE_NAME;
		} else {
			$tmp = explode('\\', $class);
			$table = strtolower(end($tmp));
		}
		return $table;
	}

	/**
	 * @param string $class
	 * @param array $filters
	 * @return mixed
	 */
	protected function readOne(string $class, array $filters): mixed
	{
		$query = 'SELECT * FROM ' . $this->getTableName($class) . ' WHERE ';
		foreach (array_keys($filters) as $filter) {
			$query .= $filter . " = :" . $filter;
			if ($filter != array_key_last($filters))
				$query .= ' AND ';
		}
		$stmt = $this->executeQuery($query, $filters);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $class);
		return $stmt->fetch();
	}

	/**
	 * @param string $class
	 * @param array $filters
	 * @param array $order
	 * @param int|null $limit
	 * @param int|null $offset
	 * @return mixed
	 */
	protected function readMany(string $class, array $filters = [], array $order = [], ?int $limit = null, ?int $offset = null): mixed
	{
		$query = 'SELECT * FROM ' . $this->getTableName($class);
		if (!empty($filters)) {
			$query .= ' WHERE ';
			foreach (array_keys($filters) as $filter) {
				$query .= $filter . " = :" . $filter;
				if ($filter != array_key_last($filters))
					$query .= ' AND ';
			}
		}
		if (!empty($order)) {
			$query .= ' ORDER BY ';
			foreach ($order as $key => $val) {
				$query .= $key . ' ' . $val;
				if ($key != array_key_last($order))
					$query .= ', ';
			}
		}
		if (isset($limit)) {
			$query .= ' LIMIT ' . $limit;
			if (isset($offset)) {
				$query .= ' OFFSET ' . $offset;
			}
		}
		$stmt = $this->executeQuery($query, $filters);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $class);
		return $stmt->fetchAll();
	}

	/**
	 * @param string $class
	 * @param array $fields
	 * @return array(PDOStatement, Int)
	 * @return array(PDOStatement, Int)
	 */
	protected function create(string $class, array $fields): array
	protected function create(string $class, array $fields): array
	{
		$query = "INSERT INTO " . $this->getTableName($class) . " (";
		foreach (array_keys($fields) as $field) {
			$query .= $field;
			if ($field != array_key_last($fields))
				$query .= ', ';
		}
		$query .= ') VALUES (';
		foreach (array_keys($fields) as $field) {
			$query .= ':' . $field;
			if ($field != array_key_last($fields))
				$query .= ', ';
		}
		$query .= ') RETURNING id';
		$stmt = $this->executeQuery($query, $fields);
		$id = $stmt->fetchColumn();
		return [$stmt, $id];
	}

	/**
	 * @param string $class
	 * @param array $fields
	 * @param int $id
	 * @return PDOStatement
	 */
	protected function update(string $class, array $fields, int $id): PDOStatement
	{
		$query = "UPDATE " . $this->getTableName($class) . " SET ";
		foreach (array_keys($fields) as $field) {
			$query .= $field . " = :" . $field;
			if ($field != array_key_last($fields))
				$query .= ', ';
		}
		$query .= ' WHERE id = :id';
		$fields['id'] = $id;
		return $this->executeQuery($query, $fields);
	}

	/**
	 * @param string $class
	 * @param int $id
	 * @return PDOStatement
	 */
	protected function remove(string $class, int $id): PDOStatement
	{
		$query = "DELETE FROM " . $this->getTableName($class) . " WHERE id = :id";
		return $this->executeQuery($query, ['id' => $id]);
	}

}