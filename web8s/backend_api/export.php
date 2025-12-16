<?php
// 1. Cấu hình Headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET');

date_default_timezone_set('Asia/Ho_Chi_Minh'); 

// 2. Thông tin kết nối Database
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "db_nhanluc";
$table_name = "user";

// 3. Kết nối Database
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4"); 

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(array("message" => "Lỗi kết nối Database.", "status" => false)));
}

// 4. Thực thi truy vấn SELECT
$sql = "SELECT id, ngay_nhan, ho_ten, sdt, nam_sinh, dia_chi, chuong_trinh, quoc_gia, ghi_chu FROM $table_name ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    
    // Header chuẩn như trong ảnh
    $txt_content = "|ID|NGÀY NHẬN|HỌ TÊN|SĐT|NĂM SINH| ĐỊA CHỈ|CHƯƠNG TRÌNH|QUỐC GIA | GHI CHÚ|\n";

    while ($row = $result->fetch_assoc()) {
        // Làm sạch dữ liệu: bỏ xuống dòng, tab để không làm vỡ cấu hình hàng
        foreach ($row as $key => $value) {
            $row[$key] = str_replace(["\n", "\r", "\t"], ' ', $value ?? '');
        }

        // Tạo dòng dữ liệu sát nhau, ngăn cách bởi dấu |
        $line = "|" . $row['id'] . 
                "| " . $row['ngay_nhan'] . 
                "|" . $row['ho_ten'] . 
                "| " . $row['sdt'] . 
                "|" . $row['nam_sinh'] . 
                "| " . $row['dia_chi'] . 
                "|" . $row['chuong_trinh'] . 
                "|" . $row['quoc_gia'] . 
                "| " . $row['ghi_chu'] . "|";
        
        $txt_content .= $line . "\n";
    }

    // 5. Lưu nội dung vào file
    $file_name = 'user_export_' . date('Ymd_His') . '.txt';
    $export_dir = __DIR__ . '/exports/';
    
    if (!is_dir($export_dir)) {
        mkdir($export_dir, 0777, true);
    }

    $file_path = $export_dir . $file_name;

    // Ghi dữ liệu với BOM UTF-8 để đọc được tiếng Việt trên Notepad
    $success = file_put_contents($file_path, "\xEF\xBB\xBF" . $txt_content); 

    if ($success) {
        http_response_code(200);
        echo json_encode(array(
            "message" => "Xuất file thành công!", 
            "status" => true, 
            "file_url" => "backend_api/exports/" . $file_name
        ));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Lỗi ghi file.", "status" => false));
    }

} else {
    http_response_code(200);
    echo json_encode(array("message" => "Không có dữ liệu để xuất.", "status" => true));
}

$conn->close();
?>