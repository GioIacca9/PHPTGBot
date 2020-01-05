<?php

//QUESTO FILE CONTIENE SOLO GLI ESEMPI DI ALCUNI DEI METODI DISPONIBILI IN PHPTGBot

// Mostra la tastiera classica - https://core.telegram.org/bots/api#replykeyboardmarkup
if ($text == "/tastiera") {
  $reply_markup = [
    "keyboard" => [
      [ // Prima riga di bottoni
        ["text" => "Tasto 1"],
        ["text" => "/nascondi"],
        ["text" => "/rispondi"],
      ],
      [ // Seconda riga di bottoni
        ["text" => "Request contact", "request_contact" => true], // Invia al Bot il contatto dell'utente (con numero di telefono)
        ["text" => "Request location", "request_location" => true], // Invia al Bot la posizione dell'utente (disponibile per mobile)
      ],
    ],
    "resize_keyboard" => true,
    "one_time_keyboard" => false,
  ];
  sendMessage($chat_id, "Tastiera classica aperta", "HTML", false, true, 0, json_encode($reply_markup));
}

// Nasconde la tastiera classica - https://core.telegram.org/bots/api#replykeyboardremove
if ($text == "/nascondi") {
  $reply_markup = [
    "remove_keyboard" => true,
  ];
  sendMessage($chat_id, "Tastiera nascosta", "HTML", false, true, 0, $reply_markup);
}

// Forza l'utente a rispondere al messaggio del bot - https://core.telegram.org/bots/api#forcereply
if ($text == "/rispondi") {
  $reply_markup = [
    "force_reply" => true,
  ];
  sendMessage($chat_id, "Rispondi a questo messaggio", "HTML", false, true, false, $reply_markup);
}

// Apre una tastiera inline - https://core.telegram.org/bots/api#inlinekeyboardmarkup
if ($text == "/inline") {
  // Per creare i bottoni di una tastiera inline: https://core.telegram.org/bots/api#inlinekeyboardbutton
  $reply_markup = [
    "inline_keyboard" => [
      [ // Prima riga di bottoni
        [
          "text" => "Url",
          "url" => "https://google.com",
        ],
        [
          "text" => "Callback data",
          "callback_data" => "/callback",
        ],
      ],
      [ // Seconda riga di bottoni
        [
          "text" => "Switch inline query",
          "switch_inline_query" => "Inserisci questo",
        ],
        [
          "text" => "Scitch inline query current chat",
          "switch_inline_query_current_chat" => "Inserisci questo",
        ],
      ],
    ],
  ];
  sendMessage($chat_id, "Tastiera inline aperta", "HTML", false, true, 0, json_encode($reply_markup));
}


// Risponde alla pressione di un tasto su una tastiera inline
if ($callback_data == "/callback") {
  $reply_markup = [
    "inline_keyboard" => [
      [
        [
          "text" => "Prova 2",
          "callback_data" => "/test",
        ],
        [
          "text" => "Callback data",
          "callback_data" => "/test",
        ],
      ],
    ],
  ];
  answerCallbackQuery($callback_query_id, "Questa è una prova", true);
  editMessageText($chat_id, $message_id, false, "Prova messaggio modificato", "HTML", false, $reply_markup);
}


// Invia una foto - https://core.telegram.org/bots/api#sendphoto
if ($text == "/foto") {
  $reply_markup = [
    "inline_keyboard" => [
      [
        [
          "text" => "Url",
          "url" => "https://google.com",
        ],
      ],
    ],
  ];
  sendPhoto($chat_id, "https://www.macitynet.it/wp-content/uploads/2017/04/app-google-foto-notte-5.jpg", "Descrizione della foto", "HTML", false, $message_id, $reply_markup);
}


// Modalità inline - https://core.telegram.org/bots/api#inline-mode
if ($inline_query == "inline"){
  $results = [ // Risultati della richiesta inline - https://core.telegram.org/bots/api#inlinequeryresult
    [
      "type" => "article",
      "id" => "1",
      "title" => "Titolo della query",
      "input_message_content" => [
        "message_text" => "<b>Questo appare</b>",
        "parse_mode" => "HTML",
      ],
      "reply_markup" => ["inline_keyboard" => [[["text" => "CLICCA QUI","callback_data" => "/test"]]]],
      "description" => "$inline_query",
    ],
  ];
  answerInlineQuery($inline_query_id, $results, 1, null, null, "Impostazioni", "settings");
}
