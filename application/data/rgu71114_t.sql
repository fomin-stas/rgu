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
    id_object integer,
    status integer DEFAULT 1
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
    authority_name character varying(4096)
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
-- Name: property_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_comments (
    id_property_commit integer NOT NULL,
    date_comment timestamp without time zone,
    id_service_property integer,
    comment text,
    "user" character varying(255)
);


ALTER TABLE public.property_comments OWNER TO postgres;

--
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE property_commits_id_property_commit_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.property_commits_id_property_commit_seq OWNER TO postgres;

--
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_commits_id_property_commit_seq OWNED BY property_comments.id_property_commit;


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
-- Name: property_values; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_values (
    property_value_id integer NOT NULL,
    property_id integer,
    value character(100)
);


ALTER TABLE public.property_values OWNER TO postgres;

--
-- Name: property_values_property_value_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE property_values_property_value_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.property_values_property_value_id_seq OWNER TO postgres;

--
-- Name: property_values_property_value_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_values_property_value_id_seq OWNED BY property_values.property_value_id;


--
-- Name: service; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service (
    id_service integer NOT NULL,
    id_service_type integer,
    id_authority_status integer,
    id_authority integer,
    service_name character varying(4096)
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
    value text,
    agreed integer DEFAULT 1 NOT NULL
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
-- Name: id_property_commit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_comments ALTER COLUMN id_property_commit SET DEFAULT nextval('property_commits_id_property_commit_seq'::regclass);


--
-- Name: id_property_format; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_format ALTER COLUMN id_property_format SET DEFAULT nextval('property_format_id_property_format_seq'::regclass);


--
-- Name: property_value_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_values ALTER COLUMN property_value_id SET DEFAULT nextval('property_values_property_value_id_seq'::regclass);


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

COPY activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) FROM stdin;
70	31546	7	2014-11-07 07:00:00	\N	6	8522	2
71	31546	8	2014-11-07 07:44:00	\N	6	8522	2
72	31546	8	2014-11-07 07:47:00	\N	6	8522	2
73	31546	8	2014-11-07 09:09:00	\N	6	8522	1
74	31546	8	2014-11-07 09:10:00	\N	6	8522	1
75	31568	7	2014-11-07 09:58:00	\N	6	8523	1
76	31546	7	2014-11-07 10:09:00	\N	6	8524	1
77	31546	8	2014-11-07 10:14:00	\N	6	8524	1
\.


--
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('activity_feed_id_activity_feed_seq', 77, true);


--
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority (id_authority, id_organization, id_authority_status, authority_name) FROM stdin;
8522	31546	3	Евгения_Олеговна_тест_07.11
8523	31568	1	Второе полномочие Евгении Олеговны
8524	31546	2	Полномочие
\.


--
-- Name: authority_id_authority_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_id_authority_seq', 8524, true);


--
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_property (id_authority_property, id_property, id_authority, value) FROM stdin;
50616	7	8522	07.11
50617	10	8522	Управление ветеринарии
50618	19	8522	
50620	72	8522	
50622	18	8522	Отраслевой орган
50623	13	8522	<a href=agreeds/check_status_authority/8522>Евгения_Олеговна_тест_07.11</a>
50624	11	8522	<a href=agreeds/check_status_authority/8522> 07.11-45</a>
50625	1022	8522	Можно написать что-нибудь
50621	8	8522	отправленно на доработку
50619	1033	8522	Проект
50626	907	8522	123123123
50627	7	8523	07.11
50628	10	8523	Архивный комитет
50629	19	8523	
50630	1033	8523	
50631	72	8523	
50632	8	8523	в разработке
50633	18	8523	Отраслевой орган
50634	13	8523	<a href=agreeds/check_status_authority/8523>Второе полномочие Евгении Олеговны</a>
50635	11	8523	<a href=agreeds/check_status_authority/8523> 07.11-62</a>
50636	7	8524	23.33
50637	10	8524	Управление ветеринарии
50638	19	8524	Наименование информационной системы органа власти, с использованием которой осуществляется полномочие
50639	1033	8524	
50640	72	8524	13-11-2014
50641	8	8524	в разработке
50642	18	8524	Отраслевой орган
50643	13	8524	<a href=agreeds/check_status_authority/8524>Полномочие</a>
50644	11	8524	<a href=agreeds/check_status_authority/8524> 23.33-79</a>
\.


--
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_property_id_authority_property_seq', 50644, true);


--
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authority_status (id_authority_status, name) FROM stdin;
1	Ожидает присвоения статуса
2	Ожидает согласования статуса
3	Полномочию присвоен статус
4	Полномочие подлежит корректировке
\.


--
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_status_id_authority_status_seq', 5, true);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comment (id_comment, id_authority, id_user, com_id_comment, message, "time") FROM stdin;
114	8522	5	\N	Кофе с ароматом сахара	2014-11-07 07:00:00
115	8522	305	\N	Мы были вынуждены его допить	2014-11-07 07:44:00
116	8522	5	\N	Добавьте еще функцию	2014-11-07 07:52:00
117	8523	5	\N	Добрый день	2014-11-07 09:58:00
118	8524	305	\N	Что-то	2014-11-07 10:14:00
\.


--
-- Name: comment_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_comment_seq', 118, true);


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
33	\N	Создание пользователей в группах.xlsx	Создание_пользователей_в_группах.xlsx	8523
34	\N	Без имени.png	Без_имени.png	8524
35	\N	предложения.docx	предложения.docx	8524
\.


--
-- Name: files_id_file_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_file_seq', 35, true);


--
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY history_log (id_history_log, old, new, "time", id_user, id_property) FROM stdin;
53	Можно написать что-нибудь	Можно написать что-нибудь	2014-11-07 07:47:00	5	1022
54		Проект	2014-11-07 09:09:00	5	1033
55	123123123	123123123	2014-11-07 09:10:00	5	907
\.


--
-- Name: history_log_id_history_log_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('history_log_id_history_log_seq', 55, true);


--
-- Data for Name: organization; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization (id_organization, id_organization_rank, organization_name) FROM stdin;
31560	1	Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности
31562	1	Комитет по промышленной политике и инновациям Санкт-Петербурга
31538	1	Комитет по тарифам Санкт-Петербурга
31539	1	Комитет по транспорту
31540	1	Комитет по труду и занятости населения
31541	1	Комитет по управлению городским имуществом
31542	1	Комитет по физической культуре и спорту
31546	1	Управление ветеринарии
64234	1	Управление по развитию садоводства и огородничества
31545	1	Управление социального питания
64251	2	Федеральный орган исполнительной власти
8987	2	Администрации районов
61488	2	Администрации районов Санкт-Петербурга
31568	1	Архивный комитет
64388	2	ВФ
31569	1	Государственная административно-техническая инспекция
31567	1	Государственная жилищная инспекция Санкт-Петербурга
31564	1	Жилищный комитет
64242	1	Комитет государственного финансового контроля Санкт-Петербурга
31565	1	Комитет по благоустройству Санкт-Петербурга
64246	1	Комитет по внешним связям
31566	1	Комитет по вопросам законности, правопорядка и безопасности
64244	1	Комитет по государственному заказу Санкт-Петербурга
31549	1	Комитет по государственному контролю, использованию и охране памятников истории и культуры
31548	1	Комитет по градостроительству и архитектуре
31550	1	Комитет по делам записи актов гражданского состояния
31551	1	Комитет по здравоохранению
31552	1	Комитет по земельным ресурсам и землеустройству
31553	1	Комитет по инвестициям Санкт-Петербурга
31554	1	Комитет по информатизации и связи
31555	1	Комитет по культуре
64240	1	Комитет по межнациональным отношениям и реализации миграционной политики
31556	1	Комитет по молодежной политике и взаимодействию с общественными организациями
31557	1	Комитет по науке и высшей школе
31558	1	Комитет по образованию
31559	1	Комитет по печати и взаимодействию со средствами массовой информации
31561	1	Комитет по развитию предпринимательства и потребительского рынка Санкт-Петербурга
8989	1	Комитет по развитию транспортной инфраструктуры Санкт-Петербурга
31547	1	Комитет по развитию туризма Санкт-Петербурга
31537	1	Комитет по социальной политике Санкт-Петербурга
31536	1	Комитет по строительству
64236	1	Комитет по экономической политике и стратегическому планированию Санкт-Петербурга
31543	1	Комитет по энергетике и инженерному обеспечению
64238	1	Комитет финансов Санкт-Петербурга
64249	2	Органы местного самоуправления
31544	1	Служба государственного строительного надзора и экспертизы Санкт-Петербурга
31563	1	Государственная инспекция Санкт-Петербурга по надзору за техническим состоянием самоходных машин и других видов техники
\.


--
-- Name: organization_id_organization_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_id_organization_seq', 58, true);


--
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY organization_rank (id_organization_rank, organization_rank) FROM stdin;
1	РОИВ
2	АР,МУ,ВФ
\.


--
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_rank_id_organization_rank_seq', 2, true);


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") FROM stdin;
8	1	6	Статус согласования полномочия	Статус согласования полномочия	executable_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":"on"}	7
12	1	6	Статус согласования статуса полномочия	Статус согласования статуса полномочия	authority_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	9
72	4	6	Cрок ответа	Cрок ответа	srok_otveta	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	15
74	2	7	Краткое наименование услуги	Краткое наименование услуги	sr_1	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	17
176	2	7	Способы предоставления услуги	Способы предоставления услуги	sr_6	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	22
178	2	7	Тип заявителя	Тип заявителя	sr_9	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	24
187	2	7	Сведения о возмездности услуги		sr_17	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	33
18	3	6	Разработчик полномочия	Разработчик полномочия	service_subject	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	14
904	2	\N	РЕЕСТР	РЕЕСТР	kis_0	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	150
17	3	\N	Тип	Тип	service_type	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	13
174	2	7	Сокращенное наименование для инфокиосков	Сокращенное наименование для инфокиосков	sr_4	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	20
193	2	7	Технологическая карта межведомственного взаимодействия (при наличии межведомственного взаимодействия с федеральными органами исполнительной власти, органами государственных внебюджетных фондов, органами исполнительной власти субъектов Российской Федерации, органами местного самоуправления, учреждениями (организациями), участвующими в оказании услуги) 	Технологическая карта межведомственного взаимодействия	sr_23	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	39
10	1	6	Наименование ИОГВ СПб	Наименование ИОГВ СПб	name_iogv	{"property_align":"left","property_width":"800","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	8
73	2	7	Наименование	Наименование услуги	sr_0	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	16
905	2	\N	РЕЕСТР Период внесения изменений	РЕЕСТР Период внесения изменений	kis_1	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	151
907	2	\N	Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)	Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)	kis_3	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	1532
908	2	\N	Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)	Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)	kis_4	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	154
909	2	\N	№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496	№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496	kis_5	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	155
910	2	\N	полномочие осуществляется с использованием ИС	полномочие осуществляется с использованием ИС	kis_6	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	156
911	2	\N	Статус	Статус	kis_7	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	157
912	2	\N	 Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ	 Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ	kis_8	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	158
913	2	\N	Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)	Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)	kis_9	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	159
15	1	7	Статус разработки услуги/функции	Статус разработки услуги/функции	service_status	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	11
914	2	\N	субъект предоставления услуг (физ/юр)	субъект предоставления услуг (физ/юр)	kis_10	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	160
915	2	\N	№ пункта Плана-графика 2013	№ пункта Плана-графика 2013	kis_11	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	161
916	2	\N	План-график 2013 (срок исполнения)	План-график 2013 (срок исполнения)	kis_12	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	162
917	2	\N	План-график 2013 (требуется внесение изменений)	План-график 2013 (требуется внесение изменений)	kis_13	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	163
918	2	\N	Продление срока по Плану 2013	Продление срока по Плану 2013	kis_14	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	164
919	2	\N	Основание для продления срока по Плану 2013	Основание для продления срока по Плану 2013	kis_15	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	165
920	2	\N	Исключение из Плана 2013	Исключение из Плана 2013	kis_16	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	166
921	2	\N	Основание для исключения из Плана 2013	Основание для исключения из Плана 2013	kis_17	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	167
922	2	\N	План 2013 исполнен	План 2013 исполнен	kis_18	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	168
923	2	\N	№ пункта Плана-графика 2014	№ пункта Плана-графика 2014	kis_19	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	169
924	2	\N	Срок исполнения План-графика 2014	Срок исполнения План-графика 2014	kis_20	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	170
925	2	\N	Основание для включения услуги в План-график 2014	Основание для включения услуги в План-график 2014	kis_21	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	171
927	2	\N	План 2014\r\n\nисполнение	План 2014\r\n\nисполнение	kis_23	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	173
928	2	\N	№ пункта Плана-графика 2015	№ пункта Плана-графика 2015	kis_24	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	174
929	2	\N	Срок исполнения План-графика 2015	Срок исполнения План-графика 2015	kis_25	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	175
981	2	\N	КАР	КАР	kis_77	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	227
930	2	\N	Основание для включения услуги в План-график 2015	Основание для включения услуги в План-график 2015	kis_26	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	176
931	2	\N	Основание для исключения из Плана 2015	Основание для исключения из Плана 2015	kis_27	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	177
932	2	\N	План 2015\r\n\nисполнение	План 2015\r\n\nисполнение	kis_28	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	178
933	2	\N	Мониторинг в 2014 году	Мониторинг в 2014 году	kis_29	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	179
934	2	\N	Проведен мониторинг в 2013 году	Проведен мониторинг в 2013 году	kis_30	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	180
935	2	\N	Услуга включена в дорожную карту ИОГВ	Услуга включена в дорожную карту ИОГВ	kis_31	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	181
936	2	\N	Результаты мониторинга 2013 года	Результаты мониторинга 2013 года	kis_32	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	182
937	2	\N	%\r\n\nудовлетворенности заявителей по услуге	%\r\n\nудовлетворенности заявителей по услуге	kis_33	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	183
938	2	\N	Срок исполнения мероприятий по ДК	Срок исполнения мероприятий по ДК	kis_34	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	184
939	2	\N	Отметка о выполнении	Отметка о выполнении	kis_35	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	185
940	2	\N	№ пункта Плана-графика 2012	№ пункта Плана-графика 2012	kis_36	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	186
941	2	\N	План-график 2012 (месяц)	План-график 2012 (месяц)	kis_37	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	187
942	2	\N	План-график 2012 Внесение изменений в АР	План-график 2012 Внесение изменений в АР	kis_38	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	188
943	2	\N	Продление срока	Продление срока	kis_39	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	189
944	2	\N	Исключение из Плана 2012	Исключение из Плана 2012	kis_40	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	190
945	2	\N	Основание для исключения	Основание для исключения	kis_41	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	191
946	2	\N	ПГ 2012 исполнен	ПГ 2012 исполнен	kis_42	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	192
947	2	\N	1593	1593	kis_43	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	193
948	2	\N	1593 (ред. от 20.09.2012)	1593 (ред. от 20.09.2012)	kis_44	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	194
949	2	\N	Внесение изменений в 1593	Внесение изменений в 1593	kis_45	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	195
950	2	\N	Реквизиты соглашения	Реквизиты соглашения	kis_46	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	196
994	2	\N	Комментарии	Комментарии	kis_90	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	240
952	2	\N	Реализация в МАИС МФЦ	Реализация в МАИС МФЦ	kis_48	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	198
955	2	\N	Внесение изменений в 11-рп	Внесение изменений в 11-рп	kis_51	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	201
956	2	\N	Реализация в АИС "ЭСРН" (Систематика)	Реализация в АИС "ЭСРН" (Систематика)	kis_52	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	202
957	2	\N	Реализация по ГК в 2014 году	Реализация по ГК в 2014 году	kis_53	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	203
958	2	\N	Реализация по ГК в 2014 году 	Реализация по ГК в 2014 году 	kis_54	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	204
959	2	\N	11-рп от 13.03.2014	11-рп от 13.03.2014	kis_55	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	205
960	2	\N	этап предоставления на Портале	этап предоставления на Портале	kis_56	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	206
961	2	\N	Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014	Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014	kis_57	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	207
962	2	\N	Возможность выдачи результата в электронном виде	Возможность выдачи результата в электронном виде	kis_58	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	208
964	2	\N	ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг	ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг	kis_60	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	210
965	2	\N	ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")	ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")	kis_61	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	211
966	2	\N	ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)	ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)	kis_62	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	212
967	2	\N	ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг	ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг	kis_63	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	213
968	2	\N	ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг	ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг	kis_64	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	214
969	2	\N	ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг	ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг	kis_65	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	215
993	2	\N	Наименование "подуслуги"	Наименование "подуслуги"	kis_89	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	239
970	2	\N	ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг	ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг	kis_66	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	216
972	2	\N	Реализация на портале (Ростелеком)	Реализация на портале (Ростелеком)	kis_68	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	218
973	2	\N	Актуализация по ЕПГУ	Актуализация по ЕПГУ	kis_69	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	219
974	2	\N	1993-р	1993-р	kis_70	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	220
975	2	\N	729-р	729-р	kis_71	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	221
976	2	\N	реализация в электронном виде	реализация в электронном виде	kis_72	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	222
977	2	\N	51-рп	51-рп	kis_73	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	223
978	2	\N	Внесение изменений в 51-рп	Внесение изменений в 51-рп	kis_74	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	224
979	2	\N	ТКМВ\r\n\n(реквизиты  протокола РГ МИВ)	ТКМВ\r\n\n(реквизиты  протокола РГ МИВ)	kis_75	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	225
980	2	\N	ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)	ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)	kis_76	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	226
983	2	\N	Реквизиты нормативных правовых актов изменений в АР	Реквизиты нормативных правовых актов изменений в АР	kis_79	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	229
984	2	\N	Возмездная / Безвозмездная государственная услуга	Возмездная / Безвозмездная государственная услуга	kis_80	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	230
985	2	\N	Сумма госпошлины	Сумма госпошлины	kis_81	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	231
986	2	\N	Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги	Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги	kis_82	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	232
987	2	\N	Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги	Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги	kis_83	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	233
988	2	\N	Наименование услуги необходимой и обязательной, \r\n\nсодержащейся в\r\n\nпостановлении\r\n\nПравительства Санкт-Петербурга\r\n\nот 03.02.2012 N 93	Наименование услуги необходимой и обязательной, \r\n\nсодержащейся в\r\n\nпостановлении\r\n\nПравительства Санкт-Петербурга\r\n\nот 03.02.2012 N 93	kis_84	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	234
989	2	\N	Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную	Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную	kis_85	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	235
990	2	\N	Стоимость услуги н.о.	Стоимость услуги н.о.	kis_86	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	236
991	2	\N	Наименование услуги (документа) необходимой для предоставления государственной услуги	Наименование услуги (документа) необходимой для предоставления государственной услуги	kis_87	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	237
992	2	\N	Соответствие с 93	Соответствие с 93	kis_88	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	238
995	2	\N	Наименование учреждения (организации), предоставляющей необходимую услугу	Наименование учреждения (организации), предоставляющей необходимую услугу	kis_91	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	241
997	2	\N	Результат предоставления услуги/исполнения функции	Результат предоставления услуги/исполнения функции	kis_93	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	243
998	2	\N	Время ожидания в очереди	Время ожидания в очереди	kis_94	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	244
999	2	\N	Требуется внесение изменений в АР	Требуется внесение изменений в АР	kis_95	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	245
1000	2	\N	03.10.2014	03.10.2014	kis_96	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	246
1001	2	\N	Результат согласования 	Результат согласования 	kis_97	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	247
1002	2	\N	03.10.2014	03.10.2014	kis_98	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	248
1003	2	\N	ФИО эксперта	ФИО эксперта	kis_99	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	249
1004	2	\N	Дата повторного поступления  на согласование	Дата повторного поступления  на согласование	kis_100	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	250
1005	2	\N	Результат повторного согласования 	Результат повторного согласования 	kis_101	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	251
1006	2	\N	Дата повторного согласования 	Дата повторного согласования 	kis_102	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	252
1007	2	\N	ФИО эксперта	ФИО эксперта	kis_103	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	253
1009	2	\N	Результат предварительной экспертизы в ЮК	Результат предварительной экспертизы в ЮК	kis_105	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	255
1010	2	\N	Проект направлен в ЮК для вынесения на КАР (реквизиты письма)	Проект направлен в ЮК для вынесения на КАР (реквизиты письма)	kis_106	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	256
1011	2	\N	Отсутствует НПА на федеральном уровне	Отсутствует НПА на федеральном уровне	kis_107	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	257
1012	2	\N	Требуется внесение изменений в НПА на федеральном уровне	Требуется внесение изменений в НПА на федеральном уровне	kis_108	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	258
1013	2	\N	Отсутствует НПА СПб	Отсутствует НПА СПб	kis_109	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	259
1014	2	\N	Требуется внесение изменений в НПА СПб	Требуется внесение изменений в НПА СПб	kis_110	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	260
1015	2	\N	№ п/п в соответствии с Перечнями №1 и №2 МЭР	№ п/п в соответствии с Перечнями №1 и №2 МЭР	kis_111	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	261
1016	2	\N	Наименование в соответствии с Перечнями №1 и №2 МЭР	Наименование в соответствии с Перечнями №1 и №2 МЭР	kis_112	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	262
1017	2	\N	Комментарии Юридического Комитета	Комментарии Юридического Комитета	kis_113	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	263
926	2	\N	Основание для исключения из Плана 2014	Основание для исключения из Плана 2014	kis_22	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	172
1018	2	\N	Наименование функции (услуги)  в соответствии с федеральным законодательством	Наименование функции (услуги)  в соответствии с федеральным законодательством	kis_114	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	264
1019	2	\N	Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ	Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ	kis_115	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	265
1021	2	\N	Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)	Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)	kis_117	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	267
1022	2	\N	Реквизиты НПА, закрепляющего перечень документов представления услуги	Реквизиты НПА, закрепляющего перечень документов представления услуги	kis_118	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	268
1023	2	6	Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня	Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня	rekvisit_npa	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	3
1024	2	\N	133-ФЗ	133-ФЗ	kis_120	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	269
1025	2	\N	Количество обращений за предоставление услуги\r\n\n (за 2011 год)	Количество обращений за предоставление услуги\r\n\n (за 2011 год)	kis_121	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	270
1026	2	\N	Количество обращений за предоставлением услуги\r\n\n(за 2013 год)	Количество обращений за предоставлением услуги\r\n\n(за 2013 год)	kis_122	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	271
1027	2	\N	Количество обращений за предоставление услуги	Количество обращений за предоставление услуги	kis_123	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	272
1028	2	\N	Количество обращений за предоставление услуги	Количество обращений за предоставление услуги	kis_124	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	273
1029	2	\N	Количество обращений за предоставление услуги\r\n\n (на 1.11.2012)	Количество обращений за предоставление услуги\r\n\n (на 1.11.2012)	kis_125	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	274
1030	2	\N	Формирование отчета по полномочиям	Формирование отчета по полномочиям	kis_126	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	275
1031	2	\N	Примечание	Примечание	kis_127	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	276
1032	2	\N	Идентификатор услуги	Идентификатор услуги	kis_128	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	277
1033	2	6	Проект постановления Правительства (наименование и дата согласования Юридическим комитетом)	Проект постановления Правительства	project_post	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	41
996	2	\N	Стоимость услуги необходимой для получения гос. услуги	Стоимость услуги необходимой для получения гос. услуги	kis_92	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	242
963	2	\N	ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг	ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг	kis_59	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	209
971	2	\N	 УЭК                 	 УЭК                 	kis_67	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	217
7	2	6	№ пункта в положении об ИОГВ	№ пункта в положении об ИОГВ	punkt_iogv	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	6
906	2	\N	Внесены изменения в Положение об ИОГВ	Внесены изменения в Положение об ИОГВ	kis_2	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	152
1060	2	9	Предмет государственного контроля (надзора) и муниципального контроля 	Предмет государственного контроля (надзора) и муниципального контроля 	sk_12	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	43
1049	3	8	Cведения о наличии необходимости формирования отчетности	Cведения о наличии необходимости формирования отчетности	sn_14	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	42
1037	2	8	Код и название целевой статьи бюджета Санкт-Петербурга	Код и название целевой статьи бюджета Санкт-Петербурга	sn_12	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	42
75	2	7	Наименование органов, участвующих в предоставлении услуги (исполнении функции)	Орган, предоставляющий услугу (исполняющий функцию)	sr_3	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	18
951	2	\N	Дата начала предоставления услуги в МФЦ	Дата начала предоставления услуги в МФЦ	kis_47	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	197
953	2	\N	8-рп	8-рп	kis_49	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	199
954	2	\N	Внесение изменений в 8-рп	Внесение изменений в 8-рп	kis_50	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	200
982	2	\N	Административный регламент утвержден распоряжением ИОГВ	Административный регламент утвержден распоряжением ИОГВ	kis_78	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	228
13	2	6	Наименование полномочия в соответствии с Положением об ИОГВ	Наименование полномочия в соответствии с Положением об ИОГВ	authority_name	{"property_align":"left","property_width":"450","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	1
1008	2	\N	Предварительная экспертиза ЮК (реквизиты письма)	Предварительная экспертиза ЮК (реквизиты письма)	kis_104	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	254
1020	2	\N	Наименование функции в соответствии с законодательством Санкт-Петербурга 	Наименование функции в соответствии с законодательством Санкт-Петербурга 	kis_116	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}	266
11	1	6	ID полномочия	ID полномочия	authority_id	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	2
19	2	6	Наименование информационной системы органа власти, с использованием которой осуществляется полномочие	Наименование информационной системы органа власти, с использованием которой осуществляется полномочие	information_system_roiv	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}	7
173	3	7	Сфера предоставления	Сфера предоставления	sr_2	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	19
1076	5	7	Жизненная ситуация	Жизненная ситуация	sr_25	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	40
1079	2	7	Услуга является необходимой и обязательной для предоставления услуг	Услуга является необходимой и обязательной для предоставления услуг	sr_28	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	40
1077	3	7	Категория услуги	Категория услуги	sr_26	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	40
1080	2	7	Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге	Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге	sr_29	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	40
1078	2	7	Наименвоание Информационной системы	Наименвоание Информационной системы	sr_27	{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}	40
\.


--
-- Data for Name: property_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property_comments (id_property_commit, date_comment, id_service_property, comment, "user") FROM stdin;
1	2014-10-27 02:40:00	53719	Не нравится этот файл	Kis_user
2	2014-10-27 02:40:00	53718	И этот	Kis_user
3	2014-10-27 03:08:00	53718		Kis_user
4	2014-11-06 17:13:00	53781	Информация правильна	Kis_user
5	2014-11-06 18:36:00	53795	Что-то	Kis_user
6	2014-11-06 18:43:00	53795	где-то	Kis_user
7	2014-11-06 19:27:00	53800	Нужно нет	Kis_user
8	2014-11-07 07:49:00	53884	Нет, измените сферу	kis_user
9	2014-11-07 07:52:00	53896	Измените	kis_user
\.


--
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_commits_id_property_commit_seq', 9, true);


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

SELECT pg_catalog.setval('property_id_property_seq', 1080, true);


--
-- Data for Name: property_values; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY property_values (property_value_id, property_id, value) FROM stdin;
3	206	hehe5                                                                                               
4	1	test 54                                                                                             
5	206	test 55                                                                                             
\.


--
-- Name: property_values_property_value_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_values_property_value_id_seq', 5, true);


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service (id_service, id_service_type, id_authority_status, id_authority, service_name) FROM stdin;
5680	7	\N	8522	sr_1
5681	9	\N	8522	sk_1
5682	7	\N	8524	sr_1
\.


--
-- Name: service_id_service_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_id_service_seq', 5682, true);


--
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY service_property (id_service_property, id_property, id_service, value, agreed) FROM stdin;
53903	73	5682	Наименование	2
53904	74	5682	Наименование	2
53905	173	5682	Картография, гиодезия и гидрометеорология\n\n	2
53906	75	5682	Внебюджетный фонд	2
53907	174	5682	Наименование	2
53908	176	5682	в традиционном порядке; через МФЦ	2
53909	178	5682	физические лица	2
53910	187	5682	возмездно	2
53911	1076	5682	Утрата документов	2
53912	1077	5682	услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания	2
53913	1079	5682	Нет	2
53914	1078	5682	НаименованиеНаименование	2
53915	1080	5682	333333	2
53916	193	5682	<a href="file_storage/property/IMG_15082014_220913.png">IMG_15082014_220913.png</a>	2
53882	73	5680	Организация праздников и торжеств по случаю взятия крепости врага	1
53883	74	5680	Организация увеселений на военные темы	1
53884	173	5680	Налоги и сборы\n\n	0
53885	75	5680	Не выбрано	1
53886	174	5680	Увеселения на военные темы	2
53887	176	5680	в традиционном порядке; через МФЦ	1
53888	178	5680	физические лица	1
53889	187	5680	возмездно	1
53890	1076	5680	Рождение ребенка; Смена фамилии; Выход на пенсию	1
53891	1077	5680	Государственная (муниципальная) услуга	2
53892	1079	5680	Нет	2
53893	1078	5680		0
53894	1080	5680		1
53895	193	5680	\N	2
53896	73	5681	Проверять курьера на iq	0
53897	74	5681	Проверка iq	1
53898	174	5681	Проверка	1
53899	1060	5681	интеллект служащего при выполнении задания	1
53900	1078	5681		2
53901	1080	5681		2
53902	193	5681	\N	0
\.


--
-- Name: service_property_id_service_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_property_id_service_property_seq', 53916, true);


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
5	31554	Kis_user	\N
5	31554	Kis_user	\N
225	31551	iogv123	\N
305	31546	iogv-77	\N
198	31563	iogv125	\N
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
-- Name: property_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_comments
    ADD CONSTRAINT property_comments_pkey PRIMARY KEY (id_property_commit);


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

