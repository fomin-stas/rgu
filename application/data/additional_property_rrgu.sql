CREATE TABLE additional_property (
    id_additional_property integer NOT NULL,
    id_property_format integer,
    additional_property_name character varying(4096)
);


ALTER TABLE public.additional_property OWNER TO rrguru_content;

--
-- TOC entry 197 (class 1259 OID 141096)
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: rrguru_content
--

CREATE SEQUENCE additional_property_id_additional_property_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.additional_property_id_additional_property_seq OWNER TO rrguru_content;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: rrguru_content
--

ALTER SEQUENCE additional_property_id_additional_property_seq OWNED BY additional_property.id_additional_property;


--
-- TOC entry 1917 (class 2604 OID 141146)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: rrguru_content
--

ALTER TABLE ONLY additional_property ALTER COLUMN id_additional_property SET DEFAULT nextval('additional_property_id_additional_property_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 141176)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: rrguru_content; Tablespace: 
--

ALTER TABLE ONLY additional_property
    ADD CONSTRAINT pk_additional_property PRIMARY KEY (id_additional_property);