/*
let allergiesList = document.getElementById('reservation_allergies')
let option = document.createElement('option')
option.innerText = 'Travail'
allergiesList.append(option)
*/

// TODO : Géréer les heures début/fin de service dans les tranches horaires intermédiaires histoire des 3/4 d'heures
// TODO : Ne pas afficher la dernière heure de service
// TODO : Bloquer la possibilité de choisir un jour passé

let selector = window.document.getElementsByName('reservation[allergies]')
const date = window.document.getElementById('reservation_reservation_date')
let allCreneaux = window.document.getElementById('reservation_meal_time').getElementsByTagName('option');
let service = window.document.getElementById('reservation_service')
service.style.display = 'none'
let premierPassage = true

// Fonction pour masquer les 96 balises option du DOM
function masqueBalises () {
    if (!premierPassage) {
        for (let option of allCreneaux){
            option.style.display = 'none'
        }
        allCreneaux[0].style.display = 'block'
    }
    premierPassage = false
}


// Condition servant à empêcher le choix de dates déja écoulées ou de choisir un créneau si la date n'est pas correcte
if(date) {
    date.addEventListener("change", function (evenement) {
        evenement.preventDefault();
        let today = new Date().toISOString().substring(0, 10);
        todayParsed = Date.parse(today)
        dateParsed = Date.parse(date.value)
        console.log(today);
        console.log(date.value)

        masqueBalises()

        if (dateParsed < todayParsed || date.value === '') {
            console.log('Veuillez choisir la date d\'aujourd\'hui '+'(' + today + ')' +' ou une date à venir')
            service.style.display = 'none'
        } else {
            service.style.display = 'block'
            getCreneaux();
        }
    })
}

function toggleAllergies() {
    const ALLERGIE_CHECKBOX_FIELD = window.document.getElementById('reservation_allergie')
    const ALLERGIES = window.document.getElementById('allergies_list')
    if(!ALLERGIE_CHECKBOX_FIELD.checked) {
        ALLERGIES.style.display = 'none'
    }
    else {
        ALLERGIES.style.display = 'block'
    }
}

async function getCreneaux() {
    let guest_number = window.document.getElementById('reservation_guest_number')
    let select = window.document.getElementById('reservation_meal_time')

//  Appel à l'API Back-End en dur pour les tests sur LOCALHOST !!
    const response = await fetch(`https://localhost:8000/api/timeSlice?date=${date.value}&service=${service.value}`)
    const creneaux = await response.json()
    const CAPACITE = 50
    let allValeurs = [0, 0, 0]
    let indiceCumulPlaces = 3

    let debutService = parseInt(creneaux.service_start.substring(11, 13))
    let finService = parseInt(creneaux.service_end.substring(11, 13))

// Boucle pour obtenir les heures à afficher dans le formulaire
    for (let dateH = creneaux.service_start.substring(11, 13); dateH < creneaux.service_end.substring(11, 13) ; dateH++) {
        let quartHeure = 0

// Boucle pour obtenir les quarts d'heures à afficher dans le formulaire
        while (quartHeure <= 3) {
            let places_prises = 0
            if (creneaux[dateH + ':' + quartHeure]) {
                places_prises = parseInt(creneaux[dateH + ':' + quartHeure].places_reservees)
            }

            allValeurs.push(places_prises)
            console.log(indiceCumulPlaces,allValeurs)

            if((allValeurs[indiceCumulPlaces]) != null && places_prises
                + parseInt(guest_number.value)
                + allValeurs[indiceCumulPlaces-1]
                + allValeurs[indiceCumulPlaces-2]
                + allValeurs[indiceCumulPlaces-3] <= CAPACITE ) {
                allCreneaux[((debutService * 4) - 2) + indiceCumulPlaces].style.display = 'block';
            }
            quartHeure++
            indiceCumulPlaces++
        }
    }
}

/*
ReMasquer les creneaux :
Si guest_number change recalcule

Si service change recalcule
Si date change recalcule
*/
