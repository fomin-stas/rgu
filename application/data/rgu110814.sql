--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: auto_id_users; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE auto_id_users
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auto_id_users OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: activity_feed; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE activity_feed (
    id_activity_feed integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_organization integer,
    id_event_type integer,
    "time" timestamp without time zone,
    message text
);


ALTER TABLE public.activity_feed OWNER TO postgres;

--
-- Name: authority; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority (
    id_authority integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_organization integer,
    id_authority_status integer,
    authority_name character varying(1024)
);


ALTER TABLE public.authority OWNER TO postgres;

--
-- Name: authority_property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_property (
    id_authority_property integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_property integer,
    id_authority integer,
    value text
);


ALTER TABLE public.authority_property OWNER TO postgres;

--
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comment (
    id_comment integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_authority integer,
    id_organization integer,
    message text,
    "time" timestamp without time zone
);


ALTER TABLE public.comment OWNER TO postgres;

--
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- Name: files; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE files (
    id_file integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_comment integer,
    name character varying(1024),
    file_name character varying(1024)
);


ALTER TABLE public.files OWNER TO postgres;

--
-- Name: history_log; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE history_log (
    id_history_log integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_service_property integer,
    id_organization integer,
    old text,
    new text,
    "time" timestamp without time zone
);


ALTER TABLE public.history_log OWNER TO postgres;

--
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- Name: property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property (
    id_property integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_property_type integer,
    id_service_type integer,
    property_name character varying(1024),
    code character varying(512),
    options text
);


ALTER TABLE public.property OWNER TO postgres;

--
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- Name: service; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service (
    id_service integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_service_type integer,
    id_authority_status integer,
    id_authority integer,
    service_name character varying(1024)
);


ALTER TABLE public.service OWNER TO postgres;

--
-- Name: service_property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_property (
    id_service_property integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_property integer,
    id_service integer,
    value text
);


ALTER TABLE public.service_property OWNER TO postgres;

--
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id_user integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_organization integer,
    user_name character varying(1024),
    password character varying(64)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY activity_feed (id_activity_feed, id_organization, id_event_type, "time", message) FROM stdin;
\.


--
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority (id_authority, id_organization, id_authority_status, authority_name) FROM stdin;
4564566	22	1	Разрабатывать и утверждать схему и программу развития электроэнергетики Санкт-Петербурга
4564565	22	1	Обеспечивает реализацию программы развития конкуренции в Российской Федерации в соответствии с компетенцией Комитета и разрабатывает региональную программу развития конкуренции в Санкт-Петербурге
4564564	22	1	Взаимодействует в установленном порядке по вопросам своей компетенции с органами государственной власти, органами местного самоуправления, иными государственными и негосударственными организациями, а также должностными лицами.
4564567	22	2	Обеспечивать в пределах компетенции Комитета выполнение федеральных программ, в реализации которых участвует Санкт-Петербург, а также программ развития Санкт-Петербурга.
15	48	1	Примерное
16	48	1	Примерное
17	48	1	Примерное
18	48	1	Примерное
19	48	1	Примерное
\.


--
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_property (id_authority_property, id_property, id_authority, value) FROM stdin;
13	13	4564566	kjhjkhkjhkj
14	13	4564566	kjhjkhkjhkj
20	7	19	2342345
21	10	19	Администрация Пушкинского района Санкт-Петербурга
22	72	19	24-08-2014
\.


--
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_status (id_authority_status, name) FROM stdin;
4	Исполняется
1	На разграничении
12	На согласовании разграничения
2	Разграничение согласовано (разработка АР)
\.


--
-- Name: auto_id_users; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('auto_id_users', 22, true);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comment (id_comment, id_authority, id_organization, message, "time") FROM stdin;
\.


--
-- Data for Name: event_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY event_type (id_event_type, event_type_name) FROM stdin;
5	Измненение статуса полномочия
\.


--
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY files (id_file, id_comment, name, file_name) FROM stdin;
\.


--
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY history_log (id_history_log, id_service_property, id_organization, old, new, "time") FROM stdin;
\.


--
-- Data for Name: organization; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization (id_organization, id_organization_rank, organization_name) FROM stdin;
1	1	Администратор
2	1	Комитет по информатизации и связи
3	1	Юридический комитет
4	1	Администрация Василеостровского района Санкт-Петербурга
5	1	Администрация Выборгского района Санкт-Петербурга
6	1	Администрация Калининского района Санкт-Петербурга
8	1	Администрация Колпинского района Санкт-Петербурга
7	1	Администрация Кировского района Санкт-Петербурга
9	1	Администрация Красногвардейского района Санкт-Петербурга
10	1	Администрация Красносельского района Санкт-Петербурга
11	1	Администрация Кронштадтcкого района Санкт-Петербурга
12	1	Администрация Курортного района Санкт-Петербурга
13	1	Администрация Московского района Санкт-Петербурга
14	1	Администрация Невского района Санкт-Петербурга
15	1	Администрация Петроградского района Санкт-Петербурга
16	1	Администрация Петродворцового района Санкт-Петербурга
17	1	Администрация Приморского района Санкт-Петербурга
18	1	Администрация Пушкинского района Санкт-Петербурга
19	1	Администрация Фрунзенского района Санкт-Петербурга
20	1	Администрация Центрального района Санкт-Петербурга
21	1	Администрация Адмиралтейского района Санкт-Петербурга
22	1	Архивный комитет
23	1	Государственная административно-техническая инспекция
24	1	Государственная инспекция Санкт-Петербурга по надзору за техническим состоянием самоходных машин и других видов техники
25	1	Жилищный комитет
26	1	Комитет по градостроительству и архитектуре
27	1	Комитет по благоустройству Санкт-Петербурга
28	1	Комитет по вопросам законности, правопорядка и безопасности
29	1	Комитет по государственному контролю, использованию и охране памятников истории и культуры
30	1	Комитет по делам записи актов гражданского состояния
31	1	Комитет по здравоохранению
32	1	Комитет по земельным ресурсам и землеустройству
33	1	Комитет по инвестициям Санкт-Петербурга
34	1	Комитет по информатизации и связи
35	1	Комитет по культуре
36	1	Комитет по молодежной политике и взаимодействию с общественными организациями
37	1	Комитет по науке и высшей школе
38	1	Комитет по образованию
39	1	Комитет по печати и взаимодействию со средствами массовой информации
40	1	Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности
41	1	Комитет по развитию транспортной инфраструктуры Санкт-Петербурга
42	1	Комитет по социальной политике Санкт-Петербурга
43	1	Комитет по строительству
44	1	Комитет по тарифам Санкт-Петербурга
45	1	Комитет по транспорту
46	1	Комитет по труду и занятости населения
47	1	Комитет по управлению городским имуществом
48	1	Комитет по физической культуре и спорту
49	1	Комитет по энергетике и инженерному обеспечению
50	1	Комитет по развитию предпринимательства и потребительского рынка Санкт-Петербурга
51	1	Служба государственного строительного надзора и экспертизы Санкт-Петербурга
52	1	Управление социального питания
53	1	Управление ветеринарии
54	1	Комитет по промышленной политике и инновациям Санкт-Петербурга
55	1	Государственная жилищная инспекция Санкт-Петербурга
56	1	Комитет по развитию туризма Санкт-Петербурга
57	1	КРИОГВ
\.


--
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization_rank (id_organization_rank, organization_rank) FROM stdin;
1	1
\.


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property (id_property, id_property_type, id_service_type, property_name, code, options) FROM stdin;
1	3	\N	РЕЕСТР	\N	\N
2	4	\N	РЕЕСТР Период внесения изменений	\N	\N
3	2	\N	Внесены изменения в Положение об ИОГВ	\N	\N
4	2	\N	Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)	\N	\N
5	2	\N	Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)	\N	\N
6	2	\N	Полномочие осуществляется с использованием ИС	\N	\N
8	3	\N	Статус исполняемости	\N	\N
12	1	\N	Статус согласования статуса полномочия	\N	\N
14	1	\N	id государственной услуги/функции	\N	\N
15	1	\N	Статус разработки услуги/функции	\N	\N
16	2	\N	Наименование государственной функций (услуги) в соответствии с административным регламентом	\N	\N
17	3	\N	Тип	\N	\N
18	3	\N	субъект предоставления услуг (физ/юр)	\N	\N
19	2	\N	№ пункта Плана-графика 2013	\N	\N
20	4	\N	План-график 2013 (срок исполнения)	\N	\N
21	2	\N	План-график 2013 (требуется внесение изменений)	\N	\N
22	2	\N	Продление срока по Плану 2013	\N	\N
23	2	\N	Основание для продления срока по Плану 2013	\N	\N
24	2	\N	Исключение из Плана 2013	\N	\N
25	2	\N	Основание для исключения из Плана 2013	\N	\N
26	3	\N	План 2013 исполнен	\N	\N
27	2	\N	№ пункта Плана-графика 2014	\N	\N
28	4	\N	Срок исполнения План-графика 2014	\N	\N
29	2	\N	Основание для включения услуги в План-график 2014	\N	\N
30	2	\N	Мониторинг в 2014 году	\N	\N
31	2	\N	Проведен мониторинг в 2013 году	\N	\N
32	3	\N	Услуга включена в дорожную карту ИОГВ	\N	\N
33	2	\N	% удовлетворенности заявителей по услуге\n	\N	\N
34	2	\N	№ пункта Плана-графика 2012	\N	\N
35	3	\N	План-график 2012 (месяц)	\N	\N
36	2	\N	План-график 2012 Внесение изменений в АР	\N	\N
37	2	\N	Продление срока	\N	\N
38	2	\N	Исключение из Плана 2012	\N	\N
39	2	\N	Основание для исключения	\N	\N
40	3	\N	ПГ 2012 исполнен	\N	\N
41	2	\N	1593	\N	\N
42	2	\N	1593 (ред. от 20.09.2012)	\N	\N
43	2	\N	Внесение изменений в 1593	\N	\N
44	2	\N	Реквизиты соглашения	\N	\N
45	2	\N	Дата начала предоставления услуги в МФЦ	\N	\N
46	2	\N	Реализация в МАИС ЭГУ	\N	\N
47	2	\N	8-рп	\N	\N
48	2	\N	Внесение изменений в 8-рп	\N	\N
49	2	\N	Реализация по ГК в 2014 году	\N	\N
50	2	\N	11-рп от 13.03.2014	\N	\N
51	5	\N	этап предоставления на Портале	\N	\N
52	3	\N	Возможность выдачи результата в электронном виде	\N	\N
53	2	\N	УЭК	\N	\N
54	2	\N	Реализация на портале (Ростелеком)	\N	\N
55	2	\N	Актуализация по ЕПГУ	\N	\N
56	2	\N	1993-р	\N	\N
57	6	\N	729-р	\N	\N
58	3	\N	реализация в электронном виде	\N	\N
59	2	\N	51-рп	\N	\N
60	2	\N	Внесение изменений в 51-рп	\N	\N
61	2	\N	ТКМВ (реквизиты  протокола РГ МИВ)	\N	\N
62	2	\N	ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)	\N	\N
63	2	\N	КАР	\N	\N
64	2	\N	Административный регламент утвержден распоряжением ИОГВ	\N	\N
65	2	\N	Реквизиты нормативных правовых актов изменений в АР	\N	\N
66	3	\N	Возмездная / Безвозмездная государственная услуга	\N	\N
67	2	\N	Сумма госпошлины	\N	\N
68	2	\N	Количество взаимодействий ЮЛ и ИОГВ при предоставлении гос. услуги	\N	\N
69	2	\N	Наименование взаимодействий ЮЛ и ИОГВ при предоставлении гос. услуги	\N	\N
70	2	\N	Наименование услуги необходимой и обязательной, \nсодержащейся в\nпостановлении\nПравительства Санкт-Петербурга\nот 03.02.2012 N 93	\N	\N
9	3	\N	Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ	\N	\N
7	2	6	№ пункта в положении об ИОГВ	punkt_iogv	\N
10	2	6	Наименование ИОГВ СПб	name_iogv	\N
72	4	6	Cрок ответа	srok_otveta	\N
13	2	6	Наименование полномочия в соответствии с Положением об ИОГВ	authority_name	\N
11	1	6	id полномочия	id_authority	\N
\.


--
-- Data for Name: property_format; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property_format (id_property_format, property_format_name) FROM stdin;
1	system
3	select
4	date
5	multiselect
6	number
2	textarea
\.


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service (id_service, id_service_type, id_authority_status, id_authority, service_name) FROM stdin;
\.


--
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_property (id_service_property, id_property, id_service, value) FROM stdin;
\.


--
-- Data for Name: service_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_type (id_service_type, service_type_name) FROM stdin;
6	Полномочие
7	Услуга
8	Функция
9	Функция по контролю и надзору
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id_user, id_organization, user_name, password) FROM stdin;
2	1	КИС	$2a$08$Ni1aPhwW8yv6yryQtwJE0e/y6APiIqxfLA6wAThrvn3HgTFpbvODS
3	2	ИОГВ	$2a$08$6/gOrlaxUf.NwVwiVhOXienIb1bzrhuEbu2WlNGn3AfW1QyQVAaS2
\.


--
-- Name: pk_activity_feed; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT pk_activity_feed PRIMARY KEY (id_activity_feed);


--
-- Name: pk_authority; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT pk_authority PRIMARY KEY (id_authority);


--
-- Name: pk_authority_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT pk_authority_property PRIMARY KEY (id_authority_property);


--
-- Name: pk_authority_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_status
    ADD CONSTRAINT pk_authority_status PRIMARY KEY (id_authority_status);


--
-- Name: pk_comment; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT pk_comment PRIMARY KEY (id_comment);


--
-- Name: pk_event_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event_type
    ADD CONSTRAINT pk_event_type PRIMARY KEY (id_event_type);


--
-- Name: pk_files; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY files
    ADD CONSTRAINT pk_files PRIMARY KEY (id_file);


--
-- Name: pk_history_log; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);


--
-- Name: pk_organization; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT pk_organization PRIMARY KEY (id_organization);


--
-- Name: pk_organization_rank; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization_rank
    ADD CONSTRAINT pk_organization_rank PRIMARY KEY (id_organization_rank);


--
-- Name: pk_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT pk_property PRIMARY KEY (id_property);


--
-- Name: pk_property_format; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_format
    ADD CONSTRAINT pk_property_format PRIMARY KEY (id_property_format);


--
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT pk_service PRIMARY KEY (id_service);


--
-- Name: pk_service_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT pk_service_property PRIMARY KEY (id_service_property);


--
-- Name: pk_service_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_type
    ADD CONSTRAINT pk_service_type PRIMARY KEY (id_service_type);


--
-- Name: pk_users; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT pk_users PRIMARY KEY (id_user);


--
-- Name: fk_activity_reference_event_ty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_event_ty FOREIGN KEY (id_event_type) REFERENCES event_type(id_event_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_activity_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_authorit_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_authorit_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_comment_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_comment_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_history__reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT fk_history__reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_history__reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT fk_history__reference_service_ FOREIGN KEY (id_service_property) REFERENCES service_property(id_service_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_organiza_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT fk_organiza_reference_organiza FOREIGN KEY (id_organization_rank) REFERENCES organization_rank(id_organization_rank) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_property_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_property FOREIGN KEY (id_property_type) REFERENCES property_format(id_property_format) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_property_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_service__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_service__reference_service; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_service FOREIGN KEY (id_service) REFERENCES service(id_service) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

