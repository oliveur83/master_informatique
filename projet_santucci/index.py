from itertools import combinations_with_replacement
from tkinter import *  
from random import randint
#----------------------------variable 
tableau_id_map=[]
tableau_id_dame=[]
tableau_id_deplacement=[]

flag_joueur=0
flag_click=0
direction_pion=0
ligne_centre=0
colonne_centre=0
#----------variable IA
flag_ia_joue=0
case_possible_ia=[]
meilleur_score=-100
meilleur_ligne=[]
meilleur_colonne=[]
deplace_meilleur_ligne=[]
deplace_meilleur_colonne=[]
n_pion_rouge=20
n_pion_jaune=20
profondeur=0
#----------fonction pour ia 
def valeur_radio():
    global flag_ia_joue
    flag_ia_joue=v.get()
def coup_ordi():
    global flag_joueur,tableau_id_dame
    print("coup ordinateur")
    for ligne in range(10):
        for colonne in range(10):
            selection_ia(ligne,colonne)
    
    jouer_ia()
    flag_joueur=flag_joueur+2  
def jouer_ia() :
    global meilleur_score,meilleur_colonne,meilleur_ligne
    global deplace_meilleur_colonne,deplace_meilleur_ligne
    i=randint(0,len(meilleur_ligne)-1 )
    col_result=int(deplace_meilleur_colonne[i]-meilleur_colonne[i])
    lig_result=int(deplace_meilleur_ligne[i]-meilleur_ligne[i])
    if abs(col_result)==2:
            Canva.delete(tableau_id_dame[int(meilleur_ligne[i]+(lig_result/2))][int(meilleur_colonne[i]+(col_result/2))][0])
          
            tableau_id_dame[int(meilleur_ligne[i]+(lig_result/2))][int(meilleur_colonne[i]+(col_result/2))][0]=0
            tableau_id_dame[int(meilleur_ligne[i]+(lig_result/2))][int(meilleur_colonne[i]+(col_result/2))][1]=0
            
    Canva.move(tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][0],col_result*50,lig_result*50)
    Canva.tag_raise(tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][0])
    cpt=tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][0]
    tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][0]=0
    d= tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][1]
    tableau_id_dame[int(meilleur_ligne[i])][int(meilleur_colonne[i])][1]=0
    tableau_id_dame[int(deplace_meilleur_ligne[i])][int(deplace_meilleur_colonne[i])][0]=cpt  
    if (deplace_meilleur_ligne[i]==0 or deplace_meilleur_ligne[i]==9) or d=='d':
        tableau_id_dame[int(deplace_meilleur_ligne[i])][int(deplace_meilleur_colonne[i])][1]='d'
    else:
        tableau_id_dame[int(deplace_meilleur_ligne[i])][int(deplace_meilleur_colonne[i])][1]='p'     
    meilleur_ligne=[]
    meilleur_colonne=[]
    deplace_meilleur_ligne=[]
    deplace_meilleur_colonne=[]
    meilleur_score=-1000
    
def selection_ia(ligne,colonne):
    global ligne_centre,colonne_centre,tableau_id_dame,tableau_id_deplacement
    global est_max
    ligne_centre=ligne
    colonne_centre=colonne

    if  0<tableau_id_dame[int(ligne)][int(colonne)][0] <=120 :
            direction_pion=1
            case_possible(1,direction_pion)

            for e in tableau_id_deplacement:
                #calcul ligne collonne 
                ligne=(e-1)/10
                colonne=(e-1)%10
                
                deplacement_ia(ligne,colonne)
           
            tableau_id_deplacement=[]
    
def meilleur(m,colonne,ligne,est_max):
    global meilleur_score,meilleur_ligne,meilleur_colonne
    global deplace_meilleur_ligne, deplace_meilleur_colonne
  
    if meilleur_score<m:
        meilleur_score=m
        meilleur_colonne=[]
        meilleur_ligne=[]
        deplace_meilleur_colonne=[]
        deplace_meilleur_ligne=[]
        meilleur_colonne.append(colonne_centre)
        meilleur_ligne.append(ligne_centre)
        deplace_meilleur_colonne.append(colonne)
        deplace_meilleur_ligne.append(ligne)
        
    elif meilleur_score==m:
        
        meilleur_colonne.append(colonne_centre)
        meilleur_ligne.append(ligne_centre)
        deplace_meilleur_colonne.append(colonne)
        deplace_meilleur_ligne.append(ligne)
        
def deplacement_ia(ligne,colonne):
    global meilleur_score,meilleur_ligne,meilleur_colonne
    global deplace_meilleur_ligne, deplace_meilleur_colonne
    col_result=colonne-colonne_centre
    lig_result=ligne-ligne_centre
    col_result=int(col_result)
    lig_result=int(lig_result)
    
    #memo case pion
    cpt=tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]
    d= tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]
    #case pion a zaro 
    tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]=0
    tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]=0
    #pion sur nouvel case 
    tableau_id_dame[int(ligne)][int(colonne)][0]=cpt  
    if (ligne==0 or ligne==9) or d=='d':
                tableau_id_dame[int(ligne)][int(colonne)][1]='d'
    else:
                tableau_id_dame[int(ligne)][int(colonne)][1]='p'
    #pour le saut 
    if abs(col_result)==2:
                memo_effacer=tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][0]
                memo_effacer2=tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][1]
                tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][0]=0
                tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][1]=0
           
    m=min_max_ia()
    meilleur(m,colonne,ligne,False)        
    cpt=tableau_id_dame[int(ligne)][int(colonne)][0]
    d= tableau_id_dame[int(ligne)][int(colonne)][1]
    #case pion a zaro 
    tableau_id_dame[int(ligne)][int(colonne)][0]=0
    tableau_id_dame[int(ligne)][int(colonne)][1]=0
    #pion sur nouvel case 
    tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]=cpt  
    if  d=='d':
                tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]='d'
    else:
                tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]='p'
    if abs(col_result)==2:
        tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][0]=memo_effacer
        tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][1]=memo_effacer2
def min_max_ia():
    global tableau_id_dame,n_pion_rouge,n_pion_jaune
    global profondeur,est_max
    pion_rouge=0
    pion_jaune=0
   
    for id2 in  tableau_id_dame:
        for id in id2: 
            
            if int(id[0])>120:
                pion_jaune=pion_jaune+1
            if 0<int(id[0])<=120:
                pion_rouge=pion_rouge+1
    dif=pion_jaune-n_pion_jaune
    
    if profondeur==0:
        if dif >0:
                return -100
        elif dif ==0:
                return 0
        else:
                return dif*-100
    else:
        profondeur=profondeur-1

#-------------------------fonction


def bd_dame(ligne,colonne):
    global tableau_id_dame
    global tableau_id_deplacement,tableau_id_map
    if ligne!=9 and colonne!=0:
        if tableau_id_dame[int(ligne+1)][int(colonne-1)][0]==0:
            Canva.itemconfigure(tableau_id_map[int(ligne+1)][int(colonne-1)], fill="green")
            tableau_id_deplacement.append(tableau_id_map[int(ligne+1)][int(colonne-1)])
def hg_dame(ligne,colonne):
    global tableau_id_dame
    global tableau_id_deplacement,tableau_id_map
    if ligne!=0 and colonne!=9:
        if tableau_id_dame[int(ligne-1)][int(colonne+1)][0]==0:
            Canva.itemconfigure(tableau_id_map[int(ligne-1)][int(colonne+1)], fill="red")
            tableau_id_deplacement.append(tableau_id_map[int(ligne-1)][int(colonne+1)])
def hd_dame(ligne,colonne):
    global tableau_id_dame
    global tableau_id_deplacement,tableau_id_map
    if ligne!=0 and colonne!=0:
        if tableau_id_dame[int(ligne-1)][int(colonne-1)][0]==0:
            Canva.itemconfigure(tableau_id_map[int(ligne-1)][int(colonne-1)], fill="blue")
            tableau_id_deplacement.append(tableau_id_map[int(ligne-1)][int(colonne-1)])                          
def bg_dame(ligne,colonne):
    global tableau_id_deplacement,tableau_id_map
    global tableau_id_dame
    
    if ligne!=9 and colonne!=9:
        
        if tableau_id_dame[int(ligne+1)][int(colonne+1)][0]==0:
            Canva.itemconfigure(tableau_id_map[int(ligne+1)][int(colonne+1)], fill="yellow")
            tableau_id_deplacement.append(tableau_id_map[int(ligne+1)][int(colonne+1)])
def qui_gagne():
    pion_rouge=0
    pion_jaune=0
    for id2 in  tableau_id_dame:
        for id in id2: 
            
            if 0<int(id[0])<=120:
                pion_jaune=pion_jaune+1
            if int(id[0])>=120:
                pion_rouge=pion_rouge+1
    if pion_jaune==0:
        
        top = Toplevel()
        var = StringVar()
        label = Label(top, textvariable=var, relief=RAISED)
        var.set("les jaune on gagné ")
        top.mainloop()
    elif pion_rouge==0:
         
        top = Toplevel()
        var = StringVar()
        label = Label(top, textvariable=var, relief=RAISED)
        var.set("les rouge on gagné ")
        top.mainloop()             
def cre_tableau():
    #creation d'un tableau pour le damier
    tableau_id_map=[]
    for i in range(10):
        tab1=[]
        for j in range(10):
            tab1.append(0)
        tableau_id_map.append(tab1)
def curseur_souris(evt):
    pos_x, pos_y = Canva.canvasx(evt.x), Canva.canvasy(evt.y)
    colonne, ligne = pos_x // 50, pos_y // 50  
    return colonne,ligne
def case_possible_dame():
    global ligne_centre,colonne_centre,flag_click
    cpt_px=ligne_centre
    cpt_mx=ligne_centre
    cpt_py=colonne_centre
    cpt_my=colonne_centre
    flag_pg=0
    flag_mg=0
    flag_md=0
    flag_pd=0
    
    for i in range(10):
        #dernier colone
        if cpt_px <= 9 and i>0:
            if cpt_py<=9:
                if tableau_id_dame[int(cpt_px)][int(cpt_py)][0]==0 and flag_pg==0:
                    Canva.itemconfigure(tableau_id_map[int(cpt_px)][int(cpt_py)], fill="blue")
                    tableau_id_deplacement.append(tableau_id_map[int(cpt_px)][int(cpt_py)])
                elif flag_pg==0: 
                    if tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]>=120 and tableau_id_dame[int(cpt_px)][int(cpt_py)][0]<=120:
                        bg_dame(cpt_px,cpt_py)
                    elif tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]<=120 and tableau_id_dame[int(cpt_px)][int(cpt_py)][0]>=120:
                       bg_dame(cpt_px,cpt_py)
                    flag_pg=flag_pg+1
            if cpt_my>=0:
                if tableau_id_dame[int(cpt_px)][int(cpt_my)][0]==0 and flag_mg==0:
                    tableau_id_deplacement.append(tableau_id_map[int(cpt_px)][int(cpt_my)])
                    Canva.itemconfigure(tableau_id_map[int(cpt_px)][int(cpt_my)], fill="blue")
                elif flag_mg==0: 
                    if tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]>=120 and tableau_id_dame[int(cpt_px)][int(cpt_my)][0]<=120:
                        bd_dame(cpt_px,cpt_my)
                    elif tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]<=120 and tableau_id_dame[int(cpt_px)][int(cpt_my)][0]>=120:
                       bd_dame(cpt_px,cpt_my)
                    flag_mg=1
        #collonne de droite 
        if cpt_mx >= 0 and i>0:
            if cpt_py<=9:
                if tableau_id_dame[int(cpt_mx)][int(cpt_py)][0]==0 and flag_pd==0:
                    tableau_id_deplacement.append(tableau_id_map[int(cpt_mx)][int(cpt_py)])
                    Canva.itemconfigure(tableau_id_map[int(cpt_mx)][int(cpt_py)], fill="blue")
                elif flag_pd==0: 
                    if tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]>=120 and tableau_id_dame[int(cpt_mx)][int(cpt_py)][0]<=120:
                        hg_dame(cpt_mx,cpt_py)
                    elif tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]<=120 and tableau_id_dame[int(cpt_mx)][int(cpt_py)][0]>=120:
                       hg_dame(cpt_mx,cpt_py)
                    flag_pd=1
            if cpt_my>=0:
                if tableau_id_dame[int(cpt_mx)][int(cpt_my)][0]==0 and flag_md==0:
                    tableau_id_deplacement.append(tableau_id_map[int(cpt_mx)][int(cpt_my)])
                    Canva.itemconfigure(tableau_id_map[int(cpt_mx)][int(cpt_my)], fill="blue")
                elif flag_md==0:
                    if tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]>=120 and tableau_id_dame[int(cpt_mx)][int(cpt_my)][0]<=120:
                        hd_dame(cpt_mx,cpt_my)
                    elif tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]<=120 and tableau_id_dame[int(cpt_mx)][int(cpt_my)][0]>=120:
                       hd_dame(cpt_mx,cpt_my)
                    flag_md=1
                    
        cpt_py+=1
        cpt_my-=1
        cpt_px+=1
        cpt_mx-=1
def case_possible(n_case,sens):
    global ligne_centre,colonne_centre,flag_click,flag_joueur
    if n_case==1:
        #elif egale saut
      
        if 9>=colonne_centre+sens>=0:     
           
            if tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre+sens)][0]==0:
                if flag_ia_joue==0 or flag_joueur<2:
                    Canva.itemconfigure(tableau_id_map[int(ligne_centre+sens)][int(colonne_centre+sens)], fill="blue") 
                tableau_id_deplacement.append(int(tableau_id_map[int(ligne_centre+sens)][int(colonne_centre+sens)]))
            elif tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre+sens)][0]>120 and sens==1 or tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre+sens)][0]<=120 and sens==-1:
               
                if 0< colonne_centre+sens<9 and 0< ligne_centre+sens<9:
                    
                    if tableau_id_dame[int(ligne_centre+(2*sens))][int(colonne_centre+(2*sens))][0]==0:
                        if flag_ia_joue==0 or flag_joueur<2:
                            Canva.itemconfigure(tableau_id_map[int(ligne_centre+(2*sens))][int(colonne_centre+(2*sens))], fill="blue") 
                        tableau_id_deplacement.append(int(tableau_id_map[int(ligne_centre+(2*sens))][int(colonne_centre+(2*sens))]))
            
        if 0<=colonne_centre-sens<=9 : 
           
            if tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre-sens)][0]==0:
                tableau_id_deplacement.append(int(tableau_id_map[int(ligne_centre+sens)][int(colonne_centre-sens)]))
                if flag_ia_joue==0 or flag_joueur<2:
                    Canva.itemconfigure(tableau_id_map[int(ligne_centre+sens)][int(colonne_centre-sens)], fill="blue")
            elif tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre-sens)][0]>120 and sens==1  or tableau_id_dame[int(ligne_centre+sens)][int(colonne_centre-sens)][0]<=120 and sens==-1 :
                if 0<colonne_centre-sens<9 and 0< ligne_centre+sens<9:
                    if tableau_id_dame[int(ligne_centre+(2*sens))][int(colonne_centre-(2*sens))][0]==0:
                        if flag_ia_joue==0 or flag_joueur<2:
                            Canva.itemconfigure(tableau_id_map[int(ligne_centre+(2*sens))][int(colonne_centre-(2*sens))], fill="blue") 
                            
                        tableau_id_deplacement.append(int(tableau_id_map[int(ligne_centre+(2*sens))][int(colonne_centre-(2*sens))]))
                    
    else:
        case_possible_dame()
    flag_click=1
def selection(evt):
    global flag_joueur,ligne_centre,colonne_centre
    global direction_pion
    #trouve la case 
    colonne, ligne =curseur_souris(evt)
    ligne_centre=ligne
    colonne_centre=colonne
    #un pion?
    if tableau_id_dame[int(ligne)][int(colonne)][0] !=0:
        
        
        Canva.itemconfigure(tableau_id_map[int(ligne)][int(colonne)], fill="green")
        # savoir si c'est un pion du joueur1
        if tableau_id_dame[int(ligne)][int(colonne)][1]=='p' and tableau_id_dame[int(ligne)][int(colonne)][0]>120:
            direction_pion=-1
            
            case_possible(1,direction_pion)
        elif tableau_id_dame[int(ligne)][int(colonne)][1]=='p':
            direction_pion=1
            case_possible(1,direction_pion)
        else:
            
            case_possible(2,0)
def deplacement(evt):
    global tableau_id_deplacement
    global ligne_centre,colonne_centre,flag_joueur
    global flag_click
    colonne, ligne =curseur_souris(evt)
    
    for id in tableau_id_deplacement:
         
         if id == tableau_id_map[int(ligne)][int(colonne)]:
            for id2 in tableau_id_deplacement:
                Canva.itemconfigure(id2,fill="black")
            #ia
            col_result=colonne-colonne_centre
            lig_result=ligne-ligne_centre
            
            #deplacement
            if abs(col_result)==2:
                Canva.delete(tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][0])
          
                tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][0]=0
                tableau_id_dame[int(ligne_centre+(lig_result/2))][int(colonne_centre+(col_result/2))][1]=0
            if abs(col_result)>2:
                x=-col_result/abs(col_result)
                y=-lig_result/abs(lig_result)
                Canva.delete(tableau_id_dame[int(ligne+y)][int(colonne+x)][0])
                tableau_id_dame[int(ligne+y)][int(colonne+x)][0]=0
                tableau_id_dame[int(ligne+y)][int(colonne+x)][1]=0

            Canva.move(tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0],col_result*50,lig_result*50)
            Canva.tag_raise(tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0])
            flag_click=0
            tableau_id_deplacement=[]
            #affichage 
            Canva.itemconfigure(tableau_id_map[int(ligne_centre)][int(colonne_centre)], fill="black")
       
            # changer la case
            cpt=tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]
            tableau_id_dame[int(ligne_centre)][int(colonne_centre)][0]=0
            d= tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]
            tableau_id_dame[int(ligne_centre)][int(colonne_centre)][1]=0
            tableau_id_dame[int(ligne)][int(colonne)][0]=cpt  
            if (ligne==0 or ligne==9) or d=='d':
                tableau_id_dame[int(ligne)][int(colonne)][1]='d'
            else:
                tableau_id_dame[int(ligne)][int(colonne)][1]='p'
          
            
            return 0
    flag_joueur=flag_joueur-1 
             
def joueur1(evt):
    global flag_click,flag_joueur
    colonne, ligne =curseur_souris(evt)
    
    if flag_click==1:
       
        deplacement(evt)
    else:
        if tableau_id_dame[int(ligne)][int(colonne)][0]>120:
           
            selection(evt)
        else:
            
            flag_joueur=flag_joueur-1
def joueur2(evt):
    global flag_click,flag_joueur
    
    if flag_click==1:
        
        deplacement(evt)
    else:
        
        colonne, ligne =curseur_souris(evt)
        if tableau_id_dame[int(ligne)][int(colonne)][0]<=120:
            selection(evt)
        else:
            flag_joueur=flag_joueur-1
def jouer(evt):
    global flag_joueur,flag_ia_joue,flag_click

    if flag_joueur<2:
        flag_joueur=flag_joueur+1
       
        joueur1(evt)
    else:
        if flag_ia_joue==0:
            flag_joueur=flag_joueur+1
            joueur2(evt)
            if flag_joueur==4:
                flag_joueur=0
        else:
            coup_ordi()
        
        if flag_joueur==4:
            flag_click=0
            flag_joueur=0

    qui_gagne()
    
def create_map():
    #creation du damier et creation des tableau case et tableau id pion 
    changecolor=0
    for j in range(10):
        tab=[]
        tab_pion=[]
        for i in range(11):
            #couleur damier
            if changecolor==1:
                changecolor=0
                couleur = "#000000"
            else:
                changecolor=1
                couleur="#FFFFFF"
            if i<10: 
                id_case=Canva.create_rectangle(0+i*50,0+j*50,50+i*50,50+j*50,fill=couleur)
                tab.append(id_case)
 
                     
        tableau_id_map.append(tab)
   
    for j in range(10):

        tab_pion=[]
        for i in range(11):
            if changecolor==1:
                changecolor=0

            else:
                changecolor=1
            if changecolor==0:
                #dame
                if j<4 and i<10:
                    id_pion=Canva.create_oval(0+i*50,0+j*50,50+i*50,50+j*50, fill='red', outline='red')
                    tab_pion.append([id_pion,'p']) 
                elif j>5 and i<10:
                    id_pion=Canva.create_oval(0+i*50,0+j*50,50+i*50,50+j*50, fill='yellow', outline='red')
                    tab_pion.append([id_pion,'p'])    
                else:
                    tab_pion.append([0,0])   
            else:
                    tab_pion.append([0,0])  
        tableau_id_dame.append(tab_pion)
    Canva.pack()

def aide():
    win = Toplevel(root)
    var = StringVar()
    label = Label(win, textvariable=var, relief=RAISED)
    var.set("jeu de dames version TOM \n"
            "ma version des dames et un mélange de plusieur jeu de dame \n"
            "les regles sont les suivante\n"
            "- pas de multi prise \n"
            "- quand on clique sur un pion on doit le jouer"
            "-possibilite de manger ou non le pion adverse ")
    label.pack()

#--------------------------main
if __name__ == "__main__":

    root = Tk()
    Canva = Canvas(root,width=500,height=500)
    Canva.pack(side="top")    

    Canva.bind("<Button-1>", jouer)
   
    btn_lancer_partie=Button(root, text="lancer une partie ", width=20, height=5, command=create_map)
    cre_tableau()

    btn_aide=Button(root, text="aide ", width=20, height=5, command=aide)
    v     = IntVar ()
    case1 = Radiobutton (variable = v, value = 0,command=valeur_radio)
    case2 = Radiobutton (variable = v, value = 1,command=valeur_radio)
    case2.config (text = "IA")
    case1.config (text = "joueur2")


    btn_lancer_partie.pack(side="left") 
    btn_aide.pack(side="left") 
    case1.pack()
    case2.pack()
    
    root.mainloop()