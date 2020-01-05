<?php
error_reporting(0);
$pdo = new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['database'], $config['database']['username'], $config['database']['password']);
$bot_username = $config['bot_username'];

function banBotUser($user_id, $username) {
  global $pdo;
  global $bot_username;
  global $config;

  if ($config['database']['use_database']) {

    if (isset($user_id)) {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE user_id=:user_id LIMIT 1");
      $stmt->execute(['user_id' => $user_id]);
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      if ($result == []) {
        return ['code' => 0]; // Utente non nel database
      } else {
        if ($result[0]['status'] == 1) {
          return ['code' => 3];
        } else {
          if (in_array($result[0]['user_id'], $config['admins'])) {
            return ['code' => 5]; // Impossibile bannare un admin
          } else {
            $stmt = $pdo->prepare("UPDATE $bot_username SET status=1 WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user_id]);
            return [
              'code' => 1,
              'first_name' => urldecode($result[0]['first_name']),
              'last_name' => urldecode($result[0]['last_name']),
              'username' => urldecode($result[0]['username']),
              'user_id' => $result[0]['user_id'],
              'last_update' => $result[0]['last_update'],
            ]; // Utente bannato
          }
        }
      }
    } elseif (isset($username) && $username != "") {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE username=:username LIMIT 1");
      $stmt->execute(['username' => $username]);
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      if ($result == []) {
        return ['code' => 0]; // Utente non nel database
      } else {
        if ($result[0]['status'] == 1) {
          return ['code' => 3];
        } else {
          if (in_array($result[0]['user_id'], $config['admins'])) {
            return ['code' => 5]; // Impossibile bannare un admin
          } else {
            $stmt = $pdo->prepare("UPDATE $bot_username SET status=1 WHERE username=:username");
            $stmt->execute(['username' => $username]);
            return [
              'code' => 1,
              'first_name' => urldecode($result[0]['first_name']),
              'last_name' => urldecode($result[0]['last_name']),
              'username' => urldecode($result[0]['username']),
              'user_id' => $result[0]['user_id'],
              'last_update' => $result[0]['last_update'],
            ]; // Utente bannato
          }
        }
      }
    } else {
      return ['code' => 4]; // Né user_id nè username impostati
    }
  } else {
    return ['code' => 2]; // Database disattivato
  }
}


function unbanBotUser($user_id, $username) {
  global $pdo;
  global $bot_username;
  global $config;

  if ($config['database']['use_database']) {

    if (isset($user_id)) {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE user_id=:user_id LIMIT 1");
      $stmt->execute(['user_id' => $user_id]);
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      if ($result == []) {
        return ['code' => 0]; // Utente non nel database
      } else {
        if (in_array($result[0]['user_id'], $config['admins'])) {
          return ['code' => 5]; // Impossibile perdonare un admin
        } else {
          if ($result[0]['status'] == 0) {
            return ['code' => 3];
          } else {
            $stmt = $pdo->prepare("UPDATE $bot_username SET status=0 WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user_id]);
            return [
              'code' => 1,
              'first_name' => urldecode($result[0]['first_name']),
              'last_name' => urldecode($result[0]['last_name']),
              'username' => urldecode($result[0]['username']),
              'user_id' => $result[0]['user_id'],
              'last_update' => $result[0]['last_update'],
            ]; // Utente sbannato
          }
        }

      }
    } elseif (isset($username) && $username != "") {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE username=:username LIMIT 1");
      $stmt->execute(['username' => $username]);
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      if ($result == []) {
        return ['code' => 0]; // Utente non nel database
      } else {
        if (in_array($result[0]['user_id'], $config['admins'])) {
          return ['code' => 5]; // Impossibile perdonare un admin
        } else {
          if ($result[0]['status'] == 0) {
            return ['code' => 3];
          } else {
            $stmt = $pdo->prepare("UPDATE $bot_username SET status=0 WHERE username=:username");
            $stmt->execute(['username' => $username]);
            return [
              'code' => 1,
              'first_name' => urldecode($result[0]['first_name']),
              'last_name' => urldecode($result[0]['last_name']),
              'username' => urldecode($result[0]['username']),
              'user_id' => $result[0]['user_id'],
              'last_update' => $result[0]['last_update'],
            ]; // Utente bannato
          }
        }
      }
    } else {
      return ['code' => 4]; // Né user_id nè username passati
    }
  } else {
    return ['code' => 2]; // Database disattivato
  }
}


if (in_array($user_id, $config['admins'])) {
  if (in_array($text[0], $config['plugins_config']['command_prefix'])) {
    if ($chat_id > 0) {
      if (substr($text, 1, 3) == "ban") {
        // Banna un utente dall'utilizzo del bot

        if ($config['database']['use_database']) {
          if (substr($text, 5, 1) === "@") {
            $result = banBotUser(null, str_replace("@", "", split(" ", $text)[1]));
            if ($result['code'] == 1) {
              sendMessage($chat_id, "⛔️ <b>È stato bandito il seguente utente:</b>\n\n<b>Nome:</b> " . $result['first_name'] . "\n<b>Cognome:</b> " . $result['last_name'] . "\n<b>Username:</b> " . $result['username'] . "\n<b>User ID:</b> <code>" . $result['user_id'] . "</code>\n<b>Ultimo aggiornamento</b>: " . date("d/m/Y H:i:s", $result['last_update']), "HTML");
            } elseif ($result['code'] == 0) {
              sendMessage($chat_id, "👀 <b>Questo utente non è nel database.</b>", "HTML");
            } elseif ($result['code'] == 3) {
              sendMessage($chat_id, "❌ <b>Questo utente è già bandito.</b>", "HTML");
            } elseif ($result['code'] == 5) {
              sendMessage($chat_id, "👑 <b>Impossibile bannare un amministratore.</b>", "HTML");
            }
          } elseif (preg_match("/^[0-9]*$/", split(" ", $text)[1]) && split(" ", $text)[1]) {
            $result = banBotUser(split(" ", $text)[1], null);
            if ($result['code'] == 1) {
              sendMessage($chat_id, "⛔️ <b>È stato bandito il seguente utente:</b>\n\n<b>Nome:</b> " . $result['first_name'] . "\n<b>Cognome:</b> " . $result['last_name'] . "\n<b>Username:</b> " . $result['username'] . "\n<b>User ID:</b> <code>" . $result['user_id'] . "</code>\n<b>Ultimo aggiornamento</b>: " . date("d/m/Y H:i:s", $result['last_update']), "HTML");
            } elseif ($result['code'] == 0) {
              sendMessage($chat_id, "👀 <b>Questo utente non è nel database.</b>", "HTML");
            } elseif ($result['code'] == 3) {
              sendMessage($chat_id, "❌ <b>Questo utente è già bandito.</b>", "HTML");
            } elseif ($result['code'] == 5) {
              sendMessage($chat_id, "👑 <b>Impossibile bannare un amministratore.</b>", "HTML");
            }
          } else {
            sendMessage($chat_id, "❌ <b>Impossibile identificare l'utente.</b>\n\nControlla di aver usato la sintassi corretta:\n\n<code>/ban &lt;@username|user_id&gt;</code>", "HTML");
          }
        } else {
          sendMessage($chat_id, "❌ <b>Impossibile usare il comando</b> <code>ban</code>.\n\nQuesto comando necessita del database.", "HTML");
        }
      }

      if (substr($text, 1, 5) == "unban") {
        // Sbanna un utente

        if ($config['database']['use_database']) {
          if (substr($text, 7, 1) === "@") {
            $result = unbanBotUser(null, str_replace("@", "", split(" ", $text)[1]));
            if ($result['code'] == 1) {
              sendMessage($chat_id, "✅ <b>È stato perdonato il seguente utente:</b>\n\n<b>Nome:</b> " . $result['first_name'] . "\n<b>Cognome:</b> " . $result['last_name'] . "\n<b>Username:</b> " . $result['username'] . "\n<b>User ID:</b> <code>" . $result['user_id'] . "</code>\n<b>Ultimo aggiornamento</b>: " . date("d/m/Y H:i:s", $result['last_update']), "HTML");
            } elseif ($result['code'] == 0) {
              sendMessage($chat_id, "👀 <b>Questo utente non è nel database.</b>", "HTML");
            } elseif ($result['code'] == 3) {
              sendMessage($chat_id, "❌ <b>Questo utente non è bandito.</b>", "HTML");
            } elseif ($result['code'] == 5) {
              sendMessage($chat_id, "👑 <b>Impossibile perdonare un amministratore.</b>", "HTML");
            }
          } elseif (preg_match("/^[0-9]*$/", split(" ", $text)[1]) && split(" ", $text)[1]) {
            $result = unbanBotUser(split(" ", $text)[1], null);
            if ($result['code'] == 1) {
              sendMessage($chat_id, "✅ <b>È stato perdonato il seguente utente:</b>\n\n<b>Nome:</b> " . $result['first_name'] . "\n<b>Cognome:</b> " . $result['last_name'] . "\n<b>Username:</b> " . $result['username'] . "\n<b>User ID:</b> <code>" . $result['user_id'] . "</code>\n<b>Ultimo aggiornamento</b>: " . date("d/m/Y H:i:s", $result['last_update']), "HTML");
            } elseif ($result['code'] == 0) {
              sendMessage($chat_id, "👀 <b>Questo utente non è nel database.</b>", "HTML");
            } elseif ($result['code'] == 3) {
              sendMessage($chat_id, "❌ <b>Questo utente non è bandito.</b>", "HTML");
            } elseif ($result['code'] == 5) {
              sendMessage($chat_id, "👑 <b>Impossibile perdonare un amministratore.</b>", "HTML");
            }
          } else {
            sendMessage($chat_id, "❌ <b>Impossibile identificare l'utente.</b>\n\nControlla di aver usato la sintassi corretta:\n\n<code>/unban &lt;@username|user_id&gt;</code>", "HTML");
          }
        } else {
          sendMessage($chat_id, "❌ <b>Impossibile usare il comando</b> <code>unban</code>.\n\nQuesto comando necessita del database.", "HTML");
        }
      }
    }

  }
}



if ($config['database']['use_database']) {
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
  if ($result != []) {
    if ($result[0]['status'] == 1){
      if (!$config['plugins_config']['users']['allow_banned_users']){
        if ($config['plugins_config']['users']['bot_assistence'] == false){
          sendMessage($database_user_id, "⛔️ <b>Non puoi usare questo bot perché sei stato bandito da un amministratore.</b>", "HTML");
        }else{
          sendMessage($database_user_id, "⛔️ <b>Non puoi usare questo bot perché sei stato bandito da un amministratore.</b>\n\nPer maggiori informazioni contattare ". $config['plugins_config']['users']['bot_assistence'].".", "HTML");
        }
        die();
      }
    }
    
  }
}