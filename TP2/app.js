
var input;
var Tableau;
var aleatoire
var foisj;
var foisi;
function getRandomInt(max) {
    return Math.floor(Math.random() * max);
  }
function grille(){
    input = document.getElementById("val").value;
    foisj=400/input;
    foisi=400/input;
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    aleatoire=(getRandomInt(input)+2);
    document.getElementById("erreur").innerHTML=aleatoire
                  
    // faire tableau pour voisin 
    Tableau = new Array(input);
    for (var i = 0; i < 10; i++)
    {
     Tableau[i] = new Array(input);
    }
    // cration de la grille 
    for(let j=0;j<input;j++){
        for(let i=0;i<=input;i++)
        {
            //contour
            ctx.strokeStyle = 'purple'; 
            ctx.beginPath();
            ctx.strokeRect(i*foisi,j*foisj,foisi,foisj);
            ctx.stroke();
            //retangle
            ctx.fillStyle="#D3D3D3";
            ctx.fillRect(i*foisi,j*foisj,foisi,foisj);
            
 
        }
        //place les k objet 
        if (j<aleatoire){
           
            var aleatoirex=getRandomInt(input);
            ctx.fillStyle="#000000";
            ctx.font = "32px serif";
            ctx.fillText("A",aleatoirex*foisi ,j*foisj);
            Tableau[j][aleatoirex]=1;
        }
    }
}
function grillebloquante(){
    
    input = document.getElementById("val").value;
    foisj=400/input;
    foisi=400/input;
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    var aleatoire=(getRandomInt(input)+2);
    var aleatoirep=((getRandomInt(input)/2) +2);

    // faire tableau pour voisin 
     Tableau = new Array(input);
    for (var i = 0; i < 10; i++)
    {
     Tableau[i] = new Array(input);
    }
    // cration de la grille 
    for(let j=0;j<input;j++){
        for(let i=0;i<=input;i++)
        {
            //contour
            ctx.strokeStyle = 'purple'; 
            ctx.beginPath();
            ctx.strokeRect(i*foisi,j*foisj,foisi,foisj);
            ctx.stroke();
            //retangle
            ctx.fillStyle="#D3D3D3";
            ctx.fillRect(i*foisi,j*foisj,foisi,foisj);
            
 
        }
        //place les k objet 
        if (j<aleatoire){
           
            var aleatoirex=getRandomInt(input);
            ctx.fillStyle="#000000";
            ctx.font = "32px serif";
            ctx.fillText("A",aleatoirex*foisi,j*foisj);
            Tableau[j][aleatoirex]=1;
        }
        //place les P bloque
        if (j<aleatoirep){
           
            var aleatoirex=getRandomInt(input);
            ctx.fillStyle="#00FF00";
            ctx.font = "32px serif";
            while(Tableau[j][aleatoirex]==1){
                aleatoirex=getRandomInt(input)
            }
            ctx.fillText("P",aleatoirex*foisi,j*foisj);
            Tableau[j][aleatoirex]=2;
        }
    }
}

function voisin(){
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    ctx.fillStyle="#FF0000";
    ctx.font = "32px serif";

let toto=0

    for(let j=0;j<input;j++){
        
        for(let i=0;i<input;i++){
            if(Tableau[j][i]==1){
                if (i==(input-1))
                {   toto=i-1
                    if (Tableau[j][toto]==2){
                        document.getElementById("erreur").innerHTML='erreur'
                    }
                    else{    ctx.fillText("V",(i-1)*foisi,j*foisj);
                }
                }
                else{
                    toto=i+1
                    if (Tableau[j][toto]==2){
                        toto=i-1
                         if (Tableau[j][toto]==2){
                                document.getElementById("erreur").innerHTML='erreur'
                            }
                        else{    ctx.fillText("V",(i-1)*foisi,j*foisj);
                                }
                       }
                    else{    ctx.fillText("V",(i+1)*foisi,j*foisj);
                }

         
                } }
            

            }
        }
    }

