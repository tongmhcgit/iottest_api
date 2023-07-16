<?php
class Room3{
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
}