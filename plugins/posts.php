<?php
error_reporting(0);
$pdo = new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['database'], $config['database']['username'], $config['database']['password']);
$bot_username = $config['bot_username'];

if (in_array($user_id, $config['admins'])) {
  if ($callback_data == "72Wa8DPlAY") {
    if (file_exists("plugins/config/posts/$user_id.json")) {
      unlink("plugins/config/posts/$user_id.json");
      answerCallbackQuery($callback_query_id, "Invio del post annullato");
      deleteMessage($chat_id, $message_id);
    } else {
      unlink("plugins/config/posts/$user_id.json");
      answerCallbackQuery($callback_query_id, "Sessione terminata");
      deleteMessage($chat_id, $message_id);
    }
  }

  if ($callback_data == "kJKgTZFSLG") {
    unlink("plugins/config/posts/$user_id.json");
    answerCallbackQuery($callback_query_id, "Chiuso");
    deleteMessage($chat_id, $message_id);
  }

  if ($callback_data == "yy4RduyUXl" && file_exists("plugins/config/posts/$user_id.json")) {
    $post = json_decode(file_get_contents("plugins/config/posts/$user_id.json"), true);
    $post_text = $post['text'];
    $post_target = $post['target'];
    $result = [];
    if ($post_target == 0) {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username");
      $stmt->execute();
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } elseif ($post_target == 1) {
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE status=0");
      $stmt->execute();
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    for ($i = 0; $i < count($result); $i++) {
      editMessageText($chat_id, $message_id, null, "📤 <b>INVIO POST</b>\n\n<b>Inviati:</b> $i/" . count($result) . "\n\n\n<i>L'operazione potrebbe richiedere diversi secondi.</i>", "HTML", false, $reply_markup);
      $post_text_custom = $post_text;
      $post_text_custom = str_replace("{first_name}", urldecode($result[$i]['first_name']), $post_text_custom);
      $post_text_custom = str_replace("{last_name}", urldecode($result[$i]['last_name']), $post_text_custom);
      if (urldecode($result[$i]['username']) == ""){
        $post_text_custom = str_replace("{username}", "", $post_text_custom);
      }else{
        $post_text_custom = str_replace("{username}", "@".urldecode($result[$i]['username']), $post_text_custom);
      }
      $post_text_custom = str_replace("{user_id}", $result[$i]['user_id'], $post_text_custom);
      $post_text_custom = str_replace("{last_update}", date("d/m/Y H:i:s", $result[$i]['last_update']), $post_text_custom);
      sendMessage($result[$i]['user_id'], $post_text_custom, "HTML");
    }
    $reply_markup = ["inline_keyboard" => [[["text" => "✅ Chiudi", "callback_data" => "kJKgTZFSLG"]]]];
    editMessageText($chat_id, $message_id, null, "📨 <b>POST INVIATO</b>\n\nIl messaggio è stato inviato a tutti i suoi destinatari (". count($result) .").", "HTML", false, $reply_markup);
    unlink("plugins/config/posts/$user_id.json");
  }

  if (file_exists("plugins/config/posts/$user_id.json")) {
    $post = json_decode(file_get_contents("plugins/config/posts/$user_id.json"), true);
    $post_text = $post['text'];
    $post_target = $post['target'];

    if ($post_text == "") {
      $post_replace = ["text" => $text];
      $json = array_replace($post, $post_replace);
      file_put_contents("plugins/config/posts/$user_id.json", json_encode($json));
      $target_0 = 0;
      $target_1 = 0;
      $stmt = $pdo->prepare("SELECT * FROM $bot_username");
      $stmt->execute();
      $result_0 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $target_0 = count($result_0);
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE status=0");
      $stmt->execute();
      $result_1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $target_1 = count($result_1);
      $reply_markup = ["inline_keyboard" => [[["text" => "Tutti (utenti banditi compresi)", "callback_data" => "WIAvygTA9M"]], [["text" => "Solo utenti liberi", "callback_data" => "fr9lzDvxhk"]], [["text" => "❌ Annulla", "callback_data" => "72Wa8DPlAY"]]]];
      sendMessage($chat_id, "✉️ <b>NUOVO POST</b> - target\n\nOk, ora scegli se inviare questo messaggio a tutti gli utenti iscritti al Bot o se inviarlo solo agli utenti che non sono stai banditi.\n\n<b>Utenti totali:</b> $target_0\n<b>Utenti liberi:</b> $target_1\n\n$text", "HTML", false, false, null, $reply_markup);
    } elseif ($post_target == "") {
      $target_0 = 0;
      $target_1 = 0;
      $stmt = $pdo->prepare("SELECT * FROM $bot_username");
      $stmt->execute();
      $result_0 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $target_0 = count($result_0);
      $stmt = $pdo->prepare("SELECT * FROM $bot_username WHERE status=0");
      $stmt->execute();
      $result_1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $target_1 = count($result_1);
      if ($callback_data == "WIAvygTA9M") {
        $post_replace = ["target" => 0];
        $json = array_replace($post, $post_replace);
        file_put_contents("plugins/config/posts/$user_id.json", json_encode($json));
        $reply_markup = ["inline_keyboard" => [[["text" => "📤 Invia", "callback_data" => "yy4RduyUXl"]], [["text" => "❌ Annulla", "callback_data" => "72Wa8DPlAY"]]]];
        $post_text_custom = $post_text;
        $post_text_custom = str_replace("{first_name}", $first_name, $post_text_custom);
        $post_text_custom = str_replace("{last_name}", $last_name, $post_text_custom);
        $post_text_custom = str_replace("{username}", "@$username", $post_text_custom);
        if ($username == ""){
          $post_text_custom = str_replace("{username}", "", $post_text_custom);
        }else{
          $post_text_custom = str_replace("{username}", "@$username", $post_text_custom);
        }
        $post_text_custom = str_replace("{user_id}", $user_id, $post_text_custom);
        $post_text_custom = str_replace("{last_update}", date("d/m/Y H:i:s", time()), $post_text_custom);
        editMessageText($chat_id, $message_id, null, "✉️ <b>NUOVO POST</b> - riepilogo\n\n<b>Target:</b> Tutti gli utenti ($target_0)\n\n🌐 <b>Ecco come apparirà il messaggio:</b>\n\n$post_text\n\n\n👤 <b>Ecco come il messaggio apparirebbe per te:</b>\n\n$post_text_custom", "HTML", false, $reply_markup);
      } elseif ($callback_data == "fr9lzDvxhk") {
        $post_replace = ["target" => 1];
        $json = array_replace($post, $post_replace);
        file_put_contents("plugins/config/posts/$user_id.json", json_encode($json));
        $reply_markup = ["inline_keyboard" => [[["text" => "📤 Invia", "callback_data" => "yy4RduyUXl"]], [["text" => "❌ Annulla", "callback_data" => "72Wa8DPlAY"]]]];
        $post_text_custom = $post_text;
        $post_text_custom = str_replace("{first_name}", $first_name, $post_text_custom);
        $post_text_custom = str_replace("{last_name}", $last_name, $post_text_custom);
        if ($username == ""){
          $post_text_custom = str_replace("{username}", "", $post_text_custom);
        }else{
          $post_text_custom = str_replace("{username}", "@$username", $post_text_custom);
        }
        $post_text_custom = str_replace("{user_id}", $user_id, $post_text_custom);
        $post_text_custom = str_replace("{last_update}", date("d/m/Y H:i:s", time()), $post_text_custom);
        editMessageText($chat_id, $message_id, null, "✉️ <b>NUOVO POST</b> - riepilogo\n\n<b>Target:</b> Solo utenti liberi ($target_1)\n\n🌐 <b>Ecco come apparirà il messaggio:</b>\n\n$post_text\n\n\n👤 <b>Ecco come il messaggio apparirebbe per te:</b>\n\n$post_text_custom", "HTML", false, $reply_markup);
      }
    }
  }

  if (in_array($text[0], $config['plugins_config']['command_prefix'])) {
    if ($chat_id > 0) {
      if (substr($text, 1, 4) == "post") {
        if ($config['database']['use_database']) {
          $json = [
            "text" => "",
            "target" => "",
          ];
          unlink("plugins/config/posts/$user_id.json");
          file_put_contents("plugins/config/posts/$user_id.json", json_encode($json));
          $reply_markup = ["inline_keyboard" => [[["text" => "❌ Annulla", "callback_data" => "72Wa8DPlAY"]]]];
          sendMessage($chat_id, "✉️ <b>NUOVO POST</b> - messaggio\n\nScrivi qui di seguito il messaggio che vuoi inviare a tutti gli utenti che usano il Bot. Puoi usare la formattazione <b>HTML</b>.\n\nPer rendere il messaggio ancora più personalizzato, puoi usare i seguenti argomenti:\n<code>{first_name}</code> stampa il nome dell'utente.\n<code>{last_name}</code> stampa il cognome dell'utente.\n<code>{username}</code> stampa l'username dell'utente.\n<code>{user_id}</code> stampa l'User ID dell utente.\n<code>{last_update}</code> stampa la data dell'ultimo accesso al bot da parte dell'utente destinatario del messaggio.", "HTML", false, false, null, $reply_markup);
        } else {
          sendMessage($chat_id, "❌ <b>Impossibile usare il comando</b> <code>post</code>.\n\nQuesto comando necessita del database.", "HTML");
        }
      }
    }
  }
}
