
    const ALLERGIES = window.document.getElementById('allergies_list')
    ALLERGIES.style.display = 'none'


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

        //console.log(date.value)
        //console.log(service.value)
        const response = await fetch(`https://localhost:8000/api/timeSlice?date=${date.value}&service=${service.value}`)
        creneaux = await response.json()

        //console.log(Date.parse(creneaux.service_start), Date.parse(creneaux.service_end))

        for (let dateH = Date.getUTCHours(Date.parse(creneaux.service_start)) ; dateH <= Date.getUTCHours(Date.parse(creneaux.service_end)) ; dateH++) {
            console.log(dateH)
            let quartHeure = 0
            let convives = 0
            while (quartHeure <= 3) {
                //convives = creneaux.creneaux[].places_reservees
                if(convives > 0 && convives <= 50 ) {
                    convives = creneaux.creneaux[0].places_reservees
                    convives += guest_number
                    console.log(convives, quartHeure)
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