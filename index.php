<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Monitorowanie czasu pracy</title>
</head>
<body>
    <header>
        <h1>Monitorowanie czasu pracy</h1>
    </header>
    <main>
        <section id="S1">
            <form>
                <label>Imię: </label>
                <input type="text" name="imie" required>
                <br>

                <label>Nazwisko: </label>
                <input type="text" name="nazwisko" required>
                <br>

                <label>Początek czasu pracy:</label>
                <input type="date" name="data_pocz" required>
                <input type="time" name="start_time" required>
                <br>

                <label>Koniec czasu pracy:</label>
                <input type="date" name="data_koniec" required>
                <input type="time" name="end_time" required>
                <br>

                <button type="submit">Zapisz czas pracy</button>
                <button type="reset">reset</button>
            </form>
        </section>
        <br>
        <section id="S2">
            <table id="table1">
                <thead>
                    <tr>
                        <th>L.p.</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Czas rozpoczęcia</th>
                        <th>Czas zakończenia</th>
                        <th>Czas pracy:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    ?>
                </tbody>    
            </table>
        </section>
    </main>
    <br>
    <footer>
        Moja strona 2026.
    </footer>
</body>
</html>