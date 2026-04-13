<?php

// print_r($_SERVER['HTTP_HOST']);
// die();

if ($_SERVER['HTTP_HOST'] === 'localhost:8001') {
    define('BASE_URL', 'http://localhost:8001/');
} else {
    define('BASE_URL', 'https://dev.zeeteck.com/projects/fursgo/');
}
