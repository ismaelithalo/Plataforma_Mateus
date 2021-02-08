//Reconhece se esta no topo da pagina e esconde o botao
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btn-back-top").style.display = "block";
        
   } else {
       document.getElementById("btn-back-top").style.display = "none";
           }
       }

// Retorna ao topo       
function subir () {
   document.documentElement.scrollTop = 0; 
}