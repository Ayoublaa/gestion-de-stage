document.querySelector('form').addEventListener('submit', function(event) {
    var email = document.querySelector('input[name="email"]').value;
    var motdepasse = document.querySelector('input[name="motdepasse"]').value;

    if (!email || !motdepasse) {
        event.preventDefault();
        alert("Veuillez remplir tous les champs.");
    }
});
