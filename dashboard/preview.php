<?php
session_start();

if (!isset($_SESSION["preview"])) {
    die("No file specified for preview.");
}

$file = $_SESSION["preview"];
$filePath = 'F:/xampp/htdocs/kriptografi-aes/dashboard/file_encrypt/' . $file;

if (!file_exists($filePath)) {
    die("File not found.");
}

$mimeType = mime_content_type($filePath);
if ($mimeType === false) {
    $mimeType = "application/octet-stream";
}

header("Content-Disposition: inline; filename=\"" . basename($filePath) . "\"");
header("Content-Type: $mimeType");
header("Content-Length: " . filesize($filePath));
header("Connection: close");

readfile($filePath);

unset($_SESSION["preview"]);
exit;
?>
