<?php
require_once __DIR__ . "/../config/database.php";

function isEmailTaken($email)
{
  global $pdo;

  $query = "select count(user_id) from users
              where email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['email' => $email]);

  return $stmt->fetchColumn() > 0;
}

function getUserByEmail($email)
{
  global $pdo;

  $query = "select * from users where email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['email' => $email]);

  return $stmt->fetch();
}
?>