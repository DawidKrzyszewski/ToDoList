<?php 
    session_start();

    if(!$_SESSION["zalogowany"])
    {
        header("location: logowanie.php");
        exit();
    }

    require_once("config.php");

    $userID = $_SESSION["userID"];

    $zapytanie = "SELECT * FROM uzytkownicy WHERE id = ?";

    $wykonaj = $polaczenie->prepare($zapytanie);

    $wykonaj->execute([$userID]);

    $wynik = $wykonaj->get_result();

    foreach($wynik as $rekord)
    {
        $login = $rekord["login"];
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <h1>Witaj <?php echo $login; ?>!</h1>
    </header>

    <section>

        <form action="home.php" method="post">
            <fieldset>
                <legend>Dodaj nowe zadanie</legend>
                <table>
                    <tr>
                        <td><label for="zadanie">Zadanie: </label></td>
                        <td><input type="text" id="zadanie" name="zadanie"></td>
                    </tr>
                    <tr>
                        <td><label for="termin">Termin: </label></td>
                        <td><input type="date" id="termin" name="termin"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button>Dodaj zadanie</button>
                        </td>
                    </tr>
                </table>

                <?php 

                    if(isset($_POST["zadanie"]) && isset($_POST["termin"]))
                    {
                        if($_POST["zadanie"] !== "" && $_POST["zadanie"] !== " ")
                        {
                            $zadanie = $_POST["zadanie"];
                            $termin = $_POST["termin"];
                            $istnieje = false;

                            $zapytanie = "SELECT * FROM zadania WHERE uzytkownicy_id = ?";

                            $wykonaj = $polaczenie->prepare($zapytanie);

                            $wykonaj->execute([$userID]);

                            $wynik = $wykonaj->get_result();

                            foreach($wynik as $rekord)
                            {
                                if($zadanie == $rekord["zadanie"])
                                {
                                    $istnieje = true;
                                }
                            }

                            if(!$istnieje)
                            {
                                $zapytanie = "INSERT INTO zadania (zadanie, termin, uzytkownicy_id) VALUES(?, ?, ?)";
                    
                                $wykonaj = $polaczenie->prepare($zapytanie);

                                $wykonaj->execute([$zadanie, $termin, $userID]);
                            }

                            else
                            {
                                // echo "Zadanie już istnieje";
                            }
                        }
                    }
                
                    
                ?>

            </fieldset>
        </form>

    <hr>

    </section>

    <main>
        <?php 
            $zapytanie = "SELECT * FROM zadania WHERE uzytkownicy_id = ? AND zrobione = 0 ORDER BY termin ASC";

            $wykonaj = $polaczenie->prepare($zapytanie);

            $wykonaj->execute([$userID]);

            $wynik = $wykonaj->get_result();

            $ileZadan = 0;

            foreach($wynik as $zadanie)
            {
                $ileZadan++;
            }

            $zadan;
            $jest;

            switch($ileZadan)
            {
                case 1:
                    $zadan = "zadanie";
                    $jest = "jest";
                    break;

                case 2:
                case 3:
                case 4:
                    $zadan = "zadania";
                    $jest = "są";
                    break;

                default:
                    $zadan = "zadań";
                    $jest = "jest";
                    break;
            };

            if($ileZadan > 0)
            {
                echo "<h3 id='doZrobienia'>Do zrobienia " . $jest . " " . $ileZadan . " " . $zadan . "</h3>"; 
            }

            else
            {
                echo "<h3 id='doZrobienia'>Nie ma więcej zadań do zrobienia</h3>"; 
            }
            

            echo "<ul>";            
                    
            foreach($wynik as $rekord)
            {
                $zadanieID = $rekord["id"];

                echo "<li>" . $rekord["zadanie"] . " <span>" . $rekord["termin"] . "<input type='checkbox' id=" . $zadanieID . "></span></li>";
            }

            echo "</ul>";

            ?>

            <?php
                // Odbieramy dane JSON z żądania POST
                $dane_json = file_get_contents('php://input');
                $dane = json_decode($dane_json, true);

                // Sprawdzamy, czy zmienna istnieje i pobieramy jej wartość
                if (isset($dane['zrobioneZadanieID'])) {
                    $zmienna_php = $dane['zrobioneZadanieID'];
                    echo $zmienna_php;

                    // Tutaj można przetworzyć zmienną, np. zapisać do bazy danych
                    // Przykładowo, po prostu zwracamy ją w odpowiedzi
                    // echo "Otrzymana wartość z JS: " . htmlspecialchars($zmienna_php);

                    $zapytanie = "UPDATE zadania SET zrobione = 1 WHERE id = ?";

                    $wykonaj = $polaczenie->prepare($zapytanie);

                    $wykonaj->execute([$zmienna_php]);
                    
                    // header("Refresh:0");
                    // exit();
                } 
                
                else {
                    // echo "Błąd: Nie otrzymano danych.";
                }
            ?>
    </main>

    <footer>
        <a href="wyloguj.php"><button>Wyloguj</button></a>
    </footer>
</body>
</html>