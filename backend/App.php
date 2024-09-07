<?php
    class App{
		// Kiểm tra một xâu ký tự có phải là text hay không
		// Input: $s
		// Điều kiện: Chỉ bao gồm các ký tự tiếng Việt và chữ số, dấu -, dấu trắng
        public static function isText($s) {
			$c1 = preg_match("/^[0-9a-zA-ZáàạảãăắằặẳẵâấầậẩẫđĐéèẹẻẽêếềệểễíìịỉĩóòọỏõôốồộổỗơớờợởỡúùụủũưứừựửữ\s\-]*$/", $s);
			if ($c1 == 1) return true;
			else return false;
		} 
    }
?>