SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE history_log (
    id_history_log integer NOT NULL,
	id_user integer,
    id_property integer,
    old text,
    new text,
    "time" timestamp without time zone
);

ALTER TABLE public.history_log OWNER TO postgres;

CREATE SEQUENCE history_log_id_history_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.history_log_id_history_log_seq OWNER TO postgres;

ALTER SEQUENCE history_log_id_history_log_seq OWNED BY history_log.id_history_log;

ALTER TABLE ONLY history_log ALTER COLUMN id_history_log SET DEFAULT nextval('history_log_id_history_log_seq'::regclass);

ALTER TABLE ONLY history_log
    ADD CONSTRAINT pk_history_log PRIMARY KEY (id_history_log);
