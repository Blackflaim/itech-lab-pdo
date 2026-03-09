<?php
require_once 'db.php';

if (isset($_GET['actor_id'])) {
    $actor_id = $_GET['actor_id'];

    $sql = "SELECT film.name, film.date, film.director 
            FROM film 
            JOIN film_actor ON film.ID_FILM = film_actor.FID_Film 
            WHERE film_actor.FID_Actor = :actor_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':actor_id' => $actor_id]); 
    
    $films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат - За актором</title>
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
    <h2>Фільми за участю обраного актора:</h2>
    
    <?php if ($films): ?>
        <table>
            <tr>
                <th>Назва фільму</th>
                <th>Дата виходу</th>
                <th>Режисер</th>
            </tr>
            <?php foreach ($films as $film): ?>
                <tr>
                    <td><?= htmlspecialchars($film['name']) ?></td>
                    <td><?= htmlspecialchars($film['date']) ?></td>
                    <td><?= htmlspecialchars($film['director']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Фільмів з цим актором не знайдено.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">Повернутися назад</a>
</body>
</html>
<?php
}
?>