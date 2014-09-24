--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.8
-- Dumped by pg_dump version 9.2.8
-- Started on 2014-09-23 21:27:18

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 204 (class 3079 OID 11727)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 204
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 168 (class 1259 OID 91332)
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
-- TOC entry 169 (class 1259 OID 91338)
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
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 169
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE activity_feed_id_activity_feed_seq OWNED BY activity_feed.id_activity_feed;


--
-- TOC entry 170 (class 1259 OID 91340)
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
-- TOC entry 171 (class 1259 OID 91346)
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
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 171
-- Name: authority_id_authority_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_id_authority_seq OWNED BY authority.id_authority;


--
-- TOC entry 172 (class 1259 OID 91348)
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
-- TOC entry 173 (class 1259 OID 91354)
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
-- TOC entry 2154 (class 0 OID 0)
-- Dependencies: 173
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_property_id_authority_property_seq OWNED BY authority_property.id_authority_property;


--
-- TOC entry 174 (class 1259 OID 91356)
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 91362)
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
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 175
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE authority_status_id_authority_status_seq OWNED BY authority_status.id_authority_status;


--
-- TOC entry 176 (class 1259 OID 91364)
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
-- TOC entry 177 (class 1259 OID 91370)
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
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 177
-- Name: comment_id_comment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comment_id_comment_seq OWNED BY comment.id_comment;


--
-- TOC entry 178 (class 1259 OID 91372)
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 91378)
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
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 179
-- Name: event_type_id_event_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE event_type_id_event_type_seq OWNED BY event_type.id_event_type;


--
-- TOC entry 180 (class 1259 OID 91380)
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
-- TOC entry 181 (class 1259 OID 91386)
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
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 181
-- Name: files_id_file_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE files_id_file_seq OWNED BY files.id_file;


--
-- TOC entry 182 (class 1259 OID 91388)
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
-- TOC entry 183 (class 1259 OID 91394)
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
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 183
-- Name: history_log_id_history_log_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE history_log_id_history_log_seq OWNED BY history_log.id_history_log;


--
-- TOC entry 184 (class 1259 OID 91396)
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 91402)
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
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 185
-- Name: organization_id_organization_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_id_organization_seq OWNED BY organization.id_organization;


--
-- TOC entry 186 (class 1259 OID 91404)
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 91410)
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
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 187
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE organization_rank_id_organization_rank_seq OWNED BY organization_rank.id_organization_rank;


--
-- TOC entry 188 (class 1259 OID 91412)
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
-- TOC entry 202 (class 1259 OID 91616)
-- Name: property_commits; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_commits (
    id_property_commit integer NOT NULL,
    commit text,
    date_commit date,
    id_user integer
);


ALTER TABLE public.property_commits OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 91619)
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
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 203
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_commits_id_property_commit_seq OWNED BY property_commits.id_property_commit;


--
-- TOC entry 189 (class 1259 OID 91418)
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 91424)
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
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_format_id_property_format_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_format_id_property_format_seq OWNED BY property_format.id_property_format;


--
-- TOC entry 191 (class 1259 OID 91426)
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
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 191
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
-- TOC entry 192 (class 1259 OID 91428)
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
-- TOC entry 193 (class 1259 OID 91434)
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
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 193
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_id_service_seq OWNED BY service.id_service;


--
-- TOC entry 194 (class 1259 OID 91436)
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
-- TOC entry 195 (class 1259 OID 91443)
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
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 195
-- Name: service_property_id_service_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_property_id_service_property_seq OWNED BY service_property.id_service_property;


--
-- TOC entry 196 (class 1259 OID 91445)
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 91451)
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
-- TOC entry 2167 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_type_id_service_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_type_id_service_type_seq OWNED BY service_type.id_service_type;


--
-- TOC entry 198 (class 1259 OID 91453)
-- Name: spher; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE spher (
    id_spher integer NOT NULL,
    name text
);


ALTER TABLE public.spher OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 91459)
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
-- TOC entry 2168 (class 0 OID 0)
-- Dependencies: 199
-- Name: spher_id_spher_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE spher_id_spher_seq OWNED BY spher.id_spher;


--
-- TOC entry 200 (class 1259 OID 91461)
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
-- TOC entry 201 (class 1259 OID 91467)
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
-- TOC entry 2169 (class 0 OID 0)
-- Dependencies: 201
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_user_seq OWNED BY users.id_user;


--
-- TOC entry 1930 (class 2604 OID 91469)
-- Name: id_activity_feed; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed ALTER COLUMN id_activity_feed SET DEFAULT nextval('activity_feed_id_activity_feed_seq'::regclass);


--
-- TOC entry 1931 (class 2604 OID 91470)
-- Name: id_authority; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority ALTER COLUMN id_authority SET DEFAULT nextval('authority_id_authority_seq'::regclass);


--
-- TOC entry 1932 (class 2604 OID 91471)
-- Name: id_authority_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property ALTER COLUMN id_authority_property SET DEFAULT nextval('authority_property_id_authority_property_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 91472)
-- Name: id_authority_status; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_status ALTER COLUMN id_authority_status SET DEFAULT nextval('authority_status_id_authority_status_seq'::regclass);


--
-- TOC entry 1934 (class 2604 OID 91473)
-- Name: id_comment; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment ALTER COLUMN id_comment SET DEFAULT nextval('comment_id_comment_seq'::regclass);


--
-- TOC entry 1935 (class 2604 OID 91474)
-- Name: id_event_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY event_type ALTER COLUMN id_event_type SET DEFAULT nextval('event_type_id_event_type_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 91475)
-- Name: id_file; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files ALTER COLUMN id_file SET DEFAULT nextval('files_id_file_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 91476)
-- Name: id_history_log; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log ALTER COLUMN id_history_log SET DEFAULT nextval('history_log_id_history_log_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 91477)
-- Name: id_organization; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization ALTER COLUMN id_organization SET DEFAULT nextval('organization_id_organization_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 91478)
-- Name: id_organization_rank; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization_rank ALTER COLUMN id_organization_rank SET DEFAULT nextval('organization_rank_id_organization_rank_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 91479)
-- Name: id_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property ALTER COLUMN id_property SET DEFAULT nextval('property_id_property_seq'::regclass);


--
-- TOC entry 1948 (class 2604 OID 91621)
-- Name: id_property_commit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_commits ALTER COLUMN id_property_commit SET DEFAULT nextval('property_commits_id_property_commit_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 91480)
-- Name: id_property_format; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_format ALTER COLUMN id_property_format SET DEFAULT nextval('property_format_id_property_format_seq'::regclass);

--
-- Name: property_value_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_values ALTER COLUMN property_value_id SET DEFAULT nextval('property_values_property_value_id_seq'::regclass);
--
-- TOC entry 1942 (class 2604 OID 91481)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service ALTER COLUMN id_service SET DEFAULT nextval('service_id_service_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 91482)
-- Name: id_service_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property ALTER COLUMN id_service_property SET DEFAULT nextval('service_property_id_service_property_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 91483)
-- Name: id_service_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_type ALTER COLUMN id_service_type SET DEFAULT nextval('service_type_id_service_type_seq'::regclass);


--
-- TOC entry 1946 (class 2604 OID 91484)
-- Name: id_spher; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY spher ALTER COLUMN id_spher SET DEFAULT nextval('spher_id_spher_seq'::regclass);


--
-- TOC entry 1947 (class 2604 OID 91485)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2108 (class 0 OID 91332)
-- Dependencies: 168
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object) VALUES (7, 8981, 7, '2014-09-21 23:45:00', NULL, 6, 38);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object) VALUES (8, 474, 7, '2014-09-21 23:50:00', NULL, 6, 39);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object) VALUES (9, 474, 7, '2014-09-21 23:57:00', NULL, 6, 40);


--
-- TOC entry 2170 (class 0 OID 0)
-- Dependencies: 169
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('activity_feed_id_activity_feed_seq', 9, true);


--
-- TOC entry 2110 (class 0 OID 91340)
-- Dependencies: 170
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (38, 8981, 1, 'Наименование полномочия в соответствии с Положением об ИОГВ');
INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (39, 474, 1, 'Наименование полномочия в соответствии с Положением об ИОГВ');
INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (40, 474, 1, 'Наименование полномочия в соответствии с Положением об ИОГВ');


--
-- TOC entry 2171 (class 0 OID 0)
-- Dependencies: 171
-- Name: authority_id_authority_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_id_authority_seq', 40, true);


--
-- TOC entry 2112 (class 0 OID 91348)
-- Dependencies: 172
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (190, 7, 38, 'Наименование полномочия в соответствии с Положением об ИОГВ');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (191, 10, 38, 'Управление ветеринарии');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (192, 8, 38, 'в разработке');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (193, 1, 38, '<a href=structure/check_status_authority/38>Наименование полномочия в соответствии с Положением об ИОГВ</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (194, 11, 38, '<a href=structure/check_status_authority/38>8981 Наименование полномочия в соответствии с Положением об ИОГВ-65</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (195, 7, 39, '123');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (196, 10, 39, 'Администрация Фрунзенского района Санкт-Петербурга');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (197, 8, 39, 'в разработке');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (198, 1, 39, '<a href=structure/check_status_authority/39>Наименование полномочия в соответствии с Положением об ИОГВ</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (199, 11, 39, '<a href=structure/check_status_authority/39>474 123-35</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (200, 7, 40, '123');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (201, 10, 40, 'Администрация Фрунзенского района Санкт-Петербурга');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (202, 8, 40, 'в разработке');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (203, 1, 40, '<a href=structure/check_status_authority/40>Наименование полномочия в соответствии с Положением об ИОГВ</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (204, 11, 40, '<a href=structure/check_status_authority/40>474 123-88</a>');


--
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 173
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_property_id_authority_property_seq', 204, true);


--
-- TOC entry 2114 (class 0 OID 91356)
-- Dependencies: 174
-- Data for Name: authority_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority_status (id_authority_status, name) VALUES (1, 'Ожидает присвоения статуса');
INSERT INTO authority_status (id_authority_status, name) VALUES (2, 'Ожидает согласования статуса');
INSERT INTO authority_status (id_authority_status, name) VALUES (3, 'Полномочию присвоен статус');
INSERT INTO authority_status (id_authority_status, name) VALUES (4, 'Полномочие подлежит корректировке');


--
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 175
-- Name: authority_status_id_authority_status_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_status_id_authority_status_seq', 5, true);


--
-- TOC entry 2116 (class 0 OID 91364)
-- Dependencies: 176
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (63, 38, 154, NULL, 'Наименование полномочия в соответствии с Положением об ИОГВ', '2014-09-21 23:45:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (64, 39, 154, NULL, 'Наименование полномочия в соответствии с Положением об ИОГВ', '2014-09-21 23:50:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (65, 40, 154, NULL, 'Наименование полномочия в соответствии с Положением об ИОГВ', '2014-09-21 23:59:00');


--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 177
-- Name: comment_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_comment_seq', 65, true);


--
-- TOC entry 2118 (class 0 OID 91372)
-- Dependencies: 178
-- Data for Name: event_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO event_type (id_event_type, event_type_name) VALUES (7, 'new_authority');
INSERT INTO event_type (id_event_type, event_type_name) VALUES (8, 'authority_changed');
INSERT INTO event_type (id_event_type, event_type_name) VALUES (9, 'overdue_response_time');


--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 179
-- Name: event_type_id_event_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('event_type_id_event_type_seq', 9, true);


--
-- TOC entry 2120 (class 0 OID 91380)
-- Dependencies: 180
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (16, NULL, 'Таблица-01.xlsx', 'Таблица-01.xlsx', 38);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (17, NULL, '12.09_.2014_.docx', '12.09_.2014_.docx', 39);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (18, NULL, '12.09_.2014_.docx', '12.09_.2014_1.docx', 40);


--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 181
-- Name: files_id_file_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_file_seq', 18, true);


--
-- TOC entry 2122 (class 0 OID 91388)
-- Dependencies: 182
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 183
-- Name: history_log_id_history_log_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('history_log_id_history_log_seq', 6, true);


--
-- TOC entry 2124 (class 0 OID 91396)
-- Dependencies: 184
-- Data for Name: organization; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (1, 1, 'Администратор');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (2, 1, 'Комитет по информатизации и связи');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (458, 1, 'Администрация Василеостровского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (459, 1, 'Администрация Выборгского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (460, 1, 'Администрация Калининского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (461, 1, 'Администрация Кировского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (462, 1, 'Администрация Колпинского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (464, 1, 'Администрация Красногвардейского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (465, 1, 'Администрация Красносельского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (466, 1, 'Администрация Кронштадтcкого района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (467, 1, 'Администрация Курортного района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (468, 1, 'Администрация Московского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (469, 1, 'Администрация Невского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (470, 1, 'Администрация Петроградского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (471, 1, 'Администрация Петродворцового района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (472, 1, 'Администрация Приморского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (473, 1, 'Администрация Пушкинского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (474, 1, 'Администрация Фрунзенского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (475, 1, 'Администрация Центрального района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (476, 1, 'Администрация Адмиралтейского района Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8950, 1, 'Архивный комитет');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8951, 1, 'Государственная административно-техническая инспекция');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8952, 1, 'Государственная инспекция Санкт-Петербурга по надзору за техническим состоянием самоходных машин и других видов техники');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8953, 1, 'Жилищный комитет');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8954, 1, 'Комитет по градостроительству и архитектуре');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8955, 1, 'Комитет по благоустройству Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8956, 1, 'Комитет по вопросам законности, правопорядка и безопасности');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8957, 1, 'Комитет по государственному контролю, использованию и охране памятников истории и культуры');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8958, 1, 'Комитет по делам записи актов гражданского состояния');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8959, 1, 'Комитет по здравоохранению');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8960, 1, 'Комитет по земельным ресурсам и землеустройству');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8961, 1, 'Комитет по инвестициям Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8962, 1, 'Комитет по информатизации и связи');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8963, 1, 'Комитет по культуре');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8964, 1, 'Комитет по молодежной политике и взаимодействию с общественными организациями');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8965, 1, 'Комитет по науке и высшей школе');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8966, 1, 'Комитет по образованию');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8967, 1, 'Комитет по печати и взаимодействию со средствами массовой информации');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8968, 1, 'Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8969, 1, 'Комитет по развитию транспортной инфраструктуры Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8970, 1, 'Комитет по социальной политике Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8971, 1, 'Комитет по строительству');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8972, 1, 'Комитет по тарифам Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8973, 1, 'Комитет по транспорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8974, 1, 'Комитет по труду и занятости населения');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8975, 1, 'Комитет по управлению городским имуществом');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8976, 1, 'Комитет по физической культуре и спорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8977, 1, 'Комитет по энергетике и инженерному обеспечению');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8978, 1, 'Комитет по развитию предпринимательства и потребительского рынка Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8979, 1, 'Служба государственного строительного надзора и экспертизы Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8980, 1, 'Управление социального питания');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8981, 1, 'Управление ветеринарии');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8982, 1, 'Комитет по промышленной политике и инновациям Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8983, 1, 'Государственная жилищная инспекция Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8984, 1, 'Комитет по развитию туризма Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (61487, 1, 'Администрации районов Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64233, 1, 'Управление по развитию садоводства и огородничества');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64235, 1, 'Комитет по экономической политике и стратегическому планированию Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64237, 1, 'Комитет финансов Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64239, 1, 'Комитет по межнациональным отношениям и реализации миграционной политики');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64241, 1, 'Комитет государственного финансового контроля Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64243, 1, 'Комитет по государственному заказу Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64245, 1, 'Комитет по внешним связям');


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 185
-- Name: organization_id_organization_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_id_organization_seq', 58, true);


--
-- TOC entry 2126 (class 0 OID 91404)
-- Dependencies: 186
-- Data for Name: organization_rank; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO organization_rank (id_organization_rank, organization_rank) VALUES (1, '1');


--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 187
-- Name: organization_rank_id_organization_rank_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_rank_id_organization_rank_seq', 2, true);


--
-- TOC entry 2128 (class 0 OID 91412)
-- Dependencies: 188
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (10, 2, 6, 'Наименование ИОГВ СПб', 'Наименование ИОГВ СПб', 'name_iogv', '{"property_align":"left","property_width":"800","property_required":false,"property_color":"#cc9858"}', 3);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (8, 3, 6, 'Статус исполняемости', 'Статус исполняемости', 'executable_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 4);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (12, 1, 6, 'Статус согласования статуса полномочия', 'Статус согласования статуса полномочия', 'authority_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 5);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (3, 2, 6, 'Внесены изменения в Положение об ИОГВ', 'Внесены изменения в Положение об ИОГВ', 'igov_changes', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 6);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (7, 2, 6, '№ пункта в положении об ИОГВ', '№ пункта в положении об ИОГВ', 'punkt_iogv', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 7);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (74, 2, 7, 'Краткое наименование услуги', 'Краткое наименование услуги', 'sr_1', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 11);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (17, 3, 6, 'Тип', 'Тип', 'service_type', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 10);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (179, 2, 7, 'Категория заявителей', 'Категория заявителей', 'sr_10', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 20);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (190, 2, 7, 'Информация о внутриведомственных и межведомственных процедурах', '', 'sr_20', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 30);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (174, 2, 7, 'Перечень НПА РФ, регулирующих предоставление услуги', 'Перечень НПА РФ', 'sr_4', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 14);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (175, 2, 7, 'Перечень НПА СПб', '', 'sr_5', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 15);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (176, 2, 7, 'Способы предоставления услуги', 'Способы предоставления услуги', 'sr_6', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 16);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (177, 2, 7, 'Результат предоставления услуги', 'Результат предоставления услуги', 'sr_7', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 17);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (178, 2, 7, 'Тип заявителя', 'Тип заявителя', 'sr_9', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 19);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (72, 4, 6, 'Cрок ответа', 'Cрок ответа', NULL, '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ca4949","property_show_other_users":false}', 8);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (184, 2, 7, 'Основания для приостановления предоставления либо отказа в предоставлении услуги', '', 'sr_14', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 24);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (186, 2, 7, 'Способы получения этих документов', '', 'sr_16', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 26);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (173, 3, 7, 'Сфера предоставления', 'Сфера предоставления', 'sr_2', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 12);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (191, 2, 7, 'Сведения о порядке досудебного обжалования решений органа предоставляющего услугу', '', 'sr_21', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 31);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (192, 2, 7, 'Наличие межведомственного взаимодействия', '', 'sr_22', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 32);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (193, 2, 7, 'Технологическая карта межведомственного взаимодействия ', '', 'sr_23', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 33);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (75, 2, 7, 'Наименование органов, участвующих в предоставлении услуги', 'Наименование органов, участвующих в предоставлении услуги', 'sr_3', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 13);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (15, 1, 6, 'Статус разработки услуги/функции', 'Статус разработки услуги/функции', 'service_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 35);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (14, 1, 6, 'id государственной услуги/функции', 'id государственной услуги/функции', 'id_service', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 34);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (11, 1, 6, 'ID полномочия', 'ID полномочия', 'authority_id', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#f7f7f7"}', 2);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (18, 3, 6, 'субъект предоставления услуг (физ/юр)', 'субъект предоставления услуг (физ/юр)', 'service_subject', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#6e5858"}', 36);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (5, 2, 6, 'Реквизиты НПА', 'Реквизиты НПА', NULL, '{"property_align":"left","property_width":"200","property_required":"on","property_color":"#23eae7","property_show_other_users":"on"}', 37);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (73, 2, 7, 'Наименование услуги', 'Наименование услуги', 'sr_0', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 9);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1, 2, 6, 'Наименование полномочия в соответствии с Положением об ИОГВ', 'Наименование полномочия', 'authority_name', '{"property_align":"left","property_width":"450","property_required":"on","property_color":"#ddee33","property_show_other_users":"on"}', 1);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (180, 2, 7, 'Сведения о местах, в которых можно получить информацию', '', 'sr_11', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 21);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (182, 2, 7, 'Срок, в течение которого заявление должно быть зарегистрировано', '', 'sr_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 22);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (183, 2, 7, 'Максимальный срок ожидания в очереди', '', 'sr_13', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 23);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (185, 2, 7, 'Перечень необходимых документов', '', 'sr_15', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 25);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (187, 2, 7, 'Сведения о возмездности услуги', '', 'sr_17', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 27);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (188, 2, 7, 'Стоимость услуги', '', 'sr_18', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 28);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (189, 2, 7, 'Показатели доступности и качества услуги', '', 'sr_19', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 29);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (181, 2, 7, 'Срок предоставления', '', 'sr_8', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#a2a2a2"}', 18);


--
-- TOC entry 2142 (class 0 OID 91616)
-- Dependencies: 202
-- Data for Name: property_commits; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 203
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_commits_id_property_commit_seq', 1, false);


--
-- TOC entry 2129 (class 0 OID 91418)
-- Dependencies: 189
-- Data for Name: property_format; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property_format (id_property_format, property_format_name) VALUES (1, 'system');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (2, 'textarea');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (3, 'select');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (4, 'date');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (5, 'multiselect');
INSERT INTO property_format (id_property_format, property_format_name) VALUES (6, 'number');


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_format_id_property_format_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_format_id_property_format_seq', 7, true);


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 191
-- Name: property_id_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_id_property_seq', 205, true);


--
-- TOC entry 2132 (class 0 OID 91428)
-- Dependencies: 192
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 193
-- Name: service_id_service_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_id_service_seq', 16, true);


--
-- TOC entry 2134 (class 0 OID 91436)
-- Dependencies: 194
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 195
-- Name: service_property_id_service_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_property_id_service_property_seq', 289, true);


--
-- TOC entry 2136 (class 0 OID 91445)
-- Dependencies: 196
-- Data for Name: service_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO service_type (id_service_type, service_type_name) VALUES (6, 'Полномочие');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (7, 'Услуга');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (8, 'Функция');
INSERT INTO service_type (id_service_type, service_type_name) VALUES (9, 'Функция по контролю и надзору');


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_type_id_service_type_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_type_id_service_type_seq', 10, true);


--
-- TOC entry 2138 (class 0 OID 91453)
-- Dependencies: 198
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
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 199
-- Name: spher_id_spher_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('spher_id_spher_seq', 24, true);


--
-- TOC entry 2140 (class 0 OID 91461)
-- Dependencies: 200
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users (id_user, id_organization, user_name, password) VALUES (2, 1, 'kis', '$2a$08$Ni1aPhwW8yv6yryQtwJE0e/y6APiIqxfLA6wAThrvn3HgTFpbvODS');
INSERT INTO users (id_user, id_organization, user_name, password) VALUES (3, 2, 'iogv', '$2a$08$6/gOrlaxUf.NwVwiVhOXienIb1bzrhuEbu2WlNGn3AfW1QyQVAaS2');
INSERT INTO users (id_user, id_organization, user_name, password) VALUES (154, 474, 'ksk2004', NULL);


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 201
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 4, true);


--
-- TOC entry 1950 (class 2606 OID 91487)
-- Name: pk_activity_feed; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT pk_activity_feed PRIMARY KEY (id_activity_feed);


--
-- TOC entry 1952 (class 2606 OID 91489)
-- Name: pk_authority; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT pk_authority PRIMARY KEY (id_authority);


--
-- TOC entry 1954 (class 2606 OID 91491)
-- Name: pk_authority_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT pk_authority_property PRIMARY KEY (id_authority_property);


--
-- TOC entry 1956 (class 2606 OID 91493)
-- Name: pk_authority_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_status
    ADD CONSTRAINT pk_authority_status PRIMARY KEY (id_authority_status);


--
-- TOC entry 1958 (class 2606 OID 91495)
-- Name: pk_comment; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT pk_comment PRIMARY KEY (id_comment);


--
-- TOC entry 1960 (class 2606 OID 91497)
-- Name: pk_event_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event_type
    ADD CONSTRAINT pk_event_type PRIMARY KEY (id_event_type);


--
-- TOC entry 1962 (class 2606 OID 91499)
-- Name: pk_files; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY files
    ADD CONSTRAINT pk_files PRIMARY KEY (id_file);


--
-- TOC entry 1964 (class 2606 OID 91501)
-- Name: pk_history_log; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);


--
-- TOC entry 1966 (class 2606 OID 91503)
-- Name: pk_organization; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT pk_organization PRIMARY KEY (id_organization);


--
-- TOC entry 1968 (class 2606 OID 91505)
-- Name: pk_organization_rank; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization_rank
    ADD CONSTRAINT pk_organization_rank PRIMARY KEY (id_organization_rank);


--
-- TOC entry 1970 (class 2606 OID 91507)
-- Name: pk_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT pk_property PRIMARY KEY (id_property);


--
-- TOC entry 1972 (class 2606 OID 91509)
-- Name: pk_property_format; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_format
    ADD CONSTRAINT pk_property_format PRIMARY KEY (id_property_format);


--
-- TOC entry 1974 (class 2606 OID 91511)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT pk_service PRIMARY KEY (id_service);


--
-- TOC entry 1976 (class 2606 OID 91513)
-- Name: pk_service_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT pk_service_property PRIMARY KEY (id_service_property);


--
-- TOC entry 1978 (class 2606 OID 91515)
-- Name: pk_service_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_type
    ADD CONSTRAINT pk_service_type PRIMARY KEY (id_service_type);


--
-- TOC entry 1980 (class 2606 OID 91517)
-- Name: pk_spher; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY spher
    ADD CONSTRAINT pk_spher PRIMARY KEY (id_spher);


--
-- TOC entry 1982 (class 2606 OID 91519)
-- Name: pk_users; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT pk_users PRIMARY KEY (id_user);


--
-- TOC entry 1983 (class 2606 OID 91520)
-- Name: fk_activity_reference_event_ty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_event_ty FOREIGN KEY (id_event_type) REFERENCES event_type(id_event_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1984 (class 2606 OID 91525)
-- Name: fk_activity_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1985 (class 2606 OID 91530)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1987 (class 2606 OID 91535)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1986 (class 2606 OID 91540)
-- Name: fk_authorit_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1988 (class 2606 OID 91545)
-- Name: fk_authorit_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1989 (class 2606 OID 91550)
-- Name: fk_comment_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1990 (class 2606 OID 91555)
-- Name: fk_comment_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_comment FOREIGN KEY (com_id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1991 (class 2606 OID 91560)
-- Name: fk_comment_reference_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_users FOREIGN KEY (id_user) REFERENCES users(id_user) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1992 (class 2606 OID 91565)
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1993 (class 2606 OID 91570)
-- Name: fk_organiza_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT fk_organiza_reference_organiza FOREIGN KEY (id_organization_rank) REFERENCES organization_rank(id_organization_rank) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1994 (class 2606 OID 91575)
-- Name: fk_property_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_property FOREIGN KEY (id_property_type) REFERENCES property_format(id_property_format) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1995 (class 2606 OID 91580)
-- Name: fk_property_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1996 (class 2606 OID 91585)
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1999 (class 2606 OID 91590)
-- Name: fk_service__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2000 (class 2606 OID 91595)
-- Name: fk_service__reference_service; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_service FOREIGN KEY (id_service) REFERENCES service(id_service) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1997 (class 2606 OID 91600)
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1998 (class 2606 OID 91605)
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2001 (class 2606 OID 91610)
-- Name: fk_users_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT fk_users_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-09-23 21:27:21

--
-- PostgreSQL database dump complete
--

