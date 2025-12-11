<?php
// FILE: admin/quanlynguoidung/export_users.php

// 1. Cấu hình Headers TẢI XUỐNG FILE TXT
header('Content-Encoding: UTF-8');
header('Content-type: text/plain; charset=UTF-8');
header('Content-Disposition: attachment; filename="danh_sach_nguoi_dung_' . date('Ymd_His') . '.txt"');

// 2. Thông tin kết nối Database
include('../connect.php'); // Dùng file connect.php đã có

// 3. Kết nối Database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Lỗi kết nối CSDL khi xuất file."); }

// 4. Thực thi truy vấn SELECT
$sql = "SELECT ID, HoTen, SĐT, NamSinh, DiaChi, ChuongTrinh, QuocGia, GhiChu, created_at FROM user";
$result = $conn->query($sql);

// 5. Chuẩn bị nội dung file TXT
$output_content = "ID_Dinh_Dang\tHo Ten\tSĐT\tNăm Sinh\tĐịa Chỉ\tChương Trình\tQuốc Gia\tGhi Chú\n"; 

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Logic xử lý ID (Dùng cột created_at)
        $timestamp = strtotime($row['created_at']); 
        $formatted_time = date('y/m/d_H/i/s', $timestamp);
        $display_id = $formatted_time . '_' . $row['ID']; 

        // Dùng tab (\t) để phân tách dữ liệu
        $line = $display_id . "\t" . 
                $row['HoTen'] . "\t" . 
                $row['SĐT'] . "\t" . 
                $row['NamSinh'] . "\t" . 
                $row['DiaChi'] . "\t" . 
                $row['ChuongTrinh'] . "\t" . 
                $row['QuocGia'] . "\t" . 
                ($row['GhiChu'] ?? '-') . "\n";

        $output_content .= $line;
    }
}

// 6. Xuất nội dung và đóng kết nối
echo "\xEF\xBB\xBF"; // UTF-8 BOM cho tiếng Việt
echo $output_content;
$conn->close();
exit;
?>