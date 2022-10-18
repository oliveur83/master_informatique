var foisj;
var foisi;
var Tableau;
var flag=0;

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
  }
function val(x)
{       

    var cpt=0;
    for(let i=0;i<9;i++){
        if (Tableau[i]=='*'){cpt=i;}
    }  
    //voisin calcul 
    let liste_voisin=[];
    var varia=false;
    //droit et gauche
    if ((cpt%3)<2){
        liste_voisin=liste_voisin+[cpt+1];
    }
    if ((cpt%3)>=1){
        liste_voisin=liste_voisin+[cpt-1];
    }
    //dessu
    if (cpt>2){
        liste_voisin=liste_voisin+[cpt-3];
    }
    if (cpt<=5){
        liste_voisin=liste_voisin+[cpt+3];
    }
    
    for(var i=0; i<liste_voisin.length; i++) {
 
        if(x== liste_voisin[i]) {
            varia=true;
        }
    }
    //-----------------
    if (varia==true){
        let toto=Tableau[x];
        document.getElementById(''+x+'').innerHTML =Tableau[cpt];
        document.getElementById(''+cpt+'').innerHTML =toto;
        Tableau[cpt]=Tableau[x];
        Tableau[x]="*";
    }

    
    gagner() ;

}
function gagner() {
    let cpt=1;
    for(let i=0;i<9;i++){
        if (Tableau[i]==cpt)
        {
            cpt=cpt+1;
        }
        if (Tableau[i]=='*' && i==7)
        {
            cpt=cpt+1;
        }
    }
    document.getElementById("erreur").innerHTML=cpt;
    if(cpt==10){document.getElementById("erreur").innerHTML='tu a gagne';}
    
}
function takin()
{
    document.body.appendChild( document.createElement( "br" ) );
       
    //creation du Tableau  
    Tableau=[1,2,3,4,5,6,7,'*',9];
    // mélange

    for(let i=0;i<8;i++){
        var A=(getRandomInt(8)+1);
        var B=(getRandomInt(8)+1);


        var cpt=Tableau[B];
        Tableau[B]=Tableau[A];
        Tableau[A]=cpt;
    }

    if(flag==0){
        for(let j=0;j<3;j++)
        { 
            for(let i=0;i<3;i++)
            {
                const btn = document.createElement("button");
                btn.style.width=100;
                btn.style.length=100;
                btn.style.fontSize=40;
                btn.value=Tableau[i];
                
                if (j==0){
                    btn.id=""+i+"";
                    btn.innerHTML = Tableau[i];
                    btn.setAttribute("onclick", 'val('+i+')');
                }
                else{
                    let x=(i+(j*3))
                    btn.id=""+x+"";
                    btn.setAttribute("onclick", "val("+x+")");
                    
   
                    btn.innerHTML = Tableau[x];
                    
                }
                document.body.appendChild(btn);
    
            }
           
    document.body.appendChild( document.createElement( "br" ) );
            
        }
        flag=1;
    }
    // faire la grille 

//savoir si on a gagne 
   

}