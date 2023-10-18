
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

//Envoyer à la base le Service et jour au back-end
    //Le controleur récupère les résas pour ce jour et ce service
    // Le controleur envoie le tableau au front
// Le front boucle pour afficher les créneau disponibles avec le nombre de places tant que le nombre de convives < 50



//Récupérer le nombre des places par créneaux back-end

// Chercher les heures d'ouverture et fermeture

//Calculer les créneaux