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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: activity_feed; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE activity_feed (
    id_activity_feed integer NOT NULL,
    id_organization integer,
    id_event_type integer,
    "time" timestamp without time zone,
    message text,
    id_service_type integer,
    id_object integer
);


ALTER TABLE public.activity_feed OWNER TO postgres;

--
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE activity_feed_id_activity_feed_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_feed_id_activity_feed_seq OWNER TO postgres;

--
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE activity_feed_id_activity_feed_seq OWNED BY activity_feed.id_activity_feed;


--
-- Name: authority; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority (
    id_authority integer NOT NULL,
    id_organization integer,
    id_authority_status integer,
    authority_name character varying(1024)
);


ALTER TABLE public.authority OWNER TO postgres;

--
-- Name: authority_id_authority_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE authority_id_authority_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.authority_id_authority_seq OWNER TO postgres;

--
-- Name: authority_id_authority_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_id_authority_seq OWNED BY authority.id_authority;


--
-- Name: authority_property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_property (
    id_authority_property integer NOT NULL,
    id_property integer,
    id_authority integer,
    value text
);


ALTER TABLE public.authority_property OWNER TO postgres;

--
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE authority_property_id_authority_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.authority_property_id_authority_property_seq OWNER TO postgres;

--
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_property_id_authority_property_seq OWNED BY authority_property.id_authority_property;


--
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE authority_status_id_authority_status_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.authority_status_id_authority_status_seq OWNER TO postgres;

--
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_status_id_authority_status_seq OWNED BY authority_status.id_authority_status;


--
-- Name: comment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comment (
    id_comment integer NOT NULL,
    id_authority integer,
    id_user integer,
    com_id_comment integer,
    message text,
    "time" timestamp without time zone
);


ALTER TABLE public.comment OWNER TO postgres;

--
-- Name: comment_id_comment_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comment_id_comment_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comment_id_comment_seq OWNER TO postgres;

--
-- Name: comment_id_comment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comment_id_comment_seq OWNED BY comment.id_comment;


--
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- Name: event_type_id_event_type_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE event_type_id_event_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.event_type_id_event_type_seq OWNER TO postgres;

--
-- Name: event_type_id_event_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE event_type_id_event_type_seq OWNED BY event_type.id_event_type;


--
-- Name: files; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE files (
    id_file integer NOT NULL,
    id_comment integer,
    name character varying(1024),
    file_name character varying(1024),
    id_authority integer
);


ALTER TABLE public.files OWNER TO postgres;

--
-- Name: files_id_file_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE files_id_file_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.files_id_file_seq OWNER TO postgres;

--
-- Name: files_id_file_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE files_id_file_seq OWNED BY files.id_file;


--
-- Name: history_log; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE history_log (
    id_history_log integer NOT NULL,
    old text,
    new text,
    "time" timestamp without time zone,
    id_user integer,
    id_property integer
);


ALTER TABLE public.history_log OWNER TO postgres;

--
-- Name: history_log_id_history_log_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE history_log_id_history_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.history_log_id_history_log_seq OWNER TO postgres;

--
-- Name: history_log_id_history_log_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE history_log_id_history_log_seq OWNED BY history_log.id_history_log;


--
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- Name: organization_id_organization_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE organization_id_organization_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.organization_id_organization_seq OWNER TO postgres;

--
-- Name: organization_id_organization_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_id_organization_seq OWNED BY organization.id_organization;


--
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE organization_rank_id_organization_rank_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.organization_rank_id_organization_rank_seq OWNER TO postgres;

--
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_rank_id_organization_rank_seq OWNED BY organization_rank.id_organization_rank;


--
-- Name: property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property (
    id_property integer NOT NULL,
    id_property_type integer,
    id_service_type integer,
    property_name character varying(1024),
    property_short_name character varying(1024),
    code character varying(1024),
    options character varying(2048),
    "order" real
);


ALTER TABLE public.property OWNER TO postgres;

--
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- Name: property_format_id_property_format_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE property_format_id_property_format_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.property_format_id_property_format_seq OWNER TO postgres;

--
-- Name: property_format_id_property_format_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_format_id_property_format_seq OWNED BY property_format.id_property_format;


--
-- Name: property_id_property_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE property_id_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.property_id_property_seq OWNER TO postgres;

--
-- Name: property_id_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_id_property_seq OWNED BY property.id_property;


--
-- Name: service; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service (
    id_service integer NOT NULL,
    id_service_type integer,
    id_authority_status integer,
    id_authority integer,
    service_name character varying(1024)
);


ALTER TABLE public.service OWNER TO postgres;

--
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE service_id_service_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_id_service_seq OWNER TO postgres;

--
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_id_service_seq OWNED BY service.id_service;


--
-- Name: service_property; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_property (
    id_service_property integer NOT NULL,
    id_property integer,
    id_service integer,
    value text
);


ALTER TABLE public.service_property OWNER TO postgres;

--
-- Name: service_property_id_service_property_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE service_property_id_service_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_property_id_service_property_seq OWNER TO postgres;

--
-- Name: service_property_id_service_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_property_id_service_property_seq OWNED BY service_property.id_service_property;


--
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- Name: service_type_id_service_type_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE service_type_id_service_type_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_type_id_service_type_seq OWNER TO postgres;

--
-- Name: service_type_id_service_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_type_id_service_type_seq OWNED BY service_type.id_service_type;


--
-- Name: spher; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE spher (
    id_spher integer NOT NULL,
    name text
);


ALTER TABLE public.spher OWNER TO postgres;

--
-- Name: spher_id_spher_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE spher_id_spher_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spher_id_spher_seq OWNER TO postgres;

--
-- Name: spher_id_spher_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE spher_id_spher_seq OWNED BY spher.id_spher;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id_user integer NOT NULL,
    id_organization integer,
    user_name character varying(1024),
    password character varying(64)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_user_seq OWNER TO postgres;

--
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- Name: id_activity_feed; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed ALTER COLUMN id_activity_feed SET DEFAULT nextval('activity_feed_id_activity_feed_seq'::regclass);


--
-- Name: id_authority; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority ALTER COLUMN id_authority SET DEFAULT nextval('authority_id_authority_seq'::regclass);


--
-- Name: id_authority_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property ALTER COLUMN id_authority_property SET DEFAULT nextval('authority_property_id_authority_property_seq'::regclass);


--
-- Name: id_authority_status; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_status ALTER COLUMN id_authority_status SET DEFAULT nextval('authority_status_id_authority_status_seq'::regclass);


--
-- Name: id_comment; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment ALTER COLUMN id_comment SET DEFAULT nextval('comment_id_comment_seq'::regclass);


--
-- Name: id_event_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY event_type ALTER COLUMN id_event_type SET DEFAULT nextval('event_type_id_event_type_seq'::regclass);


--
-- Name: id_file; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files ALTER COLUMN id_file SET DEFAULT nextval('files_id_file_seq'::regclass);


--
-- Name: id_history_log; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log ALTER COLUMN id_history_log SET DEFAULT nextval('history_log_id_history_log_seq'::regclass);


--
-- Name: id_organization; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization ALTER COLUMN id_organization SET DEFAULT nextval('organization_id_organization_seq'::regclass);


--
-- Name: id_organization_rank; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization_rank ALTER COLUMN id_organization_rank SET DEFAULT nextval('organization_rank_id_organization_rank_seq'::regclass);


--
-- Name: id_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property ALTER COLUMN id_property SET DEFAULT nextval('property_id_property_seq'::regclass);


--
-- Name: id_property_format; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_format ALTER COLUMN id_property_format SET DEFAULT nextval('property_format_id_property_format_seq'::regclass);


--
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service ALTER COLUMN id_service SET DEFAULT nextval('service_id_service_seq'::regclass);


--
-- Name: id_service_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property ALTER COLUMN id_service_property SET DEFAULT nextval('service_property_id_service_property_seq'::regclass);


--
-- Name: id_service_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_type ALTER COLUMN id_service_type SET DEFAULT nextval('service_type_id_service_type_seq'::regclass);


--
-- Name: id_spher; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY spher ALTER COLUMN id_spher SET DEFAULT nextval('spher_id_spher_seq'::regclass);


--
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object) FROM stdin;
2	6	7	2014-09-15 21:02:00	\N	6	37
\.


--
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('activity_feed_id_activity_feed_seq', 2, true);


--
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority (id_authority, id_organization, id_authority_status, authority_name) FROM stdin;
29	1	1	Test
30	3	1	test
31	5	1	test
32	4	1	test
33	5	1	test
34	6	1	aaaa
35	6	1	aaaa
36	6	1	aaaa
37	6	1	aaaa
\.


--
-- Name: authority_id_authority_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_id_authority_seq', 37, true);


--
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_property (id_authority_property, id_property, id_authority, value) FROM stdin;
154	7	29	10
155	10	29	Комитет по информатизации и связи
156	8	29	в разработке
157	1	29	<a href=structure/check_status_authority/29>Test</a>
158	11	29	<a href=structure/check_status_authority/29>1 10-67</a>
159	7	30	11
160	10	30	Юридический комитет
161	8	30	в разработке
162	1	30	<a href=structure/check_status_authority/30>test</a>
163	11	30	<a href=structure/check_status_authority/30>3 11-5</a>
164	7	31	10
165	10	31	Администрация Калининского района Санкт-Петербурга
166	8	31	в разработке
167	1	31	<a href=structure/check_status_authority/31>test</a>
168	11	31	<a href=structure/check_status_authority/31>5 10-6</a>
169	7	32	test
170	10	32	Администрация Выборгского района Санкт-Петербурга
171	8	32	в разработке
172	1	32	<a href=structure/check_status_authority/32>test</a>
173	11	32	<a href=structure/check_status_authority/32>4 test-7</a>
174	7	33	tes
175	10	33	Администрация Кировского района Санкт-Петербурга
176	8	33	в разработке
177	1	33	<a href=structure/check_status_authority/33>test</a>
178	11	33	<a href=structure/check_status_authority/33>5 tes-27</a>
179	7	37	aaa
180	10	37	Администрация Выборгского района Санкт-Петербурга
181	8	37	в разработке
182	1	37	<a href=structure/check_status_authority/37>aaaa</a>
183	11	37	<a href=structure/check_status_authority/37>6 aaa-42</a>
\.


--
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_property_id_authority_property_seq', 183, true);


--
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_status (id_authority_status, name) FROM stdin;
1	Ожидает присвоения статуса
2	Ожидает согласования статуса
3	Полномочию присвоен статус
\.


--
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_status_id_authority_status_seq', 4, true);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comment (id_comment, id_authority, id_user, com_id_comment, message, "time") FROM stdin;
33	29	2	\N	test	2014-09-12 20:07:00
34	30	2	\N	test	2014-09-12 20:07:00
35	31	2	\N	tests	2014-09-15 20:56:00
36	32	2	\N	test	2014-09-15 21:00:00
37	33	2	\N	test	2014-09-15 21:01:00
38	37	2	\N	aaaa	2014-09-15 21:02:00
\.


--
-- Name: comment_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_comment_seq', 38, true);


--
-- Data for Name: event_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY event_type (id_event_type, event_type_name) FROM stdin;
7	new_authority
8	authority_changed
9	overdue_response_time
\.


--
-- Name: event_type_id_event_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('event_type_id_event_type_seq', 9, true);


--
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY files (id_file, id_comment, name, file_name, id_authority) FROM stdin;
12	\N	MV.jpg	MV.jpg	31
13	\N	MV.jpg	MV1.jpg	32
14	\N	MV.jpg	MV2.jpg	33
15	\N	MV.jpg	MV3.jpg	37
\.


--
-- Name: files_id_file_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_file_seq', 15, true);


--
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY history_log (id_history_log, old, new, "time", id_user, id_property) FROM stdin;
\.


--
-- Name: history_log_id_history_log_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('history_log_id_history_log_seq', 5, true);


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
7	1	Администрация Кировского района Санкт-Петербурга
8	1	Администрация Колпинского района Санкт-Петербурга
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
-- Name: organization_id_organization_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_id_organization_seq', 58, true);


--
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization_rank (id_organization_rank, organization_rank) FROM stdin;
1	1
\.


--
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_rank_id_organization_rank_seq', 2, true);


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") FROM stdin;
10	2	6	Наименование ИОГВ СПб	Наименование ИОГВ СПб	name_iogv	{"property_align":"left","property_width":"800","property_required":false,"property_color":"#cc9858"}	3
8	3	6	Статус исполняемости	Статус исполняемости	executable_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	4
12	1	6	Статус согласования статуса полномочия	Статус согласования статуса полномочия	authority_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	5
3	2	6	Внесены изменения в Положение об ИОГВ	Внесены изменения в Положение об ИОГВ	igov_changes	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	6
7	2	6	№ пункта в положении об ИОГВ	№ пункта в положении об ИОГВ	punkt_iogv	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	7
74	2	7	Краткое наименование услуги	Краткое наименование услуги	sr_1	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	11
17	3	6	Тип	Тип	service_type	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	10
179	2	7	Категория заявителей	Категория заявителей	sr_10	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	20
190	2	7	Информация о внутриведомственных и межведомственных процедурах		sr_20	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	30
174	2	7	Перечень НПА РФ, регулирующих предоставление услуги	Перечень НПА РФ	sr_4	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	14
175	2	7	Перечень НПА СПб		sr_5	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	15
176	2	7	Способы предоставления услуги	Способы предоставления услуги	sr_6	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	16
177	2	7	Результат предоставления услуги	Результат предоставления услуги	sr_7	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	17
178	2	7	Тип заявителя	Тип заявителя	sr_9	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	19
72	4	6	Cрок ответа	Cрок ответа	\N	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ca4949","property_show_other_users":false}	8
184	2	7	Основания для приостановления предоставления либо отказа в предоставлении услуги		sr_14	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	24
186	2	7	Способы получения этих документов		sr_16	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	26
173	3	7	Сфера предоставления	Сфера предоставления	sr_2	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	12
191	2	7	Сведения о порядке досудебного обжалования решений органа предоставляющего услугу		sr_21	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	31
192	2	7	Наличие межведомственного взаимодействия		sr_22	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	32
193	2	7	Технологическая карта межведомственного взаимодействия 		sr_23	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	33
75	2	7	Наименование органов, участвующих в предоставлении услуги	Наименование органов, участвующих в предоставлении услуги	sr_3	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	13
15	1	6	Статус разработки услуги/функции	Статус разработки услуги/функции	service_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	35
14	1	6	id государственной услуги/функции	id государственной услуги/функции	id_service	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	34
11	1	6	ID полномочия	ID полномочия	authority_id	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#f7f7f7"}	2
18	3	6	субъект предоставления услуг (физ/юр)	субъект предоставления услуг (физ/юр)	service_subject	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}	36
5	2	6	Реквизиты НПА	Реквизиты НПА	\N	{"property_align":"left","property_width":"200","property_required":"on","property_color":"#23eae7","property_show_other_users":"on"}	37
73	2	7	Наименование услуги	Наименование услуги	sr_0	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	9
1	2	6	Наименование полномочия в соответствии с Положением об ИОГВ	Наименование полномочия	authority_name	{"property_align":"left","property_width":"450","property_required":"on","property_color":"#ddee33","property_show_other_users":"on"}	1
180	2	7	Сведения о местах, в которых можно получить информацию		sr_11	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	21
182	2	7	Срок, в течение которого заявление должно быть зарегистрировано		sr_12	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	22
183	2	7	Максимальный срок ожидания в очереди		sr_13	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	23
185	2	7	Перечень необходимых документов		sr_15	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	25
187	2	7	Сведения о возмездности услуги		sr_17	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	27
188	2	7	Стоимость услуги		sr_18	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	28
189	2	7	Показатели доступности и качества услуги		sr_19	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	29
181	2	7	Срок предоставления		sr_8	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}	18
\.


--
-- Data for Name: property_format; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property_format (id_property_format, property_format_name) FROM stdin;
1	system
2	textarea
3	select
4	date
5	multiselect
6	number
\.


--
-- Name: property_format_id_property_format_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_format_id_property_format_seq', 7, true);


--
-- Name: property_id_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_id_property_seq', 205, true);


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service (id_service, id_service_type, id_authority_status, id_authority, service_name) FROM stdin;
\.


--
-- Name: service_id_service_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_id_service_seq', 12, true);


--
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_property (id_service_property, id_property, id_service, value) FROM stdin;
\.


--
-- Name: service_property_id_service_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_property_id_service_property_seq', 193, true);


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
-- Name: service_type_id_service_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_type_id_service_type_seq', 10, true);


--
-- Data for Name: spher; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY spher (id_spher, name) FROM stdin;
1	Безопасность и охрана правопорядка
2	Государственные учреждения\r\n\n
3	Гражданство, регистрация, визы\r\n\n
4	Здравоохранение и медицина\r\n\n
5	Земельно-имущественные отношения\r\n\n
6	Информационные технологии и связь\r\n\n
7	Картография, гиодезия и гидрометеорология\r\n\n
8	Культура и искусство\r\n\n
9	Налоги и сборы\r\n\n
10	Некоммерческие организации
11	Образование и наука\r\n\n
12	Предпринимательская деятельность\r\n\n
13	Природопользование и экология\r\n\n
14	Производство, строительство и торговля\r\n\n
15	Прочие услуги\r\n\n
16	Реклама и СМИ\r\n\n
17	Социальное обеспечение\r\n\n
18	Страхование\r\n\n
19	Таможенное дело\r\n\n
20	Транспорт и дорожное хозяйство\r\n\n
21	Экономика, финансы, статистика\r\n\n
22	Энергетика и природные ресурсы\r\n\n
23	Юридические услуги\r\n\n
\.


--
-- Name: spher_id_spher_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('spher_id_spher_seq', 24, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id_user, id_organization, user_name, password) FROM stdin;
2	1	kis	$2a$08$Ni1aPhwW8yv6yryQtwJE0e/y6APiIqxfLA6wAThrvn3HgTFpbvODS
3	2	iogv	$2a$08$6/gOrlaxUf.NwVwiVhOXienIb1bzrhuEbu2WlNGn3AfW1QyQVAaS2
\.


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 4, true);


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
-- Name: pk_spher; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY spher
    ADD CONSTRAINT pk_spher PRIMARY KEY (id_spher);


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
-- Name: fk_comment_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_comment FOREIGN KEY (com_id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_comment_reference_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_users FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_users_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT fk_users_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


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

