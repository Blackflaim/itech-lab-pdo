<?php
require_once 'db.php';

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $sql = "SELECT name, date, country 
            FROM film 
            WHERE date BETWEEN :start_date AND :end_date 
            ORDER BY date ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();
    
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode($films);
}
?>