<?php

// print_r($_SERVER['HTTP_HOST']);
// die();

if ($_SERVER['HTTP_HOST'] === 'localhost:8000') {
    define('BASE_URL', 'http://localhost:8000/');
} else {
    define('BASE_URL', 'https://dev.zeeteck.com/projects/fursgo_old/');
}

// Free CARTO basemap key — remove "API KEY REQUIRED" watermark on tiles
if (!defined('CARTO_API_KEY')) {
    define('CARTO_API_KEY', 'cb1_3thf_1_9c6fa439263b43393f09202a');
}

