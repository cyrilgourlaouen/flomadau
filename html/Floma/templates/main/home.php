<h1>Floma, un micro framework PHP</h1>
<p>Test</p><?php
    // Informations de connexion à la base de données
    $host = DB_HOST;
    $dbName = DB_NAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $port = DB_PORT;
    $schema = DB_SCHEMA;
    
    function connect(): PDO
    {
        $dsn = sprintf(
            "pgsql:host=%s;port=%s;dbname=%s;options='--search_path=%s'",
            $host,
            $port,
            $dbName,
            $schema
        );

        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    $db = connect();
    $stmt = $db->prepare("SELECT * FROM Compte");
    $stmt->execute();

    $res = $stmt->fetchAll();
    print_r($res);
?>