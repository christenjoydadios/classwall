<?php
// Change the password to your own PostgreSQL password
$pdo = new PDO(
    "pgsql:host=localhost;port=5432;dbname=classwall",
    "postgres",
   "classwall123"
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
