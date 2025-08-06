<?php
// ตั้งค่า header ให้รับได้ทุกเครื่อง
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

// ตรวจสอบว่าเป็น method POST และมีไฟล์แนบ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo json_encode(["status" => "success", "message" => "Upload สำเร็จ", "url" => $target_file]);
    } else {
        echo json_encode(["status" => "error", "message" => "ไม่สามารถย้ายไฟล์ได้"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ไม่พบไฟล์ที่อัปโหลด"]);
}
?>
