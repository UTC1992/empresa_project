/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     02/11/2017 14:26:34                          */
/*==============================================================*/


/*==============================================================*/
/* Table: CONSOLIDADO                                           */
/*==============================================================*/
create table tbl_consolidado
(
   id_cons              int(5) not null auto_increment,
   n9cono               varchar(60),
   n9cocu               varchar(60),
   n9cose               varchar(60),
   n9coru               varchar(60),
   n9meco               varchar(60),
   n9feco               varchar(60),
   n9leco               varchar(60),
   n9cocl               varchar(60),
   n9nomb               varchar(200),
   n9refe               varchar(300),
   n9fecl               varchar(60),
   n9lect               varchar(60),
   n9cobs               varchar(60),
   cucoon               varchar(60),
   cucooe               varchar(60),
   createddato          varchar(60),
   updatedato           varchar(60),
   primary key (id_cons)
);


