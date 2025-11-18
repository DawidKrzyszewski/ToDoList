<?php 
    session_start();

    if(isset($_SESSION["zalogowany"]))
    {
        header("location: home.php");
        exit();
    }

    require_once("config.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList - logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>ToDoList - logowanie</h1>
    </header>

    <main>

        <form action="logowanie.php" method="post">
            <fieldset>
                <legend>Podaj dane logowania</legend>

                <input type="text" name="login" placeholder="Login" required>

                <br>

                <input type="password" name="haslo" placeholder="Hasło" required>

                <?php
                
                
                    if(isset($_POST["login"]) && isset($_POST["haslo"]))
                    {
                        $login = $_POST["login"];
                        $haslo = $_POST["haslo"];

                        $zapytnie = "SELECT * FROM uzytkownicy WHERE login = ?";

                        $wykonaj = $polaczenie->prepare($zapytnie);

                        $wykonaj->execute([$login]);

                        $wynik = $wykonaj->get_result();

                        $hasloBaza = 0;

                        foreach($wynik as $rekord)
                        {
                            $hasloBaza = $rekord["haslo"];
                            $userID = $rekord["id"];
                        }

                        if($hasloBaza == 0)
                        {
                            echo "<span style='color: red;'>Nie znaleziono użytkownika o podanej nazwie</span>";
                        }

                        else
                        {
                            // if(md5($haslo) == $hasloBaza)
                            if(password_verify($haslo, $hasloBaza))
                            {
                                $_SESSION["zalogowany"] = true;
                                $_SESSION["userID"] = $userID;
                                header("location: home.php");
                                exit();
                            }

                            else
                            {
                                echo "<span style='color: red;'>Hasło niepoprawne</span>";
                            }
                        }
                    }

                ?>

                <button>Zaloguj</button>

                <p>Nie masz konta? <a href="rejestracja.php">Zarejestruj się!</a></p>

            </fieldset>
        </form>

    </main>
</body>
</html>