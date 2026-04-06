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
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/xml; charset=utf-8');
    
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<films>';
    
    foreach ($films as $film) {
        echo '<film>';
        echo '<name>' . htmlspecialchars($film['name']) . '</name>';
        echo '<date>' . htmlspecialchars($film['date']) . '</date>';
        echo '<director>' . htmlspecialchars($film['director']) . '</director>';
        echo '</film>';
    }
    
    echo '</films>';
}
?>