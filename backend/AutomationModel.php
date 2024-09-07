<?php
require_once("Database.php");
    class AutomationModel extends Database{
        //Lấy thông tin đăng nhập
        public function getTimer($e_Id) {
            $sql = "SELECT automation.*,device.e_Id FROM automation INNER JOIN device ON device.device_id=automation.device_id WHERE device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$e_Id]);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } 

        public function updateTimer($e_Id, $machine, $timer_data, $timer_status) {
            $timer_status_machine = $machine."_status";
            $sql = "UPDATE automation
            SET $machine = ?, $timer_status_machine = ? WHERE automation.device_id IN (SELECT automation.device_id FROM automation INNER JOIN device ON device.device_id=automation.device_id WHERE device.e_Id = ?)";
            $result = $this ->conn->prepare($sql);
            $result->execute([$timer_data,$timer_status, $e_Id]);
            $sql = "SELECT automation.*,device.e_Id FROM automation INNER JOIN device ON device.device_id=automation.device_id WHERE device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$e_Id]);
            if ($result->rowCount() ==  1) {
                return 1;
                // return "Cập nhật thiết bị thành công";
            } else {
                return 0;
            }
        } 
    } 

?>