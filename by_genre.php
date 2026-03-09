<?php
require_once 'db.php';

if (isset($_GET['genre_id'])) {
    $genre_id = $_GET['genre_id'];

    $sql = "SELECT film.name, film.date, film.country 
            FROM film 
            JOIN film_genre ON film.ID_FILM = film_genre.FID_Film 
            WHERE film_genre.FID_Genre = :genre_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':genre_id' => $genre_id]); 
    
    $films = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат</title>
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
    <h2>Результати пошуку:</h2>
    
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
        <p>Фільмів не знайдено.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">Повернутися назад</a>
</body>
</html>
<?php
}
?>