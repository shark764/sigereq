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
    id_empleado integer
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
    id_servicio_externo smallint NOT NULL
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
    nombre character varying(50) NOT NULL,
    codigo character(3)
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
    id_area_padre smallint
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
    codigo character(3) DEFAULT 'DHP'::bpchar NOT NULL
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
    serie character varying(16)
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
    id integer NOT NULL,
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
-- Name: req_ctl_modelo_equipo; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_modelo_equipo (
    id integer NOT NULL,
    nombre character varying(75) DEFAULT 'Dell OptiPlex 9020'::character varying NOT NULL,
    codigo character(10) DEFAULT 'dlloptx9020'::bpchar NOT NULL,
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
    nombre character varying(100) NOT NULL,
    codigo character(6),
    id_atencion_padre integer
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
    nombre character varying(100) NOT NULL,
    codigo character(6)
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
-- Name: req_ctl_solucion_requerimiento; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_ctl_solucion_requerimiento (
    id smallint NOT NULL,
    nombre character varying(150) DEFAULT 'Funciona correctamente'::character varying NOT NULL,
    codigo character(3) DEFAULT 'FNC'::bpchar NOT NULL,
    id_solucion_padre smallint
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
    id integer NOT NULL,
    nombre character varying(75) NOT NULL,
    codigo character(3) DEFAULT 'Computadora de escritorio'::bpchar NOT NULL,
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
    sexo boolean DEFAULT true,
    id_area_servicio_atencion smallint
);


ALTER TABLE public.req_empleado OWNER TO request;

--
-- Name: req_empleado_area_servicio_atencion; Type: TABLE; Schema: public; Owner: request; Tablespace: 
--

CREATE TABLE req_empleado_area_servicio_atencion (
    id integer NOT NULL,
    id_area_servicio_atencion integer NOT NULL,
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
    fecha_hora_inicio timestamp without time zone NOT NULL,
    fecha_hora_fin timestamp without time zone NOT NULL,
    repetir_por smallint DEFAULT 0,
    dia_completo boolean DEFAULT false,
    color character varying(15) DEFAULT '#2a5469'::character varying,
    id_requerimiento_padre bigint,
    descripcion text NOT NULL,
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
    descripcion_requerimiento text,
    solucion text,
    fecha_asignacion timestamp without time zone,
    id_asigna_requerimiento integer,
    fecha_recibido timestamp without time zone,
    id_trabajo_requerido smallint,
    fecha_digitacion timestamp without time zone
);


ALTER TABLE public.req_requerimiento OWNER TO request;

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
    fecha_inicio timestamp without time zone,
    fecha_fin timestamp without time zone,
    descripcion text,
    solucion text,
    comentarios character varying(255),
    id_soluciona_requerimiento integer NOT NULL
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

ALTER TABLE ONLY req_ctl_estado_requerimiento ALTER COLUMN id SET DEFAULT nextval('req_ctl_estado_requerimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_ctl_marca_equipo ALTER COLUMN id SET DEFAULT nextval('req_ctl_marca_equipo_id_seq'::regclass);


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

ALTER TABLE ONLY req_requerimiento_trabajo_requerido ALTER COLUMN id SET DEFAULT nextval('req_requerimiento_trabajo_requerido_id_seq'::regclass);


--
-- Data for Name: fos_user_group; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: fos_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('fos_user_group_id_seq', 1, false);


--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, id_empleado) VALUES (1, 'admin', 'admin', 'farid.hdz.64@gmail.com', 'farid.hdz.64@gmail.com', true, 'qe8kcle04sgw0oo48w8ssko80cgcccc', 'G5pGA/C+RRlnARla0DX3jmEL+KsEv+8vscuTFXyeyk9Zn7qNKi8U4FGZh+KSFuIYTImRllOYrcVKcdH7IFeceA==', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', false, NULL, '2016-08-10 13:59:30', '2016-08-10 13:59:30', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL);
INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, id_empleado) VALUES (4, 'adminrequest', 'adminrequest', 'admin.request@gmail.com', 'admin.request@gmail.com', true, '3vl8bdxfucqog88gwsoswg4cg048ckg', 'pn5P8d7TkK9/TOb4Sn85Bdr6pRw+3fwPIM3lFbnm9lbNpMp1ykFMiVb0XMwMX6jCE/up5b3Yj+Q/SLSfK1++tQ==', '2016-08-24 17:27:49', false, false, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', false, NULL, '2016-08-24 01:03:31', '2016-08-24 17:27:49', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, NULL);


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



--
-- Name: req_ctl_area_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_area_atencion_id_seq', 1, false);


--
-- Data for Name: req_ctl_area_trabajo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (3, 'Soporte Técnico', 'SPT', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (4, 'Soporte Técnico en Equipos Informáticos', 'SPQ', 3);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (5, 'Soporte Técnico en Sistemas Informáticos', 'SPS', 3);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (6, 'Ofimática', 'OFM', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (7, 'Comunicaciones de Datos', 'RCD', 2);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (8, 'Redes de Datos', 'RDT', 2);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (2, 'Redes y Comunicaciones de Datos', 'RDD', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (9, 'Seguridad Informática', 'SGI', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (10, 'Mantenimiento de Equipos Informáticos', 'MNT', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (11, 'Virus Informáticos', 'SVR', 9);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (12, 'Administrativo', 'ADM', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (1, 'Sistemas Informáticos', 'SIT', NULL);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (14, 'Desarrollo de Sistemas Informáticos', 'DSI', 1);
INSERT INTO req_ctl_area_trabajo (id, nombre, codigo, id_area_padre) VALUES (15, 'Actualización de Sistemas Informáticos', 'ASI', 1);


--
-- Name: req_ctl_area_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_area_trabajo_id_seq', 15, true);


--
-- Data for Name: req_ctl_cargo_empleado; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_cargo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_cargo_empleado_id_seq', 1, false);


--
-- Data for Name: req_ctl_equipo; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_equipo_id_seq', 1, false);


--
-- Data for Name: req_ctl_estado_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_estado_requerimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_estado_requerimiento_id_seq', 1, false);


--
-- Data for Name: req_ctl_marca_equipo; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_marca_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_marca_equipo_id_seq', 1, false);


--
-- Data for Name: req_ctl_modelo_equipo; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_modelo_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_modelo_equipo_id_seq', 1, false);


--
-- Data for Name: req_ctl_servicio_atencion; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_servicio_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_servicio_atencion_id_seq', 1, false);


--
-- Data for Name: req_ctl_servicio_externo; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_servicio_externo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_servicio_externo_id_seq', 1, false);


--
-- Data for Name: req_ctl_solucion_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_solucion_requerimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_solucion_requerimiento_id_seq', 1, false);


--
-- Data for Name: req_ctl_tipo_empleado; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_tipo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_empleado_id_seq', 1, false);


--
-- Data for Name: req_ctl_tipo_equipo; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_tipo_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_equipo_id_seq', 1, false);


--
-- Data for Name: req_ctl_tipo_trabajo; Type: TABLE DATA; Schema: public; Owner: request
--

INSERT INTO req_ctl_tipo_trabajo (id, nombre, codigo) VALUES (1, 'Trabajo Correctivo       ', 'C');
INSERT INTO req_ctl_tipo_trabajo (id, nombre, codigo) VALUES (2, 'Trabajo Preventivo       ', 'P');


--
-- Name: req_ctl_tipo_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_tipo_trabajo_id_seq', 2, true);


--
-- Data for Name: req_ctl_trabajo_requerido; Type: TABLE DATA; Schema: public; Owner: request
--



--
-- Name: req_ctl_trabajo_requerido_id_seq; Type: SEQUENCE SET; Schema: public; Owner: request
--

SELECT pg_catalog.setval('req_ctl_trabajo_requerido_id_seq', 1, false);


--
-- Data for Name: req_empleado; Type: TABLE DATA; Schema: public; Owner: request
--



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

SELECT pg_catalog.setval('req_empleado_id_seq', 1, false);


--
-- Data for Name: req_requerimiento; Type: TABLE DATA; Schema: public; Owner: request
--



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

SELECT pg_catalog.setval('req_requerimiento_trabajo_requerido_id_seq', 1, false);


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
-- Name: idx_req_area_servicio_atencion; Type: CONSTRAINT; Schema: public; Owner: request; Tablespace: 
--

ALTER TABLE ONLY req_area_servicio_atencion
    ADD CONSTRAINT idx_req_area_servicio_atencion UNIQUE (id_area_atencion, id_servicio_atencion, id_servicio_externo);


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
-- Name: fk_area_trabajo_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_area_trabajo_requerimiento FOREIGN KEY (id_area_trabajo) REFERENCES req_ctl_area_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_empleado_user_user; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_empleado_user_user FOREIGN KEY (id_empleado) REFERENCES req_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_requerimiento_requerimiento_trabajo_requerido; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento_trabajo_requerido
    ADD CONSTRAINT fk_requerimiento_requerimiento_trabajo_requerido FOREIGN KEY (id_requerimiento) REFERENCES req_requerimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_tipo_trabajo_requerimiento; Type: FK CONSTRAINT; Schema: public; Owner: request
--

ALTER TABLE ONLY req_requerimiento
    ADD CONSTRAINT fk_tipo_trabajo_requerimiento FOREIGN KEY (id_tipo_trabajo) REFERENCES req_ctl_tipo_trabajo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

