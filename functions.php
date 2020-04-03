<?php
error_reporting(0);


$message = $update['message'];


if ($config['work_with_edited_messages']){
  if (isset($update['edited_message'])){
    $message = $update['edited_message'];
    $message_edited = true;
  }
}

if ($config['channels_work_with_edited_messages']){
  if (isset($update['edited_channel_post'])){
    $message = $update['edited_channel_post'];
    $message_edited = true;
  }
}

if (isset($update['channel_post'])){
  $message = $update['channel_post'];
}

$update_id = $update['update_id'];
$message_id = $message['message_id'];
$text = $message['text'];
$user_id = $message['from']['id'];
$is_bot = $message['from']['is_bot'];
$first_name = $message['from']['first_name'];
$last_name = $message['from']['last_name'];
$username = $message['from']['username'];
$language_code = $message['from']['language_code'];
$date = $message['date'];
$author_signature = $message['author_signature'];
$forward_from_message_id = $message['forward_from_message_id'];
$forward_signature = $message['forward_signature'];
$chat_id = $message['chat']['id'];
$chat_type = $message['chat']['type'];
$chat_title = $message['chat']['title'];
$chat_username = $message['chat']['username'];
$chat_first_name = $message['chat']['first_name'];
$chat_last_name = $message['chat']['last_name'];
$new_chat_title = $message['new_chat_title'];
$delete_chat_photo = $message['delete_chat_photo'];
$group_chat_created = $message['group_chat_created'];
$supergroup_chat_created = $message['supergroup_chat_created'];
$channel_chat_created = $message['channel_chat_created'];
$migrate_to_chat_id = $message['migrate_to_chat_id'];
$migrate_from_chat_id = $message['migrate_from_chat_id'];

if ($chat_type == "group") $chat_all_members_are_administrators = $message['chat']['all_members_are_administrators'];

if (isset($message['forward_from'])){
  $forward_from_id = $message['forward_from']['id'];
  $forward_from_is_bot = $message['forward_from']['is_bot'];
  $forward_from_first_name = $message['forward_from']['first_name'];
  $forward_from_last_name = $message['forward_from']['last_name'];
  $forward_from_username = $message['forward_from']['username'];
  $forward_from_language_code = $message['forward_from']['language_code'];
}

if (isset($message['forward_from_chat'])){
  $forward_from_chat_id = $message['forward_from_chat']['id'];
  $forward_from_chat_type = $message['forward_from_chat']['type'];
  $forward_from_chat_title= $message['forward_from_chat']['title'];
  $forward_from_chat_username = $message['forward_from_chat']['username'];
  $forward_from_chat_first_name = $message['forward_from_chat']['first_name'];
  $forward_from_chat_last_name = $message['forward_from_chat']['last_name'];
}

if (isset($update['callback_query'])){
  $callback_query_id = $update["callback_query"]["id"];
  $callback_data = $update["callback_query"]["data"];
  $message_id = $update["callback_query"]["message"]["message_id"];
  $chat_id = $update["callback_query"]["message"]["chat"]["id"];
  $user_id = $update["callback_query"]["from"]["id"];
  $first_name = $update["callback_query"]["from"]["first_name"];
  $last_name = $update["callback_query"]["from"]["last_name"];
  $username = $update["callback_query"]["from"]["username"];
  $language_code = $update["callback_query"]["from"]['language_code'];
}

if (isset($update['inline_query'])){
  $inline_query_id = $update['inline_query']['id'];
  $inline_query_from_id = $update['inline_query']['from']['id'];
  $inline_query_from_is_bot = $update['inline_query']['from']['is_bot'];
  $inline_query_from_first_name = $update['inline_query']['from']['first_name'];
  $inline_query_from_last_name = $update['inline_query']['from']['last_name'];
  $inline_query_from_username = $update['inline_query']['from']['username'];
  $inline_query_from_language_code = $update['inline_query']['from']['language_code'];
  $inline_query_location_longitude = $update['inline_query']['location']['longitude'];
  $inline_query_location_latitude = $update['inline_query']['location']['latitude'];
  $inline_query = $update['inline_query']['query'];
  $inline_query_offset = $update['inline_query']['offset'];
}

if (isset($update['poll_answer'])){
  $poll_answer_pool_id = $update['poll_answer']['poll_id'];
  $poll_answer_user_id = $update['poll_answer']['user']['id'];
  $poll_answer_user_is_bot = $update['poll_answer']['user']['is_bot'];
  $poll_answer_user_first_name = $update['poll_answer']['user']['first_name'];
  $poll_answer_user_last_name = $update['poll_answer']['user']['last_name'];
  $poll_answer_user_username = $update['poll_answer']['user']['username'];
  $poll_answer_user_language_code = $update['poll_answer']['user']['language_code'];
  $poll_answer_option_ids = $update['poll_answer']['option_ids'];
}

if (isset($message['replay_to_message'])){
  $replay_message_id = $message['replay_to_message']['message_id'];
  $replay_text = $message['replay_to_message']['text'];
  $replay_date = $message['replay_to_message']['date'];

  $replay_from_id = $message['replay_to_message']['from']['id'];
  $replay_from_is_bot = $message['replay_to_message']['form']['is_bot'];
  $replay_from_first_name = $message['replay_to_message']['form']['first_name'];
  $replay_from_last_name = $message['replay_to_message']['form']['last_name'];
  $replay_from_language_code = $message['replay_to_message']['form']['language_code'];

  $replay_chat_id = $message['replay_to_message']['chat']['id'];
  $replay_chat_type = $message['replay_to_message']['chat']['type'];
  $replay_chat_title= $message['replay_to_message']['chat']['title'];
  $replay_chat_username = $message['replay_to_message']['chat']['username'];
  $replay_chat_first_name = $message['replay_to_message']['chat']['first_name'];
  $replay_chat_last_name = $message['replay_to_message']['chat']['last_name'];
}

if (isset($message['audio'])){
  $audio_file_id = $message['audio']['file_id'];
  $audio_file_unique_id = $message['audio']['file_unique_id'];
  $audio_duration = $message['audio']['duration'];
  $audio_performer = $message['audio']['performer'];
  $audio_title = $message['audio']['title'];
  $audio_mime_type = $message['audio']['mime_type'];
  $audio_file_size = $message['audio']['file_size'];
  $audio_thumb_file_id = $message['audio']['thumb']['file_id'];
  $audio_thumb_file_unique_id = $message['audio']['thumb']['file_unique_id'];
  $audio_thumb_width = $message['audio']['thumb']['width'];
  $audio_thumb_height = $message['audio']['thumb']['height'];
  $audio_thumb_file_size = $message['audio']['thumb']['file_size'];
  $caption = $message['caption'];
}

if (isset($message['document'])){
  $document_file_id = $message['document']['file_id'];
  $document_file_unique_id = $message['document']['file_unique_id'];
  $document_thumb_file_id = $message['document']['thumb']['file_id'];
  $document_thumb_file_unique_id = $message['document']['thumb']['file_unique_id'];
  $document_thumb_width = $message['document']['thumb']['width'];
  $document_thumb_height = $message['document']['thumb']['height'];
  $document_thumb_file_size = $message['document']['thumb']['file_size'];
  $document_file_name = $message['document']['file_name'];
  $document_mime_type = $message['document']['mime_type'];
  $document_file_size = $message['document']['file_size'];
  $caption = $message['caption'];
}

if (isset($message['animation'])){
  $animation_file_id = $message['animation']['file_id'];
  $animation_file_unique_id = $message['animation']['file_unique_id'];
  $animation_width = $message['animation']['width'];
  $animation_height = $message['animation']['height'];
  $animation_duration = $message['animation']['duration'];
  $animation_thumb_file_id = $message['animation']['thumb']['file_id'];
  $animation_thumb_file_unique_id = $message['animation']['thumb']['file_unique_id'];
  $animation_thumb_width = $message['animation']['thumb']['width'];
  $animation_thumb_height = $message['animation']['thumb']['height'];
  $animation_thumb_file_size = $message['animation']['thumb']['file_size'];
  $animation_file_name = $message['animation']['file_name'];
  $animation_mime_type = $message['animation']['mime_type'];
  $animation_file_size = $message['animation']['file_size'];
  $caption = $message['caption'];
}

if (isset($message['game'])){
  $game_title = $message['game']['title'];
  $game_description = $message['game']['description'];
  $game_photo = $message['game']['photo'];
  $game_photo_file_id = $message['game']['photo']['file_id'];
  $game_photo_file_unique_id = $message['game']['photo']['file_unique_id'];
  $game_photo_width = $message['game']['photo']['width'];
  $game_photo_height = $message['game']['photo']['height'];
  $game_photo_file_size = $message['game']['photo']['file_size'];
  $game_text = $message['game']['text'];
  $game_animation = $message['game']['animation'];
  $game_animation_file_id = $message['game']['animation']['file_id'];
  $game_animation_file_unique_id = $message['game']['animation']['file_unique_id'];
  $game_animation_width = $message['game']['animation']['width'];
  $game_animation_height = $message['game']['animation']['height'];
  $game_animation_duration = $message['game']['animation']['duration'];
  $game_animation_thumb_file_id = $message['game']['animation']['thumb']['file_id'];
  $game_animation_thumb_file_unique_id = $message['game']['animation']['thumb']['file_unique_id'];
  $game_animation_thumb_width = $message['game']['animation']['thumb']['width'];
  $game_animation_thumb_height = $message['game']['animation']['thumb']['height'];
  $game_animation_thumb_file_size = $message['game']['animation']['thumb']['file_size'];
  $game_animation_file_name = $message['game']['animation']['file_name'];
  $game_animation_mime_type = $message['game']['animation']['mime_type'];
  $game_animation_file_size = $message['game']['animation']['file_size'];
}

if (isset($message['photo'])){
  $photo = $message['photo'];
  $photo_file_id = $message['photo'][0]['file_id'];
  $photo_file_unique_id = $message['photo'][0]['file_unique_id'];
  $photo_width = $message['photo'][0]['width'];
  $photo_height = $message['photo'][0]['height'];
  $photo_file_size = $message['photo'][0]['file_size'];
  $caption = $message['caption'];
}

if (isset($message['sticker'])){
  $sticker_file_id = $message['sticker']['file_id'];
  $sticker_file_unique_id = $message['sticker']['file_unique_id'];
  $sticker_width = $message['sticker']['width'];
  $sticker_height = $message['sticker']['height'];
  $sticker_is_animated = $message['sticker']['is_animated'];
  $sticker_thumb_file_id = $message['sticker']['thumb']['file_id'];
  $sticker_thumb_file_unique_id = $message['sticker']['thumb']['file_unique_id'];
  $sticker_thumb_width = $message['sticker']['thumb']['width'];
  $sticker_thumb_height = $message['sticker']['thumb']['height'];
  $sticker_thumb_file_size = $message['sticker']['thumb']['file_size'];
  $sticker_emoji = $message['sticker']['emoji'];
  $sticker_set_name = $message['sticker']['set_name'];
  $sticker_mask_position = $message['sticker']['mask_position'];
  $sticker_file_size = $message['sticker']['file_size'];
}

if (isset($message['video'])){
  $video_file_id = $message['video']['file_id'];
  $video_file_unique_id = $message['video']['file_unique_id'];
  $video_width = $message['video']['width'];
  $video_height = $message['video']['height'];
  $video_duration = $message['video']['duration'];
  $video_thumb_file_id = $message['video']['thumb']['file_id'];
  $video_thumb_file_unique_id = $message['video']['thumb']['file_unique_id'];
  $video_thumb_width = $message['video']['thumb']['width'];
  $video_thumb_height = $message['video']['thumb']['height'];
  $video_thumb_file_size = $message['video']['thumb']['file_size'];
  $video_mime_type = $message['video']['mime_type'];
  $video_file_size = $message['video']['file_size'];
  $caption = $message['caption'];
}

if (isset($message['voice'])){
  $voice_file_id = $message['voice']['file_id'];
  $voice_file_unique_id = $message['voice']['file_unique_id'];
  $voice_duration = $message['voice']['duration'];
  $voice_mime_type = $message['voice']['mime_type'];
  $voice_file_size = $message['voice']['file_size'];
  $caption = $message['caption'];
}

if (isset($message['video_note'])){
  $video_note_file_id = $message['video_note']['file_id'];
  $video_note_file_unique_id = $message['video_note']['file_unique_id'];
  $video_note_lenght = $message['video_note']['lenght'];
  $video_note_duration = $message['video_note']['duration'];
  $video_note_thumb_file_id = $message['video_note']['thumb']['file_id'];
  $video_note_thumb_file_unique_id = $message['video_note']['thumb']['file_unique_id'];
  $video_note_thumb_width = $message['video_note']['thumb']['width'];
  $video_note_thumb_height = $message['video_note']['thumb']['height'];
  $video_note_thumb_file_size = $message['video_note']['thumb']['file_size'];
  $video_note_file_size = $message['video_note']['file_'];
}

if (isset($message['contact'])){
  $contact_phone_number = $message['contact']['phone_number'];
  $contact_first_name = $message['contact']['first_name'];
  $contact_last_name = $message['contact']['last_name'];
  $contact_user_id = $message['contact']['user_id'];
  $contact_vcard = $message['contact']['vcard'];
}

if (isset($message['location'])){
  $location_longitude = $message['location']['longitude'];
  $location_latitude = $message['location']['latitude'];
}

if (isset($message['venue'])){
  $venue_location_longitude = $message['venue']['location']['longitude'];
  $venue_location_latitude = $message['venue']['location']['latitude'];
  $venue_title = $message['venue']['title'];
  $venue_address = $message['venue']['address'];
  $venue_foursquare_id = $message['venue']['foursquare_id'];
  $venue_foursquare_type = $message['venue']['foursquare_type'];
}

if (isset($message['poll'])){
  $poll_id = $message['poll']['id'];
  $poll_question = $message['poll']['question'];
  $poll_options = $message['poll']['options'];
  $poll_total_voter_count = $message['poll']['total_voter_count'];
  $poll_is_closed = $message['poll']['is_closed'];
  $poll_is_anonymous = $message['poll']['is_anonymous'];
  $poll_type = $message['poll']['type'];
  $poll_allows_multiple_answers = $message['poll']['allows_multiple_answers'];
  $poll_correct_option_id = $message['poll']['correct_option_id'];
}

if (isset($message['dice'])){
  $dice_value = $message['dice']['value'];
}

if (isset($message['new_chat_member'])){
  $new_chat_member_id = $message['new_chat_member']['id'];
  $new_chat_member_is_bot = $message['new_chat_member']['is_bot'];
  $new_chat_member_first_name = $message['new_chat_member']['first_name'];
  $new_chat_member_last_name = $message['new_chat_member']['last_name'];
  $new_chat_member_username = $message['new_chat_member']['username'];
  $new_chat_member_language_code = $message['new_chat_member']['language_code'];
}

if (isset($message['left_chat_member'])){
  $left_chat_member_id = $message['left_chat_member']['id'];
  $left_chat_member_is_bot = $message['left_chat_member']['is_bot'];
  $left_chat_member_first_name = $message['left_chat_member']['first_name'];
  $left_chat_member_last_name = $message['left_chat_member']['last_name'];
  $left_chat_member_username = $message['left_chat_member']['username'];
  $left_chat_member_language_code = $message['left_chat_member']['language_code'];
}

if (isset($message['new_chat_photo'])){
  $new_chat_photo_file_id = $message['new_chat_photo']['file_id'];
  $new_chat_photo_file_unique_id = $message['new_chat_photo']['file_unique_id'];
  $new_chat_photo_width = $message['new_chat_photo']['width'];
  $new_chat_photo_height = $message['new_chat_photo']['height'];
  $new_chat_photo_file_size = $message['new_chat_photo']['file_size'];
}

if (isset($message['pinned_message'])){
  $pinned_message = $message['pinned_message'];
  $pinned_message_id = $message['pinned_message']['message_id'];
  $pinned_message_text = $message['pinned_message']['text'];
}

function http_request($method, $args) {
  global $config;

  $token = $config['token'];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/$method?");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));

  $headers = array();
  $headers[] = 'Content-Type: application/json';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec($ch);
  return $result;
}

function sec_test($key, $ver_key) {
  if ($key !== $ver_key) {
    header('Content-Type: application/json');
    die(json_encode(["ok" => false, "description" => "Security test not passed"]));
  }
}

function sendMessage($chat_id, $text, $parse_mode = "default", $disable_web_page_preview = "default", $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_web_page_preview === "default") $disable_web_page_preview = $config['disable_web_page_preview'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "text" => $text,
    "parse_mode" => $parse_mode,
    "disable_web_page_preview" => $disable_web_page_preview,
    "disable_notification" => $disable_notification,
  ];

  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendMessage", $args), true);
}

function sendPhoto($chat_id, $photo, $caption, $parse_mode = "default", $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "photo" => $photo,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendPhoto", $args), true);
}


function answerCallbackQuery($callback_query_id, $text, $show_alert = false, $url, $cache_time) {

  global $config;

  $args = [
    "callback_query_id" => $callback_query_id,
    "text" => $text,
  ];

  if ($show_alert) $args["show_alert"] = $show_alert;
  if (isset($url)) $args["url"] = $url;

  return json_decode(http_request("answerCallbackQuery", $args), true);
}

function editMessageText($chat_id, $message_id, $inline_message_id, $text, $parse_mode = "default", $disable_web_page_preview = "default", $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_web_page_preview === "default") $disable_web_page_preview = $config['disable_web_page_preview'];

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "text" => $text,
    "parse_mode" => $parse_mode,
    "disable_web_page_preview" => $disable_web_page_preview
  ];

  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;

  return json_decode(http_request("editMessageText", $args), true);
}

function forwardMessage($chat_id, $from_chat_id, $disable_notification = "default", $message_id) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "from_chat_id" => $from_chat_id,
    "message_id" => $message_id,
    "disable_notification" => $disable_notification,
  ];

  return json_decode(http_request("forwardMessage", $args), true);
}

function sendAudio($chat_id, $audio, $caption, $parse_mode = "default", $duration, $performer, $title, $thumb, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "audio" => $audio,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($duration)) $args["duration"] = $duration;
  if (isset($performer)) $args["performer"] = $performer;
  if (isset($title))$args["title"] = $title;
  if (isset($thumb))$args["thumb"] = $thumb;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendAudio", $args), true);
}

function sendDocument($chat_id, $document, $thumb, $caption, $parse_mode = "default", $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "document" => $document,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($thumb))$args["thumb"] = $thumb;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendDocument", $args), true);
}

function sendVideo($chat_id, $video, $duration, $width, $height, $thumb, $caption, $parse_mode = "default", $supports_streaming = false, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "video" => $video,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($duration)) $args["duration"] = $duration;
  if (isset($width)) $args["width"] = $width;
  if (isset($height)) $args["height"] = $height;
  if ($supports_streaming)$args["supports_streaming"] = $supports_streaming;
  if (isset($thumb))$args["thumb"] = $thumb;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendVideo", $args), true);
}

function sendAnimation($chat_id, $animation, $duration, $width, $height, $thumb, $caption, $parse_mode = "default", $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "animation" => $animation,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($duration)) $args["duration"] = $duration;
  if (isset($width)) $args["width"] = $width;
  if (isset($height)) $args["height"] = $height;
  if (isset($thumb))$args["thumb"] = $thumb;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendAnimation", $args), true);
}

function sendVoice($chat_id, $voice, $caption, $parse_mode = "default", $duration, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];
  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "voice" => $voice,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
    "disable_notification" => $disable_notification,
  ];

  if (isset($duration)) $args["duration"] = $duration;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendVoice", $args), true);
}

function sendVideoNote($chat_id, $video_note, $duration, $lenght, $thumb, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "video_note" => $video_note,
    "disable_notification" => $disable_notification,
  ];

  if (isset($duration)) $args["duration"] = $duration;
  if (isset($lenght)) $args["lenght"] = $lenght;
  if (isset($thumb))$args["thumb"] = $thumb;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendVideoNote", $args), true);
}

function sendMediaGroup($chat_id, $media, $disable_notification = "default", $reply_to_message_id) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "media" => $media,
    "disable_notification" => $disable_notification,
  ];

  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;

  return json_decode(http_request("sendMediaGroup", $args), true);
}

function sendLocation($chat_id, $latitude, $longitude, $live_period, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "latitude" => $latitude,
    "longitude" => $longitude,
    "disable_notification" => $disable_notification,
  ];
  
  if (isset($live_period)) $args["live_period"] = $live_period;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendLocation", $args), true);
}

function editMessageLiveLocation($chat_id, $message_id, $inline_message_id, $latitude, $longitude, $reply_markup) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "latitude" => $latitude,
    "longitude" => $longitude,
  ];
  
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("editMessageLiveLocation", $args), true);
}

function stopMessageLiveLocation($chat_id, $message_id, $inline_message_id, $reply_markup) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
  ];
  
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("stopMessageLiveLocation", $args), true);
}

function sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id, $foursquare_type, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "latitude" => $latitude,
    "longitude" => $longitude,
    "title" => $title,
    "address" => $address,
    "foursquare_id" => $foursquare_id,
    "foursquare_type" => $foursquare_type,
    "disable_notification" => $disable_notification,
  ];

  if (isset($foursquare_id)) $args["foursquare_id"] = $foursquare_id;
  if (isset($foursquare_type)) $args["foursquare_type"] = $foursquare_type;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendVenue", $args), true);
}

function sendContact($chat_id, $phone_number, $first_name, $last_name, $vcard, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "phone_number" => $phone_number,
    "first_name" => $first_name,
    "disable_notification" => $disable_notification,
  ];

  if (isset($last_name)) $args["last_name"] = $last_name;
  if (isset($vcard)) $args["vcard"] = $vcard;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendContact", $args), true);
}

function sendPoll($chat_id, $question, $options, $is_anonymous, $type, $allows_multiple_answers, $correct_option_id, $is_closed, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "question" => $question,
    "options" => $options,
    "disable_notification" => $disable_notification,
  ];

  if (isset($is_anonymous)) $args["is_anonymous"] = $is_anonymous;
  if (isset($type)) $args["type"] = $type;
  if (isset($allows_multiple_answers)) $args["allows_multiple_answers"] = $allows_multiple_answers;
  if (isset($correct_option_id)) $args["correct_option_id"] = $correct_option_id;
  if (isset($is_closed)) $args["is_closed"] = $is_closed;
  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendPoll", $args), true);
}

function sendDice($chat_id, $disable_notification = "default", $reply_to_message_id, $reply_markup){

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "disable_notification" => $disable_notification,
  ];

  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendDice", $args), true);
}

function sendChatAction($chat_id, $action) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "action" => $action,
  ];

  return json_decode(http_request("sendChatAction", $args), true);
}

function getUserProfilePhotos($user_id, $offset, $limit) {

  global $config;

  $args = [
    "user_id" => $chat_id,
  ];

  if (isset($offset)) $args["offset"] = $offset;
  if (isset($limit)) $args["limit"] = $limit;

  return json_decode(http_request("getUserProfilePhotos", $args), true);
}

function getFile($file_id) {

  global $config;

  $args = [
    "file_id" => $file_id,
  ];

  return json_decode(http_request("getFile", $args), true);
}

function getMe() {

  global $config;

  return json_decode(http_request("getMe", $args), true);
}

function kickChatMember($chat_id, $user_id, $until_date) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
  ];

  if (isset($until_date)) $args["until_date"] = $until_date;

  return json_decode(http_request("kickChatMember", $args), true);
}

function unbanChatMember($chat_id, $user_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
  ];

  return json_decode(http_request("unbanChatMember", $args), true);
}

function restrictChatMember($chat_id, $user_id, $permissions, $until_date) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
    "permissions" => $permissions
  ];

  if (isset($until_date)) $args["until_date"] = $until_date;
  
  return json_decode(http_request("restrictChatMember", $args), true);
}

function promoteChatMember($chat_id, $user_id, $can_change_info, $can_post_messages, $can_edit_messages, $can_delete_messages, $can_invite_users, $can_restrict_members, $can_pin_messages, $can_promote_members) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
  ];

  if (isset($can_change_info)) $args["can_change_info"] = $can_change_info;
  if (isset($can_post_messages)) $args["can_post_messages"] = $can_post_messages;
  if (isset($can_edit_messages)) $args["can_edit_messages"] = $can_edit_messages;
  if (isset($can_delete_messages)) $args["can_delete_messages"] = $can_delete_messages;
  if (isset($can_invite_users)) $args["can_invite_users"] = $can_invite_users;
  if (isset($can_restrict_members)) $args["can_restrict_members"] = $can_restrict_members;
  if (isset($can_pin_messages)) $args["can_pin_messages"] = $can_pin_messages;
  if (isset($can_promote_members)) $args["can_promote_members"] = $can_promote_members;
  
  return json_decode(http_request("promoteChatMember", $args), true);
}

function setChatAdministratorCustomTitle($chat_id, $user_id, $custom_title) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
    "custom_title" => $custom_title
  ];
  
  return json_decode(http_request("setChatAdministratorCustomTitle", $args), true);
}

function setChatPermissions($chat_id, $permissions) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "permissions" => $permissions
  ];
  
  return json_decode(http_request("setChatPermissions", $args), true);
}

function exportChatInviteLink($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];
  
  return json_decode(http_request("exportChatInviteLink", $args), true);
}

function setChatPhoto($chat_id, $photo) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "photo" => $photo,
  ];
  
  return json_decode(http_request("setChatPhoto", $args), true);
}

function deleteChatPhoto($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];
  
  return json_decode(http_request("deleteChatPhoto", $args), true);
}

function setChatTitle($chat_id, $title) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "title" => $title,
  ];
  
  return json_decode(http_request("setChatTitle", $args), true);
}

function setChatDescription($chat_id, $description) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "description" => $description,
  ];
  
  return json_decode(http_request("setChatDescription", $args), true);
}

function pinChatMessage($chat_id, $message_id, $disable_notification = "default") {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "disable_notification" => $disable_notification,
  ];

  return json_decode(http_request("setChatDescription", $args), true);
}

function unpinChatMessage($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("unpinChatMessage", $args), true);
}

function leaveChat($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("leaveChat", $args), true);
}

function getChat($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("getChat", $args), true);
}

function getChatAdministrators($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("getChatAdministrators", $args), true);
}

function getChatMembersCount($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("getChatMembersCount", $args), true);
}

function getChatMember($chat_id, $user_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "user_id" => $user_id,
  ];

  return json_decode(http_request("getChatMember", $args), true);
}

function setChatStickerSet($chat_id, $sticker_set_name) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "sticker_set_name" => $sticker_set_name,
  ];

  return json_decode(http_request("setChatStickerSet", $args), true);
}

function deleteChatStickerSet($chat_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
  ];

  return json_decode(http_request("deleteChatStickerSet", $args), true);
}

function editMessageCaption($chat_id, $message_id, $inline_message_id, $caption, $parse_mode = "default", $reply_markup) {

  global $config;

  if ($parse_mode == "default") $parse_mode = $config['parse_mode'];

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "caption" => $caption,
    "parse_mode" => $parse_mode,
  ];

  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;

  return json_decode(http_request("editMessageCaption", $args), true);
}

function editMessageMedia($chat_id, $message_id, $inline_message_id, $media, $reply_markup) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
    "media" => $media,
  ];

  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;

  return json_decode(http_request("editMessageMedia", $args), true);
}


function editMessageReplyMarkup($chat_id, $message_id, $inline_message_id, $reply_markup) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
  ];

  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;
  if (isset($inline_message_id)) $args["inline_message_id"] = $inline_message_id;

  return json_decode(http_request("editMessageReplyMarkup", $args), true);
}

function stopPoll($chat_id, $message_id, $reply_markup) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
  ];

  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("stopPoll", $args), true);
}

function deleteMessage($chat_id, $message_id) {

  global $config;

  $args = [
    "chat_id" => $chat_id,
    "message_id" => $message_id,
  ];

  return json_decode(http_request("deleteMessage", $args), true);
}

function sendSticker($chat_id, $sticker, $disable_notification = "default", $reply_to_message_id, $reply_markup) {

  global $config;

  if ($disable_notification === "default") $disable_notification = $config['disable_notification'];

  $args = [
    "chat_id" => $chat_id,
    "sticker" => $sticker,
    "disable_notification" => $disable_notification,
  ];

  if (isset($reply_to_message_id)) $args["reply_to_message_id"] = $reply_to_message_id;
  if (isset($reply_markup)) $args["reply_markup"] = $reply_markup;

  return json_decode(http_request("sendSticker", $args), true);
}

function getStickerSet($name) {

  global $config;

  $args = [
    "name" => $name,
  ];

  return json_decode(http_request("getStickerSet", $args), true);
}

function uploadStickerFile($user_id, $png_sticker) {

  global $config;

  $args = [
    "user_id" => $user_id,
    "png_sticker" => $png_sticker
  ];

  return json_decode(http_request("uploadStickerFile", $args), true);
}

function createNewStickerSet($user_id, $name, $title ,$png_sticker, $emojis, $contains_mask, $mask_position) {

  global $config;

  $args = [
    "user_id" => $user_id,
    "name" => $name,
    "title" => $title,
    "emojis" => $emojis,
  ];

  if (isset($png_sticker)) $args['png_sticker'] = $png_sticker;
  if ($contains_mask) $args["contains_mask"] = $contains_mask;
  if (isset($mask_position)) $args["mask_position"] = $mask_position;

  return json_decode(http_request("uploadStickerFile", $args), true);
}

function addStickerToSet($user_id, $name, $png_sticker, $emojis, $mask_position) {

  global $config;

  $args = [
    "user_id" => $user_id,
    "name" => $name,
    "png_sticker" => $png_sticker,
    "emojis" => $emojis,
  ];
  
  if (isset($mask_position)) $args["mask_position"] = $mask_position;

  return json_decode(http_request("addStickerToSet", $args), true);
}

function setStickerPositionInSet($sticker, $position) {

  global $config;

  $args = [
    "sticker" => $sticker,
    "position" => $position,
  ];

  return json_decode(http_request("setStickerPositionInSet", $args), true);
}

function deleteStickerFromSet($sticker) {

  global $config;

  $args = [
    "sticker" => $sticker,
  ];

  return json_decode(http_request("deleteStickerFromSet", $args), true);
}

function setStickerSetThumb($name, $user_id, $thumb){

  global $config;

  $args = [
    "name" => $name,
    "user_id" => $user_id,
  ];

  if (isset($thumb)) $args["thumb"] = $thumb;
}


function answerInlineQuery($inline_query_id, $results, $cache_time, $is_personal, $next_offset, $swich_pm_text, $switch_pm_parameter){

  global $config;

  $args = [
    "inline_query_id" => $inline_query_id,
    "results" => $results,
  ];

  if (isset($cache_time)) $args["cache_time"] = $cache_time;
  if (isset($is_personal)) $args["is_personal"] = $is_personal;
  if (isset($next_offset)) $args["next_offset"] = $next_offset;
  if (isset($swich_pm_text)) $args["switch_pm_text"] = $swich_pm_text;
  if (isset($switch_pm_parameter)) $args["switch_pm_parameter"] = $switch_pm_parameter;
 
  return json_decode(http_request("answerInlineQuery", $args), true);
}

function setMyCommands($commands){

  global $config;

  $args = [
    "commands" => $commands,
  ];

  return json_decode(http_request("setMyCommands", $args), true);
}

function getMyCommands(){

  global $config;

  return json_decode(http_request("getMyCommands", $args), true);
}