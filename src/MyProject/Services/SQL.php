<?php

namespace MyProject\Models\Users;

use MyProject\Services\Db;
use MyProject\Models;

class UserActivationService
{
   //  private const TABLE_NAME = 'users_activation_codes';
	 private TABLE_NAME = 'finder';

	public static function setTableName($Table_Name): void
	{
		self::TABLE_NAME = $Table_Name;
	}

	public static function getTableMaxId(): int
	{
		$db = Db::getInstance();


		$SQL = 'SELECT max(id) FROM ' . static::getTableName() . ';';

		echo $SQL;

		$result = $db->query(
			 $SQL,
			 [],
			 static::class
		)->fetchColumn(0);
		echo "<pre>";
		var_dump($result[0]);
		echo "</pre><hr>";
		print_r($result[0]->max(id));
		print_r($result[0]->max(id));
		return ($result[0]["max(id)"]);



		$db->query(
			 'INSERT INTO ' . self::TABLE_NAME . ' (user_id, code) VALUES (:user_id, :code)',
			 [
				  'user_id' => $user->getId(),
				  'code' => $code
			 ]
		);

		return $code;
	}


    public static function createActivationCode(User $user): string
    {
        // Генерируем случайную последовательность символов, о функциях почитайте в документации
        $code = bin2hex(random_bytes(16));

        $db = Db::getInstance();
        $db->query(
            'INSERT INTO ' . self::TABLE_NAME . ' (user_id, code) VALUES (:user_id, :code)',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return $code;
    }

    public static function checkActivationCode(User $user, string $code): bool
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM ' . self::TABLE_NAME . ' WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );
        return !empty($result);
    }


    // "Здесь удаление кода активации после его использования";
    // 19
    // d7d2ed693bc2b803fdee65c0ee458fb7
    public static function deleteActivationCode(User $user, string $code): bool
    {

        $db = Db::getInstance();
        echo "Здесь удаление кода активации после его использования";
        $result = $db->query(
            'DELETE FROM ' . self::TABLE_NAME . ' WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return !empty($result);
    }
}