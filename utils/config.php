<?php

// db configs
$host = getenv('DB_HOST') ?: '127.0.0.1'; // localhost
$user = getenv('DB_USER') ?: 'root';
$pwd = getenv('DB_PASSWORD') ?: 'root';
$db = getenv('DB_NAME') ?: 'gp';
