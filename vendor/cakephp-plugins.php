<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'Authentication' => $baseDir . '/vendor/cakephp/authentication/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Cake/TwigView' => $baseDir . '/vendor/cakephp/twig-view/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'MeTools' => $baseDir . '/vendor/mirko-pagliai/me-tools/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Muffin/Trash' => $baseDir . '/vendor/muffin/trash/',
        'Thumber/Cake' => $baseDir . '/vendor/mirko-pagliai/cakephp-thumber/',
    ],
];
