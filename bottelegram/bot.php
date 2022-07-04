<?php
usleep(mt_rand(100, 10000));
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

require_once 'vendor/autoload.php';
require_once 'database/configDB.php';

$configs = [
    "telegram" => [
        "token" => file_get_contents("private/token.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs); 
// Keyboard


// Command no @ to bot
$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $bot->reply("Selamat Datang $firstname $lastname (ID:$id_user), pada Bot MBKM SPI 4.\n \nKetikkan /help untuk mengetahui perintah yang terdapat pada Bot \n\nRespond Time : $waktu");
    include "command/requestChat.php";
});

$botman->hears("/help", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $bot->reply("1. /DataPresensi : Untuk melihat data presensi \n\n2. /DataCovid : Untuk melihat data laporan Covid-19 \n\n3. /DataPenyintas : Untuk melihat data penyintas Covid-19 \n\n4. /Saran : Untuk melihat saran \n\n5. /PelaporanCovid : Untuk melaporkan kasus Covid-19 \n\n6. /PelaporanPenyintas : Untuk melaporkan penyintas Covid-19 \n\nRespond Time : $waktu");

});

$botman->hears("/Saran", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/Saran.php";
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $message = "https://bit.ly/MBKMSPI4Saran \n\nRespond Time : $waktu";
    $bot->reply($message);

});

$botman->hears("/DataPenyintas", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotPenyintas.php";
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $message = "https://bit.ly/MBKMSPI4Penyintas \n\nRespond Time : $waktu";
    $bot->reply($message);

});

$botman->hears("/DataCovid", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotPelaporan.php";
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $message = "https://bit.ly/MBKMSPI4Laporan \n\nRespond Time : $waktu";
    $bot->reply($message);

});

$botman->hears("/DataPresensi", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotAbsensi.php";
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    $message = "https://bit.ly/PresensiMBKMSPI4 \n\nRespond Time : $waktu";
    $bot->reply($message);

});


$botman->hears("/PelaporanCovid", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    include "command/requestChat.php";
    $bot->reply("Format pelaporan kasus Covid-19 :\n\n/LaporCovid Nama Lengkap-Jurusan-Nim-Nomor HP-Tanggal Terinfeksi (Bln/Tgl/Tahun)-Alamat \n\nRespond Time : $waktu");
});

$botman->hears("/LaporCovid {nama}-{jurusan}-{nim}-{nomor}-{tanggal}-{alamat}", function (Botman $bot, $nama, $jurusan, $nim, $nomor, $tanggal, $alamat) {
    $user = $bot->getUser();
    $id_user = $user->getId();
    $nama = $nama;
    $jurusan = $jurusan;
    $nim = $nim;
    $nomor = $nomor;
    $tanggal = $tanggal;
    $alamat = $alamat;
    include "command/requestChat.php";
    include "command/insertDataLaporan.php";
    $message = insertDataLaporan($nama, $jurusan, $nim, $nomor ,$tanggal, $alamat);
    $bot->reply($message);

});

$botman->hears("/PelaporanPenyintas", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    $waktu = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    include "command/requestChat.php";
    $bot->reply("Format pelaporan penyintas Covid-19 :\n\n/LaporPenyintas Nama Lengkap-Nomor HP-Tanggal Sembuh (Bln/Tgl/Tahun)-Alamat \n\nRespond Time : $waktu");
});

$botman->hears("/LaporPenyintas {nama}-{nomor}-{tanggal}-{alamat}", function (Botman $bot, $nama, $nomor,$tanggal, $alamat) {
    $user = $bot->getUser();
    $id_user = $user->getId();
    $nama = $nama;
    $nomor = $nomor;
    $tanggal = $tanggal;
    $alamat = $alamat;
    
    include "command/requestChat.php";
    include "command/insertDataPenyintas.php";

    $message = insertDataPenyintas($nama, $nomor, $tanggal, $alamat);
    $bot->reply($message);

});

// ------------------------------------------------------------pembatas---------------------------------------------------------- 
// @

$botman->hears("/start@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();

    $bot->reply("Selamat Datang $firstname $lastname (ID:$id_user), pada Bot MBKM SPI 4.\n \nKetikkan /help untuk mengetahui perintah yang terdapat pada Bot");
    include "command/requestChat.php";
});

$botman->hears("/help@mbkmspi4_bot", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";

    $bot->reply("1. /DataPresensi : Untuk melihat data presensi \n\n2. /DataCovid : Untuk melihat data laporan Covid-19 \n\n3. /DataPenyintas : Untuk melihat data penyintas Covid-19 \n\n4. /Saran : Untuk melihat saran \n\n5. /PelaporanCovid : Untuk melaporkan kasus Covid-19 \n\n6. /PelaporanPenyintas : Untuk melaporkan penyintas Covid-19 ");

});

$botman->hears("/Saran@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/Saran.php";
    $message = "https://bit.ly/MBKMSPI4Saran";
    $bot->reply($message);

});

$botman->hears("/DataPenyintas@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotPenyintas.php";
    $message = "https://bit.ly/MBKMSPI4Penyintas";
    $bot->reply($message);

});

$botman->hears("/DataCovid@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotPelaporan.php";
    $message = "https://bit.ly/MBKMSPI4Laporan";
    $bot->reply($message);

});

$botman->hears("/DataPresensi@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    include "command/BotAbsensi.php";
    $message = "https://bit.ly/AbsensiMBKMSPI4";
    $bot->reply($message);

});


$botman->hears("/PelaporanCovid@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan kasus Covid-19 :\n\n/LaporCovid Nama Lengkap-Jurusan-Nim-Nomor HP-Tanggal Terinfeksi (Bln/Tgl/Tahun)-Alamat\n");
});


$botman->hears("/PelaporanPenyintas@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan penyintas Covid-19 :\n\n/LaporPenyintas Nama Lengkap-Nomor HP-Tanggal Sembuh (Bln/Tgl/Tahun)-Alamat");
});

// command not found

$botman->listen();