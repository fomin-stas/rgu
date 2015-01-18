CREATE TABLE additional_property_values (
    id_additional_property_values integer NOT NULL,
    id_additional_property integer,
    value text
);


ALTER TABLE public.additional_property_values OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 141096)
-- Name: service_id_service_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE additional_property_values_id_additional_property_values_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.additional_property_values_id_additional_property_values_seq OWNER TO postgres;

--
-- TOC entry 2033 (class 0 OID 0)
-- Dependencies: 197
-- Name: service_id_service_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE additional_property_values_id_additional_property_values_seq OWNED BY additional_property_values.id_additional_property_values;


--
-- TOC entry 1917 (class 2604 OID 141146)
-- Name: id_service; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY additional_property_values ALTER COLUMN id_additional_property_values SET DEFAULT nextval('additional_property_values_id_additional_property_values_seq'::regclass);


--
-- TOC entry 1919 (class 2606 OID 141176)
-- Name: pk_service; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY additional_property_values
    ADD CONSTRAINT pk_additional_property_values PRIMARY KEY (id_additional_property_values);