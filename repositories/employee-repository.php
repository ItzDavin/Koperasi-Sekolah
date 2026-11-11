<?php
require_once __DIR__ . "/../config/database.php";

function getEmployees()
{
  global $pdo;
  $query = "select * from employees order by employee_id";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getEmployee($id)
{
  global $pdo;
  $query = "select * from employees where employee_id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);
  $employee = $stmt->fetch();
  if (!$employee) {
    header("Location: ../employees/index.php");
    exit;
  }
  return $employee;
}

function isEmployeeNumberTaken($number, $ignoreId = 0)
{
  global $pdo;
  $query = "select count(employee_id) from employees where employee_number = :number and employee_id != :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['number' => $number, 'id' => intval($ignoreId)]);
  return $stmt->fetchColumn() > 0;
}
?>