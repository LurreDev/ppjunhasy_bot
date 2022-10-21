<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require_once 'vendor/autoload.php';
require_once 'database/configDB.php';

$configs = [
    "telegram" => [
        "token" =>  '5622760229:AAEszpi_qvclwD6VPfL_-man3eZ2YcSMdvU'
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs); 

// Command no @ to bot
$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();

    $bot->reply("Assalamualaikum $firstname $lastname (ID:$id_user),\nNama Saya Kak Edwin. Selamat Datang Di Layanan Pusat Pelayanan Jurnal UNHASY.\n\nKetikkan Perintah /Menu Untuk Mengetahui Beberapa Layanan Kami
    \n\nKetikkan Perintah /help jika perlu bantuan
    ");
    include "command/requestChat.php";
});

$botman->hears("/help", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    include "command/requestChat.php";
    $bot->reply("
    <p>Hai Perlu bantun kak $firstname, DM langsung @ppjunhasy, chat nama dan tujuan atau pertanyaan</p><br>
    ");
    
});

$botman->hears("/menu", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";
    
    $bot->reply("/alurscan \n*Untuk Melihat Alur scan Plagiasi");
    $bot->reply("/layanansurat\n*Untuk Melihat informasi tentang surat");
    $bot->reply("/konfirmasipembayaram \n*Untuk Melihat informasi pembayaran");
    $bot->reply("/listjurnalunhasy \n*Untuk Melihat Semua situs jurnal UNHASY");
    $bot->reply("/listchanelgrup \n*Daftar channel telegram PPJ UNHASY");
    $bot->reply("/quotesday \n*Memberikan motifasi dalam kehidupan");
});

 
// Command with @ to bot
// $botman->hears("/start@ppjunhasy_bot", function (BotMan $bot) {
//     $user = $bot->getUser();
//     $firstname = $user->getFirstName();
//     $id_user = $user->getId();

//     $id = $user->getId();
//     $bot->reply("Assalamualaikum $firstname ðŸ˜Š (ID:$id_user),\nNama Saya Aisyah Salma. Selamat Datang Di Layanan Sekretaris Pribadi Anda.\n\nKetikkan Perintah /menu Untuk Mengetahui Menu Layanan Kami");
//     include "command/requestChat.php";
// });
 
$botman->hears("/alurscan", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Aturan Scan");
    $bot->reply(" <li>1. Aturan Scan
</li>
<li>2. Format Pengiriman Scan
</li>
<li>2.Alur Scan  </li>
<ul>
    <li>1. silahan melihat biaya scan di perintah /konfirmasipembayaram dan melakukan pembayaran</li>
    <li>2. kirim file di channel @scanplagiasi dengan kode #scan</li>
    <li>3. hasil scan akan dikirim ke akun sendiri-sendiri</li>
    <li>4. jika nilai scan sudah dibawah 20% bisa mengisi link form surat lolos plagiasi di  /layanansurat</li>
</ul>");
});

$botman->hears("/layanansurat", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Layanan Persuratan Mahasiswa Dan Dosen");
    $bot->reply("List Link Google form");
});

$botman->hears("/konfirmasipembayaram", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("konfirmasipembayaram   Mahasiswa Dan Dosen");
    $bot->reply("List Link Google form");
});

$botman->hears("/listjurnalunhasy", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Layanan Persuratan Mahasiswa Dan Dosen");
    $bot->reply("List Link Google form");
});


$botman->hears("/listchanelgrup", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Layanan Persuratan Mahasiswa Dan Dosen");
    $bot->reply("List Link Google form");
});

$botman->hears("/quotesday", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Layanan Persuratan Mahasiswa Dan Dosen");
    $bot->reply("List Link Google form");
});




// command not found
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Maaf, Jawaba  Perintah Ini '$message' Tidak Ada 😐 Silahan Chat di @ppjunhasy");
});


$botman->listen();