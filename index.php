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
    <title>Лабораторна робота 3</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .forms-wrapper { display: flex; gap: 20px; flex-wrap: wrap; align-items: stretch; }
        form { display: flex; }
        fieldset { display: flex; flex-direction: column; border: 1px solid #999; padding: 15px; width: 300px; box-sizing: border-box; margin: 0; }
        legend { font-weight: bold; }
        select, input[type="date"] { display: block; width: 100%; margin-top: 10px; padding: 5px; box-sizing: border-box; }
        label { display: block; margin-top: 10px; }
        button { margin-top: auto; width: 100%; padding: 8px; cursor: pointer; background: #4CAF50; color: white; border: none;}
        
        #result { margin-top: 30px; padding: 15px; border-top: 2px dashed #ccc; }
        table { border-collapse: collapse; width: 600px; margin-top: 15px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1>Лабораторна робота 3</h1>

    <div class="forms-wrapper">
        
        <form onsubmit="getByGenre(event)">
            <fieldset>
                <legend>Фільми за жанром (HTML)</legend>
                <select id="genre_id" required>
                    <option value="">-- Оберіть жанр --</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['ID_Genre'] ?>"><?= htmlspecialchars($genre['title']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

        <form onsubmit="getByActor(event)">
            <fieldset>
                <legend>Фільми за актором (XML)</legend>
                <select id="actor_id" required>
                    <option value="">-- Оберіть актора --</option>
                    <?php foreach ($actors as $actor): ?>
                        <option value="<?= $actor['ID_Actor'] ?>"><?= htmlspecialchars($actor['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

        <form onsubmit="getByDate(event)">
            <fieldset>
                <legend>За часовим інтервалом (JSON)</legend>
                <label>З: <input type="date" id="start_date" value="2000-01-01" required></label>
                <label>По: <input type="date" id="end_date" value="2020-12-31" required></label>
                <button type="submit">Знайти</button>
            </fieldset>
        </form>

    </div>

    <div id="result">
        
    </div>

    <script>
        function getByGenre(event) {
            event.preventDefault();
            const genreId = document.getElementById('genre_id').value;
            
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "by_genre.php?genre_id=" + genreId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('result').innerHTML = "<h2>Результат (HTML):</h2>" + xhr.responseText;
                }
            };
            xhr.send();
        }

        function getByActor(event) {
            event.preventDefault();
            const actorId = document.getElementById('actor_id').value;
            
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "by_actor.php?actor_id=" + actorId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const xmlDoc = xhr.responseXML;
                    const films = xmlDoc.getElementsByTagName("film");
                    
                    let html = "<h2>Результат (XML):</h2>";
                    if (films.length > 0) {
                        html += "<table><tr><th>Назва фільму</th><th>Дата виходу</th><th>Режисер</th></tr>";
                        for (let i = 0; i < films.length; i++) {
                            let name = films[i].getElementsByTagName("name")[0].textContent;
                            let date = films[i].getElementsByTagName("date")[0].textContent;
                            let director = films[i].getElementsByTagName("director")[0].textContent;
                            html += `<tr><td>${name}</td><td>${date}</td><td>${director}</td></tr>`;
                        }
                        html += "</table>";
                    } else {
                        html += "<p>Фільмів з цим актором не знайдено.</p>";
                    }
                    document.getElementById('result').innerHTML = html;
                }
            };
            xhr.send();
        }

        async function getByDate(event) {
            event.preventDefault();
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            
            const response = await fetch(`by_date.php?start_date=${start}&end_date=${end}`);
            
            const data = await response.json();
            
            let html = "<h2>Результат (JSON + Fetch):</h2>";
            if (data.length > 0) {
                html += "<table><tr><th>Назва фільму</th><th>Дата виходу</th><th>Країна</th></tr>";
                data.forEach(film => {
                    html += `<tr><td>${film.name}</td><td>${film.date}</td><td>${film.country}</td></tr>`;
                });
                html += "</table>";
            } else {
                html += "<p>Фільмів у цей часовий проміжок не знайдено.</p>";
            }
            document.getElementById('result').innerHTML = html;
        }
    </script>
</body>
</html>