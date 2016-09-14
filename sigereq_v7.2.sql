--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text NOT NULL
);


ALTER TABLE public.fos_user_group OWNER TO request;

--
-- Name: COLUMN fos_user_group.roles; Type: COMMENT; Schema: public; Owner: request
--

COMMENT ON COLUMN fos_user_group.roles IS '(DC2Type:array)';


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE fos_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fos_user_group_id_seq OWNER TO request;

--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE fos_user_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    date_of_birth timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    firstname character varying(64) DEFAULT NULL::character varying,
    lastname character varying(64) DEFAULT NULL::character varying,
    website character varying(64) DEFAULT NULL::character varying,
    biography character varying(1000) DEFAULT NULL::character varying,
    gender character varying(1) DEFAULT NULL::character varying,
    locale character varying(8) DEFAULT NULL::character varying,
    timezone character varying(64) DEFAULT NULL::character varying,
    phone character varying(64) DEFAULT NULL::character varying,
    facebook_uid character varying(255) DEFAULT NULL::character varying,
    facebook_name character varying(255) DEFAULT NULL::character varying,
    facebook_data text,
    twitter_uid character varying(255) DEFAULT NULL::character varying,
    twitter_name character varying(255) DEFAULT NULL::character varying,
    twitter_data text,
    gplus_uid character varying(255) DEFAULT NULL::character varying,
    gplus_name character varying(255) DEFAULT NULL::character varying,
    gplus_data text,
    token character varying(255) DEFAULT NULL::character varying,
    two_step_code character varying(255) DEFAULT NULL::character varying,
    id_empleado integer,
    id_area_servicio_atencion smallint
);


ALTER TABLE public.fos_user_user OWNER TO request;

--
-- Name: COLUMN fos_user_user.roles; Type: COMMENT; Schema: public; Owner: request
--

COMMENT ON COLUMN fos_user_user.roles IS '(DC2Type:array)';


--
-- Name: COLUMN fos_user_user.facebook_data; Type: COMMENT; Schema: public; Owner: request
--

COMMENT ON COLUMN fos_user_user.facebook_data IS '(DC2Type:json)';


--
-- Name: COLUMN fos_user_user.twitter_data; Type: COMMENT; Schema: public; Owner: request
--

COMMENT ON COLUMN fos_user_user.twitter_data IS '(DC2Type:json)';


--
-- Name: COLUMN fos_user_user.gplus_data; Type: COMMENT; Schema: public; Owner: request
--

COMMENT ON COLUMN fos_user_user.gplus_data IS '(DC2Type:json)';


--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE fos_user_user_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.fos_user_user_group OWNER TO request;

--
-- Name: fos_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE fos_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fos_user_user_id_seq OWNER TO request;

--
-- Name: req_area_servicio_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_area_servicio_atencion (
    id smallint NOT NULL,
    id_area_atencion smallint NOT NULL,
    id_servicio_atencion smallint NOT NULL,
    id_servicio_externo smallint NOT NULL,
    id_modalidad_atencion smallint NOT NULL,
    id_jefe_departamento integer
);


ALTER TABLE public.req_area_servicio_atencion OWNER TO request;

--
-- Name: req_area_servicio_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_area_servicio_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_area_servicio_atencion_id_seq OWNER TO request;

--
-- Name: req_area_servicio_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_area_servicio_atencion_id_seq OWNED BY req_area_servicio_atencion.id;


--
-- Name: req_ctl_area_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_area_atencion (
    id smallint NOT NULL,
    nombre character varying(50) DEFAULT 'Área Administrativa'::character varying NOT NULL,
    codigo character(3) DEFAULT 'ADM'::bpchar
);


ALTER TABLE public.req_ctl_area_atencion OWNER TO request;

--
-- Name: req_ctl_area_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_area_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_area_atencion_id_seq OWNER TO request;

--
-- Name: req_ctl_area_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_area_atencion_id_seq OWNED BY req_ctl_area_atencion.id;


--
-- Name: req_ctl_area_trabajo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_area_trabajo (
    id smallint NOT NULL,
    nombre character varying(75) DEFAULT 'Desarrollo de Sistemas Informáticos'::character varying NOT NULL,
    codigo character(3) DEFAULT 'DSI'::bpchar NOT NULL,
    id_area_padre smallint,
    tipo_etiqueta character(15) DEFAULT 'primary-v4'::bpchar
);


ALTER TABLE public.req_ctl_area_trabajo OWNER TO request;

--
-- Name: req_ctl_area_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_area_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_area_trabajo_id_seq OWNER TO request;

--
-- Name: req_ctl_area_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_area_trabajo_id_seq OWNED BY req_ctl_area_trabajo.id;


--
-- Name: req_ctl_cargo_empleado; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_cargo_empleado (
    id smallint NOT NULL,
    nombre character varying(150) DEFAULT 'Director de Hospital'::character varying NOT NULL,
    codigo character(3) DEFAULT 'DHP'::bpchar NOT NULL,
    es_jefatura boolean DEFAULT false
);


ALTER TABLE public.req_ctl_cargo_empleado OWNER TO request;

--
-- Name: req_ctl_cargo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_cargo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_cargo_empleado_id_seq OWNER TO request;

--
-- Name: req_ctl_cargo_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_cargo_empleado_id_seq OWNED BY req_ctl_cargo_empleado.id;


--
-- Name: req_ctl_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_equipo (
    id bigint NOT NULL,
    nombre character varying(255) DEFAULT 'PC Dell Optiplex 9020 de prestaciones medias'::character varying NOT NULL,
    codigo character(10) DEFAULT '000000'::bpchar NOT NULL,
    numero_inventario character(50),
    id_empleado_asignado integer,
    id_tipo_equipo smallint,
    id_modelo_equipo smallint,
    caracteristicas text,
    fecha_adquisicion timestamp without time zone,
    fecha_despacho timestamp without time zone,
    id_user_reg integer NOT NULL,
    id_user_mod integer,
    id_servicio_asignado smallint,
    serie character varying(16),
    id_estado_equipo smallint,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    fecha_hora_mod timestamp without time zone
);


ALTER TABLE public.req_ctl_equipo OWNER TO request;

--
-- Name: req_ctl_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_equipo_id_seq OWNER TO request;

--
-- Name: req_ctl_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_equipo_id_seq OWNED BY req_ctl_equipo.id;


--
-- Name: req_ctl_estado_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_estado_equipo (
    id smallint NOT NULL,
    nombre character varying(75) DEFAULT 'Equipo se encuentra funcionando correctamente'::character varying NOT NULL,
    codigo character(3) DEFAULT 'FNC'::bpchar
);


ALTER TABLE public.req_ctl_estado_equipo OWNER TO request;

--
-- Name: req_ctl_estado_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_estado_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_estado_equipo_id_seq OWNER TO request;

--
-- Name: req_ctl_estado_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_estado_equipo_id_seq OWNED BY req_ctl_estado_equipo.id;


--
-- Name: req_ctl_estado_requerimiento; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_estado_requerimiento (
    id smallint NOT NULL,
    nombre character varying(75) DEFAULT 'Requerimiento recibido'::character varying NOT NULL,
    codigo character(3) DEFAULT 'RRC'::bpchar NOT NULL,
    id_estado_padre smallint
);


ALTER TABLE public.req_ctl_estado_requerimiento OWNER TO request;

--
-- Name: req_ctl_estado_requerimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_estado_requerimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_estado_requerimiento_id_seq OWNER TO request;

--
-- Name: req_ctl_estado_requerimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_estado_requerimiento_id_seq OWNED BY req_ctl_estado_requerimiento.id;


--
-- Name: req_ctl_marca_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_marca_equipo (
    id smallint NOT NULL,
    nombre character varying(50) DEFAULT 'DELL'::character varying NOT NULL,
    codigo character(3) DEFAULT 'DLL'::bpchar NOT NULL,
    id_marca_grupo smallint,
    caracteristicas text
);


ALTER TABLE public.req_ctl_marca_equipo OWNER TO request;

--
-- Name: req_ctl_marca_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_marca_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_marca_equipo_id_seq OWNER TO request;

--
-- Name: req_ctl_marca_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_marca_equipo_id_seq OWNED BY req_ctl_marca_equipo.id;


--
-- Name: req_ctl_modalidad_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_modalidad_atencion (
    id smallint NOT NULL,
    nombre character(25) DEFAULT 'MINSAL'::bpchar NOT NULL,
    codigo character(6) DEFAULT 'MINSAL'::bpchar NOT NULL
);


ALTER TABLE public.req_ctl_modalidad_atencion OWNER TO request;

--
-- Name: req_ctl_modalidad_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_modalidad_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_modalidad_atencion_id_seq OWNER TO request;

--
-- Name: req_ctl_modalidad_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_modalidad_atencion_id_seq OWNED BY req_ctl_modalidad_atencion.id;


--
-- Name: req_ctl_modelo_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_modelo_equipo (
    id smallint NOT NULL,
    nombre character varying(75) DEFAULT 'Dell OptiPlex 9020'::character varying NOT NULL,
    codigo character(15) DEFAULT 'dlloptx9020'::bpchar NOT NULL,
    id_modelo_grupo smallint,
    id_marca_equipo smallint NOT NULL,
    caracteristicas text
);


ALTER TABLE public.req_ctl_modelo_equipo OWNER TO request;

--
-- Name: req_ctl_modelo_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_modelo_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_modelo_equipo_id_seq OWNER TO request;

--
-- Name: req_ctl_modelo_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_modelo_equipo_id_seq OWNED BY req_ctl_modelo_equipo.id;


--
-- Name: req_ctl_servicio_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_servicio_atencion (
    id smallint NOT NULL,
    nombre character varying(100) DEFAULT 'Unidad de Informática'::character varying NOT NULL,
    codigo character(6) DEFAULT 'INF'::bpchar,
    id_atencion_padre integer,
    id_tipo_servicio smallint NOT NULL
);


ALTER TABLE public.req_ctl_servicio_atencion OWNER TO request;

--
-- Name: req_ctl_servicio_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_servicio_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_servicio_atencion_id_seq OWNER TO request;

--
-- Name: req_ctl_servicio_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_servicio_atencion_id_seq OWNED BY req_ctl_servicio_atencion.id;


--
-- Name: req_ctl_servicio_externo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_servicio_externo (
    id smallint NOT NULL,
    nombre character varying(100) DEFAULT 'ISSS'::character varying NOT NULL,
    codigo character(6) DEFAULT 'ISSS'::bpchar
);


ALTER TABLE public.req_ctl_servicio_externo OWNER TO request;

--
-- Name: req_ctl_servicio_externo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_servicio_externo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_servicio_externo_id_seq OWNER TO request;

--
-- Name: req_ctl_servicio_externo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_servicio_externo_id_seq OWNED BY req_ctl_servicio_externo.id;


--
-- Name: req_ctl_sexo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_sexo (
    id smallint NOT NULL,
    sexo character(15) DEFAULT 'Masculino'::bpchar NOT NULL,
    codigo character(1) DEFAULT 'M'::bpchar NOT NULL
);


ALTER TABLE public.req_ctl_sexo OWNER TO request;

--
-- Name: req_ctl_sexo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_sexo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_sexo_id_seq OWNER TO request;

--
-- Name: req_ctl_sexo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_sexo_id_seq OWNED BY req_ctl_sexo.id;


--
-- Name: req_ctl_solucion_requerimiento; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_solucion_requerimiento (
    id smallint NOT NULL,
    nombre character varying(150) DEFAULT 'Instalación de Equipo Informático'::character varying NOT NULL,
    codigo character(3) DEFAULT 'IEI'::bpchar NOT NULL,
    id_solucion_padre smallint,
    id_area_trabajo smallint
);


ALTER TABLE public.req_ctl_solucion_requerimiento OWNER TO request;

--
-- Name: req_ctl_solucion_requerimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_solucion_requerimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_solucion_requerimiento_id_seq OWNER TO request;

--
-- Name: req_ctl_solucion_requerimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_solucion_requerimiento_id_seq OWNED BY req_ctl_solucion_requerimiento.id;


--
-- Name: req_ctl_tipo_empleado; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_tipo_empleado (
    id smallint NOT NULL,
    nombre character varying(100) DEFAULT 'Médico de Consulta General/de Especialidad'::character varying NOT NULL,
    codigo character(3) DEFAULT 'MED'::bpchar NOT NULL
);


ALTER TABLE public.req_ctl_tipo_empleado OWNER TO request;

--
-- Name: req_ctl_tipo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_tipo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_tipo_empleado_id_seq OWNER TO request;

--
-- Name: req_ctl_tipo_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_tipo_empleado_id_seq OWNED BY req_ctl_tipo_empleado.id;


--
-- Name: req_ctl_tipo_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_tipo_equipo (
    id smallint NOT NULL,
    nombre character varying(75) DEFAULT 'Computadora de escritorio'::character varying NOT NULL,
    codigo character(3) DEFAULT 'DKT'::bpchar NOT NULL,
    id_tipo_padre smallint,
    caracteristicas text
);


ALTER TABLE public.req_ctl_tipo_equipo OWNER TO request;

--
-- Name: req_ctl_tipo_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_tipo_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_tipo_equipo_id_seq OWNER TO request;

--
-- Name: req_ctl_tipo_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_tipo_equipo_id_seq OWNED BY req_ctl_tipo_equipo.id;


--
-- Name: req_ctl_tipo_servicio; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_tipo_servicio (
    id smallint NOT NULL,
    nombre character varying(100) DEFAULT 'División Administrativa'::character varying,
    codigo character(3) DEFAULT 'ADM'::bpchar,
    id_tipo_padre smallint
);


ALTER TABLE public.req_ctl_tipo_servicio OWNER TO request;

--
-- Name: req_ctl_tipo_servicio_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_tipo_servicio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_tipo_servicio_id_seq OWNER TO request;

--
-- Name: req_ctl_tipo_servicio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_tipo_servicio_id_seq OWNED BY req_ctl_tipo_servicio.id;


--
-- Name: req_ctl_tipo_trabajo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_tipo_trabajo (
    id smallint NOT NULL,
    nombre character(25) DEFAULT 'Trabajo Correctivo'::bpchar NOT NULL,
    codigo character(1) DEFAULT 'C'::bpchar
);


ALTER TABLE public.req_ctl_tipo_trabajo OWNER TO request;

--
-- Name: req_ctl_tipo_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_tipo_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_tipo_trabajo_id_seq OWNER TO request;

--
-- Name: req_ctl_tipo_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_tipo_trabajo_id_seq OWNED BY req_ctl_tipo_trabajo.id;


--
-- Name: req_ctl_trabajo_requerido; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_trabajo_requerido (
    id smallint NOT NULL,
    requerimiento character varying(255) DEFAULT 'Asignación de equipo de cómputo'::character varying NOT NULL,
    codigo character(6) DEFAULT '000000'::bpchar,
    id_area_trabajo smallint NOT NULL,
    id_trabajo_requerido_padre smallint
);


ALTER TABLE public.req_ctl_trabajo_requerido OWNER TO request;

--
-- Name: req_ctl_trabajo_requerido_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_ctl_trabajo_requerido_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_ctl_trabajo_requerido_id_seq OWNER TO request;

--
-- Name: req_ctl_trabajo_requerido_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_ctl_trabajo_requerido_id_seq OWNED BY req_ctl_trabajo_requerido.id;


--
-- Name: req_empleado; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_empleado (
    id integer NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    id_tipo_empleado smallint NOT NULL,
    id_cargo_empleado smallint NOT NULL,
    habilitado boolean DEFAULT true,
    correo_electronico character varying(100),
    telefono_casa character(10),
    telefono_celular character(10),
    fecha_nacimiento date,
    id_jefe_inmediato integer,
    fecha_hora_reg timestamp without time zone,
    fecha_hora_mod timestamp without time zone,
    hora_nacimiento time without time zone,
    id_user_reg integer NOT NULL,
    id_user_mod integer,
    id_area_servicio_atencion smallint,
    id_sexo smallint NOT NULL,
    correo_institucional character varying(100),
    fecha_contratacion timestamp without time zone,
    fecha_inicia_labores timestamp without time zone,
    fecha_finaliza_labores timestamp without time zone
);


ALTER TABLE public.req_empleado OWNER TO request;

--
-- Name: req_empleado_area_servicio_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_empleado_area_servicio_atencion (
    id integer NOT NULL,
    id_area_servicio_atencion smallint NOT NULL,
    id_empleado integer NOT NULL,
    habilitado boolean DEFAULT true
);


ALTER TABLE public.req_empleado_area_servicio_atencion OWNER TO request;

--
-- Name: req_empleado_area_servicio_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_empleado_area_servicio_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_empleado_area_servicio_atencion_id_seq OWNER TO request;

--
-- Name: req_empleado_area_servicio_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_empleado_area_servicio_atencion_id_seq OWNED BY req_empleado_area_servicio_atencion.id;


--
-- Name: req_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_empleado_id_seq OWNER TO request;

--
-- Name: req_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_empleado_id_seq OWNED BY req_empleado.id;


--
-- Name: req_requerimiento; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_requerimiento (
    id bigint NOT NULL,
    titulo character varying(255) NOT NULL,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    fecha_hora_mod timestamp without time zone,
    fecha_hora_inicio timestamp without time zone,
    fecha_hora_fin timestamp without time zone,
    repetir_por smallint DEFAULT 0,
    dia_completo boolean DEFAULT false,
    color character varying(15) DEFAULT '#2a5469'::character varying,
    id_requerimiento_padre bigint,
    descripcion text,
    id_equipo_solicitud bigint,
    id_empleado_registra smallint NOT NULL,
    id_empleado_asignado smallint,
    id_area_trabajo smallint NOT NULL,
    id_estado_requerimiento smallint,
    id_tipo_trabajo smallint,
    id_solucion_requerimiento smallint,
    id_empleado_solicita smallint,
    id_servicio_solicita smallint,
    id_user_reg integer NOT NULL,
    id_user_mod integer,
    comentarios character varying(255),
    solucion text,
    fecha_asignacion timestamp without time zone,
    id_asigna_requerimiento integer,
    fecha_recibido timestamp without time zone,
    id_trabajo_requerido smallint,
    fecha_digitacion timestamp without time zone
);


ALTER TABLE public.req_requerimiento OWNER TO request;

--
-- Name: req_requerimiento_empleado; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_requerimiento_empleado (
    id bigint NOT NULL,
    id_trabajo_requerido bigint NOT NULL,
    id_empleado_asignado integer NOT NULL,
    fecha_asignacion timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_inicio timestamp without time zone DEFAULT (now())::timestamp(0) without time zone,
    fecha_hora_fin timestamp without time zone,
    id_requerimiento bigint
);


ALTER TABLE public.req_requerimiento_empleado OWNER TO request;

--
-- Name: req_requerimiento_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_requerimiento_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_requerimiento_empleado_id_seq OWNER TO request;

--
-- Name: req_requerimiento_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_requerimiento_empleado_id_seq OWNED BY req_requerimiento_empleado.id;


--
-- Name: req_requerimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: request
--

CREATE SEQUENCE req_requerimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.req_requerimiento_id_seq OWNER TO request;

--
-- Name: req_requerimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: request
--

ALTER SEQUENCE req_requerimiento_id_seq OWNED BY req_requerimiento.id;


--
-- Name: req_requerimiento_trabajo_requerido; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_requerimiento_trabajo_requerido (
    id bigint NOT NULL,
    id_requerimiento bigint NOT NULL,
    id_trabajo_requerido smallint NOT NULL,
    fecha_hora_reg timestamp without time zone DEFAULT (now())::timestamp(0) without time zone NOT NULL,
    fecha_hora_mod timestamp without time zone,
    fecha_hora_inicio timestamp without time zone,
    fecha_hora_fin timestamp without time zone,
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

ALTER TABLE ONLY req_area_servicio_atencion ALTER COLUMN id SET DEFAULT nextval('req_area_servicio_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_area_atencion ALTER COLUMN id SET DEFAULT nextval('req_ctl_area_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_area_trabajo ALTER COLUMN id SET DEFAULT nextval('req_ctl_area_trabajo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_cargo_empleado ALTER COLUMN id SET DEFAULT nextval('req_ctl_cargo_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_estado_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_estado_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_estado_requerimiento ALTER COLUMN id SET DEFAULT nextval('req_ctl_estado_requerimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_marca_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_marca_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_modalidad_atencion ALTER COLUMN id SET DEFAULT nextval('req_ctl_modalidad_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_modelo_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_modelo_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_servicio_atencion ALTER COLUMN id SET DEFAULT nextval('req_ctl_servicio_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_servicio_externo ALTER COLUMN id SET DEFAULT nextval('req_ctl_servicio_externo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_sexo ALTER COLUMN id SET DEFAULT nextval('req_ctl_sexo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_solucion_requerimiento ALTER COLUMN id SET DEFAULT nextval('req_ctl_solucion_requerimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_empleado ALTER COLUMN id SET DEFAULT nextval('req_ctl_tipo_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_tipo_equipo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_servicio ALTER COLUMN id SET DEFAULT nextval('req_ctl_tipo_servicio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_trabajo ALTER COLUMN id SET DEFAULT nextval('req_ctl_tipo_trabajo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_trabajo_requerido ALTER COLUMN id SET DEFAULT nextval('req_ctl_trabajo_requerido_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado ALTER COLUMN id SET DEFAULT nextval('req_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado_area_servicio_atencion ALTER COLUMN id SET DEFAULT nextval('req_empleado_area_servicio_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento ALTER COLUMN id SET DEFAULT nextval('req_requerimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_empleado ALTER COLUMN id SET DEFAULT nextval('req_requerimiento_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido ALTER COLUMN id SET DEFAULT nextval('req_requerimiento_trabajo_requerido_id_seq'::regclass);


--
-- Data for Name: fos_user_group; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO fos_user_group (id, name, roles) VALUES (1, 'yeah baby', 'a:5:{i:0;s:32:"ROLE_SONATA_USER_ADMIN_USER_EDIT";i:1;s:34:"ROLE_SONATA_USER_ADMIN_USER_CREATE";i:2;s:36:"ROLE_SONATA_USER_ADMIN_USER_OPERATOR";i:3;s:33:"ROLE_SONATA_USER_ADMIN_GROUP_EDIT";i:4;s:33:"ROLE_SONATA_USER_ADMIN_GROUP_VIEW";}');
INSERT INTO fos_user_group (id, name, roles) VALUES (2, 'yeah 2 baby', 'a:8:{i:0;s:34:"ROLE_SONATA_USER_ADMIN_USER_MASTER";i:1;s:33:"ROLE_SONATA_USER_ADMIN_GROUP_EDIT";i:2;s:33:"ROLE_SONATA_USER_ADMIN_GROUP_LIST";i:3;s:35:"ROLE_SONATA_USER_ADMIN_GROUP_DELETE";i:4;s:35:"ROLE_SONATA_USER_ADMIN_GROUP_MASTER";i:5;s:9:"ROLE_USER";i:6;s:17:"ROLE_SONATA_ADMIN";i:7;s:32:"ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT";}');
INSERT INTO fos_user_group (id, name, roles) VALUES (3, 'field_dialog_form_list_handle_action_s57c9e0ffd9030_groups', 'a:0:{}');
INSERT INTO fos_user_group (id, name, roles) VALUES (4, 'field_dialog_form_list_handle_action_s57c9e0ffd9030_groupsfield_dialog_form_list_handle_action_s57c9e0ffd9030_groups', 'a:13:{i:0;s:62:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_AREA_TRABAJO_EDIT";i:1;s:62:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_AREA_TRABAJO_VIEW";i:2;s:64:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_AREA_TRABAJO_MASTER";i:3;s:58:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_EQUIPO_CREATE";i:4;s:58:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_EQUIPO_DELETE";i:5;s:69:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TRABAJO_REQUERIDO_MASTER";i:6;s:79:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_EMPLEADO_AREA_SERVICIO_ATENCION_EXPORT";i:7;s:61:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_EQUIPO_VIEW";i:8;s:63:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_EQUIPO_DELETE";i:9;s:63:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_EQUIPO_EXPORT";i:10;s:65:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_EQUIPO_OPERATOR";i:11;s:9:"ROLE_USER";i:12;s:17:"ROLE_SONATA_ADMIN";}');
INSERT INTO fos_user_group (id, name, roles) VALUES (7, 'TOS_ADMIN_REQ_CTL_AREA_TRABAJO_EDIT', 'a:5:{i:0;s:64:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_AREA_TRABAJO_EXPORT";i:1;s:65:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_SERVICIO_CREATE";i:2;s:65:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_SERVICIO_DELETE";i:3;s:67:"ROLE_SAN_RAFAEL_REQUERIMIENTOS_ADMIN_REQ_CTL_TIPO_SERVICIO_OPERATOR";i:4;s:16:"ROLE_SUPER_ADMIN";}');


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('fos_user_group_id_seq', 7, true);


--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, id_empleado, id_area_servicio_atencion) VALUES (1, 'admin', 'admin', 'farid.hdz.64@gmail.com', 'farid.hdz.64@gmail.com', false, 'qe8kcle04sgw0oo48w8ssko80cgcccc', 'G5pGA/C+RRlnARla0DX3jmEL+KsEv+8vscuTFXyeyk9Zn7qNKi8U4FGZh+KSFuIYTImRllOYrcVKcdH7IFeceA==', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', false, NULL, '2016-08-10 13:59:30', '2016-08-26 11:58:31', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, NULL);
INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, id_empleado, id_area_servicio_atencion) VALUES (4, 'adminrequest', 'adminrequest', 'admin.request@gmail.com', 'admin.request@gmail.com', true, '3vl8bdxfucqog88gwsoswg4cg048ckg', 'pn5P8d7TkK9/TOb4Sn85Bdr6pRw+3fwPIM3lFbnm9lbNpMp1ykFMiVb0XMwMX6jCE/up5b3Yj+Q/SLSfK1++tQ==', '2016-09-14 00:11:53', false, false, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', false, NULL, '2016-08-24 01:03:31', '2016-09-14 00:11:53', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL, NULL);


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('fos_user_user_id_seq', 4, true);


--
-- Data for Name: req_area_servicio_atencion; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_area_servicio_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_area_servicio_atencion_id_seq', 1, false);


--
-- Data for Name: req_ctl_area_atencion; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (1, 'Área Administrativa', 'ADM');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (2, 'Consulta Externa', 'CXT');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (3, 'Emergencia', 'EMG');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (4, 'Hospitalización', 'HPT');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (5, 'Consulta de Especialidades', 'ESP');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (6, 'Servicios de Diagnóstico', 'SDG');
INSERT INTO req_ctl_area_atencion (id, nombre, codigo) VALUES (7, 'Servicios de Apoyo', 'SPY');


--
-- Name: req_ctl_area_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_area_atencion_id_seq', 7, true);


--
-- Data for Name: req_ctl_area_trabajo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (7, 'Comunicaciones de Datos', 'RCD', 2, 'primary-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (8, 'Redes de Datos', 'RDT', 2, 'primary-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (2, 'Redes y Comunicaciones de Datos', 'RDD', NULL, 'primary-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (10, 'Mantenimiento de Equipos Informáticos', 'MNT', NULL, 'primary-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (3, 'Soporte Técnico', 'SPT', NULL, 'primary-v3     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (4, 'Soporte Técnico en Equipos Informáticos', 'SPQ', 3, 'primary-v3     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (5, 'Soporte Técnico en Sistemas Informáticos', 'SPS', 3, 'primary-v3     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (12, 'Administrativo', 'ADM', NULL, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (1, 'Sistemas Informáticos', 'SIT', NULL, 'success-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (14, 'Desarrollo de Sistemas Informáticos', 'DSI', 1, 'success-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (15, 'Actualización de Sistemas Informáticos', 'ASI', 1, 'success-v4     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (9, 'Seguridad Informática', 'SGI', NULL, 'success-v3     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (11, 'Virus Informáticos', 'SVR', 9, 'success-v3     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (6, 'Ofimática', 'OFM', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (16, 'Capacitaciones', 'CPT', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (17, 'Capacitaciones de Ofimática', 'CPF', 16, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (18, 'Capacitaciones de Software Libre', 'CSL', 16, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (19, 'Capacitaciones de Manejo de Computadora', 'CMC', 16, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (20, 'Capacitaciones de uso de Correo Institucional', 'CCI', 16, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (21, 'Elaboración de Informes', 'EIN', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (22, 'Elaboración de Memorandum', 'EMM', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (23, 'Reunión de Personal del Departamento / Unidad', 'RPD', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (24, 'Elaboración de Notas', 'ENT', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (25, 'Reunión programada', 'RPG', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (26, 'Reunión fuera del Establecimiento', 'RFR', 12, 'element-v2     ');
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre, tipo_etiqueta) VALUES (27, 'Creación de Términos de Referencia', 'TDR', 12, 'element-v2     ');


--
-- Name: req_ctl_area_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_area_trabajo_id_seq', 27, true);


--
-- Data for Name: req_ctl_cargo_empleado; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (1, 'Director de Hospital', 'DHP', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (2, 'Jefe de Departamento de Informática', 'JNF', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (3, 'Coordinador de Área de Informática', 'CNF', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (4, 'Jefe de Departamento de Radiología e Imágenes Médicas', 'JRX', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (5, 'Jefe Administrativo de Radiología e Imágenes Médicas', 'ARX', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (6, 'Jefe de Laboratorio Clínico', 'JLB', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (7, 'Jefe de Departamento de Anatomía Patológica', 'JPT', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (8, 'Jefe de UACI', 'JAC', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (9, 'Jefe de Departamento de Recursos Humanos', 'JRH', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (10, 'Jefe de Departamento de Estadístico y Documentos Médicos', 'JST', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (11, 'Jefe de Lavandería', 'JLV', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (12, 'Jefe de Transporte', 'JTR', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (13, 'Jefe de Servicios Generales', 'JSG', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (14, 'Jefe de Almacén de Insumos Médicos', 'JLM', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (16, 'Jefe de Farmacia', 'JFR', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (15, 'Jefe de División Administrativa', 'JDA', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (17, 'Jefe de División Médica', 'JDM', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (18, 'Subdirector de Hospital', 'SHP', true);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (19, 'Analista Programador', 'ANP', false);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (20, 'Administrador de Redes y Seguridad', 'ARD', false);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (21, 'Operador de Sistemas I', 'OPS', false);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (22, 'Encargado de Soporte Técnico', 'EST', false);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (23, 'Secretari@ de Informática', 'SNF', false);
INSERT INTO req_ctl_cargo_empleado (id, nombre, codigo, es_jefatura) VALUES (24, 'Jefe de Departamento de Comunicaciones', 'JCM', true);


--
-- Name: req_ctl_cargo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_cargo_empleado_id_seq', 24, true);


--
-- Data for Name: req_ctl_equipo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_equipo (id, nombre, codigo, numero_inventario, id_empleado_asignado, id_tipo_equipo, id_modelo_equipo, caracteristicas, fecha_adquisicion, fecha_despacho, id_user_reg, id_user_mod, id_servicio_asignado, serie, id_estado_equipo, fecha_hora_reg, fecha_hora_mod) VALUES (4, 'PC Dell Optiplex 9020 de prestaciones altas', '000000    ', NULL, NULL, 1, 2, NULL, '2016-08-28 20:38:00', '2016-08-28 20:38:00', 4, 4, NULL, NULL, 1, '2016-08-28 20:41:12', '2016-08-28 20:42:07');
INSERT INTO req_ctl_equipo (id, nombre, codigo, numero_inventario, id_empleado_asignado, id_tipo_equipo, id_modelo_equipo, caracteristicas, fecha_adquisicion, fecha_despacho, id_user_reg, id_user_mod, id_servicio_asignado, serie, id_estado_equipo, fecha_hora_reg, fecha_hora_mod) VALUES (3, 'PC Dell Optiplex 9020 de prestaciones medias', '0000001   ', NULL, NULL, 1, 2, NULL, '2016-08-28 19:00:00', '2016-08-28 19:00:00', 4, 4, NULL, '09GH89983333309I', 1, '2016-08-28 19:02:26', '2016-08-28 21:28:50');
INSERT INTO req_ctl_equipo (id, nombre, codigo, numero_inventario, id_empleado_asignado, id_tipo_equipo, id_modelo_equipo, caracteristicas, fecha_adquisicion, fecha_despacho, id_user_reg, id_user_mod, id_servicio_asignado, serie, id_estado_equipo, fecha_hora_reg, fecha_hora_mod) VALUES (6, 'ups', '0000025   ', NULL, NULL, 1, 2, NULL, '2016-08-29 10:50:00', '2016-08-29 10:50:00', 4, NULL, NULL, NULL, 1, '2016-08-29 10:51:57', NULL);
INSERT INTO req_ctl_equipo (id, nombre, codigo, numero_inventario, id_empleado_asignado, id_tipo_equipo, id_modelo_equipo, caracteristicas, fecha_adquisicion, fecha_despacho, id_user_reg, id_user_mod, id_servicio_asignado, serie, id_estado_equipo, fecha_hora_reg, fecha_hora_mod) VALUES (7, 'PC Dell Optiplex 9020 de prestaciones medias', '000300    ', NULL, 1, 1, 2, NULL, '2016-09-14 00:11:00', '2016-09-14 00:11:00', 4, NULL, NULL, NULL, 1, '2016-09-14 00:18:35', NULL);


--
-- Name: req_ctl_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_equipo_id_seq', 7, true);


--
-- Data for Name: req_ctl_estado_equipo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (1, 'Equipo se encuentra funcionando correctamente', 'FNC');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (2, 'Equipo se encuentra en reparación', 'RPR');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (3, 'Equipo ha sido dado de baja', 'QBJ');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (4, 'Equipo ha sido desechado', 'DSH');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (5, 'Equipo almacenado en bodega', 'BDG');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (6, 'Equipo presenta fallas de hardware', 'FHW');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (7, 'Equipo presenta fallas de Sistema Operativo', 'FSO');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (8, 'Equipo faltante de repuestos', 'QRP');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (9, 'Equipo con problemas de Virus', 'QVR');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (10, 'Equipo infectado de Virus', 'QNV');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (11, 'Teclado faltante de Teclas', 'TFT');
INSERT INTO req_ctl_estado_equipo (id, nombre, codigo) VALUES (12, 'Equipo impresor sin Toner', 'ITN');


--
-- Name: req_ctl_estado_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_estado_equipo_id_seq', 12, true);


--
-- Data for Name: req_ctl_estado_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (1, 'Requerimiento recibido', 'RRC', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (2, 'Requerimiento en proceso', 'RPR', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (3, 'Requerimiento solucionado', 'RSL', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (4, 'Requerimiento rechazado', 'RCZ', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (5, 'Requerimiento descartado', 'RDS', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (6, 'Requerimiento asignado a Técnico', 'RAT', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (7, 'Requerimiento descartado por falta de detalle', 'RFD', 5);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (9, 'Requerimiento descartado por indisponibilidad de Técnicos', 'RIT', 5);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (8, 'Requerimiento descartado por indisponibilidad de equipos en inventario', 'RDQ', 5);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (10, 'Requerimiento en espera', 'RSP', NULL);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (15, 'Requerimiento en espera por asueto', 'RSS', 10);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (11, 'Requerimiento en espera de insumos para completarse', 'RIC', 10);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (12, 'Requerimiento en espera de equipos para completarse', 'RQC', 10);
INSERT INTO req_ctl_estado_requerimiento (id, nombre, codigo, id_estado_padre) VALUES (14, 'Requerimiento en espera por ausencia de Técnicos', 'RST', 10);


--
-- Name: req_ctl_estado_requerimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_estado_requerimiento_id_seq', 15, true);


--
-- Data for Name: req_ctl_marca_equipo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_marca_equipo (id, nombre, codigo, id_marca_grupo, caracteristicas) VALUES (1, 'DELL', 'DLL', NULL, NULL);


--
-- Name: req_ctl_marca_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_marca_equipo_id_seq', 1, true);


--
-- Data for Name: req_ctl_modalidad_atencion; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_modalidad_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_modalidad_atencion_id_seq', 1, false);


--
-- Data for Name: req_ctl_modelo_equipo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_modelo_equipo (id, nombre, codigo, id_modelo_grupo, id_marca_equipo, caracteristicas) VALUES (2, 'Dell OptiPlex 9020', 'dlloptx9020    ', NULL, 1, NULL);


--
-- Name: req_ctl_modelo_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_modelo_equipo_id_seq', 2, true);


--
-- Data for Name: req_ctl_servicio_atencion; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (2, 'Dirección del Hospital', 'DHP   ', NULL, 2);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (1, 'Unidad de Informática', 'INF   ', NULL, 1);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (3, 'Departamento de Servicios de Diagnóstico y Apoyo', 'DGY   ', NULL, 4);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (4, 'Departamento de Radiología e Imágenes Médicas', 'DRX   ', 3, 4);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (5, 'Departamento de Laboratorio Clínico', 'DLB   ', 3, 4);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (6, 'Departamento de Anatomía Patológica', 'DPT   ', 3, 4);
INSERT INTO req_ctl_servicio_atencion (id, nombre, codigo, id_atencion_padre, id_tipo_servicio) VALUES (7, 'División Administrativa', 'ADM   ', 2, 1);


--
-- Name: req_ctl_servicio_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_servicio_atencion_id_seq', 7, true);


--
-- Data for Name: req_ctl_servicio_externo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_servicio_externo (id, nombre, codigo) VALUES (1, 'ISSS', 'ISSS  ');
INSERT INTO req_ctl_servicio_externo (id, nombre, codigo) VALUES (2, 'Bienestar Magisterial', 'BM    ');


--
-- Name: req_ctl_servicio_externo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_servicio_externo_id_seq', 2, true);


--
-- Data for Name: req_ctl_sexo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_sexo (id, sexo, codigo) VALUES (1, 'Masculino      ', 'M');
INSERT INTO req_ctl_sexo (id, sexo, codigo) VALUES (2, 'Femenino       ', 'F');
INSERT INTO req_ctl_sexo (id, sexo, codigo) VALUES (3, 'Otros          ', 'O');


--
-- Name: req_ctl_sexo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_sexo_id_seq', 3, true);


--
-- Data for Name: req_ctl_solucion_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_solucion_requerimiento (id, nombre, codigo, id_solucion_padre, id_area_trabajo) VALUES (4, 'Cambio de Dirección IPV4', 'DIP', NULL, NULL);
INSERT INTO req_ctl_solucion_requerimiento (id, nombre, codigo, id_solucion_padre, id_area_trabajo) VALUES (2, 'Actualización de Versión de Antivirus', 'VAV', NULL, NULL);
INSERT INTO req_ctl_solucion_requerimiento (id, nombre, codigo, id_solucion_padre, id_area_trabajo) VALUES (3, 'Actualización de Versión de Sistema Informático', 'VSI', NULL, NULL);
INSERT INTO req_ctl_solucion_requerimiento (id, nombre, codigo, id_solucion_padre, id_area_trabajo) VALUES (1, 'Actualización de Sistema Operativo', 'ASO', NULL, NULL);
INSERT INTO req_ctl_solucion_requerimiento (id, nombre, codigo, id_solucion_padre, id_area_trabajo) VALUES (5, 'Instalación de Equipo Informático', 'IEI', NULL, NULL);


--
-- Name: req_ctl_solucion_requerimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_solucion_requerimiento_id_seq', 5, true);


--
-- Data for Name: req_ctl_tipo_empleado; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_tipo_empleado (id, nombre, codigo) VALUES (1, 'Médico de Consulta General/de Especialidad', 'MED');
INSERT INTO req_ctl_tipo_empleado (id, nombre, codigo) VALUES (2, 'Empleado Administrativo', 'ADM');


--
-- Name: req_ctl_tipo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_empleado_id_seq', 2, true);


--
-- Data for Name: req_ctl_tipo_equipo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_tipo_equipo (id, nombre, codigo, id_tipo_padre, caracteristicas) VALUES (1, 'Computadora de escritorio', 'DKT', NULL, NULL);


--
-- Name: req_ctl_tipo_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_equipo_id_seq', 1, true);


--
-- Data for Name: req_ctl_tipo_servicio; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_tipo_servicio (id, nombre, codigo, id_tipo_padre) VALUES (1, 'División Administrativa', 'ADM', NULL);
INSERT INTO req_ctl_tipo_servicio (id, nombre, codigo, id_tipo_padre) VALUES (2, 'Dirección General', 'DRG', NULL);
INSERT INTO req_ctl_tipo_servicio (id, nombre, codigo, id_tipo_padre) VALUES (3, 'División Médica', 'DMD', NULL);
INSERT INTO req_ctl_tipo_servicio (id, nombre, codigo, id_tipo_padre) VALUES (4, 'División de Diagnóstico y Apoyo', 'DGY', NULL);


--
-- Name: req_ctl_tipo_servicio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_servicio_id_seq', 4, true);


--
-- Data for Name: req_ctl_tipo_trabajo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_tipo_trabajo (id, nombre, codigo) VALUES (1, 'Trabajo Correctivo       ', 'C');
INSERT INTO req_ctl_tipo_trabajo (id, nombre, codigo) VALUES (2, 'Trabajo Preventivo       ', 'P');
INSERT INTO req_ctl_tipo_trabajo (id, nombre, codigo) VALUES (3, 'Otros                    ', 'O');


--
-- Name: req_ctl_tipo_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_trabajo_id_seq', 3, true);


--
-- Data for Name: req_ctl_trabajo_requerido; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_trabajo_requerido (id, requerimiento, codigo, id_area_trabajo, id_trabajo_requerido_padre) VALUES (1, 'Asignación de equipo de cómputo', '000000', 3, NULL);


--
-- Name: req_ctl_trabajo_requerido_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_trabajo_requerido_id_seq', 1, true);


--
-- Data for Name: req_empleado; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_empleado (id, nombre, apellido, id_tipo_empleado, id_cargo_empleado, habilitado, correo_electronico, telefono_casa, telefono_celular, fecha_nacimiento, id_jefe_inmediato, fecha_hora_reg, fecha_hora_mod, hora_nacimiento, id_user_reg, id_user_mod, id_area_servicio_atencion, id_sexo, correo_institucional, fecha_contratacion, fecha_inicia_labores, fecha_finaliza_labores) VALUES (1, 'Daniel Farid', 'Hernández Cortez', 2, 19, true, 'farid.hdz.64@gmail.com', '2-272-4516', '7-710-2360', '1990-01-04', NULL, '2016-09-02 16:39:15', '2016-09-02 16:39:34', '01:30:00', 4, 4, NULL, 1, 'farid.hdz.64@gmail.com', '2015-05-04 00:00:00', '2016-09-02 00:00:00', NULL);


--
-- Data for Name: req_empleado_area_servicio_atencion; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_empleado_area_servicio_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_empleado_area_servicio_atencion_id_seq', 1, false);


--
-- Name: req_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_empleado_id_seq', 1, true);


--
-- Data for Name: req_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Data for Name: req_requerimiento_empleado; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_requerimiento_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_requerimiento_empleado_id_seq', 1, false);


--
-- Name: req_requerimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_requerimiento_id_seq', 1, false);


--
-- Data for Name: req_requerimiento_trabajo_requerido; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_requerimiento_trabajo_requerido_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_requerimiento_trabajo_requerido_id_seq', 3, true);


--
-- Name: fos_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY fos_user_group
    ADD CONSTRAINT fos_user_group_pkey PRIMARY KEY (id);


--
-- Name: fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- Name: fos_user_user_pkey; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fos_user_user_pkey PRIMARY KEY (id);


--
-- Name: idx_req_area_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_area_atencion
    ADD CONSTRAINT idx_req_area_atencion UNIQUE (codigo);


--
-- Name: idx_req_codigo_area_trabajo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_area_trabajo
    ADD CONSTRAINT idx_req_codigo_area_trabajo UNIQUE (codigo);


--
-- Name: idx_req_codigo_cargo_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_cargo_empleado
    ADD CONSTRAINT idx_req_codigo_cargo_empleado UNIQUE (codigo);


--
-- Name: idx_req_codigo_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT idx_req_codigo_equipo UNIQUE (codigo);


--
-- Name: idx_req_codigo_estado_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_estado_equipo
    ADD CONSTRAINT idx_req_codigo_estado_equipo UNIQUE (codigo);


--
-- Name: idx_req_codigo_estado_requerimiento; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_estado_requerimiento
    ADD CONSTRAINT idx_req_codigo_estado_requerimiento UNIQUE (codigo);


--
-- Name: idx_req_codigo_marca_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_marca_equipo
    ADD CONSTRAINT idx_req_codigo_marca_equipo UNIQUE (codigo);


--
-- Name: idx_req_codigo_modalidad_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_modalidad_atencion
    ADD CONSTRAINT idx_req_codigo_modalidad_atencion UNIQUE (codigo);


--
-- Name: idx_req_codigo_modelo_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_modelo_equipo
    ADD CONSTRAINT idx_req_codigo_modelo_equipo UNIQUE (codigo);


--
-- Name: idx_req_codigo_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_servicio_atencion
    ADD CONSTRAINT idx_req_codigo_servicio_atencion UNIQUE (codigo);


--
-- Name: idx_req_codigo_servicio_externo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_servicio_externo
    ADD CONSTRAINT idx_req_codigo_servicio_externo UNIQUE (codigo);


--
-- Name: idx_req_codigo_sexo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_sexo
    ADD CONSTRAINT idx_req_codigo_sexo UNIQUE (codigo);


--
-- Name: idx_req_codigo_solucion_requerimiento; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_solucion_requerimiento
    ADD CONSTRAINT idx_req_codigo_solucion_requerimiento UNIQUE (codigo);


--
-- Name: idx_req_codigo_tipo_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_empleado
    ADD CONSTRAINT idx_req_codigo_tipo_empleado UNIQUE (codigo);


--
-- Name: idx_req_codigo_tipo_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_equipo
    ADD CONSTRAINT idx_req_codigo_tipo_equipo UNIQUE (codigo);


--
-- Name: idx_req_codigo_tipo_servicio; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_servicio
    ADD CONSTRAINT idx_req_codigo_tipo_servicio UNIQUE (codigo);


--
-- Name: idx_req_codigo_tipo_trabajo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_trabajo
    ADD CONSTRAINT idx_req_codigo_tipo_trabajo UNIQUE (codigo);


--
-- Name: idx_req_codigo_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_trabajo_requerido
    ADD CONSTRAINT idx_req_codigo_trabajo_requerido UNIQUE (codigo);


--
-- Name: idx_req_empleado_area_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_empleado_area_servicio_atencion
    ADD CONSTRAINT idx_req_empleado_area_servicio_atencion UNIQUE (id_area_servicio_atencion, id_empleado);


--
-- Name: idx_req_empleado_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_empleado
    ADD CONSTRAINT idx_req_empleado_trabajo_requerido UNIQUE (id_trabajo_requerido, id_empleado_asignado);


--
-- Name: idx_req_modalidad_area_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT idx_req_modalidad_area_servicio_atencion UNIQUE (id_area_atencion, id_servicio_atencion, id_servicio_externo, id_modalidad_atencion);


--
-- Name: idx_req_requerimiento_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT idx_req_requerimiento_trabajo_requerido UNIQUE (id_requerimiento, id_trabajo_requerido);


--
-- Name: pk_req_area_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT pk_req_area_servicio_atencion PRIMARY KEY (id);


--
-- Name: pk_req_ctl_area_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_area_atencion
    ADD CONSTRAINT pk_req_ctl_area_atencion PRIMARY KEY (id);


--
-- Name: pk_req_ctl_area_trabajo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_area_trabajo
    ADD CONSTRAINT pk_req_ctl_area_trabajo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_cargo_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_cargo_empleado
    ADD CONSTRAINT pk_req_ctl_cargo_empleado PRIMARY KEY (id);


--
-- Name: pk_req_ctl_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT pk_req_ctl_equipo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_estado_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_estado_equipo
    ADD CONSTRAINT pk_req_ctl_estado_equipo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_estado_requerimiento; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_estado_requerimiento
    ADD CONSTRAINT pk_req_ctl_estado_requerimiento PRIMARY KEY (id);


--
-- Name: pk_req_ctl_marca_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_marca_equipo
    ADD CONSTRAINT pk_req_ctl_marca_equipo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_modalidad_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_modalidad_atencion
    ADD CONSTRAINT pk_req_ctl_modalidad_atencion PRIMARY KEY (id);


--
-- Name: pk_req_ctl_modelo_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_modelo_equipo
    ADD CONSTRAINT pk_req_ctl_modelo_equipo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_servicio_atencion
    ADD CONSTRAINT pk_req_ctl_servicio_atencion PRIMARY KEY (id);


--
-- Name: pk_req_ctl_servicio_externo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_servicio_externo
    ADD CONSTRAINT pk_req_ctl_servicio_externo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_sexo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_sexo
    ADD CONSTRAINT pk_req_ctl_sexo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_solucion_requerimiento; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_solucion_requerimiento
    ADD CONSTRAINT pk_req_ctl_solucion_requerimiento PRIMARY KEY (id);


--
-- Name: pk_req_ctl_tipo_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_empleado
    ADD CONSTRAINT pk_req_ctl_tipo_empleado PRIMARY KEY (id);


--
-- Name: pk_req_ctl_tipo_equipo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_equipo
    ADD CONSTRAINT pk_req_ctl_tipo_equipo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_tipo_servicio; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_servicio
    ADD CONSTRAINT pk_req_ctl_tipo_servicio PRIMARY KEY (id);


--
-- Name: pk_req_ctl_tipo_trabajo; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_tipo_trabajo
    ADD CONSTRAINT pk_req_ctl_tipo_trabajo PRIMARY KEY (id);


--
-- Name: pk_req_ctl_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_ctl_trabajo_requerido
    ADD CONSTRAINT pk_req_ctl_trabajo_requerido PRIMARY KEY (id);


--
-- Name: pk_req_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT pk_req_empleado PRIMARY KEY (id);


--
-- Name: pk_req_empleado_area_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_empleado_area_servicio_atencion
    ADD CONSTRAINT pk_req_empleado_area_servicio_atencion PRIMARY KEY (id);


--
-- Name: pk_req_requerimiento; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT pk_req_requerimiento PRIMARY KEY (id);


--
-- Name: pk_req_requerimiento_empleado; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_empleado
    ADD CONSTRAINT pk_req_requerimiento_empleado PRIMARY KEY (id);


--
-- Name: pk_req_requerimiento_trabajo_requerido; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT pk_req_requerimiento_trabajo_requerido PRIMARY KEY (id);


--
-- Name: idx_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: request; Tablespace: 
--

CREATE INDEX idx_b3c77447a76ed395 ON fos_user_user_group USING btree (user_id);


--
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: request; Tablespace: 
--

CREATE INDEX idx_b3c77447fe54d947 ON fos_user_user_group USING btree (group_id);


--
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: request; Tablespace: 
--

CREATE UNIQUE INDEX uniq_583d1f3e5e237e06 ON fos_user_group USING btree (name);


--
-- Name: uniq_c560d76192fc23a8; Type: INDEX; Schema: public; Owner: request; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c560d76192fc23a8 ON fos_user_user USING btree (username_canonical);


--
-- Name: uniq_c560d761a0d96fbf; Type: INDEX; Schema: public; Owner: request; Tablespace: 
--

CREATE UNIQUE INDEX uniq_c560d761a0d96fbf ON fos_user_user USING btree (email_canonical);


--
-- Name: fk_area_atencion_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT fk_area_atencion_area_servicio_atencion FOREIGN KEY (id_area_atencion) REFERENCES req_ctl_area_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_padre_area_trabajo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_area_trabajo
    ADD CONSTRAINT fk_area_padre_area_trabajo FOREIGN KEY (id_area_padre) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_atencion_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_area_servicio_atencion_empleado FOREIGN KEY (id_area_servicio_atencion) REFERENCES req_area_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_servicio_atencion_user_user; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_area_servicio_atencion_user_user FOREIGN KEY (id_area_servicio_atencion) REFERENCES req_area_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_trabajo_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_area_trabajo_requerimiento FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_trabajo_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_area_trabajo_requerimiento_trabajo_requerido FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_trabajo_solucion_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_solucion_requerimiento
    ADD CONSTRAINT fk_area_trabajo_solucion_requerimiento FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_area_trabajo_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_trabajo_requerido
    ADD CONSTRAINT fk_area_trabajo_trabajo_requerido FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_requerimiento_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_asigna_requerimiento_requerimiento FOREIGN KEY (id_asigna_requerimiento) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asigna_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_asigna_requerimiento_trabajo_requerido FOREIGN KEY (id_asigna_requerimiento) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_atencion_padre_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_servicio_atencion
    ADD CONSTRAINT fk_atencion_padre_servicio_atencion FOREIGN KEY (id_atencion_padre) REFERENCES req_ctl_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES fos_user_user(id) ON DELETE CASCADE;


--
-- Name: fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES fos_user_group(id) ON DELETE CASCADE;


--
-- Name: fk_cargo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_cargo_empleado FOREIGN KEY (id_cargo_empleado) REFERENCES req_ctl_cargo_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_asignado_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_empleado_asignado_equipo FOREIGN KEY (id_empleado_asignado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_asignado_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_empleado_asignado_requerimiento FOREIGN KEY (id_empleado_asignado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_asignado_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_empleado_asignado_requerimiento_trabajo_requerido FOREIGN KEY (id_empleado_asignado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_empleado_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado_area_servicio_atencion
    ADD CONSTRAINT fk_empleado_empleado_area_servicio_atencion FOREIGN KEY (id_empleado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_registra_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_empleado_registra_requerimiento FOREIGN KEY (id_empleado_registra) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_registra_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_empleado_registra_requerimiento_trabajo_requerido FOREIGN KEY (id_empleado_registra) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_requerimiento_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_empleado
    ADD CONSTRAINT fk_empleado_requerimiento_empleado FOREIGN KEY (id_empleado_asignado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_solicita_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_empleado_solicita_requerimiento FOREIGN KEY (id_empleado_solicita) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_user_user; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_empleado_user_user FOREIGN KEY (id_empleado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_equipo_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_equipo_requerimiento_trabajo_requerido FOREIGN KEY (id_equipo_solicitud) REFERENCES req_ctl_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_equipo_solicitud_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_equipo_solicitud_requerimiento FOREIGN KEY (id_equipo_solicitud) REFERENCES req_ctl_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_equipo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_estado_equipo_equipo FOREIGN KEY (id_estado_equipo) REFERENCES req_ctl_estado_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_padre_estado_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_estado_requerimiento
    ADD CONSTRAINT fk_estado_padre_estado_requerimiento FOREIGN KEY (id_estado_padre) REFERENCES req_ctl_estado_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_requerimiento_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_estado_requerimiento_requerimiento FOREIGN KEY (id_estado_requerimiento) REFERENCES req_ctl_estado_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_estado_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_estado_requerimiento_trabajo_requerido FOREIGN KEY (id_estado_requerimiento) REFERENCES req_ctl_estado_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_jefe_departamento_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT fk_jefe_departamento_area_servicio_atencion FOREIGN KEY (id_jefe_departamento) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_jefe_inmediato_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_jefe_inmediato_empleado FOREIGN KEY (id_jefe_inmediato) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_marca_equipo_modelo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_modelo_equipo
    ADD CONSTRAINT fk_marca_equipo_modelo_equipo FOREIGN KEY (id_marca_equipo) REFERENCES req_ctl_marca_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_marca_grupo_marca_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_marca_equipo
    ADD CONSTRAINT fk_marca_grupo_marca_equipo FOREIGN KEY (id_marca_grupo) REFERENCES req_ctl_marca_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_modalidad_atencion_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT fk_modalidad_atencion_area_servicio_atencion FOREIGN KEY (id_modalidad_atencion) REFERENCES req_ctl_modalidad_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_modelo_equipo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_modelo_equipo_equipo FOREIGN KEY (id_modelo_equipo) REFERENCES req_ctl_modelo_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_modelo_grupo_modelo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_modelo_equipo
    ADD CONSTRAINT fk_modelo_grupo_modelo_equipo FOREIGN KEY (id_modelo_grupo) REFERENCES req_ctl_modelo_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_requerimiento_padre_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_requerimiento_padre_requerimiento FOREIGN KEY (id_requerimiento_padre) REFERENCES req_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_requerimiento_requerimiento_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_empleado
    ADD CONSTRAINT fk_requerimiento_requerimiento_empleado FOREIGN KEY (id_requerimiento) REFERENCES req_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_requerimiento_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_requerimiento_requerimiento_trabajo_requerido FOREIGN KEY (id_requerimiento) REFERENCES req_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_servicio_asignado_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_servicio_asignado_equipo FOREIGN KEY (id_servicio_asignado) REFERENCES req_area_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_servicio_atencion_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT fk_servicio_atencion_area_servicio_atencion FOREIGN KEY (id_servicio_atencion) REFERENCES req_ctl_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_servicio_empleado_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado_area_servicio_atencion
    ADD CONSTRAINT fk_servicio_empleado_area_servicio_atencion FOREIGN KEY (id_area_servicio_atencion) REFERENCES req_area_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_servicio_externo_area_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT fk_servicio_externo_area_servicio_atencion FOREIGN KEY (id_servicio_externo) REFERENCES req_ctl_servicio_externo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_servicio_solicita_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_servicio_solicita_requerimiento FOREIGN KEY (id_servicio_solicita) REFERENCES req_area_servicio_atencion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_sexo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_sexo_empleado FOREIGN KEY (id_sexo) REFERENCES req_ctl_sexo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solucion_padre_solucion_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_solucion_requerimiento
    ADD CONSTRAINT fk_solucion_padre_solucion_requerimiento FOREIGN KEY (id_solucion_padre) REFERENCES req_ctl_solucion_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_solucion_requerimiento_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_solucion_requerimiento_requerimiento FOREIGN KEY (id_solucion_requerimiento) REFERENCES req_ctl_solucion_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_tipo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_tipo_empleado FOREIGN KEY (id_tipo_empleado) REFERENCES req_ctl_tipo_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_equipo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_tipo_equipo_equipo FOREIGN KEY (id_tipo_equipo) REFERENCES req_ctl_tipo_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_padre_tipo_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_equipo
    ADD CONSTRAINT fk_tipo_padre_tipo_equipo FOREIGN KEY (id_tipo_padre) REFERENCES req_ctl_tipo_equipo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_padre_tipo_servicio; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_tipo_servicio
    ADD CONSTRAINT fk_tipo_padre_tipo_servicio FOREIGN KEY (id_tipo_padre) REFERENCES req_ctl_tipo_servicio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_servicio_servicio_atencion; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_servicio_atencion
    ADD CONSTRAINT fk_tipo_servicio_servicio_atencion FOREIGN KEY (id_tipo_servicio) REFERENCES req_ctl_tipo_servicio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_trabajo_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_tipo_trabajo_requerimiento FOREIGN KEY (id_tipo_trabajo) REFERENCES req_ctl_tipo_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_trabajo_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_tipo_trabajo_requerimiento_trabajo_requerido FOREIGN KEY (id_tipo_trabajo) REFERENCES req_ctl_tipo_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_trabajo_requerido_padre_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_trabajo_requerido
    ADD CONSTRAINT fk_trabajo_requerido_padre_trabajo_requerido FOREIGN KEY (id_trabajo_requerido_padre) REFERENCES req_ctl_trabajo_requerido(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_trabajo_requerido_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_trabajo_requerido_requerimiento FOREIGN KEY (id_trabajo_requerido) REFERENCES req_ctl_trabajo_requerido(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_trabajo_requerido_requerimiento_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_empleado
    ADD CONSTRAINT fk_trabajo_requerido_requerimiento_empleado FOREIGN KEY (id_trabajo_requerido) REFERENCES req_requerimiento_trabajo_requerido(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_trabajo_requerido_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_trabajo_requerido_requerimiento_trabajo_requerido FOREIGN KEY (id_trabajo_requerido) REFERENCES req_ctl_trabajo_requerido(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_user_mod_empleado FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_user_mod_equipo FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_user_mod_requerimiento FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_mod_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_user_mod_requerimiento_trabajo_requerido FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_empleado; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_empleado
    ADD CONSTRAINT fk_user_reg_empleado FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_equipo; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_equipo
    ADD CONSTRAINT fk_user_reg_equipo FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_user_reg_requerimiento FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_user_reg_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_user_reg_requerimiento_trabajo_requerido FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

