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

    $bot->reply("Assalamualaikum $firstname $lastname (ID:$id_user),\nNama Saya Aisyah Salma. Selamat Datang Di Layanan Sekretaris Pribadi Anda.\n\nKetikkan Perintah /help Untuk Mengetahui Menu Perintah Yang Bisa Saya Kerjakan");
    include "command/requestChat.php";
});

$botman->hears("/help", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";
    
    $bot->reply("/lihat_catatan_tugas_kuliah \n*Untuk Melihat Seluruh Catatan M.K");
    $bot->reply("/cari_catatan [Kode MK] \n*Untuk Melihat Per Catatan M.K");
    $bot->reply("/tambah_catatan_tugas_kuliah \n*Untuk Membuat Catatan M.K");
    $bot->reply("/edit_catatan_tugas_kuliah \n*Untuk Mengedit Catatan M.K");
    $bot->reply("/hapus_catatan_tugas_kuliah \n*Untuk Menghapus Catatan M.K");
});
 
// Command with @ to bot
$botman->hears("/start@Aisyah_Bukan_Bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    $id = $user->getId();

    $bot->reply("Assalamualaikum $firstname ðŸ˜Š (ID:$id_user),\nNama Saya Aisyah Salma. Selamat Datang Di Layanan Sekretaris Pribadi Anda.\n\nKetikkan Perintah /help Untuk Mengetahui Menu Perintah Yang Bisa Saya Kerjakan");
    include "command/requestChat.php";
});

$botman->hears("/help@Aisyah_Bukan_Bot", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";

    $bot->reply("/lihat_catatan_tugas_kuliah@Aisyah_Bukan_Bot \n*Untuk Melihat Catatan M.K");
    $bot->reply("/tambah_catatan_tugas_kuliah@Aisyah_Bukan_Bot \n*Untuk Membuat Catatan M.K");
    $bot->reply("/edit_catatan_tugas_kuliah@Aisyah_Bukan_Bot \n*Untuk Mengedit Catatan M.K");
    $bot->reply("/hapus_catatan_tugas_kuliah@Aisyah_Bukan_Bot \n*Untuk Menghapus Catatan M.K");
});

$botman->hears("hai", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Hai juga");
   
});

 

// command not found
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Maaf, Perintah Ini '$message' Tidak Ada 😐");
});


$botman->listen();