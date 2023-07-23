<?php
// api login sent data Json
header("Access-control-allow-origin: *");
header("content-type: application/json; charset=UTF-8");

//api ทำงานกับ ไฟล์ databaseconnect.php และ user.php
include_once "./../../databaseconnect.php";
include_once "./../../model/room2.php";
 
$databaseConnect = new DatabaseConnect();
$connDB = $databaseConnect->getConnection();
 
$room2 = new Room2($connDB);

//เรียกใช้ฟังก์ชันตามวัตถุประสงค์ของ API ตัวนี้
$stmt = $room2->getAllTempRoom2();

// นับแถวเพื่อดูว่าได้ข้อมูลมาไหม
$numrow = $stmt->rowCount();

//สร้างตัวแปรมาเก็บข้อมูลที่ได้จากการเรีียกใช้ฟังก์ชัน เพื่อส่งกลับไปยังส่วนที่เรียกใช้ API
$room2_arr = array();

//ตรวจสอบผลและส่งกลับไปยังส่วนที่เรียกใช้ API
if($numrow > 0){
    //แปลว่ามีข้อมูล
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $room2_item = array(
            "message" => "1",
            "id" => $id,
            "airValue1" => $airValue1,
            "airValue2" => $airValue2,
            "airValue3" => $airValue3,
            "roomDate" => $roomDate,
            "roomTime" => $roomTime

        );
 
        array_push($room2_arr, $room2_item);
    }

}else{
    //ไม่มีข้อมูล
    $room2_item = array(
        "massage" => "0"
    );
 
    array_push($room2_arr, $room2_item);

}

//คำสั่งจักการข้อมูลให้เป็น JSON เพื่อส่งกลับ
http_response_code(200);
echo json_encode($room2_arr);

