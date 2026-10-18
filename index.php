<?php
$svoris = is_string($_GET['svoris'] ?? null) ? $_GET['svoris'] : '';
$ugis = is_string($_GET['ugis'] ?? null) ? $_GET['ugis'] : '';
function escape(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KMI skaičiuoklė</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="card">
    <p class="eyebrow">Kūno masės indeksas</p>
    <h1>KMI skaičiuoklė</h1>
    <p class="intro">Įveskite savo svorį ir ūgį, kad sužinotumėte kūno masės indeksą.</p>
    <form action="rezultatas.php" method="post">
        <label for="svoris">Svoris (kg)</label>
        <input id="svoris" name="svoris" type="number" min="0.1" max="1000" step="0.1" inputmode="decimal" placeholder="Pvz., 70" value="<?= escape($svoris) ?>" required>
        <label for="ugis">Ūgis (cm)</label>
        <input id="ugis" name="ugis" type="number" min="1" max="300" step="0.1" inputmode="decimal" placeholder="Pvz., 175" value="<?= escape($ugis) ?>" required>
        <button type="submit">Skaičiuoti KMI <span aria-hidden="true">→</span></button>
    </form>
    <p class="note">Skirta suaugusiesiems. KMI yra orientacinis rodiklis ir nepakeičia gydytojo konsultacijos.</p>
</main>
</body>
</html>
