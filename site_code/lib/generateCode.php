<?php
	header('Content-Type: text/html; charset=utf-8');

	// Создает случаайную строку из определенных символов
	function generateCode($codeLength = 6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = '';
		$charsLen = strLen($chars) - 1;

		while (strlen($code) < $codeLength) {
			$code .= $chars[mt_rand(0, $charsLen)];
		}
		
		return $code;
	}
?>