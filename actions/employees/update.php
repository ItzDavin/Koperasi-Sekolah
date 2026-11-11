<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  try {
    $pdo->beginTransaction();
    $request = getEmployeeRequest($_POST);
    $errors = validateEmployee($request, $request['id']);
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old'] = $request;
      header('Location: ../../pages/employees/edit.php' . '?id=' . urlencode($request['id']));
      exit;
    }
    $query = "update employees set employee_number = :employee_number, full_name = :full_name, gender = :gender, birth_date = :birth_date, position = :position, salary = :salary where employee_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      'employee_number' => $request['employee_number'],
      'full_name' => $request['full_name'],
      'gender' => $request['gender'],
      'birth_date' => $request['birth_date'],
      'position' => $request['position'],
      'salary' => $request['salary'],
      'id' => $request['id']
    ]);
    $pdo->commit();
    header('Location: ../../pages/employees/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}
?>