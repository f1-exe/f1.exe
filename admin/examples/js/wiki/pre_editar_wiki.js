function obtenerIdWiki(id) {
    id_wiki =  document.getElementById("btn_tema_"+id).value;
    location.replace("editar_wiki.php?id="+id_wiki);
}
