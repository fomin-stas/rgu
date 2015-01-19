/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     19.01.2015 11:36:32                          */
/*==============================================================*/


drop table additional_property CASCADE;

drop table additional_property_values CASCADE;

drop table pap CASCADE;

drop table spap CASCADE;

/*==============================================================*/
/* Table: additional_property                                   */
/*==============================================================*/
create table additional_property (
   id_additional_property SERIAL not null,
   id_property_format   INT4                 null,
   additional_property_name VARCHAR(1024)        null,
   constraint PK_ADDITIONAL_PROPERTY primary key (id_additional_property)
);

/*==============================================================*/
/* Table: additional_property_values                            */
/*==============================================================*/
create table additional_property_values (
   id_additional_property_values SERIAL not null,
   id_additional_property INT4                 null,
   value                TEXT                 null,
   constraint PK_ADDITIONAL_PROPERTY_VALUES primary key (id_additional_property_values)
);

/*==============================================================*/
/* Table: pap                                                   */
/*==============================================================*/
create table pap (
   id_pap               SERIAL not null,
   id_additional_property INT4                 null,
   id_property          INT4                 null,
   add_id_additional_property INT4                 null,
   id_additional_property_values INT4                 null,
   property_value_id    INT4                 null,
   constraint PK_PAP primary key (id_pap)
);

/*==============================================================*/
/* Table: spap                                                  */
/*==============================================================*/
create table spap (
   id_spap              SERIAL not null,
   id_service_property  INT4                 null,
   id_additional_property INT4                 null,
   id_pap               INT4                 null,
   value                TEXT                 null,
   constraint PK_SPAP primary key (id_spap)
);

alter table additional_property_values
   add constraint FK_ADDITION_REFERENCE_ADDITION foreign key (id_additional_property)
      references additional_property (id_additional_property)
      on delete cascade on update cascade;

alter table pap
   add constraint FK_PAP_REFERENCE_ADDITION_1 foreign key (id_additional_property)
      references additional_property (id_additional_property)
      on delete cascade on update cascade;

alter table pap
   add constraint FK_PAP_REFERENCE_ADDITION_2 foreign key (add_id_additional_property)
      references additional_property (id_additional_property)
      on delete cascade on update cascade;

alter table pap
   add constraint FK_PAP_REFERENCE_ADDITION_3 foreign key (id_additional_property_values)
      references additional_property_values (id_additional_property_values)
      on delete cascade on update cascade;

alter table spap
   add constraint FK_SPAP_REFERENCE_ADDITION foreign key (id_additional_property)
      references additional_property (id_additional_property)
      on delete cascade on update cascade;

alter table spap
   add constraint FK_SPAP_REFERENCE_PAP foreign key (id_pap)
      references pap (id_pap)
      on delete cascade on update cascade;

