--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.8
-- Dumped by pg_dump version 9.2.8
-- Started on 2014-08-10 11:31:26

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 185 (class 3079 OID 11727)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 185
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 168 (class 1259 OID 17361)
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
-- TOC entry 169 (class 1259 OID 17363)
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
-- TOC entry 170 (class 1259 OID 17370)
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
-- TOC entry 171 (class 1259 OID 17377)
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
-- TOC entry 172 (class 1259 OID 17384)
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 17391)
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
-- TOC entry 174 (class 1259 OID 17398)
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 17405)
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
-- TOC entry 176 (class 1259 OID 17412)
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
-- TOC entry 177 (class 1259 OID 17419)
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 17426)
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 17433)
-- Name: property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property (
    id_property integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    id_property_type integer,
    id_service_type integer,
    property_name character varying(1024),
    code character varying(512)
);


ALTER TABLE public.property OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 17440)
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 17447)
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
-- TOC entry 182 (class 1259 OID 17454)
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
-- TOC entry 183 (class 1259 OID 17461)
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer DEFAULT nextval('auto_id_users'::regclass) NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 17468)
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
-- TOC entry 2060 (class 0 OID 17363)
-- Dependencies: 169
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY activity_feed (id_activity_feed, id_organization, id_event_type, "time", message) FROM stdin;
\.


--
-- TOC entry 2061 (class 0 OID 17370)
-- Dependencies: 170
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
-- TOC entry 2062 (class 0 OID 17377)
-- Dependencies: 171
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
-- TOC entry 2063 (class 0 OID 17384)
-- Dependencies: 172
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_status (id_authority_status, name) FROM stdin;
4	Исполняется
1	На разграничении
12	На согласовании разграничения
2	Разграничение согласовано (разработка АР)
\.


--
-- TOC entry 2084 (class 0 OID 0)
-- Dependencies: 168
-- Name: auto_id_users; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('auto_id_users', 22, true);


--
-- TOC entry 2064 (class 0 OID 17391)
-- Dependencies: 173
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comment (id_comment, id_authority, id_organization, message, "time") FROM stdin;
\.


--
-- TOC entry 2065 (class 0 OID 17398)
-- Dependencies: 174
-- Data for Name: event_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY event_type (id_event_type, event_type_name) FROM stdin;
5	Измненение статуса полномочия
\.


--
-- TOC entry 2066 (class 0 OID 17405)
-- Dependencies: 175
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY files (id_file, id_comment, name, file_name) FROM stdin;
\.


--
-- TOC entry 2067 (class 0 OID 17412)
-- Dependencies: 176
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY history_log (id_history_log, id_service_property, id_organization, old, new, "time") FROM stdin;
\.


--
-- TOC entry 2068 (class 0 OID 17419)
-- Dependencies: 177
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
-- TOC entry 2069 (class 0 OID 17426)
-- Dependencies: 178
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization_rank (id_organization_rank, organization_rank) FROM stdin;
1	1
\.


--
-- TOC entry 2070 (class 0 OID 17433)
-- Dependencies: 179
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property (id_property, id_property_type, id_service_type, property_name, code) FROM stdin;
1	3	\N	РЕЕСТР	\N
2	4	\N	РЕЕСТР Период внесения изменений	\N
3	2	\N	Внесены изменения в Положение об ИОГВ	\N
4	2	\N	Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)	\N
5	2	\N	Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)	\N
6	2	\N	Полномочие осуществляется с использованием ИС	\N
8	3	\N	Статус исполняемости	\N
11	1	\N	id полномочия	\N
12	1	\N	Статус согласования статуса полномочия	\N
14	1	\N	id государственной услуги/функции	\N
15	1	\N	Статус разработки услуги/функции	\N
16	2	\N	Наименование государственной функций (услуги) в соответствии с административным регламентом	\N
17	3	\N	Тип	\N
18	3	\N	субъект предоставления услуг (физ/юр)	\N
19	2	\N	№ пункта Плана-графика 2013	\N
20	4	\N	План-график 2013 (срок исполнения)	\N
21	2	\N	План-график 2013 (требуется внесение изменений)	\N
22	2	\N	Продление срока по Плану 2013	\N
23	2	\N	Основание для продления срока по Плану 2013	\N
24	2	\N	Исключение из Плана 2013	\N
25	2	\N	Основание для исключения из Плана 2013	\N
26	3	\N	План 2013 исполнен	\N
27	2	\N	№ пункта Плана-графика 2014	\N
28	4	\N	Срок исполнения План-графика 2014	\N
29	2	\N	Основание для включения услуги в План-график 2014	\N
30	2	\N	Мониторинг в 2014 году	\N
31	2	\N	Проведен мониторинг в 2013 году	\N
32	3	\N	Услуга включена в дорожную карту ИОГВ	\N
33	2	\N	% удовлетворенности заявителей по услуге\n	\N
34	2	\N	№ пункта Плана-графика 2012	\N
35	3	\N	План-график 2012 (месяц)	\N
36	2	\N	План-график 2012 Внесение изменений в АР	\N
37	2	\N	Продление срока	\N
38	2	\N	Исключение из Плана 2012	\N
39	2	\N	Основание для исключения	\N
40	3	\N	ПГ 2012 исполнен	\N
41	2	\N	1593	\N
42	2	\N	1593 (ред. от 20.09.2012)	\N
43	2	\N	Внесение изменений в 1593	\N
44	2	\N	Реквизиты соглашения	\N
45	2	\N	Дата начала предоставления услуги в МФЦ	\N
46	2	\N	Реализация в МАИС ЭГУ	\N
47	2	\N	8-рп	\N
48	2	\N	Внесение изменений в 8-рп	\N
49	2	\N	Реализация по ГК в 2014 году	\N
50	2	\N	11-рп от 13.03.2014	\N
51	5	\N	этап предоставления на Портале	\N
52	3	\N	Возможность выдачи результата в электронном виде	\N
53	2	\N	УЭК	\N
54	2	\N	Реализация на портале (Ростелеком)	\N
55	2	\N	Актуализация по ЕПГУ	\N
56	2	\N	1993-р	\N
57	6	\N	729-р	\N
58	3	\N	реализация в электронном виде	\N
59	2	\N	51-рп	\N
60	2	\N	Внесение изменений в 51-рп	\N
61	2	\N	ТКМВ (реквизиты  протокола РГ МИВ)	\N
62	2	\N	ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)	\N
63	2	\N	КАР	\N
64	2	\N	Административный регламент утвержден распоряжением ИОГВ	\N
65	2	\N	Реквизиты нормативных правовых актов изменений в АР	\N
66	3	\N	Возмездная / Безвозмездная государственная услуга	\N
67	2	\N	Сумма госпошлины	\N
68	2	\N	Количество взаимодействий ЮЛ и ИОГВ при предоставлении гос. услуги	\N
69	2	\N	Наименование взаимодействий ЮЛ и ИОГВ при предоставлении гос. услуги	\N
70	2	\N	Наименование услуги необходимой и обязательной, \nсодержащейся в\nпостановлении\nПравительства Санкт-Петербурга\nот 03.02.2012 N 93	\N
9	3	\N	Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ	\N
13	2	6	Наименование полномочия в соответствии с Положением об ИОГВ	name_authority
7	2	6	№ пункта в положении об ИОГВ	punkt_iogv
10	2	6	Наименование ИОГВ СПб	name_iogv
72	4	6	Cрок ответа	srok_otveta
\.


--
-- TOC entry 2071 (class 0 OID 17440)
-- Dependencies: 180
-- Data for Name: property_format; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property_format (id_property_format, property_format_name) FROM stdin;
1	system
2	text
3	select
4	date
5	multiselect
6	number
\.


--
-- TOC entry 2072 (class 0 OID 17447)
-- Dependencies: 181
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service (id_service, id_service_type, id_authority_status, id_authority, service_name) FROM stdin;
\.


--
-- TOC entry 2073 (class 0 OID 17454)
-- Dependencies: 182
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_property (id_service_property, id_property, id_service, value) FROM stdin;
\.


--
-- TOC entry 2074 (class 0 OID 17461)
-- Dependencies: 183
-- Data for Name: service_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_type (id_service_type, service_type_name) FROM stdin;
6	Полномочие
7	Услуга
8	Функция
9	Функция по контролю и надзору
\.


--
-- TOC entry 2075 (class 0 OID 17468)
-- Dependencies: 184
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id_user, id_organization, user_name, password) FROM stdin;
2	1	КИС	$2a$08$Ni1aPhwW8yv6yryQtwJE0e/y6APiIqxfLA6wAThrvn3HgTFpbvODS
3	2	ИОГВ	$2a$08$6/gOrlaxUf.NwVwiVhOXienIb1bzrhuEbu2WlNGn3AfW1QyQVAaS2
\.


--
-- TOC entry 1903 (class 2606 OID 17476)
-- Name: pk_activity_feed; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT pk_activity_feed PRIMARY KEY (id_activity_feed);


--
-- TOC entry 1905 (class 2606 OID 17478)
-- Name: pk_authority; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT pk_authority PRIMARY KEY (id_authority);


--
-- TOC entry 1907 (class 2606 OID 17480)
-- Name: pk_authority_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT pk_authority_property PRIMARY KEY (id_authority_property);


--
-- TOC entry 1909 (class 2606 OID 17482)
-- Name: pk_authority_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_status
    ADD CONSTRAINT pk_authority_status PRIMARY KEY (id_authority_status);


--
-- TOC entry 1911 (class 2606 OID 17484)
-- Name: pk_comment; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT pk_comment PRIMARY KEY (id_comment);


--
-- TOC entry 1913 (class 2606 OID 17486)
-- Name: pk_event_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event_type
    ADD CONSTRAINT pk_event_type PRIMARY KEY (id_event_type);


--
-- TOC entry 1915 (class 2606 OID 17488)
-- Name: pk_files; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY files
    ADD CONSTRAINT pk_files PRIMARY KEY (id_file);


--
-- TOC entry 1917 (class 2606 OID 17490)
-- Name: pk_history_log; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);


--
-- TOC entry 1919 (class 2606 OID 17492)
-- Name: pk_organization; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT pk_organization PRIMARY KEY (id_organization);


--
-- TOC entry 1921 (class 2606 OID 17494)
-- Name: pk_organization_rank; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization_rank
    ADD CONSTRAINT pk_organization_rank PRIMARY KEY (id_organization_rank);


--
-- TOC entry 1923 (class 2606 OID 17496)
-- Name: pk_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT pk_property PRIMARY KEY (id_property);


--
-- TOC entry 1925 (class 2606 OID 17498)
-- Name: pk_property_format; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_format
    ADD CONSTRAINT pk_property_format PRIMARY KEY (id_property_format);


--
-- TOC entry 1927 (class 2606 OID 17500)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT pk_service PRIMARY KEY (id_service);


--
-- TOC entry 1929 (class 2606 OID 17502)
-- Name: pk_service_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT pk_service_property PRIMARY KEY (id_service_property);


--
-- TOC entry 1931 (class 2606 OID 17504)
-- Name: pk_service_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_type
    ADD CONSTRAINT pk_service_type PRIMARY KEY (id_service_type);


--
-- TOC entry 1933 (class 2606 OID 17506)
-- Name: pk_users; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT pk_users PRIMARY KEY (id_user);


--
-- TOC entry 1934 (class 2606 OID 17507)
-- Name: fk_activity_reference_event_ty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_event_ty FOREIGN KEY (id_event_type) REFERENCES event_type(id_event_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1935 (class 2606 OID 17512)
-- Name: fk_activity_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1936 (class 2606 OID 17517)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1938 (class 2606 OID 17522)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1937 (class 2606 OID 17527)
-- Name: fk_authorit_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1939 (class 2606 OID 17532)
-- Name: fk_authorit_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1940 (class 2606 OID 17537)
-- Name: fk_comment_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1941 (class 2606 OID 17542)
-- Name: fk_comment_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1942 (class 2606 OID 17547)
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1943 (class 2606 OID 17552)
-- Name: fk_history__reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT fk_history__reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1944 (class 2606 OID 17557)
-- Name: fk_history__reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT fk_history__reference_service_ FOREIGN KEY (id_service_property) REFERENCES service_property(id_service_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1945 (class 2606 OID 17562)
-- Name: fk_organiza_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT fk_organiza_reference_organiza FOREIGN KEY (id_organization_rank) REFERENCES organization_rank(id_organization_rank) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1946 (class 2606 OID 17567)
-- Name: fk_property_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_property FOREIGN KEY (id_property_type) REFERENCES property_format(id_property_format) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1947 (class 2606 OID 17572)
-- Name: fk_property_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1948 (class 2606 OID 17577)
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1951 (class 2606 OID 17582)
-- Name: fk_service__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1952 (class 2606 OID 17587)
-- Name: fk_service__reference_service; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_service FOREIGN KEY (id_service) REFERENCES service(id_service) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1949 (class 2606 OID 17592)
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1950 (class 2606 OID 17597)
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-08-10 11:31:29

--
-- PostgreSQL database dump complete
--

