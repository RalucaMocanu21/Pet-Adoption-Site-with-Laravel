<!DOCTYPE html>
<html>
<head>
    <title>Un nou animal a fost postat</title>
</head>
<body>
    <h1>Un nou animal a fost postat</h1>
    <p>Tip: {{ $animal->tip }}</p>
    <p>Descriere: {{ $animal->descriere }}</p>
    <p>Locație: {{ $animal->locatie }}</p>
    <p>Vârstă: {{ $animal->varsta }}</p>
    <p>Culoare: {{ $animal->culoare }}</p>
    <p>Rasă: {{ $animal->rasa }}</p>
    <p>Greutate: {{ $animal->greutate }}</p>
    <p>Vaccinat: {{ $animal->vaccinat }}</p>
</body>
</html>
