<?php

$config = [
  "key" => "", // Chiave d'autenticazione del bot
  "token" => "", // Token del Bot
  "bot_username" => "", // Username del Bot (senza '@')

  "parse_mode" => "HTML", // Modalità di formattazione dei messaggi predefinita, può essere MarkdownV2/HTML/Markdown
  "disable_web_page_preview" => false, // Specifica se mostrare l'anteprima del link nei messaggi come impostazione predefinita
  "disable_notification" => false, // Specifica se disabilitare la notifica dei messaggi che invia il bot come impostazione predefinita
  "work_with_edited_messages" => true, // Specifica se il Bot funziona con i messaggi modificati
  "channels_work_with_edited_messages" => false, // Specifica se il Bot funziona con i messaggi modificati nei canali

  "database" => [
    "use_database" => true, // Specifica se usare il database per memorizzare e gestire gli utenti iscritti al bot
    "database" => "", // Nome del database
    "username" => "", // Nome utente per l'accesso al database
    "password" => "", // Facoltativo. La password dell'utente per l'accesso al database
    "host" => "localhost", // Indirizzo del server mysql
  ],

  "admins" => [
    504700021, // Aggiungere tutti gli user_id degli utenti che si vuole rendere amministratori nel bot (rimuovere quelli predefiniti)
    777000,
  ],

  "plugins" => [
    "users" => true, // Aggiungere eventuali plugins. È possibile disabilitare un plugin impostandolo su false. I plugin abilitati verranno inclusi automaticamente
    "posts" => true,
  ],

  "plugins_config" => [ // Configurazione dei plugin
    "command_prefix" => ["!", ".", "/"], // Prefisso per i comandi dei plugins
    
    "users" => [ // Configurazione plugin "users"
      "allow_banned_users" => false, // Specifica se consentire agli utenti bannati dall'utilizzo del bot ad utilizzarlo comunque (per sbannare tutti gli utenti temporaneamente e lasciare invariati i permessi degli utenti nel database)
      "bot_assistence" => false, // Contatto di assistenza per il bot. Viene mostrato quando un utente bannato tenta di utilizzare il bot. Se non si vuole lasciare nessun contatto, impostare su false. È possibile utilizzare la formattazione HTML
    ],
  ],
];