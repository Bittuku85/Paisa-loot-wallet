<?php
// Render.com Bot (Updated)

$bot_token = "8544481346:AAFMzuU6vZwCl_mrWsnuw9EbCpYn1TfzOx8";

// --- WEBSITE SE REQUEST ---
if (isset($_GET['send_to']) && isset($_GET['msg'])) {
    $chat_id = $_GET['send_to'];
    $message = $_GET['msg'];
    
    $url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    
    // Response print karein taaki humein pata chale error kya hai
    echo "Telegram Response: " . $res;
    exit;
}

// --- TELEGRAM UPDATE ---
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update["message"])) {
    // ... Wahi purana logic start wala ...
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];
    
    if ($text == "/start active") {
        $msg = "✅ Active!";
    } else {
        $msg = "Hello! ID: $chat_id";
    }
    
    file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($msg));
} else {
    echo "Bot is Running! (v2)";
}
?>
