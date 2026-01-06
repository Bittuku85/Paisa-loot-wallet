<?php
// Render.com Bot Script

// Yahan Apna TOKEN Dalein (Hardcode karna padega)
$bot_token = "8544481346:AAFMzuU6vZwCl_mrWsnuw9EbCpYn1TfzOx8";

// Telegram Update Receive
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];
    $first_name = $update["message"]["chat"]["first_name"];

    $reply = "";

    // START COMMANDS
    if ($text == "/start active") {
        $reply = "✅ <b>Success!</b>\n\nHello $first_name, Your wallet alert is now active on the website.\n\n🥳 <b>ENJOY!</b>";
    }
    else if ($text == "/start") {
        $reply = "👋 <b>Hello $first_name!</b>\n\n🆔 <b>Your ID:</b> <code>$chat_id</code>\n\n(Copy this ID and paste it on the website)";
    }

    // MESSAGE SENDING
    if($reply != ""){
        $url = "https://api.telegram.org/bot$bot_token/sendMessage";
        $data = [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ];
        
        // Render par cURL use karein
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }
} else {
    echo "Bot is Running!";
}
?>
