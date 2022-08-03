<?php
header('Content-Type: application/json; charset=utf-8');

try {
    $dbhost = "127.0.0.1";
    $dbname = "";
    $dbuser = "";
    $dbpswd = "";

    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpswd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
} catch (PDOException $error) {
    throw new PDOException($error->getMessage());
}
function CleanedData($data): string
{
    $data = trim($data);
    $data = htmlentities($data, ENT_QUOTES, 'utf-8');
    return stripslashes($data);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ip = CleanedData($_GET['ip'] ?? $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR']);
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        http_response_code(200);
        echo json_encode(["query" => $ip, "status" => "fail", "message" => "invalid query"]);
    } else {
        $query = $db->prepare("SELECT id FROM ip_address WHERE ip_address = :ip");
        $query->execute(array(':ip' => ip2long($ip)));
        $row = $query->fetch(PDO::FETCH_ASSOC);
        http_response_code(200);
        if ($row) {
            echo json_encode(["query" => $ip, "status" => "success", "blocked" => true]);
        } else {
            echo json_encode(["query" => $ip, "status" => "fail", "blocked" => false]);
        }
    }
}
