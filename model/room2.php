<?php
class Room2{
    //ตัวแปรที่จะใช้ติดต่อกับ Database
    private $conn;

    //ตัวแปรที่จะทำงานคู่กับแต่ละฟิวล์หรือคอลัมน์ในตาราง
    public $id;
    public $airValue1;
    public $airValue2;
    public $airValue3;
    public $roomDate;
    public $roomTime;

    //ตัวแปรที่จะเก็บข้้อมูลใด เผื่อเอาไว้ใช้งานเฉยๆ
    public $message;

    //คอนสตรักเตอร์ที่จะที่คำสั่งที่ใช้ในการติดต่อกับ Database
    public function __construct($db){
        $this->conn = $db;
    }

    //ฟังชันต่างๆ ที่จะทำงานกับ Database ตาม API ที่เราจะสร้างขึ้นมา ซึ้งมีมากน้อยก็แล้วแต่
    //
   //function getAllTempRoom1 ที่ทำงานกับ api_getAllTempRoom2.php
    //วัตถุประสงค์ของฟังก์ชันนี้คือ ไปเอาอุณหภูมิทั้งหมดที่มีในตาราง room1 มา
    function getAllTempRoom2(){
          
        $strSQL = "SELECT * FROM room2_tb" ;

        $stmt = $this ->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;


    }

    //function getAirValue2Room1
    //วัตถุประสงค์ของฟังก์ชันนี้คือ ต้องการอุณหภูทิเฉาะแอร์ตัวที่ 2 ของห้อง Room1
    function getairValue2Room2(){
            
        $strSQL = "SELECT airValue2, roomDate, roomTime FROM room2_tb" ;

        $stmt = $this ->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;


    }

    //function getAllTempLessThan20Room1 ที่ทำงานกับ getAllTempLessThan20Room2.php
    //วัตถุประสงค์ของฟังก์ชันนี้คือ ต้องการอุณหภูของแอร์ทุกตัวตัวที่น้อยกว่า 20 องศา ของห้อง Room2
    function getAllTempLessThan20Room2(){
            
        $strSQL = "SELECT * FROM `room2_tb` WHERE airValue1 < 20 and airValue2 < 20 and airValue3 < 20" ;

        $stmt = $this ->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;


    }



    
}