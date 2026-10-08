<?php

// Semua isi undangan diatur dari sini. Ganti sesuai data kalian.
return [
    'bride' => [
        'nick'    => 'Rina',
        'full'    => 'Rina Aulia Putri',
        'parents' => 'Putri dari Bapak Hendra & Ibu Siti',
        'photo'   => 'images/G couple.png', // foto kartu (portrait), contoh: 'images/rina.jpg' (taruh di public/images)
        'face'    => 'images/goyounjung.jpg', // foto bulat kecil (opsional), kalau kosong pakai 'photo'
    ],
    'groom' => [
        'nick'    => 'Dimas',
        'full'    => 'Dimas Pratama, S.T.',
        'parents' => 'Putra dari Bapak Agus & Ibu Lestari',
        'photo'   => 'images/K couple.png', // contoh: 'images/dimas.jpg'
        'face'    => 'images/kim seonho.jpg',
    ],

    'date' => '2026-12-12 08:00:00', // waktu WIB
    'quote' => 'Di antara tanda-tanda kebesaran-Nya, Dia menciptakan pasangan untukmu dari jenismu sendiri agar kamu merasa tenteram, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
    'quote_src' => 'QS. Ar-Rum: 21',

    'events' => [
        [
            'title'   => 'Akad Nikah',
            'time'    => '08.00 – 10.00 WIB',
            'place'   => 'Masjid Al-Ikhlas',
            'address' => 'Jl. Merdeka No. 12, Indramayu, Jawa Barat',
            'map'     => 'https://maps.google.com/?q=Indramayu',
        ],
        [
            'title'   => 'Resepsi',
            'time'    => '11.00 – 14.00 WIB',
            'place'   => 'Gedung Serbaguna Mawar',
            'address' => 'Jl. Jenderal Sudirman No. 45, Indramayu, Jawa Barat',
            'map'     => 'https://maps.google.com/?q=Indramayu',
        ],
    ],

    'gifts' => [
        ['bank' => 'BCA',     'number' => '1234567890', 'name' => 'Rina Aulia Putri'],
        ['bank' => 'Mandiri', 'number' => '9876543210', 'name' => 'Dimas Pratama'],
    ],
    'gift_address' => 'Jl. Merdeka No. 12, Indramayu, Jawa Barat 45211',

    'music' => null, // contoh: 'audio/lagu.mp3' (taruh di public/audio)
];