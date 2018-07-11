<?php

include_once('connectDB.php');
include_once('functions.php');

$pdo = connect();
$hostGetParam = $_SERVER['HTTP_HOST'] . '/?q=';
$msg = '';

if (!empty($_GET['q'])) {
    $short_url = strip_tags(trim($_GET['q']));
    $data = [':url_short' => $short_url];
    if ($result = getUrl($pdo, $data)) {
        header('Location:' . $result['url_real']);
        exit();
    } else {
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $real_url = trim(strip_tags($_POST['url']));
    if (!empty($real_url)) {
        if (!preg_match('/^https?:\/\//', $real_url)) {
            $real_url = 'http://' . $real_url;
        }
        if (@file_get_contents($real_url)) {
            $data = [':url_real' => $real_url];
            $result = getUrl($pdo, $data, true);
            if ($result === false) {
                $data = [':url_real' => $real_url];
                $result = addUrl($pdo, $data);
                $msg = $hostGetParam . $result['url_short'];
            } else {
                $msg = $hostGetParam . $result['url_short'];
            }
        } else {
            $msg = 'Введён несуществующий url';
        }
    } else {
        $msg = 'Введи какой-нибудь url';
    }
    echo $msg;
}
