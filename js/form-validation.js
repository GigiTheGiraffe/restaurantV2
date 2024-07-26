// Validation côté client
document.getElementById('contact').addEventListener('submit', (event) => {
    const message = document.getElementById('message').value;
    
    // Basique sécurité contre les scripts avec un test et une alerte
    const scriptPattern = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
    if (scriptPattern.test(message)) {
        alert('Les scripts ne sont pas autorisés dans le message.');
        event.preventDefault();
    }
});