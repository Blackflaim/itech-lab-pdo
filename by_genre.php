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
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($films) {
        echo "<table>";
        echo "<tr><th>Назва фільму</th><th>Дата виходу</th><th>Країна</th></tr>";
        foreach ($films as $film) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($film['name']) . "</td>";
            echo "<td>" . htmlspecialchars($film['date']) . "</td>";
            echo "<td>" . htmlspecialchars($film['country']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Фільмів не знайдено.</p>";
    }
}
?>