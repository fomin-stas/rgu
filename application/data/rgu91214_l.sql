--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.8
-- Dumped by pg_dump version 9.2.8
-- Started on 2014-12-09 11:20:42

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 206 (class 3079 OID 11727)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 206
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 168 (class 1259 OID 238965)
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
-- TOC entry 169 (class 1259 OID 238972)
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
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 169
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE activity_feed_id_activity_feed_seq OWNED BY activity_feed.id_activity_feed;


--
-- TOC entry 170 (class 1259 OID 238974)
-- Name: authority; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority (
    id_authority integer NOT NULL,
    id_organization integer,
    id_authority_status integer,
    authority_name character varying(4096),
    is_new boolean
);


ALTER TABLE public.authority OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 238980)
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
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 171
-- Name: authority_id_authority_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_id_authority_seq OWNED BY authority.id_authority;


--
-- TOC entry 172 (class 1259 OID 238982)
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
-- TOC entry 173 (class 1259 OID 238988)
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
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 173
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_property_id_authority_property_seq OWNED BY authority_property.id_authority_property;


--
-- TOC entry 174 (class 1259 OID 238990)
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 238996)
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
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 175
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_status_id_authority_status_seq OWNED BY authority_status.id_authority_status;


--
-- TOC entry 176 (class 1259 OID 238998)
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
-- TOC entry 177 (class 1259 OID 239004)
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
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 177
-- Name: comment_id_comment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comment_id_comment_seq OWNED BY comment.id_comment;


--
-- TOC entry 178 (class 1259 OID 239006)
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 239012)
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
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 179
-- Name: event_type_id_event_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE event_type_id_event_type_seq OWNED BY event_type.id_event_type;


--
-- TOC entry 180 (class 1259 OID 239014)
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
-- TOC entry 181 (class 1259 OID 239020)
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
-- TOC entry 2167 (class 0 OID 0)
-- Dependencies: 181
-- Name: files_id_file_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE files_id_file_seq OWNED BY files.id_file;


--
-- TOC entry 182 (class 1259 OID 239022)
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
-- TOC entry 183 (class 1259 OID 239028)
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
-- TOC entry 2168 (class 0 OID 0)
-- Dependencies: 183
-- Name: history_log_id_history_log_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE history_log_id_history_log_seq OWNED BY history_log.id_history_log;


--
-- TOC entry 184 (class 1259 OID 239030)
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 239036)
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
-- TOC entry 2169 (class 0 OID 0)
-- Dependencies: 185
-- Name: organization_id_organization_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_id_organization_seq OWNED BY organization.id_organization;


--
-- TOC entry 186 (class 1259 OID 239038)
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 239044)
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
-- TOC entry 2170 (class 0 OID 0)
-- Dependencies: 187
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_rank_id_organization_rank_seq OWNED BY organization_rank.id_organization_rank;


--
-- TOC entry 188 (class 1259 OID 239046)
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
-- TOC entry 189 (class 1259 OID 239052)
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
-- TOC entry 190 (class 1259 OID 239058)
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
-- TOC entry 2171 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_commits_id_property_commit_seq OWNED BY property_comments.id_property_commit;


--
-- TOC entry 191 (class 1259 OID 239060)
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 239066)
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
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 192
-- Name: property_format_id_property_format_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_format_id_property_format_seq OWNED BY property_format.id_property_format;


--
-- TOC entry 193 (class 1259 OID 239068)
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
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 193
-- Name: property_id_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_id_property_seq OWNED BY property.id_property;


--
-- TOC entry 194 (class 1259 OID 239070)
-- Name: property_values; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_values (
    property_value_id integer NOT NULL,
    property_id integer,
    value character(100)
);


ALTER TABLE public.property_values OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 239073)
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
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 195
-- Name: property_values_property_value_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_values_property_value_id_seq OWNED BY property_values.property_value_id;


--
-- TOC entry 196 (class 1259 OID 239075)
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
-- TOC entry 197 (class 1259 OID 239081)
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
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_id_service_seq OWNED BY service.id_service;


--
-- TOC entry 198 (class 1259 OID 239083)
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
-- TOC entry 199 (class 1259 OID 239090)
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
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 199
-- Name: service_property_id_service_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_property_id_service_property_seq OWNED BY service_property.id_service_property;


--
-- TOC entry 200 (class 1259 OID 239092)
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 239098)
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
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 201
-- Name: service_type_id_service_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_type_id_service_type_seq OWNED BY service_type.id_service_type;


--
-- TOC entry 202 (class 1259 OID 239100)
-- Name: spher; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE spher (
    id_spher integer NOT NULL,
    name text
);


ALTER TABLE public.spher OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 239106)
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
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 203
-- Name: spher_id_spher_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE spher_id_spher_seq OWNED BY spher.id_spher;


--
-- TOC entry 204 (class 1259 OID 239108)
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
-- TOC entry 205 (class 1259 OID 239114)
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
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 205
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- TOC entry 1937 (class 2604 OID 239116)
-- Name: id_activity_feed; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed ALTER COLUMN id_activity_feed SET DEFAULT nextval('activity_feed_id_activity_feed_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 239117)
-- Name: id_authority; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority ALTER COLUMN id_authority SET DEFAULT nextval('authority_id_authority_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 239118)
-- Name: id_authority_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property ALTER COLUMN id_authority_property SET DEFAULT nextval('authority_property_id_authority_property_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 239119)
-- Name: id_authority_status; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_status ALTER COLUMN id_authority_status SET DEFAULT nextval('authority_status_id_authority_status_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 239120)
-- Name: id_comment; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment ALTER COLUMN id_comment SET DEFAULT nextval('comment_id_comment_seq'::regclass);


--
-- TOC entry 1942 (class 2604 OID 239121)
-- Name: id_event_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY event_type ALTER COLUMN id_event_type SET DEFAULT nextval('event_type_id_event_type_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 239122)
-- Name: id_file; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files ALTER COLUMN id_file SET DEFAULT nextval('files_id_file_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 239123)
-- Name: id_history_log; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log ALTER COLUMN id_history_log SET DEFAULT nextval('history_log_id_history_log_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 239124)
-- Name: id_organization; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization ALTER COLUMN id_organization SET DEFAULT nextval('organization_id_organization_seq'::regclass);


--
-- TOC entry 1946 (class 2604 OID 239125)
-- Name: id_organization_rank; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization_rank ALTER COLUMN id_organization_rank SET DEFAULT nextval('organization_rank_id_organization_rank_seq'::regclass);


--
-- TOC entry 1947 (class 2604 OID 239126)
-- Name: id_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property ALTER COLUMN id_property SET DEFAULT nextval('property_id_property_seq'::regclass);


--
-- TOC entry 1948 (class 2604 OID 239127)
-- Name: id_property_commit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_comments ALTER COLUMN id_property_commit SET DEFAULT nextval('property_commits_id_property_commit_seq'::regclass);


--
-- TOC entry 1949 (class 2604 OID 239128)
-- Name: id_property_format; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_format ALTER COLUMN id_property_format SET DEFAULT nextval('property_format_id_property_format_seq'::regclass);


--
-- TOC entry 1950 (class 2604 OID 239129)
-- Name: property_value_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_values ALTER COLUMN property_value_id SET DEFAULT nextval('property_values_property_value_id_seq'::regclass);


--
-- TOC entry 1951 (class 2604 OID 239130)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service ALTER COLUMN id_service SET DEFAULT nextval('service_id_service_seq'::regclass);


--
-- TOC entry 1953 (class 2604 OID 239131)
-- Name: id_service_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property ALTER COLUMN id_service_property SET DEFAULT nextval('service_property_id_service_property_seq'::regclass);


--
-- TOC entry 1954 (class 2604 OID 239132)
-- Name: id_service_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_type ALTER COLUMN id_service_type SET DEFAULT nextval('service_type_id_service_type_seq'::regclass);


--
-- TOC entry 1955 (class 2604 OID 239133)
-- Name: id_spher; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY spher ALTER COLUMN id_spher SET DEFAULT nextval('spher_id_spher_seq'::regclass);


--
-- TOC entry 1956 (class 2604 OID 239134)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2115 (class 0 OID 238965)
-- Dependencies: 168
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 169
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('activity_feed_id_activity_feed_seq', 74, true);


--
-- TOC entry 2117 (class 0 OID 238974)
-- Dependencies: 170
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 171
-- Name: authority_id_authority_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_id_authority_seq', 20052, true);


--
-- TOC entry 2119 (class 0 OID 238982)
-- Dependencies: 172
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 173
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_property_id_authority_property_seq', 138054, true);


--
-- TOC entry 2121 (class 0 OID 238990)
-- Dependencies: 174
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority_status (id_authority_status, name) VALUES (1, 'Ожидает присвоения статуса');
INSERT INTO authority_status (id_authority_status, name) VALUES (2, 'Ожидает согласования статуса');
INSERT INTO authority_status (id_authority_status, name) VALUES (3, 'Полномочию присвоен статус');
INSERT INTO authority_status (id_authority_status, name) VALUES (4, 'Полномочие подлежит корректировке');


--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 175
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_status_id_authority_status_seq', 5, true);


--
-- TOC entry 2123 (class 0 OID 238998)
-- Dependencies: 176
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 177
-- Name: comment_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_comment_seq', 117, true);


--
-- TOC entry 2125 (class 0 OID 239006)
-- Dependencies: 178
-- Data for Name: event_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO event_type (id_event_type, event_type_name) VALUES (7, 'new_authority');
INSERT INTO event_type (id_event_type, event_type_name) VALUES (8, 'authority_changed');
INSERT INTO event_type (id_event_type, event_type_name) VALUES (9, 'overdue_response_time');


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 179
-- Name: event_type_id_event_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('event_type_id_event_type_seq', 9, true);


--
-- TOC entry 2127 (class 0 OID 239014)
-- Dependencies: 180
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 181
-- Name: files_id_file_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_file_seq', 32, true);


--
-- TOC entry 2129 (class 0 OID 239022)
-- Dependencies: 182
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 183
-- Name: history_log_id_history_log_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('history_log_id_history_log_seq', 56, true);


--
-- TOC entry 2131 (class 0 OID 239030)
-- Dependencies: 184
-- Data for Name: organization; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31568, 1, 'Архивный комитет');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64388, 2, 'ВФ');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31569, 1, 'Государственная административно-техническая инспекция');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31567, 1, 'Государственная жилищная инспекция Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31563, 1, 'Государственная инспекция Санкт-Петербурга по надзору за техническим состоянием самоходных машин и других видов техники');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31564, 1, 'Жилищный комитет');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64242, 1, 'Комитет государственного финансового контроля Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31565, 1, 'Комитет по благоустройству Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64246, 1, 'Комитет по внешним связям');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31566, 1, 'Комитет по вопросам законности, правопорядка и безопасности');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64244, 1, 'Комитет по государственному заказу Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31549, 1, 'Комитет по государственному контролю, использованию и охране памятников истории и культуры');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31548, 1, 'Комитет по градостроительству и архитектуре');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31550, 1, 'Комитет по делам записи актов гражданского состояния');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31551, 1, 'Комитет по здравоохранению');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31552, 1, 'Комитет по земельным ресурсам и землеустройству');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31553, 1, 'Комитет по инвестициям Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31554, 1, 'Комитет по информатизации и связи');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31555, 1, 'Комитет по культуре');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64240, 1, 'Комитет по межнациональным отношениям и реализации миграционной политики');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31556, 1, 'Комитет по молодежной политике и взаимодействию с общественными организациями');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31557, 1, 'Комитет по науке и высшей школе');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31558, 1, 'Комитет по образованию');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31559, 1, 'Комитет по печати и взаимодействию со средствами массовой информации');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31560, 1, 'Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31562, 1, 'Комитет по промышленной политике и инновациям Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31561, 1, 'Комитет по развитию предпринимательства и потребительского рынка Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8989, 1, 'Комитет по развитию транспортной инфраструктуры Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31547, 1, 'Комитет по развитию туризма Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31537, 1, 'Комитет по социальной политике Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31536, 1, 'Комитет по строительству');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31538, 1, 'Комитет по тарифам Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31539, 1, 'Комитет по транспорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31540, 1, 'Комитет по труду и занятости населения');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31541, 1, 'Комитет по управлению городским имуществом');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31542, 1, 'Комитет по физической культуре и спорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64236, 1, 'Комитет по экономической политике и стратегическому планированию Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31543, 1, 'Комитет по энергетике и инженерному обеспечению');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64238, 1, 'Комитет финансов Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64249, 2, 'Органы местного самоуправления');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31544, 1, 'Служба государственного строительного надзора и экспертизы Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31546, 1, 'Управление ветеринарии');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64234, 1, 'Управление по развитию садоводства и огородничества');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31545, 1, 'Управление социального питания');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64251, 2, 'Федеральный орган исполнительной власти');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8987, 2, 'Администрации районов');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (61488, 2, 'Администрации районов Санкт-Петербурга');


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 185
-- Name: organization_id_organization_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_id_organization_seq', 58, true);


--
-- TOC entry 2133 (class 0 OID 239038)
-- Dependencies: 186
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO organization_rank (id_organization_rank, organization_rank) VALUES (1, 'РОИВ');
INSERT INTO organization_rank (id_organization_rank, organization_rank) VALUES (2, 'АР,МУ,ВФ');


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 187
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_rank_id_organization_rank_seq', 2, true);


--
-- TOC entry 2135 (class 0 OID 239046)
-- Dependencies: 188
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (12, 1, 6, 'Статус согласования статуса полномочия', 'Статус согласования статуса полномочия', 'authority_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 9);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (72, 4, 6, 'Cрок ответа', 'Cрок ответа', 'srok_otveta', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 15);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (176, 2, 7, 'Способы предоставления услуги', 'Способы предоставления услуги', 'sr_6', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 22);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (178, 2, 7, 'Тип заявителя', 'Тип заявителя', 'sr_9', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 24);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (174, 2, 7, 'Сокращенное наименование для инфокиосков', 'Сокращенное наименование для инфокиосков', 'sr_4', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 20);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (15, 1, 7, 'Статус разработки услуги/функции', 'Статус разработки услуги/функции', 'service_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 11);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (17, 3, 7, 'Тип', 'Тип', 'service_type', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 13);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (10, 1, 6, 'Наименование ИОГВ СПб', 'Наименование ИОГВ СПб', 'name_iogv', '{"property_align":"left","property_width":"800","property_required":false,"property_color":"#4a85ed","property_show_other_users":false}', 8);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (8, 1, 6, 'Статус согласования статуса полномочия', 'Статус согласования статуса полномочия', 'executable_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":"on"}', 7);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (18, 3, 6, 'Cтатус разработки услуги/функции', 'Cтатус разработки услуги/функции', 'service_subject', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 14);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1037, 2, 8, 'Код и название целевой статьи бюджета Санкт-Петербурга', 'Код и название целевой статьи бюджета Санкт-Петербурга', 'sn_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 42);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1023, 2, 6, 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'rekvisit_npa', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 3);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1033, 2, 6, 'Проект постановления Правительства (наименование и дата согласования Юридическим комитетом)', 'Проект постановления Правительства', 'project_post', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 41);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (7, 2, 6, '№ пункта в положении об ИОГВ', '№ пункта в положении об ИОГВ', 'punkt_iogv', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 6);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1060, 2, 9, 'Предмет государственного контроля (надзора) и муниципального контроля ', 'Предмет государственного контроля (надзора) и муниципального контроля ', 'sk_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 43);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1049, 3, 8, 'Cведения о наличии необходимости формирования отчетности', 'Cведения о наличии необходимости формирования отчетности', 'sn_14', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 42);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (13, 2, 6, 'Наименование полномочия в соответствии с Положением об ИОГВ', 'Наименование полномочия в соответствии с Положением об ИОГВ', 'authority_name', '{"property_align":"left","property_width":"450","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 1);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (11, 1, 6, 'ID полномочия', 'ID полномочия', 'authority_id', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 2);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (19, 2, 6, 'Наименование информационной системы органа власти, с использованием которой осуществляется полномочие', 'Наименование информационной системы органа власти, с использованием которой осуществляется полномочие', 'information_system_roiv', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 7);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (173, 3, 7, 'Сфера предоставления', 'Сфера предоставления', 'sr_2', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 19);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1076, 5, 7, 'Жизненная ситуация', 'Жизненная ситуация', 'sr_25', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1079, 2, 7, 'Услуга является необходимой и обязательной для предоставления услуг', 'Услуга является необходимой и обязательной для предоставления услуг', 'sr_28', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1077, 3, 7, 'Категория услуги', 'Категория услуги', 'sr_26', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1333, 2, 6, 'РЕЕСТР', 'РЕЕСТР', 'kis_0', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 350);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1080, 2, 7, 'Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге', 'Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге', 'sr_29', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (75, 2, 7, 'Орган, предоставляющий услугу (исполняющий функцию)', 'Орган, предоставляющий услугу (исполняющий функцию)', 'sr_3', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 18);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (193, 2, 7, 'Технологическая карта межведомственного взаимодействия', 'Технологическая карта межведомственного взаимодействия', 'sr_23', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 39);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (74, 2, 7, 'Краткое наименование услуги (функции)', 'Краткое наименование услуги (функции)', 'sr_1', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 17);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1078, 2, 7, 'Наименование информационной системы, в которой учитывается результат', 'Наименование информационной системы, в которой учитывается результат', 'sr_27', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1334, 2, 6, 'РЕЕСТР Период внесения изменений', 'РЕЕСТР Период внесения изменений', 'kis_1', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 351);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1335, 2, 6, 'Внесены изменения в Положение об ИОГВ', 'Внесены изменения в Положение об ИОГВ', 'kis_2', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 352);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1336, 2, 6, 'Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)', 'Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)', 'kis_3', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 353);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1337, 2, 6, 'Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)', 'Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)', 'kis_4', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 354);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1338, 2, 6, '№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496', '№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496', 'kis_5', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 355);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1339, 2, 6, 'полномочие осуществляется с использованием ИС', 'полномочие осуществляется с использованием ИС', 'kis_6', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 356);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1340, 2, 6, 'Статус', 'Статус', 'kis_7', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 357);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1341, 2, 6, 'Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ', 'Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ', 'kis_8', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 358);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1342, 2, 6, 'Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)', 'Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)', 'kis_9', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 359);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1343, 2, 6, 'субъект предоставления услуг (физ/юр)', 'субъект предоставления услуг (физ/юр)', 'kis_10', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 360);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1344, 2, 6, '№ пункта Плана-графика 2013', '№ пункта Плана-графика 2013', 'kis_11', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 361);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1345, 2, 7, 'План-график 2013 (срок исполнения)', 'План-график 2013 (срок исполнения)', 'kis_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 362);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1346, 2, 7, 'План-график 2013 (требуется внесение изменений)', 'План-график 2013 (требуется внесение изменений)', 'kis_13', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 363);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1347, 2, 7, 'Продление срока по Плану 2013', 'Продление срока по Плану 2013', 'kis_14', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 364);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1348, 2, 7, 'Основание для продления срока по Плану 2013', 'Основание для продления срока по Плану 2013', 'kis_15', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 365);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1349, 2, 7, 'Исключение из Плана 2013', 'Исключение из Плана 2013', 'kis_16', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 366);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1350, 2, 7, 'Основание для исключения из Плана 2013', 'Основание для исключения из Плана 2013', 'kis_17', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 367);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1351, 2, 7, 'План 2013 исполнен', 'План 2013 исполнен', 'kis_18', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 368);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1352, 2, 7, '№ пункта Плана-графика 2014', '№ пункта Плана-графика 2014', 'kis_19', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 369);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1353, 2, 7, 'Срок исполнения План-графика 2014', 'Срок исполнения План-графика 2014', 'kis_20', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 370);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1354, 2, 7, 'Основание для включения услуги в План-график 2014', 'Основание для включения услуги в План-график 2014', 'kis_21', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 371);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1355, 2, 7, 'Основание для исключения из Плана 2014', 'Основание для исключения из Плана 2014', 'kis_22', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 372);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1356, 2, 7, 'План 2014 исполнение', 'План 2014 исполнение', 'kis_23', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 373);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1357, 2, 7, '№ пункта Плана-графика 2015', '№ пункта Плана-графика 2015', 'kis_24', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 374);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1358, 2, 7, 'Срок исполнения План-графика 2015', 'Срок исполнения План-графика 2015', 'kis_25', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 375);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1359, 2, 7, 'Основание для включения услуги в План-график 2015', 'Основание для включения услуги в План-график 2015', 'kis_26', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 376);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1360, 2, 7, 'Основание для исключения из Плана 2015', 'Основание для исключения из Плана 2015', 'kis_27', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 377);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1361, 2, 7, 'План 2015 исполнение', 'План 2015 исполнение', 'kis_28', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 378);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1362, 2, 7, 'Мониторинг в 2014 году', 'Мониторинг в 2014 году', 'kis_29', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 379);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1363, 2, 7, 'Проведен мониторинг в 2013 году', 'Проведен мониторинг в 2013 году', 'kis_30', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 380);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1364, 2, 7, 'Услуга включена в дорожную карту ИОГВ', 'Услуга включена в дорожную карту ИОГВ', 'kis_31', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 381);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1365, 2, 7, 'Результаты мониторинга 2013 года', 'Результаты мониторинга 2013 года', 'kis_32', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 382);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1366, 2, 7, '% удовлетворенности заявителей по услуге', '% удовлетворенности заявителей по услуге', 'kis_33', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 383);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1367, 2, 7, 'Срок исполнения мероприятий по ДК', 'Срок исполнения мероприятий по ДК', 'kis_34', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 384);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1368, 2, 7, 'Отметка о выполнении', 'Отметка о выполнении', 'kis_35', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 385);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1369, 2, 7, '№ пункта Плана-графика 2012', '№ пункта Плана-графика 2012', 'kis_36', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 386);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1370, 2, 7, 'План-график 2012 (месяц)', 'План-график 2012 (месяц)', 'kis_37', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 387);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1371, 2, 7, 'План-график 2012 Внесение изменений в АР', 'План-график 2012 Внесение изменений в АР', 'kis_38', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 388);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1372, 2, 7, 'Продление срока', 'Продление срока', 'kis_39', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 389);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1373, 2, 7, 'Исключение из Плана 2012', 'Исключение из Плана 2012', 'kis_40', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 390);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1374, 2, 7, 'Основание для исключения', 'Основание для исключения', 'kis_41', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 391);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1375, 2, 7, 'ПГ 2012 исполнен', 'ПГ 2012 исполнен', 'kis_42', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 392);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1376, 2, 7, '1593', '1593', 'kis_43', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 393);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1377, 2, 7, '1593 (ред. от 20.09.2012)', '1593 (ред. от 20.09.2012)', 'kis_44', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 394);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1378, 2, 7, 'Внесение изменений в 1593', 'Внесение изменений в 1593', 'kis_45', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 395);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1379, 2, 7, 'Реквизиты соглашения', 'Реквизиты соглашения', 'kis_46', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 396);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1380, 2, 7, 'Дата начала предоставления услуги в МФЦ', 'Дата начала предоставления услуги в МФЦ', 'kis_47', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 397);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1381, 2, 7, 'Реализация в МАИС МФЦ', 'Реализация в МАИС МФЦ', 'kis_48', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 398);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1382, 2, 7, '8-рп', '8-рп', 'kis_49', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 399);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1383, 2, 7, 'Внесение изменений в 8-рп', 'Внесение изменений в 8-рп', 'kis_50', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 400);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1384, 2, 7, 'Внесение изменений в 11-рп', 'Внесение изменений в 11-рп', 'kis_51', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 401);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1385, 2, 7, 'Реализация в АИС "ЭСРН" (Систематика)', 'Реализация в АИС "ЭСРН" (Систематика)', 'kis_52', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 402);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1386, 2, 7, 'Реализация по ГК в 2014 году', 'Реализация по ГК в 2014 году', 'kis_53', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 403);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1387, 2, 7, 'Реализация по ГК в 2014 году', 'Реализация по ГК в 2014 году', 'kis_54', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 404);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1388, 2, 7, '11-рп от 13.03.2014', '11-рп от 13.03.2014', 'kis_55', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 405);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1389, 2, 7, 'этап предоставления на Портале', 'этап предоставления на Портале', 'kis_56', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 406);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1390, 2, 7, 'Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014', 'Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014', 'kis_57', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 407);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1391, 2, 7, 'Возможность выдачи результата в электронном виде', 'Возможность выдачи результата в электронном виде', 'kis_58', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 408);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1392, 2, 7, 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг', 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг', 'kis_59', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 409);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1393, 2, 7, 'ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг', 'ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг', 'kis_60', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 410);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1394, 2, 7, 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")', 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")', 'kis_61', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 411);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1395, 2, 7, 'ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)', 'ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)', 'kis_62', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 412);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1396, 2, 7, 'ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг', 'ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг', 'kis_63', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 413);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1418, 2, 7, 'Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную', 'Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную', 'kis_85', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 435);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1397, 2, 7, 'ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг', 'ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг', 'kis_64', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 414);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1398, 2, 7, 'ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг', 'ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг', 'kis_65', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 415);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1399, 2, 7, 'ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг', 'ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг', 'kis_66', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 416);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1400, 2, 7, 'УЭК', 'УЭК', 'kis_67', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 417);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1401, 2, 7, 'Реализация на портале (Ростелеком)', 'Реализация на портале (Ростелеком)', 'kis_68', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 418);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1402, 2, 7, 'Актуализация по ЕПГУ', 'Актуализация по ЕПГУ', 'kis_69', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 419);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1403, 2, 7, '1993-р', '1993-р', 'kis_70', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 420);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1404, 2, 7, '729-р', '729-р', 'kis_71', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 421);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1405, 2, 7, 'реализация в электронном виде', 'реализация в электронном виде', 'kis_72', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 422);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1406, 2, 7, '51-рп', '51-рп', 'kis_73', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 423);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1407, 2, 7, 'Внесение изменений в 51-рп', 'Внесение изменений в 51-рп', 'kis_74', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 424);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1408, 2, 7, 'ТКМВ (реквизиты  протокола РГ МИВ)', 'ТКМВ (реквизиты  протокола РГ МИВ)', 'kis_75', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 425);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1409, 2, 7, 'ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)', 'ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)', 'kis_76', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 426);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1410, 2, 7, 'КАР', 'КАР', 'kis_77', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 427);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1411, 2, 7, 'Административный регламент утвержден распоряжением ИОГВ', 'Административный регламент утвержден распоряжением ИОГВ', 'kis_78', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 428);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1412, 2, 7, 'Реквизиты нормативных правовых актов изменений в АР', 'Реквизиты нормативных правовых актов изменений в АР', 'kis_79', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 429);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1413, 2, 7, 'Возмездная / Безвозмездная государственная услуга', 'Возмездная / Безвозмездная государственная услуга', 'kis_80', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 430);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1414, 2, 7, 'Сумма госпошлины', 'Сумма госпошлины', 'kis_81', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 431);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1415, 2, 7, 'Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'kis_82', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 432);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1416, 2, 7, 'Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'kis_83', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 433);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1417, 2, 7, 'Наименование услуги необходимой и обязательной,  содержащейся в постановлении Правительства Санкт-Петербурга от 03.02.2012 N 93', 'Наименование услуги необходимой и обязательной,  содержащейся в постановлении Правительства Санкт-Петербурга от 03.02.2012 N 93', 'kis_84', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 434);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1419, 2, 7, 'Стоимость услуги н.о.', 'Стоимость услуги н.о.', 'kis_86', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 436);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1420, 2, 7, 'Наименование услуги (документа) необходимой для предоставления государственной услуги', 'Наименование услуги (документа) необходимой для предоставления государственной услуги', 'kis_87', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 437);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1421, 2, 7, 'Наименование учреждения (организации), предоставляющей необходимую услугу', 'Наименование учреждения (организации), предоставляющей необходимую услугу', 'kis_88', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 438);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1422, 2, 7, 'Стоимость услуги необходимой для получения гос. услуги', 'Стоимость услуги необходимой для получения гос. услуги', 'kis_89', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 439);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1423, 2, 7, 'Результат предоставления услуги/исполнения функции', 'Результат предоставления услуги/исполнения функции', 'kis_90', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 440);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1424, 2, 7, 'Время ожидания в очереди', 'Время ожидания в очереди', 'kis_91', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 441);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1425, 2, 7, 'Требуется внесение изменений в АР', 'Требуется внесение изменений в АР', 'kis_92', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 442);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1426, 2, 7, '09.12.2014', '09.12.2014', 'kis_93', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 443);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1427, 2, 7, 'Результат согласования', 'Результат согласования', 'kis_94', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 444);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1428, 2, 7, '09.12.2014', '09.12.2014', 'kis_95', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 445);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1429, 2, 7, 'ФИО эксперта', 'ФИО эксперта', 'kis_96', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 446);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1430, 2, 7, 'Дата повторного поступления  на согласование', 'Дата повторного поступления  на согласование', 'kis_97', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 447);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1431, 2, 7, 'Результат повторного согласования', 'Результат повторного согласования', 'kis_98', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 448);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1432, 2, 7, 'Дата повторного согласования', 'Дата повторного согласования', 'kis_99', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 449);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1433, 2, 7, 'ФИО эксперта', 'ФИО эксперта', 'kis_100', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 450);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1434, 2, 7, 'Предварительная экспертиза ЮК (реквизиты письма)', 'Предварительная экспертиза ЮК (реквизиты письма)', 'kis_101', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 451);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1435, 2, 7, 'Результат предварительной экспертизы в ЮК', 'Результат предварительной экспертизы в ЮК', 'kis_102', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 452);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1436, 2, 7, 'Проект направлен в ЮК для вынесения на КАР (реквизиты письма)', 'Проект направлен в ЮК для вынесения на КАР (реквизиты письма)', 'kis_103', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 453);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1437, 2, 7, 'Отсутствует НПА на федеральном уровне', 'Отсутствует НПА на федеральном уровне', 'kis_104', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 454);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1438, 2, 7, 'Требуется внесение изменений в НПА на федеральном уровне', 'Требуется внесение изменений в НПА на федеральном уровне', 'kis_105', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 455);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1439, 2, 7, 'Отсутствует НПА СПб', 'Отсутствует НПА СПб', 'kis_106', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 456);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1440, 2, 7, 'Требуется внесение изменений в НПА СПб', 'Требуется внесение изменений в НПА СПб', 'kis_107', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 457);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1441, 2, 7, '№ п/п в соответствии с Перечнями №1 и №2 МЭР', '№ п/п в соответствии с Перечнями №1 и №2 МЭР', 'kis_108', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 458);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1442, 2, 7, 'Наименование в соответствии с Перечнями №1 и №2 МЭР', 'Наименование в соответствии с Перечнями №1 и №2 МЭР', 'kis_109', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 459);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1443, 2, 7, 'Комментарии Юридического Комитета', 'Комментарии Юридического Комитета', 'kis_110', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 460);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1444, 2, 7, 'Наименование функции (услуги)  в соответствии с федеральным законодательством', 'Наименование функции (услуги)  в соответствии с федеральным законодательством', 'kis_111', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 461);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1445, 2, 7, 'Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ', 'Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ', 'kis_112', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 462);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1446, 2, 7, 'Наименование функции в соответствии с законодательством Санкт-Петербурга', 'Наименование функции в соответствии с законодательством Санкт-Петербурга', 'kis_113', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 463);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1447, 2, 7, 'Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)', 'Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)', 'kis_114', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 464);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1448, 2, 7, 'Реквизиты НПА, закрепляющего перечень документов представления услуги', 'Реквизиты НПА, закрепляющего перечень документов представления услуги', 'kis_115', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 465);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1449, 2, 7, 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'kis_116', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 466);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1450, 2, 7, '133-ФЗ', '133-ФЗ', 'kis_117', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 467);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1451, 2, 7, 'Количество обращений за предоставление услуги  (за 2011 год)', 'Количество обращений за предоставление услуги  (за 2011 год)', 'kis_118', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 468);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1452, 2, 7, 'Количество обращений за предоставлением услуги (за 2013 год)', 'Количество обращений за предоставлением услуги (за 2013 год)', 'kis_119', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 469);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1453, 2, 7, 'Количество обращений за предоставление услуги', 'Количество обращений за предоставление услуги', 'kis_120', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 470);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1454, 2, 7, 'Количество обращений за предоставление услуги', 'Количество обращений за предоставление услуги', 'kis_121', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 471);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1455, 2, 7, 'Количество обращений за предоставление услуги  (на 1.11.2012)', 'Количество обращений за предоставление услуги  (на 1.11.2012)', 'kis_122', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 472);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1456, 2, 7, 'Формирование отчета по полномочиям', 'Формирование отчета по полномочиям', 'kis_123', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 473);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1457, 2, 7, 'Примечание', 'Примечание', 'kis_124', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 474);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1458, 2, 7, 'Идентификатор услуги', 'Идентификатор услуги', 'kis_125', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 475);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (187, 2, 7, 'Сведения о возмездности услуги', 'Сведения о возмездности услуги', 'sr_17', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 33);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (73, 2, 7, 'Наименование функции (услуги)', 'Наименование услуги (функции)', 'sr_0', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 16);


--
-- TOC entry 2136 (class 0 OID 239052)
-- Dependencies: 189
-- Data for Name: property_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_commits_id_property_commit_seq', 7, true);


--
-- TOC entry 2138 (class 0 OID 239060)
-- Dependencies: 191
-- Data for Name: property_format; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property_format (id_property_format, property_format_name) VALUES (1, 'system');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (2, 'textarea');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (3, 'select');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (4, 'date');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (5, 'multiselect');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (6, 'number');


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 192
-- Name: property_format_id_property_format_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_format_id_property_format_seq', 7, true);


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 193
-- Name: property_id_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_id_property_seq', 1458, true);


--
-- TOC entry 2141 (class 0 OID 239070)
-- Dependencies: 194
-- Data for Name: property_values; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property_values (property_value_id, property_id, value) VALUES (3, 206, 'hehe5                                                                                               ');
INSERT INTO property_values (property_value_id, property_id, value) VALUES (4, 1, 'test 54                                                                                             ');
INSERT INTO property_values (property_value_id, property_id, value) VALUES (5, 206, 'test 55                                                                                             ');


--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 195
-- Name: property_values_property_value_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_values_property_value_id_seq', 5, true);


--
-- TOC entry 2143 (class 0 OID 239075)
-- Dependencies: 196
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_id_service_seq', 17205, true);


--
-- TOC entry 2145 (class 0 OID 239083)
-- Dependencies: 198
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 199
-- Name: service_property_id_service_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_property_id_service_property_seq', 173030, true);


--
-- TOC entry 2147 (class 0 OID 239092)
-- Dependencies: 200
-- Data for Name: service_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO service_type (id_service_type, service_type_name) VALUES (6, 'Полномочие');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (7, 'Услуга');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (8, 'Функция');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (9, 'Функция по контролю и надзору');


--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 201
-- Name: service_type_id_service_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_type_id_service_type_seq', 10, true);


--
-- TOC entry 2149 (class 0 OID 239100)
-- Dependencies: 202
-- Data for Name: spher; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO spher (id_spher, name) VALUES (1, 'Безопасность и охрана правопорядка');
INSERT INTO spher (id_spher, name) VALUES (2, 'Государственные учреждения

');
INSERT INTO spher (id_spher, name) VALUES (3, 'Гражданство, регистрация, визы

');
INSERT INTO spher (id_spher, name) VALUES (4, 'Здравоохранение и медицина

');
INSERT INTO spher (id_spher, name) VALUES (5, 'Земельно-имущественные отношения

');
INSERT INTO spher (id_spher, name) VALUES (6, 'Информационные технологии и связь

');
INSERT INTO spher (id_spher, name) VALUES (7, 'Картография, гиодезия и гидрометеорология

');
INSERT INTO spher (id_spher, name) VALUES (8, 'Культура и искусство

');
INSERT INTO spher (id_spher, name) VALUES (9, 'Налоги и сборы

');
INSERT INTO spher (id_spher, name) VALUES (10, 'Некоммерческие организации');
INSERT INTO spher (id_spher, name) VALUES (11, 'Образование и наука

');
INSERT INTO spher (id_spher, name) VALUES (12, 'Предпринимательская деятельность

');
INSERT INTO spher (id_spher, name) VALUES (13, 'Природопользование и экология

');
INSERT INTO spher (id_spher, name) VALUES (14, 'Производство, строительство и торговля

');
INSERT INTO spher (id_spher, name) VALUES (15, 'Прочие услуги

');
INSERT INTO spher (id_spher, name) VALUES (16, 'Реклама и СМИ

');
INSERT INTO spher (id_spher, name) VALUES (17, 'Социальное обеспечение

');
INSERT INTO spher (id_spher, name) VALUES (18, 'Страхование

');
INSERT INTO spher (id_spher, name) VALUES (19, 'Таможенное дело

');
INSERT INTO spher (id_spher, name) VALUES (20, 'Транспорт и дорожное хозяйство

');
INSERT INTO spher (id_spher, name) VALUES (21, 'Экономика, финансы, статистика

');
INSERT INTO spher (id_spher, name) VALUES (22, 'Энергетика и природные ресурсы

');
INSERT INTO spher (id_spher, name) VALUES (23, 'Юридические услуги

');


--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 203
-- Name: spher_id_spher_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('spher_id_spher_seq', 24, true);


--
-- TOC entry 2151 (class 0 OID 239108)
-- Dependencies: 204
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 205
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 4, true);


--
-- TOC entry 1958 (class 2606 OID 239137)
-- Name: pk_activity_feed; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT pk_activity_feed PRIMARY KEY (id_activity_feed);


--
-- TOC entry 1960 (class 2606 OID 239139)
-- Name: pk_authority; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT pk_authority PRIMARY KEY (id_authority);


--
-- TOC entry 1962 (class 2606 OID 239141)
-- Name: pk_authority_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT pk_authority_property PRIMARY KEY (id_authority_property);


--
-- TOC entry 1964 (class 2606 OID 239143)
-- Name: pk_authority_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_status
    ADD CONSTRAINT pk_authority_status PRIMARY KEY (id_authority_status);


--
-- TOC entry 1966 (class 2606 OID 239145)
-- Name: pk_comment; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT pk_comment PRIMARY KEY (id_comment);


--
-- TOC entry 1968 (class 2606 OID 239147)
-- Name: pk_event_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event_type
    ADD CONSTRAINT pk_event_type PRIMARY KEY (id_event_type);


--
-- TOC entry 1970 (class 2606 OID 239149)
-- Name: pk_files; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY files
    ADD CONSTRAINT pk_files PRIMARY KEY (id_file);


--
-- TOC entry 1972 (class 2606 OID 239151)
-- Name: pk_history_log; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);


--
-- TOC entry 1974 (class 2606 OID 239153)
-- Name: pk_organization; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT pk_organization PRIMARY KEY (id_organization);


--
-- TOC entry 1976 (class 2606 OID 239155)
-- Name: pk_organization_rank; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization_rank
    ADD CONSTRAINT pk_organization_rank PRIMARY KEY (id_organization_rank);


--
-- TOC entry 1978 (class 2606 OID 239157)
-- Name: pk_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT pk_property PRIMARY KEY (id_property);


--
-- TOC entry 1982 (class 2606 OID 239159)
-- Name: pk_property_format; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_format
    ADD CONSTRAINT pk_property_format PRIMARY KEY (id_property_format);


--
-- TOC entry 1984 (class 2606 OID 239161)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT pk_service PRIMARY KEY (id_service);


--
-- TOC entry 1986 (class 2606 OID 239163)
-- Name: pk_service_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT pk_service_property PRIMARY KEY (id_service_property);


--
-- TOC entry 1988 (class 2606 OID 239165)
-- Name: pk_service_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_type
    ADD CONSTRAINT pk_service_type PRIMARY KEY (id_service_type);


--
-- TOC entry 1990 (class 2606 OID 239167)
-- Name: pk_spher; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY spher
    ADD CONSTRAINT pk_spher PRIMARY KEY (id_spher);


--
-- TOC entry 1980 (class 2606 OID 239169)
-- Name: property_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_comments
    ADD CONSTRAINT property_comments_pkey PRIMARY KEY (id_property_commit);


--
-- TOC entry 1991 (class 2606 OID 239170)
-- Name: fk_activity_reference_event_ty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_event_ty FOREIGN KEY (id_event_type) REFERENCES event_type(id_event_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1992 (class 2606 OID 239175)
-- Name: fk_activity_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1993 (class 2606 OID 239180)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1995 (class 2606 OID 239185)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1994 (class 2606 OID 239190)
-- Name: fk_authorit_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1996 (class 2606 OID 239195)
-- Name: fk_authorit_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1997 (class 2606 OID 239200)
-- Name: fk_comment_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1998 (class 2606 OID 239205)
-- Name: fk_comment_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_comment FOREIGN KEY (com_id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1999 (class 2606 OID 239210)
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2000 (class 2606 OID 239215)
-- Name: fk_organiza_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT fk_organiza_reference_organiza FOREIGN KEY (id_organization_rank) REFERENCES organization_rank(id_organization_rank) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2001 (class 2606 OID 239220)
-- Name: fk_property_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_property FOREIGN KEY (id_property_type) REFERENCES property_format(id_property_format) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2002 (class 2606 OID 239225)
-- Name: fk_property_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2003 (class 2606 OID 239230)
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2006 (class 2606 OID 239235)
-- Name: fk_service__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2007 (class 2606 OID 239240)
-- Name: fk_service__reference_service; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_service FOREIGN KEY (id_service) REFERENCES service(id_service) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2004 (class 2606 OID 239245)
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2005 (class 2606 OID 239250)
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2008 (class 2606 OID 239255)
-- Name: fk_users_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT fk_users_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-12-09 11:20:43

--
-- PostgreSQL database dump complete
--

