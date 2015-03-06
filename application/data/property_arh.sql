CREATE TABLE service_arh_property (
    id_service_arh_property integer NOT NULL,
    id_property integer,
    id_service_arh integer,
    value text,
    agreed integer DEFAULT 1 NOT NULL
);

ALTER TABLE public.service_arh_property OWNER TO postgres;

CREATE SEQUENCE service_arh_property_id_service_arh_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.service_arh_property_id_service_arh_property_seq OWNER TO postgres;

ALTER SEQUENCE service_arh_property_id_service_arh_property_seq OWNED BY service_arh_property.id_service_arh_property;

ALTER TABLE ONLY service_arh_property ALTER COLUMN id_service_arh_property SET DEFAULT nextval('service_arh_property_id_service_arh_property_seq'::regclass);

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT pk_service_arh_property PRIMARY KEY (id_service_arh_property);

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT fk_service_arh__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT fk_service_arh__reference_service_arh FOREIGN KEY (id_service_arh) REFERENCES service_arh(id_service_arh) ON UPDATE CASCADE ON DELETE CASCADE;

