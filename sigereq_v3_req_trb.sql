--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: req_requerimiento_trabajo_requerido; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_requerimiento_trabajo_requerido (
    id bigint NOT NULL,
    id_requerimiento bigint NOT NULL,
    id_trabajo_requerido smallint NOT NULL,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    fecha_hora_mod timestamp without time zone,
    fecha_inicio timestamp without time zone,
    fecha_fin timestamp without time zone,
    descripcion text,
    solucion text,
    comentarios character varying(255),
    id_soluciona_requerimiento integer NOT NULL,
    id_solucion_requerimiento smallint,
    id_equipo_solicitud bigint,
    id_empleado_registra smallint NOT NULL,
    id_empleado_asignado smallint,
    id_area_trabajo smallint NOT NULL,
    id_estado_requerimiento smallint,
    id_tipo_trabajo smallint,
    id_asigna_requerimiento integer,
    id_user_reg integer NOT NULL,
    id_user_mod integer
);


ALTER TABLE public.req_requerimiento_trabajo_requerido OWNER TO request;

--
-- Name: req_requerimiento_trabajo_requerido_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_requerimiento_trabajo_requerido_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_requerimiento_trabajo_requerido_id_seq OWNER TO request;

--
-- Name: req_requerimiento_trabajo_requerido_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_requerimiento_trabajo_requerido_id_seq OWNED BY req_requerimiento_trabajo_requerido.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido ALTER COLUMN id SET DEFAULT nextval('req_requerimiento_trabajo_requerido_id_seq'::regclass);


--
-- Data for Name: req_requerimiento_trabajo_requerido; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_requerimiento_trabajo_requerido_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_requerimiento_trabajo_requerido_id_seq', 1, false);


--
-- Name: idx_req_requerimiento_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT idx_req_requerimiento_trabajo_requerido UNIQUE (id_requerimiento, id_trabajo_requerido);


--
-- Name: pk_req_requerimiento_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT pk_req_requerimiento_trabajo_requerido PRIMARY KEY (id);


--
-- Name: fk_area_trabajo_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_area_trabajo_requerimiento_trabajo_requerido FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_asigna_requerimiento_trabajo_requerido FOREIGN KEY (id_asigna_requerimiento) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_asignado_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_empleado_asignado_requerimiento_trabajo_requerido FOREIGN KEY (id_empleado_asignado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_registra_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_empleado_registra_requerimiento_trabajo_requerido FOREIGN KEY (id_empleado_registra) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_estado_requerimiento_trabajo_requerido FOREIGN KEY (id_estado_requerimiento) REFERENCES req_ctl_estado_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_requerimiento_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_requerimiento_requerimiento_trabajo_requerido FOREIGN KEY (id_requerimiento) REFERENCES req_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solucion_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_solucion_requerimiento_trabajo_requerido FOREIGN KEY (id_solucion_requerimiento) REFERENCES req_ctl_solucion_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_soluciona_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_soluciona_requerimiento_trabajo_requerido FOREIGN KEY (id_soluciona_requerimiento) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_trabajo_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_tipo_trabajo_requerimiento_trabajo_requerido FOREIGN KEY (id_tipo_trabajo) REFERENCES req_ctl_tipo_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_trabajo_requerido_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_trabajo_requerido_requerimiento_trabajo_requerido FOREIGN KEY (id_trabajo_requerido) REFERENCES req_ctl_trabajo_requerido(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_user_mod_requerimiento_trabajo_requerido FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_user_reg_requerimiento_trabajo_requerido FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

