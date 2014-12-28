

CREATE TABLE service_arh (
    id_service_arh integer NOT NULL,
    id_service_type integer,
    id_authority_status integer,
    id_authority integer,
    service_name character varying(4096)
);


ALTER TABLE public.service_arh OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 141096)
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE service_arh_id_service_arh_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_arh_id_service_arh_seq OWNER TO postgres;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE service_arh_id_service_arh_seq OWNED BY service_arh.id_service_arh;


--
-- TOC entry 1917 (class 2604 OID 141146)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh ALTER COLUMN id_service_arh SET DEFAULT nextval('service_arh_id_service_arh_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 141176)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT pk_service_arh PRIMARY KEY (id_service_arh);


--
-- TOC entry 1920 (class 2606 OID 141245)
-- Name: fk_service_45_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_45_authorit FOREIGN KEY (id_authority_status) REFERENCES authority_status(id_authority_status) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1921 (class 2606 OID 141260)
-- Name: fk_service_reference_authorit; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_reference_authorit FOREIGN KEY (id_authority) REFERENCES authority(id_authority) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 1922 (class 2606 OID 141265)
-- Name: fk_service_reference_service_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY service_arh
    ADD CONSTRAINT fk_service_arh_reference_service_ FOREIGN KEY (id_service_type) REFERENCES service_type(id_service_type) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2014-12-29 00:39:24

--
-- PostgreSQL database dump complete
--

