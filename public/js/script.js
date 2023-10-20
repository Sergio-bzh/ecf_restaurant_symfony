/*
let allergiesList = document.getElementById('reservation_allergies')
let option = document.createElement('option')
option.innerText = 'Travail'
allergiesList.append(option)
*/


let selector = window.document.getElementsByName('reservation[allergies]')

function toggleAllergies() {
    const ALLERGIE_CHECKBOX_FIELD = window.document.getElementById('reservation_allergie')
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

    const response = await fetch(`https://localhost:8000/api/timeSlice?date=${date.value}&service=${service.value}`)
    creneaux = await response.json()

    const CAPACITE = 50

    for (let dateH = creneaux.service_start.substring(11, 13); dateH < creneaux.service_end.substring(11, 13) ; dateH++) {
        let quartHeure = 0
        while (quartHeure <= 3) {
            let places_prises = 0
            if (creneaux[dateH + ':' + quartHeure]) {
                places_prises = parseInt(creneaux[dateH + ':' + quartHeure].places_reservees)
            }

            places_prises += parseInt(guest_number.value)
            if(places_prises <= 50 ) {
                let option = window.document.createElement('option')
                option.innerText = `${dateH}  :  ${quartHeure}`
                select.appendChild(option)
            }
            quartHeure++
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