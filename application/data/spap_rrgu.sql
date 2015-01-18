CREATE TABLE spap (
    id_spap integer NOT NULL,
    id_pap integer,
    id_service_property integer,
    id_parent_spap integer,
    value text
);


ALTER TABLE public.spap OWNER TO rrguru_content;

--
-- TOC entry 197 (class 1259 OID 141096)
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: rrguru_content
--

CREATE SEQUENCE spap_id_spap_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spap_id_spap_seq OWNER TO rrguru_content;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: rrguru_content
--

ALTER SEQUENCE spap_id_spap_seq OWNED BY spap.id_spap;


--
-- TOC entry 1917 (class 2604 OID 141146)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: rrguru_content
--

ALTER TABLE ONLY spap ALTER COLUMN id_spap SET DEFAULT nextval('spap_id_spap_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 141176)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: rrguru_content; Tablespace: 
--

ALTER TABLE ONLY spap
    ADD CONSTRAINT pk_spap PRIMARY KEY (id_spap);