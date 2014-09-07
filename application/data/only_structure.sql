/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     07.09.2014 19:46:47                          */
/*==============================================================*/


drop table activity_feed;

drop table authority;

drop table authority_property;

drop table authority_status;

drop table comment;

drop table event_type;

drop table files;

drop table history_log;

drop table organization;

drop table organization_rank;

drop table property;

drop table property_format;

drop table service;

drop table service_property;

drop table service_type;

drop table spher;

drop table users;

/*==============================================================*/
/* Table: activity_feed                                         */
/*==============================================================*/
create table activity_feed (
   id_activity_feed     SERIAL not null,
   id_organization      INT4                 null,
   id_event_type        INT4                 null,
   "time"               TIMESTAMP            null,
   message              TEXT                 null,
   constraint PK_ACTIVITY_FEED primary key (id_activity_feed)
);

/*==============================================================*/
/* Table: authority                                             */
/*==============================================================*/
create table authority (
   id_authority         SERIAL not null,
   id_organization      INT4                 null,
   id_authority_status  INT4                 null,
   authority_name       VARCHAR(1024)        null,
   constraint PK_AUTHORITY primary key (id_authority)
);

/*==============================================================*/
/* Table: authority_property                                    */
/*==============================================================*/
create table authority_property (
   id_authority_property SERIAL not null,
   id_property          INT4                 null,
   id_authority         INT4                 null,
   value                TEXT                 null,
   constraint PK_AUTHORITY_PROPERTY primary key (id_authority_property)
);

/*==============================================================*/
/* Table: authority_status                                      */
/*==============================================================*/
create table authority_status (
   id_authority_status  SERIAL not null,
   name                 VARCHAR(512)         null,
   constraint PK_AUTHORITY_STATUS primary key (id_authority_status)
);

/*==============================================================*/
/* Table: comment                                               */
/*==============================================================*/
create table comment (
   id_comment           SERIAL not null,
   id_authority         INT4                 null,
   id_user              INT4                 null,
   com_id_comment       INT4                 null,
   message              TEXT                 null,
   "time"               TIMESTAMP            null,
   constraint PK_COMMENT primary key (id_comment)
);

/*==============================================================*/
/* Table: event_type                                            */
/*==============================================================*/
create table event_type (
   id_event_type        SERIAL not null,
   event_type_name      VARCHAR(2048)        null,
   constraint PK_EVENT_TYPE primary key (id_event_type)
);

/*==============================================================*/
/* Table: files                                                 */
/*==============================================================*/
create table files (
   id_file              SERIAL not null,
   id_comment           INT4                 null,
   id_authority         INT4                 null,
   name                 VARCHAR(1024)        null,
   file_name            VARCHAR(1024)        null,
   constraint PK_FILES primary key (id_file)
);

/*==============================================================*/
/* Table: history_log                                           */
/*==============================================================*/
create table history_log (
   id_history_log       SERIAL not null,
   id_service_property  INT4                 null,
   id_organization      INT4                 null,
   "old"                TEXT                 null,
   "new"                TEXT                 null,
   "time"               TIMESTAMP            null,
   constraint PK_HISTORY_LOG primary key (id_history_log)
);

/*==============================================================*/
/* Table: organization                                          */
/*==============================================================*/
create table organization (
   id_organization      SERIAL not null,
   id_organization_rank INT4                 null,
   organization_name    VARCHAR(1024)        null,
   constraint PK_ORGANIZATION primary key (id_organization)
);

/*==============================================================*/
/* Table: organization_rank                                     */
/*==============================================================*/
create table organization_rank (
   id_organization_rank SERIAL not null,
   organization_rank    VARCHAR(1024)        null,
   constraint PK_ORGANIZATION_RANK primary key (id_organization_rank)
);

/*==============================================================*/
/* Table: property                                              */
/*==============================================================*/
create table property (
   id_property          SERIAL not null,
   id_property_type     INT4                 null,
   id_service_type      INT4                 null,
   property_name        VARCHAR(1024)        null,
   code                 VARCHAR(1024)        null,
   options              VARCHAR(2048)        null,
   constraint PK_PROPERTY primary key (id_property)
);

/*==============================================================*/
/* Table: property_format                                       */
/*==============================================================*/
create table property_format (
   id_property_format   SERIAL not null,
   property_format_name VARCHAR(1024)        null,
   constraint PK_PROPERTY_FORMAT primary key (id_property_format)
);

/*==============================================================*/
/* Table: service                                               */
/*==============================================================*/
create table service (
   id_service           SERIAL not null,
   id_service_type      INT4                 null,
   id_authority_status  INT4                 null,
   id_authority         INT4                 null,
   service_name         VARCHAR(1024)        null,
   constraint PK_SERVICE primary key (id_service)
);

/*==============================================================*/
/* Table: service_property                                      */
/*==============================================================*/
create table service_property (
   id_service_property  SERIAL not null,
   id_property          INT4                 null,
   id_service           INT4                 null,
   value                TEXT                 null,
   constraint PK_SERVICE_PROPERTY primary key (id_service_property)
);

/*==============================================================*/
/* Table: service_type                                          */
/*==============================================================*/
create table service_type (
   id_service_type      SERIAL not null,
   service_type_name    VARCHAR(1024)        null,
   constraint PK_SERVICE_TYPE primary key (id_service_type)
);

/*==============================================================*/
/* Table: spher                                                 */
/*==============================================================*/
create table spher (
   id_spher             SERIAL not null,
   name                 TEXT                 null,
   constraint PK_SPHER primary key (id_spher)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users (
   id_user              SERIAL not null,
   id_organization      INT4                 null,
   user_name            VARCHAR(1024)        null,
   password             VARCHAR(64)          null,
   constraint PK_USERS primary key (id_user)
);

alter table activity_feed
   add constraint FK_ACTIVITY_REFERENCE_ORGANIZA foreign key (id_organization)
      references organization (id_organization)
      on delete restrict on update restrict;

alter table activity_feed
   add constraint FK_ACTIVITY_REFERENCE_EVENT_TY foreign key (id_event_type)
      references event_type (id_event_type)
      on delete restrict on update restrict;

alter table authority
   add constraint FK_AUTHORIT_REFERENCE_AUTHORIT foreign key (id_authority_status)
      references authority_status (id_authority_status)
      on delete restrict on update restrict;

alter table authority
   add constraint FK_AUTHORIT_REFERENCE_ORGANIZA foreign key (id_organization)
      references organization (id_organization)
      on delete restrict on update restrict;

alter table authority_property
   add constraint FK_AUTHORIT_REFERENCE_PROPERTY foreign key (id_property)
      references property (id_property)
      on delete restrict on update restrict;

alter table authority_property
   add constraint FK_AUTHORIT_REFERENCE_AUTHORIT foreign key (id_authority)
      references authority (id_authority)
      on delete restrict on update restrict;

alter table comment
   add constraint FK_COMMENT_REFERENCE_AUTHORIT foreign key (id_authority)
      references authority (id_authority)
      on delete restrict on update restrict;

alter table comment
   add constraint FK_COMMENT_REFERENCE_USERS foreign key (id_user)
      references users (id_user)
      on delete restrict on update restrict;

alter table comment
   add constraint FK_COMMENT_REFERENCE_COMMENT foreign key (com_id_comment)
      references comment (id_comment)
      on delete restrict on update restrict;

alter table files
   add constraint FK_FILES_REFERENCE_COMMENT foreign key (id_comment)
      references comment (id_comment)
      on delete restrict on update restrict;

alter table files
   add constraint FK_FILES_REFERENCE_AUTHORIT foreign key (id_authority)
      references authority (id_authority)
      on delete restrict on update restrict;

alter table history_log
   add constraint FK_HISTORY__REFERENCE_SERVICE_ foreign key (id_service_property)
      references service_property (id_service_property)
      on delete restrict on update restrict;

alter table history_log
   add constraint FK_HISTORY__REFERENCE_ORGANIZA foreign key (id_organization)
      references organization (id_organization)
      on delete restrict on update restrict;

alter table organization
   add constraint FK_ORGANIZA_REFERENCE_ORGANIZA foreign key (id_organization_rank)
      references organization_rank (id_organization_rank)
      on delete restrict on update restrict;

alter table property
   add constraint FK_PROPERTY_REFERENCE_SERVICE_ foreign key (id_service_type)
      references service_type (id_service_type)
      on delete restrict on update restrict;

alter table property
   add constraint FK_PROPERTY_REFERENCE_PROPERTY foreign key (id_property_type)
      references property_format (id_property_format)
      on delete restrict on update restrict;

alter table service
   add constraint FK_SERVICE_45_AUTHORIT foreign key (id_authority_status)
      references authority_status (id_authority_status)
      on delete restrict on update restrict;

alter table service
   add constraint FK_SERVICE_REFERENCE_SERVICE_ foreign key (id_service_type)
      references service_type (id_service_type)
      on delete restrict on update restrict;

alter table service
   add constraint FK_SERVICE_REFERENCE_AUTHORIT foreign key (id_authority)
      references authority (id_authority)
      on delete restrict on update restrict;

alter table service_property
   add constraint FK_SERVICE__REFERENCE_PROPERTY foreign key (id_property)
      references property (id_property)
      on delete restrict on update restrict;

alter table service_property
   add constraint FK_SERVICE__REFERENCE_SERVICE foreign key (id_service)
      references service (id_service)
      on delete restrict on update restrict;

alter table users
   add constraint FK_USERS_REFERENCE_ORGANIZA foreign key (id_organization)
      references organization (id_organization)
      on delete restrict on update restrict;

