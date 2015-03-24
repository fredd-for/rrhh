--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-02-13 11:23:35 BOT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 292 (class 1259 OID 114311)
-- Name: parametros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parametros (
    id integer DEFAULT nextval('parametros_id_seq'::regclass) NOT NULL,
    parametro character varying(200) NOT NULL,
    nivel character varying(200),
    valor_1 character varying(200),
    valor_2 character varying(200),
    valor_3 character varying(200),
    valor_4 character varying(200),
    valor_5 character varying(200),
    descripcion character varying(200),
    observacion character varying(200),
    estado integer NOT NULL,
    baja_logica integer NOT NULL,
    agrupador integer NOT NULL
);


ALTER TABLE public.parametros OWNER TO postgres;

--
-- TOC entry 2764 (class 0 OID 0)
-- Dependencies: 292
-- Name: TABLE parametros; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE parametros IS 'tabla para el registro de parámetros de control para la aplicación.';


--
-- TOC entry 2765 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.id IS 'identificador único del registro de parámetros.';


--
-- TOC entry 2766 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.parametro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.parametro IS 'denominación del parámetro.';


--
-- TOC entry 2767 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.nivel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.nivel IS 'nivel correspondiente al parámetro.';


--
-- TOC entry 2768 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.valor_1; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.valor_1 IS 'primer valor para control dentro de los parámetros.';


--
-- TOC entry 2769 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.valor_2; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.valor_2 IS 'segundo valor para control dentro de los parámetros.';


--
-- TOC entry 2770 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.valor_3; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.valor_3 IS 'tercero valor para control dentro de los parámetros.';


--
-- TOC entry 2771 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.valor_4; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.valor_4 IS 'tercer valor para control dentro de los parámetros.';


--
-- TOC entry 2772 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.valor_5; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.valor_5 IS 'quinto valor para control dentro de los parámetros.';


--
-- TOC entry 2773 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.descripcion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.descripcion IS 'descripción desplegable sobre el parámetro.';


--
-- TOC entry 2774 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.observacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.observacion IS 'observación sobre el parámetro.';


--
-- TOC entry 2775 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.estado IS 'estado del parámetro. su valor intrisico es 0:inactivo;1:activo.';


--
-- TOC entry 2776 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.baja_logica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.baja_logica IS 'valor indicativo si un registro ha sido eliminado. (1:no ha sido eliminado;0:ha sido eliminado)';


--
-- TOC entry 2777 (class 0 OID 0)
-- Dependencies: 292
-- Name: COLUMN parametros.agrupador; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN parametros.agrupador IS 'valor que agrupa un conjunto registros de acuerdo a un criterio.';


--
-- TOC entry 2759 (class 0 OID 114311)
-- Dependencies: 292
-- Data for Name: parametros; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO parametros VALUES (1, 'tipopresdoc', '1', 'Fotocopia Simple', NULL, NULL, NULL, NULL, 'Si el documento a presentar es fotocopia simple', '', 0, 1, 0);
INSERT INTO parametros VALUES (2, 'tipopresdoc', '2', 'Fotocopia Legalizada', NULL, NULL, NULL, NULL, 'Fotocopia Legaliazada por parte de la entidad emisora', 'no es lo mismo que fotocopia simple', 0, 1, 0);
INSERT INTO parametros VALUES (31, 'grupoarchivos', '5', 'Seguro Social', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (32, 'grupoarchivos', '6', 'Licencias, vacaciones y otros', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (4, 'tipopresdoc', '3', 'Original', '', '', '', '', 'Si el documento a presentar es original', '', 0, 1, 0);
INSERT INTO parametros VALUES (3, 'periodopresdoc', '1', 'Inicio', '', NULL, NULL, NULL, 'Este documento es generado al inicio del contrato.', 'ninguna', 0, 1, 0);
INSERT INTO parametros VALUES (5, 'tipopresdoc', '4', 'Original y Fotocopia', NULL, NULL, NULL, NULL, 'Presentación de ambos documentos', '', 0, 1, 0);
INSERT INTO parametros VALUES (6, 'tipopresdoc', '5', 'Digital', NULL, NULL, NULL, NULL, 'Sólo entrega en formato digital', '', 0, 1, 0);
INSERT INTO parametros VALUES (7, 'tipopresdoc', '6', 'Digital e Impresión', NULL, NULL, NULL, NULL, 'Entrega de el documento digital y su impresión', '', 0, 1, 0);
INSERT INTO parametros VALUES (8, 'periodopresdoc', '2', 'Finalización', NULL, NULL, NULL, NULL, 'Este documento es generado al momento de finalizar el contrato.', '', 0, 1, 0);
INSERT INTO parametros VALUES (11, 'periodopresdoc', '5', 'Trimestral', NULL, NULL, NULL, NULL, 'Este documento es generado una vez por trimestre.', '', 0, 1, 0);
INSERT INTO parametros VALUES (9, 'periodopresdoc', '3', 'Gestión', NULL, NULL, NULL, NULL, 'Este documento es generado una vez por gestión.', '', 0, 1, 0);
INSERT INTO parametros VALUES (10, 'periodopresdoc', '4', 'Mensual', NULL, NULL, NULL, NULL, 'Este documento es generado una vez por mes.', '', 0, 1, 0);
INSERT INTO parametros VALUES (12, 'tipoperssoldoc', '1', 'Una vez por persona', NULL, NULL, NULL, NULL, 'Este tipo de documento permanece de manera recurrente o continúa solicitándose para todos los contratos de una persona.', '', 0, 1, 0);
INSERT INTO parametros VALUES (14, 'tipoperssoldoc', '2', 'Una vez por Gestión', NULL, NULL, NULL, NULL, 'Este tipo de documento permanece recurrente o continúa solicitándose en función a una persona en una determinada gestión.', NULL, 0, 1, 0);
INSERT INTO parametros VALUES (15, 'tipoperssoldoc', '3', 'Sólo primer contrato', NULL, NULL, NULL, NULL, 'Este tipo de documento permanece o se solicita para contratos cuyo proceso refiera a un proceso de Contratación (Hecho que distingue al primer contrato de una secuencia de contratos para una persona).', NULL, 0, 1, 0);
INSERT INTO parametros VALUES (16, 'tipoperssoldoc', '4', 'Hasta recontratación', NULL, NULL, NULL, NULL, 'Este tipo de documento permanece recurrente para personal con contratos relacionados a un proceso de Contratación y a contratos por Recontratación.', '', 0, 1, 0);
INSERT INTO parametros VALUES (17, 'tipoperssoldoc', '5', 'Sólo Recontratación', NULL, NULL, NULL, NULL, 'Este tipo de documento sólo permanece o se solicita para contratos producto de un proceso de Recontratación.', '', 0, 1, 0);
INSERT INTO parametros VALUES (18, 'tipoemisordoc', '1', 'Elaboración Propia', NULL, NULL, NULL, NULL, 'Elaborada por la persona', '', 0, 1, 0);
INSERT INTO parametros VALUES (19, 'tipoemisordoc', '2', 'Mi Teleférico', NULL, NULL, NULL, NULL, 'Elaborado por la EETC-MT', '', 0, 1, 0);
INSERT INTO parametros VALUES (20, 'tipoemisordoc', '3', 'Entidades Estatales', NULL, NULL, NULL, NULL, 'Elaborado por entidades del estado', '', 0, 1, 0);
INSERT INTO parametros VALUES (21, 'tipoemisordoc', '4', 'Entidades Mixtas', NULL, NULL, NULL, NULL, 'Elaborado por entidades mixtas del estado', '', 0, 1, 0);
INSERT INTO parametros VALUES (22, 'tipoemisordoc', '5', 'Cualquier Entidad', NULL, NULL, NULL, NULL, 'Elaborado por cualquier otra entidad', '', 0, 1, 0);
INSERT INTO parametros VALUES (23, 'tipofechaemidoc', '1', 'Particionada', NULL, NULL, NULL, NULL, 'La Fecha de Emisión respecto a la presentación de un documento se separa en dos campos, una para la gestión y otra para el mes.', '', 0, 1, 0);
INSERT INTO parametros VALUES (24, 'tipofechaemidoc', '2', 'Trimestral', NULL, NULL, NULL, NULL, 'La Fecha de Emisión respecto a la presentación de un documento se separa en dos campos, una para la gestión y otra para el trimestre.', '', 0, 1, 0);
INSERT INTO parametros VALUES (25, 'tipofechaemidoc', '3', 'Conjuncionada', NULL, NULL, NULL, NULL, 'La Fecha de Emisión respecto a la presentación de un documento se conjuncionan en sólo campo que almacena el día, mes y año en el formato dd-mm-aaaa.', '', 0, 1, 0);
INSERT INTO parametros VALUES (26, 'tipofechaemidoc', '4', 'Gestión', NULL, NULL, NULL, NULL, 'La Fecha de Emisión respecto a la presentación de un documento sólo refiere a un campo que es la gestión o año.', '', 0, 1, 0);
INSERT INTO parametros VALUES (27, 'grupoarchivos', '1', 'Proceso de Selección y Contratación', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (28, 'grupoarchivos', '2', 'Datos Personales', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (29, 'grupoarchivos', '3', 'Formación Académica y Experiencia Laboral', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (30, 'grupoarchivos', '4', 'Memorandums', NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0);
INSERT INTO parametros VALUES (34, 'TIPOS_HORARIOS', '1', 'DISCONTINUO (LUN A VIE)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (35, 'TIPOS_HORARIOS', '2', 'CONTINUO (LUN A VIE)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (36, 'TIPOS_HORARIOS', '3', 'MULTIPLE (LUN A DOM)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (39, 'TIPO_CONSIDERACION_RETRASO', '0', 'NO SUMAR TOLERANCIA AL RETRASO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (40, 'TIPO_CONSIDERACION_RETRASO', '1', 'SUMAR TOLERANCIA AL RETRASO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (37, 'TIPO_ACUMULACION_TOLERANCIA', '0', 'POR TURNO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (38, 'TIPO_ACUMULACION_TOLERANCIA', '1', 'POR DIA', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (41, 'ESTADO_REGISTRO', '0', 'PASIVO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (43, 'ESTADO_REGISTRO', '1', 'ACTIVO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (44, 'ESTADO_REGISTRO', '2', 'EN PROCESO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (45, 'ESTADO_CALENDARIO', '0', 'PASIVO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (47, 'ESTADO_CALENDARIO', '2', 'ELABORADO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (48, 'ESTADO_CALENDARIO', '3', 'APROBADO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (49, 'ESTADO_CALENDARIO', '4', 'PLANILLADO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (53, 'TIPO_JORNADA_LABORAL', '3', 'SOLO HOMBRES', '48', '8', '7', NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (50, 'TIPO_JORNADA_LABORAL', '1', 'AMBOS SEXOS', '48', '8', '7', NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (46, 'ESTADO_CALENDARIO', '1', 'EN ELABORACION', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (52, 'TIPO_JORNADA_LABORAL', '2', 'MUJERES O MENORES DE 18 AÑOS', '40', '8', '7', NULL, NULL, NULL, 1, 1, 0);
INSERT INTO parametros VALUES (63, 'tipo_documento', '1', 'Titulo en Provisión Nacional', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (54, 'formacion_academica', '4', 'Licenciatura', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (62, 'formacion_academica', '1', 'Doctorado', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1);
INSERT INTO parametros VALUES (61, 'formacion_academica', '2', 'Maestria', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1);
INSERT INTO parametros VALUES (55, 'formacion_academica', '5', 'Egresado', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (56, 'formacion_academica', '6', 'Tecnico Superior', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (57, 'formacion_academica', '7', 'Tecnico Medio', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (58, 'formacion_academica', '8', 'Estudiante Universitario', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (59, 'formacion_academica', '9', 'Bachiller', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0);
INSERT INTO parametros VALUES (60, 'formacion_academica', '3', 'Diplomado', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1);


--
-- TOC entry 2651 (class 2606 OID 114890)
-- Name: parametros_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parametros
    ADD CONSTRAINT parametros_pk PRIMARY KEY (id);


-- Completed on 2015-02-13 11:23:35 BOT

--
-- PostgreSQL database dump complete
--

