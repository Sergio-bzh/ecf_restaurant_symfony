/*
let allergiesList = document.getElementById('reservation_allergies')
let option = document.createElement('option')
option.innerText = 'Travail'
allergiesList.append(option)
*/

// TODO : Géréer les heures début/fin de service dans les tranches horaires intermédiaires
// TODO : Ne pas afficher la dernière heure de service
// TODO : Afficher les minutes au lieu du numéro du quart d'heure exemple (12:15 au lieu de 12:1)
// TODO : Bloquer la possibilité de choisir un jour passé

let selector = window.document.getElementsByName('reservation[allergies]')
toggleAllergies()
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

    const CAPACITE = 50
    let allValeurs = [0, 0, 0]
    let indiceCumulPlaces = 3
    select.innerHTML = ''

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
                let option = window.document.createElement('option')
                option.innerText = `${dateH}:${quartHeure}`
                select.appendChild(option)
            }
            quartHeure++
            indiceCumulPlaces++
        }
    }
}






//Envoyer à la base le Service et jour au back-end
    //Le controleur récupère les résas pour ce jour et ce service
    // Le controleur envoie le tableau au front
// Le front boucle pour afficher les créneau disponibles avec le nombre de places tant que le nombre de convives < 50



//Récupérer le nombre des places par créneaux back-end

// Chercher les heures d'ouverture et fermeture

//Calculer les créneaux