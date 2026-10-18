<?php
function skaicius($value): ?float {
    if (!is_string($value)) return null;
    $value = str_replace(',', '.', trim($value));
    return is_numeric($value) && is_finite((float) $value) ? (float) $value : null;
}
$svoris = skaicius($_POST['svoris'] ?? null);
$ugis = skaicius($_POST['ugis'] ?? null);
$valid = $svoris !== null && $ugis !== null && $svoris >= 0.1 && $svoris <= 1000 && $ugis >= 1 && $ugis <= 300;
$normos = [
    ['Mažas svoris', 'Mažiau nei 18,5'],
    ['Normalus svoris', '18,5–<25'],
    ['Antsvoris', '25–<30'],
    ['Nutukimas, I laipsnis', '30–<35'],
    ['Nutukimas, II laipsnis', '35–<40'],
    ['Nutukimas, III laipsnis', '40 ir daugiau'],
];
if ($valid) {
    $kmi = $svoris / (($ugis / 100) ** 2);
    $kategorija = $kmi < 18.5 ? 0 : ($kmi < 25 ? 1 : ($kmi < 30 ? 2 : ($kmi < 35 ? 3 : ($kmi < 40 ? 4 : 5))));
    $atgal = 'index.php?' . http_build_query(['svoris' => $svoris, 'ugis' => $ugis]);
} else {
    http_response_code(422);
    $atgal = 'index.php';
}
?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KMI rezultatas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="card">
    <p class="eyebrow">Kūno masės indeksas</p>
    <h1><?= $valid ? 'Jūsų rezultatas' : 'Patikrinkite duomenis' ?></h1>
    <?php if ($valid): ?>
        <div class="result">
            <p>Jūsų KMI</p>
            <strong><?= number_format($kmi, 2, ',', '') ?></strong>
            <p><?= $normos[$kategorija][0] ?></p>
        </div>
        <p class="formula">KMI = <?= number_format($svoris, 1, ',', '') ?> kg / (<?= number_format($ugis / 100, 3, ',', '') ?> m)²</p>
        <h2>KMI normos suaugusiesiems</h2>
        <table>
            <caption>Kategorija nustatoma pagal nesuapvalintą KMI.</caption>
            <thead><tr><th scope="col">Kategorija</th><th scope="col">KMI</th></tr></thead>
            <tbody>
            <?php foreach ($normos as $index => [$pavadinimas, $intervalas]): ?>
                <tr<?= $index === $kategorija ? ' class="selected"' : '' ?>>
                    <th scope="row"><?= $pavadinimas ?><?= $index === $kategorija ? ' (jūsų)' : '' ?></th>
                    <td><?= htmlspecialchars($intervalas, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <p class="note">KMI yra orientacinis rodiklis. Jis nevertina raumenų masės, netinka vaikams ar nėščiosioms ir nepakeičia gydytojo konsultacijos.</p>
    <?php else: ?>
        <p class="error" role="alert">Įveskite svorį nuo 0,1 iki 1000 kg ir ūgį nuo 1 iki 300 cm. Abu laukai privalomi.</p>
    <?php endif; ?>
    <a class="button" href="<?= htmlspecialchars($atgal, ENT_QUOTES, 'UTF-8') ?>">← Grįžti į skaičiavimo formą</a>
</main>
</body>
</html>
