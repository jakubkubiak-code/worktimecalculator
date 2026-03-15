<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Monitorowanie czasu pracy</title>
</head>
<body>
    <?php
        $plik = "czas_pracy.json";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        $start = $_POST["data_pocz"] . " " . $_POST["start_time"];
        $koniec = $_POST["data_koniec"] . " " . $_POST["end_time"];

        $start_ts = strtotime($start);
        $koniec_ts = strtotime($koniec);

        $roznica = $koniec_ts - $start_ts;
        
        $godziny = floor($roznica / 3600);
        $minuty = floor(($roznica % 3600) / 60);

        $czas_pracy = $godziny . " h " . $minuty . " m";

        $nowy_wpis = [
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "start" => $start,
            "koniec" => $koniec,
            "czas" => $czas_pracy
        ];
        
        if (file_exists($plik)) {
            $dane = json_decode(file_get_contents($plik), true);
        } else {
            $dane = [];
        }

        $dane[] = $nowy_wpis;

        file_put_contents($plik, json_encode($dane, JSON_PRETTY_PRINT));
        }
    ?>
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
                        if (file_exists("czas_pracy.json")) {
                        $dane = json_decode(file_get_contents("czas_pracy.json"), true);
                        $lp = 1;
                            
                        foreach ($dane as $osoba){
                            echo "<tr>";
                            echo "<td>".$lp++."</td>";
                            echo "<td>".$osoba["imie"]."</td>";
                            echo "<td>".$osoba["nazwisko"]."</td>";
                            echo "<td>".$osoba["start"]."</td>";
                            echo "<td>".$osoba["koniec"]."</td>";
                            echo "<td>".$osoba["czas"]."</td>";
                            echo "</tr>";
                            }
                        }
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
