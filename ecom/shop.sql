/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  06/05/2020 23:18:30                      */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists CATEGORIE;

drop table if exists CLIENT;

drop table if exists COMMANDE;

drop table if exists CONTENIR;

drop table if exists CONTIENT;

drop table if exists PANIER_FIXE;

drop table if exists PAYEMENT;

drop table if exists PRODUIT;

drop table if exists TYPE_PAYEMENT;

/*==============================================================*/
/* Table : ADMIN                                                */
/*==============================================================*/
create table ADMIN
(
   MATRICULE            varchar(250) not null,
   PASSWORD             varchar(250),
   primary key (MATRICULE)
);

/*==============================================================*/
/* Table : CATEGORIE                                            */
/*==============================================================*/
create table CATEGORIE
(
   ID_CAT               int not null,
   MATRICULE            varchar(250) not null,
   DESC_cat               varchar(250),
   primary key (ID_CAT)
);

/*==============================================================*/
/* Table : CLIENT                                               */
/*==============================================================*/
create table CLIENT
(
   ID                   int not null,
   NOM                  varchar(250),
   PRENOM               varchar(250),
   EMAIL                varchar(250),
   PASSWORD             varchar(250),
   primary key (ID)
);

/*==============================================================*/
/* Table : COMMANDE                                             */
/*==============================================================*/
create table COMMANDE
(
   ID_COMMANDE          int not null,
   ID                   varchar(250) not null,
   DATE_COMMANDE        timestamp,
   primary key (ID_COMMANDE)
);

/*==============================================================*/
/* Table : CONTENIR                                             */
/*==============================================================*/
create table CONTENIR
(
   ID_PRD               int not null,
   ID_COMMANDE          int not null,
   QTE                  float,
   primary key (ID_PRD, ID_COMMANDE)
);

/*==============================================================*/
/* Table : CONTIENT                                             */
/*==============================================================*/
create table CONTIENT
(
   ID_PRD               int not null,
   ID_PANIER            int not null,
   QTE_PRODUIT          float,
   primary key (ID_PRD, ID_PANIER)
);

/*==============================================================*/
/* Table : PANIER_FIXE                                          */
/*==============================================================*/
create table PANIER_FIXE
(
   ID_PANIER            int not null,
   ID_COMMANDE          int not null,
   MATRICULE            varchar(250) not null,
   DATE_PANIER          date,
   primary key (ID_PANIER)
);

/*==============================================================*/
/* Table : PAYEMENT                                             */
/*==============================================================*/
create table PAYEMENT
(
   ID_PAYMENT           int not null,
   ID_PAYEMENT          int not null,
   ID                   varchar(250) not null,
   NUM_CART             int,
   DATE_EXP             datetime,
   primary key (ID_PAYMENT)
);

/*==============================================================*/
/* Table : PRODUIT                                              */
/*==============================================================*/
create table PRODUIT
(
   ID_PRD               int not null,
   MATRICULE            varchar(250) not null,
   ID_CAT               int,
   NOM                  varchar(250),
   QTE_MAX              float,
   IMAGE                longblob,
   primary key (ID_PRD)
);

/*==============================================================*/
/* Table : TYPE_PAYEMENT                                        */
/*==============================================================*/
create table TYPE_PAYEMENT
(
   ID_PAYEMENT          int not null,
   DESC_pay               varchar(250),
   primary key (ID_PAYEMENT)
);

alter table CATEGORIE add constraint FK_CREER foreign key (MATRICULE)
      references ADMIN (MATRICULE) on delete restrict on update restrict;

-- alter table COMMANDE add constraint FK_PASSER foreign key (ID)
--       references CLIENT (ID) on delete restrict on update restrict;

alter table CONTENIR add constraint FK_CONTENIR foreign key (ID_PRD)
      references PRODUIT (ID_PRD) on delete restrict on update restrict;

alter table CONTENIR add constraint FK_CONTENIR2 foreign key (ID_COMMANDE)
      references COMMANDE (ID_COMMANDE) on delete restrict on update restrict;

alter table CONTIENT add constraint FK_CONTIENT foreign key (ID_PRD)
      references PRODUIT (ID_PRD) on delete restrict on update restrict;

alter table CONTIENT add constraint FK_CONTIENT2 foreign key (ID_PANIER)
      references PANIER_FIXE (ID_PANIER) on delete restrict on update restrict;

alter table PANIER_FIXE add constraint FK_CONSTITUER foreign key (ID_COMMANDE)
      references COMMANDE (ID_COMMANDE) on delete restrict on update restrict;

alter table PANIER_FIXE add constraint FK_CREER_PANIER foreign key (MATRICULE)
      references ADMIN (MATRICULE) on delete restrict on update restrict;


-- alter table PAYEMENT add constraint FK_EFFECTUER foreign key (ID)
--       references CLIENT (ID) on delete restrict on update restrict;

alter table PAYEMENT add constraint FK_REGLER foreign key (ID_PAYEMENT)
      references TYPE_PAYEMENT (ID_PAYEMENT) on delete restrict on update restrict;

alter table PRODUIT add constraint FK_AJOUTE foreign key (MATRICULE)
      references ADMIN (MATRICULE) on delete restrict on update restrict;

alter table PRODUIT add constraint FK_APPARTIENT foreign key (ID_CAT)
      references CATEGORIE (ID_CAT) on delete restrict on update restrict;



-- Update Images 
UPDATE `produit` SET IMAGE = LOAD_FILE('C:/xampp/htdocs/Brief9-master/images/ .jpg') where `ID_PRD` = 2