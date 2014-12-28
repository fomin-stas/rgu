
CREATE TABLE service_arh_property (
    id_service_arh_property integer NOT NULL,
    id_property integer,
    id_service_arh integer,
    value text,
    agreed integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.service_arh_property OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 141106)
-- Name: service_property_id_service_property_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE service_arh_property_id_service_arh_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_arh_property_id_service_arh_property_seq OWNER TO postgres;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 199
-- Name: service_arh_property_id_service_arh_property_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_arh_property_id_service_arh_property_seq OWNED BY service_arh_property.id_service_arh_property;


--
-- TOC entry 1918 (class 2604 OID 141147)
-- Name: id_service_property; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh_property ALTER COLUMN id_service_arh_property SET DEFAULT nextval('service_arh_property_id_service_arh_property_seq'::regclass);


--
-- TOC entry 1920 (class 2606 OID 141178)
-- Name: pk_service_arh_property; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT pk_service_arh_property PRIMARY KEY (id_service_arh_property);


--
-- TOC entry 1921 (class 2606 OID 141250)
-- Name: fk_service_arh__reference_property; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT fk_service_arh__reference_property FOREIGN KEY (id_property) REFERENCES property(id_property) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1922 (class 2606 OID 141255)
-- Name: fk_service_arh__reference_service_arh; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh_property
    ADD CONSTRAINT fk_service_arh__reference_service_arh FOREIGN KEY (id_service_arh) REFERENCES service_arh(id_service_arh) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2014-12-29 00:55:06

--
-- PostgreSQL database dump complete
--

