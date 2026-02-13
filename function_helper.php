<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', 'http://localhost/fursgo/');
} else {
    define('BASE_URL', 'https://dev.zeeteck.com/projects/fursgo/');
}
