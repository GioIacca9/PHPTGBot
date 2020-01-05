<?php
error_reporting(0);
$pdo = new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['database'], $config['database']['username'], $config['database']['password']);
$bot_username = $config['bot_username'];

if ($config['database']['use_database']) {
  // Aggiunge o aggiorna l'utente nel database

  if (isset($message) || isset($update['callback_query'])) {
    $database_user_id = $user_id;
    $database_first_name = urlencode($first_name);
    $database_last_name = urlencode($last_name);
    $database_username = urlencode($username);
    $database_language_code = $language_code;
    $database_last_update = time();
    $database_status = 0;
  } elseif (isset($update['inline_query'])) {
    $database_user_id = $inline_query_from_id;
    $database_first_name = urlencode($inline_query_from_first_name);
    $database_last_name = urlencode($inline_query_from_last_name);
    $database_username = urlencode($inline_query_from_username);
    $database_language_code = $inline_query_from_language_code;
    $database_last_update = time();
    $database_status = 0;
  }
  $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE user_id=:user_id LIMIT 1");
  $stmt->execute(['user_id' => $database_user_id]);
  $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  if ($result == []) {
    $stmt = $pdo->prepare("INSERT INTO $bot_username (id, user_id, first_name, last_name, username, language_code, status, last_update) VALUES (null, :user_id, :first_name, :last_name, :username, :language_code, :status, :last_update)");
    $stmt->execute(['user_id' => $database_user_id, 'first_name' => $database_first_name, 'last_name' => $database_last_name, 'username' => $database_username, 'language_code' => $database_language_code, 'status' => $database_status, 'last_update' => $database_last_update]);
  } else {
    $stmt = $pdo->prepare("UPDATE $bot_username SET first_name=:first_name, last_name=:last_name, username=:username, language_code=:language_code, last_update=:last_update WHERE user_id=:user_id");
    $stmt->execute(['first_name' => $database_first_name, 'last_name' => $database_last_name, 'username' => $database_username, 'language_code' => $database_language_code, 'last_update' => $database_last_update, 'user_id' => $database_user_id]);
  }

  if ($_GET['action'] == "create_database") {

    $pdo->query("CREATE TABLE IF NOT EXISTS $bot_username (
      id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
      user_id bigint NOT NULL,
      first_name text NOT NULL,
      last_name text NOT NULL,
      username text NOT NULL,
      language_code varchar(10) NOT NULL,
      status tinyint NOT NULL,
      last_update bigint NOT NULL
    );");

    if ($pdo->errorInfo()[0] !== "00000") {
      $json = [
        "ok" => false,
        "description" => $pdo->errorInfo(),
      ];
      header('Content-Type: application/json');
      die(json_encode($json));
    } else {
      $json = [
        "ok" => true,
        "description" => "Database created",
      ];
      header('Content-Type: application/json');
      die(json_encode($json));
    }

  }
}
