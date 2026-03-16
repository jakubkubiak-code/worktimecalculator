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
            
        if(isset($_POST["usun"])){
            $index = $_POST["usun"];

            if(file_exists($plik)){
                $dane = json_decode(file_get_contents($plik), true);

                unset($dane[$index]);

                file_put_contents($plik, json_encode(array_values($dane), JSON_PRETTY_PRINT));
            }
        }

        if(isset($_POST["imie"])){

            $imie = $_POST["imie"];
            $nazwisko = $_POST["nazwisko"];
            $start = $_POST["data_pocz"] . " " . $_POST["start_time"];
            $koniec = $_POST["data_koniec"] . " " . $_POST["end_time"];

            $start_ts = strtotime($start);
            $koniec_ts = strtotime($koniec);

            $roznica = $koniec_ts - $start_ts;

            $godziny = floor($roznica / 3600);
            $minuty = floor(($roznica % 3600) / 60);

            $czas_pracy = $godziny . " h " .  $minuty . " m";

            $nowy_wpis = [
                "imie" => $imie,
                "nazwisko" => $nazwisko,
                "start" => $start,
                "koniec" => $koniec,
                "czas" => $czas_pracy
            ];

        if (file_exists($plik)) {
            $dane = json_decode(file_get_contents($plik), true);
        } 
        else {
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
            <form method="post" action="index.php">
                <label class="label">Imię: </label>
                <input type="text" name="imie" required>
                <br>

                <label class="label">Nazwisko: </label>
                <input type="text" name="nazwisko" required>
                <br>

                <label class="label">Początek czasu pracy:</label>
                <input type="date" name="data_pocz" required>
                <input type="time" name="start_time" required>
                <br>

                <label class="label">Koniec czasu pracy:</label>
                <input type="date" name="data_koniec" required>
                <input type="time" name="end_time" required>
                <br><br>

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
                        <th>Usuń rekord</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (file_exists("czas_pracy.json")) {

                        $json = file_get_contents("czas_pracy.json");
                        $dane = json_decode($json, true);

                        if ($dane) {
                            $lp = 1;

                        foreach ($dane as $key => $osoba) {
                            echo "<tr>";
                            echo "<td>".$lp++."</td>";
                            echo "<td>".$osoba["imie"]."</td>";
                            echo "<td>".$osoba["nazwisko"]."</td>";
                            echo "<td>".$osoba["start"]."</td>";
                            echo "<td>".$osoba["koniec"]."</td>";
                            echo "<td>".$osoba["czas"]."</td>";
                            echo "<td>
                                <form method='post'>
                                <button type='submit' name='usun' value='$key'>Usuń rekord</button>
                                </form>
                                </td>";
                            echo "</tr>";
                                }
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