CREATE TABLE service_arh (
    id_service_arh integer NOT NULL,
    id_service_type integer,
    id_authority_status integer,
    id_authority integer,
    service_name character varying(4096)
);

ALTER TABLE public.service_arh OWNER TO postgres;

CREATE SEQUENCE service_arh_id_service_arh_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.service_arh_id_service_arh_seq OWNER TO postgres;

ALTER SEQUENCE service_arh_id_service_arh_seq OWNED BY service_arh.id_service_arh;

ALTER TABLE ONLY service_arh ALTER COLUMN id_service_arh SET DEFAULT nextval('service_arh_id_service_arh_seq'::regclass);

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT pk_service_arh PRIMARY KEY (id_service_arh);

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE CASCADE ON DELETE CASCADE;