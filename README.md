# KMI skaičiuoklė

Du puslapiai su PHP, HTML ir CSS. Papildomų bibliotekų ar duomenų bazės nereikia.

## Paleidimas

Reikia PHP 8 arba naujesnio. Projekto aplanke paleiskite:

```sh
php -S 0.0.0.0:8000 -t .
```

Naršyklėje atidarykite `http://localhost:8000/index.php`.

`index.php` pateikia svorio ir ūgio formą. `rezultatas.php` priima POST duomenis, patikrina juos, apskaičiuoja KMI ir parodo normų lentelę. Grįžus į formą išsaugomi teisingai įvesti duomenys. `style.css` pritaiko išdėstymą telefono ir kompiuterio ekranams.

KMI = svoris kilogramais / (ūgis centimetrais / 100)². Kategorija nustatoma prieš apvalinimą; rezultatas rodomas dviejų skaitmenų po kablelio tikslumu.
