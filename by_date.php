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
    
    $films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат - За датою</title>
    <style>
        body 
        { 
            font-family: Arial, sans-serif; margin: 20px; 
        }
        table 
        { 
            border-collapse: collapse; width: 600px; margin-top: 15px; 
        }
        th, td 
        { 
            border: 1px solid black; padding: 8px; text-align: left; 
        }
        th 
        { 
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>
    <h2>Фільми, що вийшли з <?= htmlspecialchars($start_date) ?> по <?= htmlspecialchars($end_date) ?>:</h2>
    
    <?php if ($films): ?>
        <table>
            <tr>
                <th>Назва фільму</th>
                <th>Дата виходу</th>
                <th>Країна</th>
            </tr>
            <?php foreach ($films as $film): ?>
                <tr>
                    <td><?= htmlspecialchars($film['name']) ?></td>
                    <td><?= htmlspecialchars($film['date']) ?></td>
                    <td><?= htmlspecialchars($film['country']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Фільмів у цей часовий проміжок не знайдено.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">Повернутися назад</a>
</body>
</html>
<?php
}
?>