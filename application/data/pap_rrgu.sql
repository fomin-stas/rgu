CREATE TABLE pap (
    id_pap integer NOT NULL,
    id_additional_property integer,
    id_property integer,
    id_parent_additional_property integer
);


ALTER TABLE public.pap OWNER TO rrguru_content;

--
-- TOC entry 197 (class 1259 OID 141096)
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: rrguru_content
--

CREATE SEQUENCE pap_id_pap_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pap_id_pap_seq OWNER TO rrguru_content;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: rrguru_content
--

ALTER SEQUENCE pap_id_pap_seq OWNED BY pap.id_pap;


--
-- TOC entry 1917 (class 2604 OID 141146)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: rrguru_content
--

ALTER TABLE ONLY pap ALTER COLUMN id_pap SET DEFAULT nextval('pap_id_pap_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 141176)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: rrguru_content; Tablespace: 
--

ALTER TABLE ONLY pap
    ADD CONSTRAINT pk_pap PRIMARY KEY (id_pap);