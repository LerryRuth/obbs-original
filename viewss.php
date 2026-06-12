<?php
// Ensure you have the correct file path parameter
if (!isset($_GET['file_path'])) {
    die('File path is missing.');
}

$file_path = $_GET['file_path'];

// Define the uploads directory
$upload_dir = 'uploads/';

// Full path to the file
$full_path = $upload_dir . basename($file_path);

// Check if the file exists and is readable
if (file_exists($full_path) && is_readable($full_path)) {
    // Set the appropriate content type for image files
    $mime_type = mime_content_type($full_path);
    header("Content-Type: $mime_type");
    header("Content-Length: " . filesize($full_path));
    readfile($full_path);
    exit();
} else {
    die('File not found or inaccessible.');
}
?>