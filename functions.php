<?php
/*
 * Create a random string
 */
function randomStr()
{
    $arr = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
        'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y',
        'z', 'A', 'B', 'C', 'D', 'E', 'G', 'H', 'I', 'J', 'K', 'L',
        'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y',
        'Z', 'F', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
    ];

    $str = '';
    for ($i = 0; $i < 4; $i++) {
        $random = rand(0, count($arr) - 1);
        $str .= $arr[$random];
    }
    return $str;
}
/*
 * Add a url and a short url in database
 */
function addUrl($pdo, $data)
{
    do {
        $short_url = [':url_short' => randomStr()];
        $result = getUrl($pdo, $short_url);
    } while ($result['url_short']);

    $data = array_merge($data, $short_url);
    $sql = 'INSERT INTO urls (url_real, url_short) VALUES (:url_real, :url_short)';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    array_shift($data);
    return getUrl($pdo, $data);
}
/*
 * Query in the database
 */
function getUrl($pdo, $data, $realUrl = false)
{
    if ($realUrl) {
        $sql = 'SELECT * FROM urls WHERE url_real = :url_real';
    } else {
        $sql = 'SELECT * FROM urls WHERE url_short = :url_short';
    }
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}