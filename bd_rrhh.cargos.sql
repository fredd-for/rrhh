--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2014-11-10 00:23:27 BOT

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
-- TOC entry 185 (class 1259 OID 19681)
-- Name: cargos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cargos (
    id integer NOT NULL,
    organigrama_id integer NOT NULL,
    ejecutora_id integer NOT NULL,
    codigo character varying(30),
    cargo character varying(300),
    nivelsalarial_id integer NOT NULL,
    cargo_estado_id integer NOT NULL,
    baja_logica integer NOT NULL,
    user_reg_id integer NOT NULL,
    fecha_reg timestamp without time zone NOT NULL,
    user_mod_id integer,
    fecha_mod timestamp without time zone,
    estado integer,
    fin_partida_id integer,
    depende_id integer
);


ALTER TABLE public.cargos OWNER TO postgres;

--
-- TOC entry 2580 (class 0 OID 0)
-- Dependencies: 185
-- Name: TABLE cargos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE cargos IS 'Tabla para el registro de cargos usados en los contratos.';


--
-- TOC entry 2581 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.id IS 'identificador único del registro de cargo.';


--
-- TOC entry 2582 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.organigrama_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.organigrama_id IS 'identificador único de la unidad administrativa a la cual corresponde la asignación del cargo';


--
-- TOC entry 2583 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.ejecutora_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.ejecutora_id IS 'identificador único de la unidad ejecutora al cual corresponde el cargo.';


--
-- TOC entry 2584 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.codigo IS 'código del cargo que referencia de manera única al cargo por gestión.';


--
-- TOC entry 2585 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.cargo IS 'nombre del cargo que actua de manera identificatoria para la elaboración de los contratos por parte de la dirección jurídica.';


--
-- TOC entry 2586 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.nivelsalarial_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.nivelsalarial_id IS 'identificador del nivel salarial correspondiente al cargo.';


--
-- TOC entry 2587 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.cargo_estado_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.cargo_estado_id IS 'estado del cargo para su uso. ';


--
-- TOC entry 2588 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.baja_logica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.baja_logica IS 'valor indicativo si un registro ha sido eliminado. (1:no ha sido eliminado;0:ha sido eliminado)';


--
-- TOC entry 2589 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.user_reg_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.user_reg_id IS 'identificador del usuario que registró el cargo.';


--
-- TOC entry 2590 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.fecha_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.fecha_reg IS 'fecha y hora de registro del cargo.';


--
-- TOC entry 2591 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.user_mod_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.user_mod_id IS 'identificador del usuario que modificó por última vez el registro del cargo.';


--
-- TOC entry 2592 (class 0 OID 0)
-- Dependencies: 185
-- Name: COLUMN cargos.fecha_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN cargos.fecha_mod IS 'fecha y hora de la última modificación sobre el registro del cargo.';


--
-- TOC entry 188 (class 1259 OID 19690)
-- Name: cargos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cargos_id_seq OWNER TO postgres;

--
-- TOC entry 2593 (class 0 OID 0)
-- Dependencies: 188
-- Name: cargos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cargos_id_seq OWNED BY cargos.id;


--
-- TOC entry 2461 (class 2604 OID 20279)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos ALTER COLUMN id SET DEFAULT nextval('cargos_id_seq'::regclass);


--
-- TOC entry 2574 (class 0 OID 19681)
-- Dependencies: 185
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (2, 1, 1, '1', 'GERENTE EJECUTIVO', 1, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (3, 1, 1, '2', 'SECRETARIA DE GERENCIA', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (4, 1, 1, '3', 'ASISTENTE ADMINISTRATIVO', 13, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (5, 1, 1, '4', 'MENSAJERO', 13, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (6, 1, 1, '5', 'MENSAJERO', 16, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (10, 1, 1, '9', 'RESPONABLE TRANSPARENCIA', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (7, 1, 1, '6', 'COORDINADOR DE GESTIÓN GERENCIAL', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (8, 1, 1, '7', 'RESP. EN FISCALIZACION INTERNA', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (9, 1, 1, '8', 'PROFESIONAL EN FISCALIZACION INTERNA', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 2);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (11, 4, 1, '10', 'GERENTE DE DESARROLLO PROYECTOS', 2, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (12, 4, 1, '11', 'ASISTENTE ADMINISTRATIVO', 13, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 11);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (13, 13, 1, '12', 'JEFE DPTO. DE ESTUDIOS Y DESARROLLO TECNOLOGICO', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, '2014-11-09 00:00:00', 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (53, 23, 1, '46', 'PROFESIONAL EN DESARROLLO DE SISTEMAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 49);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (56, 23, 1, '48', 'TÉCNICO EN SISTEMAS', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 50);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (16, 13, 1, '13', 'PROFESIONAL SISTEMA INTEGRADO DE TRANSPORTE', 6, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 13);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (17, 13, 1, '14', 'PROFESIONAL EN AVALUOS', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 13);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (19, 13, 1, '15', 'PROFESIONAL EN DESARROLLO TECNOLÓGICO', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 13);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (20, 13, 1, '16', 'PROFESIONAL EN ESTUDIOS', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 13);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (23, 14, 1, '18', 'PROFESIONAL ELECTROMECANICO', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (25, 14, 1, '19', 'PROFESIONAL EN ARQUITECTURA', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (21, 14, 1, '17', 'JEFE DPTO. DE PROYECTOS', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (26, 14, 1, '20', 'ENCARGADO FISCAL CIVIL', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (27, 14, 1, '21', 'PROFESIONAL EN MEDIO AMBIENTE, HIGIENE Y SEGURIDAD', 5, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (28, 14, 1, '22', 'PROFESIONAL EN DESARROLLO Y FISCALIACIÓN', 6, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (29, 14, 1, '23', 'ENCARGADO DE MANTENIMIENTO DE EDIFICIOS', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (30, 14, 1, '24', 'PROFESIONAL EN GESTIÓN DE CONFLICTOS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (31, 14, 1, '25', 'PROFESIONAL DE GESTION SOCIAL', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (32, 14, 1, '26', 'TÉCNICO DE MANTENIMIENTO DE EDIFICIOS', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (33, 14, 1, '27', 'AUXILIAR EN ESTUDIOS Y DESARROLLO TECNOLÓGICO', 13, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (34, 14, 1, '28', 'AUXILIAR DE MANTENIMIENTO DE EDIFICIOS', 17, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 21);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (35, 8, 1, '29', 'GERENTE DE GESTION EMPRESARIAL', 2, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (36, 8, 1, '30', 'SECRETARIA', 15, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, NULL);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (37, 24, 1, '31', 'JEFE DPTO. DE COMERCIALIZACION, MARKETING Y VENTAS', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (38, 24, 1, '32', 'PROFESIONAL EN COMERCIALIZACION, MARKETING Y VENTAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 37);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (39, 24, 1, '33', 'TÉCNICO DE APOYO A LA COMERCIALIZACIÓN DE VALORES', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 37);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (40, 24, 1, '34', 'TÉCNICO EN INVESTIGACIÓN DE MERCADO Y VENTAS', 12, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 37);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (41, 22, 1, '35', 'JEFE DPTO. DE PLANIFICACION Y GESTION', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (42, 22, 1, '36', 'RESPONSABLE EN DESARROLLO DE PROCESOS Y CALIDAD', 6, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 41);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (43, 22, 1, '37', 'PROFESIONAL EN PLANIFICACION Y PRESUPUESTO', 6, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 41);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (44, 22, 1, '38', 'PROFESIONAL ANALISIS Y ESTADÍSTICAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 41);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (45, 22, 1, '39', 'PROFESIONAL EN DESARROLLO ORGANIZACIONAL', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 41);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (47, 22, 1, '40', 'PROFESIONAL EN DEFENSA DEL CONSUMIDOR', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 41);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (48, 23, 1, '41', 'JEFE DPTO. DE TECNOLOGIAS DE INFORMACION', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (49, 23, 1, '42', 'RESPONSABLE DE DESARROLLO', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 48);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (50, 23, 1, '43', 'RESPONSABLE DE REDES, COMUNICACIÓN E INFRAESTRUCTURA', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 48);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (51, 23, 1, '44', 'PROFESIONAL EN DESARROLLO DE SISTEMAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 49);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (52, 23, 1, '45', 'PROFESIONAL EN DESARROLLO DE SISTEMAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 49);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (57, 23, 1, '49', 'TÉCNICO SOPORTE', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 50);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (54, 23, 1, '47', 'PROFESIONAL EN DESARROLLO DE SISTEMAS', 8, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 49);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (59, 23, 1, '50', 'TÉCNICO SOPORTE', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 50);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (60, 3, 1, '51', 'GERENTE DE OPERACIÓN Y MANTENIMIENTO', 2, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (64, 11, 1, '54', 'JEFE DE OPERACIÓN DE LINEA', 6, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (66, 11, 1, '55', 'ENCARGADO DE SEGURIDAD', 9, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (62, 3, 1, '52', 'APOYO LOGÍSTICO Y ADMINISTRATIVO', 14, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 60);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (63, 11, 1, '53', 'JEFE DPTO. DE OPERACIONES', 4, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (67, 11, 1, '56', 'ENCARGADO DE LIMPIEZA', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (68, 11, 1, '57', 'OPERADOR DE ESTACION', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (69, 1, 1, '58', 'AUXILIAR OPERADOR DE ESTACION', 11, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (70, 11, 1, '59', 'AGENTE DE ANDEN', 12, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (71, 11, 1, '60', 'AUXILIAR DE ANDEN', 15, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 63);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (73, 12, 1, '62', 'ENCARGADO DE MANTENIMIENTO ELECTRICO', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (74, 12, 1, '63', 'ENCARGADO DE MANTENIMIENTO ELECTRONICO', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (75, 12, 1, '64', 'ENCARGADO DE MANTENIMIENTO ELECTRONICO', 7, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (72, 12, 1, '61', 'JEFE DPTO. DE MANTENIMIENTO', 4, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (76, 12, 1, '65', 'TÉCNICO DE MANTENIMIENTO ELECTRICO SENIOR', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (77, 12, 1, '66', 'TÉCNICO DE MANTENIMIENTO MECANICO SENIOR', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (78, 12, 1, '67', 'TÉCNICO MANTENIMIENTO ELECTRONICO SENIOR', 10, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (79, 12, 1, '68', 'TÉCNICO DE MANTENIMIENTO ELECTRICO JUNIOR', 11, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (80, 12, 1, '69', 'TÉCNICO DE MANTENIMIENTO MECANICO JUNIOR', 11, 1, 1, 1, '2014-11-09 00:00:00', NULL, NULL, 0, 1, 72);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (81, 7, 1, '70', 'GERENTE JURIDICO', 4, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (82, 7, 1, '71', 'SECRETARIA', 15, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 81);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (83, 20, 1, '74', 'JEFE DPTO. DE GESTIÓN JURÍDICA Y REGULACIÓN DERECHO PROPIETARIO', 4, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 0);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (84, 20, 1, '73', 'RESPONSABLE GESTIÓN JURÍDICA', 6, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 83);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (85, 20, 1, '74', 'RESPONSABLE REG. DERECHO PROPIETARIO', 6, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 83);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (87, 20, 1, '76', 'ABOGADO', 8, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 84);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (86, 20, 1, '75', 'ABOGADO GESTOR', 7, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 84);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (88, 20, 1, '77', 'ABOGADO GESTOR', 7, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 85);
INSERT INTO cargos (id, organigrama_id, ejecutora_id, codigo, cargo, nivelsalarial_id, cargo_estado_id, baja_logica, user_reg_id, fecha_reg, user_mod_id, fecha_mod, estado, fin_partida_id, depende_id) VALUES (89, 20, 1, '77', 'ABOGADO GESTOR', 8, 1, 1, 1, '2014-11-10 00:00:00', NULL, NULL, 0, 1, 85);


--
-- TOC entry 2594 (class 0 OID 0)
-- Dependencies: 188
-- Name: cargos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cargos_id_seq', 89, true);


--
-- TOC entry 2463 (class 2606 OID 20310)
-- Name: cargos_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pk PRIMARY KEY (id);


--
-- TOC entry 2464 (class 2606 OID 20455)
-- Name: ejecutoras_cargos_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT ejecutoras_cargos_fk FOREIGN KEY (ejecutora_id) REFERENCES ejecutoras(id);


--
-- TOC entry 2465 (class 2606 OID 20470)
-- Name: nivelessalariales_cargos_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT nivelessalariales_cargos_fk FOREIGN KEY (nivelsalarial_id) REFERENCES nivelsalariales(id);


--
-- TOC entry 2466 (class 2606 OID 20480)
-- Name: organigramas_cargos_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT organigramas_cargos_fk FOREIGN KEY (organigrama_id) REFERENCES organigramas(id);


-- Completed on 2014-11-10 00:23:27 BOT

--
-- PostgreSQL database dump complete
--

