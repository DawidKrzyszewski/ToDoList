<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList - rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>ToDoList - rejestracja</h1>
    </header>

    <main>

        <form action="rejestracja.php" method="post">
            <fieldset>
                <legend>Podaj dane do rejestracji</legend>

                <input type="text" name="login" placeholder="Login" required>

                <br>

                <input type="password" name="haslo" placeholder="Hasło" required>

                <br>

                <input type="password" name="hasloPowtorz" placeholder="Powtórz hasło" required>

                <?php 

                    require_once("config.php");
        
                    if(isset($_POST["login"]) && isset($_POST["haslo"]) && isset($_POST["hasloPowtorz"]))
                    {
                        $login = $_POST["login"];
                        $haslo = $_POST["haslo"];
                        $hasloPowtorz = $_POST["hasloPowtorz"];

                        if($haslo !== $hasloPowtorz)
                        {
                            echo "<span style='color: red;'>Podane hasła nie są identyczne!</span>";
                        }

                        else
                        {
                            // $hash = md5($haslo);
                            $hash = password_hash($haslo, PASSWORD_BCRYPT);

                            $zapytanie = "INSERT INTO uzytkownicy (login, haslo) VALUES (?, ?);";

                            $wykonaj = $polaczenie->prepare($zapytanie);

                            $wykonaj->execute([$login, $hash]);

                            header("location: logowanie.php");
                            exit();
                        }

                        
                        echo $hash;

                        echo "<br>";

                        if(password_verify($login, $hash)) 
                        {
                            echo "git";
                        }
                        
                        else
                        {
                            echo "nie git";
                        }
                    }
                
                ?>

                <button>Zarejestruj</button>

                <p>Masz już konto? <a href="logowanie.php">Zaloguj się!</a></p>

            </fieldset>
        </form>

        

    </main>
</body>
</html>