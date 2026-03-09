<?php
require_once 'db.php';

$stmtGenres = $pdo->query("SELECT ID_Genre, title FROM genre ORDER BY title");
$genres = $stmtGenres->fetchAll();

$stmtActors = $pdo->query("SELECT ID_Actor, name FROM actor ORDER BY name");
$actors = $stmtActors->fetchAll();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота 1</title>
    <style>
        body 
        { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
        }
        
        .forms-wrapper 
        {
            display: flex;
            gap: 20px; 
            flex-wrap: wrap; 
            align-items: stretch;
        }

        form 
        {
            display: flex;
        }

        fieldset 
        { 
            display: flex;
            flex-direction: column;
            border: 1px solid #999; 
            padding: 15px; 
            width: 300px; 
            box-sizing: border-box;
            margin: 0;
        }

        legend 
        { 
            font-weight: bold; 
        }

        select, input[type="date"] 
        {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 5px;
            box-sizing: border-box;
        }

        label 
        {
            display: block;
            margin-top: 10px;
        }

        input[type="date"] 
        {
            margin-top: 5px;
        }

        button {
            margin-top: auto;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Лабораторна робота 1</h1>

    <div class="forms-wrapper">
        
        <form action="by_genre.php" method="GET">
            <fieldset>
                <legend>Фільми за жанром</legend>
                <select name="genre_id" required>
                    <option value="">-- Оберіть жанр --</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['ID_Genre'] ?>"><?= htmlspecialchars($genre['title']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

        <form action="by_actor.php" method="GET">
            <fieldset>
                <legend>Фільми за актором</legend>
                <select name="actor_id" required>
                    <option value="">-- Оберіть актора --</option>
                    <?php foreach ($actors as $actor): ?>
                        <option value="<?= $actor['ID_Actor'] ?>"><?= htmlspecialchars($actor['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

        <form action="by_date.php" method="GET">
            <fieldset>
                <legend>Фільми за часовий інтервал</legend>
                <label>З: <input type="date" name="start_date" value="2000-01-01" required></label>
                <label>По: <input type="date" name="end_date" value="2020-12-31" required></label>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

    </div>

</body>
</html>