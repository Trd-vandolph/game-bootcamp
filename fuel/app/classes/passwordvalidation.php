<?php
class PasswordValidation
{

	public static function _validation_password($data)
	{
		if(!empty($data)) {
			if (preg_match('/(?=.*\d+.*)(?=.*[a-zA-Z]+.*)+.*/', $data)) {
				return true;
			}
			else {
				return false;
			}
		}
		return true;
	}
}