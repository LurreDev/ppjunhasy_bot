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
        "token" =>  'API'
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
    Hai Perlu bantun kak $firstname, DM langsung @ppjunhasy, chat nama dan tujuan atau pertanyaan
    ");
    
});


$botman->hears("/menu", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";
    
    $bot->reply("Silahkan pilih dan Klik tanda / untuk melihat infromasi");
    $bot->reply("/alurscan \n*Untuk Melihat Alur scan Plagiasi");
    $bot->reply("/layanansurat\n*Untuk Melihat informasi tentang surat");
    $bot->reply("/infobiaya \n*Untuk Melihat informasi pembayaran");
    $bot->reply("/listjurnalunhasy \n*Untuk Melihat Semua situs jurnal UNHASY");
    $bot->reply("/akunmediasosial \n*Akun Media Sosial PPJ UNHASY");
    // $bot->reply("/quotesday \n*Memberikan motifasi dalam kehidupan");
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
    $bot->reply("Aturan Scan \nBaca di https://bit.ly/PERATURANSCAN");
    $bot->reply("Alur Scan \n
    \n1. sudah Melakukan Registrasi Pembayaran (Mahasiswa/Dosen), jika pengelola JURNAL Unhasy melampirkan Surat Permohonan Scan dan Mengirim FILE DOKUMEN ZIP
    \n2. Format Pengiriman Scan bisa klik /formatscan
    \n3. silahkan dikirim file sesuai dengan format
    \n4. Maksimal SCAN 5x dan masa revisi plagiasi tidak dikenakan biaya
    \n5. Jika Lebih dari 5x scan akan dikenakan biaya tambahan
    \n6. Jika sudah dibawah 20% maka silahkan mengisi link form surat lolos plagiasi klik /layanansurat
    ");
});
 
 

$botman->hears("/layanansurat", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Layanan Persuratan Mahasiswa S1&S2 UNHASY");
     // Create attachment
     $attachment = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/alur_suketpublikas.jpeg");
     // Build message object
     $message = OutgoingMessage::create('Alur Surat Publikasi')
                 ->withAttachment($attachment);
     // Reply message object
    $bot->reply($message);
    $bot->reply("List Link Persuratan Google form");
    $bot->reply("1. Link Surat Reviewer \n👉 https://bit.ly/SuratReviewer_");
    $bot->reply("2. Link Surat Lolos Plagiasi \n👉 https://bit.ly/SuketLolosPlagiasi");
    $bot->reply("3. Link Surat Publikasi \n👉 https://bit.ly/SuketPublikasi");
    $bot->reply("List Persuratan Untuk Dosen");
    $bot->reply("1. Link Surat Permohonan Scan \n👉 https://bit.ly/TemplatePSPJurnal");
    $bot->reply("2. Link Surat Permohonan DOI Jurnal \n👉 https://bit.ly/TemplateaksesDOI");
    $bot->reply("3. Link Surat VALIDASI KARYA ILIMIAH  \n👉 https://bit.ly/FORM_VALIDASI_KARYA_ILMIAH");
    $bot->reply("Jika Informasi yang anda cari tidak ada silahkan HUBUNGI Admin @ppjunhasy");
});
 $botman->hears("/infobiaya", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("INFORMASI BIAYA DAN LINK KONFIRMASI PEMBAYARAN");
    $attachment = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/biayanonunhasy.jpeg");
     $message = OutgoingMessage::create('Untuk Biaya Scan Dosen dan mahasiswa UNHASY')
                 ->withAttachment($attachment);
     $bot->reply($message);

     $attachment2 = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/biayanonunhasy.jpeg");
     $message2 = OutgoingMessage::create('Untuk Biaya Scan Dosen dan mahasiswa Dari Luar UNHASY')
                 ->withAttachment($attachment2);
     $bot->reply($message2);

    $bot->reply("DI BACA DENGAN TELITI SEBELUM MELAKUKAN TRANSFER PEMBAYARAN \n
    Biaya di Transfer \n ke 👉 REK BSI UNHASY 7108073262 n Dan Kirim Bukti tf ke Admin @ppjunhasy
    ");
    $bot->reply("Jika Informasi yang anda cari tidak ada silahkan HUBUNGI Admin @ppjunhasy");
});


$botman->hears("/formatscan", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("FORMAT SCAN");
    $attachment2 = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/formatscan.jpeg");
    $message2 = OutgoingMessage::create('format pengiriman')
                ->withAttachment($attachment2);
    $bot->reply($message2);
});


$botman->hears("/listjurnalunhasy", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Berikut link http://ejournal.unhasy.ac.id/index.php/");
    $bot->reply("untuk mahasiswa S1 UNHASY Jurnal minimal ISSN");
    $bot->reply("untuk mahasiswa S2 UNHASY Jurnal minimal (SINTA)");
});


$botman->hears("/akunmediasosial", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Akun Media Sosial");
    $bot->reply("Youtube \n https://www.youtube.com/channel/UClDmEQJltl9M67DAaHNClMw");
    $bot->reply("Instagram @ppj.unhasy");
});

// $botman->hears("/quotesday", function (Botman $bot) {
//     $user = $bot->getUser();
//     $firstname = $user->getFirstName();
//     $id_user = $user->getId();
//     $bot->reply("Layanan Persuratan Mahasiswa Dan Dosen");
//     $bot->reply("List Link Google form");
// });




// command not found
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Maaf, Jawaba  Perintah Ini '$message' Tidak Ada 😐 Silahan Chat di @ppjunhasy \n atau kembali ke menu /menu");
});



$botman->listen();