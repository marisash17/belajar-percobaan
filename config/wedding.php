<?php

// Semua isi undangan diatur dari sini. Ganti sesuai data kalian.
return [
    'bride' => [
        'nick'    => 'Go Youn-jung',
        'full'    => 'Go Youn-jung',
        'parents' => 'Putri dari bapak blabla dan ibu blabla',
        'photo'   => 'images/G couple.png', // foto kartu (portrait), contoh: 'images/rina.jpg' (taruh di public/images)
        'face'    => 'images/goyounjung.jpg', // foto bulat kecil (opsional), kalau kosong pakai 'photo'
    ],
    'groom' => [
        'nick'    => 'Kim Seonho',
        'full'    => 'Kim Seonho',
        'parents' => 'putra dari bapak blabla dan ibu blabla',
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
            'place'   => 'KUA Sindang',
            'address' => 'KUA Sindang, Indramayu, Jawa Barat',
            'map'     => 'https://maps.app.goo.gl/SqLkjJcbBjMMvHra8',
        ],
        [
            'title'   => 'Resepsi',
            'time'    => '11.00 – 14.00 WIB',
            'place'   => 'Hotel Swiss-Bellin',
            'address' => 'Hotel Swiss-Belinn Indramayu',
            'map'     => 'https://maps.app.goo.gl/5xwmTScZ1nXVKDQU6',
        ],
    ],

    'gifts' => [
        ['bank' => 'BCA',     'number' => '1234567890', 'name' => 'Goyounjung'],
        ['bank' => 'Mandiri', 'number' => '9876543210', 'name' => 'Kimseonho'],
    ],
    'gift_address' => 'Jl. Merdeka No. 12, Indramayu, Jawa Barat 45211',

    'music' => 'audio/sampai-jadi-debu.mp3', // contoh: 'audio/lagu.mp3' (taruh di public/audio)
];