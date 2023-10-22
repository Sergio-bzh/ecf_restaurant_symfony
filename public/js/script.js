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
let premierPassage = true

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
    const date = window.document.getElementById('reservation_reservation_date')
    const service = window.document.getElementById('reservation_service')
    let guest_number = window.document.getElementById('reservation_guest_number')
    let select = window.document.getElementById('reservation_meal_time')

//  Appel à l'API Back-End en dur pour les tests sur LOCALHOST !!
    const response = await fetch(`https://localhost:8000/api/timeSlice?date=${date.value}&service=${service.value}`)
    const creneaux = await response.json()
console.log(creneaux)
    const CAPACITE = 50
    let allValeurs = [0, 0, 0]
    let indiceCumulPlaces = 3

//  Constante créé à partir du tableau des quart d'heures (96 balise option) présentes dans le DOM
    const ALLCRENEAUX = window.document.getElementById('reservation_meal_time').getElementsByTagName('option');

// Boucle pour masquer les 96 balises option avant d'obtenir les heures à afficher dans le formulaire
    if (!premierPassage) {
        for (option of ALLCRENEAUX)
           option.style.display = 'none'
    }
    premierPassage = false

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

            if((allValeurs[indiceCumulPlaces]) != null && places_prises + parseInt(guest_number.value) + allValeurs[indiceCumulPlaces-1] + allValeurs[indiceCumulPlaces-2] + allValeurs[indiceCumulPlaces-3] <= CAPACITE ) {
                ALLCRENEAUX[((debutService * 4) - 2) + indiceCumulPlaces].style.display = 'block';
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
