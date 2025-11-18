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
</head>
<body>
    <header>
        <h1>Witaj <?php echo $login; ?>!</h1>
    </header>

    <main>
        <a href="wyloguj.php"><button>Wyloguj</button></a>
    </main>
</body>
</html>