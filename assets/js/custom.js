document.addEventListener("DOMContentLoaded", function() {
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        currentTimeElement.textContent = `${hours}:${minutes}`;
    }

    function updateDate() {
        const currentDateElement = document.getElementById('current-date-time');
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const year = now.getFullYear();
        currentDateElement.textContent = `${day}/${month}/${year}`;
    }

    // Aggiorna l'ora immediatamente al caricamento della pagina
    updateTime();

    // Aggiorna l'ora ogni 30 secondi (30000 millisecondi)
    setInterval(updateTime, 30000);

     // Aggiorna la data immediatamente al caricamento della pagina
     updateDate();

     // Aggiorna la data ogni 30 secondi (30000 millisecondi)
     setInterval(updateDate, 30000);
});
