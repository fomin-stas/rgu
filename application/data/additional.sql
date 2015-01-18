drop table additional_property;

drop table pap;

drop table spap;

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
/* Table: pap                                                   */
/*==============================================================*/
create table pap (
   id_pap               SERIAL not null,
   id_additional_property INT4                 null,
   parent_id_property   INT4                 null,
   parent_id_additional_property INT4                 null,
   parent_id_spap       INT4                 null,
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



alter table pap
   add constraint FK_PAP_REFERENCE_ADDITION_2 foreign key (id_additional_property)
      references additional_property (id_additional_property)
      on delete cascade on update cascade;

alter table pap
   add constraint FK_PAP_REFERENCE_ADDITION foreign key (parent_id_additional_property)
      references additional_property (id_additional_property)
      on delete restrict on update restrict;

alter table pap
   add constraint FK_PAP_REFERENCE_SPAP foreign key (parent_id_spap)
      references spap (id_spap)
      on delete restrict on update restrict;


alter table spap
   add constraint FK_SPAP_REFERENCE_ADDITION foreign key (id_additional_property)
      references additional_property (id_additional_property)
      on delete restrict on update restrict;

alter table spap
   add constraint FK_SPAP_REFERENCE_PAP foreign key (id_pap)
      references pap (id_pap)
      on delete restrict on update restrict;

