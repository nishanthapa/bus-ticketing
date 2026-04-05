<?php
session_start();
include __DIR__ . "/config.php";

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Just load index.php which already has everything
include __DIR__ . "/index.php";