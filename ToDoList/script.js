let doZrobienia = document.querySelector("#doZrobienia");

let zadania = document.querySelectorAll("li input[type='checkbox']");

zadania.forEach(zadanie => {
    zadanie.addEventListener("change", zadaniaZmiana);
});

function zadaniaZmiana()
{
    if(this.checked)
    {
        this.parentNode.parentNode.classList.add("zrobione");
    }

    this.disabled = true;

    // this.parentNode.parentNode.style.order = "100";

    let ile = 0;

    zadania.forEach(zadanie => {
        if(!zadanie.checked)
        {
            ile++;
        }
    });

    let jest = "";
    let zadan = "";

    switch(ile)
    {
        case 1:
            zadan = "zadanie";
            jest = "jest";
            break;

        case 2:
        case 3:
        case 4:
            zadan = "zadania";
            jest = "są";
            break;

        default:
            zadan = "zadań";
            jest = "jest";
            break;
    }

    if(ile > 0)
    {
        doZrobienia.textContent = "Do zrobienia " + jest + " " + ile + " " + zadan;
    }

    else
    {
        doZrobienia.textContent = "Nie ma więcej zadań do zrobienia";
    }

    zmienStatus(this.id);
}

function zmienStatus(id)
{
    // Definicja zmiennej, którą chcesz przesłać
    let zrobioneZadanieID = id;

    // Użycie fetch do wysłania danych
    fetch('home.php', {
        method: 'POST', // Metoda HTTP
        headers: {
            'Content-Type': 'application/json' // Wskazuje, że wysyłamy dane JSON
        },
        body: JSON.stringify({
            zrobioneZadanieID: zrobioneZadanieID // Przekazujemy zmienną w obiekcie JSON
        })
    })

    .then(response => response.text()) // Odbieramy odpowiedź tekstową z serwera
    
    .then(data => {
        console.log('Odpowiedź od serwera:', data); // Wyświetlamy odpowiedź
    })

    .catch(error => {
        console.error('Błąd:', error); // W przypadku błędu
    });

    // document.querySelector("ul").remove();

}