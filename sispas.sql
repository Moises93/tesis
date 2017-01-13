/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10-01-2017 20:12:27                          */
/*==============================================================*/


/*==============================================================*/
/* Table: empresa                                               */
/*==============================================================*/
create table empresa
(
   emp_rif              int not null,
   emp_nombre           varchar(255),
   emp_pais             varchar(100),
   emp_region           varchar(100),
   emp_ciudad           varchar(100),
   emp_direccion        varchar(300),
   emp_sector           varchar(100),
   id_usuario           int,
   primary key (emp_rif)
);

/*==============================================================*/
/* Table: escuela                                               */
/*==============================================================*/
create table escuela
(
   id_escuela           bigint not null,
   esc_nombre           varchar(20),
   primary key (id_escuela)
);

/*==============================================================*/
/* Table: habilidad                                             */
/*==============================================================*/
create table habilidad
(
   id_habilidad         bigint not null,
   descripcion          varchar(1),
   id_escuela           bigint,
   primary key (id_habilidad)
);

/*==============================================================*/
/* Table: habilidad_empresa                                     */
/*==============================================================*/
create table habilidad_empresa
(
   emp_rif              int,
   id_habilidad         bigint
);

/*==============================================================*/
/* Table: habilidad_pasante                                     */
/*==============================================================*/
create table habilidad_pasante
(
   pa_cedula            int,
   id_habilidad         bigint
);

/*==============================================================*/
/* Table: pasante                                               */
/*==============================================================*/
create table pasante
(
   pa_cedula            int not null,
   pa_nombre            varchar(255),
   pa_apellido          varchar(255),
   pa_sexo              char(1),
   id_usuario           int,
   id_escuela           bigint,
   primary key (pa_cedula)
);

/*==============================================================*/
/* Table: pasantia                                              */
/*==============================================================*/
create table pasantia
(
   id_pasantia          int not null,
   estatus              char(2),
   fecha_inicio         datetime,
   fecha_final          datetime,
   modalidad            varchar(20),
   emp_rif              int,
   pa_cedula            int,
   pro_cedula           int,
   te_nombre            bigint,
   primary key (id_pasantia)
);

/*==============================================================*/
/* Table: profesor                                              */
/*==============================================================*/
create table profesor
(
   pro_cedula           int not null,
   pro_nombre           varchar(255),
   pro_apellido         varchar(255),
   pro_sexo             char(1),
   pro_tipos            bigint,
   id_usuario           int,
   id_escuela           bigint,
   primary key (pro_cedula)
);

/*==============================================================*/
/* Table: tutor_empresarial                                     */
/*==============================================================*/
create table tutor_empresarial
(
   te_nombre            bigint not null,
   te_cargo             varchar(200),
   te_profesion         varchar(1),
   emp_rif              int,
   primary key (te_nombre)
);

/*==============================================================*/
/* Table: usuario                                               */
/*==============================================================*/
create table usuario
(
   id_usuario           int not null,
   login                varchar(200),
   clave                varchar(200),
   estatus              bigint,
   primary key (id_usuario)
);

/*==============================================================*/
/* Table: valoracion                                            */
/*==============================================================*/
create table valoracion
(
   id_valoracion        bigint,
   valoracion           bigint,
   comentarios          varchar(300),
   tipo                 char(1),
   id_pasantia          int
);

alter table empresa add constraint fk_reference_3 foreign key (id_usuario)
      references usuario (id_usuario) on delete restrict on update restrict;

alter table habilidad add constraint fk_reference_8 foreign key (id_escuela)
      references escuela (id_escuela) on delete restrict on update restrict;

alter table habilidad_empresa add constraint fk_reference_11 foreign key (emp_rif)
      references empresa (emp_rif) on delete restrict on update restrict;

alter table habilidad_empresa add constraint fk_reference_12 foreign key (id_habilidad)
      references habilidad (id_habilidad) on delete restrict on update restrict;

alter table habilidad_pasante add constraint fk_reference_10 foreign key (pa_cedula)
      references pasante (pa_cedula) on delete restrict on update restrict;

alter table habilidad_pasante add constraint fk_reference_9 foreign key (id_habilidad)
      references habilidad (id_habilidad) on delete restrict on update restrict;

alter table pasante add constraint fk_reference_1 foreign key (id_usuario)
      references usuario (id_usuario) on delete restrict on update restrict;

alter table pasante add constraint fk_reference_13 foreign key (id_escuela)
      references escuela (id_escuela) on delete restrict on update restrict;

alter table pasantia add constraint fk_reference_16 foreign key (te_nombre)
      references tutor_empresarial (te_nombre) on delete restrict on update restrict;

alter table pasantia add constraint fk_reference_4 foreign key (pa_cedula)
      references pasante (pa_cedula) on delete restrict on update restrict;

alter table pasantia add constraint fk_reference_5 foreign key (pro_cedula)
      references profesor (pro_cedula) on delete restrict on update restrict;

alter table pasantia add constraint fk_reference_6 foreign key (emp_rif)
      references empresa (emp_rif) on delete restrict on update restrict;

alter table profesor add constraint fk_reference_14 foreign key (id_escuela)
      references escuela (id_escuela) on delete restrict on update restrict;

alter table profesor add constraint fk_reference_2 foreign key (id_usuario)
      references usuario (id_usuario) on delete restrict on update restrict;

alter table tutor_empresarial add constraint fk_reference_15 foreign key (emp_rif)
      references empresa (emp_rif) on delete restrict on update restrict;

alter table valoracion add constraint fk_reference_7 foreign key (id_pasantia)
      references pasantia (id_pasantia) on delete restrict on update restrict;

