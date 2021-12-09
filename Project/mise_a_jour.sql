/** ============================================== 

                    MISES A JOURS

    ============================================== **/ 

/** =============== SUR LES VELOS =============== **/

/** AJOUT VELO **/
CALL ajout_velo(p_reference VARCHAR(100), p_marque VARCHAR(100), p_kilometrage FLOAT, p_etat VARCHAR(100), p_batterie INT, p_id_station INT);

/** SUPPRESSION VELO **/
CALL suppression_velo(p_id_velo INT);

/** DEPLACER VELO **/
CALL deplacement_velo(p_id_velo INT, p_id_station INT);

/** RECHARGER BATTERIE **/
CALL recharge_batterie(p_id_velo INT, p_batterie INT)


/** =============== SUR LES UTILISATIONS =============== **/

/** SUPPRIMER UTILISATION **/
CALL delete_utilisation(p_id_utilisation INT);

/** =============== SUR LES ADHERENTS =============== **/

/** FIN ADHESION **/
CALL fin_adhesion(p_id_adherent INT);

/** SUPPRESSION ADHERENT **/
CALL delete_adherent(p_id_adherent INT);


