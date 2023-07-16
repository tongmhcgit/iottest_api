<?php
// api login sent data Json
header("Access-control-allow-origin: *");
header("content-type: application/json; charset=UTF-8");

//api ทำงานกับ ไฟล์ databaseconnect.php และ user.php
include_once "./../../databaseconnect.php";
include_once "./../../model/user.php";
 
$databaseConnect = new DatabaseConnect();
$connDB = $databaseConnect->getConnection();
 
$user = new User($connDB);

//สร้างตัวแปรเก็บค่าของข้อมูลที่ส่งมาซึ่งเป็น JSON ที่ทำการ decode แล้ว
$data = json_decode(file_get_contents("php://input"));
//เอาข้อมูลที่ถูก decode ไปเก็บในตัวแปร
$user->userName = $data ->userName;
$user->userPassword = $data ->userPassword;

//เรียกใช้ฟังก์ชันตามวัตถุประสงค์ของ API ตัวนี้
$stmt = $user->loginUser();

// นับแถวเพื่อดูว่าได้ข้อมูลมาไหม
$numrow = $stmt->rowCount();

//สร้างตัวแปรมาเก็บข้อมูลที่ได้จากการเรีียกใช้ฟังก์ชัน เพื่อส่งกลับไปยังส่วนที่เรียกใช้ API
$user_arr = array();

//ตรวจสอบผลและส่งกลับไปยังส่วนที่เรียกใช้ API
if($numrow > 0){
    //แปลว่ามีข้อมูล
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
            "message" => "1",
            "userId" => $userId,
            "userFullname" => $userFullname
        );
 
        array_push($user_arr, $user_item);
    }

}else{
    //ไม่มีข้อมูล
    $user_item = array(
        "massage" => "0"
    );
 
    array_push($user_arr, $user_item);

}

//คำสั่งจักการข้อมูลให้เป็น JSON เพื่อส่งกลับ
http_response_code(200);
echo json_encode($user_arr);

