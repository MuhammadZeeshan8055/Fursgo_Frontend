<?php

// print_r($_SERVER['HTTP_HOST']);
// die();

if ($_SERVER['HTTP_HOST'] === 'localhost:8000') {
    define('BASE_URL', 'http://localhost:8000/');
} else {
    define('BASE_URL', 'https://dev.zeeteck.com/projects/fursgo_old/');
}
