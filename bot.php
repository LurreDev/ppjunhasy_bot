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
    $bot->reply("/tutorialojs \n*Tutorial Pengelola OJS Jurnal UNHASY");

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
    \n2. Format Pengiriman Scan bisa tekan /formatscan
    \n3. silahkan dikirim file sesuai dengan format
    \n4. Maksimal SCAN 5x dan masa revisi plagiasi tidak dikenakan biaya
    \n5. Jika Lebih dari 5x scan akan dikenakan biaya tambahan
    \n6. Jika sudah dibawah 20% maka silahkan mengisi link form surat lolos plagiasi di  /layanansurat
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
    $attachment = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/biayaunhasy.jpeg");
     $message = OutgoingMessage::create('Untuk Biaya Scan Dosen dan mahasiswa UNHASY')
                 ->withAttachment($attachment);
     $bot->reply($message);

     $attachment2 = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/biayanonunhasy.jpeg");
     $message2 = OutgoingMessage::create('Untuk Biaya Scan Dosen dan mahasiswa Dari Luar UNHASY')
                 ->withAttachment($attachment2);
     $bot->reply($message2);

    $bot->reply("DI BACA DENGAN TELITI SEBELUM MELAKUKAN TRANSFER PEMBAYARAN \n
    Biaya di Transfer \n ke 👉 REK BSI UNHASY 7108073262 n Dan Kirim Bukti tf ke Admin @ppjunhasy dan \n di upload di https://bit.ly/KonfirmasiPembayaranPlagiasi
    ");
    $bot->reply("Jika Informasi yang anda cari tidak ada silahkan HUBUNGI Admin @ppjunhasy");
});


$botman->hears("/formatscan", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("FORMAT SCAN");
    $attachment2 = new Image("https://demo.solusiskripsi.my.id/ppjunhasy_bot/images/formatscan.jpeg");
    $message2 = OutgoingMessage::create('Dikirim Ke @ppjunhasy')
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


$botman->hears("/tutorialojs", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Berikut link Tutorial OJS Untuk Pengelola Jurnal");
    $bot->reply("1. Modifikasi Bar Atas (Navigation Menu) \n
    https://drive.google.com/file/d/152izPkgxO8DuPAzws8m2lIryF59CFQHo/view?usp=sharing 
    ");
    $bot->reply("2. Modifikasi Bar Bawah (Footer dan Memasang Flag Counter)* \n
    https://drive.google.com/file/d/1Bu8kid3vvge11VUmdLGMaba7GCRutjJW/view?usp=sharing ");
    $bot->reply("3. Modifikasi Side Bar (Custom Block Manager dan Static Page)* \n
    https://drive.google.com/file/d/1Ke2OVROrIR3MoMV25lI-2apzEUOjsB8_/view?usp=sharing "); 
    $bot->reply("4. User Profile* \n
    https://drive.google.com/file/d/1PsPzHIoM4uzbpVv5WQj-qgfKdANO_wh2/view?usp=sharing");
    $bot->reply("5. Menu Submission* \n
    https://drive.google.com/file/d/1cQEV0sYCjkgTUW4fIMTiOkGhmjX6pHcP/view?usp=sharing");
    $bot->reply("6. Menu Issue* \n
    https://drive.google.com/file/d/1crYQFIOnNVLzXY-OjZ6iJXb1lrJR1Kr5/view?usp=sharing"); 
    $bot->reply("7. Menu Setting > Journal* \n
    https://drive.google.com/file/d/1PmHBOtjRCFtSt1FPKQSQdvScPIB5TSjs/view?usp=sharing");
    $bot->reply("8. Menu Setting > Website > Appearance* \n
    https://drive.google.com/file/d/1GAbEWEU_pHT-dERsjIybQxp-hqhQb5Hi/view?usp=sharing");
    $bot->reply("9. Menu Setting > Website > Information - Plugin - Static Page* \n
    https://drive.google.com/file/d/1GOzwz5B5aU2ZGHNRPc9ESl2rCM__YrlY/view?usp=sharing");
    $bot->reply("10. Membuat Announcement OJS 3* \n
    https://drive.google.com/file/d/195FSNtuSvLCbe1PlcWMmP65JbYRnpkZz/view?usp=sharing");
    $bot->reply("11. Setting > Workflow > Component* \n
    https://drive.google.com/file/d/17AeHT5BZbnk4ED4jj4TAlmjMUqi6vBBJ/view?usp=sharing"); 
    $bot->reply("12. Setting > Workflow > Submission* \n
    https://drive.google.com/file/d/1j6GA7Rml7WqTWyftPU5triiZ8pewjK_H/view?usp=sharing");
    $bot->reply("13. Setting > Workflow > Review* \n
    https://drive.google.com/file/d/1d3lZM-Z7P1WJPbuI7t0Set29XLCWOm96/view?usp=sharing");
    $bot->reply("14. Setting > Workflow > Review Form* \n
    https://drive.google.com/file/d/1-4ZxwbA-6mvXYUNdxKuD6pdQO4CjoQ0c/view?usp=sharing"); 
    $bot->reply("15. Setting > Workflow > Publisher Library dan Emails* \n
    https://drive.google.com/file/d/14Soc1Fyh2sWfiDoLoHdL8SSq50E3eSuQ/view?usp=sharing");
    $bot->reply("16. Setting > Distribution dan OAI* \n
    https://drive.google.com/file/d/101zh7HtokI6XXEqacD_betB2OgDapRMQ/view?usp=sharing");
    $bot->reply("17. Menu Users dan Cara Daftar Akun Editorial (Misal Reviewer)* \n
    https://drive.google.com/file/d/1fGI2SG4_CeQgFLKJv_rsxnkJZ-L906Kl/view?usp=sharing");
    $bot->reply("18. Menu Roles dan Site Access Option* \n
    https://drive.google.com/file/d/1vQPQGyMbqn9bGjfwGJw503w0cdHJ5_rG/view?usp=sharing");
    $bot->reply("19. Tools dan Download Statistik Penggunaan* \n
    https://drive.google.com/file/d/1v58rDxHDRKT95yooDkZdvrbH8W_DRR8M/view?usp=sharing");
    $bot->reply("Cara Setting DOI");
    $bot->reply("20. Setting DOI, Prefix, Suffix:* \n
    https://drive.google.com/file/d/1PLjSDKQS69soVc31SKjjZQrVFbS15yTj/view?usp=sharing");
    $bot->reply("21. Menampilkan Nomor DOI Artikel di Web Jurnal:* \n
    https://drive.google.com/file/d/1uOqlOj4RjuxeSA9gGa6BEIRFBifKH3l5/view?usp=sharing");
    $bot->reply("22. Mengaktifkan nomor DOI artikel:* \n
    https://drive.google.com/file/d/1iB61QtuvrQHh3BdciMvw2DiMkB0NPVSh/view?usp=sharing");
    $bot->reply("23. Mengaktifkan nomor DOI banyak artikel secara bersamaan:* \n
    https://drive.google.com/file/d/1UzzNG0klGGc2_EFo5WgpEW2fkEqMA5NN/view?usp=sharing");
    $bot->reply("24. Mendaftarkan DOI Jurnal:* \n
    https://drive.google.com/file/d/1G61x5bsP4JnWQeEixbyd351qy-NV1FgX/view?usp=sharing");
    $bot->reply("25. Membuat Nomor DOI Secara Manual dalam Naskah:* \n
    https://drive.google.com/file/d/1MFTz0SM68lDeoBBz3tlkI7TAtC8KXpkO/view?usp=sharing");
    $bot->reply("Cara Upload Artikel dan Publish Issue");
    $bot->reply("26. Upload Artikel via Quick Submit Plugin dan Publish Issue \n
    https://drive.google.com/file/d/1om1n7i3Eb2yYo0m-uKqESQMVICDSUkb3/view?usp=sharing");
    $bot->reply("Proses Penerbitan Artikel via Editorial Workflow (standar publikasi jurnal online):"); 
    $bot->reply("27. Submit dan Tugas Editor Tahap 1:* \n
    https://drive.google.com/file/d/1lA3xS3UR3VLeOrsg8fKpXlwdehOTusEJ/view?usp=sharing");
    $bot->reply("28. Tugas Section Editor Tahap 1:* \n
    https://drive.google.com/file/d/1Hgu0efJp8aE4U7iBBCzyEox5YTt3EujG/view?usp=sharing");
    $bot->reply("29. Tugas Reviewer* \n
    https://drive.google.com/file/d/1jNFch23rk9JJMyFt5gP6YzY5Xwf0e7_K/view?usp=sharing");
    $bot->reply("30. Tugas Section Editor Tahap 2: \n
    https://drive.google.com/file/d/1n9zIsO4J1Mf_JymSgGCSAUCy4dy7SnOp/view?usp=sharing");
});

$botman->hears("/akunmediasosial", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $bot->reply("Akun Media Sosial");
    $bot->reply("Youtube \n https://www.youtube.com/channel/UClDmEQJltl9M67DAaHNClMw");
    $bot->reply("Instagram @ppj.unhasy");
});




// command not found
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Maaf, Jawaba  Perintah Ini '$message' Tidak Ada 😐 Silahan Chat di @ppjunhasy \n atau kembali ke menu /menu");
});


$botman->listen();