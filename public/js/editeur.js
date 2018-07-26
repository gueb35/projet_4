function commande(nom, argument){
    if (typeof argument === 'undefined') {
        argument = '';
    }
	// Exécuter la commande
	document.execCommand(nom, false, argument);
}
function resultat(){
	document.getElementById("resultat").value = document.getElementById("editeur").innerHTML;
}