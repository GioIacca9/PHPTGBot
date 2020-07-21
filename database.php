<?php
error_reporting(0);
$pdo = new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['database'], $config['database']['username'], $config['database']['password']);
$bot_username = $config['bot_username'];
$stmt = $pdo->prepare("set names 'utf8mb4'");
$stmt->execute();

if ($config['database']['use_database']) {
  // Add or update user's data in the database
  if (isset($message) || isset($update['callback_query'])) {
    $database_user_id = $user_id;
    $database_first_name = $first_name;
    $database_last_name = $last_name;
    $database_username = $username;
    $database_language_code = $language_code;
    $database_last_update = time();
    $database_status = 0;
  } elseif (isset($update['inline_query'])) {
    $database_user_id = $inline_query_from_id;
    $database_first_name = $inline_query_from_first_name;
    $database_last_name = $inline_query_from_last_name;
    $database_username = $inline_query_from_username;
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
      `id` INT NOT NULL AUTO_INCREMENT,
      `user_id` BIGINT NOT NULL,
      `first_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
      `last_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
      `username` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
      `language_code` VARCHAR(10) NULL,
      `status` TINYINT NOT NULL,
      `last_update` BIGINT NOT NULL,
      PRIMARY KEY(`id`)
    ) ENGINE = MyISAM CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

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
