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
23	22	3	Проводит в установленном порядке экспертизу ценности документов
34	25	3	В установленном порядке согласовывать переустройство и(или) перепланировку жилых помещений
50	27	3	Выдавать порубочные билеты, определять требования к производству работ по рубке и(или) пересадке, а также любому другому правомерному уничтожению зеленых насаждений в Санкт-Петербурге, обеспечивать проверку соответствия работ по рубке и(или) пересадке, а также любому другому правомерному уничтожению зеленых насаждений условиям выданных порубочных билетов\n
62	38	3	Проводить государственную аккредитацию образовательных учреждений, расположенных на территории Санкт-Петербурга, в том числе образовательных учреждений среднего профессионального образования при привлечении представителей Комитета по науке и высшей школе (за исключением образовательных учреждений, указанных в подпункте 24 статьи 28 Закона Российской Федерации "Об образовании"), а также формирование, ведение и обеспечение использования региональных информационных систем государственной аккредитации, содержащих сведения о деятельности аккредитованных образовательных учреждений.\n
74	43	3	Обеспечивать рассмотрение заявлений потенциальных инвесторов о выборе земельного участка и предварительном согласовании места размещения объекта.\n
87	31	3	Выдает диплом целителя и принимает решение о лишении диплома целителя.
100	26	3	 Обеспечивать организацию и проведение мероприятий по мобилизационной подготовке Комитета, разрабатывать и утверждать мобилизационный план Комитета и мобилизационные задания подведомственным государственным унитарным предприятиям.\n
111	28	3	Взаимодействовать в установленном порядке по вопросам, находящимся в компетенции Комитета, с органами государственной власти и местного самоуправления, организациями, а также должностными лицами
122	32	3	Устанавливать порядок осуществления инвентаризации территорий зеленых насаждений
135	40	3	Осуществлять федеральный государственный надзор в области охраны   и использования объектов животного мира и среды их обитания на территории     Санкт-Петербурга, за исключением объектов животного мира и среды их обитания, находящихся на особо охраняемых природных территориях федерального значения, расположенных на территории Санкт-Петербурга
149	54	3	Осуществлять региональный государственный контроль (надзор) на территории особой экономической зоны
\.


--
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_property (id_authority_property, id_property, id_authority, value) FROM stdin;
24	13	23	Проводит в установленном порядке экспертизу ценности документов
25	8	23	Исполняемое
26	10	23	Архивный комитет
27	7	23	3.16.
28	1	23	Р
35	12	34	Полномочию присвоен статус 
36	12	23	Полномочию присвоен статус 
37	13	34	"В установленном порядке согласовывать переустройство и(или) перепланировку жилых помещений"
38	8	34	Исполняемая\n
39	10	34	Жилищный комитет
40	7	34	3.4.41.
41	1	34	АР
45	9	34	Администрация района
51	12	50	Полномочию присвоен статус \n
52	13	50	Выдавать порубочные билеты, определять требования к производству работ по рубке и(или) пересадке, а также любому другому правомерному уничтожению зеленых насаждений в Санкт-Петербурге, обеспечивать проверку соответствия работ по рубке и(или) пересадке, а также любому другому правомерному уничтожению зеленых насаждений условиям выданных порубочных билетов\n
53	8	50	Исполняемое
54	10	50	Комитет по благоустройству Санкт-Петербурга\n
55	7	50	3.46
56	1	50	Р
63	12	62	Полномочию присвоен статус 
64	13	62	Проводить государственную аккредитацию образовательных учреждений, расположенных на территории Санкт-Петербурга, в том числе образовательных учреждений среднего профессионального образования при привлечении представителей Комитета по науке и высшей школе (за исключением образовательных учреждений, указанных в подпункте 24 статьи 28 Закона Российской Федерации "Об образовании"), а также формирование, ведение и обеспечение использования региональных информационных систем государственной аккредитации, содержащих сведения о деятельности аккредитованных образовательных учреждений.\n
65	8	62	Исполняемое
66	10	62	Комитет по образованию\n
67	7	62	3.22-1.\n
68	1	62	Р
75	12	74	Полномочию присвоен статус 
76	13	74	Обеспечивать рассмотрение заявлений потенциальных инвесторов о выборе земельного участка и предварительном согласовании места размещения объекта.\n
77	8	74	исполняемая\n
78	10	74	Комитет по строительству\n
79	7	74	3.23-2. 
80	4	74	Постановлением Правительства СПб от 11.08.2011 N 1150
81	1	74	Р
88	12	87	Полномочию присвоен статус 
89	13	87	Выдает диплом целителя и принимает решение о лишении диплома целителя.\n
90	8	87	исключено
91	10	87	Комитет по здравоохранению
92	7	87	3.13.2.\n
93	4	87	КАР №46
94	5	87	ПП СПБ от 25.12.2012 №1673
95	2	87	октябрь\n
101	12	100	Полномочию присвоен статус 
102	13	100	 Обеспечивать организацию и проведение мероприятий по мобилизационной подготовке Комитета, разрабатывать и утверждать мобилизационный план Комитета и мобилизационные задания подведомственным государственным унитарным предприятиям.
103	8	100	Общее
104	10	100	Комитет по градостроительству и архитектуре 
105	7	100	3.38.
106	1	100	Р
112	12	111	Полномочию присвоен статус 
113	13	111	Взаимодействовать в установленном порядке по вопросам, находящимся в компетенции Комитета, с органами государственной власти и местного самоуправления, организациями, а также должностными лицами\n
114	8	111	Общее\n
115	10	111	Комитет по вопросам законности, правопорядка и безопасности
116	7	111	3.1.
117	1	111	Р
123	12	122	Полномочию присвоен статус 
124	13	122	Устанавливать порядок осуществления инвентаризации территорий зеленых насаждений
125	8	122	исполняемое
126	10	122	Комитет по земельным ресурсам и землеустройству
127	7	122	3.52.
128	3	122	1)о внесении изменений в постановление Правительства Санкт-Петербурга от 05.06.2007 №640ППСПб дополнено пунктом 3.51.      2)от 15.08.2011 №1170п.3.49 и 3.50 считать  п.3.51 и 3.52 соответственно
129	4	122	КАР №38 от 28.07.2011   КАР №43
130	1	122	Р
136	12	135	Полномочию присвоен статус 
137	13	135	Осуществлять федеральный государственный надзор в области охраны   и использования объектов животного мира и среды их обитания на территории     Санкт-Петербурга, за исключением объектов животного мира и среды их обитания, находящихся на особо охраняемых природных территориях федерального значения, расположенных на территории Санкт-Петербурга\n
138	8	135	Исполняемое
139	10	135	Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности 
140	7	135	3.34-10. 
141	3	135	Проект постановления Правительства СПб о внесении изменений в постановление Правительства СПб от 06.04.2004 № 530 (изменена формулировка) \n
142	4	135	КАР №49
143	1	135	РФКН
144	2	135	апрель
150	12	149	Полномочию присвоен статус \n
151	13	149	Осуществлять региональный государственный контроль (надзор) на территории особой экономической зоны\n
152	8	149	исполняемое
153	10	149	Комитет по промышленной политике и инновациям Санкт-Петербурга
154	7	149	3.19. 
155	1	149	РФКН\n
156	2	149	апрель
\.


--
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_status (id_authority_status, name) FROM stdin;
1	Ожидает присвоения статуса
2	Ожидает согласования статуса
3	Полномочию присвоен статус
\.


--
-- Name: auto_id_users; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('auto_id_users', 160, true);


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
2	4	\N	РЕЕСТР Период внесения изменений	\N	\N
6	2	\N	Полномочие осуществляется с использованием ИС	\N	\N
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
10	2	6	Наименование ИОГВ СПб	name_iogv	\N
72	4	6	Cрок ответа	srok_otveta	\N
13	2	6	Наименование полномочия в соответствии с Положением об ИОГВ	authority_name	\N
12	1	\N	Статус согласования статуса полномочия	authority_status	\N
11	1	6	id полномочия	id_authority	\N
8	3	\N	Статус исполняемости	executable_status	\N
7	2	6	№ пункта в положении об ИОГВ	iogv_item	\N
3	2	\N	Внесены изменения в Положение об ИОГВ	igov_changes	\N
4	2	\N	Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)	base_date_changes	\N
5	2	\N	Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)	base_for_exclude	\N
1	3	\N	РЕЕСТР	register	\N
15	1	\N	Статус разработки услуги/функции	service_status	\N
14	1	\N	id государственной услуги/функции	id_service	\N
16	2	\N	Наименование государственной функций (услуги) в соответствии с административным регламентом	service_name	\N
17	3	\N	Тип	service_type	\N
18	3	\N	субъект предоставления услуг (физ/юр)	service_subject	\N
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
29	7	\N	23	Проведение в установленном порядке экспертизы ценности документов
44	7	\N	34	"Согласовывать переустройство и (или) перепланировку жилых помещений\n"\n
57	7	\N	50	Выдача порубочных билетов\n
69	7	\N	62	Проведение государственной аккредитации образовательных учреждений, расположенных на территории Санкт-Петербурга (за исключением образовательных учреждений, указанных в подпункте 24 статьи 28 Закона Российской Федерации "Об образовании")\n
82	7	\N	74	Рассмотрение заявлений потенциальных инвесторов о выборе земельного участка и предварительном согласовании места размещения объекта\n
96	7	\N	87	Выдает диплом целителя и принимает решение о лишении диплома целителя.
107	8	\N	100	 Обеспечивать организацию и проведение мероприятий по мобилизационной подготовке Комитета, разрабатывать и утверждать мобилизационный план Комитета и мобилизационные задания подведомственным государственным унитарным предприятиям.
118	8	\N	111	Взаимодействовать в установленном порядке по вопросам, находящимся в компетенции Комитета, с органами государственной власти и местного самоуправления, организациями, а также должностными лицами\n
131	8	\N	122	Установление порядок осуществления инвентаризации территорий зеленых насаждений\n
145	9	\N	135	Осуществлять федеральный государственный надзор в области охраны   и использования объектов животного мира и среды их обитания на территории     Санкт-Петербурга, за исключением объектов животного мира и среды их обитания, находящихся на особо охраняемых природных территориях федерального значения, расположенных на территории Санкт-Петербурга\n
157	9	\N	149	Осуществление регионального государственного контроля (надзора) на территории особой экономической зоны
\.


--
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_property (id_service_property, id_property, id_service, value) FROM stdin;
30	15	29	Исполняется
31	16	29	Проведение в установленном порядке экспертизы ценности документов
32	17	29	услуга
33	18	29	физ/юр
46	15	44	Исполняется
47	16	44	"Согласовывать переустройство и (или) перепланировку жилых помещений"\n
48	17	44	услуга
49	18	44	физ/юр
58	15	57	Исполняется\n
59	16	57	Выдача порубочных билетов\n
60	17	57	услуга
61	18	57	юр\n
70	15	69	Исполняется
71	16	69	Проведение государственной аккредитации образовательных учреждений, расположенных на территории Санкт-Петербурга (за исключением образовательных учреждений, указанных в подпункте 24 статьи 28 Закона Российской Федерации "Об образовании")\n
72	17	69	услуга
73	18	69	юр
83	15	82	Исполняется
84	16	82	Рассмотрение заявлений потенциальных инвесторов о выборе земельного участка и предварительном согласовании места размещения объекта
85	17	82	Услуга
86	18	82	физ/юр\n
97	15	96	Исполняется
98	16	96	Выдает диплом целителя и принимает решение о лишении диплома целителя.
99	17	96	услуга\n
108	15	107	Исполняется
109	16	107	 Обеспечивать организацию и проведение мероприятий по мобилизационной подготовке Комитета, разрабатывать и утверждать мобилизационный план Комитета и мобилизационные задания подведомственным государственным унитарным предприятиям.
110	17	107	функция
119	15	118	Исполняется
120	16	118	Взаимодействовать в установленном порядке по вопросам, находящимся в компетенции Комитета, с органами государственной власти и местного самоуправления, организациями, а также должностными лицами\n
121	17	118	Функция
132	15	131	Исполняется
133	16	131	Установление порядок осуществления инвентаризации территорий зеленых насаждений\n
134	17	131	Функция\n
146	15	145	Исполняется
147	16	145	Осуществлять федеральный государственный надзор в области охраны   и использования объектов животного мира и среды их обитания на территории     Санкт-Петербурга, за исключением объектов животного мира и среды их обитания, находящихся на особо охраняемых природных территориях федерального значения, расположенных на территории Санкт-Петербурга\n
148	17	145	Функция контроля и надзора
158	15	157	Исполняется
159	16	157	Осуществление регионального государственного контроля (надзора) на территории особой экономической зоны\n
160	17	157	Функция контроля и надзора
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

