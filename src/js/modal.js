// On récupère la modal
var modal = document.getElementById("myModal");

// On récupère le bouton qui permet d'ouvrir la modal
var btn = document.getElementById("myBtn");

// On récupère le span qui permet de fermer la modal (la croix)
var span = document.getElementsByClassName("close")[0];

// Lorsqu'on clique sur le bouton, la modal passe en display block et s'affiche en conséquence (car de base en display none)
btn.onclick = function () {
	modal.style.display = "block";
};

// Lorsque l'utilisateur clique sur la croix, on ferme la modal en la passant en display none
span.onclick = function () {
	modal.style.display = "none";
};

// Lorsque l'utilisateur n'importe où en dehors de la modal, on ferme la modal en la passant en display none
window.onclick = function (event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
};
