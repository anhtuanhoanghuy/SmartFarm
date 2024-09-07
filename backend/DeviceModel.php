<?php
require_once("Database.php");
    class DeviceModel extends Database{
        //Lấy thông tin đăng nhập
        public function getDevice($a) {
            $sql = "SELECT e_Id, devicename FROM device
                    JOIN management ON device.device_id = management.device_id
                    JOIN account ON account.user_id = management.user_id
                    WHERE account.username = ?;";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a]);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } 
        public function deleteDevice($a,$b) {
            $sql = "DELETE FROM management WHERE id IN 
            (SELECT management.id FROM device 
            JOIN management ON device.device_id = management.device_id 
            JOIN account ON account.user_id = management.user_id 
            WHERE account.username = ? AND device.e_Id = ?)";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b]);
            $sql = "SELECT management.id FROM device
                    JOIN management ON device.device_id = management.device_id
                    JOIN account ON account.user_id = management.user_id
                    WHERE account.username = ? AND device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b]);
            if ($result->rowCount() ==  1) {
                return 0;
            } else if ($result->rowCount() ==  0) {
                return 1;
            }
        } 

        public function addDevice($a,$b,$c) {
            $sql = "SELECT management.id FROM device
                    JOIN management ON device.device_id = management.device_id
                    JOIN account ON account.user_id = management.user_id
                    WHERE account.username = ? AND device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$c]);
            if ($result->rowCount() ==  1) {
                return 0;
                // return "Đã tồn tại thiết bị";
            }
            $sql = "SELECT * FROM device WHERE device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$c]);
            if ($result->rowCount() ==  0) {
                // return "Không có thiết bị";
                return 1;
            }
            $sql = "INSERT INTO management (user_id, device_id, devicename)
                    SELECT 
                        user_id, 
                        device_id, 
                        ?
                    FROM 
                        account, device
                    WHERE 
                        account.username = ? 
                        AND device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b,$a,$c]);
            $sql = "SELECT management.id FROM device
                    JOIN management ON device.device_id = management.device_id
                    JOIN account ON account.user_id = management.user_id
                    WHERE account.username = ? AND device.e_Id = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$c]);
            if ($result->rowCount() ==  1) {
                return 2;
                // return "Đã tồn tại thiết bị";
            }

        } 

        public function updateDevice($a,$b,$c) {
            $sql = "UPDATE management
            SET devicename = ?
            WHERE id IN 
            (SELECT management.id FROM device 
            JOIN management ON device.device_id = management.device_id 
            JOIN account ON account.user_id = management.user_id 
            WHERE account.username = ? AND device.e_Id = ?)";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b,$a,$c]);
            $sql = "SELECT management.id FROM device
                    JOIN management ON device.device_id = management.device_id
                    JOIN account ON account.user_id = management.user_id
                    WHERE account.username = ? AND device.e_Id = ? AND management.devicename = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$c,$b]);
            if ($result->rowCount() ==  1) {
                return 3;
                // return "Cập nhật thiết bị thành công";
            }

        } 
    } 

?>