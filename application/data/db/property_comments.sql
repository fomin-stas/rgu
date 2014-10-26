--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.8
-- Dumped by pg_dump version 9.2.8
-- Started on 2014-10-27 02:37:31

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 189 (class 1259 OID 107803)
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
-- TOC entry 190 (class 1259 OID 107809)
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
-- TOC entry 2030 (class 0 OID 0)
-- Dependencies: 190
-- Name: property_commits_id_property_commit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE property_commits_id_property_commit_seq OWNED BY property_comments.id_property_commit;


--
-- TOC entry 1917 (class 2604 OID 107878)
-- Name: id_property_commit; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property_comments ALTER COLUMN id_property_commit SET DEFAULT nextval('property_commits_id_property_commit_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 115909)
-- Name: property_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY property_comments
    ADD CONSTRAINT property_comments_pkey PRIMARY KEY (id_property_commit);


-- Completed on 2014-10-27 02:37:32

--
-- PostgreSQL database dump complete
--

