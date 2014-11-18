--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.8
-- Dumped by pg_dump version 9.2.8
-- Started on 2014-11-07 02:52:11

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
-- TOC entry 168 (class 1259 OID 108212)
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
-- TOC entry 169 (class 1259 OID 108219)
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
-- TOC entry 170 (class 1259 OID 108221)
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
-- TOC entry 171 (class 1259 OID 108227)
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
-- TOC entry 172 (class 1259 OID 108229)
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
-- TOC entry 173 (class 1259 OID 108235)
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
-- TOC entry 174 (class 1259 OID 108237)
-- Name: authority_status; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authority_status (
    id_authority_status integer NOT NULL,
    name character varying(512)
);


ALTER TABLE public.authority_status OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 108243)
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
-- TOC entry 176 (class 1259 OID 108245)
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
-- TOC entry 177 (class 1259 OID 108251)
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
-- TOC entry 178 (class 1259 OID 108253)
-- Name: event_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE event_type (
    id_event_type integer NOT NULL,
    event_type_name character varying(2048)
);


ALTER TABLE public.event_type OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 108259)
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
-- TOC entry 180 (class 1259 OID 108261)
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
-- TOC entry 181 (class 1259 OID 108267)
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
-- TOC entry 182 (class 1259 OID 108269)
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
-- TOC entry 183 (class 1259 OID 108275)
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
-- TOC entry 184 (class 1259 OID 108277)
-- Name: organization; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization (
    id_organization integer NOT NULL,
    id_organization_rank integer,
    organization_name character varying(1024)
);


ALTER TABLE public.organization OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 108283)
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
-- TOC entry 186 (class 1259 OID 108285)
-- Name: organization_rank; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE organization_rank (
    id_organization_rank integer NOT NULL,
    organization_rank character varying(1024)
);


ALTER TABLE public.organization_rank OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 108291)
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
-- TOC entry 188 (class 1259 OID 108293)
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
-- TOC entry 189 (class 1259 OID 108299)
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
-- TOC entry 190 (class 1259 OID 108305)
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
-- TOC entry 191 (class 1259 OID 108307)
-- Name: property_format; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_format (
    id_property_format integer NOT NULL,
    property_format_name character varying(1024)
);


ALTER TABLE public.property_format OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 108313)
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
-- TOC entry 193 (class 1259 OID 108315)
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
-- TOC entry 194 (class 1259 OID 108317)
-- Name: property_values; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE property_values (
    property_value_id integer NOT NULL,
    property_id integer,
    value character(100)
);


ALTER TABLE public.property_values OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 108320)
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
-- TOC entry 196 (class 1259 OID 108322)
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
-- TOC entry 197 (class 1259 OID 108328)
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
-- TOC entry 198 (class 1259 OID 108330)
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
-- TOC entry 199 (class 1259 OID 108337)
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
-- TOC entry 200 (class 1259 OID 108339)
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE service_type (
    id_service_type integer NOT NULL,
    service_type_name character varying(1024)
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 108345)
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
-- TOC entry 202 (class 1259 OID 108347)
-- Name: spher; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE spher (
    id_spher integer NOT NULL,
    name text
);


ALTER TABLE public.spher OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 108353)
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
-- TOC entry 204 (class 1259 OID 108355)
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
-- TOC entry 205 (class 1259 OID 108361)
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
-- TOC entry 1937 (class 2604 OID 108363)
-- Name: id_activity_feed; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed ALTER COLUMN id_activity_feed SET DEFAULT nextval('activity_feed_id_activity_feed_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 108364)
-- Name: id_authority; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority ALTER COLUMN id_authority SET DEFAULT nextval('authority_id_authority_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 108365)
-- Name: id_authority_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property ALTER COLUMN id_authority_property SET DEFAULT nextval('authority_property_id_authority_property_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 108366)
-- Name: id_authority_status; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_status ALTER COLUMN id_authority_status SET DEFAULT nextval('authority_status_id_authority_status_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 108367)
-- Name: id_comment; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment ALTER COLUMN id_comment SET DEFAULT nextval('comment_id_comment_seq'::regclass);


--
-- TOC entry 1942 (class 2604 OID 108368)
-- Name: id_event_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY event_type ALTER COLUMN id_event_type SET DEFAULT nextval('event_type_id_event_type_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 108369)
-- Name: id_file; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files ALTER COLUMN id_file SET DEFAULT nextval('files_id_file_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 108370)
-- Name: id_history_log; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY history_log ALTER COLUMN id_history_log SET DEFAULT nextval('history_log_id_history_log_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 108371)
-- Name: id_organization; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization ALTER COLUMN id_organization SET DEFAULT nextval('organization_id_organization_seq'::regclass);


--
-- TOC entry 1946 (class 2604 OID 108372)
-- Name: id_organization_rank; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization_rank ALTER COLUMN id_organization_rank SET DEFAULT nextval('organization_rank_id_organization_rank_seq'::regclass);


--
-- TOC entry 1947 (class 2604 OID 108373)
-- Name: id_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property ALTER COLUMN id_property SET DEFAULT nextval('property_id_property_seq'::regclass);


--
-- TOC entry 1948 (class 2604 OID 108374)
-- Name: id_property_commit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_comments ALTER COLUMN id_property_commit SET DEFAULT nextval('property_commits_id_property_commit_seq'::regclass);


--
-- TOC entry 1949 (class 2604 OID 108375)
-- Name: id_property_format; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_format ALTER COLUMN id_property_format SET DEFAULT nextval('property_format_id_property_format_seq'::regclass);


--
-- TOC entry 1950 (class 2604 OID 108376)
-- Name: property_value_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_values ALTER COLUMN property_value_id SET DEFAULT nextval('property_values_property_value_id_seq'::regclass);


--
-- TOC entry 1951 (class 2604 OID 108377)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service ALTER COLUMN id_service SET DEFAULT nextval('service_id_service_seq'::regclass);


--
-- TOC entry 1953 (class 2604 OID 108378)
-- Name: id_service_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property ALTER COLUMN id_service_property SET DEFAULT nextval('service_property_id_service_property_seq'::regclass);


--
-- TOC entry 1954 (class 2604 OID 108379)
-- Name: id_service_type; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_type ALTER COLUMN id_service_type SET DEFAULT nextval('service_type_id_service_type_seq'::regclass);


--
-- TOC entry 1955 (class 2604 OID 108380)
-- Name: id_spher; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY spher ALTER COLUMN id_spher SET DEFAULT nextval('spher_id_spher_seq'::regclass);


--
-- TOC entry 1956 (class 2604 OID 108381)
-- Name: id_user; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id_user SET DEFAULT nextval('users_id_user_seq'::regclass);


--
-- TOC entry 2115 (class 0 OID 108212)
-- Dependencies: 168
-- Data for Name: activity_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (61, 31557, 7, '2014-11-06 20:27:00', NULL, 6, 8519, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (62, 31557, 8, '2014-11-06 20:32:00', NULL, 6, 8519, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (63, 31557, 7, '2014-11-07 00:29:00', NULL, 6, 8520, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (64, 31557, 7, '2014-11-07 00:30:00', NULL, 6, 8521, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (65, 31557, 8, '2014-11-07 00:41:00', NULL, 6, 8521, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (66, 31557, 8, '2014-11-07 00:55:00', NULL, 6, 8521, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (67, 31557, 8, '2014-11-07 00:57:00', NULL, 6, 8521, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (68, 31557, 8, '2014-11-07 00:57:00', NULL, 6, 8521, 1);
INSERT INTO activity_feed (id_activity_feed, id_organization, id_event_type, "time", message, id_service_type, id_object, status) VALUES (69, 31557, 8, '2014-11-07 02:33:00', NULL, 6, 8521, 1);


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 169
-- Name: activity_feed_id_activity_feed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('activity_feed_id_activity_feed_seq', 69, true);


--
-- TOC entry 2117 (class 0 OID 108221)
-- Dependencies: 170
-- Data for Name: authority; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (8519, 31557, 2, 'йцуйцу');
INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (8520, 31557, 1, '2 полномочие');
INSERT INTO authority (id_authority, id_organization, id_authority_status, authority_name) VALUES (8521, 31557, 2, '3 полномочие');


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 171
-- Name: authority_id_authority_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_id_authority_seq', 8521, true);


--
-- TOC entry 2119 (class 0 OID 108229)
-- Dependencies: 172
-- Data for Name: authority_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50585, 7, 8519, '123');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50586, 10, 8519, 'Комитет по науке и высшей школе');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50587, 19, 8519, 'фыв');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50588, 1033, 8519, '');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50589, 72, 8519, '12-11-2014');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50590, 8, 8519, 'в разработке');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50591, 18, 8519, 'КИС');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50592, 13, 8519, '<a href=agreeds/check_status_authority/8519>йцуйцу</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50593, 11, 8519, '<a href=agreeds/check_status_authority/8519> 123-59</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50596, 7, 8520, '123');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50597, 10, 8520, 'Комитет по науке и высшей школе');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50598, 19, 8520, '1');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50599, 1033, 8520, '');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50600, 72, 8520, '12-11-2014');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50601, 8, 8520, 'в разработке');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50602, 18, 8520, 'Отраслевой орган');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50603, 13, 8520, '<a href=agreeds/check_status_authority/8520>2 полномочие</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50604, 11, 8520, '<a href=agreeds/check_status_authority/8520> 123-17</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50605, 7, 8521, 'йц');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50606, 10, 8521, 'Комитет по науке и высшей школе');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50607, 19, 8521, 'й');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50608, 1033, 8521, '');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50609, 72, 8521, '13-11-2014');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50611, 18, 8521, 'КИС');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50612, 13, 8521, '<a href=agreeds/check_status_authority/8521>3 полномочие</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50613, 11, 8521, '<a href=agreeds/check_status_authority/8521> йц-2</a>');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50614, 1023, NULL, 'йцу');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50615, 1023, 8521, 'ывввыфыфывфффффффф');
INSERT INTO authority_property (id_authority_property, id_property, id_authority, value) VALUES (50610, 8, 8521, 'отправленно на доработку');


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 173
-- Name: authority_property_id_authority_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('authority_property_id_authority_property_seq', 50615, true);


--
-- TOC entry 2121 (class 0 OID 108237)
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
-- TOC entry 2123 (class 0 OID 108245)
-- Dependencies: 176
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (108, 8519, 5, NULL, 'фывфывфыв', '2014-11-06 20:27:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (109, 8519, 5, NULL, 'ыв', '2014-11-06 20:32:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (110, 8520, 5, NULL, '123', '2014-11-07 00:29:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (111, 8521, 5, NULL, 'что-то', '2014-11-07 00:41:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (112, 8521, 5, NULL, 'ФФЫ', '2014-11-07 01:17:00');
INSERT INTO comment (id_comment, id_authority, id_user, com_id_comment, message, "time") VALUES (113, 8521, 5, NULL, '2222', '2014-11-07 02:46:00');


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 177
-- Name: comment_id_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_comment_seq', 113, true);


--
-- TOC entry 2125 (class 0 OID 108253)
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
-- TOC entry 2127 (class 0 OID 108261)
-- Dependencies: 180
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (28, NULL, 'DDOS.doc', 'DDOS.doc', 8521);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (29, NULL, 'Article 4_Carrier Grade_LTC.pdf', 'Article_4_Carrier_Grade_LTC.pdf', 8521);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (30, NULL, 'doc_303no.pdf', 'doc_303no.pdf', 8521);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (31, NULL, 'nadezhnost_v_tekhnike_terminy_i_opredeleniya_ГОСТ Р 53480-2009.pdf', 'nadezhnost_v_tekhnike_terminy_i_opredeleniya_ГОСТ_Р_53480-2009.pdf', 8521);
INSERT INTO files (id_file, id_comment, name, file_name, id_authority) VALUES (32, NULL, 'Семинар Калинин.docx', 'Семинар_Калинин.docx', 8521);


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 181
-- Name: files_id_file_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('files_id_file_seq', 32, true);


--
-- TOC entry 2129 (class 0 OID 108269)
-- Dependencies: 182
-- Data for Name: history_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (39, '<a href="file_storage/property/предложения1.docx">предложения.docx</a>', '<a href="file_storage/property/предложения1.docx">предложения.docx</a>', '2014-11-06 20:35:00', 5, 193);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (40, '<a href="file_storage/property/Без_имени.png">Без имени.png</a>', '<a href="file_storage/property/Без_имени.png">Без имени.png</a>', '2014-11-06 20:35:00', 5, 193);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (41, 'Есть такие', 'Есть такие', '2014-11-07 00:47:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (42, 'Есть такие', '123', '2014-11-07 00:53:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (43, '123', 'йцу', '2014-11-07 00:54:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (44, 'ыввв', 'ыввв', '2014-11-07 00:55:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (45, 'ыввв', 'ывввыфыфыв', '2014-11-07 00:57:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (46, 'ывввыфыфыв', 'ывввыфыфывфффффффф', '2014-11-07 00:57:00', 5, 1023);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (47, 'Реклама и СМИ



', 'Безопасность и охрана правопорядка', '2014-11-07 02:33:00', 5, 173);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (48, 'Природопользование и экология



', 'Безопасность и охрана правопорядка', '2014-11-07 02:33:00', 5, 173);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (49, '<a href="file_storage/property/default.jpeg">default.jpeg</a>', NULL, '2014-11-07 02:33:00', 5, 193);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (50, '<a href="file_storage/property/Структурно-мат.подход_ч_.4_.doc">Структурно-мат.подход ч_.4_.doc</a>', NULL, '2014-11-07 02:33:00', 5, 193);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (51, '<a href="file_storage/property/Lecture_NeuroDynaPro.pdf">Lecture_NeuroDynaPro.pdf</a>', NULL, '2014-11-07 02:33:00', 5, 193);
INSERT INTO history_log (id_history_log, old, new, "time", id_user, id_property) VALUES (52, '<a href="file_storage/property/DDOS.doc">DDOS.doc</a>', NULL, '2014-11-07 02:33:00', 5, 193);


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 183
-- Name: history_log_id_history_log_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('history_log_id_history_log_seq', 52, true);


--
-- TOC entry 2131 (class 0 OID 108277)
-- Dependencies: 184
-- Data for Name: organization; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31560, 1, 'Комитет по природопользованию, охране окружающей среды и обеспечению экологической безопасности');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31562, 1, 'Комитет по промышленной политике и инновациям Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31538, 1, 'Комитет по тарифам Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31539, 1, 'Комитет по транспорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31540, 1, 'Комитет по труду и занятости населения');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31541, 1, 'Комитет по управлению городским имуществом');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31542, 1, 'Комитет по физической культуре и спорту');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31546, 1, 'Управление ветеринарии');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64234, 1, 'Управление по развитию садоводства и огородничества');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31545, 1, 'Управление социального питания');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64251, 2, 'Федеральный орган исполнительной власти');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8987, 2, 'Администрации районов');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (61488, 2, 'Администрации районов Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31568, 1, 'Архивный комитет');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64388, 2, 'ВФ');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31569, 1, 'Государственная административно-техническая инспекция');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31567, 1, 'Государственная жилищная инспекция Санкт-Петербурга');
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
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31561, 1, 'Комитет по развитию предпринимательства и потребительского рынка Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (8989, 1, 'Комитет по развитию транспортной инфраструктуры Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31547, 1, 'Комитет по развитию туризма Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31537, 1, 'Комитет по социальной политике Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31536, 1, 'Комитет по строительству');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64236, 1, 'Комитет по экономической политике и стратегическому планированию Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31543, 1, 'Комитет по энергетике и инженерному обеспечению');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64238, 1, 'Комитет финансов Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (64249, 2, 'Органы местного самоуправления');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31544, 1, 'Служба государственного строительного надзора и экспертизы Санкт-Петербурга');
INSERT INTO organization (id_organization, id_organization_rank, organization_name) VALUES (31563, 1, 'Государственная инспекция Санкт-Петербурга по надзору за техническим состоянием самоходных машин и других видов техники');


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 185
-- Name: organization_id_organization_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('organization_id_organization_seq', 58, true);


--
-- TOC entry 2133 (class 0 OID 108285)
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
-- TOC entry 2135 (class 0 OID 108293)
-- Dependencies: 188
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (8, 1, 6, 'Статус согласования полномочия', 'Статус согласования полномочия', 'executable_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":"on"}', 7);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (12, 1, 6, 'Статус согласования статуса полномочия', 'Статус согласования статуса полномочия', 'authority_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 9);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (72, 4, 6, 'Cрок ответа', 'Cрок ответа', 'srok_otveta', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 15);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (74, 2, 7, 'Краткое наименование услуги', 'Краткое наименование услуги', 'sr_1', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 17);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (176, 2, 7, 'Способы предоставления услуги', 'Способы предоставления услуги', 'sr_6', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 22);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (178, 2, 7, 'Тип заявителя', 'Тип заявителя', 'sr_9', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 24);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (187, 2, 7, 'Сведения о возмездности услуги', '', 'sr_17', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 33);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (18, 3, 6, 'Разработчик полномочия', 'Разработчик полномочия', 'service_subject', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 14);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (904, 2, NULL, 'РЕЕСТР', 'РЕЕСТР', 'kis_0', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 150);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (17, 3, NULL, 'Тип', 'Тип', 'service_type', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 13);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (174, 2, 7, 'Сокращенное наименование для инфокиосков', 'Сокращенное наименование для инфокиосков', 'sr_4', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 20);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (193, 2, 7, 'Технологическая карта межведомственного взаимодействия (при наличии межведомственного взаимодействия с федеральными органами исполнительной власти, органами государственных внебюджетных фондов, органами исполнительной власти субъектов Российской Федерации, органами местного самоуправления, учреждениями (организациями), участвующими в оказании услуги) ', 'Технологическая карта межведомственного взаимодействия', 'sr_23', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 39);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (10, 1, 6, 'Наименование ИОГВ СПб', 'Наименование ИОГВ СПб', 'name_iogv', '{"property_align":"left","property_width":"800","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 8);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (73, 2, 7, 'Наименование', 'Наименование услуги', 'sr_0', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 16);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (905, 2, NULL, 'РЕЕСТР Период внесения изменений', 'РЕЕСТР Период внесения изменений', 'kis_1', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 151);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (907, 2, NULL, 'Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)', 'Основание/ Дата внесения изменений в Положение (дата согласования КРИОГВ изменений в положение)', 'kis_3', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 1532);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (908, 2, NULL, 'Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)', 'Основание для исключения (Реквизиты НПА, регламентирующие исключение полномочия)', 'kis_4', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 154);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (909, 2, NULL, '№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496', '№ пункта в соответствии с ПП Правительства РФ от 30.05.2014 № 496', 'kis_5', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 155);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (910, 2, NULL, 'полномочие осуществляется с использованием ИС', 'полномочие осуществляется с использованием ИС', 'kis_6', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 156);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (911, 2, NULL, 'Статус', 'Статус', 'kis_7', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 157);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (912, 2, NULL, ' Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ', ' Услугу/функцию предоставляет Администрация района/ОМСУ/ФОИВ/ВФ/ГУ', 'kis_8', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 158);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (913, 2, NULL, 'Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)', 'Наименование процедуры в сфере жилищного строительства (распоряжение Правительства РФ)', 'kis_9', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 159);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (15, 1, 7, 'Статус разработки услуги/функции', 'Статус разработки услуги/функции', 'service_status', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 11);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (914, 2, NULL, 'субъект предоставления услуг (физ/юр)', 'субъект предоставления услуг (физ/юр)', 'kis_10', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 160);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (915, 2, NULL, '№ пункта Плана-графика 2013', '№ пункта Плана-графика 2013', 'kis_11', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 161);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (916, 2, NULL, 'План-график 2013 (срок исполнения)', 'План-график 2013 (срок исполнения)', 'kis_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 162);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (917, 2, NULL, 'План-график 2013 (требуется внесение изменений)', 'План-график 2013 (требуется внесение изменений)', 'kis_13', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 163);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (918, 2, NULL, 'Продление срока по Плану 2013', 'Продление срока по Плану 2013', 'kis_14', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 164);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (919, 2, NULL, 'Основание для продления срока по Плану 2013', 'Основание для продления срока по Плану 2013', 'kis_15', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 165);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (920, 2, NULL, 'Исключение из Плана 2013', 'Исключение из Плана 2013', 'kis_16', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 166);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (921, 2, NULL, 'Основание для исключения из Плана 2013', 'Основание для исключения из Плана 2013', 'kis_17', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 167);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (922, 2, NULL, 'План 2013 исполнен', 'План 2013 исполнен', 'kis_18', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 168);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (923, 2, NULL, '№ пункта Плана-графика 2014', '№ пункта Плана-графика 2014', 'kis_19', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 169);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (924, 2, NULL, 'Срок исполнения План-графика 2014', 'Срок исполнения План-графика 2014', 'kis_20', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 170);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (925, 2, NULL, 'Основание для включения услуги в План-график 2014', 'Основание для включения услуги в План-график 2014', 'kis_21', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 171);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (927, 2, NULL, 'План 2014

исполнение', 'План 2014

исполнение', 'kis_23', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 173);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (928, 2, NULL, '№ пункта Плана-графика 2015', '№ пункта Плана-графика 2015', 'kis_24', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 174);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (929, 2, NULL, 'Срок исполнения План-графика 2015', 'Срок исполнения План-графика 2015', 'kis_25', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 175);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (981, 2, NULL, 'КАР', 'КАР', 'kis_77', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 227);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (930, 2, NULL, 'Основание для включения услуги в План-график 2015', 'Основание для включения услуги в План-график 2015', 'kis_26', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 176);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (931, 2, NULL, 'Основание для исключения из Плана 2015', 'Основание для исключения из Плана 2015', 'kis_27', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 177);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (932, 2, NULL, 'План 2015

исполнение', 'План 2015

исполнение', 'kis_28', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 178);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (933, 2, NULL, 'Мониторинг в 2014 году', 'Мониторинг в 2014 году', 'kis_29', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 179);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (934, 2, NULL, 'Проведен мониторинг в 2013 году', 'Проведен мониторинг в 2013 году', 'kis_30', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 180);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (935, 2, NULL, 'Услуга включена в дорожную карту ИОГВ', 'Услуга включена в дорожную карту ИОГВ', 'kis_31', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 181);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (936, 2, NULL, 'Результаты мониторинга 2013 года', 'Результаты мониторинга 2013 года', 'kis_32', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 182);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (937, 2, NULL, '%

удовлетворенности заявителей по услуге', '%

удовлетворенности заявителей по услуге', 'kis_33', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 183);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (938, 2, NULL, 'Срок исполнения мероприятий по ДК', 'Срок исполнения мероприятий по ДК', 'kis_34', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 184);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (939, 2, NULL, 'Отметка о выполнении', 'Отметка о выполнении', 'kis_35', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 185);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (940, 2, NULL, '№ пункта Плана-графика 2012', '№ пункта Плана-графика 2012', 'kis_36', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 186);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (941, 2, NULL, 'План-график 2012 (месяц)', 'План-график 2012 (месяц)', 'kis_37', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 187);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (942, 2, NULL, 'План-график 2012 Внесение изменений в АР', 'План-график 2012 Внесение изменений в АР', 'kis_38', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 188);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (943, 2, NULL, 'Продление срока', 'Продление срока', 'kis_39', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 189);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (944, 2, NULL, 'Исключение из Плана 2012', 'Исключение из Плана 2012', 'kis_40', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 190);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (945, 2, NULL, 'Основание для исключения', 'Основание для исключения', 'kis_41', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 191);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (946, 2, NULL, 'ПГ 2012 исполнен', 'ПГ 2012 исполнен', 'kis_42', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 192);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (947, 2, NULL, '1593', '1593', 'kis_43', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 193);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (948, 2, NULL, '1593 (ред. от 20.09.2012)', '1593 (ред. от 20.09.2012)', 'kis_44', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 194);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (949, 2, NULL, 'Внесение изменений в 1593', 'Внесение изменений в 1593', 'kis_45', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 195);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (950, 2, NULL, 'Реквизиты соглашения', 'Реквизиты соглашения', 'kis_46', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 196);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (994, 2, NULL, 'Комментарии', 'Комментарии', 'kis_90', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 240);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (952, 2, NULL, 'Реализация в МАИС МФЦ', 'Реализация в МАИС МФЦ', 'kis_48', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 198);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (955, 2, NULL, 'Внесение изменений в 11-рп', 'Внесение изменений в 11-рп', 'kis_51', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 201);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (956, 2, NULL, 'Реализация в АИС "ЭСРН" (Систематика)', 'Реализация в АИС "ЭСРН" (Систематика)', 'kis_52', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 202);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (957, 2, NULL, 'Реализация по ГК в 2014 году', 'Реализация по ГК в 2014 году', 'kis_53', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 203);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (958, 2, NULL, 'Реализация по ГК в 2014 году ', 'Реализация по ГК в 2014 году ', 'kis_54', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 204);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (959, 2, NULL, '11-рп от 13.03.2014', '11-рп от 13.03.2014', 'kis_55', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 205);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (960, 2, NULL, 'этап предоставления на Портале', 'этап предоставления на Портале', 'kis_56', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 206);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (961, 2, NULL, 'Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014', 'Внесение изменений в 8-рп в редакции 11-рп от 13.03.2014', 'kis_57', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 207);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (962, 2, NULL, 'Возможность выдачи результата в электронном виде', 'Возможность выдачи результата в электронном виде', 'kis_58', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 208);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (964, 2, NULL, 'ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг', 'ГК 2014 - Развитие МАИС (подлежат модернизации по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 27 услуг', 'kis_60', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 210);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (965, 2, NULL, 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")', 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - статическая реализация услуг) - 3 услуги (в ГК - 4, нет "8 тонн")', 'kis_61', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 211);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (966, 2, NULL, 'ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)', 'ГК 2014 - Развитие МАИС (перечень платежей, которые разрабатываются на Портале и в мобильных приложениях на безе Android и iOS)', 'kis_62', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 212);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (967, 2, NULL, 'ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг', 'ГК 2014 - Развитие МАИС (электронные ГУ, разрабатываются в ЭДО МФЦ) - 15 услуг', 'kis_63', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 213);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (968, 2, NULL, 'ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг', 'ГК 2014 - Развитие МАИС (электронные услуги КСП, модернизируются по результатам интеграции МАИС ЭГУ с АИС ЭСРН) - 96 услуг', 'kis_64', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 214);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (969, 2, NULL, 'ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг', 'ГК 2014 - Развитие МАИС (реализуются в ЭДО МФЦ, предоставляются юридическим лицам) - 55 услуг', 'kis_65', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 215);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (993, 2, NULL, 'Наименование "подуслуги"', 'Наименование "подуслуги"', 'kis_89', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 239);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (970, 2, NULL, 'ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг', 'ГК 2014 - Развитие МАИС ЭГУ (административные процедуры 2-й очереди, разрабатываемые в 2014 году в ЭДО МФЦ) - 20 услуг', 'kis_66', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 216);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (972, 2, NULL, 'Реализация на портале (Ростелеком)', 'Реализация на портале (Ростелеком)', 'kis_68', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 218);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (973, 2, NULL, 'Актуализация по ЕПГУ', 'Актуализация по ЕПГУ', 'kis_69', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 219);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (974, 2, NULL, '1993-р', '1993-р', 'kis_70', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 220);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (975, 2, NULL, '729-р', '729-р', 'kis_71', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 221);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (976, 2, NULL, 'реализация в электронном виде', 'реализация в электронном виде', 'kis_72', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 222);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (977, 2, NULL, '51-рп', '51-рп', 'kis_73', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 223);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (978, 2, NULL, 'Внесение изменений в 51-рп', 'Внесение изменений в 51-рп', 'kis_74', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 224);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (979, 2, NULL, 'ТКМВ

(реквизиты  протокола РГ МИВ)', 'ТКМВ

(реквизиты  протокола РГ МИВ)', 'kis_75', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 225);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (980, 2, NULL, 'ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)', 'ТКМВ внесение изменений (реквизиты  протокола РГ МИВ)', 'kis_76', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 226);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (983, 2, NULL, 'Реквизиты нормативных правовых актов изменений в АР', 'Реквизиты нормативных правовых актов изменений в АР', 'kis_79', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 229);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (984, 2, NULL, 'Возмездная / Безвозмездная государственная услуга', 'Возмездная / Безвозмездная государственная услуга', 'kis_80', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 230);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (985, 2, NULL, 'Сумма госпошлины', 'Сумма госпошлины', 'kis_81', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 231);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (986, 2, NULL, 'Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'Количество взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'kis_82', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 232);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (987, 2, NULL, 'Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'Наименование взаимодействий ЮЛ/ФЛ и ИОГВ при предоставлении гос. услуги', 'kis_83', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 233);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (988, 2, NULL, 'Наименование услуги необходимой и обязательной, 

содержащейся в

постановлении

Правительства Санкт-Петербурга

от 03.02.2012 N 93', 'Наименование услуги необходимой и обязательной, 

содержащейся в

постановлении

Правительства Санкт-Петербурга

от 03.02.2012 N 93', 'kis_84', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 234);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (989, 2, NULL, 'Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную', 'Наименование учреждения (организации), предоставляющей услугу необходимую и обязательную', 'kis_85', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 235);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (990, 2, NULL, 'Стоимость услуги н.о.', 'Стоимость услуги н.о.', 'kis_86', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 236);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (991, 2, NULL, 'Наименование услуги (документа) необходимой для предоставления государственной услуги', 'Наименование услуги (документа) необходимой для предоставления государственной услуги', 'kis_87', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 237);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (992, 2, NULL, 'Соответствие с 93', 'Соответствие с 93', 'kis_88', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 238);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (995, 2, NULL, 'Наименование учреждения (организации), предоставляющей необходимую услугу', 'Наименование учреждения (организации), предоставляющей необходимую услугу', 'kis_91', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 241);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (997, 2, NULL, 'Результат предоставления услуги/исполнения функции', 'Результат предоставления услуги/исполнения функции', 'kis_93', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 243);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (998, 2, NULL, 'Время ожидания в очереди', 'Время ожидания в очереди', 'kis_94', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 244);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (999, 2, NULL, 'Требуется внесение изменений в АР', 'Требуется внесение изменений в АР', 'kis_95', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 245);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1000, 2, NULL, '03.10.2014', '03.10.2014', 'kis_96', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 246);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1001, 2, NULL, 'Результат согласования ', 'Результат согласования ', 'kis_97', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 247);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1002, 2, NULL, '03.10.2014', '03.10.2014', 'kis_98', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 248);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1003, 2, NULL, 'ФИО эксперта', 'ФИО эксперта', 'kis_99', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 249);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1004, 2, NULL, 'Дата повторного поступления  на согласование', 'Дата повторного поступления  на согласование', 'kis_100', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 250);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1005, 2, NULL, 'Результат повторного согласования ', 'Результат повторного согласования ', 'kis_101', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 251);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1006, 2, NULL, 'Дата повторного согласования ', 'Дата повторного согласования ', 'kis_102', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 252);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1007, 2, NULL, 'ФИО эксперта', 'ФИО эксперта', 'kis_103', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 253);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1009, 2, NULL, 'Результат предварительной экспертизы в ЮК', 'Результат предварительной экспертизы в ЮК', 'kis_105', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 255);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1010, 2, NULL, 'Проект направлен в ЮК для вынесения на КАР (реквизиты письма)', 'Проект направлен в ЮК для вынесения на КАР (реквизиты письма)', 'kis_106', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 256);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1011, 2, NULL, 'Отсутствует НПА на федеральном уровне', 'Отсутствует НПА на федеральном уровне', 'kis_107', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 257);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1012, 2, NULL, 'Требуется внесение изменений в НПА на федеральном уровне', 'Требуется внесение изменений в НПА на федеральном уровне', 'kis_108', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 258);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1013, 2, NULL, 'Отсутствует НПА СПб', 'Отсутствует НПА СПб', 'kis_109', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 259);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1014, 2, NULL, 'Требуется внесение изменений в НПА СПб', 'Требуется внесение изменений в НПА СПб', 'kis_110', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 260);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1015, 2, NULL, '№ п/п в соответствии с Перечнями №1 и №2 МЭР', '№ п/п в соответствии с Перечнями №1 и №2 МЭР', 'kis_111', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 261);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1016, 2, NULL, 'Наименование в соответствии с Перечнями №1 и №2 МЭР', 'Наименование в соответствии с Перечнями №1 и №2 МЭР', 'kis_112', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 262);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1017, 2, NULL, 'Комментарии Юридического Комитета', 'Комментарии Юридического Комитета', 'kis_113', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 263);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (926, 2, NULL, 'Основание для исключения из Плана 2014', 'Основание для исключения из Плана 2014', 'kis_22', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 172);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1018, 2, NULL, 'Наименование функции (услуги)  в соответствии с федеральным законодательством', 'Наименование функции (услуги)  в соответствии с федеральным законодательством', 'kis_114', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 264);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1019, 2, NULL, 'Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ', 'Реквизиты НПА федерального уровня, которым функция (полномочие) закреплено (отнесено к ведению) за субъектом РФ', 'kis_115', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 265);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1021, 2, NULL, 'Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)', 'Реквизиты НПА регионального уровня, которым функция (полномочие) закреплено (порядок предоставления услуги)', 'kis_117', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 267);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1022, 2, NULL, 'Реквизиты НПА, закрепляющего перечень документов представления услуги', 'Реквизиты НПА, закрепляющего перечень документов представления услуги', 'kis_118', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 268);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1023, 2, 6, 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня', 'rekvisit_npa', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 3);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1024, 2, NULL, '133-ФЗ', '133-ФЗ', 'kis_120', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 269);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1025, 2, NULL, 'Количество обращений за предоставление услуги

 (за 2011 год)', 'Количество обращений за предоставление услуги

 (за 2011 год)', 'kis_121', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 270);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1026, 2, NULL, 'Количество обращений за предоставлением услуги

(за 2013 год)', 'Количество обращений за предоставлением услуги

(за 2013 год)', 'kis_122', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 271);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1027, 2, NULL, 'Количество обращений за предоставление услуги', 'Количество обращений за предоставление услуги', 'kis_123', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 272);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1028, 2, NULL, 'Количество обращений за предоставление услуги', 'Количество обращений за предоставление услуги', 'kis_124', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 273);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1029, 2, NULL, 'Количество обращений за предоставление услуги

 (на 1.11.2012)', 'Количество обращений за предоставление услуги

 (на 1.11.2012)', 'kis_125', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 274);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1030, 2, NULL, 'Формирование отчета по полномочиям', 'Формирование отчета по полномочиям', 'kis_126', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 275);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1031, 2, NULL, 'Примечание', 'Примечание', 'kis_127', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 276);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1032, 2, NULL, 'Идентификатор услуги', 'Идентификатор услуги', 'kis_128', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 277);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1033, 2, 6, 'Проект постановления Правительства (наименование и дата согласования Юридическим комитетом)', 'Проект постановления Правительства', 'project_post', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 41);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (996, 2, NULL, 'Стоимость услуги необходимой для получения гос. услуги', 'Стоимость услуги необходимой для получения гос. услуги', 'kis_92', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 242);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (963, 2, NULL, 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг', 'ГК 2014 - Развитие МАИС (разрабатываются по 4 и 5 этапам перевода в электронный вид - динамическая реализация услуг) - 20 услуг', 'kis_59', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 209);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (971, 2, NULL, ' УЭК                 ', ' УЭК                 ', 'kis_67', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 217);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (7, 2, 6, '№ пункта в положении об ИОГВ', '№ пункта в положении об ИОГВ', 'punkt_iogv', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 6);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (906, 2, NULL, 'Внесены изменения в Положение об ИОГВ', 'Внесены изменения в Положение об ИОГВ', 'kis_2', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 152);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1060, 2, 9, 'Предмет государственного контроля (надзора) и муниципального контроля ', 'Предмет государственного контроля (надзора) и муниципального контроля ', 'sk_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 43);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1049, 3, 8, 'Cведения о наличии необходимости формирования отчетности', 'Cведения о наличии необходимости формирования отчетности', 'sn_14', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 42);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1037, 2, 8, 'Код и название целевой статьи бюджета Санкт-Петербурга', 'Код и название целевой статьи бюджета Санкт-Петербурга', 'sn_12', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 42);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (75, 2, 7, 'Наименование органов, участвующих в предоставлении услуги (исполнении функции)', 'Орган, предоставляющий услугу (исполняющий функцию)', 'sr_3', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 18);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (951, 2, NULL, 'Дата начала предоставления услуги в МФЦ', 'Дата начала предоставления услуги в МФЦ', 'kis_47', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 197);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (953, 2, NULL, '8-рп', '8-рп', 'kis_49', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 199);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (954, 2, NULL, 'Внесение изменений в 8-рп', 'Внесение изменений в 8-рп', 'kis_50', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 200);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (982, 2, NULL, 'Административный регламент утвержден распоряжением ИОГВ', 'Административный регламент утвержден распоряжением ИОГВ', 'kis_78', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 228);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (13, 2, 6, 'Наименование полномочия в соответствии с Положением об ИОГВ', 'Наименование полномочия в соответствии с Положением об ИОГВ', 'authority_name', '{"property_align":"left","property_width":"450","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 1);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1008, 2, NULL, 'Предварительная экспертиза ЮК (реквизиты письма)', 'Предварительная экспертиза ЮК (реквизиты письма)', 'kis_104', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 254);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1020, 2, NULL, 'Наименование функции в соответствии с законодательством Санкт-Петербурга ', 'Наименование функции в соответствии с законодательством Санкт-Петербурга ', 'kis_116', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_iogv_displayed":false}', 266);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (11, 1, 6, 'ID полномочия', 'ID полномочия', 'authority_id', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 2);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (19, 2, 6, 'Наименование информационной системы органа власти, с использованием которой осуществляется полномочие', 'Наименование информационной системы органа власти, с использованием которой осуществляется полномочие', 'information_system_roiv', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff","property_show_other_users":false}', 7);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (173, 3, 7, 'Сфера предоставления', 'Сфера предоставления', 'sr_2', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 19);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1076, 5, 7, 'Жизненная ситуация', 'Жизненная ситуация', 'sr_25', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1079, 2, 7, 'Услуга является необходимой и обязательной для предоставления услуг', 'Услуга является необходимой и обязательной для предоставления услуг', 'sr_28', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1077, 3, 7, 'Категория услуги', 'Категория услуги', 'sr_26', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1080, 2, 7, 'Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге', 'Дата и номер протокола Комиссии по проведению административной реформы в Санкт-Петербурге', 'sr_29', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);
INSERT INTO property (id_property, id_property_type, id_service_type, property_name, property_short_name, code, options, "order") VALUES (1078, 2, 7, 'Наименвоание Информационной системы', 'Наименвоание Информационной системы', 'sr_27', '{"property_align":"left","property_width":"200","property_required":false,"property_color":"#ffffff"}', 40);


--
-- TOC entry 2136 (class 0 OID 108299)
-- Dependencies: 189
-- Data for Name: property_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (1, '2014-10-27 02:40:00', 53719, 'Не нравится этот файл', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (2, '2014-10-27 02:40:00', 53718, 'И этот', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (3, '2014-10-27 03:08:00', 53718, '', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (4, '2014-11-06 17:13:00', 53781, 'Информация правильна', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (5, '2014-11-06 18:36:00', 53795, 'Что-то', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (6, '2014-11-06 18:43:00', 53795, 'где-то', 'Kis_user');
INSERT INTO property_comments (id_property_commit, date_comment, id_service_property, comment, "user") VALUES (7, '2014-11-06 19:27:00', 53800, 'Нужно нет', 'Kis_user');


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('property_commits_id_property_commit_seq', 7, true);


--
-- TOC entry 2138 (class 0 OID 108307)
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

SELECT pg_catalog.setval('property_id_property_seq', 1080, true);


--
-- TOC entry 2141 (class 0 OID 108317)
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
-- TOC entry 2143 (class 0 OID 108322)
-- Dependencies: 196
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5672, 9, NULL, 8519, 'sk_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5673, 8, NULL, 8519, 'sn_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5674, 7, NULL, 8519, 'sr_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5675, 7, NULL, 8521, 'sr_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5676, 8, NULL, 8521, 'sn_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5677, 7, NULL, 8521, 'sr_2');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5678, 9, NULL, 8521, 'sk_1');
INSERT INTO service (id_service, id_service_type, id_authority_status, id_authority, service_name) VALUES (5679, 9, NULL, 8521, 'sk_2');


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_id_service_seq', 5679, true);


--
-- TOC entry 2145 (class 0 OID 108330)
-- Dependencies: 198
-- Data for Name: service_property; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53803, 73, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53804, 74, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53805, 174, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53806, 1060, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53807, 1078, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53808, 1080, 5672, 'Краткое наименование услуги', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53810, 73, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53811, 74, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53812, 75, 5673, 'Администрация района', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53813, 174, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53814, 1037, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53815, 1049, 5673, 'НЕТ', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53816, 1078, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53817, 1080, 5673, 'Наименование', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53818, 73, 5674, 'Сфера предоставления', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53819, 74, 5674, 'Сфера предоставления', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53820, 173, 5674, 'Образование и наука

', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53821, 75, 5674, 'Государственное учреждение', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53822, 174, 5674, 'Сфера предоставления', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53823, 176, 5674, 'в традиционном порядке; через МФЦ', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53824, 178, 5674, 'физические лица; юридические лица; индивидуальные предприниматели', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53825, 187, 5674, 'возмездно', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53826, 1076, 5674, 'Индивидуальное жилищное строительство; открытие своего дела', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53827, 1077, 5674, 'услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53828, 1079, 5674, 'Нет', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53829, 1078, 5674, 'Сфера предоставления', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53830, 1080, 5674, 'Сфера предоставления', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53809, 193, 5672, '<a href=''file_storage/property/предложения1.docx''>предложения.docx</a>', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53831, 193, 5674, '<a href=''file_storage/property/Без_имени.png''>Без имени.png</a>', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53836, 174, 5675, 'у1', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53837, 176, 5675, 'в традиционном порядке; в электронном виде', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53858, 174, 5677, 'у2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53838, 178, 5675, 'юридические лица', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53844, 1080, 5675, 'у1', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53845, 193, 5675, NULL, 0);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53846, 73, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53847, 74, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53848, 75, 5676, 'ГУЖА', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53849, 174, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53850, 1037, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53851, 1049, 5676, 'НЕТ', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53859, 176, 5677, 'в традиционном порядке', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53839, 187, 5675, 'не установлено', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53860, 178, 5677, 'индивидуальные предприниматели', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53861, 187, 5677, 'не установлено', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53862, 1076, 5677, 'Смена места жительства', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53863, 1077, 5677, 'услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53864, 1079, 5677, 'Да', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53865, 1078, 5677, 'у2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53866, 1080, 5677, 'у2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53867, 193, 5677, NULL, 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53868, 73, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53869, 74, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53870, 174, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53871, 1060, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53872, 1078, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53873, 1080, 5678, 'фкн1', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53874, 193, 5678, NULL, 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53875, 73, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53876, 74, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53877, 174, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53878, 1060, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53840, 1076, 5675, 'Индивидуальное жилищное строительство', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53841, 1077, 5675, 'услуга, необходимая и обязательная для предоставления государственной (муниципальной) услуги', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53842, 1079, 5675, 'Нет', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53843, 1078, 5675, 'у1', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53879, 1078, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53832, 73, 5675, 'у1', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53833, 74, 5675, 'у1', 1);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53834, 173, 5675, 'Безопасность и охрана правопорядка', 0);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53835, 75, 5675, 'Внебюджетный фонд', 0);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53852, 1078, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53853, 1080, 5676, 'ф2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53854, 73, 5677, 'у2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53855, 74, 5677, 'у2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53856, 173, 5677, 'Безопасность и охрана правопорядка', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53857, 75, 5677, 'Внебюджетный фонд', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53880, 1080, 5679, 'фкн2', 2);
INSERT INTO service_property (id_service_property, id_property, id_service, value, agreed) VALUES (53881, 193, 5679, NULL, 2);


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 199
-- Name: service_property_id_service_property_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('service_property_id_service_property_seq', 53881, true);


--
-- TOC entry 2147 (class 0 OID 108339)
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
-- TOC entry 2149 (class 0 OID 108347)
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
-- TOC entry 2151 (class 0 OID 108355)
-- Dependencies: 204
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users (id_user, id_organization, user_name, password) VALUES (5, 31554, 'Kis_user', NULL);
INSERT INTO users (id_user, id_organization, user_name, password) VALUES (5, 31554, 'Kis_user', NULL);
INSERT INTO users (id_user, id_organization, user_name, password) VALUES (225, 31551, 'iogv123', NULL);


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 205
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_user_seq', 4, true);


--
-- TOC entry 1958 (class 2606 OID 108386)
-- Name: pk_activity_feed; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT pk_activity_feed PRIMARY KEY (id_activity_feed);


--
-- TOC entry 1960 (class 2606 OID 108388)
-- Name: pk_authority; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT pk_authority PRIMARY KEY (id_authority);


--
-- TOC entry 1962 (class 2606 OID 108390)
-- Name: pk_authority_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT pk_authority_property PRIMARY KEY (id_authority_property);


--
-- TOC entry 1964 (class 2606 OID 108392)
-- Name: pk_authority_status; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authority_status
    ADD CONSTRAINT pk_authority_status PRIMARY KEY (id_authority_status);


--
-- TOC entry 1966 (class 2606 OID 108394)
-- Name: pk_comment; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT pk_comment PRIMARY KEY (id_comment);


--
-- TOC entry 1968 (class 2606 OID 108396)
-- Name: pk_event_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event_type
    ADD CONSTRAINT pk_event_type PRIMARY KEY (id_event_type);


--
-- TOC entry 1970 (class 2606 OID 108398)
-- Name: pk_files; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY files
    ADD CONSTRAINT pk_files PRIMARY KEY (id_file);


--
-- TOC entry 1972 (class 2606 OID 108400)
-- Name: pk_history_log; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);


--
-- TOC entry 1974 (class 2606 OID 108402)
-- Name: pk_organization; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT pk_organization PRIMARY KEY (id_organization);


--
-- TOC entry 1976 (class 2606 OID 108404)
-- Name: pk_organization_rank; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY organization_rank
    ADD CONSTRAINT pk_organization_rank PRIMARY KEY (id_organization_rank);


--
-- TOC entry 1978 (class 2606 OID 108406)
-- Name: pk_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT pk_property PRIMARY KEY (id_property);


--
-- TOC entry 1982 (class 2606 OID 108408)
-- Name: pk_property_format; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_format
    ADD CONSTRAINT pk_property_format PRIMARY KEY (id_property_format);


--
-- TOC entry 1984 (class 2606 OID 108410)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service
    ADD CONSTRAINT pk_service PRIMARY KEY (id_service);


--
-- TOC entry 1986 (class 2606 OID 108412)
-- Name: pk_service_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT pk_service_property PRIMARY KEY (id_service_property);


--
-- TOC entry 1988 (class 2606 OID 108414)
-- Name: pk_service_type; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_type
    ADD CONSTRAINT pk_service_type PRIMARY KEY (id_service_type);


--
-- TOC entry 1990 (class 2606 OID 108416)
-- Name: pk_spher; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY spher
    ADD CONSTRAINT pk_spher PRIMARY KEY (id_spher);


--
-- TOC entry 1980 (class 2606 OID 108418)
-- Name: property_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_comments
    ADD CONSTRAINT property_comments_pkey PRIMARY KEY (id_property_commit);


--
-- TOC entry 1991 (class 2606 OID 108419)
-- Name: fk_activity_reference_event_ty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_event_ty FOREIGN KEY (id_event_type) REFERENCES event_type(id_event_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1992 (class 2606 OID 108424)
-- Name: fk_activity_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY activity_feed
    ADD CONSTRAINT fk_activity_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1993 (class 2606 OID 108429)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1995 (class 2606 OID 108434)
-- Name: fk_authorit_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1994 (class 2606 OID 108439)
-- Name: fk_authorit_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority
    ADD CONSTRAINT fk_authorit_reference_organiza FOREIGN KEY (id_organization) REFERENCES organization(id_organization) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1996 (class 2606 OID 108444)
-- Name: fk_authorit_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authority_property
    ADD CONSTRAINT fk_authorit_reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1997 (class 2606 OID 108449)
-- Name: fk_comment_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1998 (class 2606 OID 108454)
-- Name: fk_comment_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_comment_reference_comment FOREIGN KEY (com_id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1999 (class 2606 OID 108459)
-- Name: fk_files_reference_comment; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY files
    ADD CONSTRAINT fk_files_reference_comment FOREIGN KEY (id_comment) REFERENCES comment(id_comment) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2000 (class 2606 OID 108464)
-- Name: fk_organiza_reference_organiza; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY organization
    ADD CONSTRAINT fk_organiza_reference_organiza FOREIGN KEY (id_organization_rank) REFERENCES organization_rank(id_organization_rank) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2001 (class 2606 OID 108469)
-- Name: fk_property_reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_property FOREIGN KEY (id_property_type) REFERENCES property_format(id_property_format) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2002 (class 2606 OID 108474)
-- Name: fk_property_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property
    ADD CONSTRAINT fk_property_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2003 (class 2606 OID 108479)
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2006 (class 2606 OID 108484)
-- Name: fk_service__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2007 (class 2606 OID 108489)
-- Name: fk_service__reference_service; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_property
    ADD CONSTRAINT fk_service__reference_service FOREIGN KEY (id_service) REFERENCES service(id_service) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2004 (class 2606 OID 108494)
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2005 (class 2606 OID 108499)
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service
    ADD CONSTRAINT fk_service_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2008 (class 2606 OID 108504)
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


-- Completed on 2014-11-07 02:52:12

--
-- PostgreSQL database dump complete
--
