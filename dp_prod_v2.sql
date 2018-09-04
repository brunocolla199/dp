--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.13
-- Dumped by pg_dump version 9.5.13

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: anexo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.anexo (
    id integer NOT NULL,
    nome character varying(200) NOT NULL,
    hash character varying(15) NOT NULL,
    extensao character varying(5) NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.anexo OWNER TO postgres;

--
-- Name: anexo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.anexo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.anexo_id_seq OWNER TO postgres;

--
-- Name: anexo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.anexo_id_seq OWNED BY public.anexo.id;


--
-- Name: aprovador_setor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aprovador_setor (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    setor_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.aprovador_setor OWNER TO postgres;

--
-- Name: aprovador_setor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aprovador_setor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.aprovador_setor_id_seq OWNER TO postgres;

--
-- Name: aprovador_setor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aprovador_setor_id_seq OWNED BY public.aprovador_setor.id;


--
-- Name: area_interesse_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.area_interesse_documento (
    id integer NOT NULL,
    documento_id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.area_interesse_documento OWNER TO postgres;

--
-- Name: area_interesse_documento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.area_interesse_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.area_interesse_documento_id_seq OWNER TO postgres;

--
-- Name: area_interesse_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.area_interesse_documento_id_seq OWNED BY public.area_interesse_documento.id;


--
-- Name: configuracao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.configuracao (
    id integer NOT NULL,
    numero_padrao_codigo character varying(5),
    admin_setor_qualidade integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.configuracao OWNER TO postgres;

--
-- Name: configuracao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.configuracao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.configuracao_id_seq OWNER TO postgres;

--
-- Name: configuracao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.configuracao_id_seq OWNED BY public.configuracao.id;


--
-- Name: dados_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dados_documento (
    id integer NOT NULL,
    validade date NOT NULL,
    status boolean NOT NULL,
    observacao text NOT NULL,
    copia_controlada boolean NOT NULL,
    nivel_acesso character varying(20) NOT NULL,
    finalizado boolean NOT NULL,
    setor_id integer NOT NULL,
    grupo_treinamento_id integer NOT NULL,
    grupo_divulgacao_id integer NOT NULL,
    elaborador_id integer NOT NULL,
    aprovador_id integer NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    necessita_revisao boolean DEFAULT false,
    id_usuario_solicitante integer,
    revisao character varying(20),
    justificativa_rejeicao_revisao character varying(200),
    em_revisao boolean DEFAULT false,
    justificativa_cancelar_revisao character varying(500),
    obsoleto boolean DEFAULT false NOT NULL
);


ALTER TABLE public.dados_documento OWNER TO postgres;

--
-- Name: dados_documento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dados_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dados_documento_id_seq OWNER TO postgres;

--
-- Name: dados_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dados_documento_id_seq OWNED BY public.dados_documento.id;


--
-- Name: documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documento (
    id integer NOT NULL,
    nome character varying(200) NOT NULL,
    codigo character varying(80) NOT NULL,
    extensao character varying(10) NOT NULL,
    tipo_documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.documento OWNER TO postgres;

--
-- Name: documento_formulario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documento_formulario (
    id integer NOT NULL,
    documento_id integer NOT NULL,
    formulario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.documento_formulario OWNER TO postgres;

--
-- Name: documento_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documento_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documento_formulario_id_seq OWNER TO postgres;

--
-- Name: documento_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documento_formulario_id_seq OWNED BY public.documento_formulario.id;


--
-- Name: documento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documento_id_seq OWNER TO postgres;

--
-- Name: documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documento_id_seq OWNED BY public.documento.id;


--
-- Name: documento_observacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documento_observacao (
    id integer NOT NULL,
    observacao character varying(350) NOT NULL,
    nome_usuario_responsavel character varying(100) NOT NULL,
    documento_id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.documento_observacao OWNER TO postgres;

--
-- Name: documento_observacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documento_observacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documento_observacao_id_seq OWNER TO postgres;

--
-- Name: documento_observacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documento_observacao_id_seq OWNED BY public.documento_observacao.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: formulario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.formulario (
    id integer NOT NULL,
    nome character varying(80) NOT NULL,
    codigo character varying(80) NOT NULL,
    extensao character varying(10) NOT NULL,
    conteudo text,
    nivel_acesso character varying(20) NOT NULL,
    finalizado boolean NOT NULL,
    tipo_documento_id integer NOT NULL,
    elaborador_id integer NOT NULL,
    setor_id integer NOT NULL,
    grupo_divulgacao_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    revisao character varying(20),
    em_revisao boolean DEFAULT false NOT NULL,
    id_usuario_solicitante integer,
    nome_completo_finalizado character varying(200),
    nome_completo_em_revisao character varying(200),
    justificativa_cancelar_revisao character varying(200),
    obsoleto boolean DEFAULT false NOT NULL
);


ALTER TABLE public.formulario OWNER TO postgres;

--
-- Name: formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.formulario_id_seq OWNER TO postgres;

--
-- Name: formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.formulario_id_seq OWNED BY public.formulario.id;


--
-- Name: formulario_revisao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.formulario_revisao (
    id integer NOT NULL,
    codigo character varying(10) NOT NULL,
    revisao character varying(3) NOT NULL,
    nome character varying(250) NOT NULL,
    nome_completo character varying(254) NOT NULL,
    extensao character varying(5) NOT NULL,
    nivel_acesso character varying(80) NOT NULL,
    finalizado boolean NOT NULL,
    documentos_necessitam character varying(80),
    formulario_id integer NOT NULL,
    tipo_documento_id integer NOT NULL,
    elaborador_id integer NOT NULL,
    setor_id integer NOT NULL,
    grupo_divulgacao_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.formulario_revisao OWNER TO postgres;

--
-- Name: formulario_revisao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.formulario_revisao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.formulario_revisao_id_seq OWNER TO postgres;

--
-- Name: formulario_revisao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.formulario_revisao_id_seq OWNED BY public.formulario_revisao.id;


--
-- Name: grupo_divulgacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_divulgacao (
    id integer NOT NULL,
    nome character varying(80) NOT NULL,
    descricao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grupo_divulgacao OWNER TO postgres;

--
-- Name: grupo_divulgacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_divulgacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_divulgacao_id_seq OWNER TO postgres;

--
-- Name: grupo_divulgacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_divulgacao_id_seq OWNED BY public.grupo_divulgacao.id;


--
-- Name: grupo_divulgacao_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_divulgacao_usuario (
    id integer NOT NULL,
    grupo_id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grupo_divulgacao_usuario OWNER TO postgres;

--
-- Name: grupo_divulgacao_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_divulgacao_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_divulgacao_usuario_id_seq OWNER TO postgres;

--
-- Name: grupo_divulgacao_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_divulgacao_usuario_id_seq OWNED BY public.grupo_divulgacao_usuario.id;


--
-- Name: grupo_treinamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_treinamento (
    id integer NOT NULL,
    nome character varying(80) NOT NULL,
    descricao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grupo_treinamento OWNER TO postgres;

--
-- Name: grupo_treinamento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_treinamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_treinamento_id_seq OWNER TO postgres;

--
-- Name: grupo_treinamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_treinamento_id_seq OWNED BY public.grupo_treinamento.id;


--
-- Name: grupo_treinamento_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_treinamento_usuario (
    id integer NOT NULL,
    grupo_id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grupo_treinamento_usuario OWNER TO postgres;

--
-- Name: grupo_treinamento_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_treinamento_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_treinamento_usuario_id_seq OWNER TO postgres;

--
-- Name: grupo_treinamento_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_treinamento_usuario_id_seq OWNED BY public.grupo_treinamento_usuario.id;


--
-- Name: historico_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historico_documento (
    id integer NOT NULL,
    descricao text NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_usuario_responsavel integer,
    nome_usuario_responsavel character varying(80)
);


ALTER TABLE public.historico_documento OWNER TO postgres;

--
-- Name: historico_documento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historico_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historico_documento_id_seq OWNER TO postgres;

--
-- Name: historico_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historico_documento_id_seq OWNED BY public.historico_documento.id;


--
-- Name: historico_formulario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historico_formulario (
    id integer NOT NULL,
    descricao text NOT NULL,
    formulario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_usuario_responsavel integer,
    nome_usuario_responsavel character varying(80)
);


ALTER TABLE public.historico_formulario OWNER TO postgres;

--
-- Name: historico_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historico_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historico_formulario_id_seq OWNER TO postgres;

--
-- Name: historico_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historico_formulario_id_seq OWNED BY public.historico_formulario.id;


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: lista_presenca; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lista_presenca (
    id integer NOT NULL,
    nome character varying(80) NOT NULL,
    extensao character varying(10) NOT NULL,
    data date NOT NULL,
    descricao text NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.lista_presenca OWNER TO postgres;

--
-- Name: lista_presenca_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lista_presenca_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lista_presenca_id_seq OWNER TO postgres;

--
-- Name: lista_presenca_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lista_presenca_id_seq OWNED BY public.lista_presenca.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: notificacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notificacao (
    id integer NOT NULL,
    texto character varying(100) NOT NULL,
    visualizada boolean NOT NULL,
    necessita_interacao boolean NOT NULL,
    usuario_id integer NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.notificacao OWNER TO postgres;

--
-- Name: notificacao_formulario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notificacao_formulario (
    id integer NOT NULL,
    texto character varying(100) NOT NULL,
    visualizada boolean NOT NULL,
    necessita_interacao boolean NOT NULL,
    usuario_id integer NOT NULL,
    formulario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.notificacao_formulario OWNER TO postgres;

--
-- Name: notificacao_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notificacao_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notificacao_formulario_id_seq OWNER TO postgres;

--
-- Name: notificacao_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notificacao_formulario_id_seq OWNED BY public.notificacao_formulario.id;


--
-- Name: notificacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notificacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notificacao_id_seq OWNER TO postgres;

--
-- Name: notificacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notificacao_id_seq OWNED BY public.notificacao.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: setor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.setor (
    id integer NOT NULL,
    nome character varying(80) NOT NULL,
    sigla character varying(5) NOT NULL,
    descricao text NOT NULL,
    tipo_setor_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.setor OWNER TO postgres;

--
-- Name: setor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.setor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.setor_id_seq OWNER TO postgres;

--
-- Name: setor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.setor_id_seq OWNED BY public.setor.id;


--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_documento (
    id integer NOT NULL,
    nome_tipo character varying(80) NOT NULL,
    sigla character varying(10) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tipo_documento OWNER TO postgres;

--
-- Name: tipo_documento_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_documento_id_seq OWNER TO postgres;

--
-- Name: tipo_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_documento_id_seq OWNED BY public.tipo_documento.id;


--
-- Name: tipo_setor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_setor (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tipo_setor OWNER TO postgres;

--
-- Name: tipo_setor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_setor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_setor_id_seq OWNER TO postgres;

--
-- Name: tipo_setor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_setor_id_seq OWNED BY public.tipo_setor.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    setor_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: workflow; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workflow (
    id integer NOT NULL,
    etapa_num integer NOT NULL,
    etapa character varying(50) NOT NULL,
    descricao character varying(100) NOT NULL,
    justificativa character varying(300) NOT NULL,
    documento_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.workflow OWNER TO postgres;

--
-- Name: workflow_formulario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workflow_formulario (
    id integer NOT NULL,
    etapa_num integer NOT NULL,
    etapa character varying(50) NOT NULL,
    descricao character varying(100) NOT NULL,
    justificativa character varying(300) NOT NULL,
    formulario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.workflow_formulario OWNER TO postgres;

--
-- Name: workflow_formulario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workflow_formulario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.workflow_formulario_id_seq OWNER TO postgres;

--
-- Name: workflow_formulario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workflow_formulario_id_seq OWNED BY public.workflow_formulario.id;


--
-- Name: workflow_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workflow_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.workflow_id_seq OWNER TO postgres;

--
-- Name: workflow_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workflow_id_seq OWNED BY public.workflow.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anexo ALTER COLUMN id SET DEFAULT nextval('public.anexo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprovador_setor ALTER COLUMN id SET DEFAULT nextval('public.aprovador_setor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.area_interesse_documento ALTER COLUMN id SET DEFAULT nextval('public.area_interesse_documento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.configuracao ALTER COLUMN id SET DEFAULT nextval('public.configuracao_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento ALTER COLUMN id SET DEFAULT nextval('public.dados_documento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento ALTER COLUMN id SET DEFAULT nextval('public.documento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_formulario ALTER COLUMN id SET DEFAULT nextval('public.documento_formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_observacao ALTER COLUMN id SET DEFAULT nextval('public.documento_observacao_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario ALTER COLUMN id SET DEFAULT nextval('public.formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao ALTER COLUMN id SET DEFAULT nextval('public.formulario_revisao_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao ALTER COLUMN id SET DEFAULT nextval('public.grupo_divulgacao_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao_usuario ALTER COLUMN id SET DEFAULT nextval('public.grupo_divulgacao_usuario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento ALTER COLUMN id SET DEFAULT nextval('public.grupo_treinamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento_usuario ALTER COLUMN id SET DEFAULT nextval('public.grupo_treinamento_usuario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_documento ALTER COLUMN id SET DEFAULT nextval('public.historico_documento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_formulario ALTER COLUMN id SET DEFAULT nextval('public.historico_formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_presenca ALTER COLUMN id SET DEFAULT nextval('public.lista_presenca_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao ALTER COLUMN id SET DEFAULT nextval('public.notificacao_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao_formulario ALTER COLUMN id SET DEFAULT nextval('public.notificacao_formulario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setor ALTER COLUMN id SET DEFAULT nextval('public.setor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_documento ALTER COLUMN id SET DEFAULT nextval('public.tipo_documento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_setor ALTER COLUMN id SET DEFAULT nextval('public.tipo_setor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow ALTER COLUMN id SET DEFAULT nextval('public.workflow_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_formulario ALTER COLUMN id SET DEFAULT nextval('public.workflow_formulario_id_seq'::regclass);


--
-- Data for Name: anexo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.anexo (id, nome, hash, extensao, documento_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: anexo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.anexo_id_seq', 11, true);


--
-- Data for Name: aprovador_setor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.aprovador_setor (id, usuario_id, setor_id, created_at, updated_at) FROM stdin;
3	1003	1	2018-08-06 15:00:37	2018-08-06 15:00:37
4	670	1	2018-08-06 15:01:27	2018-08-06 15:01:27
8	1	2	2018-08-06 15:39:42	2018-08-06 15:39:42
10	1	13	2018-08-09 08:40:43	2018-08-09 08:40:43
11	1	1	2018-08-13 17:39:00	2018-08-13 17:39:00
12	962	14	2018-08-13 17:48:05	2018-08-13 17:48:05
13	1	14	2018-08-14 09:07:43	2018-08-14 09:07:43
14	962	5	2018-08-14 09:39:11	2018-08-14 09:39:11
15	670	2	2018-08-28 16:10:29	2018-08-28 16:10:29
16	1	17	2018-08-30 08:23:53	2018-08-30 08:23:53
17	962	17	2018-08-30 08:23:53	2018-08-30 08:23:53
\.


--
-- Name: aprovador_setor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aprovador_setor_id_seq', 17, true);


--
-- Data for Name: area_interesse_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.area_interesse_documento (id, documento_id, usuario_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: area_interesse_documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.area_interesse_documento_id_seq', 107, true);


--
-- Data for Name: configuracao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.configuracao (id, numero_padrao_codigo, admin_setor_qualidade, created_at, updated_at) FROM stdin;
1	000	0	2018-08-06 13:25:38	2018-08-06 13:25:38
2		690	2018-08-06 13:25:38	2018-08-06 14:58:11
\.


--
-- Name: configuracao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.configuracao_id_seq', 2, true);


--
-- Data for Name: dados_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dados_documento (id, validade, status, observacao, copia_controlada, nivel_acesso, finalizado, setor_id, grupo_treinamento_id, grupo_divulgacao_id, elaborador_id, aprovador_id, documento_id, created_at, updated_at, necessita_revisao, id_usuario_solicitante, revisao, justificativa_rejeicao_revisao, em_revisao, justificativa_cancelar_revisao, obsoleto) FROM stdin;
81	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	81	2018-09-01 02:25:31	2018-09-01 02:25:31	f	\N	04	\N	f	\N	f
82	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	82	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	04	\N	f	\N	f
83	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	83	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	00	\N	f	\N	f
84	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	84	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	06	\N	f	\N	f
85	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	85	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	00	\N	f	\N	f
86	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	86	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	00	\N	f	\N	f
87	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	87	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	01	\N	f	\N	f
88	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	88	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	09	\N	f	\N	f
89	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	89	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	04	\N	f	\N	f
90	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	90	2018-09-01 02:27:31	2018-09-01 02:27:31	f	\N	02	\N	f	\N	f
91	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	91	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	10	\N	f	\N	f
92	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	92	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	08	\N	f	\N	f
93	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	93	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	00	\N	f	\N	f
94	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	94	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	01	\N	f	\N	f
95	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	95	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	08	\N	f	\N	f
96	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	96	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	02	\N	f	\N	f
97	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	97	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	01	\N	f	\N	f
98	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	98	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	04	\N	f	\N	f
99	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	99	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	00	\N	f	\N	f
100	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	100	2018-09-01 02:27:32	2018-09-01 02:27:32	f	\N	01	\N	f	\N	f
101	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	101	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	 01	\N	f	\N	f
102	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	102	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	07	\N	f	\N	f
103	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	103	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	04	\N	f	\N	f
104	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	104	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	04	\N	f	\N	f
105	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	105	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	05	\N	f	\N	f
106	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	106	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	06	\N	f	\N	f
107	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	107	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	02	\N	f	\N	f
108	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	108	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	00	\N	f	\N	f
109	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	109	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	01	\N	f	\N	f
110	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	110	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	01	\N	f	\N	f
111	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	111	2018-09-01 02:27:33	2018-09-01 02:27:33	f	\N	00	\N	f	\N	f
112	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	112	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
113	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	113	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
114	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	114	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
115	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	115	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
116	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	116	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
117	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	117	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
118	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	118	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
119	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	119	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
120	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	120	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
121	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	121	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
122	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	122	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	01	\N	f	\N	f
123	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	123	2018-09-01 02:27:34	2018-09-01 02:27:34	f	\N	00	\N	f	\N	f
124	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	124	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	01	\N	f	\N	f
125	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	125	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
126	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	126	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	01	\N	f	\N	f
127	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	127	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	02	\N	f	\N	f
128	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	128	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
129	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	129	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
130	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	130	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	03	\N	f	\N	f
131	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	131	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	01	\N	f	\N	f
132	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	132	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
133	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	133	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
134	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	134	2018-09-01 02:27:35	2018-09-01 02:27:35	f	\N	00	\N	f	\N	f
135	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	135	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
136	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	136	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	01	\N	f	\N	f
137	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	137	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
138	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	138	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
139	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	139	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
140	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	140	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
141	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	141	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00	\N	f	\N	f
142	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	142	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	00.	\N	f	\N	f
143	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	143	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	01	\N	f	\N	f
144	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	144	2018-09-01 02:27:36	2018-09-01 02:27:36	f	\N	03	\N	f	\N	f
145	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	145	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	00	\N	f	\N	f
146	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	146	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	00	\N	f	\N	f
147	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	147	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	00	\N	f	\N	f
148	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	148	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	03 - 04.12.2017	\N	f	\N	f
149	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	149	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	00	\N	f	\N	f
150	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	150	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	01	\N	f	\N	f
151	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	151	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	01	\N	f	\N	f
152	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	152	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	00	\N	f	\N	f
153	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	153	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	01	\N	f	\N	f
154	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	154	2018-09-01 02:27:37	2018-09-01 02:27:37	f	\N	02	\N	f	\N	f
155	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	155	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	01	\N	f	\N	f
156	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	156	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	03	\N	f	\N	f
157	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	157	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	01	\N	f	\N	f
158	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	158	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	03	\N	f	\N	f
159	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	159	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	05	\N	f	\N	f
160	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	160	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	04	\N	f	\N	f
161	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	161	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	00	\N	f	\N	f
162	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	162	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	02	\N	f	\N	f
163	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	163	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	01	\N	f	\N	f
164	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	164	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	00	\N	f	\N	f
165	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	165	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	03	\N	f	\N	f
166	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	166	2018-09-01 02:27:38	2018-09-01 02:27:38	f	\N	04	\N	f	\N	f
167	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	167	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	02	\N	f	\N	f
168	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	168	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	01	\N	f	\N	f
169	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	169	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	05	\N	f	\N	f
170	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	170	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	04	\N	f	\N	f
171	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	171	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	02	\N	f	\N	f
172	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	172	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	02	\N	f	\N	f
173	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	173	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	00	\N	f	\N	f
174	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	174	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	04	\N	f	\N	f
175	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	175	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	02	\N	f	\N	f
176	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	176	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	00	\N	f	\N	f
177	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	177	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	00	\N	f	\N	f
178	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	178	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	01	\N	f	\N	f
179	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	179	2018-09-01 02:27:39	2018-09-01 02:27:39	f	\N	01	\N	f	\N	f
180	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	180	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
181	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	181	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
182	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	182	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
183	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	183	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
184	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	184	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
185	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	185	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
186	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	186	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	04	\N	f	\N	f
187	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	187	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
188	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	188	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
189	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	189	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	01	\N	f	\N	f
190	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	190	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
191	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	191	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	00	\N	f	\N	f
192	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	192	2018-09-01 02:27:40	2018-09-01 02:27:40	f	\N	02	\N	f	\N	f
193	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	193	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	01	\N	f	\N	f
194	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	194	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
195	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	195	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
196	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	196	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	01	\N	f	\N	f
197	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	197	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	01	\N	f	\N	f
198	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	198	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
199	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	199	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
200	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	200	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
201	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	201	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	02	\N	f	\N	f
202	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	202	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
203	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	203	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
204	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	204	2018-09-01 02:27:41	2018-09-01 02:27:41	f	\N	00	\N	f	\N	f
205	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	205	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
206	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	206	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
207	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	207	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
208	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	208	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
209	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	209	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	05	\N	f	\N	f
210	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	210	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
211	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	211	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
212	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	212	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	01	\N	f	\N	f
213	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	213	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
214	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	214	2018-09-01 02:27:42	2018-09-01 02:27:42	f	\N	00	\N	f	\N	f
215	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	215	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
216	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	216	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
217	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	217	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
218	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	218	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
219	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	219	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
220	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	220	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	01	\N	f	\N	f
221	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	221	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	01	\N	f	\N	f
222	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	222	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
223	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	223	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	02	\N	f	\N	f
224	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	224	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	00	\N	f	\N	f
225	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	225	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	04	\N	f	\N	f
226	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	226	2018-09-01 02:27:43	2018-09-01 02:27:43	f	\N	 01	\N	f	\N	f
227	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	227	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	00	\N	f	\N	f
228	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	228	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	01	\N	f	\N	f
229	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	229	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	03	\N	f	\N	f
230	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	230	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	02	\N	f	\N	f
231	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	231	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	02	\N	f	\N	f
232	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	232	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	07	\N	f	\N	f
233	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	233	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	02	\N	f	\N	f
234	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	234	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	03	\N	f	\N	f
235	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	235	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	03	\N	f	\N	f
236	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	236	2018-09-01 02:27:44	2018-09-01 02:27:44	f	\N	07	\N	f	\N	f
237	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	237	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	04	\N	f	\N	f
238	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	238	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	02	\N	f	\N	f
239	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	239	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	04	\N	f	\N	f
240	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	240	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	02	\N	f	\N	f
241	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	241	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	05	\N	f	\N	f
242	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	242	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	00	\N	f	\N	f
243	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	243	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	03	\N	f	\N	f
244	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	244	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	02	\N	f	\N	f
245	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	245	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	01	\N	f	\N	f
246	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	246	2018-09-01 02:27:45	2018-09-01 02:27:45	f	\N	04	\N	f	\N	f
247	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	247	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	04	\N	f	\N	f
248	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	248	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	05	\N	f	\N	f
249	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	249	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	12	\N	f	\N	f
250	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	250	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	03	\N	f	\N	f
251	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	251	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	09	\N	f	\N	f
252	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	252	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	01	\N	f	\N	f
253	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	253	2018-09-01 02:27:46	2018-09-01 02:27:46	f	\N	01	\N	f	\N	f
254	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	254	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	01	\N	f	\N	f
255	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	255	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	00	\N	f	\N	f
256	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	256	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	05	\N	f	\N	f
257	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	257	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	02	\N	f	\N	f
258	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	258	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	01	\N	f	\N	f
259	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	259	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	02	\N	f	\N	f
260	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	260	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	01	\N	f	\N	f
261	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	261	2018-09-01 02:27:47	2018-09-01 02:27:47	f	\N	02	\N	f	\N	f
262	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	262	2018-09-01 02:27:48	2018-09-01 02:27:48	f	\N	03	\N	f	\N	f
263	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	263	2018-09-01 02:27:48	2018-09-01 02:27:48	f	\N	00	\N	f	\N	f
264	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	264	2018-09-01 02:27:48	2018-09-01 02:27:48	f	\N	00	\N	f	\N	f
265	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	265	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
266	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	266	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	01	\N	f	\N	f
267	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	267	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
268	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	268	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	02	\N	f	\N	f
269	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	269	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
270	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	270	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
271	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	271	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
272	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	272	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
273	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	273	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
274	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	274	2018-09-01 02:27:49	2018-09-01 02:27:49	f	\N	00	\N	f	\N	f
275	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	275	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
276	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	276	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
277	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	277	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
278	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	278	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
279	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	279	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
280	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	280	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	01	\N	f	\N	f
281	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	281	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
282	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	282	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
283	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	283	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	01	\N	f	\N	f
284	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	284	2018-09-01 02:27:50	2018-09-01 02:27:50	f	\N	00	\N	f	\N	f
285	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	285	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	00	\N	f	\N	f
286	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	286	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	00	\N	f	\N	f
287	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	287	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	00	\N	f	\N	f
288	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	288	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	01	\N	f	\N	f
289	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	289	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	01	\N	f	\N	f
290	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	290	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	00	\N	f	\N	f
291	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	291	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	00	\N	f	\N	f
292	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	292	2018-09-01 02:27:51	2018-09-01 02:27:51	f	\N	01	\N	f	\N	f
293	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	293	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
294	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	294	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
295	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	295	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
296	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	296	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
297	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	297	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
298	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	298	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	01	\N	f	\N	f
299	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	299	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	01	\N	f	\N	f
300	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	300	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
301	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	301	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
302	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	302	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
303	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	303	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	00	\N	f	\N	f
304	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	304	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	04	\N	f	\N	f
305	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	305	2018-09-01 02:27:52	2018-09-01 02:27:52	f	\N	04	\N	f	\N	f
306	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	306	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	02	\N	f	\N	f
307	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	307	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	04	\N	f	\N	f
308	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	308	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	02	\N	f	\N	f
309	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	309	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	01	\N	f	\N	f
310	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	310	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	03	\N	f	\N	f
311	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	311	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	02	\N	f	\N	f
312	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	312	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	02	\N	f	\N	f
313	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	313	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	10	\N	f	\N	f
314	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	314	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	00	\N	f	\N	f
315	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	315	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	09	\N	f	\N	f
316	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	316	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	20	\N	f	\N	f
317	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	317	2018-09-01 02:27:53	2018-09-01 02:27:53	f	\N	07	\N	f	\N	f
318	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	318	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	10	\N	f	\N	f
319	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	319	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	01	\N	f	\N	f
320	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	320	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	07	\N	f	\N	f
321	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	321	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	02	\N	f	\N	f
322	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	322	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	07	\N	f	\N	f
323	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	323	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	04	\N	f	\N	f
324	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	324	2018-09-01 02:27:54	2018-09-01 02:27:54	f	\N	03	\N	f	\N	f
325	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	325	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	02	\N	f	\N	f
326	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	326	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	11	\N	f	\N	f
327	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	327	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	02	\N	f	\N	f
328	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	328	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	08	\N	f	\N	f
329	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	329	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	01	\N	f	\N	f
330	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	330	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	 02	\N	f	\N	f
331	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	331	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	04	\N	f	\N	f
332	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	332	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	03	\N	f	\N	f
333	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	333	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	05	\N	f	\N	f
334	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	334	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	02	\N	f	\N	f
335	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	335	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	04	\N	f	\N	f
336	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	336	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	03	\N	f	\N	f
337	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	337	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	01	\N	f	\N	f
338	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	338	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	01	\N	f	\N	f
339	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	339	2018-09-01 02:27:55	2018-09-01 02:27:55	f	\N	02	\N	f	\N	f
340	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	340	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	03	\N	f	\N	f
341	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	341	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	02	\N	f	\N	f
342	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	342	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	02	\N	f	\N	f
343	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	343	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	00	\N	f	\N	f
344	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	344	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	01	\N	f	\N	f
345	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	345	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	00	\N	f	\N	f
346	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	346	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	05	\N	f	\N	f
347	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	347	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	04	\N	f	\N	f
348	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	348	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	02	\N	f	\N	f
349	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	349	2018-09-01 02:27:56	2018-09-01 02:27:56	f	\N	01	\N	f	\N	f
350	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	350	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	01	\N	f	\N	f
351	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	351	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	00	\N	f	\N	f
352	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	352	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	02	\N	f	\N	f
353	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	353	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	01	\N	f	\N	f
354	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	354	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	00	\N	f	\N	f
355	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	355	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	01	\N	f	\N	f
356	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	356	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	00	\N	f	\N	f
357	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	357	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	01	\N	f	\N	f
358	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	358	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	00	\N	f	\N	f
359	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	359	2018-09-01 02:27:57	2018-09-01 02:27:57	f	\N	02	\N	f	\N	f
360	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	360	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	01	\N	f	\N	f
361	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	361	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
362	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	362	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	01	\N	f	\N	f
363	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	363	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
364	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	364	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
365	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	365	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	01	\N	f	\N	f
366	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	366	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	02	\N	f	\N	f
367	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	367	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
368	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	368	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
369	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	369	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
370	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	370	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
371	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	371	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	00	\N	f	\N	f
372	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	372	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	01	\N	f	\N	f
373	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	373	2018-09-01 02:27:58	2018-09-01 02:27:58	f	\N	01	\N	f	\N	f
374	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	374	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	00	\N	f	\N	f
375	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	375	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	03	\N	f	\N	f
376	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	376	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	00	\N	f	\N	f
377	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	377	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	07	\N	f	\N	f
378	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	378	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	04	\N	f	\N	f
379	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	379	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	04	\N	f	\N	f
380	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	380	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	02	\N	f	\N	f
381	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	381	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	03	\N	f	\N	f
382	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	382	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	04	\N	f	\N	f
383	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	383	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	01	\N	f	\N	f
384	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	384	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	01	\N	f	\N	f
385	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	385	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	03	\N	f	\N	f
386	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	386	2018-09-01 02:27:59	2018-09-01 02:27:59	f	\N	09	\N	f	\N	f
387	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	387	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	01	\N	f	\N	f
388	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	388	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	03	\N	f	\N	f
389	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	389	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	01	\N	f	\N	f
390	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	390	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	02	\N	f	\N	f
391	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	391	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	01	\N	f	\N	f
392	2018-08-29	t	Documento Finalizado (Importação)	f	Livre	t	1	1	1	1	1	392	2018-09-01 02:28:00	2018-09-01 02:28:00	f	\N	02	\N	f	\N	f
\.


--
-- Name: dados_documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dados_documento_id_seq', 392, true);


--
-- Data for Name: documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documento (id, nome, codigo, extensao, tipo_documento_id, created_at, updated_at) FROM stdin;
81	DG-01 - Plano de Prevenção e Gerenciamento de Crise - 10.10.2017 - _rev04	DG-01	docx	3	2018-09-01 02:25:31	2018-09-01 02:25:31
82	DG-01 - Plano de Prevenção e Gerenciamento de Crise - 10.10.2017 - _rev04	DG-01	docx	3	2018-09-01 02:27:30	2018-09-01 02:27:30
83	DG-02 - Comissão de Prevenção de Acidentes no Trabalho Portuário - 16.11.2017 - _rev00	DG-02	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
84	DG-05 - Plano de Emergência Individual - 20.04.2017 - _rev06	DG-05	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
85	DG-07 - Documento Único de Delegação de Autoridade  - 07.12.2017 - _rev00	DG-07	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
86	DG-08 - Programa de Gerenciamento de Mudança - 07.06.2017 - _rev00	DG-08	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
87	DG-09 - Manual de Boas Práticas de Armazenagem - 14.10.2016 - _rev01	DG-09	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
88	DG-10 - Contexto de Gerenciamento de Riscos à Segurança - 04.06.2018 - _rev09	DG-10	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
89	DG-11 - Plano de Gerenciamento de Resíduos de Serviço de Saúde - 01.06.2017 - _rev04	DG-11	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
90	DG-12 - Plano Interno de Prevenção e Combate à Dengue - 03.05.2018 - _rev02	DG-12	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
91	DG-13 - Programa de Controle Médico Ocupacional - Terminal Portuário - 21.11.2017 - _rev10	DG-13	docx	3	2018-09-01 02:27:31	2018-09-01 02:27:31
92	DG-14 - Programa de Gerenciamento de Trafego - 05.03.2018 - _rev08	DG-14	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
93	DG-15 - Codigo de conduta da Embraport - 12.08.14 - _rev00	DG-15	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
94	DG-16 - Codigo de conduta do Fornecedor - 12.01.2016 - _rev01	DG-16	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
95	DG-17 - Plano de Contingência e Emergência - 17.05.2018 - _rev08	DG-17	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
96	DG-18 - Plano de Contingência do escâner de contêineres - 02.05.2017 - _rev02	DG-18	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
97	DG-19 - Plano de Contingência em caso de Interrupção no Fornecimento de Energia Elétrica - 06.06.2018 - _rev01	DG-19	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
98	DG-20 - Programa de Controle Médico Ocupacional - Unidade  Administrativa  - 21.09.2017 - _rev04	DG-20	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
99	DG-21- Programa de Prevenção a Dependência de Álcool e Drogas - 16.12.2015 - _rev00	DG-21-	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
100	DG-22 - Programa de Prevenção a Acidentes Relacionados à Fadiga -25.10.2016 - _rev01	DG-22	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
101	DG-23 - Plano de Segurança para Produtos Controlados pelo Exército - 15.01.2018 - _rev 01	DG-23	docx	3	2018-09-01 02:27:32	2018-09-01 02:27:32
102	PG-01 - Gestão da Qualidade - 08.05.2018 - _rev07	PG-01	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
103	PG-03 - Gestão de Saúde e Segurança do Trabalho - 11.10.2017 - _rev04	PG-03	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
104	PG-04 - Gestão Socioambiental -  27.04.2015 - _rev04	PG-04	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
105	PG-05 - Gestão de Pessoas - 22.03.2017 - _rev05	PG-05	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
106	PG-06 - Gestão de Compras e Fornecedores - 17.04.2018 - _rev06	PG-06	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
107	PG-08 - Gestão de Manutenção - 25.02.2016 -  _rev02	PG-08	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
108	PG-09 - Gestão de Controladoria - 16.07.2015 - _rev00	PG-09	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
109	PG-10 - Gestão da Comunicação - 30 04 2015 - _rev01	PG-10	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
110	PG-11 - Gestão Comercial - 14.05.2018 - _rev01	PG-11	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
111	PG-13 -  Voluntariado - 01.06.2017 - _rev00	PG-13	docx	2	2018-09-01 02:27:33	2018-09-01 02:27:33
112	PG-14 - Gestão de Riscos e Oportunidades - 03.05.2018 - _rev00	PG-14	docx	2	2018-09-01 02:27:34	2018-09-01 02:27:34
113	IT-ADM-002 - Recebimento e Circulação de Documentos - 06.08.2014 - _rev00	IT-ADM-002	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
114	IT-ADM-008 - Diretrizes e Gestão de Viagens Hospedagem e Transporte - 01.08.2014 - _rev00	IT-ADM-008	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
115	IT-ADU-001 - Desconsolidação - 15.05.2017 - _rev00	IT-ADU-001	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
116	IT-ADU-002 - Presença de Carga - 15.05.2017 - _rev00	IT-ADU-002	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
117	IT-ADU-008 - Averbação (On Line - Manual) - 04.04.2014 - _rev00	IT-ADU-008	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
118	IT-ADU-009 - Habilitar entrega de Cabotagem Porto - 04.04.2014 - _rev00	IT-ADU-009	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
119	IT-ADU-010 - Registro e Liberação - Agendamento Cabotagem Porto - 04.04.2014 - _rev00	IT-ADU-010	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
120	IT-ADU-011 - Registro e Liberação - Agendamento DTA Pátio - 04.04.2014 - _rev00	IT-ADU-011	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
121	IT-ADU-012 - Registro e Liberação - Agendamento Processos On Line (DI-DSI-DTA-ARM) - 04.04.2014 - _rev00	IT-ADU-012	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
122	IT-ADU-013 - Procedimentos para Envio e Recebimento de Dados - 01.08.2014 - _rev01	IT-ADU-013	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
123	IT-ADU-016 - Atendimento a Fiscalização e Controle Aduaneiro - 16.04.2014 - _rev00	IT-ADU-016	docx	1	2018-09-01 02:27:34	2018-09-01 02:27:34
124	IT-ADU-017 - Apoio ao MAPA - 20.02.2018 - _rev01	IT-ADU-017	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
125	IT-ADU-018 - Triagem documento físico digital de Processos aduaneiros – 23.04.2014 – _rev00	IT-ADU-018	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
126	IT-ADU-019 - Plano de Contingência para Quedas no Sistema  29.09.2017 - _rev01	IT-ADU-019	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
127	IT-AMB-001 - Identificação dos Aspectos e Avaliação dos Impactos Ambientais - 23.09.2016 - _rev02	IT-AMB-001	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
128	IT-AMB-002 - Conteineres com Vazamento Produto Perigoso ou Sob Suspeita - 18.06.2014 - _rev00	IT-AMB-002	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
129	IT-AMB-003 - Controle de Fumaça Preta - 30.06.2014 - _rev00	IT-AMB-003	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
130	IT-AMB-004 - Inspeções de Meio Ambiente  - 05.09.2016 - _rev03	IT-AMB-004	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
131	IT-AMB-005 - Controle da Emissão de Ruídos - 11.06.2018 - _rev01	IT-AMB-005	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
132	IT-AMB-006 - Controle de Emissão de Efluentes - 24.04.2015 - _rev00	IT-AMB-006	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
133	IT-AMB-007 - Monitoramento da fauna aquática - 24.04.2015 - _rev00	IT-AMB-007	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
134	IT-AMB-008 - Monitoramento da fauna terrestre - 24.04.2015 - _rev00	IT-AMB-008	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
135	IT-AMB-009 - Monitoramento de Águas Superficiais - 24.04.2015 - _rev00	IT-AMB-009	docx	1	2018-09-01 02:27:35	2018-09-01 02:27:35
136	IT-AMB-010 - Programa de Educação Ambiental - 27.12.2017 - _rev01	IT-AMB-010	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
137	IT-AMB-011 - Controle de Qualidade das Águas Subterrâneas - 24.04.2015 - _rev00	IT-AMB-011	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
138	IT-AMB-012 - Monitoramento da Vegetação Remanescente - 24.04.2015 - _rev00	IT-AMB-012	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
139	IT-AMB-013 - Proteção da Fauna Silvestre - 07.05.2015 - _rev00	IT-AMB-013	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
140	IT-AMB-014 - Manuseio de Resíduos Sólidos - 30.09.2016 - _rev00	IT-AMB-014	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
141	IT-AMB-015 - Plano Controle Ambiental das Obras - 08.01.2018 - _rev00	IT-AMB-015	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
142	IT-ARM-001 - Mudança de janelas - 11.01.2017 - _rev00.	IT-ARM-001	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
143	IT-CDI-001 - Liberação Para Atuação de Prestadores de Serviço - 05.04.2017 - _rev01	IT-CDI-001	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
144	IT-CDI-002 - Homologação Contratada - 25.05.2018 - _rev03	IT-CDI-002	docx	1	2018-09-01 02:27:36	2018-09-01 02:27:36
145	IT-CDI-003 - Liberação de Pagamento - Contratada - 03.02.2015 - _rev00	IT-CDI-003	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
146	IT-CMP-001 - Requisição de Compras - 10.07.2014 - _rev00	IT-CMP-001	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
147	IT-CMP-002 - Guia do Comprador - 11.07.2014 - _rev00	IT-CMP-002	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
148	IT-CMP-003 - Guia do Fornecedor -  _rev03 - 04.12.2017	IT-CMP-003	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
149	IT-CMP-004 - Cadastro de Fornecedor - 11.07.2014 - _rev00	IT-CMP-004	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
150	IT-COC-001 - Relacionamento com a Imprensa - 30.04.2015 - _rev01	IT-COC-001	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
151	IT-COC-002 - Gerenciamento de Ideias e Ouvidoria - 30.04.2015 - _rev01	IT-COC-002	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
152	IT-COC-003 - Diretrizes para Visitas Institucionais - 30.04.2014- _rev00	IT-COC-003	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
153	IT-COC-004 - Comunicação Interna - 03.03.2015 - _rev01	IT-COC-004	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
154	IT-COM-001 - Cadastro de Cliente Comercial - 10.12.2016 - _rev02	IT-COM-001	docx	1	2018-09-01 02:27:37	2018-09-01 02:27:37
155	IT-COM-002 - Administração de Vendas - 06.12.2016 - _rev01	IT-COM-002	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
156	IT-COM-003 - Captação de Carga - Navios Externos - 20.02.2017 - _rev03	IT-COM-003	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
157	IT-COM-005 - Vendas - 05.06.2018 - _rev01	IT-COM-005	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
158	IT-COM-006 - Captação de Carga Navios Internos - 02.10.2017 - _rev03	IT-COM-006	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
159	IT-COM-007 - Controle de Ocorrência Reclamação de Cliente - 05.06.2018 - _rev05	IT-COM-007	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
160	IT-COM-008 - Pesquisa de Satisfação do Cliente - 26.10.2017 - _rev04	IT-COM-008	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
161	IT-COM-010 -  Novos Negócios - 11.01.2017 - _rev00	IT-COM-010	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
162	IT-COT-001 - Recebimento Fiscal  - 10.08.2015 - _rev02	IT-COT-001	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
163	IT-COT-002 - Obrigações Fiscais - 06.10.2014 - _rev01	IT-COT-002	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
164	IT-COT-003 - Contabilidade - 08.04.2014 - _rev00	IT-COT-003	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
165	IT-COT-004 - Ativo Fixo - 24.11.2015 - _rev03	IT-COT-004	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
166	IT-FIN-001 - Contas a Pagar - 26.06.2018 - _rev04	IT-FIN-001	docx	1	2018-09-01 02:27:38	2018-09-01 02:27:38
167	IT-FIN-002 - Contas a Receber - 31.01.2017 - _rev02	IT-FIN-002	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
168	IT-FIN-003 - Operações Financeiras Cambio - 09.01.2017 - _rev01	IT-FIN-003	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
169	IT-FIN-004 - Crédito - 29.05.2017 - _rev05	IT-FIN-004	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
170	IT-FIN-006 - Faturamento de Cliente com Crédito à vista - 21.06.2016 - _rev04	IT-FIN-006	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
171	IT-FIN-007 - Fechamento Mensal - 21.06.2016 - _rev02	IT-FIN-007	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
172	IT-FIN-008 - Controle de Processos Faturamento - 21.06.2016 - _rev02	IT-FIN-008	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
173	IT-FIN-009 - Provisão para Devedores Duvidosos (PDD) ou  (PCLD) - 18.08.2016 - _rev00	IT-FIN-009	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
174	IT-FIN-010 - Solicitação de desconto e cancelamento de nota fiscal - 21.06.2016 - _rev04	IT-FIN-010	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
175	IT-FIN-011 - Solicitação de desenvolvimento para TI - 21.06.2016 - _rev02	IT-FIN-011	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
176	IT-FIN-012 - Acesso ao Usuário -  Módulo Billing - 01.09.2016 - _rev00	IT-FIN-012	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
177	IT-FIN-013 - Procedimentos de Compliance - 09.01.2017 - _rev00	IT-FIN-013	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
178	IT-JUR-001 - Contratos - 20.08.2014 - _rev01	IT-JUR-001	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
179	IT-JUR-002 - Manual de Contratos - 20.08.2014 - _rev01	IT-JUR-002	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
180	IT-JUR-003 - Arquivo e Controle de Documentos - 19.08.2014 - _rev00	IT-JUR-003	docx	1	2018-09-01 02:27:39	2018-09-01 02:27:39
181	IT-JUR-004 - Proposta de Deliberação - 19.08.2014 - _rev00	IT-JUR-004	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
182	IT-JUR-005 - Procurações - 19.08.2014 - _rev00	IT-JUR-005	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
183	IT-JUR-006 - Sistema Projuris - 27.03.2017 - _rev00	IT-JUR-006	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
184	IT-MAN-001 Acesso e Manobra na Subestação - 07.08.2013 - _rev00	IT-MAN-001	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
185	IT-MAN-002- Bloqueio de Equipamentos Móveis - 13.02.2013 - _rev00	IT-MAN-002-	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
186	IT-MAN-003 - Calibração de Equipamentos de Medição - 21.05.2018 - _rev04	IT-MAN-003	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
187	IT-MAN-004 Carga de Bateria - 09.01.2013 -  _rev00	IT-MAN-004	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
188	IT-MAN-005 Disposiçãp e descarte de pneus -10.12.2013 - _rev00	IT-MAN-005	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
189	IT-MAN-006 - Acesso ao QC e RTG - 17.04.2017 - _rev01	IT-MAN-006	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
190	IT-MAN-007 - Diretrizes para Solicitação de Compra de Materiais e Serviço - 24.08.2017 - _rev00	IT-MAN-007	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
191	IT-MAN-008 - Acesso ao Almoxarifado 16.04.2015 - _rev00	IT-MAN-008	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
192	IT-MAN-009 - Inspeção de Cabos de Aço do QC e RTG - 19.09.2016 - _rev02	IT-MAN-009	docx	1	2018-09-01 02:27:40	2018-09-01 02:27:40
193	IT-MAN-010 -  Isolamento de área - 14.07.2017 - _rev01	IT-MAN-010	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
194	IT-MAN-011 - Manutenção da Oficina - 13.11.2012 - _rev00	IT-MAN-011	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
195	IT-MAN-012 - Manutenção de Compressores de ar - 12.11.2012 - _rev00	IT-MAN-012	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
196	IT-MAN-013 - Substituição de Spreaders - 21.08.2016 - _rev01	IT-MAN-013	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
197	IT-MAN-014 - Abastecimento do Posto de Combustivel - 08.05.2015 - _rev01	IT-MAN-014	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
198	IT-MAN-015 - Análise de Falha - 12.11.2012 - _rev00	IT-MAN-015	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
199	IT-MAN-016 - Teste de carga e certificação de RTGs e QCs - 12.11.2012 - _rev00	IT-MAN-016	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
200	IT-MAN-017 - Abastecimento dos Geradores - 09.12.2013 - _rev00	IT-MAN-017	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
201	IT-MAN-018 - Substituição e Calibração de Pneus - 26.10.2017 -_rev02	IT-MAN-018	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
202	IT-MAN-019 - Uso da ponte rolante na oficina - 12.11.2012 - _rev00	IT-MAN-019	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
203	IT-MAN-020 - Uso de ar comprimido na oficina - 12.11.2012 - _rev00	IT-MAN-020	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
204	IT-MAN-021 - Utilização da lavadora a jato - 12.11.2012 - _rev00	IT-MAN-021	docx	1	2018-09-01 02:27:41	2018-09-01 02:27:41
205	IT-MAN-022 - Veículos em manutenção na área da oficina - 12.11.2012 - _rev00	IT-MAN-022	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
206	IT-MAN-023 - Remoção de Bloqueio Pessoal - 19.12.2013 - _rev00	IT-MAN-023	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
207	IT-MAN-024 - Operação da Carreta de Combate a Incêndio - 18.12.2013 - _rev00	IT-MAN-024	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
208	IT-MAN-025 - Energização e Transferência de Linha na SEP-138KV - 18.12.2013 - _rev00	IT-MAN-025	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
209	IT-MAN-026 - Diretrizes do Almoxarifado - 24.04.2017 - _rev05	IT-MAN-026	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
210	IT-MAN-027 - Abastecimento Empilhadeira a Gás - 09.07.2014 - _rev00	IT-MAN-027	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
211	IT-MAN-028 - Abastecimento RTG - 16.06.2014 - _rev00	IT-MAN-028	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
212	IT-MAN-029 - Abastecimento de Veículos no Posto de Combustível - 03.05.2016 - _rev01	IT-MAN-029	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
213	IT-MAN-030 -  Manutenção Corretiva da Pavimentação - Intertravados - 19.11.2014 - _rev00	IT-MAN-030	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
214	IT-MAN-031 - Manutenção do RTG na Área - 07.08.2015 - _rev00	IT-MAN-031	docx	1	2018-09-01 02:27:42	2018-09-01 02:27:42
215	IT-MAN-032 - Isolamento de área para realizar a manutenção dos QCs- 07.08.2015 - _rev00	IT-MAN-032	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
216	IT-MAN-033 - Critérios Para Abertura e Fechamento de Ordens de Serviço - 30.10.2015 - _rev00	IT-MAN-033	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
217	IT-MAN-034 - Oscilação de Energia Externa CPFL - 16.05.2016 - _rev00	IT-MAN-034	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
218	IT-MAN-035 -  Padrão para Escavações - 05.09.2016 - _rev00	IT-MAN-035	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
219	IT-MAN-036 - Gestão de Transporte Maritimo - 22.11.2017 - _rev00	IT-MAN-036	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
220	IT-MAN-037 - Gestão do Transporte Rodoviário - 11.06.2018 - _rev01	IT-MAN-037	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
221	IT-MAN-038 - Utilização da Máquina Varredeira - 07.05.2018 - _rev01	IT-MAN-038	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
222	IT-MAN-039 - Procedimento de Bloqueio Lock-Out and Tag-Out (LoTo) - 07.03.2018 - _rev00	IT-MAN-039	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
223	IT-MAN-040 - Gestão dos serviços de limpeza e desinfecção - 23.03.2018 - _rev02	IT-MAN-040	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
224	IT-MAN-041 - Solicitação e Aprovação de Projetos de Melhoria e Reforma - 04.04.2018 - _rev00	IT-MAN-041	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
225	IT-OPE-001 - Atracação e Desatracação de Navio - 20.05.2017 - _rev04	IT-OPE-001	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
226	IT-OPE-002 - Descarga e Embarque de Cargas Especiais - 09.06.2014 - _rev 01	IT-OPE-002	docx	1	2018-09-01 02:27:43	2018-09-01 02:27:43
227	IT-OPE-003 - Gerenciamento do Contrato da Empresa Raggi-x- 20.09.2014 - _rev00	IT-OPE-003	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
228	IT-OPE-004 - Fixação e Retirada de Castanhas - 06.06.2014 - _rev01	IT-OPE-004	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
229	IT-OPE-005 - Peação e Despeação de Contêineres - 04.04.2017 - _rev03	IT-OPE-005	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
230	IT-OPE-006 - Trabalho em Altura em Operações Portuárias - 12.06.2015 - _rev02	IT-OPE-006	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
231	IT-OPE-007 - Monitoramento de Operações - 05.07.2018 - _rev02	IT-OPE-007	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
232	IT-OPE-008 - Operação de Guindaste de Pórtico no Cais - Quay Crane - 27.10.2017 - _rev07	IT-OPE-008	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
233	IT-OPE-009 - Operação de Empilhadeira de Grande Porte - 12.06.2015 - _rev02	IT-OPE-009	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
234	IT-OPE-010 - Operação de RTG  - Rubber Tyred Gantry - 12.06.2015 - _rev03	IT-OPE-010	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
235	IT-OPE-011 - Operação de Empilhadeira de Pequeno Porte - 18.06.2018 - _rev03	IT-OPE-011	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
236	IT-OPE-012 - Operação de Veículo de Transferência Interna - ITV - 03.07.2017 - _rev07	IT-OPE-012	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
237	IT-OPE-013 - Conferência de Contêiner - Operação Navios - 09.12.2016 - _rev04	IT-OPE-013	docx	1	2018-09-01 02:27:44	2018-09-01 02:27:44
238	IT-OPE-014 - Plano de Contigência Parada no Sistema - 24.07.2018 - _rev02	IT-OPE-014	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
239	IT-OPE-015 - Planejamento de Operação de Pátio - 08.06.2018 - _rev04	IT-OPE-015	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
240	IT-OPE-016 - Pré - Operação de Pátio e Navio - 10.04.2015 - _rev02	IT-OPE-016	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
241	IT-OPE-017 - Planejamento de Operação de Navio - 24.07.2018 - _rev05	IT-OPE-017	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
242	IT-OPE-018 - Pós - Operação de Pátio e Navio- 14.08.2014 - _rev00	IT-OPE-018	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
243	IT-OPE-019 - Operações e Monitoramento de Contêineres Reefer - 16.12.2016 - _rev03	IT-OPE-019	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
244	IT-OPE-020 - Trabalho no Pinning Station - Operação Navios - 27.03.2018- _rev02	IT-OPE-020	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
245	IT-OPE-021- Operação Ferroviária - 08.11.2016 - _rev01	IT-OPE-021-	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
246	IT-OPE-022 - Recepção e Entrega de Gen Set - 14.05.2018 - _rev04	IT-OPE-022	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
247	IT-OPE-023 - Cadastro de Biometria - Operação de Gate - 03 05 2018 - _rev04	IT-OPE-023	docx	1	2018-09-01 02:27:45	2018-09-01 02:27:45
248	IT-OPE-024 - Troca de Quadra (RTG) - 06.03.2018 - _rev05	IT-OPE-024	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
249	IT-OPE-025 - Entrada e Saída de Carga - Operação de Gate - 14.05.2018 - _rev12	IT-OPE-025	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
250	IT-OPE-026 - Vistoria de Contêineres - Operação de Navio - 20.06.2017 - _rev03	IT-OPE-026	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
251	IT-OPE-027 - Vistoria no Recebimento e Entrega de contêineres - Operação de Gate  - 14.05.2018 - _rev09	IT-OPE-027	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
252	IT-OPE-028 - Operação De Armazenamento De Trilhos No Pátio - 22.01.2018 - _rev01	IT-OPE-028	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
253	IT-OPE-029 - Entrega de trilhos - 17.05.2016 - _rev01	IT-OPE-029	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
254	IT-OPE-030 - Operação de Descarga de Trilhos - 22.01.2018 - _rev01	IT-OPE-030	docx	1	2018-09-01 02:27:46	2018-09-01 02:27:46
255	IT-OPE-031 - Armazenamento de Vagões no pátio - 31.08.2015 - _rev00	IT-OPE-031	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
256	IT-OPE-032 - Inspeção de Materiais de Movimentação de Cargas - 09.04.2018 - _rev05	IT-OPE-032	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
257	IT-OPE-033 - Operações DDC no Cross Docking - 05.06.2018 - _rev02	IT-OPE-033	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
258	IT-OPE-034 - Carga e Descarga de Tanktainer sem Longarina - 26.10.2016 - _rev01	IT-OPE-034	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
259	IT-OPE-035 - Estufagem CrossDocking - Sistema WMS - 05.07.2018 - _rev02	IT-OPE-035	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
260	IT-OPE-036 - Pesagem Contêiner Cheio - Cross Docking - 14.05.2018 - _rev01	IT-OPE-036	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
261	IT-OPE-037 - Procedimento de Estufagem de Fardo Cross Docking - 14.05.2018 - _rev02	IT-OPE-037	docx	1	2018-09-01 02:27:47	2018-09-01 02:27:47
262	IT-OPE-038 - Procedimento de Estufagem de Big Bag Cross Docking - 14.05.2018 - _rev03	IT-OPE-038	docx	1	2018-09-01 02:27:48	2018-09-01 02:27:48
263	IT-OPE-039 - Entrega de vagões de trem - metrô (Via Quatro) - 23.06.2016 - _rev00	IT-OPE-039	docx	1	2018-09-01 02:27:48	2018-09-01 02:27:48
264	IT-OPE-040 - Entrega de vagões de trem-metrô - CPTM - 23 06 2016 - _rev00	IT-OPE-040	docx	1	2018-09-01 02:27:48	2018-09-01 02:27:48
265	IT-OPE-041 - Retirada de Contêineres no Depot - 25.07.2016 - _rev00	IT-OPE-041	docx	1	2018-09-01 02:27:48	2018-09-01 02:27:48
266	IT-OPE-042 - Recebimento de Contêineres no Depot - 25.08.2016 - _rev01	IT-OPE-042	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
267	IT-OPE-043 - Procedimentos de DTA Ferrovia - 19.08.2016 - _rev00	IT-OPE-043	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
268	IT-OPE-044 - Gerenciamento de Cargas Perigosas - 04.06.2018 - _rev02	IT-OPE-044	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
269	IT-OPE-045 - Empilhamento de Contêineres no Depot - 05.09.2016 - _rev00	IT-OPE-045	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
270	IT-OPE-047 - Controle de Lacres no Depot - 21.11.2016 - _rev00	IT-OPE-047	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
271	IT-OPE-048 - Mobilização e desmobilização da oficina - 21.11.2016 - _rev00	IT-OPE-048	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
272	IT-OPE-049 - Procedimento para criação do EDO - 01.12.2016 - _rev00	IT-OPE-049	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
273	IT-OPE-050 - Cadastro de Booking - 18.01.2017- _rev00	IT-OPE-050	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
274	IT-OPE-051 - Cadastro de Navio - 18.01.2017 - _rev00	IT-OPE-051	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
275	IT-OPE-052 - Fechamento de Exportação - 18.01.2017 - _rev00	IT-OPE-052	docx	1	2018-09-01 02:27:49	2018-09-01 02:27:49
276	IT-OPE-053 - Presença de Carga Exportação - 18.01.2017 - _rev00	IT-OPE-053	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
277	IT-OPE-054 - Recepção e Processamento de Documentos de Exportação - 18.01.2017 - _rev00	IT-OPE-054	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
278	IT-OPE-055 - Cadastro de Contêineres Vazios para Embarque - 18.01.2017- _rev00	IT-OPE-055	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
279	IT-OPE-056 - Fechamento de Importação - 18.01.2017 - _rev00	IT-OPE-056	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
280	IT-OPE-057 - Conferência e Vistoria de Carga - Armazém -  24.05.2017 - _rev01	IT-OPE-057	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
281	IT-OPE-058 - Cargas Retidas e Abandonadas - 22.12.2016 - _rev00	IT-OPE-058	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
282	IT-OPE-059 - Operação de Guindaste de Navio no Cais - Vessel Crane - 03.05.2017 - _rev00	IT-OPE-059	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
283	IT-OPE-060 - Desunitização para Armazém - 09.05.2017 - _rev01	IT-OPE-060	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
284	IT-OPE-061 - Vistoria, reparo e lavagem de contêineres no Depot - 12.12.2016 - _rev00	IT-OPE-061	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
285	IT-OPE-062 - Operação de Entrega de bobinas de aço - 31.05.2017 - _rev00	IT-OPE-062	docx	1	2018-09-01 02:27:50	2018-09-01 02:27:50
286	IT-OPE-063 - Procedimento de estufagem de maquinário em flat rack - 10.07.2017 - _rev00	IT-OPE-063	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
287	IT-OPE-064 - Dissociação MAPA - 09.08.2017 - _rev00	IT-OPE-064	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
288	IT-OPE-065 - Tratamento de Avarias  - 19.02.2018 - _rev01	IT-OPE-065	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
289	IT-OPE-066 - Operação de Celulose - 03.04.2018 - _rev01	IT-OPE-066	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
290	IT-OPE-067 - Celulose Safety Procedures - 19.03.2018 - _rev00	IT-OPE-067	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
291	IT-OPE-068 - Posicionamento de Container na Área do Armazém Alfandegado- 21.05.2018 - _rev00	IT-OPE-068	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
292	IT-PeO-001 - Solicitação de Treinamento - 21.06.2018 - _rev01	IT-PeO-001	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
293	IT-PeO-002 - Avaliação Eficacia de Treinamento- 01 08 2014 - _rev00	IT-PeO-002	docx	1	2018-09-01 02:27:51	2018-09-01 02:27:51
294	IT-PeO-003 - Solicitação de Trabalhador Portuário Avulso - 15.07.2014 - _rev00	IT-PeO-003	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
295	IT-PeO-004 - Férias - 01.08.2014 - _rev00	IT-PeO-004	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
296	IT-PeO-005 - Registro de Ponto Eletronico- 01.08.2014 - _rev00	IT-PeO-005	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
297	IT-PeO-006- Centro de Condicionamento Físico - 26.09.2014 - _rev00	IT-PeO-006-	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
298	IT-PeO-007 - Programa de Estágio - 14.03.2016 - _rev01	IT-PeO-007	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
299	IT-PeO-008 - Subsídio para curso de Inglês - 21.06.2018 - _rev01	IT-PeO-008	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
300	IT-PeO-009 - Controle de Entrega de Certidão Negativa DETRAN - Operadores - 30.10.2015 - _rev00	IT-PeO-009	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
301	IT-PeO-010 - Programa Jovem Aprendiz - 14.03.2016 - _rev00	IT-PeO-010	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
302	IT-PeO-011 - Ações disciplinares - critérios e aprovações - 04.04.2017 - _rev00	IT-PeO-011	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
303	IT-PeO-012 - Ciclo de Conversa - 05.04.2017 - _rev00	IT-PeO-012	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
304	IT-QUA-001 - Padronização de Documentos  - 13.07.2017 - _rev04	IT-QUA-001	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
305	IT-QUA-002 - Identificação e Controle de Requisitos Aplicáveis - 29.06.2018 - _rev04	IT-QUA-002	docx	1	2018-09-01 02:27:52	2018-09-01 02:27:52
306	IT-QUA-003 - Controle de Registros  - 26.11.2014 - _rev02	IT-QUA-003	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
307	IT-QUA-004 - Monitoramento da Qualidade da Água distribuída no Terminal - 27.03.2018 - _rev04	IT-QUA-004	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
308	IT-QUA-005 - Inspeção Física e de Produtos Sob Vigilância Sanitária - 15.05.2018 - _rev02	IT-QUA-005	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
309	IT-QUA-006 - Monitoramento de Temperatura e Umidade do Armazém - 10.05.2018 - _rev01	IT-QUA-006	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
310	IT-QUA-007 - Manejo de Fauna Sinantrópica - 10.05.2018 - _rev03	IT-QUA-007	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
311	IT-QUA-008 - Objetivos e Metas - 07.07.2017 - _rev02	IT-QUA-008	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
312	IT-QUA-009 - Tratamento de Não Conformidades - 10.05.2018 - _rev02	IT-QUA-009	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
313	IT-QUA-010 - Execução de Auditorias - 18.07.2016 - _rev10	IT-QUA-010	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
314	IT-QUA-011 - Mapeamento e Estudo de Riscos do Negócio - 04.05.2018 - _rev00	IT-QUA-011	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
315	IT-SEP-001 - Gestão de Riscos de Segurança da Cadeia Logística - 14.06.2018 - _rev09	IT-SEP-001	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
316	IT-SEP-002 - Controle de Acesso de Pessoas e Veículos Leves - 21.05.2018 - _rev20	IT-SEP-002	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
317	IT-SEP-003 - Central de Controle e Operações de Segurança - 02.01.2018 - _rev07	IT-SEP-003	docx	1	2018-09-01 02:27:53	2018-09-01 02:27:53
318	IT-SEP-004 - Gestão de Ocorrências - 02.01.2018 - _rev10	IT-SEP-004	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
319	IT-SEP-005 - Utilização do Scanner e Portal Detector de Metais nas Portarias da Área Alfandegada - 26.03.2018 - _rev01	IT-SEP-005	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
320	IT-SEP-006 - Gestão de Lacres - 24.10.2017 - _rev07	IT-SEP-006	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
321	IT-SEP-007 - Manutenção do Plano ISPS - 02.01.2018 - _rev02	IT-SEP-007	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
322	IT-SEP-008 - Gerenciamento do Contrato da Empresa de Vigilância - 02.01.2018 - _rev07	IT-SEP-008	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
323	IT-SEP-009 - Exercícios e Simulados de Segurança - 05.06.2018 - _rev04	IT-SEP-009	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
324	IT-SEP-010 - Achados e Perdidos 05.06.2018 - _rev03	IT-SEP-010	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
325	IT-SEP-011 - Plano de Backup dos Sistemas de Segurança Patrimonial - 06.06.2018 - _rev02	IT-SEP-011	docx	1	2018-09-01 02:27:54	2018-09-01 02:27:54
326	IT-SEP-012 - Rondas - 08.12.2017 - _rev11	IT-SEP-012	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
327	IT-SEP-013 - Segurança Eletrônica - 29.05.2018 - _rev02	IT-SEP-013	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
328	IT-SEP-014 - Proteção e Segurança de Carga - 29.05.2018 - _rev08	IT-SEP-014	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
329	IT-SEP-015 - Apuração e Investigação - 16.08.2017 - _rev01	IT-SEP-015	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
330	IT-SEP-017 - Prevenção de Perdas -15.01.2018 - _rev 02	IT-SEP-017	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
331	IT-SET-001- Distribuição e Controle de Equipamentos de Proteção Individual - 05-06-2018 - _rev04	IT-SET-001-	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
332	IT-SET-002 - Investigação de Incidentes e Acidentes - 18.05.2018 - _rev03	IT-SET-002	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
333	IT-SET-003 - Inspeções de Segurança - 26.06.2018 - _rev05	IT-SET-003	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
334	IT-SET-004 - Permissões de Trabalho - 17.12.2015 - _rev02	IT-SET-004	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
335	IT-SET-005 - Trabalho em Altura  - 23.05.2018 - _rev04	IT-SET-005	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
336	IT-SET-006 - Trabalho em Espaços Confinados  - 26.12.2017 - _rev03	IT-SET-006	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
337	IT-SET-007 -Trabalho em Máquinas e Equipamentos - 31.08.2017 - _rev01	IT-SET-007	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
338	IT-SET-008 - Informações de Segurança sobre Produtos Perigosos - 25.09.2017 - _rev01	IT-SET-008	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
339	IT-SET-009 - Controle de Energias Perigosas  - 08.11.2017 - _rev02	IT-SET-009	docx	1	2018-09-01 02:27:55	2018-09-01 02:27:55
340	IT-SET-010 - Identificação e Controle de Perigos e Riscos Ocupacionais - 09.11.2017 - _rev03	IT-SET-010	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
341	IT-SET-011 - Segurança em operação de navios - 25.09.2017 - _rev02	IT-SET-011	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
342	IT-SET-012 - Trabalhos Administrativos em Segurança do Trabalho - 11.10.2017 - _rev02	IT-SET-012	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
343	IT-SET-013 - Armazenamento e Abastecimento de Combustíveis - 03.07.2014 - _rev00	IT-SET-013	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
344	IT-SET-014 - Inspeção e Manuseio de Extintores e Mangueiras - 02.04.2018 - _rev01	IT-SET-014	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
345	IT-SET-015 - Análise Prevencionista da Tarefa - 29.07.2014 - _rev00	IT-SET-015	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
346	IT-SET-016 - Segurança para Motoristas Externos - 14.05.2018 - _rev05	IT-SET-016	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
347	IT-SET-017- Condições Climáticas Desfavoráveis - 05.03.2018 - _rev04	IT-SET-017-	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
348	IT-SET-018 - Segurança Em Atividades Com O Uso De Linha De Vida Móvel - 29.03.2018 - _rev02	IT-SET-018	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
349	IT-SET-019 - Controle de Acesso aos Equipamentos  - 31.08.2017 - _rev01	IT-SET-019	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
350	IT-SET-020 - Utilização de Equipamentos de Comunicação - 02.08.2017 - _rev01	IT-SET-020	docx	1	2018-09-01 02:27:56	2018-09-01 02:27:56
351	IT-SET-021 - Trabalho a Quente - 28.02.2018 - _rev00	IT-SET-021	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
352	IT-SOC-001 Gerenciamento de Exames Ocupacionais - 07.05.2018 - _rev02	IT-SOC-001	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
353	IT-SOC-002 - Administração de Medicamentos - 07.05.2018 - _rev01	IT-SOC-002	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
354	IT-SOC-004 - Controle de Validade e Estoque de Medicamentos - 11.06.2014 - _rev00	IT-SOC-004	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
355	IT-SOC-005 - Entrega de atestado Médico - 07.05.2018 - _rev01	IT-SOC-005	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
356	IT-SOC-006 - Controle de Absenteísmo - 11.06.2014 - _rev00	IT-SOC-006	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
357	IT-SOC-007 - Monitoramento de Saúde Individual e Coletiva - 04.05.2018 - _rev01	IT-SOC-007	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
358	IT-SOC-008 - Acompanhamento de Benefícios Previdenciários - _rev00	IT-SOC-008	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
359	IT-SOC-009 - Programa de Proteção Auditiva - 03.05.2018 - _rev02	IT-SOC-009	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
360	IT-SOC-010 - Comunicação de Acidente de Trajeto - 02.05.2018 - _rev01	IT-SOC-010	docx	1	2018-09-01 02:27:57	2018-09-01 02:27:57
361	IT-SOC-011 - Plano de Prevenção de Riscos de Acidentes com Agentes Biológicos e Materiais - 01.07.2014 - _rev00	IT-SOC-011	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
362	IT-SOC-012 - Plano de Ação Médica - 12.06.2018 - _rev01	IT-SOC-012	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
363	IT-SOC-013 - Limpeza do Ambulatório de Saúde Ocupacional - 15.07.2014 - _rev00	IT-SOC-013	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
364	IT-SOC-014 - Avaliação Clínica da Brigada de Emergência - 16.07.2014 - _rev00	IT-SOC-014	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
365	IT-SOC-015 - Inserção de Pessoas com Deficiência e Mobilidade Reduzida - PIPDMR - 12.06.2018 - _rev01	IT-SOC-015	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
366	IT-SOC-017 - Procedimento Médico para trabalho em altura e espaço confinado - 04.05.2018 - _rev02	IT-SOC-017	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
367	IT-SOC-018 - Plano de Atividades Operacionais do Serviço de Saúde - 16.07.2014- _rev00	IT-SOC-018	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
368	IT-SOC-019 - Diretrizes de Saúde Ocupacional para Prestadores de Serviço - 18.09.2014- _rev00	IT-SOC-019	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
369	IT-SOC-020 - Gerenciamento de Afastados Previdenciários - 13.10.2014 - _rev00	IT-SOC-020	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
370	IT-SOC-021 - Restrição e Reabilitação ao Trabalho - 02.03.2015 - _rev00	IT-SOC-021	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
371	IT-SOC-023 - Programa Àlcool e Drogas - 17.12.2015 - _rev00	IT-SOC-023	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
372	IT-SOC-024 - Preenchimento ASO - 07.05.2018 - _rev01	IT-SOC-024	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
373	IT-TEC-001 - Plantão TI - 02.01.2017 - _rev01	IT-TEC-001	docx	1	2018-09-01 02:27:58	2018-09-01 02:27:58
374	IT-TEC-002 - Gerenciamento de mudanças - 21.11.2016 - _rev00	IT-TEC-002	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
375	IT-TEC-004 - Chamadas Técnicas - Service Desk - 08.06.2016 - _rev03	IT-TEC-004	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
376	IT-TEC-005 - Atualização Sistema Navis (N4, Billing e XPS) - 09.05.2016 - _rev00	IT-TEC-005	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
377	IT-TEC-008 - Backup e Testes de Recuperação e Movimentação de Fitas- 28.03.2016 - _rev07	IT-TEC-008	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
378	IT-TEC-009 - Criação de Emails Corporativos - 11.05.2016 - _rev04	IT-TEC-009	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
379	IT-TEC-012- Controle de Internet Corporativa - 10.07.2017 - _rev04	IT-TEC-012-	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
380	IT-TEC-015 - Procedimentos do DBA para Servidores de Bancos de Dados - 25.02.2015 - _rev02	IT-TEC-015	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
381	IT-TEC-017 - Procedimento de EDI - 07.11.2016 - _rev03	IT-TEC-017	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
382	IT-TEC-019 - Suporte e Atualização do ORACLE-EBS - 04.07.2017 - _rev04	IT-TEC-019	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
383	IT-TEC-022 - Manutenção Preventiva em Ar Condicionado e UPS dos Data Center - 05.03.2015 - _rev01	IT-TEC-022	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
384	IT-TEC-024 - Checklist para Data Center e Sala de UPS- 25.02.2015 - _rev01	IT-TEC-024	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
385	IT-TEC-026 - Monitoramento do Antivirus Corporativo - 13.07.2017 - _rev03	IT-TEC-026	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
386	IT-TEC-040 - Descritivo de Infraestrutura e Segurança de TI - 13.11.2017 - _rev09	IT-TEC-040	docx	1	2018-09-01 02:27:59	2018-09-01 02:27:59
387	IT-TEC-041 - Objetivos RPO e RTO - 25.02.2015 - _rev01	IT-TEC-041	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
388	IT-TEC-043- Gestores de Aplicação - 13.07.2017 - _rev03	IT-TEC-043-	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
389	IT-TEC-044 - Processo de Mudança de Sistemas - 02.01.2017 - _rev01	IT-TEC-044	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
390	IT-TEC-045 - Controle de acessos, equipamentos de informática e telefonia - 23.04.2017 - _rev02	IT-TEC-045	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
391	IT-TRP-001- Retirada de Carga em Terminais Externos - 22.06.2017 - _rev01	IT-TRP-001-	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
392	IT-TRP-002 - Operação Vistoria em Terminais Externos - 18.06.2018 - _rev02	IT-TRP-002	docx	1	2018-09-01 02:28:00	2018-09-01 02:28:00
\.


--
-- Data for Name: documento_formulario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documento_formulario (id, documento_id, formulario_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: documento_formulario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documento_formulario_id_seq', 36, true);


--
-- Name: documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documento_id_seq', 392, true);


--
-- Data for Name: documento_observacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documento_observacao (id, observacao, nome_usuario_responsavel, documento_id, usuario_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: documento_observacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documento_observacao_id_seq', 14, true);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Data for Name: formulario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.formulario (id, nome, codigo, extensao, conteudo, nivel_acesso, finalizado, tipo_documento_id, elaborador_id, setor_id, grupo_divulgacao_id, created_at, updated_at, revisao, em_revisao, id_usuario_solicitante, nome_completo_finalizado, nome_completo_em_revisao, justificativa_cancelar_revisao, obsoleto) FROM stdin;
50	Relatório de Provisão	FR-FIN-011	xlsx	\N	Livre	f	4	916	9	3	2018-08-28 10:48:39	2018-08-28 10:48:39	00	f	\N	\N	\N	\N	f
5	Check List Documentação Legal - Autônomo	FR-CDI-001	xls	\N	Livre	f	4	962	4	3	2018-08-27 13:30:36	2018-08-27 13:30:36	00	f	\N	\N	\N	\N	f
6	Check List - Documentação Legal - Consultoria	FR-CDI-002	xlsx	\N	Livre	f	4	962	4	3	2018-08-27 13:31:47	2018-08-27 13:31:47	00	f	\N	\N	\N	\N	f
7	Check List Documentação LegaL - Estrangeiro	FR-CDI-003	xlsx	\N	Restrito	f	4	916	4	3	2018-08-27 13:40:53	2018-08-27 13:40:53	00	f	\N	\N	\N	\N	f
8	Check List Documentação Legal - Fornecimento	FR-CDI-004	xlsx	\N	Restrito	f	4	916	4	3	2018-08-27 13:45:13	2018-08-27 13:45:13	00	f	\N	\N	\N	\N	f
9	Check List Documentação Legal - Proposta 15 D	FR-CDI-005	xlsx	\N	Restrito	f	4	916	4	3	2018-08-27 13:47:32	2018-08-27 13:47:32	00	f	\N	\N	\N	\N	f
10	Check List Documentação Legal - MDO	FR-CDI-006	xlsx	\N	Restrito	f	4	916	4	3	2018-08-28 09:11:18	2018-08-28 09:11:18	00	f	\N	\N	\N	\N	f
11	Liberação para Trabalho - Exigências	FR-CDI-007	xlsx	\N	Restrito	f	4	916	4	3	2018-08-28 09:12:15	2018-08-28 09:12:15	00	f	\N	\N	\N	\N	f
12	Documentação Mensal - Exigências	FR-CDI-008	xlsx	\N	Restrito	f	4	916	4	3	2018-08-28 09:12:51	2018-08-28 09:12:51	00	f	\N	\N	\N	\N	f
13	Protocolo	FR-CDI-012	xlsx	\N	Livre	f	4	916	4	3	2018-08-28 09:31:24	2018-08-28 09:31:24	00	f	\N	\N	\N	\N	f
14	Check List Documentação Legal - Serviços de execução imediata até 07 dias	FR-CDI-014	xlsx	\N	Restrito	f	4	916	4	3	2018-08-28 09:41:51	2018-08-28 09:41:51	00	f	\N	\N	\N	\N	f
15	Declaração de Veracidade - Integrante	FR-CDI-015	docx	\N	Restrito	f	4	916	4	3	2018-08-28 09:43:34	2018-08-28 09:43:34	00	f	\N	\N	\N	\N	f
16	Declaração de Veracidade - Pessoa Jurídica	FR-CDI-016	docx	\N	Restrito	f	4	916	4	3	2018-08-28 09:44:45	2018-08-28 09:44:45	00	f	\N	\N	\N	\N	f
17	Consolidado da Pesquisa de Satisfação do Cliente	FR-COM-002	xlsx	\N	Restrito	f	4	916	6	3	2018-08-28 09:46:18	2018-08-28 09:46:18	00	f	\N	\N	\N	\N	f
18	Ficha de Cadastro e Qualificação de Fornecedor\tFicha Cadastral Fornecedor	FR-CMP-002	xlsx	\N	Livre	f	4	916	5	3	2018-08-28 10:10:13	2018-08-28 10:10:13	00	f	\N	\N	\N	\N	f
19	Monitoramento de Fornecedores	FR-CMP-003	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:11:00	2018-08-28 10:11:00	00	f	\N	\N	\N	\N	f
20	Controle Processos de Compras	FR-CMP-004	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:12:18	2018-08-28 10:12:18	00	f	\N	\N	\N	\N	f
21	Controle Diário de Refeições Fornecidas aos Integrantes DP World Santos	FR-CMP-005	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:14:37	2018-08-28 10:14:37	00	f	\N	\N	\N	\N	f
22	Controle Planos de ação	FR-CMP-006	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:15:09	2018-08-28 10:15:09	00	f	\N	\N	\N	\N	f
23	Controle de Fornecedores Homologados, Suspensos e Inativos	FR-CMP-007	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:15:53	2018-08-28 10:15:53	00	f	\N	\N	\N	\N	f
24	Advertência Prestador de Serviço	FR-CMP-008	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:17:13	2018-08-28 10:17:13	00	f	\N	\N	\N	\N	f
25	Avaliação Performance de Entrega	FR-CMP-014	xlsx	\N	Restrito	f	4	916	5	3	2018-08-28 10:19:56	2018-08-28 10:19:56	00	f	\N	\N	\N	\N	f
26	Solicitação de Cadastro de Item	FR-CMP-015	xlsx	\N	Livre	f	4	916	5	3	2018-08-28 10:20:24	2018-08-28 10:20:24	00	f	\N	\N	\N	\N	f
27	Supplier Registration & Qualification Form	FR-CMP-016	xlsx	\N	Livre	f	4	916	5	3	2018-08-28 10:21:50	2018-08-28 10:21:50	00	f	\N	\N	\N	\N	f
28	Pesquisa  - Programa de Visita	FR-COC-004	docx	\N	Restrito	f	4	916	7	3	2018-08-28 10:23:06	2018-08-28 10:23:06	00	f	\N	\N	\N	\N	f
29	Levantamento de Noticias Publicadas na Imprensa	FR-COC-006	docx	\N	Restrito	f	4	916	7	3	2018-08-28 10:23:43	2018-08-28 10:23:43	00	f	\N	\N	\N	\N	f
30	Controle de Demandas Fale Conosco	FR-COC-007	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:24:44	2018-08-28 10:24:44	00	f	\N	\N	\N	\N	f
31	Solicitação e Regras para Visitas	FR-COC-009	docx	\N	Restrito	f	4	916	7	3	2018-08-28 10:25:17	2018-08-28 10:25:17	00	f	\N	\N	\N	\N	f
32	Solicitação de Visita	FR-COC-011	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:25:44	2018-08-28 10:25:44	00	f	\N	\N	\N	\N	f
33	Mailing Imprensa	FR-COC-014	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:26:21	2018-08-28 10:26:21	00	f	\N	\N	\N	\N	f
34	Relatório de Acompanhamento de Demandas de Imprensa	FR-COC-015	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:27:14	2018-08-28 10:27:14	00	f	\N	\N	\N	\N	f
35	Registro de Reunião - Café com o Presidente	FR-COC-016	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:28:54	2018-08-28 10:28:54	00	f	\N	\N	\N	\N	f
36	Relatório de Horas de Voluntariado	FR-COC-017	xlsx	\N	Restrito	f	4	916	7	3	2018-08-28 10:29:45	2018-08-28 10:29:45	00	f	\N	\N	\N	\N	f
37	Planilha de Cambio - Dados da Invoice	FR-COT-002	xls	\N	Livre	f	4	916	8	3	2018-08-28 10:31:38	2018-08-28 10:31:38	00	f	\N	\N	\N	\N	f
38	Solicitação de Nota Fiscal de Saída	FR-COT-003	xls	\N	Livre	f	4	916	8	3	2018-08-28 10:36:20	2018-08-28 10:36:20	00	f	\N	\N	\N	\N	f
39	Carta de Doação ou Venda	FR-COT-005	doc	\N	Livre	f	4	916	8	3	2018-08-28 10:36:57	2018-08-28 10:36:57	00	f	\N	\N	\N	\N	f
40	Declaração de Não Contribuinte ICMS	FR-COT-006	docx	\N	Restrito	f	4	916	8	3	2018-08-28 10:37:32	2018-08-28 10:37:32	00	f	\N	\N	\N	\N	f
41	Modelo de Declaração de ISS	FR-COT-007	docx	\N	Livre	f	4	916	8	3	2018-08-28 10:38:06	2018-08-28 10:38:06	00	f	\N	\N	\N	\N	f
42	Solicitação de Provisão Mensal	FR-COT-008	xlsx	\N	Livre	f	4	916	8	3	2018-08-28 10:38:42	2018-08-28 10:38:42	00	f	\N	\N	\N	\N	f
43	Movimentação de Ativos	FR-COT-010	xlsx	\N	Livre	f	4	916	8	3	2018-08-28 10:41:08	2018-08-28 10:41:08	00	f	\N	\N	\N	\N	f
44	Controle de Projetos	FR-COT-011	xlsx	\N	Livre	f	4	916	8	3	2018-08-28 10:41:41	2018-08-28 10:41:41	00	f	\N	\N	\N	\N	f
45	Solicitação de Pagamentos - Taxas e Despesas compulsórias	FR-FIN-001	xlsx	\N	Livre	f	4	916	9	3	2018-08-28 10:43:31	2018-08-28 10:43:31	00	f	\N	\N	\N	\N	f
46	Formulário de Extravio de Comprovante de Despesa	FR-FIN-002	xls	\N	Livre	f	4	916	9	3	2018-08-28 10:44:43	2018-08-28 10:44:43	00	f	\N	\N	\N	\N	f
47	Solicitação de Restituição à Cliente	FR-FIN-003	xlsx	\N	Livre	f	4	916	9	3	2018-08-28 10:45:08	2018-08-28 10:45:08	00	f	\N	\N	\N	\N	f
48	Fechamento Mensal	FR-FIN-008	xlsx	\N	Livre	f	4	916	9	3	2018-08-28 10:45:35	2018-08-28 10:45:35	00	f	\N	\N	\N	\N	f
49	Relatório Fiscal	FR-FIN-010	xlsx	\N	Livre	f	4	916	9	3	2018-08-28 10:48:03	2018-08-28 10:48:03	00	f	\N	\N	\N	\N	f
51	Arquivo Eletronico	FR-JUR-001	doc	\N	Restrito	f	4	916	10	3	2018-08-28 11:04:47	2018-08-28 11:04:47	00	f	\N	\N	\N	\N	f
52	Controle de Vencimentos de Certidoes - Juridico	FR-JUR-002	xls	\N	Restrito	f	4	916	10	3	2018-08-28 11:19:02	2018-08-28 11:19:02	00	f	\N	\N	\N	\N	f
53	Controle Contencioso Trabalhista	FR-JUR-003	xlsx	\N	Restrito	f	4	916	10	3	2018-08-28 11:20:10	2018-08-28 11:20:10	00	f	\N	\N	\N	\N	f
54	Controle Geral Contratos	FR-FIN-004	xls	\N	Restrito	f	4	916	9	3	2018-08-28 11:20:44	2018-08-28 11:20:44	00	f	\N	\N	\N	\N	f
55	Registro de Resumo Executivo	FR-JUR-005	xlsx	\N	Restrito	f	4	916	10	3	2018-08-28 11:21:23	2018-08-28 11:21:23	00	f	\N	\N	\N	\N	f
56	Controle de Correspondências	FR-JUR-006	xls	\N	Restrito	f	4	916	10	3	2018-08-28 11:22:53	2018-08-28 11:22:53	00	f	\N	\N	\N	\N	f
57	Registro de Atos Societários	FR-JUR-007	xls	\N	Restrito	f	4	916	10	3	2018-08-28 11:23:24	2018-08-28 11:23:24	00	f	\N	\N	\N	\N	f
58	Controle de Vencimentos de Procurações - DP World Santos	FR-FIN-008	xls	\N	Restrito	f	4	916	9	3	2018-08-28 11:24:49	2018-08-28 11:24:49	00	f	\N	\N	\N	\N	f
59	Solicitação para Elaboração de Procuração	FR-JUR-009	xls	\N	Livre	f	4	916	10	3	2018-08-28 11:25:29	2018-08-28 11:25:29	00	f	\N	\N	\N	\N	f
60	Registro de Atos Societários - Hostens Holding	FR-JUR-011	xlsx	\N	Restrito	f	4	916	10	3	2018-08-28 11:26:01	2018-08-28 11:26:01	00	f	\N	\N	\N	\N	f
61	Registro de Proposta de Deliberação - DP World Santos	FR-JUR-012	xlsx	\N	Restrito	f	4	916	10	3	2018-08-28 11:26:49	2018-08-28 11:26:49	00	f	\N	\N	\N	\N	f
62	Controle de Consumo de Óleo e Água dos Equipamentos	FR-MAN-001	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:28:44	2018-08-28 11:28:44	00	f	\N	\N	\N	\N	f
63	Controle de Óleo e Água dos Equipamentos	FR-MAN-002	pdf	\N	Restrito	f	4	916	11	3	2018-08-28 11:30:24	2018-08-28 11:30:24	00	f	\N	\N	\N	\N	f
64	Controle de Pneus	FR-MAN-003	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:31:44	2018-08-28 11:31:44	00	f	\N	\N	\N	\N	f
65	Ficha de Controle de Pneu	FR-MAN-004	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:34:31	2018-08-28 11:34:31	00	f	\N	\N	\N	\N	f
66	Passagem de Turno	FR-MAN-005	xls	\N	Restrito	f	4	916	11	3	2018-08-28 11:35:10	2018-08-28 11:35:10	00	f	\N	\N	\N	\N	f
67	Inspeção de Cabos de Aço QC - Hoist e Catenária	FR-MAN-006	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:37:27	2018-08-28 11:37:27	00	f	\N	\N	\N	\N	f
68	Inpeção de Cabos de Aço RTG	FR-MAN-007	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:38:01	2018-08-28 11:38:01	00	f	\N	\N	\N	\N	f
69	Indicadores de Desempenho dos Equipamentos	FR-MAN-008	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 11:38:46	2018-08-28 11:38:46	00	f	\N	\N	\N	\N	f
70	Saída de Materiais	FR-MAN-009	xlsx	\N	Livre	f	4	916	11	3	2018-08-28 11:39:22	2018-08-28 11:39:22	00	f	\N	\N	\N	\N	f
71	Inventário	FR-MAN-010	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:20:05	2018-08-28 12:20:05	00	f	\N	\N	\N	\N	f
72	Controle de Abastecimento - Contingência	FR-MAN-011	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:21:26	2018-08-28 12:21:26	00	f	\N	\N	\N	\N	f
73	Controle de Ferramentas	FR-MAN-012	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:21:58	2018-08-28 12:21:58	00	f	\N	\N	\N	\N	f
74	Controle de Recebimento de Notas Fiscais	FR-MAN-013	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:22:44	2018-08-28 12:22:44	00	f	\N	\N	\N	\N	f
75	Notificação de Sistema de Combate à Incêndio Inoperante	FR-MAN-014	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:23:27	2018-08-28 12:23:27	00	f	\N	\N	\N	\N	f
76	Inspeção de Partículas Magnéticas - Headblock	FR-MAN-015	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:24:28	2018-08-28 12:24:28	00	f	\N	\N	\N	\N	f
77	Análise de Falha	FR-MAN-017	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:28:25	2018-08-28 12:28:25	00	f	\N	\N	\N	\N	f
78	Manutenção Preditiva - Análise de Vibração	FR-MAN-018	xls	\N	Restrito	f	4	916	11	3	2018-08-28 12:29:36	2018-08-28 12:29:36	00	f	\N	\N	\N	\N	f
79	Manutenção Preditiva - Inspeção Termográfica	FR-MAN-020	xls	\N	Restrito	f	4	916	11	3	2018-08-28 12:32:25	2018-08-28 12:32:25	00	f	\N	\N	\N	\N	f
80	Inspeção de Partículas Magnéticas - Spreader RTG	FR-MAN-022	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:38:11	2018-08-28 12:38:11	00	f	\N	\N	\N	\N	f
81	Inspeção de Partículas Magnéticas - Spreader QC	FR-MAN-023	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:39:01	2018-08-28 12:39:01	00	f	\N	\N	\N	\N	f
82	Inspeção de Partículas Magnéticas - ECH	FR-MAN-024	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:40:20	2018-08-28 12:40:20	00	f	\N	\N	\N	\N	f
83	Inspeção de Partículas Magnéticas - RS	FR-MAN-025	docx	\N	Restrito	f	4	916	11	3	2018-08-28 12:40:51	2018-08-28 12:40:51	00	f	\N	\N	\N	\N	f
84	Controle de Medição das Lonas de Freio do Terminal Tractor	FR-MAN-026	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:41:58	2018-08-28 12:41:58	00	f	\N	\N	\N	\N	f
85	Controle de Medição das Lonas de Freio da Carreta Houcon	FR-MAN-027	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:42:35	2018-08-28 12:42:35	00	f	\N	\N	\N	\N	f
86	Aferição dos Calibradores de Pneu	FR-MAN-028	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:43:02	2018-08-28 12:43:02	00	f	\N	\N	\N	\N	f
87	Manutenção Preditiva - Inspeção de Cabo de Aço	FR-MAN-029	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:43:55	2018-08-28 12:43:55	00	f	\N	\N	\N	\N	f
88	Cronograma Semanal - Infra-estrutura	FR-MAN-030	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:44:30	2018-08-28 12:44:30	00	f	\N	\N	\N	\N	f
89	Cronograma Semanal - Infra-estrutura	FR-MAN-030	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 12:44:30	2018-08-28 12:44:30	00	f	\N	\N	\N	\N	f
90	Cronograma Semanal - Equipamentos	FR-MAN-031	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:49:52	2018-08-28 14:49:52	00	f	\N	\N	\N	\N	f
91	Ficha de Controle de Manilhas	FR-MAN-032	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:51:12	2018-08-28 14:51:12	00	f	\N	\N	\N	\N	f
92	Ficha de Controle de Cabos de Aço	FR-MAN-033	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:51:47	2018-08-28 14:51:47	00	f	\N	\N	\N	\N	f
93	Ficha de Controle de Cintas	FR-MAN-034	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:53:23	2018-08-28 14:53:23	00	f	\N	\N	\N	\N	f
94	Ficha de Controle de Cavaletes	FR-MAN-035	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:55:06	2018-08-28 14:55:06	00	f	\N	\N	\N	\N	f
95	Check List para Escavações	FR-MAN-037	doc	\N	Restrito	f	4	916	11	3	2018-08-28 14:57:00	2018-08-28 14:57:00	00	f	\N	\N	\N	\N	f
96	Controle de Abastecimento - Caminhão Comboio	FR-MAN-038	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:57:49	2018-08-28 14:57:49	00	f	\N	\N	\N	\N	f
97	Conferência Recebimento de Combustível	FR-MAN-039	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 14:58:47	2018-08-28 14:58:47	00	f	\N	\N	\N	\N	f
98	Controle de Acesso - Almoxarifado	FR-MAN-040	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:00:16	2018-08-28 15:00:16	00	f	\N	\N	\N	\N	f
99	Controle de calibração dos equipamentos	FR-MAN-041	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:00:57	2018-08-28 15:00:57	00	f	\N	\N	\N	\N	f
100	Controle de Combustível	FR-MAN-042	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:09:28	2018-08-28 15:09:28	00	f	\N	\N	\N	\N	f
101	Check List para Plataforma Elevatória	FR-MAN-044	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:12:36	2018-08-28 15:12:36	00	f	\N	\N	\N	\N	f
102	Solicitação de Compra de Materiais e Serviços	FR-MAN-045	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:13:05	2018-08-28 15:13:05	00	f	\N	\N	\N	\N	f
103	Check List da Máquina Varredeira	FR-MAN-046	docx	\N	Restrito	f	4	916	11	3	2018-08-28 15:13:56	2018-08-28 15:13:56	00	f	\N	\N	\N	\N	f
105	Controle de Fluxo Marítimo	FR-MAN-048	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:17:14	2018-08-28 15:17:14	00	f	\N	\N	\N	\N	f
106	Controle de Retirada de Chaves - Claviculário	FR-MAN-050	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:21:32	2018-08-28 15:21:32	00	f	\N	\N	\N	\N	f
107	Limpeza Medição Mensal	FR-MAN-051	xlsx	\N	Restrito	f	4	916	11	4	2018-08-28 15:22:20	2018-08-28 15:22:20	00	f	\N	\N	\N	\N	f
108	Medição Mensal Transporte Marítimo - Estiva	FR-MAN-052	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:23:06	2018-08-28 15:23:06	00	f	\N	\N	\N	\N	f
109	Medição Mensal Transporte Marítimo - Extra	FR-MAN-053	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:23:55	2018-08-28 15:23:55	00	f	\N	\N	\N	\N	f
110	Medição Mensal Transporte Marítimo - Horário Fixo	FR-MAN-054	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:24:35	2018-08-28 15:24:35	00	f	\N	\N	\N	\N	f
111	Medição Mensal Transporte Marítimo - Lancha Rápida	FR-MAN-055	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:25:08	2018-08-28 15:25:08	00	f	\N	\N	\N	\N	f
112	Termo de notificação de infração de trânsito	FR-MAN-056	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:25:42	2018-08-28 15:25:42	00	f	\N	\N	\N	\N	f
113	Medição Mensal - Transporte Rodoviário	FR-MAN-057	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:26:10	2018-08-28 15:26:10	00	f	\N	\N	\N	\N	f
114	Medição de Locação Mensal - Veículo Leve	FR-MAN-058	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:26:38	2018-08-28 15:26:38	00	f	\N	\N	\N	\N	f
115	Medição de Consumo - Ticket Car - Veículo Leve	FR-MAN-059	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:27:16	2018-08-28 15:27:16	00	f	\N	\N	\N	\N	f
116	Controle de Manutenção dos Bebedouros	FR-MAN-060	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:28:55	2018-08-28 15:28:55	00	f	\N	\N	\N	\N	f
117	Inspeção de Partículas Magnéticas - Estrutura do Spreader	FR-MAN-061	docx	\N	Restrito	f	4	916	11	3	2018-08-28 15:29:31	2018-08-28 15:29:31	00	f	\N	\N	\N	\N	f
118	Inspeção de Partículas Magnéticas - Hook Cargo Beam	FR-MAN-062	docx	\N	Restrito	f	4	916	11	3	2018-08-28 15:30:00	2018-08-28 15:30:00	00	f	\N	\N	\N	\N	f
119	Solicitação de Reforma, Melhoria nas Edificações e Infraestrutura.	FR-MAN-063	xlsx	\N	Livre	f	4	916	11	3	2018-08-28 15:30:43	2018-08-28 15:30:43	00	f	\N	\N	\N	\N	f
120	Medição Kristal Água	FR-MAN-064	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:31:24	2018-08-28 15:31:24	00	f	\N	\N	\N	\N	f
121	Medição Mensal - Estrela Guia Transporte Marítimo	FR-MAN-065	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:31:57	2018-08-28 15:31:57	00	f	\N	\N	\N	\N	f
122	Veículo Leve Medição de Consumo - Sem Parar	FR-MAN-066	xlsx	\N	Restrito	f	4	916	11	3	2018-08-28 15:32:32	2018-08-28 15:32:32	00	f	\N	\N	\N	\N	f
4	Teste adm	FR-ADM-004	docx	\N	Livre	f	4	143	2	3	2018-08-27 10:09:12	2018-08-30 09:49:55	00	t	143	Teste adm.docx	Teste adm.docx	\N	f
104	Advertência Prestador de Serviço	FR-MAN-047	xlsx	\N	Restrito	t	4	916	11	3	2018-08-28 15:16:33	2018-08-30 14:04:41	00	f	\N	Advertência Prestador de Serviço.xlsx	\N	\N	f
\.


--
-- Name: formulario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.formulario_id_seq', 155, true);


--
-- Data for Name: formulario_revisao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.formulario_revisao (id, codigo, revisao, nome, nome_completo, extensao, nivel_acesso, finalizado, documentos_necessitam, formulario_id, tipo_documento_id, elaborador_id, setor_id, grupo_divulgacao_id, created_at, updated_at) FROM stdin;
1	FR-ADM-004	00	Teste adm	Teste adm.docx	docx	Livre	t	\N	4	4	962	2	3	2018-08-27 10:09:27	2018-08-27 10:09:27
\.


--
-- Name: formulario_revisao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.formulario_revisao_id_seq', 26, true);


--
-- Data for Name: grupo_divulgacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_divulgacao (id, nome, descricao, created_at, updated_at) FROM stdin;
1	Exemplo Divulgação I	O primeiro exemplo de grupo de divulgação para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.	2018-08-06 13:25:38	2018-08-06 13:25:38
2	Exemplo Divulgação II	O segundo exemplo de grupo de divulgação para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.	2018-08-06 13:25:38	2018-08-06 13:25:38
3	Divulgação PeO	Teste	2018-08-14 09:29:55	2018-08-14 09:29:55
16	Pessoas	Grupo de divulgação - Pessoas	2018-08-28 12:07:08	2018-08-28 12:07:08
17	Processos Aduaneiros	Grupo de divulgação - Processos Aduaneiros	2018-08-28 12:21:24	2018-08-28 12:21:24
18	Qualidade	Grupo de divulgação - Qualidade	2018-08-28 12:25:35	2018-08-28 12:25:35
14	Projetos	Grupo de divulgação - Projetos	2018-08-28 11:31:11	2018-08-28 12:40:34
19	Segurança do Trabalho	Grupo de divulgação - Segurança do Trabalho	2018-08-28 12:41:36	2018-08-28 12:41:36
4	Administrativo	Grupo de divulgação - Administrativo	2018-08-28 08:23:25	2018-08-28 14:22:19
5	Armadores	Grupo de divulgação - Armadores	2018-08-28 08:26:51	2018-08-28 14:22:30
6	Central de Documentação Integrada	Grupo de divulgação - CDI	2018-08-28 08:29:25	2018-08-28 14:22:39
7	Compras	Grupo de divulgação - Compras	2018-08-28 08:31:16	2018-08-28 14:22:54
8	Comunicação	Grupo de divulgação - Comunicação	2018-08-28 08:36:43	2018-08-28 14:23:10
9	Controladoria	Grupo de divulgação - Controladoria	2018-08-28 08:43:48	2018-08-28 14:23:20
10	Financeiro	Grupo de divulgação - Financeiro	2018-08-28 09:09:42	2018-08-28 14:23:37
11	Jurídico	Grupo de divulgação - Jurídico	2018-08-28 09:20:38	2018-08-28 14:23:53
12	Manutenção	Grupo de divulgação - Manutenção	2018-08-28 09:35:02	2018-08-28 14:24:10
13	Meio Ambiente	Grupo de divulgação - Meio Ambiente	2018-08-28 09:49:59	2018-08-28 14:24:30
15	Operação	Grupo de divulgação - Operação	2018-08-28 11:47:40	2018-08-28 14:24:44
20	Grupo de Divulgação - Importação de Documentos	Grupo de Divulgação criado para que os documentos provenientes da pré-carga realizada no sistema possam ser vinculados. Isso pode ser alterado futuramente.	2018-08-29 14:05:54	2018-08-29 14:05:54
\.


--
-- Name: grupo_divulgacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_divulgacao_id_seq', 20, true);


--
-- Data for Name: grupo_divulgacao_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_divulgacao_usuario (id, grupo_id, usuario_id, created_at, updated_at) FROM stdin;
1	3	916	2018-08-14 09:30:32	2018-08-14 09:30:32
2	4	2	2018-08-28 08:23:45	2018-08-28 08:23:45
3	4	913	2018-08-28 08:23:45	2018-08-28 08:23:45
4	5	310	2018-08-28 08:27:09	2018-08-28 08:27:09
5	6	168	2018-08-28 08:29:38	2018-08-28 08:29:38
6	6	68	2018-08-28 08:29:38	2018-08-28 08:29:38
7	7	6	2018-08-28 08:31:45	2018-08-28 08:31:45
8	7	76	2018-08-28 08:31:45	2018-08-28 08:31:45
9	7	345	2018-08-28 08:31:45	2018-08-28 08:31:45
10	7	384	2018-08-28 08:31:45	2018-08-28 08:31:45
11	8	96	2018-08-28 08:37:20	2018-08-28 08:37:20
12	8	138	2018-08-28 08:37:20	2018-08-28 08:37:20
13	8	573	2018-08-28 08:37:20	2018-08-28 08:37:20
14	8	851	2018-08-28 08:37:20	2018-08-28 08:37:20
15	9	4	2018-08-28 08:59:56	2018-08-28 08:59:56
16	9	129	2018-08-28 08:59:56	2018-08-28 08:59:56
17	9	511	2018-08-28 08:59:56	2018-08-28 08:59:56
18	9	732	2018-08-28 08:59:56	2018-08-28 08:59:56
19	9	817	2018-08-28 08:59:56	2018-08-28 08:59:56
20	10	489	2018-08-28 09:10:06	2018-08-28 09:10:06
21	10	706	2018-08-28 09:10:06	2018-08-28 09:10:06
22	10	675	2018-08-28 09:10:06	2018-08-28 09:10:06
23	11	152	2018-08-28 09:21:00	2018-08-28 09:21:00
24	11	476	2018-08-28 09:21:00	2018-08-28 09:21:00
25	11	596	2018-08-28 09:21:00	2018-08-28 09:21:00
26	11	934	2018-08-28 09:21:00	2018-08-28 09:21:00
27	11	1007	2018-08-28 09:21:00	2018-08-28 09:21:00
28	12	195	2018-08-28 09:36:49	2018-08-28 09:36:49
29	12	473	2018-08-28 09:36:49	2018-08-28 09:36:49
30	12	580	2018-08-28 09:36:49	2018-08-28 09:36:49
31	12	592	2018-08-28 09:36:49	2018-08-28 09:36:49
32	12	848	2018-08-28 09:36:49	2018-08-28 09:36:49
33	12	842	2018-08-28 09:36:49	2018-08-28 09:36:49
34	12	924	2018-08-28 09:36:49	2018-08-28 09:36:49
35	12	937	2018-08-28 09:36:49	2018-08-28 09:36:49
36	12	1027	2018-08-28 09:36:49	2018-08-28 09:36:49
37	13	30	2018-08-28 09:51:41	2018-08-28 09:51:41
38	13	509	2018-08-28 09:51:41	2018-08-28 09:51:41
39	13	779	2018-08-28 09:51:41	2018-08-28 09:51:41
40	13	1015	2018-08-28 09:51:41	2018-08-28 09:51:41
41	14	165	2018-08-28 11:31:49	2018-08-28 11:31:49
42	14	492	2018-08-28 11:31:49	2018-08-28 11:31:49
43	14	693	2018-08-28 11:31:49	2018-08-28 11:31:49
44	14	840	2018-08-28 11:31:49	2018-08-28 11:31:49
45	14	1073	2018-08-28 11:33:22	2018-08-28 11:33:22
46	15	179	2018-08-28 11:49:17	2018-08-28 11:49:17
47	15	503	2018-08-28 11:49:17	2018-08-28 11:49:17
48	15	528	2018-08-28 11:49:17	2018-08-28 11:49:17
49	15	539	2018-08-28 11:49:17	2018-08-28 11:49:17
50	15	661	2018-08-28 11:49:17	2018-08-28 11:49:17
51	15	747	2018-08-28 11:49:17	2018-08-28 11:49:17
52	15	806	2018-08-28 11:49:17	2018-08-28 11:49:17
53	15	915	2018-08-28 11:49:17	2018-08-28 11:49:17
54	15	958	2018-08-28 11:49:17	2018-08-28 11:49:17
55	15	1130	2018-08-28 11:49:17	2018-08-28 11:49:17
56	15	804	2018-08-28 11:49:17	2018-08-28 11:49:17
57	15	1134	2018-08-28 11:49:17	2018-08-28 11:49:17
58	16	40	2018-08-28 12:07:36	2018-08-28 12:07:36
59	16	193	2018-08-28 12:07:36	2018-08-28 12:07:36
60	16	305	2018-08-28 12:07:36	2018-08-28 12:07:36
61	16	335	2018-08-28 12:07:36	2018-08-28 12:07:36
62	16	331	2018-08-28 12:07:36	2018-08-28 12:07:36
63	16	391	2018-08-28 12:07:36	2018-08-28 12:07:36
64	16	519	2018-08-28 12:07:36	2018-08-28 12:07:36
65	16	687	2018-08-28 12:07:36	2018-08-28 12:07:36
66	16	683	2018-08-28 12:07:36	2018-08-28 12:07:36
67	16	728	2018-08-28 12:07:36	2018-08-28 12:07:36
68	17	200	2018-08-28 12:22:13	2018-08-28 12:22:13
69	17	265	2018-08-28 12:22:13	2018-08-28 12:22:13
70	17	365	2018-08-28 12:22:13	2018-08-28 12:22:13
71	17	543	2018-08-28 12:22:13	2018-08-28 12:22:13
72	17	579	2018-08-28 12:22:13	2018-08-28 12:22:13
73	17	538	2018-08-28 12:22:13	2018-08-28 12:22:13
74	17	646	2018-08-28 12:22:13	2018-08-28 12:22:13
75	17	754	2018-08-28 12:22:13	2018-08-28 12:22:13
76	17	805	2018-08-28 12:22:13	2018-08-28 12:22:13
77	17	946	2018-08-28 12:22:13	2018-08-28 12:22:13
78	17	1117	2018-08-28 12:22:14	2018-08-28 12:22:14
79	17	927	2018-08-28 12:22:14	2018-08-28 12:22:14
80	17	610	2018-08-28 12:22:14	2018-08-28 12:22:14
81	18	10	2018-08-28 12:27:10	2018-08-28 12:27:10
82	18	916	2018-08-28 12:27:10	2018-08-28 12:27:10
83	18	962	2018-08-28 12:27:10	2018-08-28 12:27:10
84	18	32	2018-08-28 12:27:10	2018-08-28 12:27:10
85	18	690	2018-08-28 12:27:10	2018-08-28 12:27:10
86	19	167	2018-08-28 14:25:33	2018-08-28 14:25:33
87	19	598	2018-08-28 14:25:33	2018-08-28 14:25:33
88	19	769	2018-08-28 14:25:33	2018-08-28 14:25:33
89	19	839	2018-08-28 14:25:33	2018-08-28 14:25:33
90	19	843	2018-08-28 14:25:33	2018-08-28 14:25:33
91	19	859	2018-08-28 14:25:33	2018-08-28 14:25:33
92	19	166	2018-08-28 14:25:33	2018-08-28 14:25:33
\.


--
-- Name: grupo_divulgacao_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_divulgacao_usuario_id_seq', 92, true);


--
-- Data for Name: grupo_treinamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_treinamento (id, nome, descricao, created_at, updated_at) FROM stdin;
1	Exemplo Treinamento I	O primeiro exemplo de grupo de treinamento para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.	2018-08-06 13:25:38	2018-08-06 13:25:38
2	Exemplo Treinamento II	O segundo exemplo de grupo de treinamento para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.	2018-08-06 13:25:38	2018-08-06 13:25:38
16	Processos Aduaneiros	Grupo de treinamento - Processos Aduaneiros	2018-08-28 12:09:23	2018-08-28 12:09:23
17	Qualidade	Grupo de treinamento - Qualidade	2018-08-28 12:23:37	2018-08-28 12:23:37
19	Saúde Ocupacional	Grupo de treinamento - Saúde Ocupacional	2018-08-28 12:37:40	2018-08-28 12:37:40
18	Segurança do Trabalho	Grupo de treinamento - Segurança do Trabalho	2018-08-28 12:28:13	2018-08-28 12:39:00
13	Projetos	Grupo de treinamento - Projetos	2018-08-28 09:52:33	2018-08-28 12:40:21
3	Administrativo	Grupo de treinamento - Administrativo.	2018-08-28 08:14:57	2018-08-28 14:18:27
4	Armadores	Grupo de treinamento - Armadores.	2018-08-28 08:25:39	2018-08-28 14:18:42
5	Central de Documentação Integrada	Grupo de treinamento - CDI	2018-08-28 08:28:18	2018-08-28 14:18:51
6	Compras	Grupo de treinamento - Compras	2018-08-28 08:30:13	2018-08-28 14:19:03
7	Comunicação	Grupo de treinamento - Comunicação	2018-08-28 08:34:40	2018-08-28 14:19:14
8	Controladoria	Grupo de treinamento - Controladoria	2018-08-28 08:39:16	2018-08-28 14:19:23
9	Financeiro	Grupo de treinamento - Financeiro	2018-08-28 09:02:50	2018-08-28 14:19:35
10	Jurídico	Grupo de treinamento - Jurídico	2018-08-28 09:13:12	2018-08-28 14:19:49
11	Manutenção	Grupo de treinamento - Manutenção	2018-08-28 09:22:40	2018-08-28 14:20:01
12	Meio Ambiente	Grupo de treinamento - Meio Ambiente	2018-08-28 09:47:50	2018-08-28 14:20:12
14	Operação	Grupo de treinamento - Operação	2018-08-28 09:53:47	2018-08-28 14:20:42
15	Pessoas	Grupo de treinamento - Pessoas	2018-08-28 11:44:17	2018-08-28 14:20:59
20	Grupo de Treinamento - Importação de Documentos	Grupo de Treinamento criado para que os documentos provenientes da pré-carga realizada no sistema possam ser vinculados. Isso pode ser alterado futuramente.	2018-08-29 14:05:00	2018-08-29 14:05:00
\.


--
-- Name: grupo_treinamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_treinamento_id_seq', 20, true);


--
-- Data for Name: grupo_treinamento_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_treinamento_usuario (id, grupo_id, usuario_id, created_at, updated_at) FROM stdin;
2	3	2	2018-08-28 08:22:31	2018-08-28 08:22:31
3	3	913	2018-08-28 08:22:31	2018-08-28 08:22:31
4	4	310	2018-08-28 08:25:54	2018-08-28 08:25:54
5	5	168	2018-08-28 08:28:42	2018-08-28 08:28:42
6	5	68	2018-08-28 08:28:42	2018-08-28 08:28:42
7	6	6	2018-08-28 08:30:35	2018-08-28 08:30:35
8	6	76	2018-08-28 08:30:35	2018-08-28 08:30:35
9	6	345	2018-08-28 08:30:35	2018-08-28 08:30:35
10	6	384	2018-08-28 08:30:35	2018-08-28 08:30:35
11	7	96	2018-08-28 08:35:33	2018-08-28 08:35:33
12	7	138	2018-08-28 08:35:33	2018-08-28 08:35:33
13	7	573	2018-08-28 08:35:33	2018-08-28 08:35:33
14	7	851	2018-08-28 08:35:33	2018-08-28 08:35:33
15	8	4	2018-08-28 08:40:14	2018-08-28 08:40:14
16	8	129	2018-08-28 08:40:14	2018-08-28 08:40:14
17	8	511	2018-08-28 08:40:14	2018-08-28 08:40:14
18	8	732	2018-08-28 08:40:14	2018-08-28 08:40:14
19	8	817	2018-08-28 08:43:19	2018-08-28 08:43:19
20	9	489	2018-08-28 09:08:23	2018-08-28 09:08:23
21	9	706	2018-08-28 09:08:23	2018-08-28 09:08:23
22	9	675	2018-08-28 09:08:23	2018-08-28 09:08:23
23	10	152	2018-08-28 09:19:30	2018-08-28 09:19:30
24	10	476	2018-08-28 09:19:30	2018-08-28 09:19:30
25	10	596	2018-08-28 09:19:30	2018-08-28 09:19:30
26	10	934	2018-08-28 09:19:30	2018-08-28 09:19:30
27	10	1007	2018-08-28 09:19:30	2018-08-28 09:19:30
29	11	473	2018-08-28 09:27:21	2018-08-28 09:27:21
30	11	580	2018-08-28 09:27:21	2018-08-28 09:27:21
31	11	592	2018-08-28 09:27:21	2018-08-28 09:27:21
32	11	848	2018-08-28 09:27:21	2018-08-28 09:27:21
33	11	842	2018-08-28 09:27:21	2018-08-28 09:27:21
34	11	924	2018-08-28 09:27:21	2018-08-28 09:27:21
35	11	937	2018-08-28 09:27:21	2018-08-28 09:27:21
36	11	1027	2018-08-28 09:27:21	2018-08-28 09:27:21
37	12	30	2018-08-28 09:48:58	2018-08-28 09:48:58
38	12	509	2018-08-28 09:48:58	2018-08-28 09:48:58
39	12	779	2018-08-28 09:48:58	2018-08-28 09:48:58
40	12	1015	2018-08-28 09:48:58	2018-08-28 09:48:58
41	13	165	2018-08-28 11:28:58	2018-08-28 11:28:58
42	13	492	2018-08-28 11:28:58	2018-08-28 11:28:58
43	13	693	2018-08-28 11:28:58	2018-08-28 11:28:58
44	13	840	2018-08-28 11:28:58	2018-08-28 11:28:58
45	13	1073	2018-08-28 11:33:03	2018-08-28 11:33:03
46	14	179	2018-08-28 11:45:32	2018-08-28 11:45:32
47	14	503	2018-08-28 11:45:32	2018-08-28 11:45:32
48	14	528	2018-08-28 11:45:32	2018-08-28 11:45:32
49	14	539	2018-08-28 11:45:32	2018-08-28 11:45:32
50	14	661	2018-08-28 11:45:32	2018-08-28 11:45:32
51	14	747	2018-08-28 11:45:32	2018-08-28 11:45:32
52	14	806	2018-08-28 11:45:32	2018-08-28 11:45:32
53	14	915	2018-08-28 11:45:32	2018-08-28 11:45:32
54	14	958	2018-08-28 11:45:32	2018-08-28 11:45:32
55	14	1130	2018-08-28 11:45:32	2018-08-28 11:45:32
56	14	1134	2018-08-28 11:45:32	2018-08-28 11:45:32
57	15	40	2018-08-28 12:06:34	2018-08-28 12:06:34
58	15	193	2018-08-28 12:06:34	2018-08-28 12:06:34
59	15	305	2018-08-28 12:06:34	2018-08-28 12:06:34
60	15	335	2018-08-28 12:06:34	2018-08-28 12:06:34
61	15	331	2018-08-28 12:06:34	2018-08-28 12:06:34
62	15	391	2018-08-28 12:06:34	2018-08-28 12:06:34
63	15	519	2018-08-28 12:06:34	2018-08-28 12:06:34
64	15	687	2018-08-28 12:06:34	2018-08-28 12:06:34
65	15	683	2018-08-28 12:06:34	2018-08-28 12:06:34
66	15	728	2018-08-28 12:06:34	2018-08-28 12:06:34
67	16	200	2018-08-28 12:20:41	2018-08-28 12:20:41
68	16	265	2018-08-28 12:20:41	2018-08-28 12:20:41
69	16	365	2018-08-28 12:20:41	2018-08-28 12:20:41
70	16	543	2018-08-28 12:20:41	2018-08-28 12:20:41
71	16	579	2018-08-28 12:20:41	2018-08-28 12:20:41
72	16	538	2018-08-28 12:20:41	2018-08-28 12:20:41
73	16	646	2018-08-28 12:20:41	2018-08-28 12:20:41
74	16	754	2018-08-28 12:20:41	2018-08-28 12:20:41
75	16	805	2018-08-28 12:20:41	2018-08-28 12:20:41
76	16	946	2018-08-28 12:20:41	2018-08-28 12:20:41
77	16	1117	2018-08-28 12:20:41	2018-08-28 12:20:41
78	16	927	2018-08-28 12:20:41	2018-08-28 12:20:41
79	16	610	2018-08-28 12:20:41	2018-08-28 12:20:41
80	17	10	2018-08-28 12:24:36	2018-08-28 12:24:36
81	17	916	2018-08-28 12:24:36	2018-08-28 12:24:36
82	17	962	2018-08-28 12:24:36	2018-08-28 12:24:36
83	17	32	2018-08-28 12:24:36	2018-08-28 12:24:36
84	17	690	2018-08-28 12:24:36	2018-08-28 12:24:36
85	19	45	2018-08-28 12:39:39	2018-08-28 12:39:39
86	19	66	2018-08-28 12:39:39	2018-08-28 12:39:39
87	19	143	2018-08-28 12:39:39	2018-08-28 12:39:39
88	19	289	2018-08-28 12:39:39	2018-08-28 12:39:39
89	19	332	2018-08-28 12:39:39	2018-08-28 12:39:39
90	19	815	2018-08-28 12:39:39	2018-08-28 12:39:39
91	19	995	2018-08-28 12:39:39	2018-08-28 12:39:39
92	18	167	2018-08-28 14:21:47	2018-08-28 14:21:47
93	18	598	2018-08-28 14:21:47	2018-08-28 14:21:47
94	18	769	2018-08-28 14:21:47	2018-08-28 14:21:47
95	18	839	2018-08-28 14:21:47	2018-08-28 14:21:47
96	18	843	2018-08-28 14:21:47	2018-08-28 14:21:47
97	18	859	2018-08-28 14:21:47	2018-08-28 14:21:47
\.


--
-- Name: grupo_treinamento_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_treinamento_usuario_id_seq', 97, true);


--
-- Data for Name: historico_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historico_documento (id, descricao, documento_id, created_at, updated_at, id_usuario_responsavel, nome_usuario_responsavel) FROM stdin;
709	Documento Importado	81	2018-09-01 02:25:31	2018-09-01 02:25:31	1	Speed
710	Documento Importado	82	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
711	Documento Importado	83	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
712	Documento Importado	84	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
713	Documento Importado	85	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
714	Documento Importado	86	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
715	Documento Importado	87	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
716	Documento Importado	88	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
717	Documento Importado	89	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
718	Documento Importado	90	2018-09-01 02:27:31	2018-09-01 02:27:31	1	Speed
719	Documento Importado	91	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
720	Documento Importado	92	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
721	Documento Importado	93	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
722	Documento Importado	94	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
723	Documento Importado	95	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
724	Documento Importado	96	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
725	Documento Importado	97	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
726	Documento Importado	98	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
727	Documento Importado	99	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
728	Documento Importado	100	2018-09-01 02:27:32	2018-09-01 02:27:32	1	Speed
729	Documento Importado	101	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
730	Documento Importado	102	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
731	Documento Importado	103	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
732	Documento Importado	104	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
733	Documento Importado	105	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
734	Documento Importado	106	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
735	Documento Importado	107	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
736	Documento Importado	108	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
737	Documento Importado	109	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
738	Documento Importado	110	2018-09-01 02:27:33	2018-09-01 02:27:33	1	Speed
739	Documento Importado	111	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
740	Documento Importado	112	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
741	Documento Importado	113	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
742	Documento Importado	114	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
743	Documento Importado	115	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
744	Documento Importado	116	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
745	Documento Importado	117	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
746	Documento Importado	118	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
747	Documento Importado	119	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
748	Documento Importado	120	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
749	Documento Importado	121	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
750	Documento Importado	122	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
751	Documento Importado	123	2018-09-01 02:27:34	2018-09-01 02:27:34	1	Speed
752	Documento Importado	124	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
753	Documento Importado	125	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
754	Documento Importado	126	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
755	Documento Importado	127	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
756	Documento Importado	128	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
757	Documento Importado	129	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
758	Documento Importado	130	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
759	Documento Importado	131	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
760	Documento Importado	132	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
761	Documento Importado	133	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
762	Documento Importado	134	2018-09-01 02:27:35	2018-09-01 02:27:35	1	Speed
763	Documento Importado	135	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
764	Documento Importado	136	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
765	Documento Importado	137	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
766	Documento Importado	138	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
767	Documento Importado	139	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
768	Documento Importado	140	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
769	Documento Importado	141	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
770	Documento Importado	142	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
771	Documento Importado	143	2018-09-01 02:27:36	2018-09-01 02:27:36	1	Speed
772	Documento Importado	144	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
773	Documento Importado	145	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
774	Documento Importado	146	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
775	Documento Importado	147	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
776	Documento Importado	148	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
777	Documento Importado	149	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
778	Documento Importado	150	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
779	Documento Importado	151	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
780	Documento Importado	152	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
781	Documento Importado	153	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
782	Documento Importado	154	2018-09-01 02:27:37	2018-09-01 02:27:37	1	Speed
783	Documento Importado	155	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
784	Documento Importado	156	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
785	Documento Importado	157	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
786	Documento Importado	158	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
787	Documento Importado	159	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
788	Documento Importado	160	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
789	Documento Importado	161	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
790	Documento Importado	162	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
791	Documento Importado	163	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
792	Documento Importado	164	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
793	Documento Importado	165	2018-09-01 02:27:38	2018-09-01 02:27:38	1	Speed
794	Documento Importado	166	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
795	Documento Importado	167	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
796	Documento Importado	168	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
797	Documento Importado	169	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
798	Documento Importado	170	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
799	Documento Importado	171	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
800	Documento Importado	172	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
801	Documento Importado	173	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
802	Documento Importado	174	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
803	Documento Importado	175	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
804	Documento Importado	176	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
805	Documento Importado	177	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
806	Documento Importado	178	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
807	Documento Importado	179	2018-09-01 02:27:39	2018-09-01 02:27:39	1	Speed
808	Documento Importado	180	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
809	Documento Importado	181	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
810	Documento Importado	182	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
811	Documento Importado	183	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
812	Documento Importado	184	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
813	Documento Importado	185	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
814	Documento Importado	186	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
815	Documento Importado	187	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
816	Documento Importado	188	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
817	Documento Importado	189	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
818	Documento Importado	190	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
819	Documento Importado	191	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
820	Documento Importado	192	2018-09-01 02:27:40	2018-09-01 02:27:40	1	Speed
821	Documento Importado	193	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
822	Documento Importado	194	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
823	Documento Importado	195	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
824	Documento Importado	196	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
825	Documento Importado	197	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
826	Documento Importado	198	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
827	Documento Importado	199	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
828	Documento Importado	200	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
829	Documento Importado	201	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
830	Documento Importado	202	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
831	Documento Importado	203	2018-09-01 02:27:41	2018-09-01 02:27:41	1	Speed
832	Documento Importado	204	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
833	Documento Importado	205	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
834	Documento Importado	206	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
835	Documento Importado	207	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
836	Documento Importado	208	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
837	Documento Importado	209	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
838	Documento Importado	210	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
839	Documento Importado	211	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
840	Documento Importado	212	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
841	Documento Importado	213	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
842	Documento Importado	214	2018-09-01 02:27:42	2018-09-01 02:27:42	1	Speed
843	Documento Importado	215	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
844	Documento Importado	216	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
845	Documento Importado	217	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
846	Documento Importado	218	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
847	Documento Importado	219	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
848	Documento Importado	220	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
849	Documento Importado	221	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
850	Documento Importado	222	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
851	Documento Importado	223	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
852	Documento Importado	224	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
853	Documento Importado	225	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
854	Documento Importado	226	2018-09-01 02:27:43	2018-09-01 02:27:43	1	Speed
855	Documento Importado	227	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
856	Documento Importado	228	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
857	Documento Importado	229	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
858	Documento Importado	230	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
859	Documento Importado	231	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
860	Documento Importado	232	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
861	Documento Importado	233	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
862	Documento Importado	234	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
863	Documento Importado	235	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
864	Documento Importado	236	2018-09-01 02:27:44	2018-09-01 02:27:44	1	Speed
865	Documento Importado	237	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
866	Documento Importado	238	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
867	Documento Importado	239	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
868	Documento Importado	240	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
869	Documento Importado	241	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
870	Documento Importado	242	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
871	Documento Importado	243	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
872	Documento Importado	244	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
873	Documento Importado	245	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
874	Documento Importado	246	2018-09-01 02:27:45	2018-09-01 02:27:45	1	Speed
875	Documento Importado	247	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
876	Documento Importado	248	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
877	Documento Importado	249	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
878	Documento Importado	250	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
879	Documento Importado	251	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
880	Documento Importado	252	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
881	Documento Importado	253	2018-09-01 02:27:46	2018-09-01 02:27:46	1	Speed
882	Documento Importado	254	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
883	Documento Importado	255	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
884	Documento Importado	256	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
885	Documento Importado	257	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
886	Documento Importado	258	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
887	Documento Importado	259	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
888	Documento Importado	260	2018-09-01 02:27:47	2018-09-01 02:27:47	1	Speed
889	Documento Importado	261	2018-09-01 02:27:48	2018-09-01 02:27:48	1	Speed
890	Documento Importado	262	2018-09-01 02:27:48	2018-09-01 02:27:48	1	Speed
891	Documento Importado	263	2018-09-01 02:27:48	2018-09-01 02:27:48	1	Speed
892	Documento Importado	264	2018-09-01 02:27:48	2018-09-01 02:27:48	1	Speed
893	Documento Importado	265	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
894	Documento Importado	266	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
895	Documento Importado	267	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
896	Documento Importado	268	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
897	Documento Importado	269	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
898	Documento Importado	270	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
899	Documento Importado	271	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
900	Documento Importado	272	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
901	Documento Importado	273	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
902	Documento Importado	274	2018-09-01 02:27:49	2018-09-01 02:27:49	1	Speed
903	Documento Importado	275	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
904	Documento Importado	276	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
905	Documento Importado	277	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
906	Documento Importado	278	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
907	Documento Importado	279	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
908	Documento Importado	280	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
909	Documento Importado	281	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
910	Documento Importado	282	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
911	Documento Importado	283	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
912	Documento Importado	284	2018-09-01 02:27:50	2018-09-01 02:27:50	1	Speed
913	Documento Importado	285	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
914	Documento Importado	286	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
915	Documento Importado	287	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
916	Documento Importado	288	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
917	Documento Importado	289	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
918	Documento Importado	290	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
919	Documento Importado	291	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
920	Documento Importado	292	2018-09-01 02:27:51	2018-09-01 02:27:51	1	Speed
921	Documento Importado	293	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
922	Documento Importado	294	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
923	Documento Importado	295	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
924	Documento Importado	296	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
925	Documento Importado	297	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
926	Documento Importado	298	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
927	Documento Importado	299	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
928	Documento Importado	300	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
929	Documento Importado	301	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
930	Documento Importado	302	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
931	Documento Importado	303	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
932	Documento Importado	304	2018-09-01 02:27:52	2018-09-01 02:27:52	1	Speed
933	Documento Importado	305	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
934	Documento Importado	306	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
935	Documento Importado	307	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
936	Documento Importado	308	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
937	Documento Importado	309	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
938	Documento Importado	310	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
939	Documento Importado	311	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
940	Documento Importado	312	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
941	Documento Importado	313	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
942	Documento Importado	314	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
943	Documento Importado	315	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
944	Documento Importado	316	2018-09-01 02:27:53	2018-09-01 02:27:53	1	Speed
945	Documento Importado	317	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
946	Documento Importado	318	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
947	Documento Importado	319	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
948	Documento Importado	320	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
949	Documento Importado	321	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
950	Documento Importado	322	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
951	Documento Importado	323	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
952	Documento Importado	324	2018-09-01 02:27:54	2018-09-01 02:27:54	1	Speed
953	Documento Importado	325	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
954	Documento Importado	326	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
955	Documento Importado	327	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
956	Documento Importado	328	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
957	Documento Importado	329	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
958	Documento Importado	330	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
959	Documento Importado	331	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
960	Documento Importado	332	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
961	Documento Importado	333	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
962	Documento Importado	334	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
963	Documento Importado	335	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
964	Documento Importado	336	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
965	Documento Importado	337	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
966	Documento Importado	338	2018-09-01 02:27:55	2018-09-01 02:27:55	1	Speed
967	Documento Importado	339	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
968	Documento Importado	340	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
969	Documento Importado	341	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
970	Documento Importado	342	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
971	Documento Importado	343	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
972	Documento Importado	344	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
973	Documento Importado	345	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
974	Documento Importado	346	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
975	Documento Importado	347	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
976	Documento Importado	348	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
977	Documento Importado	349	2018-09-01 02:27:56	2018-09-01 02:27:56	1	Speed
978	Documento Importado	350	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
979	Documento Importado	351	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
980	Documento Importado	352	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
981	Documento Importado	353	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
982	Documento Importado	354	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
983	Documento Importado	355	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
984	Documento Importado	356	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
985	Documento Importado	357	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
986	Documento Importado	358	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
987	Documento Importado	359	2018-09-01 02:27:57	2018-09-01 02:27:57	1	Speed
988	Documento Importado	360	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
989	Documento Importado	361	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
990	Documento Importado	362	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
991	Documento Importado	363	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
992	Documento Importado	364	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
993	Documento Importado	365	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
994	Documento Importado	366	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
995	Documento Importado	367	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
996	Documento Importado	368	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
997	Documento Importado	369	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
998	Documento Importado	370	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
999	Documento Importado	371	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
1000	Documento Importado	372	2018-09-01 02:27:58	2018-09-01 02:27:58	1	Speed
1001	Documento Importado	373	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1002	Documento Importado	374	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1003	Documento Importado	375	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1004	Documento Importado	376	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1005	Documento Importado	377	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1006	Documento Importado	378	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1007	Documento Importado	379	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1008	Documento Importado	380	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1009	Documento Importado	381	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1010	Documento Importado	382	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1011	Documento Importado	383	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1012	Documento Importado	384	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1013	Documento Importado	385	2018-09-01 02:27:59	2018-09-01 02:27:59	1	Speed
1014	Documento Importado	386	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1015	Documento Importado	387	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1016	Documento Importado	388	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1017	Documento Importado	389	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1018	Documento Importado	390	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1019	Documento Importado	391	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
1020	Documento Importado	392	2018-09-01 02:28:00	2018-09-01 02:28:00	1	Speed
\.


--
-- Name: historico_documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historico_documento_id_seq', 1020, true);


--
-- Data for Name: historico_formulario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historico_formulario (id, descricao, formulario_id, created_at, updated_at, id_usuario_responsavel, nome_usuario_responsavel) FROM stdin;
13	Emissão	4	2018-08-27 10:09:12	2018-08-27 10:09:12	962	Jessica de Oliveira Magalhaes
14	Em análise pela área de qualidade	4	2018-08-27 10:09:12	2018-08-27 10:09:12	962	Jessica de Oliveira Magalhaes
15	Aprovado pela área de qualidade	4	2018-08-27 10:09:27	2018-08-27 10:09:27	962	Jessica de Oliveira Magalhaes
16	Formulário divulgado	4	2018-08-27 10:09:27	2018-08-27 10:09:27	962	Jessica de Oliveira Magalhaes
17	Emissão	5	2018-08-27 13:30:36	2018-08-27 13:30:36	962	Jessica de Oliveira Magalhaes
18	Em análise pela área de qualidade	5	2018-08-27 13:30:36	2018-08-27 13:30:36	962	Jessica de Oliveira Magalhaes
19	Emissão	6	2018-08-27 13:31:47	2018-08-27 13:31:47	962	Jessica de Oliveira Magalhaes
20	Em análise pela área de qualidade	6	2018-08-27 13:31:47	2018-08-27 13:31:47	962	Jessica de Oliveira Magalhaes
21	Emissão	7	2018-08-27 13:40:53	2018-08-27 13:40:53	916	Gabriel Roberto da Silva
22	Em análise pela área de qualidade	7	2018-08-27 13:40:53	2018-08-27 13:40:53	916	Gabriel Roberto da Silva
23	Emissão	8	2018-08-27 13:45:13	2018-08-27 13:45:13	916	Gabriel Roberto da Silva
24	Em análise pela área de qualidade	8	2018-08-27 13:45:13	2018-08-27 13:45:13	916	Gabriel Roberto da Silva
25	Emissão	9	2018-08-27 13:47:32	2018-08-27 13:47:32	916	Gabriel Roberto da Silva
26	Em análise pela área de qualidade	9	2018-08-27 13:47:32	2018-08-27 13:47:32	916	Gabriel Roberto da Silva
27	Emissão	10	2018-08-28 09:11:18	2018-08-28 09:11:18	916	Gabriel Roberto da Silva
28	Em análise pela área de qualidade	10	2018-08-28 09:11:18	2018-08-28 09:11:18	916	Gabriel Roberto da Silva
29	Emissão	11	2018-08-28 09:12:15	2018-08-28 09:12:15	916	Gabriel Roberto da Silva
30	Em análise pela área de qualidade	11	2018-08-28 09:12:15	2018-08-28 09:12:15	916	Gabriel Roberto da Silva
31	Emissão	12	2018-08-28 09:12:51	2018-08-28 09:12:51	916	Gabriel Roberto da Silva
32	Em análise pela área de qualidade	12	2018-08-28 09:12:51	2018-08-28 09:12:51	916	Gabriel Roberto da Silva
33	Emissão	13	2018-08-28 09:31:24	2018-08-28 09:31:24	916	Gabriel Roberto da Silva
34	Em análise pela área de qualidade	13	2018-08-28 09:31:24	2018-08-28 09:31:24	916	Gabriel Roberto da Silva
35	Emissão	14	2018-08-28 09:41:51	2018-08-28 09:41:51	916	Gabriel Roberto da Silva
36	Em análise pela área de qualidade	14	2018-08-28 09:41:51	2018-08-28 09:41:51	916	Gabriel Roberto da Silva
37	Emissão	15	2018-08-28 09:43:34	2018-08-28 09:43:34	916	Gabriel Roberto da Silva
38	Em análise pela área de qualidade	15	2018-08-28 09:43:34	2018-08-28 09:43:34	916	Gabriel Roberto da Silva
39	Emissão	16	2018-08-28 09:44:45	2018-08-28 09:44:45	916	Gabriel Roberto da Silva
40	Em análise pela área de qualidade	16	2018-08-28 09:44:45	2018-08-28 09:44:45	916	Gabriel Roberto da Silva
41	Emissão	17	2018-08-28 09:46:18	2018-08-28 09:46:18	916	Gabriel Roberto da Silva
42	Em análise pela área de qualidade	17	2018-08-28 09:46:18	2018-08-28 09:46:18	916	Gabriel Roberto da Silva
43	Emissão	18	2018-08-28 10:10:13	2018-08-28 10:10:13	916	Gabriel Roberto da Silva
44	Em análise pela área de qualidade	18	2018-08-28 10:10:13	2018-08-28 10:10:13	916	Gabriel Roberto da Silva
45	Emissão	19	2018-08-28 10:11:00	2018-08-28 10:11:00	916	Gabriel Roberto da Silva
46	Em análise pela área de qualidade	19	2018-08-28 10:11:00	2018-08-28 10:11:00	916	Gabriel Roberto da Silva
47	Emissão	20	2018-08-28 10:12:18	2018-08-28 10:12:18	916	Gabriel Roberto da Silva
48	Em análise pela área de qualidade	20	2018-08-28 10:12:18	2018-08-28 10:12:18	916	Gabriel Roberto da Silva
49	Emissão	21	2018-08-28 10:14:37	2018-08-28 10:14:37	916	Gabriel Roberto da Silva
50	Em análise pela área de qualidade	21	2018-08-28 10:14:37	2018-08-28 10:14:37	916	Gabriel Roberto da Silva
51	Emissão	22	2018-08-28 10:15:09	2018-08-28 10:15:09	916	Gabriel Roberto da Silva
52	Em análise pela área de qualidade	22	2018-08-28 10:15:09	2018-08-28 10:15:09	916	Gabriel Roberto da Silva
53	Emissão	23	2018-08-28 10:15:53	2018-08-28 10:15:53	916	Gabriel Roberto da Silva
54	Em análise pela área de qualidade	23	2018-08-28 10:15:53	2018-08-28 10:15:53	916	Gabriel Roberto da Silva
55	Emissão	24	2018-08-28 10:17:13	2018-08-28 10:17:13	916	Gabriel Roberto da Silva
56	Em análise pela área de qualidade	24	2018-08-28 10:17:13	2018-08-28 10:17:13	916	Gabriel Roberto da Silva
57	Emissão	25	2018-08-28 10:19:56	2018-08-28 10:19:56	916	Gabriel Roberto da Silva
58	Em análise pela área de qualidade	25	2018-08-28 10:19:56	2018-08-28 10:19:56	916	Gabriel Roberto da Silva
59	Emissão	26	2018-08-28 10:20:24	2018-08-28 10:20:24	916	Gabriel Roberto da Silva
60	Em análise pela área de qualidade	26	2018-08-28 10:20:24	2018-08-28 10:20:24	916	Gabriel Roberto da Silva
61	Emissão	27	2018-08-28 10:21:50	2018-08-28 10:21:50	916	Gabriel Roberto da Silva
62	Em análise pela área de qualidade	27	2018-08-28 10:21:50	2018-08-28 10:21:50	916	Gabriel Roberto da Silva
63	Emissão	28	2018-08-28 10:23:06	2018-08-28 10:23:06	916	Gabriel Roberto da Silva
64	Em análise pela área de qualidade	28	2018-08-28 10:23:06	2018-08-28 10:23:06	916	Gabriel Roberto da Silva
65	Emissão	29	2018-08-28 10:23:43	2018-08-28 10:23:43	916	Gabriel Roberto da Silva
66	Em análise pela área de qualidade	29	2018-08-28 10:23:43	2018-08-28 10:23:43	916	Gabriel Roberto da Silva
67	Emissão	30	2018-08-28 10:24:44	2018-08-28 10:24:44	916	Gabriel Roberto da Silva
68	Em análise pela área de qualidade	30	2018-08-28 10:24:44	2018-08-28 10:24:44	916	Gabriel Roberto da Silva
69	Emissão	31	2018-08-28 10:25:17	2018-08-28 10:25:17	916	Gabriel Roberto da Silva
70	Em análise pela área de qualidade	31	2018-08-28 10:25:17	2018-08-28 10:25:17	916	Gabriel Roberto da Silva
71	Emissão	32	2018-08-28 10:25:44	2018-08-28 10:25:44	916	Gabriel Roberto da Silva
72	Em análise pela área de qualidade	32	2018-08-28 10:25:44	2018-08-28 10:25:44	916	Gabriel Roberto da Silva
73	Emissão	33	2018-08-28 10:26:21	2018-08-28 10:26:21	916	Gabriel Roberto da Silva
74	Em análise pela área de qualidade	33	2018-08-28 10:26:21	2018-08-28 10:26:21	916	Gabriel Roberto da Silva
75	Emissão	34	2018-08-28 10:27:14	2018-08-28 10:27:14	916	Gabriel Roberto da Silva
76	Em análise pela área de qualidade	34	2018-08-28 10:27:14	2018-08-28 10:27:14	916	Gabriel Roberto da Silva
77	Emissão	35	2018-08-28 10:28:54	2018-08-28 10:28:54	916	Gabriel Roberto da Silva
78	Em análise pela área de qualidade	35	2018-08-28 10:28:54	2018-08-28 10:28:54	916	Gabriel Roberto da Silva
79	Emissão	36	2018-08-28 10:29:45	2018-08-28 10:29:45	916	Gabriel Roberto da Silva
80	Em análise pela área de qualidade	36	2018-08-28 10:29:45	2018-08-28 10:29:45	916	Gabriel Roberto da Silva
81	Emissão	37	2018-08-28 10:31:38	2018-08-28 10:31:38	916	Gabriel Roberto da Silva
82	Em análise pela área de qualidade	37	2018-08-28 10:31:38	2018-08-28 10:31:38	916	Gabriel Roberto da Silva
83	Emissão	38	2018-08-28 10:36:20	2018-08-28 10:36:20	916	Gabriel Roberto da Silva
84	Em análise pela área de qualidade	38	2018-08-28 10:36:20	2018-08-28 10:36:20	916	Gabriel Roberto da Silva
85	Emissão	39	2018-08-28 10:36:57	2018-08-28 10:36:57	916	Gabriel Roberto da Silva
86	Em análise pela área de qualidade	39	2018-08-28 10:36:57	2018-08-28 10:36:57	916	Gabriel Roberto da Silva
87	Emissão	40	2018-08-28 10:37:32	2018-08-28 10:37:32	916	Gabriel Roberto da Silva
88	Em análise pela área de qualidade	40	2018-08-28 10:37:32	2018-08-28 10:37:32	916	Gabriel Roberto da Silva
89	Emissão	41	2018-08-28 10:38:06	2018-08-28 10:38:06	916	Gabriel Roberto da Silva
90	Em análise pela área de qualidade	41	2018-08-28 10:38:06	2018-08-28 10:38:06	916	Gabriel Roberto da Silva
91	Emissão	42	2018-08-28 10:38:42	2018-08-28 10:38:42	916	Gabriel Roberto da Silva
92	Em análise pela área de qualidade	42	2018-08-28 10:38:42	2018-08-28 10:38:42	916	Gabriel Roberto da Silva
93	Emissão	43	2018-08-28 10:41:08	2018-08-28 10:41:08	916	Gabriel Roberto da Silva
94	Em análise pela área de qualidade	43	2018-08-28 10:41:08	2018-08-28 10:41:08	916	Gabriel Roberto da Silva
95	Emissão	44	2018-08-28 10:41:41	2018-08-28 10:41:41	916	Gabriel Roberto da Silva
96	Em análise pela área de qualidade	44	2018-08-28 10:41:41	2018-08-28 10:41:41	916	Gabriel Roberto da Silva
97	Emissão	45	2018-08-28 10:43:31	2018-08-28 10:43:31	916	Gabriel Roberto da Silva
98	Em análise pela área de qualidade	45	2018-08-28 10:43:31	2018-08-28 10:43:31	916	Gabriel Roberto da Silva
99	Emissão	46	2018-08-28 10:44:43	2018-08-28 10:44:43	916	Gabriel Roberto da Silva
100	Em análise pela área de qualidade	46	2018-08-28 10:44:43	2018-08-28 10:44:43	916	Gabriel Roberto da Silva
101	Emissão	47	2018-08-28 10:45:08	2018-08-28 10:45:08	916	Gabriel Roberto da Silva
102	Em análise pela área de qualidade	47	2018-08-28 10:45:08	2018-08-28 10:45:08	916	Gabriel Roberto da Silva
103	Emissão	48	2018-08-28 10:45:35	2018-08-28 10:45:35	916	Gabriel Roberto da Silva
104	Em análise pela área de qualidade	48	2018-08-28 10:45:35	2018-08-28 10:45:35	916	Gabriel Roberto da Silva
105	Emissão	49	2018-08-28 10:48:03	2018-08-28 10:48:03	916	Gabriel Roberto da Silva
106	Em análise pela área de qualidade	49	2018-08-28 10:48:03	2018-08-28 10:48:03	916	Gabriel Roberto da Silva
107	Emissão	50	2018-08-28 10:48:39	2018-08-28 10:48:39	916	Gabriel Roberto da Silva
108	Em análise pela área de qualidade	50	2018-08-28 10:48:39	2018-08-28 10:48:39	916	Gabriel Roberto da Silva
109	Emissão	51	2018-08-28 11:04:47	2018-08-28 11:04:47	916	Gabriel Roberto da Silva
110	Em análise pela área de qualidade	51	2018-08-28 11:04:47	2018-08-28 11:04:47	916	Gabriel Roberto da Silva
111	Emissão	52	2018-08-28 11:19:02	2018-08-28 11:19:02	916	Gabriel Roberto da Silva
112	Em análise pela área de qualidade	52	2018-08-28 11:19:02	2018-08-28 11:19:02	916	Gabriel Roberto da Silva
113	Emissão	53	2018-08-28 11:20:10	2018-08-28 11:20:10	916	Gabriel Roberto da Silva
114	Em análise pela área de qualidade	53	2018-08-28 11:20:10	2018-08-28 11:20:10	916	Gabriel Roberto da Silva
115	Emissão	54	2018-08-28 11:20:44	2018-08-28 11:20:44	916	Gabriel Roberto da Silva
116	Em análise pela área de qualidade	54	2018-08-28 11:20:44	2018-08-28 11:20:44	916	Gabriel Roberto da Silva
117	Emissão	55	2018-08-28 11:21:23	2018-08-28 11:21:23	916	Gabriel Roberto da Silva
118	Em análise pela área de qualidade	55	2018-08-28 11:21:23	2018-08-28 11:21:23	916	Gabriel Roberto da Silva
119	Emissão	56	2018-08-28 11:22:53	2018-08-28 11:22:53	916	Gabriel Roberto da Silva
120	Em análise pela área de qualidade	56	2018-08-28 11:22:53	2018-08-28 11:22:53	916	Gabriel Roberto da Silva
121	Emissão	57	2018-08-28 11:23:24	2018-08-28 11:23:24	916	Gabriel Roberto da Silva
122	Em análise pela área de qualidade	57	2018-08-28 11:23:24	2018-08-28 11:23:24	916	Gabriel Roberto da Silva
123	Emissão	58	2018-08-28 11:24:49	2018-08-28 11:24:49	916	Gabriel Roberto da Silva
124	Em análise pela área de qualidade	58	2018-08-28 11:24:49	2018-08-28 11:24:49	916	Gabriel Roberto da Silva
125	Emissão	59	2018-08-28 11:25:29	2018-08-28 11:25:29	916	Gabriel Roberto da Silva
126	Em análise pela área de qualidade	59	2018-08-28 11:25:29	2018-08-28 11:25:29	916	Gabriel Roberto da Silva
127	Emissão	60	2018-08-28 11:26:01	2018-08-28 11:26:01	916	Gabriel Roberto da Silva
128	Em análise pela área de qualidade	60	2018-08-28 11:26:01	2018-08-28 11:26:01	916	Gabriel Roberto da Silva
129	Emissão	61	2018-08-28 11:26:49	2018-08-28 11:26:49	916	Gabriel Roberto da Silva
130	Em análise pela área de qualidade	61	2018-08-28 11:26:49	2018-08-28 11:26:49	916	Gabriel Roberto da Silva
131	Emissão	62	2018-08-28 11:28:44	2018-08-28 11:28:44	916	Gabriel Roberto da Silva
132	Em análise pela área de qualidade	62	2018-08-28 11:28:44	2018-08-28 11:28:44	916	Gabriel Roberto da Silva
133	Emissão	63	2018-08-28 11:30:24	2018-08-28 11:30:24	916	Gabriel Roberto da Silva
134	Em análise pela área de qualidade	63	2018-08-28 11:30:24	2018-08-28 11:30:24	916	Gabriel Roberto da Silva
135	Emissão	64	2018-08-28 11:31:44	2018-08-28 11:31:44	916	Gabriel Roberto da Silva
136	Em análise pela área de qualidade	64	2018-08-28 11:31:44	2018-08-28 11:31:44	916	Gabriel Roberto da Silva
137	Emissão	65	2018-08-28 11:34:31	2018-08-28 11:34:31	916	Gabriel Roberto da Silva
138	Em análise pela área de qualidade	65	2018-08-28 11:34:31	2018-08-28 11:34:31	916	Gabriel Roberto da Silva
139	Emissão	66	2018-08-28 11:35:10	2018-08-28 11:35:10	916	Gabriel Roberto da Silva
140	Em análise pela área de qualidade	66	2018-08-28 11:35:10	2018-08-28 11:35:10	916	Gabriel Roberto da Silva
141	Emissão	67	2018-08-28 11:37:27	2018-08-28 11:37:27	916	Gabriel Roberto da Silva
142	Em análise pela área de qualidade	67	2018-08-28 11:37:27	2018-08-28 11:37:27	916	Gabriel Roberto da Silva
143	Emissão	68	2018-08-28 11:38:01	2018-08-28 11:38:01	916	Gabriel Roberto da Silva
144	Em análise pela área de qualidade	68	2018-08-28 11:38:01	2018-08-28 11:38:01	916	Gabriel Roberto da Silva
145	Emissão	69	2018-08-28 11:38:46	2018-08-28 11:38:46	916	Gabriel Roberto da Silva
146	Em análise pela área de qualidade	69	2018-08-28 11:38:46	2018-08-28 11:38:46	916	Gabriel Roberto da Silva
147	Emissão	70	2018-08-28 11:39:22	2018-08-28 11:39:22	916	Gabriel Roberto da Silva
148	Em análise pela área de qualidade	70	2018-08-28 11:39:22	2018-08-28 11:39:22	916	Gabriel Roberto da Silva
149	Emissão	71	2018-08-28 12:20:05	2018-08-28 12:20:05	916	Gabriel Roberto da Silva
150	Em análise pela área de qualidade	71	2018-08-28 12:20:05	2018-08-28 12:20:05	916	Gabriel Roberto da Silva
151	Emissão	72	2018-08-28 12:21:26	2018-08-28 12:21:26	916	Gabriel Roberto da Silva
152	Em análise pela área de qualidade	72	2018-08-28 12:21:26	2018-08-28 12:21:26	916	Gabriel Roberto da Silva
153	Emissão	73	2018-08-28 12:21:58	2018-08-28 12:21:58	916	Gabriel Roberto da Silva
154	Em análise pela área de qualidade	73	2018-08-28 12:21:58	2018-08-28 12:21:58	916	Gabriel Roberto da Silva
155	Emissão	74	2018-08-28 12:22:44	2018-08-28 12:22:44	916	Gabriel Roberto da Silva
156	Em análise pela área de qualidade	74	2018-08-28 12:22:44	2018-08-28 12:22:44	916	Gabriel Roberto da Silva
157	Emissão	75	2018-08-28 12:23:27	2018-08-28 12:23:27	916	Gabriel Roberto da Silva
158	Em análise pela área de qualidade	75	2018-08-28 12:23:27	2018-08-28 12:23:27	916	Gabriel Roberto da Silva
159	Emissão	76	2018-08-28 12:24:28	2018-08-28 12:24:28	916	Gabriel Roberto da Silva
160	Em análise pela área de qualidade	76	2018-08-28 12:24:28	2018-08-28 12:24:28	916	Gabriel Roberto da Silva
161	Emissão	77	2018-08-28 12:28:25	2018-08-28 12:28:25	916	Gabriel Roberto da Silva
162	Em análise pela área de qualidade	77	2018-08-28 12:28:25	2018-08-28 12:28:25	916	Gabriel Roberto da Silva
163	Emissão	78	2018-08-28 12:29:36	2018-08-28 12:29:36	916	Gabriel Roberto da Silva
164	Em análise pela área de qualidade	78	2018-08-28 12:29:36	2018-08-28 12:29:36	916	Gabriel Roberto da Silva
165	Emissão	79	2018-08-28 12:32:25	2018-08-28 12:32:25	916	Gabriel Roberto da Silva
166	Em análise pela área de qualidade	79	2018-08-28 12:32:25	2018-08-28 12:32:25	916	Gabriel Roberto da Silva
167	Emissão	80	2018-08-28 12:38:11	2018-08-28 12:38:11	916	Gabriel Roberto da Silva
168	Em análise pela área de qualidade	80	2018-08-28 12:38:11	2018-08-28 12:38:11	916	Gabriel Roberto da Silva
169	Emissão	81	2018-08-28 12:39:01	2018-08-28 12:39:01	916	Gabriel Roberto da Silva
170	Em análise pela área de qualidade	81	2018-08-28 12:39:01	2018-08-28 12:39:01	916	Gabriel Roberto da Silva
171	Emissão	82	2018-08-28 12:40:20	2018-08-28 12:40:20	916	Gabriel Roberto da Silva
172	Em análise pela área de qualidade	82	2018-08-28 12:40:20	2018-08-28 12:40:20	916	Gabriel Roberto da Silva
173	Emissão	83	2018-08-28 12:40:51	2018-08-28 12:40:51	916	Gabriel Roberto da Silva
174	Em análise pela área de qualidade	83	2018-08-28 12:40:51	2018-08-28 12:40:51	916	Gabriel Roberto da Silva
175	Emissão	84	2018-08-28 12:41:58	2018-08-28 12:41:58	916	Gabriel Roberto da Silva
176	Em análise pela área de qualidade	84	2018-08-28 12:41:58	2018-08-28 12:41:58	916	Gabriel Roberto da Silva
177	Emissão	85	2018-08-28 12:42:35	2018-08-28 12:42:35	916	Gabriel Roberto da Silva
178	Em análise pela área de qualidade	85	2018-08-28 12:42:35	2018-08-28 12:42:35	916	Gabriel Roberto da Silva
179	Emissão	86	2018-08-28 12:43:02	2018-08-28 12:43:02	916	Gabriel Roberto da Silva
180	Em análise pela área de qualidade	86	2018-08-28 12:43:02	2018-08-28 12:43:02	916	Gabriel Roberto da Silva
181	Emissão	87	2018-08-28 12:43:55	2018-08-28 12:43:55	916	Gabriel Roberto da Silva
182	Em análise pela área de qualidade	87	2018-08-28 12:43:55	2018-08-28 12:43:55	916	Gabriel Roberto da Silva
183	Emissão	88	2018-08-28 12:44:30	2018-08-28 12:44:30	916	Gabriel Roberto da Silva
184	Em análise pela área de qualidade	88	2018-08-28 12:44:30	2018-08-28 12:44:30	916	Gabriel Roberto da Silva
185	Emissão	89	2018-08-28 12:44:30	2018-08-28 12:44:30	916	Gabriel Roberto da Silva
186	Em análise pela área de qualidade	89	2018-08-28 12:44:30	2018-08-28 12:44:30	916	Gabriel Roberto da Silva
187	Emissão	90	2018-08-28 14:49:52	2018-08-28 14:49:52	916	Gabriel Roberto da Silva
188	Em análise pela área de qualidade	90	2018-08-28 14:49:52	2018-08-28 14:49:52	916	Gabriel Roberto da Silva
189	Emissão	91	2018-08-28 14:51:12	2018-08-28 14:51:12	916	Gabriel Roberto da Silva
190	Em análise pela área de qualidade	91	2018-08-28 14:51:12	2018-08-28 14:51:12	916	Gabriel Roberto da Silva
191	Emissão	92	2018-08-28 14:51:47	2018-08-28 14:51:47	916	Gabriel Roberto da Silva
192	Em análise pela área de qualidade	92	2018-08-28 14:51:47	2018-08-28 14:51:47	916	Gabriel Roberto da Silva
193	Emissão	93	2018-08-28 14:53:23	2018-08-28 14:53:23	916	Gabriel Roberto da Silva
194	Em análise pela área de qualidade	93	2018-08-28 14:53:23	2018-08-28 14:53:23	916	Gabriel Roberto da Silva
195	Emissão	94	2018-08-28 14:55:06	2018-08-28 14:55:06	916	Gabriel Roberto da Silva
196	Em análise pela área de qualidade	94	2018-08-28 14:55:06	2018-08-28 14:55:06	916	Gabriel Roberto da Silva
197	Emissão	95	2018-08-28 14:57:01	2018-08-28 14:57:01	916	Gabriel Roberto da Silva
198	Em análise pela área de qualidade	95	2018-08-28 14:57:01	2018-08-28 14:57:01	916	Gabriel Roberto da Silva
199	Emissão	96	2018-08-28 14:57:49	2018-08-28 14:57:49	916	Gabriel Roberto da Silva
200	Em análise pela área de qualidade	96	2018-08-28 14:57:49	2018-08-28 14:57:49	916	Gabriel Roberto da Silva
201	Emissão	97	2018-08-28 14:58:47	2018-08-28 14:58:47	916	Gabriel Roberto da Silva
202	Em análise pela área de qualidade	97	2018-08-28 14:58:47	2018-08-28 14:58:47	916	Gabriel Roberto da Silva
203	Emissão	98	2018-08-28 15:00:16	2018-08-28 15:00:16	916	Gabriel Roberto da Silva
204	Em análise pela área de qualidade	98	2018-08-28 15:00:16	2018-08-28 15:00:16	916	Gabriel Roberto da Silva
205	Emissão	99	2018-08-28 15:00:57	2018-08-28 15:00:57	916	Gabriel Roberto da Silva
206	Em análise pela área de qualidade	99	2018-08-28 15:00:57	2018-08-28 15:00:57	916	Gabriel Roberto da Silva
207	Emissão	100	2018-08-28 15:09:28	2018-08-28 15:09:28	916	Gabriel Roberto da Silva
208	Em análise pela área de qualidade	100	2018-08-28 15:09:28	2018-08-28 15:09:28	916	Gabriel Roberto da Silva
209	Emissão	101	2018-08-28 15:12:36	2018-08-28 15:12:36	916	Gabriel Roberto da Silva
210	Em análise pela área de qualidade	101	2018-08-28 15:12:36	2018-08-28 15:12:36	916	Gabriel Roberto da Silva
211	Emissão	102	2018-08-28 15:13:05	2018-08-28 15:13:05	916	Gabriel Roberto da Silva
212	Em análise pela área de qualidade	102	2018-08-28 15:13:05	2018-08-28 15:13:05	916	Gabriel Roberto da Silva
213	Emissão	103	2018-08-28 15:13:56	2018-08-28 15:13:56	916	Gabriel Roberto da Silva
214	Em análise pela área de qualidade	103	2018-08-28 15:13:56	2018-08-28 15:13:56	916	Gabriel Roberto da Silva
215	Emissão	104	2018-08-28 15:16:34	2018-08-28 15:16:34	916	Gabriel Roberto da Silva
216	Em análise pela área de qualidade	104	2018-08-28 15:16:34	2018-08-28 15:16:34	916	Gabriel Roberto da Silva
217	Emissão	105	2018-08-28 15:17:14	2018-08-28 15:17:14	916	Gabriel Roberto da Silva
218	Em análise pela área de qualidade	105	2018-08-28 15:17:14	2018-08-28 15:17:14	916	Gabriel Roberto da Silva
219	Emissão	106	2018-08-28 15:21:32	2018-08-28 15:21:32	916	Gabriel Roberto da Silva
220	Em análise pela área de qualidade	106	2018-08-28 15:21:32	2018-08-28 15:21:32	916	Gabriel Roberto da Silva
221	Emissão	107	2018-08-28 15:22:20	2018-08-28 15:22:20	916	Gabriel Roberto da Silva
222	Em análise pela área de qualidade	107	2018-08-28 15:22:20	2018-08-28 15:22:20	916	Gabriel Roberto da Silva
223	Emissão	108	2018-08-28 15:23:06	2018-08-28 15:23:06	916	Gabriel Roberto da Silva
224	Em análise pela área de qualidade	108	2018-08-28 15:23:06	2018-08-28 15:23:06	916	Gabriel Roberto da Silva
225	Emissão	109	2018-08-28 15:23:55	2018-08-28 15:23:55	916	Gabriel Roberto da Silva
226	Em análise pela área de qualidade	109	2018-08-28 15:23:55	2018-08-28 15:23:55	916	Gabriel Roberto da Silva
227	Emissão	110	2018-08-28 15:24:35	2018-08-28 15:24:35	916	Gabriel Roberto da Silva
228	Em análise pela área de qualidade	110	2018-08-28 15:24:35	2018-08-28 15:24:35	916	Gabriel Roberto da Silva
229	Emissão	111	2018-08-28 15:25:08	2018-08-28 15:25:08	916	Gabriel Roberto da Silva
230	Em análise pela área de qualidade	111	2018-08-28 15:25:08	2018-08-28 15:25:08	916	Gabriel Roberto da Silva
231	Emissão	112	2018-08-28 15:25:42	2018-08-28 15:25:42	916	Gabriel Roberto da Silva
232	Em análise pela área de qualidade	112	2018-08-28 15:25:42	2018-08-28 15:25:42	916	Gabriel Roberto da Silva
233	Emissão	113	2018-08-28 15:26:10	2018-08-28 15:26:10	916	Gabriel Roberto da Silva
234	Em análise pela área de qualidade	113	2018-08-28 15:26:10	2018-08-28 15:26:10	916	Gabriel Roberto da Silva
235	Emissão	114	2018-08-28 15:26:38	2018-08-28 15:26:38	916	Gabriel Roberto da Silva
236	Em análise pela área de qualidade	114	2018-08-28 15:26:38	2018-08-28 15:26:38	916	Gabriel Roberto da Silva
237	Emissão	115	2018-08-28 15:27:16	2018-08-28 15:27:16	916	Gabriel Roberto da Silva
238	Em análise pela área de qualidade	115	2018-08-28 15:27:16	2018-08-28 15:27:16	916	Gabriel Roberto da Silva
239	Emissão	116	2018-08-28 15:28:55	2018-08-28 15:28:55	916	Gabriel Roberto da Silva
240	Em análise pela área de qualidade	116	2018-08-28 15:28:55	2018-08-28 15:28:55	916	Gabriel Roberto da Silva
241	Emissão	117	2018-08-28 15:29:31	2018-08-28 15:29:31	916	Gabriel Roberto da Silva
242	Em análise pela área de qualidade	117	2018-08-28 15:29:31	2018-08-28 15:29:31	916	Gabriel Roberto da Silva
243	Emissão	118	2018-08-28 15:30:00	2018-08-28 15:30:00	916	Gabriel Roberto da Silva
244	Em análise pela área de qualidade	118	2018-08-28 15:30:00	2018-08-28 15:30:00	916	Gabriel Roberto da Silva
245	Emissão	119	2018-08-28 15:30:43	2018-08-28 15:30:43	916	Gabriel Roberto da Silva
246	Em análise pela área de qualidade	119	2018-08-28 15:30:43	2018-08-28 15:30:43	916	Gabriel Roberto da Silva
247	Emissão	120	2018-08-28 15:31:24	2018-08-28 15:31:24	916	Gabriel Roberto da Silva
248	Em análise pela área de qualidade	120	2018-08-28 15:31:24	2018-08-28 15:31:24	916	Gabriel Roberto da Silva
249	Emissão	121	2018-08-28 15:31:57	2018-08-28 15:31:57	916	Gabriel Roberto da Silva
250	Em análise pela área de qualidade	121	2018-08-28 15:31:57	2018-08-28 15:31:57	916	Gabriel Roberto da Silva
251	Emissão	122	2018-08-28 15:32:32	2018-08-28 15:32:32	916	Gabriel Roberto da Silva
252	Em análise pela área de qualidade	122	2018-08-28 15:32:32	2018-08-28 15:32:32	916	Gabriel Roberto da Silva
\.


--
-- Name: historico_formulario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historico_formulario_id_seq', 443, true);


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
1	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535631739	1535631739
2	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535631789	1535631789
3	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535631815	1535631815
4	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-18\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535631825	1535631825
5	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535632044	1535632044
6	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-19\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:26:\\"Samuel Fernandez de Barros\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535632138	1535632138
7	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:519;i:7;i:687;i:8;i:683;i:9;i:728;i:10;i:1171;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:5:\\"Speed\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-11\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535632254	1535632254
8	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;i:7;i:40;i:8;i:193;i:9;i:305;i:10;i:335;i:11;i:331;i:12;i:391;i:13;i:519;i:14;i:687;i:15;i:683;i:16;i:728;i:17;i:1171;i:18;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535632490	1535632490
9	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Otavio de Oliveira Rocha Filho\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535632604	1535632604
10	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-120\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535633311	1535633311
11	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;i:7;i:2;i:8;i:913;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-120\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535633388	1535633388
12	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Anderson Cardoso dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635419	1535635419
13	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635425	1535635425
14	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Alesandra Josefa Rocha Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635428	1535635428
15	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:12:\\"Aline Soares\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635431	1535635431
16	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:32:\\"Raquel Rafaelle Lima De Oliveira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635432	1535635432
17	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:19:\\"Daniel Loren Fabris\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635436	1535635436
18	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Sergio Sampaio Garcia\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635442	1535635442
19	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:20:\\"Erica Gabriela Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635472	1535635472
20	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:817;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento rejeitado\\";s:7:\\"\\u0000*\\u0000icon\\";s:5:\\"error\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi rejeitado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:39:\\"Foram solicitadas mudan\\u00e7as no arquivo.\\";s:10:\\"\\u0000*\\u0000valueF2\\";s:27:\\" Visualize a justificativa!\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:22:\\"Usu\\u00e1rio solicitante: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:19:\\" \\/ Solicitado por: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:15:\\"Setor Qualidade\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635496	1535635496
21	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Mariana Andrade Spyer Lisboa\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635497	1535635497
22	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635527	1535635527
23	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:3:{i:0;N;i:1;N;i:2;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635531	1535635531
24	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:3:{i:0;N;i:1;N;i:2;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635531	1535635531
25	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-003\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635536	1535635536
26	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Alesandra Josefa Rocha Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635540	1535635540
27	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635579	1535635579
28	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635596	1535635596
29	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635612	1535635612
30	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635629	1535635629
31	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635773	1535635773
32	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:962;i:4;i:1;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-10\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:20:\\"Erica Gabriela Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635970	1535635970
33	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535635983	1535635983
34	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636324	1535636324
35	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:5:\\"Speed\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:10:\\"IT-ADM-001\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636405	1535636405
36	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636557	1535636557
37	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Alesandra Josefa Rocha Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636878	1535636878
38	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Alesandra Josefa Rocha Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636919	1535636919
39	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-CMP-002\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535636966	1535636966
40	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637217	1535637217
41	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Sergio Sampaio Garcia\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637222	1535637222
42	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Anderson Cardoso dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637228	1535637228
43	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:12:\\"Aline Soares\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637250	1535637250
44	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-124\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:32:\\"Raquel Rafaelle Lima De Oliveira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637263	1535637263
45	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-124\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Alesandra Josefa Rocha Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637301	1535637301
46	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:20:\\"Erica Gabriela Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637332	1535637332
47	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:18:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:179;i:7;i:503;i:8;i:528;i:9;i:539;i:10;i:661;i:11;i:747;i:12;i:806;i:13;i:915;i:14;i:958;i:15;i:1130;i:16;i:1134;i:17;i:804;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637408	1535637408
48	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:817;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-124\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637472	1535637472
49	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:489;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-124\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637476	1535637476
50	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:851;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637482	1535637482
51	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-CMP-002\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637487	1535637487
52	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:179;i:7;i:503;i:8;i:528;i:9;i:539;i:10;i:661;i:11;i:747;i:12;i:806;i:13;i:915;i:14;i:958;i:15;i:1130;i:16;i:1134;i:17;i:804;i:18;i:772;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637492	1535637492
53	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:511;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637496	1535637496
54	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:8:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-121\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535637500	1535637500
55	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:25:\\"Danilo Moreira dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646343	1535646343
56	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646405	1535646405
57	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646406	1535646406
58	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Stephany Calderaro Milheiro\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646407	1535646407
59	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Gabriel Roberto da Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646407	1535646407
60	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Jonathan Ferreira Soares\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646407	1535646407
61	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Rafael Martins de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646407	1535646407
62	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Roberto Lopes Trimmel\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646411	1535646411
63	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:19:\\"Vanessa Campos Lins\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646412	1535646412
64	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646419	1535646419
65	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646424	1535646424
66	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:7:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;i:6;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646433	1535646433
67	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646447	1535646447
68	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646453	1535646453
69	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646457	1535646457
70	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646467	1535646467
71	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646478	1535646478
72	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646488	1535646488
73	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:25:\\"Danilo Moreira dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646721	1535646721
74	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:25:\\"Danilo Moreira dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646748	1535646748
75	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento rejeitado\\";s:7:\\"\\u0000*\\u0000icon\\";s:5:\\"error\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi rejeitado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:39:\\"Foram solicitadas mudan\\u00e7as no arquivo.\\";s:10:\\"\\u0000*\\u0000valueF2\\";s:27:\\" Visualize a justificativa!\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:22:\\"Usu\\u00e1rio solicitante: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:19:\\" \\/ Solicitado por: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:18:\\"\\u00c1rea de Interesse\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646805	1535646805
76	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646908	1535646908
77	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535646991	1535646991
78	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647002	1535647002
79	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:25:\\"Danilo Moreira dos Santos\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:10:\\"IT-OPE-006\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647125	1535647125
80	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647183	1535647183
81	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:817;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-001\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647208	1535647208
82	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:26:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:661;i:20;i:592;i:21;i:444;i:22;i:806;i:23;i:958;i:24;i:1073;i:25;i:839;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647253	1535647253
83	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Roberto Lopes Trimmel\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:10:\\"IT-OPE-006\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647504	1535647504
84	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647529	1535647529
85	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Rafael Martins de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647573	1535647573
86	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:27:\\"Stephany Calderaro Milheiro\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-20\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647625	1535647625
87	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647635	1535647635
88	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647640	1535647640
89	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647643	1535647643
90	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-20\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647677	1535647677
91	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:22:\\"Rafael Martins de Lima\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-11\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647696	1535647696
92	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:21:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:460;i:20;i:661;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647898	1535647898
93	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:485;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647903	1535647903
94	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:538;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647909	1535647909
95	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647921	1535647921
96	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647941	1535647941
97	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535647946	1535647946
98	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-ADM-004\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648084	1535648084
99	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Gabriel Roberto da Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648171	1535648171
100	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:24:\\"Jonathan Ferreira Soares\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-20\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648302	1535648302
101	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648326	1535648326
102	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Roberto Lopes Trimmel\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648341	1535648341
103	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Rafael Martins de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648376	1535648376
104	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:24:\\"Gabriel Roberto da Silva\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-20\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648386	1535648386
105	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648415	1535648415
106	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648415	1535648415
107	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:19:\\"Vanessa Campos Lins\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-20\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648420	1535648420
108	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-11\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648421	1535648421
109	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-MAN-047\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:12:\\"Manuten\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648681	1535648681
110	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:19:\\"Vanessa Campos Lins\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648727	1535648727
111	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:25:\\"Danilo Moreira dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648728	1535648728
112	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-AMB-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:13:\\"Meio Ambiente\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:34:\\"Natalia Georgia Bezerra dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648729	1535648729
113	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-CDI-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:3:\\"CDI\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648737	1535648737
114	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADU-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:20:\\"Processos Aduaneiros\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Stephany Calderaro Milheiro\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648741	1535648741
115	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-133\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Rafael Martins de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648753	1535648753
116	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Roberto Lopes Trimmel\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648753	1535648753
117	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:200;i:7;i:265;i:8;i:365;i:9;i:543;i:10;i:579;i:11;i:538;i:12;i:646;i:13;i:754;i:14;i:805;i:15;i:946;i:16;i:1117;i:17;i:927;i:18;i:610;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADU-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:20:\\"Processos Aduaneiros\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648755	1535648755
118	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:179;i:7;i:503;i:8;i:528;i:9;i:539;i:10;i:661;i:11;i:747;i:12;i:806;i:13;i:915;i:14;i:958;i:15;i:1130;i:16;i:804;i:17;i:1134;i:18;i:485;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-133\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648760	1535648760
119	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-135\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Jonathan Ferreira Soares\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648764	1535648764
120	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:958;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-135\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648788	1535648788
121	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:11:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:4;i:7;i:129;i:8;i:511;i:9;i:732;i:10;i:817;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-CDI-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:3:\\"CDI\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648795	1535648795
122	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:18:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:179;i:7;i:503;i:8;i:528;i:9;i:539;i:10;i:661;i:11;i:747;i:12;i:806;i:13;i:915;i:14;i:958;i:15;i:1130;i:16;i:804;i:17;i:1134;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648796	1535648796
123	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:412;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648797	1535648797
124	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-055\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Gabriel Roberto da Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648801	1535648801
125	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-055\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648809	1535648809
126	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:10:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:30;i:7;i:509;i:8;i:779;i:9;i:1015;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-AMB-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:13:\\"Meio Ambiente\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535648815	1535648815
127	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:179;i:7;i:503;i:8;i:528;i:9;i:539;i:10;i:661;i:11;i:747;i:12;i:806;i:13;i:915;i:14;i:958;i:15;i:1130;i:16;i:804;i:17;i:1134;i:18;i:460;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-OPE-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:10:\\"Opera\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649022	1535649022
128	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-055\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Gabriel Roberto da Silva\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649065	1535649065
129	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-055\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649086	1535649086
130	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-OPE-006\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649089	1535649089
131	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADU-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:20:\\"Processos Aduaneiros\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Stephany Calderaro Milheiro\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649234	1535649234
132	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:200;i:7;i:265;i:8;i:365;i:9;i:543;i:10;i:579;i:11;i:538;i:12;i:646;i:13;i:754;i:14;i:805;i:15;i:946;i:16;i:1117;i:17;i:927;i:18;i:610;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADU-128\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:20:\\"Processos Aduaneiros\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535649478	1535649478
133	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-137\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535650195	1535650195
134	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:8:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-137\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535650201	1535650201
135	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653840	1535653840
136	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Gilson Santos de Deus\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653840	1535653840
137	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-007\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:26:\\"Milena De Carvalho Taboada\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653840	1535653840
138	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Geovane dos Santos Gomes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653840	1535653840
139	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Giovanna Machado dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653840	1535653840
140	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Silmar Augusto Marques\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653841	1535653841
141	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Paulo Ricardo Alves Cavalcante\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653848	1535653848
142	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Ana Paula Mota Busatti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653859	1535653859
143	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653860	1535653860
144	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:14:\\"Edvandro Sachs\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653863	1535653863
145	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653869	1535653869
146	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:839;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento rejeitado\\";s:7:\\"\\u0000*\\u0000icon\\";s:5:\\"error\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi rejeitado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:39:\\"Foram solicitadas mudan\\u00e7as no arquivo.\\";s:10:\\"\\u0000*\\u0000valueF2\\";s:27:\\" Visualize a justificativa!\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:22:\\"Usu\\u00e1rio solicitante: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:19:\\" \\/ Solicitado por: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:15:\\"Setor Qualidade\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653889	1535653889
147	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653905	1535653905
148	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653923	1535653923
149	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653954	1535653954
150	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Ana Paula Mota Busatti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535653984	1535653984
151	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654033	1535654033
152	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654037	1535654037
153	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654041	1535654041
154	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654044	1535654044
155	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654055	1535654055
156	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654059	1535654059
157	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-007\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654103	1535654103
158	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654114	1535654114
159	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654133	1535654133
160	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654152	1535654152
161	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654163	1535654163
162	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-007\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654469	1535654469
163	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654544	1535654544
164	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654572	1535654572
165	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654603	1535654603
166	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:26:\\"Milena De Carvalho Taboada\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:10:\\"IT-SOC-007\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654633	1535654633
167	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:27:\\"Giovanna Machado dos Santos\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654958	1535654958
168	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Gilson Santos de Deus\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654960	1535654960
169	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:24:\\"Geovane dos Santos Gomes\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654960	1535654960
170	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:22:\\"Silmar Augusto Marques\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654960	1535654960
171	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:30:\\"Paulo Ricardo Alves Cavalcante\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535654974	1535654974
172	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Edvandro Sachs\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655009	1535655009
173	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:937;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655018	1535655018
174	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:1130;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655022	1535655022
175	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:881;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655027	1535655027
176	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:45;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"IT-SOC-007\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:6:\\"Sa\\u00fade\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655034	1535655034
177	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:539;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655037	1535655037
178	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:92;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655044	1535655044
179	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655102	1535655102
180	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:934;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655105	1535655105
181	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:958;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655108	1535655108
182	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:412;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-20\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655126	1535655126
183	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:22:\\"Ana Paula Mota Busatti\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-27\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655263	1535655263
184	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:20:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;i:19;i:839;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-27\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655273	1535655273
185	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:5:\\"Speed\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:9:\\"IT-ADM-12\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655442	1535655442
186	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:687;i:13;i:683;i:14;i:728;i:15;i:962;i:16;i:1171;i:17;i:519;i:18;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655451	1535655451
187	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Geovane dos Santos Gomes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655749	1535655749
188	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:9:\\"IT-ADM-12\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Instru\\u00e7\\u00e3o de Trabalho\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:14:\\"Edvandro Sachs\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655842	1535655842
189	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655965	1535655965
190	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:21:\\"Gilson Santos de Deus\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655965	1535655965
191	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:27:\\"Giovanna Machado dos Santos\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655966	1535655966
192	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:26:\\"Milena De Carvalho Taboada\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655966	1535655966
193	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:14:\\"Edvandro Sachs\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655968	1535655968
194	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Paulo Ricardo Alves Cavalcante\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655968	1535655968
195	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-MAN-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:12:\\"Manuten\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Geovane dos Santos Gomes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535655971	1535655971
196	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:15:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:195;i:7;i:473;i:8;i:580;i:9;i:592;i:10;i:848;i:11;i:842;i:12;i:924;i:13;i:937;i:14;i:1027;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-MAN-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:12:\\"Manuten\\u00e7\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:8:\\"Restrito\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535656016	1535656016
197	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-145\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Ana Paula Mota Busatti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535656023	1535656023
198	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:1130;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-138\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535656024	1535656024
199	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:9:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;i:8;i:839;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-145\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535656027	1535656027
200	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Carolina de Alencar Siqueira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535714874	1535714874
201	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Carolina de Alencar Siqueira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535714997	1535714997
202	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Juliana Moura de Sousa\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715009	1535715009
203	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:31:\\"Daniely Campelo da Silva Mendes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715011	1535715011
204	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715012	1535715012
205	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Nayara Barriento Raia Ferreira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715013	1535715013
206	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715031	1535715031
207	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Danilo Mendon\\u00e7a de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715033	1535715033
208	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:7:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:962;i:5;i:32;i:6;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:23:\\"Dominique Nat\\u00e1lia Osti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715033	1535715033
209	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715035	1535715035
210	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715040	1535715040
211	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715046	1535715046
212	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715059	1535715059
213	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715066	1535715066
214	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715074	1535715074
215	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715339	1535715339
216	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715343	1535715343
217	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715357	1535715357
218	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715368	1535715368
219	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715376	1535715376
220	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715377	1535715377
221	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715416	1535715416
222	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:22:\\"Juliana Moura de Sousa\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715629	1535715629
223	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:13:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:962;i:10;i:1171;i:11;i:519;i:12;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:24:\\"Danilo Mendon\\u00e7a de Lima\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715671	1535715671
224	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:23:\\"Dominique Nat\\u00e1lia Osti\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715714	1535715714
225	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715734	1535715734
226	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:28:\\"Carolina de Alencar Siqueira\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715752	1535715752
227	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:687;i:7;i:683;i:8;i:728;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:28:\\"Carolina de Alencar Siqueira\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715786	1535715786
244	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716639	1535716639
228	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:683;i:7;i:728;i:8;i:962;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:31:\\"Daniely Campelo da Silva Mendes\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715866	1535715866
229	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:600;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715973	1535715973
230	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:687;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715978	1535715978
231	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:1073;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715988	1535715988
232	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:683;i:7;i:728;i:8;i:962;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:30:\\"Nayara Barriento Raia Ferreira\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715993	1535715993
233	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:18:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535715994	1535715994
234	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:35;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716024	1535716024
235	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:600;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716051	1535716051
236	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:19:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;i:18;i:662;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716058	1535716058
237	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:29:\\"Jessica de Oliveira Magalhaes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716126	1535716126
238	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:11:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:683;i:7;i:728;i:8;i:1171;i:9;i:519;i:10;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:5:\\"Speed\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716168	1535716168
239	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:1:{i:0;i:1;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:28:\\"Lista de presen\\u00e7a rejeitada\\";s:7:\\"\\u0000*\\u0000icon\\";s:5:\\"error\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:21:\\"A lista de presen\\u00e7a \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:14:\\"foi rejeitada.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:39:\\"A rejei\\u00e7\\u00e3o foi realizada pelo setor: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:7:\\"Pessoas\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716260	1535716260
240	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:12:{i:0;i:40;i:1;i:193;i:2;i:305;i:3;i:335;i:4;i:331;i:5;i:391;i:6;i:683;i:7;i:728;i:8;i:962;i:9;i:1171;i:10;i:519;i:11;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:40:\\"Nova lista de presen\\u00e7a para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:20:\\"A lista de presen\\u00e7a\\";s:9:\\"\\u0000*\\u0000codeF1\\";s:0:\\"\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:25:\\"Elaborador do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:5:\\"Speed\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:43:\\"Lista de presen\\u00e7a vinculada ao documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"DG-28\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716310	1535716310
241	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:18:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:40;i:7;i:193;i:8;i:305;i:9;i:335;i:10;i:331;i:11;i:391;i:12;i:683;i:13;i:728;i:14;i:962;i:15;i:1171;i:16;i:519;i:17;i:1166;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:19:\\"Documento divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:20:\\"Setor do documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:31:\\"N\\u00edvel de acesso do documento: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:22:\\" \\/ Tipo do documento: \\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716337	1535716337
242	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Carolina de Alencar Siqueira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716600	1535716600
243	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Nayara Barriento Raia Ferreira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716630	1535716630
245	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716647	1535716647
246	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:26:\\"App\\\\AreaInteresseDocumento\\";s:2:\\"id\\";a:1:{i:0;N;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Nayara Barriento Raia Ferreira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716662	1535716662
247	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:31:\\"Novo documento para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:12:\\"O documento \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:5:\\"DG-28\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:19:\\"Tipo do Documento: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:21:\\"Diretrizes de Gest\\u00e3o\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:23:\\"Dominique Nat\\u00e1lia Osti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535716908	1535716908
248	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-SEP-146\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:22:\\"Seguran\\u00e7a Patrimonial\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:28:\\"Carolina de Alencar Siqueira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717067	1535717067
249	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ARM-147\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:9:\\"Armadores\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:22:\\"Juliana Moura de Sousa\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717093	1535717093
250	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-147\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:30:\\"Nayara Barriento Raia Ferreira\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717097	1535717097
251	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ADM-146\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:14:\\"Administrativo\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:31:\\"Daniely Campelo da Silva Mendes\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717098	1535717098
252	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ARM-146\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:9:\\"Armadores\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Speed\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717108	1535717108
253	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-PRJ-146\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:8:\\"Projetos\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:24:\\"Danilo Mendon\\u00e7a de Lima\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717130	1535717130
254	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:6:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:33:\\"Novo formul\\u00e1rio para aprova\\u00e7\\u00e3o\\";s:7:\\"\\u0000*\\u0000icon\\";s:4:\\"info\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-PRJ-152\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:17:\\" requer an\\u00e1lise.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:8:\\"Projetos\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:13:\\"Enviado por: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:23:\\"Dominique Nat\\u00e1lia Osti\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717153	1535717153
255	default	{"displayName":"App\\\\Jobs\\\\SendEmailsJob","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"timeoutAt":null,"data":{"commandName":"App\\\\Jobs\\\\SendEmailsJob","command":"O:22:\\"App\\\\Jobs\\\\SendEmailsJob\\":19:{s:16:\\"\\u0000*\\u0000destinatarios\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":3:{s:5:\\"class\\";s:8:\\"App\\\\User\\";s:2:\\"id\\";a:8:{i:0;i:10;i:1;i:846;i:2;i:916;i:3;i:1;i:4;i:32;i:5;i:690;i:6;i:2;i:7;i:913;}s:10:\\"connection\\";s:5:\\"pgsql\\";}s:10:\\"\\u0000*\\u0000assunto\\";s:21:\\"Formul\\u00e1rio divulgado\\";s:7:\\"\\u0000*\\u0000icon\\";s:7:\\"success\\";s:15:\\"\\u0000*\\u0000contentF1_P1\\";s:14:\\"O formul\\u00e1rio \\";s:9:\\"\\u0000*\\u0000codeF1\\";s:10:\\"FR-ARM-146\\";s:15:\\"\\u0000*\\u0000contentF1_P2\\";s:15:\\" foi divulgado.\\";s:10:\\"\\u0000*\\u0000labelF2\\";s:22:\\"Setor do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF2\\";s:9:\\"Armadores\\";s:10:\\"\\u0000*\\u0000labelF3\\";s:33:\\"N\\u00edvel de acesso do formul\\u00e1rio: \\";s:10:\\"\\u0000*\\u0000valueF3\\";s:5:\\"Livre\\";s:12:\\"\\u0000*\\u0000label2_F3\\";s:0:\\"\\";s:12:\\"\\u0000*\\u0000value2_F3\\";s:0:\\"\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:15:\\"chainConnection\\";N;s:10:\\"chainQueue\\";N;s:5:\\"delay\\";N;s:7:\\"chained\\";a:0:{}}"}}	0	\N	1535717173	1535717173
\.


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 255, true);


--
-- Data for Name: lista_presenca; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lista_presenca (id, nome, extensao, data, descricao, documento_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: lista_presenca_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lista_presenca_id_seq', 36, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
151	2018_08_06_153415_alter_historico_documento_table	2
152	2018_08_06_153446_alter_historico_formulario_table	2
153	2018_08_07_092128_create_documento_observacao_table	2
154	2018_08_10_093008_alter_dados_documento_table	3
155	2018_08_14_090316_alter_dados_documento_add_columns_cancelar_revisao_table	4
156	2018_08_15_135220_create_anexo_table	5
157	2018_08_16_135546_create_formulario_revisao_table	6
158	2018_08_16_145838_alter_formulario_add_columns_revisao_table	6
159	2018_08_27_100448_create_jobs_table	7
160	2018_08_27_145906_create_failed_jobs_table	7
128	2014_06_28_163844_create_tipo_setor_table	1
129	2014_06_28_163857_create_setor_table	1
130	2014_10_12_000000_create_users_table	1
131	2014_10_12_100000_create_password_resets_table	1
132	2018_06_28_163901_create_grupo_divulgacao_table	1
133	2018_06_28_163902_create_grupo_divulgacao_usuario_table	1
134	2018_06_28_163903_create_grupo_treinamento_table	1
135	2018_06_28_163904_create_grupo_treinamento_usuario_table	1
136	2018_06_28_163908_create_tipo_documento_table	1
137	2018_06_28_163909_create_documento_table	1
138	2018_06_28_163918_create_dados_documento_table	1
139	2018_06_28_163938_create_workflow_table	1
140	2018_06_28_164014_create_lista_presenca_table	1
141	2018_07_13_104549_create_configuracao_table	1
142	2018_07_14_155624_create_grupo_area_interesse_documento_table	1
143	2018_07_21_042324_create_notificacao_table	1
144	2018_07_21_045450_create_formulario_table	1
145	2018_07_21_050245_create_documento_formulario_table	1
146	2018_07_21_050537_create_workflow_formulario_table	1
147	2018_07_30_112211_create_historico_formulario_table	1
148	2018_07_30_112236_create_historico_documento_table	1
149	2018_07_30_170608_create_notificacao_formulario_table	1
150	2018_08_03_004230_create_aprovador_setor_table	1
161	2018_08_27_154421_alter_formulario_add_columns_tornar_obsoleto_table	8
162	2018_08_27_154605_alter_dados_documento_add_columns_tornar_obsoleto_table	8
\.


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 162, true);


--
-- Data for Name: notificacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notificacao (id, texto, visualizada, necessita_interacao, usuario_id, documento_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: notificacao_formulario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notificacao_formulario (id, texto, visualizada, necessita_interacao, usuario_id, formulario_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: notificacao_formulario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notificacao_formulario_id_seq', 3516, true);


--
-- Name: notificacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notificacao_id_seq', 39502, true);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: setor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.setor (id, nome, sigla, descricao, tipo_setor_id, created_at, updated_at) FROM stdin;
1	Qualidade	QUA	Responsável por garantir o cumprimento das políticas da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
2	Administrativo	ADM	Responsável pelo controle de receitas e despesas e pelo gerenciamento das tarefas e rotinas da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
3	Armadores	ARM	Responsável por gerenciar as embarcações.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
4	CDI	CDI	Responsável por garantir a segurança empresarial, possibilitando a padronização de processos e o fluxo de informações.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
5	Compras	CMP	Responsável pelo estabelecimento dos fluxos dos materiais da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
6	Comercial	COM	Responsável direto pelos ganhos da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
7	Comunicação	COC	Responsável em manter informado todos os colaborades da empresa, parceiros e prestadores de serviço.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
8	Controladoria	COT	Responsável pela organização, avaliação e armazenamento das informações da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
9	Financeiro	FIN	Responsável por administrar os recursos da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
10	Jurídico	JUR	Responsável em orientar os assuntos jurídicos da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
11	Manutenção	MAN	Responsável em realizar serviços para conservação da infraestrutura da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
12	Meio Ambiente	AMB	Responsável por desenvolver métodos e ações, pautando-se nas noções de sustentabilidade e responsabilidade socioambiental.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
13	Operação	OPE	Responsável pelo planejamento, implantação e manutenação de toda a infraestrutura da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
15	Processos Aduaneiros	ADU	Responsável pelas importações e exportações da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
16	Projetos	PRJ	Responsável em planejar, controlar e executar os projetos da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
17	Saúde	SOC	Responsável por orientar e previnir a saúde dos colaboradores.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
18	Segurança do Trabalho	SET	Responsável em traçar e implantar meios de projeger o colaborador de possíveis acidentes de trabalho.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
19	Segurança Patrimonial	SEP	Responsável por prevenir e reduzir perdas patrimoniais na empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
20	Tecnologia da Informação	TEC	Responsável por gerenciar as informações da empresa.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
21	Transporte	TRP	Responsável em atuar com a rotina de operação de transporte.	1	2018-08-06 13:25:38	2018-08-06 13:25:38
22	Sem Setor	SS	Setor criado para vincular usuários que acabaram de ser importados do AD.	1	2018-08-15 09:29:06	2018-08-15 09:29:06
14	Pessoas	P&O	Responsável por potencializar o capital humano.	1	2018-08-06 13:25:38	2018-08-28 12:08:04
23	Diretores e Gerentes	DIR	DPW	1	2018-08-28 16:08:24	2018-08-28 16:08:24
\.


--
-- Name: setor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.setor_id_seq', 23, true);


--
-- Data for Name: tipo_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_documento (id, nome_tipo, sigla, created_at, updated_at) FROM stdin;
1	Instrução de Trabalho	IT	2018-08-06 13:25:38	2018-08-06 13:25:38
2	Procedimentos de Gestão	PG	2018-08-06 13:25:38	2018-08-06 13:25:38
3	Diretrizes de Gestão	DG	2018-08-06 13:25:38	2018-08-06 13:25:38
4	Formulários	FR	2018-08-06 13:25:38	2018-08-06 13:25:38
\.


--
-- Name: tipo_documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_documento_id_seq', 4, true);


--
-- Data for Name: tipo_setor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_setor (id, nome, created_at, updated_at) FROM stdin;
1	Setor da Empresa	2018-08-06 13:25:38	2018-08-06 13:25:38
2	Diretoria	2018-08-06 13:25:38	2018-08-06 13:25:38
3	Gerência	2018-08-06 13:25:38	2018-08-06 13:25:38
\.


--
-- Name: tipo_setor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_setor_id_seq', 3, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, username, email, password, remember_token, setor_id, created_at, updated_at) FROM stdin;
3	Natalia Sobrinho dos Santos	natalia.sobrinho	natalia.sobrinho@embraport.com	$2y$10$ky091N/VEA7Y4NTQE3QI2u3ONmUHk3.AchQ91MPfHlLEsWJqmKEaO	\N	22	2018-08-06 13:28:38	2018-08-16 08:40:34
5	Nathaly Ferreira Nunes	nathaly.nunes	nathaly.nunes@embraport.net	$2y$10$YX/MyWDAxSoLgE7Tte9GQeO5VAjBBGVu27PW7rjcfC/Fs3vKdOspu	\N	22	2018-08-06 13:28:38	2018-08-16 08:40:34
30	Nickole Carvalho Rodrigues	nickole	nickole@embraport.com	$2y$10$8vBtwra1nYLcvJkdkKEiyOyyLAHIpmFkU8nmrJ2swRk8Y5swhOnFO	\N	12	2018-08-06 13:28:40	2018-08-14 15:28:08
7	Nathalia Reis	nathalia.reis	nathalia.reis@embraport.com	$2y$10$tqNIVJDnuXylWpIEsNJmNOeedu.lrphGJoSjD69NpW6bEMrjMY7mq	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
4	Nathiely Santana de Lima Rodrigues	nathielylima	nathielylima@embraport.com	$2y$10$iWi47Epk56Lq1/23MwpGeetRhK9ZUyuEV1RqNCsq9qhRPgj18rr7.	\N	8	2018-08-06 13:28:38	2018-08-14 14:34:16
8	Natasha Ivanovitch Viana	natasha.viana	natasha.viana@embraport.net	$2y$10$ae0Lb8/0AkbXjB9UxGm9mORGczul7y4w/AuhyL1VmjU2Ym0DlinXC	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
9	Natalia Garcia Gonçalves	nataliagarcia	nataliagarcia@embraport.com	$2y$10$hytoaV0tAk.LvjxpQ.lSluM/hg7h.J.xB4Fi300w6M1sFrt/TZ50S	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
11	navis-qa	navis-qa	navis-qa@embraport.net	$2y$10$/ZaY7I8tK5KFCMK.IJa4lOMiFVQJZdzMPwoQH6xX1XsExmXCTt1Di	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
6	Anne Nathalie Luz	nathalie	nathalie@embraport.com	$2y$10$fc.2PBRWtBnBFmLbPFJJXuvbcv73mgaVz9s5XRNIpcWNys83AKugy	\N	5	2018-08-06 13:28:39	2018-08-14 14:27:14
12	Naiade de Oliveira Salem	naiadesalem	naiadesalem@embraport.com	$2y$10$jIimcSCb3M.S5aLc1Q/47.0yGZkNC3U9CJdHpcsjoyC79F4a6nBfO	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
13	mxintadm	mxintadm	mxintadm@embraport.net	$2y$10$KevvV5v1tHkAhTJyzs8xluWycKzUwT/0wAlryy.h7S83l5Z0GLzMC	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
14	Marcelo Willian Souza de Lima	mwlima	mwlima@embraport.com	$2y$10$lYljbWd1Fm8nb3e2D87OiO/DOQmzVGOrZJppBx0S1HfxKZWSWkqCS	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
15	Marcus Trindade Asse	mtrindade	mtrindade@embraport.net	$2y$10$4p.YQ1du9GFd6KQDt.aloujF4/9gc9ni5eBU25B8cc3d3XECtPtY6	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
16	Mayara de Alcantara Tibagy	mtibagy	mtibagy@embraport.net	$2y$10$iHT1Sq2pPibQP4xTZhIqPuH9tEvCmPD4caHGdep/j7qeRO96w7l/2	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
10	Natalia Georgia Bezerra dos Santos	natalia.bezerra	natalia.bezerra@embraport.com	$2y$10$ySCWBhMRYVY94q1D5yNcQ.E2d3B6acIeJeAnPtHIvM2x1axVkHsAO	PWHgfw0WZlNcJAU9oMlA3LYwXM1Ou25qfmCHwBJNlDwKCKPeRp4DQghcC8P2	1	2018-08-06 13:28:39	2018-08-28 11:51:40
18	navis-dev	navis-dev	navis-dev@embraport.net	$2y$10$uR2hk27Cn/t.hjZHjtxwn.tgSMQ8Y/3ksdpatbEPN8RsxDYIHrrNe	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
19	navis	navis	navis@embraport.net	$2y$10$NDypI7fAQMVr9OL0DRIka.kaT5IkBr3fLoLKbo4jTsPcLT/WUI0Xy	\N	22	2018-08-06 13:28:39	2018-08-16 08:40:34
20	Marina Salvador de lima	msalvador	msalvador@embraport.net	$2y$10$EU1RnR4WRJ7d5V8VQpswOu4/UlCRjA1IAAp1vKZ0VPA44SMaSJ1vK	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
21	NineCon User	ninecon_adm	ninecon_adm@embraport.net	$2y$10$A8PQd934nklEqMIJXa2MD.E31FhtGtNR/QPvrpv1S/97hMlNC93/K	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
22	noreplyposvendas	noreplyposvendas	noreplyposvendas@embraport.net	$2y$10$Y5fko8YzFtKXY.z/m/CJ1etLuS2ljyMwQhGiMDQMKEm.pmykVNYmC	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
23	noreply_segurancapatrimonial	noreply_segpat	noreply_segurancapatrimonial@embraport.net	$2y$10$feda0KHDnGBfCQ28ubtEEuk5.Z61jbmfJc9/4qeITfbw3ow4R95ua	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
25	noreply	noreply	noreply@embraport.net	$2y$10$7AnDc3gtXh4P9QZjZ3AcbeF39s2K1GTKOhwMjxP6nCOLCj3JxA2Im	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
26	Noreply comunicadoInfração	noreply-comunicado.i	noreply-comunicado.infracao@embraport.net	$2y$10$JCsKTbxQdRAZWacBJzN04Og3yZ9jLcfOB2FUoeMg58RfNMFFiRzs6	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
27	Natassia Massote	nmassote	nmassote@embraport.net	$2y$10$/58yvycUaM1vt8yQAmq2F.CP9w9iG//V1YdEOxePpnPnveTj5FSt2	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
28	Nilton Carlos Pereira dos Santos	nilton.pereira	nilton.pereira@embraport.com	$2y$10$He3Mda9/XkRn1nV05ANXOOHAwNMGxCR10zip3w0zwn3ADTz/2PzES	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
29	Navis Test	navistest	navistest@embraport.net	$2y$10$vV9bI4h3tuBFiYR4SzmFI.WOGq2/F4RgPXFP4DIqTJV0xcw4JPcXy	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
31	Nicholas Junior Severiano de Mattos	nicholas.mattos	nicholas.mattos@embraport.com	$2y$10$byTb2qJqwVqoOBNv2fJVquKlv7InHtU32lNe6N/LI3lCN/0p13EAS	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
45	Milena De Carvalho Taboada	milena.taboada	milena.taboada@embraport.com	$2y$10$ilcG3yPPDfleIYQCEMUhTeeXMY3P4eY7RIb5UOQ2oze9Q8pYvmWFq	NOMDeia760RubVfG4Vj79dqSNwmwTmw0mIkAgrkuCnCe254Tie3WoNmqifZp	17	2018-08-06 13:28:41	2018-08-28 12:37:15
33	Nilson Luis de Freitas Santos	nfreitas	nfreitas@embraport.com	$2y$10$ktkMUiUZlhBmWdvtOfPoC.YcnU8Vi3RXkzio4ZlV0sK8s9HCzd9xO	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:34
34	Nelson Lopes Amancio Junior	nelson.junior	nelson.junior@embraport.net	$2y$10$5DlxF5Qj9zVabZVrOWQ52uowLHizOjtmaCMyjYxSOh4wyMVSpeuHC	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
44	Milton Mazzo Junior	milton.mazzo	milton.mazzo@embraport.com	$2y$10$kewee19FCO/JIw.Q.V4x1e/EsYqg83KXts6OSJMkR4jWuOCr8/wri	\N	23	2018-08-06 13:28:41	2018-08-28 16:09:27
36	Marcos Santos Melo	msantos	msantos@embraport.net	$2y$10$pD1CercQzzcOa6DZmLlm3u/COyegleFm9kO4D4vD8Dq5v5I3SgL6W	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
37	Manoel Victor Vieira Sales	msales	msales@embraport.com	$2y$10$Ou/6J4BWddxnfntq//h4n.wA0ejy42JDdavYT7EiKtaZoTxTsQEdu	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
38	Caroline Zanon de Faria	npo.caroline	npo.caroline@embraport.net	$2y$10$t21OrG3UqUbJXPnjUzXHgeZWHTNet.To41WiNaWi/FwWywRNfDrFu	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
39	Mila de Almeida Ladeia	milaladeia	milaladeia@embraport.com	$2y$10$idUAnc86ZSVSLUFwhknCROF5aNnMlDWTGlMSHxILncF4QHEn9UnDi	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
35	Nayara Barriento Raia Ferreira	nayara.ferreira	nayara.ferreira@embraport.com	$2y$10$SIu2EEPlPeXY776zyPTIl.ropxGMYSAxtbwrVmPv/x3.vgfOWgeRi	gcktuK0yZkFmeDM4W4Wy50RTINP8Fj9FHpl6KfhAWFMzCncHycB5OmlQHc4z	19	2018-08-06 13:28:41	2018-08-28 14:45:24
41	Marcos Lisboa	mlisboa	mlisboa@embraport.net	$2y$10$oDXhKRlZZunc..3ADPJ7buaVzxiLaP5ej6CYzbnGGLZ0gVpQIMO3m	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
42	Misael Messias Da Silva Franca	misael.franca	misael.franca@embraport.net	$2y$10$Fbl47DmYI46m1OFSPEFwGejMPn1nVWKBl1NUze7jRlF6JKK43dqiy	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
43	Miro Banovic	miro.banovic	miro.banovic@embraport.net	$2y$10$IAv.6vAgzbMlBLoPAy9BbuWfRCmRrlutK88t5NoaRjCXebcc.f.2S	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
2	Amanda dos Santos Almeida	aalmeida	aalmeida@embraport.com	$2y$10$.GHQA7Gbt0EjA49CQZ4LR.RWAj2lLjawNN5.hrReqQysB/51O.3YG	\N	2	2018-08-06 13:28:38	2018-08-28 08:22:09
40	Michel Santana de Macedo	mmacedo	mmacedo@embraport.com	$2y$10$hJ/5YX5m5xrtbxMogMmQK.A9I296BVTBlZJjYXBxUq6UwzC/cbZH6	\N	14	2018-08-06 13:28:41	2018-08-28 12:05:43
47	Maycon de Oliveira Morais	mmorais	mmorais@embraport.net	$2y$10$ukPZMVKblpkwO/jcKMEop.a.xwRmF7wWz6zCe53nPMeCmtZf.TQBW	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
48	Michel Mor Goncalves	michel.goncalves	michel.goncalves@embraport.com	$2y$10$HH/8tzNnddpE0./UfzAb3OHUe0cx7xIzGdbPi/f2STVz4T7X6SkTi	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
49	Marco Hutter	mhutter	mhutter@embraport.com	$2y$10$JSLMPExU1uM2Dd/15yrbDOMoHHUERxp86IFjzTBS0x2pn57DXPdqW	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
50	Marcelo Gustavo de O. Souza	mgsouza	mgsouza@embraport.net	$2y$10$PQXAvCdA7xesYisSZkwCLehS2AUSMaK1LoOXZgueVlrhfIuzTbXee	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
51	Marcos Willian Lavor Grunfeldt	mgrunfeldt	mgrunfeldt@embraport.com	$2y$10$4Dm9YWo1XznMQ8Rq1g373ertwscvMFB1iCJFhHJuANHBy20VdMSjq	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
52	Master Food	mfood	mfood@embraport.net	$2y$10$GSupYWjJkQ1MqONKhzYGue0NJuL.vzoHh.c6Y7ZiPmT.7cgRvmopy	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
53	Maiana Fernandes do Nascimento	mfnascimento	mfnascimento@embraport.com	$2y$10$KQVBGNQlxcFKh2xfBdyk1eQ396SfHfSSTor2yOoyPtWIbDcAdbcDm	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
54	Mônica Borges Moia	mmoia	mmoia@embraport.net	$2y$10$lEmJWoD9GMMuilzSjhwoE.ScD0WGp/U.e1UPLbVme/aik7IPOipeG	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
55	Monica Silva Nunes	mnunes	mnunes@embraport.com	$2y$10$jZ0ujiJNKIfWjDL/jgQz/uxeXPNy5UVRf4.x68GxCfGZLfBSOWe6S	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
56	Michele Raquel dos Santos	mrsantos	mrsantos@embraport.net	$2y$10$6.B7eY.ZqumtHoF1dMB77eyatbXzJV3BqS7zk1M3AB3wnhdwsn.bC	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
57	monitor	monitor	monitor@embraport.com	$2y$10$dhqsR7DuHObJyOG3qWJVIudCwMAafOOlnwMCLqDKW/1Aq7yFmdwFW	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
58	Monique Camelo Reiners Moreira	mreiners	mreiners@embraport.com	$2y$10$/9cJ/YdTtNorFg5.CaGJduDSRYJw1.MQt53yzXYSy6JfFXNXI8vBy	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
60	Sala Monte Cabrao	montecabrao	montecabrao@embraport.com	$2y$10$r5BYJgSI0BjnRdov1w8yne/zwJxMIza65AI1BH.aC0hP4GQNkIqVG	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
61	Monitor Cross Docking	monitorcrossdocking	monitorcrossdocking@embraport.net	$2y$10$1BJ/.aiHDvklKfKtClSVAOdHEmCWlSwsW7HOOD/ApQvxT9yhOwF.W	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:34
62	Monitoracao SCCM e SCOM	monitoracao	monitoracao@embraport.net	$2y$10$rSNLmJfwqs8uNhiEJVk0Y.Z6ZRpJ9rnz3WuqjmtT5NB0c4Z09M4e.	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
63	Monitora Navios	monitora_navios	monitora_navios@embraport.net	$2y$10$QIE3.N1dx7Xx78jAUSINwO0456HYI4c.T1HDXTWU18JVw1ujm1YW2	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
64	Monique Martins Gaiato	monique.gaiato	monique.gaiato@embraport.com	$2y$10$Tb/r4FWbLTVM1SaMvFzeG.Xt0Hro/RqqBzSPQkC.fW2dhPVJ/xknW	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
65	_Modelo User Generico	modelo_generico	modelo_generico@embraport.net	$2y$10$KCONZaOqlVe8yH1ictWAUeOHasrX4JWR50nY5rVJZbPsjvAi7yHDi	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
72	Natalia Dias Pedro	npedro	npedro@embraport.net	$2y$10$e79WZ1se4KTkA0maBd.vxeMRlK4U1nbk08Wjc2DItVrNZvAZCYnMe	\N	22	2018-08-06 13:28:43	2018-08-29 11:49:16
67	Sala Mongagua	mongagua	mongagua@embraport.com	$2y$10$jvQOrh41vYJ/7C8jCwWY3O63BvpFPJemTIB7Oin8Sh9BdAXv0qlNq	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
69	MOISES SANTOS DE CARVALHO	moises.carvalho	moises.carvalho@embraport.net	$2y$10$FQNKhPwj60juzKrQUpoGleM1Z9xlFSlq8gNDGWCHy0ylYrnAGS0S6	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
70	_MOD_Usuario servico	moduserservico	moduserservico@embraport.net	$2y$10$vIRqr.Sqq/LhACHL8ak1c.gCx/8V7u1/RkhMsgQuiJF/phAgibAX6	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
71	Mariana de Oliveira Dias	modias	modias@embraport.net	$2y$10$vtDXaz3JTZcTHVDAhdsgY.yaip1PaA5XncdYtgDfyjibgtXzyA6gS	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
73	Norberto Eduardo Alves de Sousa	nsousa	nsousa@embraport.com	$2y$10$mxvqd6k.LI.je2aUUrLX.O25aNMBPo1nSFoZxrvxSqbqa7c5qmtbO	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
74	Marcus Vinicius Espinoza	mespinoza	mespinoza@embraport.net	$2y$10$6Zh5HPLNwouSmJvieE3HCOu4kzX8NHeBxaqBZGCqz7Tp3zosiEVK6	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
75	Planner TI	plannerti	plannerti@embraport.net	$2y$10$gVbJdI6WYNWreqviDXhCTeT628z9IBOCH1yZUpIIa8v/WifVnoxhW	\N	22	2018-08-06 13:28:43	2018-08-16 08:40:34
77	Paulo Mateus Bezerra dos Santos	pmateus	pmateus@embraport.com	$2y$10$A0Lkecsoqm6kSB/6EJI1XOdWqA/ul3Ashlc/AF5xV3Uk7iZbVhRfq	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
46	Michelle Medeiros Gomes	michelle.gomes	michelle.gomes@embraport.com	$2y$10$NtSGdq3enNI1mjsmwgUG/OAo/WqzyRkdSBAhQqV/pbdM2z/XUvooO	\N	22	2018-08-06 13:28:41	2018-08-16 08:40:34
78	Pedro Eduardo Leal de Sousa Rodrigues	plrodrigues	plrodrigues@embraport.net	$2y$10$N.pEZ/XoTfEPL49QzjqjxeMWy3z.rBXrKWUsa5U9eZoec5mIYnFh.	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
79	Pedro Luiz Scalise Ribeiro	plribeiro	plribeiro@embraport.com	$2y$10$tlEFkJUbGOtvvHjHlHDr/.rp5roJ93XQnrI87WeXvLK04x9F21tmK	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
80	Plantao N2	plantaon2	plantaon2@embraport.com	$2y$10$/y0JZdgOF4F8v9.ujkUJnuMJRewZfcYE5ihVN0dPhaHGgx.k.gzjW	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
82	Planner	planners	planners@embraport.net	$2y$10$AnOUGMzA4X6zfY4dgPdCj.K3qoB8DCHjxEgJrB2H6O/ZOnoiAVZSW	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
83	poc-rafaria	poc-rafaria	poc-rafaria@embraport.net	$2y$10$ocL2w/QINoGGCcFgH0IxUuX1gxbLoV3N638KAdd9S36z2SeMBLLWe	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
84	planner_noreply	planner_noreply	planner_noreply@embraport.net	$2y$10$3uqEqajxtkuY41svXqZovO6NOzy0KK7JxOFUb7p1iasPb.Tunoc7C	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
85	Paulo Vitor Uemura Gregorio	pgregorio	pgregorio@embraport.com	$2y$10$mPoB7DEi0nIu20SyxI551ujdvOagQS//9O7T43jpwRz1Q3J8nZ6UC	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
86	Percival Pereira De Matos	percival.matos	percival.matos@embraport.net	$2y$10$/CsLI4/fzaICsYx6nyPFPeuJfFbMkSKI1bpOU1MpnVLe0ELt8T4E.	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
87	Peniel Amaral Rodrigues	peniel.rodrigues	peniel.rodrigues@embraport.net	$2y$10$AAtxZ6iLBFPwNlVyQ9Sr3u.NRaH1VgOPMbsBs3Tjgj3d4Wbf4aD2K	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
88	Pedro Christiano Trimmel	pedro.trimmel	pedro.trimmel@embraport.com	$2y$10$OM6QIZId.ry/Bc.YZHkeO.87zDBGM67CN586W0kYxv91K/BUiJSgW	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
89	Pedro Davi Silva de Matos Pimentel	pedro.pimentel	pedro.pimentel@embraport.net	$2y$10$AReUdHDx0s549mafEsBMQueS6iHS1JEQdCnDQUuZVZJcpLEiZtbDa	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:34
90	poc-ecoppi	poc-ecoppi	poc-ecoppi@embraport.net	$2y$10$3.OeWpNjVQ8YS97X4sOcoOgW/fCzd8Gss3IG1ypWQsBpTwDmKj7Ba	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
66	Monica Stati de Almeida	monica.almeida	monica.almeida@embraport.net	$2y$10$VLc5A96DGeGaiPQkc1B5VuQKoKlBYTkm0NMe7IuSOs7U6dmkNx4ka	\N	17	2018-08-06 13:28:43	2018-08-28 12:37:15
76	Paulo Henrique Pinho Molero	pmolero	pmolero@embraport.com	$2y$10$r8UHjcTrBRFY0rEYtpK0ZeBbRkVxLXVmMV7w4r5pubDx8RBbQBbT2	\N	5	2018-08-06 13:28:44	2018-08-14 14:27:14
93	Priscilla Galante Formoso Matos	priscillamatos	priscillamatos@embraport.net	$2y$10$5XJyu6m82AeHBV/.WwQGfu2UFoeHc.b1jiCVYNSWTUEGpAKoA0Y0e	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
94	Paulo de Tarso Vasconcellos Neto	pvasconcellos	pvasconcellos@embraport.net	$2y$10$lqHUZB8Iqb4lwVpYexaUw.MdSTti37xaUoCZJ0OTQQIqxiqT4eRgK	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
95	Paulo Teixeira Sobrinho	ptsobrinho	ptsobrinho@embraport.net	$2y$10$i1Bk7szojnlw/ePgvjGmcuNwY793kdVgOz5GmxEEutW2kUj7GSSQa	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
97	Password Reset User	prsadm	prsadm@embraport.net	$2y$10$Tep6mioyLww9zK4WBKAMbefpBIVIc9Anrs8qg7hTcSzObgDSkzTRi	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
129	Patricia Brito Pinelli	patricia.pinelli	patricia.pinelli@embraport.com	$2y$10$dNfFDMMcwWoVlXR0Lvlk0uwisEz0vezN0lI0Dq4qiGtn3vaDGvfFS	\N	8	2018-08-06 13:28:47	2018-08-14 14:34:16
98	Prontificacao	prontificacao	prontificacao@embraport.com	$2y$10$Lwwe/lZKnBaYKNm6Rat/nO36pPpWDrSIAxnM132a6zyCYhng1TaHC	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
99	Promon	promon	promon@embraport.net	$2y$10$u9ZWg6nlsSBKKmtW7TxxQOy6UA7YN0.oA7s3dPT7Mf3bNsjTHACFC	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
100	Presenca de Carga	presencadecarga	presencadecarga@embraport.com	$2y$10$36l30hMyn4p6/TtzwOOCneBOfQdm5nAd2JEx1G0ax9HLNR.ik70BO	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
102	Predial	predial	predial@embraport.net	$2y$10$8hCwWL/kPbCnesUAZpbDuu3swmroiGlOJQHlR4EvlYZtzYK2xfiXu	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
96	Paulo Gabriel Setten	psetten	psetten@embraport.com	$2y$10$eu7/S4zto23W/OHSZJr6WujvL.3clspcnc.0dr0kT4g7dMLFuP5se	\N	7	2018-08-06 13:28:45	2018-08-14 14:32:44
103	Priscila Rodrigues da Conceicao	prconceicao	prconceicao@embraport.com	$2y$10$RoaEkU4SFEdjKQz1hktKxeE8t97jFQQzPTMek2mGccrS14XMJ7Nuu	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
104	Sala Praia Grande	praiagrande	praiagrande@embraport.com	$2y$10$HlmqhaBDpoFURdmMMc/PdOs1VlYIO3/hodovbiVIrK0/UCup./X8W	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
105	Paulo Sergio Parente Pereira	pr.paulopereira	pr.paulopereira@embraport.net	$2y$10$lsFlF8wtojfy0JXAFiffTu/OEmSPVrv97Zl7gIhFmFlCglYLwBEfa	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
106	Portal P&O	portalpeo	portalpeo@embraport.net	$2y$10$7Ohho85gHzT7fCqFKeMq4OoNK7BYqQVdA/2TPofgsil38fTRuWO36	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
107	Ponto	ponto	ponto@embraport.net	$2y$10$brl1HelF9/MsDh9Fz3HyB.p.iouh3ZQFnknEgKrfqoHFqU.DH5R9m	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
108	Paulo de Tarso Coppe Junior	pcoppe	pcoppe@embraport.com	$2y$10$viMnGvbSk9D5oLOxWS7tAe40DednVeo1J4nlPCNtL2skd3euV6r2G	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
109	Paulo Ricardo Congedo Carrieri	pcarrieri	pcarrieri@embraport.com	$2y$10$zIhdjBv4G1Jo9RH7e.1JJ.NfmQPfVMfIRJAneIqGgVXXbds7x0lXq	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
110	Nathalye da Silva Pereira	nspereira	nspereira@embraport.com	$2y$10$iMWiDdPJEuUGI38SkM.y.eYuTthm9Yqrj8IbCw5IUPnB0fOwjNIl6	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
111	operador.qc1	operador.qc1	operador.qc1@embraport.net	$2y$10$pc4K5WcolRiHLSX.mzaii.h6bJd54r3UYBRFtr.2/0D67RNmYSSmS	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
112	Oracle EBS Prd	oracle.ebs	oracle.ebs@embraport.net	$2y$10$v9bF4teEd//ZFvp.0fzT5uROClrU12a16i3hhth9zlmdEA3PVTy/6	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
114	operador.qc5	operador.qc5	operador.qc5@embraport.net	$2y$10$eu3Wo.C4DIaaTCpjq9ciTO7AVrNCMC/uS0lQypM4Te8LP.CgyQk6G	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
115	operador.qc4	operador.qc4	operador.qc4@embraport.net	$2y$10$T6P8KrFOhrypAdw4qZReIeY9Vo9dv4L3u7DMlKNUS0h.5p3vmep36	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
116	operador.qc3	operador.qc3	operador.qc3@embraport.net	$2y$10$Fb2OwGRrd/WAK/JtMy8hX.qCSwIKU5ETdpfcyDuOvEP19pjLnVtOy	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
117	operador.qc2	operador.qc2	operador.qc2@embraport.net	$2y$10$T3VpAR4KMcl8ir.H8WJ1uessL94CK/ZRzX0UM38GMuxexersvRbY.	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:34
118	Operador Gate 2	operador.gate2	operador.gate2@embraport.net	$2y$10$T3Re57Yg8v5qjPDR4eS.xeETVBR8bJZbxPrlgJT6b6OZM5/qxlnZK	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
119	Orlando Dos Santos Zacarias	orlando.zacarias	orlando.zacarias@embraport.net	$2y$10$gXr33nrmUgJmIlvZQzPbOOnWLIWkgxBSoqSmhi0I7z0ZSh1mxIksK	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
120	Operador Gate 1	operador.gate1	operador.gate1@embraport.net	$2y$10$0NDL6qhfgS9yaSrJmnE8j.bAlQyQRaT/nlbIaoeW80uKkAlyhqUy6	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
121	Operação	operacao	operacao@embraport.net	$2y$10$383Y2ZsXqQNpxwTApw63ZeQ06kTO8GZVdKOhqHzJL2nCU38FpmPFG	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
122	opera	opera	opera@embraport.net	$2y$10$GrZsCjFhcrVyGR.d3B2bFuO4BXQzci/QF0yZDwG1ywpfhgdATZaFq	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
123	Oliveira Reparos User	oliveira.reparos	oliveira.reparos@embraport.net	$2y$10$myyJh7Pp/GMB.v.BenE4YuntsrvmOuVTi9ecgWnAsGGPrlGxukiAO	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
124	OCS Admin	ocsadmin	ocsadmin@embraport.net	$2y$10$Y8p6NJLdHbl/NffP35hFWOxl2PeU4dB/aQ10JmXYKKBiNN7Q/kRNG	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
125	NTP Cisco	ntp-cisco	ntp-cisco@embraport.net	$2y$10$eCM3OJDgbAw.wf0t4dRcr.HNvmnypYKW5mgWcoSUgElgF3AyDuQJC	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
126	Oracle Email Teste	oracle_teste	oracle_teste@embraport.net	$2y$10$gFGdcLnlBM0bePE.3P32FeJap/brJJqu63XGFwJC3ZBSzNC7goMIm	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
128	Priscilla Boscolo da Costa	pboscolo	pboscolo@embraport.net	$2y$10$Loa1C77zk9h2wLJr6lJr0.1OzbKIxnSeG.Q19Wn3odYDyGuFjHkzq	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
92	Paulo Ricardo Alves Cavalcante	pcavalcante	pcavalcante@embraport.com	$2y$10$XDEBLiAkRF4FpPGH/truQeJdpk12LyJZWs/6JMDyMVuv30L1gA8K.	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:34
130	Paloma Chaddad Bomfim Santos	pbomfim	pbomfim@embraport.net	$2y$10$s3mLfXFXT.FobDcLpvDZr.lGRJWro.i1ICMfTZA7JWfYgu8WIOyd2	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:34
132	Paulo Cesar Pantuso Turini	paulo.turini	paulo.turini@embraport.net	$2y$10$yQKP0rX78iy3joqQtZl.xeRc1ufg5UPXSzw8MEKoY2bS5rfxmJ.Hy	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
133	Paulo Camara Vasques Borges	paulo.borges	paulo.borges@embraport.com	$2y$10$BxOPxo/Ph3b3Zl/81fm1puFjVt4k4Hx3j1IssyHMW7VKtQeeRoMp.	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
134	Paulo Tadashi Aoki	paulo.aoki	paulo.aoki@dpworld.com	$2y$10$RinvWkoFO/bPFtefTVgQ9eDVbq45wELp1WTUy3QZqG7OcTRSYD6ii	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
135	Patricia Priscila dos Santos Rezende	patricia.rezende	patricia.rezende@embraport.com	$2y$10$UkqoWB9q9R7pTBc75M0UkOCxb0b4jzKy5OitFH0VIZNbj2lCML4I2	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
127	Oscar Alberto Paredes Terry	oscarparedes	oscarparedes@embraport.com	$2y$10$Q3Vnj6mQrY0iQyuWx13Xvu7nOlncKHaARkxC.jQc5FWXDdZYmNQwW	\N	23	2018-08-06 13:28:47	2018-08-28 17:00:35
101	Pamela Miguel Rodrigues Oliveira	poliveira	poliveira@embraport.com	$2y$10$sxY0wxpkDukV/Fhh/lM8nuc3Q6Jvd99sl.Ayqh1w02X8x02dEzXm.	\N	6	2018-08-06 13:28:45	2018-08-14 14:22:37
137	Osmar Almeida Queiroz da Silva	osmarsilva	osmarsilva@embraport.net	$2y$10$UdvJt.AkvJkrzFzwJRCUn.X1on0hFpjFzVNP/kAn4qKPjKa2MBjui	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
139	Pamela Barroso Pereira	pamela.pereira	pamela.pereira@embraport.com	$2y$10$QYBeIQUVHGsBbAYKFUVTG..aqw089kByMAk7C6CeJLPdOtLcjJq0S	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
143	Otavio de Oliveira Rocha Filho	otavio.filho	otavio.filho@embraport.net	$2y$10$3JHv9R0cHTZ1MCS0EMHHwON6Fz3K3ju.v4i4H03HOf1WZBugrbgTq	aJLe5i9OMpwVrTurzDl7WYj8Ee1jFeIY1Lsfh8WIH53ZNNx6EZ492wHmojSm	17	2018-08-06 13:28:48	2018-08-29 11:49:16
140	Palo Alto User Service	paloalto-adm	paloalto-adm@embraport.net	$2y$10$2mlVjUJ42J.ZdrukBlvwO.9kJgAz6nPdmSUNTQcryvRBf5qYTawd.	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
141	Paloma Lins Alencar	palencar	palencar@embraport.net	$2y$10$l7VwC4RT4MEQTMd7aVejdev/k/opnhMgwnBYemmfuH66Db.IPmHIq	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
142	Oziel Barbosa da Silva	ozielb	ozielb@embraport.com	$2y$10$8ilHj/X48EfbP/lPNhNEO.9D5Fm8y20dcoCCsrY8uExBJ9194iRDm	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
167	Lucas Mehl Ramos Alvarez	lucas.alvarez	lucas.alvarez@embraport.com	$2y$10$RlSa0kpB.IG7QodoVD/ZG.PYGd6pp1cfeLISAFC5ZOEF9/ZeaP/V2	\N	18	2018-08-06 13:28:50	2018-08-28 12:50:31
144	Otavio Augusto Dos Santos Batista	otavio.batista	otavio.batista@embraport.com	$2y$10$f7qMC63RSJBP8yl7eVANNuFlkOYHlL.HBdlg9Qac/0qUevyQbewLm	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
145	Maciel Felix Soares	mfelix	mfelix@embraport.net	$2y$10$YrL7VPfS59H1ICIY/oDlKuC233a0EIJ0sEPfs2S9P9tJznqxtQs8C	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
147	Salesforce QA	qa.salesforce	qa.salesforce@embraport.net	$2y$10$YvVVqssaIs4ydzkNkyn6eO.PBNYivWhcXC3A4Q8gB0oHDG4oV793m	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
148	Leticia Francielli Rodrigues Silva	leticia.silva	leticia.silva@embraport.com	$2y$10$9wILWn63pUwW1wQhqzb1KOX1bEVf5yORNm/utY/HQ3MOvVDNCQVhG	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
149	Leandro Nascimento	lnascimento	lnascimento@embraport.net	$2y$10$O9Escp9eNVKtpSmI32yNsOCEN/.7seLC61h63O1HNzwz8pU25OxkO	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
150	Leandro LM. Monteiro	lmonteiro.partner	lmonteiro.partner@embraport.net	$2y$10$iYl/ZWwS5iWj5wi05gFIqOJSf2JTDEFSOcxXzJvHRDISZpCxj4/Lm	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
151	Lincon Praxedes Vieira	linconvieira	linconvieira@embraport.net	$2y$10$xwmdK.PNocLIDSdgh6yccuOdY1WtghRxGgUYKfvAPDEHkfPlAy59G	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
153	Liliane Mendes de Gois	lgois	lgois@embraport.net	$2y$10$1GxXXY1zR/IquOZ4oG85QejNYR4vGsEdz03k0bXEscXz2Chm9lXg6	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
165	Leandro Nunes Silva	leandronunes	leandronunes@embraport.com	$2y$10$2BL87Y7okoC/QgvrIvPbsO2bWuaK9P168zLcGOleRMvCosj0wKRia	\N	16	2018-08-06 13:28:50	2018-08-28 11:28:13
154	Leonardo Gandra	lgandra	lgandra@embraport.net	$2y$10$PGoFKsDhxyKoNQW0T.JODeXXscwsYLue3BxeCmSspzD.sHgCzbX.a	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
155	Letícia Dantas Tomaz Monteiro	leticia.monteiro	leticia.monteiro@embraport.com	$2y$10$AXyEA99wY9rxOI5ELxetDu7zu9qpDAmYuzflq.5/pJU4ZzYy45cZy	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
156	Luciano Neiva de Sousa	lnsousa	lnsousa@embraport.net	$2y$10$pXNWfbkW6VxYdeuQzV/Bfen86kp4HAQ2MH35GhxCA940h1ImLicRi	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
157	Lethicia de Azevedo Ribeiro	lethicia.ribeiro	lethicia.ribeiro@embraport.com	$2y$10$WrU7/BKcmv9G4HIQb8in3uYAvXA6CAmhJ2IdTae.RoR/4txqt63he	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
158	Leonardo Silva Rocha Santos	leonardosantos	leonardosantos@embraport.net	$2y$10$WWL7ar3gGtKt2RDe5dh6uuk2YQT/9l.flIgBPMwrvmFvNpBJcAcdG	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
159	Leonardo Araujo	leonardoraraujo	leonardoraraujo@embraport.net	$2y$10$VnxIKrJTR3DIa0Ebun2uru0Sj45LsENCeIpdUN8SQFe/48XDvXRhq	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:34
160	Leonardo Borges	leonardoborges	leonardoborges@embraport.net	$2y$10$8fxflxDOl/Knh/.eT8VHnOg1T30bE1fruG736v9vgP4z5UFNXIgxW	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
161	Leonardo Roberto Silva de Oliveira	leonardo.oliveira	leonardo.oliveira@embraport.com	$2y$10$/fz1EZOZYkLXYSaOWBlABOD3Aj3AJTZFUXNqULd.qV8nMOA4d2I7e	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
162	Lennon Marcos Silva	lennonsilva	lennonsilva@embraport.com	$2y$10$3BwQpkpjcGg5eruFmYcYUOtLKCGbFb3P6qqrlPmy7uG8.WhvvSdw6	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
163	Leonardo Notari	lnotari	lnotari@embraport.net	$2y$10$EVhimn09I33UVHcT9NfzIu0Lq9HCqCtLf4xqnx8PvFAF1.m9HpmHO	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
164	Load Balancer Externo	loadbalancer	loadbalancer@embraport.net	$2y$10$mQwnqs7RfKJ5FmPMgXRLlOK5g4/diHkZsF8oB7GhVdo4XOm8MogH.	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
179	Leandro Pinheiro Matos	lpinheiro	lpinheiro@embraport.com	$2y$10$1It/bIeiTCOLF.T9.McEXOXVTXuG/SHgmMKn9XWfYReVfU/uNs4aG	\N	13	2018-08-06 13:28:51	2018-08-28 11:38:19
136	Parceria Embraport	parceriaembraport	parceriaembraport@embraport.net	$2y$10$.qK2/AQCn7RN6bhT.t21B.F5tR8sQ95I9ixWpII83mWAmL88wjvvS	\N	22	2018-08-06 13:28:48	2018-08-16 08:40:34
169	Luana Rodrigues Cortez	luana.cortez	luana.cortez@embraport.com	$2y$10$Zt4FCwShqSCiTLV.vcyZlOH44xfiEOAfXj9Fn0/X/z2H.T81UU7IG	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
170	Luan Santos Dantas	luan.dantas	luan.dantas@embraport.com	$2y$10$XDEnFO4XLiHBfBf9q/3nbetY6sj0ufutQPZqbK.0KficCYFpqzyQ6	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
172	Luiz Fernando Tiberio Faustino	ltiberio	ltiberio@embraport.com	$2y$10$3OGkuE9GPIAHM/PcgXVPGuCN7dPkReZfqMuhbVZs2OIWn4RRZ9zRe	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
173	Leonardo da Silva Rodrigues	lsrodrigues	lsrodrigues@embraport.net	$2y$10$kw/gE1E7CAuBkpk7dOSP5OuJnO/oFoafnZfzKPUGS2ZkQyyPLSWbW	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:34
174	Lucas Pires da Conceição	lpconceicao	lpconceicao@embraport.net	$2y$10$T84yynwRDdPhDjW8gRJnDOmv0PYyZAZqqZMecRWyn3YEGA2ZZwHY2	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
175	Leonardo de Santana Pedro	lspedro	lspedro@embraport.net	$2y$10$WWOzXVpVo7/BBTbS1oAx9u6HqxtWKY2ZoL4m6znCGD33IIDg10xye	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
176	Leonardo Sierro Cabral Silva	lsierro	lsierro@embraport.com	$2y$10$EfHwZwBVR4Qfx5gLMao8be6pAUe4ew1bqOp/qHbofPFyoBs.B04gu	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
177	Leandro Reis dos Santos	lrsantos	lrsantos@embraport.net	$2y$10$3he6p4m5wZnT1AzU/dgFNOUVCItsaN.LWqYjiJXC3I9JaBRwe5oN2	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
178	Leandro Petenucci Rangel	lrangel	lrangel@embraport.net	$2y$10$fhD85H9nJZsfNGIihxEjCuC4CqA2FRJkRUExOv6x7UxG6sZIy2jK2	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
166	Leonardo Guenther Villar Steiner	lsteiner	lsteiner@embraport.com	$2y$10$Q26xtpWVih5DspLwUbxmfOpQRItK0eobfBrjoLcRbrJv8nU8KMboq	\N	20	2018-08-06 13:28:50	2018-08-29 11:49:16
152	Luiz Fernando Santos Goncalves	lgoncalves	lgoncalves@embraport.com	$2y$10$Hk0IYDxzAtjld0ggfwmtoO6xBZwHB6llw2nBX918G8hraYF1PBlu6	\N	10	2018-08-06 13:28:49	2018-08-28 09:18:00
138	Paola Bossan Bianchini	paola.bianchini	paola.bianchini@embraport.com	$2y$10$KF98GNw5JrfwHd03YOpH9OzGJVdfIxkQ6hE9Yl4eyegLB05ZbAsru	\N	7	2018-08-06 13:28:48	2018-08-14 14:32:44
182	Leandro Gomes	leandrogomes	leandrogomes@embraport.com	$2y$10$rbYjn0eeYicaKct5eWp.5uW4wJuC1yfpW4mv0mstLLiQZU79lO1Me	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
183	Lucas Teles da Silva	lucasteles	lucasteles@embraport.com	$2y$10$nsr/xkAzQjPsNjAmm2myaOQFSzGTpEz6EeSclLSmDQ6/PlWxG41Xm	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
184	Julio Amaro de Paula	julio.paula	julio.paula@embraport.com	$2y$10$WdFZ/P./6VuRYJABmyS97OqTYLRqQGkEcJnZuabwHgUYjJCFQbm2K	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
185	Karolina Gomes De Souza	karolina.souza	karolina.souza@embraport.com	$2y$10$dyGEFGAOlpqpCnUpQp5MPuV3XQ6VLqPX2N09euBaEGcXJIVtEyvwO	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
186	Karla Santos da Conceicao	karla.conceicao	karla.conceicao@embraport.net	$2y$10$k54FFUMpIW86J/5CXbPJ3u1Zy99mHv/f2Pj.nHQL/LeRBouJTVc6G	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
187	Karina Ferreira Alves dos Santos	karinaalves	karinaalves@embraport.net	$2y$10$IsxkVotVBsY2vWIkYaCi7uPYYh6Re4KNOXIljlughGAa8DYu9PzfW	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:34
188	Kaio Felipe Souza do Nascimento	kaio.nascimento	kaio.nascimento@embraport.com	$2y$10$cma8ot8FKeSD/qYcHFSLVe.pDWojnMzuPS9bLV.Ff0K9exW1m/FY6	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
189	Julio Cristian Velasco Arduz	jvelasco	jvelasco@embraport.com	$2y$10$FyfuQMcxg64zINGCWEdIzekxloJcAm8qsrr0BF3me37Nd/Rladrw.	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
190	Julio C. Melo	juliocmelo	juliocmelo@embraport.net	$2y$10$CdXwKEwxlpLBRv7V2uuy/evsdnR7ANot5rM5foz1XSSJ2ZMEmbkPW	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
192	Kelvyn Bezerra Nascimento	kelvyn.nascimento	kelvyn.nascimento@embraport.com	$2y$10$3gt.xEsWH9e/5Pmv/MTxX.DbUs/baMEk09b1S7CcfhENgQ.YcgtVm	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
200	Karoline da Costa Lage	klage	klage@embraport.net	$2y$10$npkaporW2bclwGZUu5zHSuiNVd77jyyNmYCCEJjgqo3LwLDX.4psK	\N	15	2018-08-06 13:28:52	2018-08-28 12:19:33
194	Jose Santos de Araujo	jsaraujo	jsaraujo@embraport.net	$2y$10$WEl1Jn5E7u4ir4hUcshvbeKNkHnOySsGeHachGLqUyyh8aiPGz/Lu	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
196	John McAllister Rees	jrees	jrees@embraport.net	$2y$10$Hub0elWQW8L67U8D1LhJtu9au85kbnpJ3O9sWCWFJihCuueEv508G	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
195	Jose Roberto Rocco Junior	jrocco	jrocco@embraport.com	$2y$10$DLoZvMrSN4EZVPXBKeJ.N.JCK4g0yJLqUotBJbVQ4gVHhghtgYlXi	\N	23	2018-08-06 13:28:52	2018-08-28 17:00:35
197	Julio Cesar da Silva Rasquinho	jrasquinho	jrasquinho@embraport.com	$2y$10$FqX.qI2F3ZPV0NDm1LY9s.j1UOpMQVnw59kcnv0.5uz3x3lH7Ii8O	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
198	Joao JP. Pereira	jpereira	jpereira@embraport.net	$2y$10$coy2AOIjjh5dmzkQMwivD.rs8oX0LUD7BYkTOAj47Ml7gi5ihyNB2	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
199	Kauan Henrique Vieira Pereira	kauan.pereira	kauan.pereira@embraport.net	$2y$10$p8DA9vU.J12bDiCV6Nyvb.J9FKMId0MqJK0AgZMj8ZSeGwkbdWEGO	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
181	Lenilton Jordao	leniltonjordao	leniltonjordao@embraport.net	$2y$10$V8S/RWK0pa5WPw8VLdtUWOXbi4BLyhPIADHwzQHG5S7O3.PaUd//K	\N	23	2018-08-06 13:28:51	2018-08-28 16:09:27
201	Leandro Cesar Rodrigues Dias	leandro.rodrigues	leandro.rodrigues@embraport.net	$2y$10$nOFVhuVIau0K14sR1974nuQcXvoDbUFfoRFx1HsSTA7QnFN.L5ROS	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:34
202	Leandro de Araújo do Carmo	lcarmo	lcarmo@embraport.net	$2y$10$W.7C4HZfyAtu686LRLQljedW1ZRUlSh02lXUMflCR71u19f3YC70y	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
203	Leandro Araujo Paulino	leandro.paulino	leandro.paulino@embraport.com	$2y$10$J37kkl/rt7tQrEr4h6RpTONivbvCHvk.H2FZQmMsYRldaa3n/bSjG	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
204	Leandro Farias de Jesus	leandro.jesus	leandro.jesus@embraport.com	$2y$10$mSxj8YxzXEe3Z9ISgsCQjui9tvnRJbMiSwyNt383322wrct2k8Usu	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
205	Leandro Abreu Carvalho	leandro.carvalho	leandro.carvalho@embraport.com	$2y$10$JY93HlVrtPe1SVdNmWwE/OnaH3EzkTbX9SjrtipTGm5hw8pg9M8py	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
206	Lucas Czepaniki de Souza	lczepaniki	lczepaniki@embraport.net	$2y$10$jG.2i3OEWlFXUAmfgeO9Yut7XezQsfou4muxq3Zf0G2hFw4Tcp7/2	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
207	Lucas Castro Pereira	lcpereira	lcpereira@embraport.net	$2y$10$ifPb/Kv/dbNtp3gtffotAevRcfMFsIOBWDqe7DTniFjI3xjfvTiYi	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
208	Luiz Henrique Cordeiro	lcordeiro	lcordeiro@embraport.net	$2y$10$HtA9Q4BTGJnxY.qPxXFbeO5MZP6J26akk0GE.HCp2fCsfTo7iY0ZW	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
209	Lauro Costa Bulhoes	lbulhoes	lbulhoes@embraport.net	$2y$10$1cZVmIOIzMwVNNkyNDNgz.B8FL2MXnYI3vEyyxlnd/HXBs2EEG3Lu	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
210	Kleber De Lima Peixinho	kleber.peixinho	kleber.peixinho@embraport.net	$2y$10$3sP6c62n5aVyu7tcKEReWO4CnNiUfzWhFBhCf6.w08Yyczplo7Wm6	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
211	Luciana Brandi dos Santos	lbrandi	lbrandi@embraport.net	$2y$10$uHkvKuv.JKGcePRmFPAWd.aUOYHEEAewCiuUB2yo.qTyPyVnO0RhG	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
213	Larissa Brandao Flocco	larissa.flocco	larissa.flocco@embraport.net	$2y$10$QPWpx9ekkFTjIOdj3Y7ZjOfqtnd77HSoHGQqQXFBOKj0R4EI8Q73S	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
214	Lansweeper user	lansweeper-adm	lansweeper-adm@embraport.net	$2y$10$p2EJWZnb/FgBMCvW27VICe8dvSj3mqIv4.c0Tx.1qbLuq2Byy9CXK	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
215	Laiza dos Santos Silva	laiza.silva	laiza.silva@embraport.net	$2y$10$bwCElm.GVmTxRMn1wkT8QO6W5D4fCxCtWPBQY9NBPOoeanKzfMooW	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:34
216	Karina Vieira dos Santos	ksantos	ksantos@embraport.com	$2y$10$jZSPBz0CPs2P9dIV9/gStejz0Icw27PL/NnNSIu/VEy2k.BLUxcae	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
217	Kleyton de Lima Vasconcelos	kleyton.lima	kleyton.lima@embraport.net	$2y$10$p38mBa76TN3UQ8mGDlG5T.VaYoFTE6vaWub8Kfh.8b5Qq5afX8CSi	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
218	Lucas Olivier	lucas.olivier	lucas.olivier@embraport.net	$2y$10$cHl4Ob72KTOfuHjOPkFyrum2HqgL/7MpXQNRA4meqgmN9fKaT.Ajm	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
219	Luciana Fabricio da Silva	luciana.fabricio	luciana.fabricio@embraport.com	$2y$10$3eh2ogFyCZRBPnXEX3yF3OOx2RtilISQyrQPxzzRsUtKNhWC2KybO	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
220	Maycon David dos Santos Luz	mdavid	mdavid@embraport.net	$2y$10$etrVcVJ0Bi4k5yRQfs4x.OkZkCSEYDPkm2.0aK8OtFiFJTz8h8lci	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
221	Margarete da Silva Nascimento	margaretesilva	margaretesilva@embraport.com	$2y$10$q2bqDe2tn.ziNly0JVOGA.mba82xseJR2U3rS62jH2c2pinwpyF1S	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
222	Mario Souza Dos Santos	mario.souza	mario.souza@embraport.com	$2y$10$ADGffzbDV1Y.9JEO4AiJRu6f2C/.qUvbAL/UtBxGj0lYLWDTg6QSy	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
223	Mario Jose de Andrade Motta	mario.motta	mario.motta@embraport.com	$2y$10$yDTXPxQEuRFU181EIV4LoeZJBC7Xj/azY.5/rgMCN2WS4GAA0pQ9O	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
193	Juliana Moura de Sousa	juliana.sousa	juliana.sousa@embraport.com	$2y$10$qMfx35L6uL6XkAZD1WSi3uTurJ4Hlsu6i2QThuoWOeZ24wZ7IOplK	\N	14	2018-08-06 13:28:52	2018-08-28 12:05:43
226	Marina Braz de Paula Meck	marina.meck	marina.meck@embraport.com	$2y$10$jDoKCbjxru1yPCf1Jvqqze5XSwl/djOL/OOA0WeIAZH3VFPAg9O3q	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
227	Maria da Conceição Siqueira	maria.siqueira	maria.siqueira@embraport.net	$2y$10$TD5X8xVmyrkSaF7GOyx.NOVLMniBoxkgS0XXrdrMheJ8yD2TDjzNC	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
228	Marcos Antonio Dos Santos	marcos.santos	marcos.santos@embraport.net	$2y$10$rSY4Ecl7J.CERGKynLqETusqas8xx4ffpTKchTZsqh6/QPpC5hrdK	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
229	Martha Anjos Silva	marthasilva	marthasilva@embraport.com	$2y$10$/w6H7U35ePHhi.f0V4J5Gu5bbWxcp5ePqj5xji7IzKWPjAV2ottw6	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
230	Marcos Eduardo de Santis	marcos.santis	marcos.santis@embraport.com	$2y$10$FoGPt20UAgkhtGX/2z3DFuxyOJ03Lt4eEYqjlwGwvvHu5G/WzJJm2	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
231	Marcos Antonio Prisco	marcos.prisco	marcos.prisco@embraport.net	$2y$10$qgOHQhIxUkPZZI0FypGFh.JqDMYlg1xhqgOKAKkPoWrNZe9hixXX.	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
232	Marcos Fernando Mello Matos	marcos.matos	marcos.matos@embraport.net	$2y$10$9I.1Y7LGZSzFKn63SnnJZ.72L0PBZZT8tY/aZdOTc1IXEV/hyptSW	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
233	MARCOS ROBERTO MARQUI	marcos.marqui	marcos.marqui@embraport.net	$2y$10$xz3lzSN13lkbG60tsITyZuovuGfnvzlN2LzlR90h9owbFPDYbwm2K	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
235	Marcos Cardoso Alvares Filho	marcos.alvares	marcos.alvares@embraport.com	$2y$10$tzGz87qKyO.UA8n299BequMw8Alu.gNelezu0vkbo75MBkzDu4HEe	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
236	Ricardo Marquart Rodrigues	marquart	marquart@embraport.net	$2y$10$etvL/KDsSKd/kv3L5cVLhO22kUvG.c/oqjWKjKkK8J3I2u14OsAC6	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
237	Marcelo Alves Silva	masilva	masilva@embraport.net	$2y$10$hTBN7Nbdt7Ub6KEo5G6gv.swiTjOMrcW/LsakvPuzPNQmwerpJHky	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
238	Marco Antonio Ferreira	marco.ferreira	marco.ferreira@embraport.net	$2y$10$v8SMv4whyPEb46/gaIeVa.WzCwqUK2Ugr00UjZE5XDeFiqnNN.9si	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
239	maxadmin	maxadmin	maxadmin@embraport.net	$2y$10$Gbe1Pwi/I2dNd6QoIAnV0.WHGHvMdpZyzpJl1g3bbgt7dx.iGC5A6	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
240	Marcos Cesar Dantas Santos	mcesar	mcesar@embraport.com	$2y$10$.w7RysZY6Z.XtTv0fRNP..Qiq4e5brRye5J9FOpeMz/3dcY31aAJC	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
241	Michael de Oliveira Cabral	mcabral	mcabral@embraport.net	$2y$10$x9RkEeycyTFVBV5VSZFK8OiXLoUqTq3C3SYMQdRUnI8ynwy5NfyDa	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
242	Marcelo Barros da Silva	mbsilva	mbsilva@embraport.com	$2y$10$LibCd7O9ZpgaDR4XGIXLH.i9iLu6hyrSUNgG0JHGd9pk0kN25a0.O	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
243	Mayara Fernandes do Nascimento	mayarafernandes	Mayarafernandes@embraport.net	$2y$10$pGM2/zHrEJNk3cZi2Vj/x.edZmv5QtHtHjLo3keg8V0xuzuaZn6ay	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:34
244	maxreg	maxreg	maxreg@embraport.net	$2y$10$7Gpg3NNFk/Pe/tuSkv9c7OZeCFVySNhxgIUDRCTJmteKKzf1IEmmO	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
245	maximo	maximo	maximo@embraport.net	$2y$10$E8qHf.aDlw3pJ8bAjhSDJuRPCcHTA74LD/QJ44e5t96tbA2AAVbnK	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
246	Mauricio Souza Santos	mauricio.santos	mauricio.santos@embraport.net	$2y$10$devQyygxoA8vnK8xHZYFr.LFMkbLKYncsR6Zvm/90K68gRKXZCM6m	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
247	Embraport - RPS	master.dfe	master.dfe@embraport.net	$2y$10$4/KDpaqEsTn4.ejxB.ilIuds8BepIsUvKx8VxAsin5yhLL8htJRl2	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
248	Matheus dos Santos Silveira	matheussilveira	matheussilveira@embraport.net	$2y$10$z/nJhUTobEwWQ7OAMmOONeBv3.XPoBrAXYJbn1LPklolwcsvxjdWa	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
249	Matheus Augusto Mastros Pires	matheuspires	matheuspires@embraport.net	$2y$10$D9wQnpK.mJ4nXAsQ6jmoPelkCwHb8Ezv4tnwaPt/9S7LwFiz9mi2.	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
250	Matheus Eduardo Hipolito Martins	matheus.martins	matheus.martins@embraport.com	$2y$10$0E33rVjkXadT6rPfScB0tOW5qRfJmKynvhfHVagvCCLE8bH4GmvXC	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
251	Matheus Souza Damo	matheus.damo	matheus.damo@embraport.com	$2y$10$EiM15.124SUMNCrJtorVo.HxS2hHPTN4xcpRGluFlj.dOUbuM5yhq	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
252	Matheus Henrique Oliveira Araujo	matheus.araujo	matheus.araujo@embraport.com	$2y$10$vO4HyG2Bo9FgNhI44AInzeRONGe4SxovfM8JEW5zX3ziYLPwWcMCu	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
253	Matheus Aguiar Alves	matheus.alves	matheus.alves@embraport.net	$2y$10$oY/B9G9LjuRunE5hutf7p.kQrU1Boom8rB1wAC1EAmJ4AjnZwlR2q	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
254	Marco Antonio Vieira Da Silva	marco.silva	marco.silva@embraport.net	$2y$10$ciLifZh6Sx6xReBRQw3kf.foRl/kC4E2zkVh8xvW3gEpijRbD9Rtu	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
256	Luciane Alves Dos Santos	luciane.santos	luciane.santos@embraport.com	$2y$10$eLKhGbUhOZGqLP.QdkAy/.W92.ussj494ubeCy.fNCnz/eKN5apUi	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
257	Luiz Henrique Alves dos Santos	luiz.santos	luiz.santos@embraport.net	$2y$10$HlzBisVb1mtcbG1lboQZ8OK/RBnTfO2szXrSUse20LZPFo2SXKvTS	\N	22	2018-08-06 13:28:56	2018-08-16 08:40:34
259	Magda Chaves da Silva	magdasilva	magdasilva@embraport.net	$2y$10$y7/Gr6LtFI.17kGOQJE0UucwdBdUDGBGSCyTyUZp4HMW9BXBFh1lm	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
260	Leonardo Lourenço Vieira	lvieira	lvieira@embraport.com	$2y$10$BF.tois9sSowOdl/WvjVq.S/DgSszhwJQNvC.81R2SRXclvZBdrHW	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
261	Lucas Veiga	lveiga	lveiga@embraport.net	$2y$10$wGpkVmxvbKS6kfVirU9HHuUXu5DxVK5VNeHqnNNODzR3UDPxJUANa	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
262	Luiz Claudio Viana dos Santos	luizviana	luizviana@embraport.com	$2y$10$hKNYKhHnMVN3YaBpK4eQY.tAHzwpE//St.3A9jfEMjRWAEhdKJqIq	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
255	Marcio Roberto de Abreu Ramos	marcioroberto	marcioroberto@embraport.com	$2y$10$y5b0EvKhk2v.guNk.YB5gua30Xlogp4g1QFk40a/BfpxFe8BV9/VO	4gmYbMDpfktFiFt49vwxPHWi1zVXPMIwTSeR4idM11S0V6YMqa7DP1jQVOD9	22	2018-08-06 13:28:56	2018-08-16 08:40:34
264	Luiz Antonio Dos Santos Pereira	luiz.pereira	luiz.pereira@embraport.com	$2y$10$6rHAAattZ9K8XGHc94lB2OZyZ5tL.sojzDhHX.Z51/Hjyjlhn.Zcu	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
263	Luiz Nelson Cabral Carneiro Junior	luizcabral	luizcabral@embraport.com	$2y$10$M1XHRg1XP6mfu37xrDfbSeddmbpoxtIkzNzSLRTebaceXFlCJk8ua	\N	19	2018-08-06 13:28:57	2018-08-28 14:45:24
266	Luiz Henrique Santos Da Costa	luiz.costa	luiz.costa@embraport.net	$2y$10$L/WlAn/vi3vi3QHVUkjW8OoRNHDWOpfVIjyH1wKv./cmxphPtR5K2	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
267	Luiz Enrique Nobrega de Camargo	luiz.camargo	luiz.camargo@embraport.net	$2y$10$oqLO7oY7Pwz0caXWIsVNeeKCXhp/iwB2jqDMMOfVFaK/OlmGiAt7G	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
265	Marco Antonio Barros da Silva	mantonio	mantonio@embraport.com	$2y$10$3MKW1hL8ecW8JKlm/OIkMexcfcscAgDBGmbYgYJIyIOkinRacd9c.	\N	15	2018-08-06 13:28:57	2018-08-28 12:19:33
225	Mario Dias Escrivao	mario.escrivao	mario.escrivao@embraport.com	$2y$10$8gbYGY6MTNOHuiv6x0qg9e.rh1ONEjz3cKIpBGlMCbK3eQqv2XJRq	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:34
270	Luis Claudio Castilho	luis.castilho	luis.castilho@embraport.net	$2y$10$1duHazL/HZtNaibjO2LwFeXtMGJc9CXmMLhOhK0wEhO1IV3skGzr2	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
271	Luciano da Cruz Sobral	lucianosobral	lucianosobral@embraport.com	$2y$10$ukGJoPy4.hh0s7r6cACKj.DKhveraptWP0ft5TC75WSMwI4.YgRh2	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
272	Maira Joaquim Severino	mairaseverino	mairaseverino@embraport.net	$2y$10$IF0x3f1TqQYRwLoVkUyFLe4oDo0BMWEcd/WP.QKAwpx6DzY6Qp8/i	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
273	Mara Rubia Souza	marasouza	marasouza@embraport.net	$2y$10$nHpDjvkHyimflbQ3aZKka.6A.uh9GsmtFm3aPIH2m1cCzAfxOYI.e	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
274	Marcio Gomes dos Santos	marciogomes	marciogomes@embraport.net	$2y$10$HF.RIr042Ry5IK7Z21Hu.uY.Jn19/RMeJH/wp1O4Nhi6.nboAgqEu	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
275	Marcelo De Souza	marcelo.souza	marcelo.souza@embraport.net	$2y$10$imAqf0u9Le6jtgzfoN6uwuNTseRbteY9vUDUAut5.50xAJMgSfZgu	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
276	Marcio Renato Da Silva	marcio.silva	marcio.silva@embraport.net	$2y$10$OD.8swcJCNGWKyI0kbzEEu4VwRLbYyGOS.3c6LG547PDZCKztYBzu	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
278	Marcio Carreiro Pinheiro	marcio.pinheiro	marcio.pinheiro@embraport.net	$2y$10$jPjw9uvmKfnQb91f0zSr5eE5ltrgcgdIsZcLF2AcadrsShvK95qdy	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
279	Marcia Regina do Nascimento	marcia.nascimento	marcia.nascimento@embraport.com	$2y$10$n18ZzAIUedYt3wZ1kNW8kOmvqYBOsvEdw9U2a5hv/8YN3hvV8QcJ.	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
280	Marcelo Barbosa Santos	marcelobsantos	marcelobsantos@embraport.net	$2y$10$T6StDJ4peZeVGLjGsLF3x.RiNsznJYYmECmjSmXxKLQyaL3VjW98u	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
305	Thayna Noronha Costiuc	thayna.costiuc	thayna.costiuc@embraport.com	$2y$10$/TJpjMMYSTY0xJGDsMGG9e3MEhpnYYICQovLg0HGeyC8ZBOhgkATS	tQ2x59v1KK7tZuFLJAhAqh1rfQEv78qHNHATriNFk5fmtfQqUBrHkEmxP6Z7	14	2018-08-06 13:29:00	2018-08-28 12:05:43
282	Marcelo Sosa	marcelo.sosa	marcelo.sosa@embraport.net	$2y$10$Ra6tTcHnZclkVgeLkI2XzeXjt/AE0cSHM5cIR1LmxWFfhEVlF0Dcy	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
283	Marcel da Silva Barbosa	marcel.barbosa	marcel.barbosa@embraport.com	$2y$10$6hDarMouISgX4A2H1TdIN.qbRlOeX0V4el3.de.8Y98tfre2HETUq	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
284	Marcelo Machado e Silva	marcelo.silva	marcelo.silva@embraport.com	$2y$10$OTgpCIerNfv9OVntEMJDwupbzQ8y/ke.z3ydbZ4km9RwhrUaRYz4e	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
285	Marcelo Augusto Ribeiro Penha	marcelo.ribeiro	marcelo.ribeiro@embraport.net	$2y$10$BK1GGhorbGiVYBqyg9bMkuDAlENoaYjIUKaZv0qZ9bNej5KUtLd/S	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:34
286	Marcelo Procopio Silva	marcelo.procopio	marcelo.procopio@embraport.net	$2y$10$IRKnqOwFumUDUBAsjC1KJeL5CZ1WqfaEFbYcF9wTXFngADc.0phOm	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
287	Marcelo Felberg	marcelo.felberg	marcelo.felberg@embraport.com	$2y$10$hSiqSHaBSkKhR9fEokjw1O38Q9sjL9h1ez.uRfeFrjqg5R65hMkTe	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
288	Marcella Fernandes Santos	marcellafernandes	marcellafernandes@embraport.net	$2y$10$84LieooA/Grp2PV06W.tT.SSSLn05DW.xiIrLwU5oz7.tVMiTXB42	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
281	Mauricio Perez dos Santos	mauricioperez	mauricioperez@embraport.com	$2y$10$GiBlEApJ12b2Lq7xzki8G.i6BfFEyUchKnd6O5IHW6D63AfGUD68O	\N	22	2018-08-06 13:28:58	2018-08-29 11:49:17
290	Marcela Tatiana Chaves	marcela.chaves	marcela.chaves@embraport.net	$2y$10$OBKoi1.hdXXhhJuMpAL5z.9PHL95BvQ9biilQbwsDOpcWG..TcOmi	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
291	QA EBS	qa-ebs	qa-ebs@embraport.net	$2y$10$SOKdWCyRHg.Rg3fob/FzFe50FKht7dp862.lBDW6gLOSsMlAqpRua	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
292	Qualitor Infra	qinfraadm	qinfraadm@embraport.net	$2y$10$qfxca5vRUxhvtkSXHQpGe.gmjdOjehahzmbvilMTzoNaryPU14jP2	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
293	Jorge Borges Paracampos Junior	jparacampos	jparacampos@embraport.net	$2y$10$Qqk/p/Zyz5Xv66T5XJYTFuCWPXLBnZO/UpWEh6qSFGozHQxDC1sRW	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
294	Thiago Henrique Da Silva Santos	thiago.silva	thiago.silva@embraport.net	$2y$10$KGAZo1FG2CtI7VkgFjuq3umU3yXSqe3nzQ4H5rBOsH72hGpREAyE.	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
295	Tiago Santos da Silva	tiago.silva	tiago.silva@embraport.com	$2y$10$wWw5ZI0X3mcgWTIZB54J9ey5/s4JYDJYJr.9xPm/X1G2ZrH0FiRnC	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
296	Tiago de Almeida Santos	tiago.santos	tiago.santos@embraport.com	$2y$10$8dg0ukJK260w8XHCvNp2cu4K5jd9YWoZDjECkNDGk7C/AA3XAfekm	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
297	Tiago Mota Da Silva	tiago.mota	tiago.mota@embraport.com	$2y$10$Af0xoq8jMjPcuis86rFBie7/h0u85oqUJVtjWnCQPTljrQ1RXjMK2	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
299	Thiago Santos Silva	thiagossilva	thiagossilva@embraport.net	$2y$10$qaREVeHK6VFT02FEd5Nr5u/C2DXlBLs8wafDmchHZbglaQxRMFmiS	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:34
300	Thiago Costa De Souza	thiago.souza	thiago.souza@embraport.net	$2y$10$UzjuZ3kfHvrWz2KAgUeYg.TuJCwPqLzsd4lbSJ2fx1b79IgncOxPC	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
301	Thiago Rodrigo Oliveira Silva	thiago.oliveira	thiago.oliveira@embraport.com	$2y$10$pjxobCB0RFCXQQ.qDlxPm.t9a/GftK5HxiuLmEFgOF7hFGZ5ziCje	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
302	Thais Leandro de Souza	tlsouza	tlsouza@embraport.net	$2y$10$2Jp73fO1gPaX1Bs5GCBaZO8rfiZLPI4x0KANomw4jL5nkDe9IeP/m	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
303	Thiago do Nascimento Goes	thiago.goes	thiago.goes@embraport.net	$2y$10$hQkQ3FijJ/K5nQwRs3i4FONy39YTAT/FjWEv/6m.BC.jBs3fDeiBm	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
304	Thiago Aguiar de Siqueira Barros	thiago.basto	thiago.basto@embraport.net	$2y$10$CYUcP0nxZh720bJpcsotE./gAeP/jIJpL3E7Kf3BItfBtSiDYp4.O	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
289	Marcela Dias Carlos de Jesus	marcela.jesus	marcela.jesus@embraport.com	$2y$10$YXT2rt4K1.c3SnkMW5fk7OlgLBhakg6S/yrrJBxwlmP6hlHmf3wgm	\N	17	2018-08-06 13:28:59	2018-08-28 12:37:15
306	Thais Saltao Campos	thaiscampos	thaiscampos@embraport.com	$2y$10$OKZ6R7SUd/J0dodtjM0amuK3hE7WcHNXCqadDOOj1/LFEYqkZsH4.	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
307	Thais Eloa Silva Bamondes	thaisbamondes	thaisbamondes@embraport.com	$2y$10$TA60i3.czS7cILJya1TZZO/H60nZ5RqwIsNXTeQAQMpOXFvac5iFS	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
308	Roberto Thadeu Martinez Barbosa	thadeu.barbosa	thadeu.barbosa@embraport.com	$2y$10$5xqivu7Jw3/jEvRcvI3G0On//66zZRLVaOHKF7yBwC5k4vZGEjEqu	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
309	Thaynara Lima da Silva	tlima	tlima@embraport.net	$2y$10$x999/MCjXgI.6wx9Pn2iquQu7dcHUNWinaHCeVt.Fg07h/AbuP/Q6	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
311	Tatiane Franco Ribeiro	tfranco	tfranco@embraport.com	$2y$10$rnwpVFfKwy2vG6cr1bVTb.39DGGm/JcXqBd/H9bjOTt4shOsFTgHi	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
269	Luís Claudio Saraiva Lopes	luis.partner	luis.partner@embraport.net	$2y$10$CgVaYnBo5U0ukUq6KbA8xefGSv4LskpitwJvnECO7qeanYDak8nle	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:34
310	Thiago Martins Rosa	tmartins	tmartins@embraport.com	$2y$10$7yChyYoJryeoxf/mPyxLQ.4f9x86TchnTItXSJrSTUvxv3xh54vEi	\N	3	2018-08-06 13:29:00	2018-08-14 14:19:46
314	tycoadm	tycoadm	tycoadm@embraport.net	$2y$10$caSU1pJWWPkYaARndw1yd..La9fNz0w25uvkEcVxWw078s.4hTaPG	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
315	Tyco	tyco	tyco@embraport.net	$2y$10$2LkUn3IJubOBwfbBo.xnfezB4QojmlJcmciiq7Fj4pPntrjlYGhFi	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
316	TV Innogate	tvinnogate	tvinnogate@embraport.net	$2y$10$n3fbudFk8F2JDRi8YFIkwewCICVTB5CCi62DduEr7i9llBG9Z7.qy	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
317	Thiago da Silva Santos	tssantos	tssantos@embraport.net	$2y$10$oMVl6jTsl7YJIApqUU9xROvm5VDZpgrnvWrxfOoFjntjPOp3q3aSe	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
318	Tamirys dos Santos Ribeiro da Silva	tsribeiro	tsribeiro@embraport.com	$2y$10$AGkT87CoM9w98msX53y1HOfHLaIjYkZSg3hx/D0c91wZrlHPsGHZq	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
319	Tobias Ritter	tritter	tritter@embraport.net	$2y$10$mwi/U7mSPgl4blMbK.UqBONC8wGxtsO9bkQwvAjTkEnAugbZ0R4Gm	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
320	Gregory Hedrick	tmeicgah	tmeicgah@embraport.net	$2y$10$ebCnK8/IfmesLG98gB6xiuUy0MGT2S5X46HnlS3omlVQHkoXRq4cW	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
321	Trend User	trendadm	trendadm@embraport.net	$2y$10$wmawkKU.rVSxazajdF7BBeZSAhN0HdX1i5DW2wK6QwsmOshm0nvUC	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
322	Treinamento EMBRAPORT	treinamentoembraport	treinamentoembraport@embraport.net	$2y$10$v4uaB4WEGpjYmgzHv0WcSuHL/VxHQlehOI9XyS.5hQC/YOdcLtjCO	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
324	Transporte	transporte	transporte@embraport.net	$2y$10$gD5aJ2ufTQwf.Ag2mR0oGOxIKhfXZu5/ZBRHuspnM7OUCISQxAtLK	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
325	Thiago de Paula Silva	tpsilva	tpsilva@embraport.com	$2y$10$vDK5UW8HB4MNod.DU1V1pOinO.OSYUbcuFvUaPiHNRr0ICB0Pc.rO	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:34
328	Thiago de Freitas Coelho	tfcoelho	tfcoelho@embraport.com	$2y$10$tJktbA708eI6Vnpl4WR8vuGCLzSyhGyCQTqraMJO6ni3Qw4A.yyjm	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
345	Tarcisio Barja Silva	tbarja	tbarja@embraport.net	$2y$10$Ia7m1h5WUwhfrvvar7MryOSISqZni9toW1o0geU/h4qdHRXJ1wQDu	\N	5	2018-08-06 13:29:03	2018-08-14 14:27:14
329	Vagner Teixeira Santos	vagnersantos	vagnersantos@embraport.net	$2y$10$R8Fr5TrpPmQo9AKih5259e2xwkJ34K4x2ZiJRJKY5otqZB2tc95OO	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
375	Wanderlei Baptista	wbaptista	wbaptista@embraport.com	$2y$10$1e72tSGOMP06OPXh.G4Sj.G9mkJ.j.9SCz/09VZkshjr7wvJ/Xexu	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
330	SystemMailbox{1f05a927-8a4d-4391-a4b8-94bde6d7d407}	SM_8aaeffb035d644f1b	SystemMailbox{1f05a927-8a4d-4391-a4b8-94bde6d7d407}@embraport.net	$2y$10$Glc9KJFT.FuaXzMOnckqG.7YJGqbU6MzdV.7R9/KPC3jbfvBC8RZC	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
335	Thais Silva do Nascimento	t.nascimento	t.nascimento@embraport.net	$2y$10$dZtKw1xe1UcbbxiWytv6Z.kIoFt8LmwCpjlqFg2ULhMpWG2iGDGRi	\N	14	2018-08-06 13:29:02	2018-08-28 12:05:43
323	Treinamento EMBRA	treinamento_embra	treinamento_embra@embraport.net	$2y$10$9Y/YBaKJ/6f.a8lebEERPeDNubt5Bu2UvsUr1HlpNiZuZAn860kx6	uFAQdMZmwoEI9OJuqHdXZvoS6OqUVcG75MFrJSN2irBHnDurE7Hp6UHgcVcO	22	2018-08-06 13:29:01	2018-08-16 08:40:34
333	Taize Dunda da Silva	taize.silva	taize.silva@embraport.net	$2y$10$EkSqhPZDyD3xnHNXk7ua5e31diCdYljQl95T2nFuVNQsoZjl22NRa	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
334	T2S	t2s	t2s@embraport.net	$2y$10$XQGbqmDlaoDrz4ISiToJ6uSdWU4izpT.NI/LYaPQDcEpWiV6RciAy	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
332	Tatiana Miyashiro Kian	tatianak	tatianak@embraport.com	$2y$10$5MvmigTgqe.lCZKH/q9eTezaX9HmyJWm.BP9vgNwTS6U8cNeUAjMO	\N	17	2018-08-06 13:29:02	2018-08-28 12:37:15
336	SystemMailbox{e0dc1c29-89c3-4034-b678-e6c29d823ed9}	SM_4f68a3fbefb64a568	SystemMailbox{e0dc1c29-89c3-4034-b678-e6c29d823ed9}@embraport.net	$2y$10$3d2Lm9vh34EDgV9vfnvid.BwZuymvc/BTWBCkvelX8PS7lJpTd/Ie	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
337	Support EDI	support-edi	support-edi@embraport.net	$2y$10$72J/VfWV5spsoapW8xuUAevLpabEjTjZ1QyJT1eo0plHeaT9tuAKu	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
338	Thiago das Eiras Braiani	tbraiani	tbraiani@embraport.com	$2y$10$mU.AvKlfF1F.Gj1ReUh8rOfnC4XXzNH/3qUzfcnRWaTRmIxgm1qLq	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
339	suporteti	suporteti	suporteti@embraport.net	$2y$10$8c43lvT67XDaeJyQpocq0ef/DUQI8zqDbfszwWtjmt.UGETHHf4lq	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
340	Suporte Gate	suportegate	suportegate@embraport.net	$2y$10$NFbKd1CsqCOwVg4K10RetuPiYhYf4YsMy0mPTW1IRkgzkibg93j52	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
341	Suporte Emergencia	suporteemergencia	suporteemergencia@embraport.net	$2y$10$JB09uGZ5b.i9lHgDToBDduagh3Jsq3x8Ns6cCbddlC45ztgsLHzjy	\N	22	2018-08-06 13:29:02	2018-08-16 08:40:34
342	Suporte TI	suporte	suporte@embraport.com	$2y$10$cDAWpU3Z0TpPzAgOIjdHMO6xsUb41EyF6.FN4/1LCzEOMxivzqSN6	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
343	Supervisor  Patrimonial	supervisor.patrimoni	supervisor.patrimonial@embraport.net	$2y$10$UF8NpFg3Fwbrgrj9/HbquuOj7StpqPeH0InEYC6jCMwYLQAb1ncai	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
344	Supervisor Patio - Remoto	superpatio	superpatio@embraport.net	$2y$10$ASTF7GdMbSXjjy1EL9yH1.C.LkUISPGRFDogfiK.pGRGBAn/QyLXG	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
346	Thaynara Barbosa da Silva	tbsilva	tbsilva@embraport.net	$2y$10$tZLxtV1zKJNAe3taK2ddHuwjkY2L4M88l80fkKUmquaODRJO7dzlW	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
313	Usuario Teste	usrteste	usrteste@embraport.net	$2y$10$Mt7GxbopZEOxrDza8Y/mVeLIrmOG4HKBs4qzsC6D20cf.gMw29/0u	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:34
347	testevpn	testevpn	testevpn@embraport.net	$2y$10$svFxV8d5MX95Ga6JCK63uuuV9vK7sNflfwexyYBtVtlOBbBdcCJaC	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
348	teste_planner	teste_planner	teste_planner@embraport.net	$2y$10$F/UlwhiUTnZT39UwPEmR/uVveFKcTCA2GcZhBzw6Vvdv1JdlRGtLy	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
349	Teste da Silva 80	testesilva80	testesilva80@embraport.net	$2y$10$BRFejl00KSWk4vTzVXqbsOq19f0MjC7jYzd5uXKKENrE6hhmMwd6S	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
350	Teste dos Santos 8	testesantos8	testesantos8@embraport.net	$2y$10$ouS8BE9zBgODe6xgnQ93EuE7JIgTUSyGHFJDRNro8zT11vdnYsscu	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
351	teste dos Santos 5	testesantos5	testesantos5@embraport.net	$2y$10$N7.05N6FACQaKkbIAveeDu5dtr3OxtD7xY19U/ryEVrX0HYnr2uhW	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
352	teste printer	testeprinter	testeprinter@embraport.net	$2y$10$IOS9clnSV7wdgkEX/OHea.e6ILfzBAP1792SlFTguLr5Iz55oW2UG	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
353	teste12345	teste12345	teste12345@embraport.net	$2y$10$.MCOCk6Lw2x6Aop3CFI63egAZe9WvkBqzsOjUu9edoKH8Ooq/5Vi6	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
354	teste098	teste098	teste098@embraport.net	$2y$10$717AAC.iJahTkcecO/1mE.1GwdfZNu5tnjX.eQ66EhwsU7u5tyVMS	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:34
356	Thamara Souza Marques Coutinho	tcoutinho	tcoutinho@embraport.com	$2y$10$c11J.iwdaJ1mg7FaSKn4N.gan/DPnZMrfTAKaLXIvA0Y8gDtk8LoK	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
331	Tays Rodrigues Soares	tays.soares	tays.soares@embraport.net	$2y$10$9XPIxXBCC0wJ/c2EAjEKA.pSG8.UFzJC81sYV.fvnMuMBytblmrha	\N	14	2018-08-06 13:29:02	2018-08-28 12:05:43
327	Tatiana Regina Gonçalves	tgoncalves	tgoncalves@embraport.net	$2y$10$pVpSxsMG3Ksp/.TnJBY9J.m7flWhSsGIrNzTBjf5F7cnyTRR/5kvu	\N	6	2018-08-06 13:29:01	2018-08-14 14:22:37
359	teste-senha	teste-senha	teste-senha@embraport.net	$2y$10$JJbuehUXRFqolHZQ2VJiruOnuY6UynIjtTjDKtgqZgjZUQPg7HHx.	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
360	teste-resetpassword	teste-resetpassword	teste-resetpassword@embraport.net	$2y$10$jBaZCGCtocyqbGJOsS78Ne46r1u7uEhMFlWOr0g7CiejWDAtbr/.u	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
361	teste-cofre	teste-cofre	teste-cofre@embraport.net	$2y$10$Ke.toFxV/OITjLOFvP4njOwsdEpEtMXPshi2jX5jGJWi2UXQzvzp6	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
362	Tecnico Manutencao	tecmantemp	tecmantemp@embraport.net	$2y$10$8rKrDmcscSG3UgGFb2g9HeH8x3XuqIhym5jfvcUM6AHazw9pfaJiy	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
363	Vagner Almeida	vagneralmeida	vagneralmeida@embraport.net	$2y$10$qeBC6UyAF6dwxjqJFPHviOh01ZoXUj/eNpA/WjAKVSluiuxizRnSe	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
395	Wladimir Baptista	wladimir	wladimir@embraport.com	$2y$10$B7kztZXfD9w7OYcEh52TQ.NKoq2KA/YLmGTMKqD8MOEpzUMEmpXbu	\N	23	2018-08-06 13:29:06	2018-08-28 17:00:35
366	Welligton da Silva Gomes	welligton.gomes	welligton.gomes@embraport.net	$2y$10$TvHchl4gAR9zJJDbB8Za.OZf2GQz7wa6fXIQk5BGJlbC85oFYCQTG	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
367	William Silva De Oliveira	william.oliveira	william.oliveira@embraport.net	$2y$10$/cGE.N6KgZBPyMgp1ImhN.9d2o4GYipaLOOcNdqA6z4DmFKjqgT0S	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
368	Wilian Camargo Martins	wilian.martins	wilian.martins@embraport.net	$2y$10$lZxpFOSp.zprQkfsHTlA5..GC5TwQmrL98XPZlsiqB51o.lBsDMba	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
369	Wagner Gomes da Silva	wgsilva	wgsilva@embraport.net	$2y$10$cL5MTqyhES2iKsCKvuxPuui09LBjwJQ5wKGHE6kgdIenm2DApJDLa	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
370	Weslley Luiz Bataello Da Silva	weslley.silva	weslley.silva@embraport.net	$2y$10$59wrL46Um2APrn2IJlX./O/nNZu5Oi37wvzuSfkrNECcogQi0it7u	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
371	Wesley de Oliveira Andrade	wesleyandrade	wesleyandrade@embraport.com	$2y$10$xGWovCWfK5Aslk0C4UmtaO3uxr9iiJnkGrvbmRHR66g7yFiHsNdLO	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
372	Wesley Ricardo dos Santos Morado	wesley.morado	wesley.morado@embraport.com	$2y$10$9t20mN/YVI.SzNjk1BQzUOa0jItYL186m/Mubkz3GHAJfOV2YA6fC	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
373	Willian Leite de Camargo	wcamargo	wcamargo@embraport.net	$2y$10$kCUrUsJGjL9PFGdkYnOOs.Vka7u8ZOcXStQFsQ9chel7F8TYZQOG2	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
374	Willian Jose de Souza	williansouza	williansouza@embraport.net	$2y$10$ZKDlEFxUeQNwsm95bF527u8up.Hc5Xfk7DZOnvoAuqtCEMYHkOuTq	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
376	Wania Machado da Silva	wania.silva	wania.silva@embraport.net	$2y$10$MivE7hf7dptesoTJ6L3cQOaesbSh3jSDBtoT1eytP5ymzub5VGOUW	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
377	Walter Augusto da Cruz	waltercruz	waltercruz@embraport.net	$2y$10$xiH4gmclWbAyveu4ON.MtupdjcUY/86Gvp8YXaXbVLCSWRDc4r1AG	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
378	Walmir Ribeiro da Silva Junior	walmirsilva	walmirsilva@embraport.net	$2y$10$SKXv9iMhl0LXP.se3nLqD.EfENk84J5kUlW1U5ec6LTNCoDjEQFxq	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
379	Wagner Gomes Pereira Santos	wagnersantos	wagnersantos@embraport.com	$2y$10$qNCEJ5B1uRxpwyz4GvmgZu2Lp0XAYf60tQCWcdkJco/wnMUAug4XS	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
380	Wagner Laragnoit Martins	wagnermartins	wagnermartins@embraport.com	$2y$10$rpJk/B5s2e0wIjMu/Z30pOiwfafFl1EtJ.gA.XKdJaZSRx/YCqMli	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
381	Willian Florido Correia	willian.correia	willian.correia@embraport.com	$2y$10$K4vLFgduXyyjOrkDF6K3werQqF3zRJtRODfZZTSy8grtRrE6U3UHi	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
382	Wilson Maia da Costa Junior	wilson.costa	wilson.costa@embraport.net	$2y$10$X2AAjd8.dW75PxAe0mICQOeQ.hoECIMKC2PgPrLOS90yWxAF4XCm.	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
383	Wilson Mario Fadel Lozano	w.lozano	w.lozano@embraport.com	$2y$10$DqVOTAV5pVmpnU5LOEJOZuf6cM9tg16NrHkZJ8dPI78rEelzENZtG	\N	22	2018-08-06 13:29:05	2018-08-16 08:40:34
385	zabbixservice	zabbixservice	zabbixservice@embraport.net	$2y$10$Y.XAnSQjSdMP.A0vVl2TaO0B15JsTapLIjJr3ctQXOtwS0U5ygR0C	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
358	teste-senha4	teste-senha4	teste-senha4@embraport.net	$2y$10$95BZzLTk9gCcE2c.grFqheLWYzTzK658Klg8UHlc4UiooNTcFs1ZO	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:34
386	Youssef Ferreira Pires de Souza	ysouza	ysouza@embraport.net	$2y$10$TFjcifoVjXI52G3JKris0eBbtm40iQo0gilytahCLg0GlPAwfsofC	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
387	Yard Planner	yardplanner	yardplanner@embraport.com	$2y$10$KZyDKss/wy8vkY09qxLRYO04y1fKNKE9DMyU.fjATPD72/qFyFA1q	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
389	Usuario WSUS	wsus	wsus@embraport.net	$2y$10$e1zR3NmTDKi7XQnmtgM6JuWs2JvooB.Jy9N7ZICwkhNFogN2hXwlO	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
390	Wesley da Silva Santos	wsilva	wsilva@embraport.net	$2y$10$QHviBbb3l8chMZvudpD9y.N2CPx/456Q9olsNOynBDAnGxxu8SJfu	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
365	Sharon Renee Teixeira Shimabuku	sshimabuku	sshimabuku@embraport.com	$2y$10$tu5dFaLhegW5T6Gp95Ffmuuls36ohQHln7Afsj/dZFJqmhtJLYz1O	\N	15	2018-08-06 13:29:04	2018-08-28 12:19:33
392	Wilson Silva De Oliveira	wilson.oliveira	wilson.oliveira@embraport.net	$2y$10$fShfnPMAIB9XGaf6eVdczel.ew9kGA5YdJEy3Q5PADblMdIcdNrRO	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
393	Willian Anderson Pivato dos Santos	wpivato	wpivato@embraport.com	$2y$10$17/Kj6Hrvju/SO7R9ZOqLOly3.ci2vCe2jT8C/ghmWoJDN5mvVDMu	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
394	Wellington Gomes Pereira Santos	wpereira	wpereira@embraport.com	$2y$10$kqLmAY6t8RaIZwxoPDA1BeqjZOO8d0/raddt385L9zpNvwN51aNCy	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
396	wlademir Ferreira de Melo	wlademir.melo	wlademir.melo@embraport.com	$2y$10$MGA38Se/oR3BYKidwbA3YeCZi6Jmjm2MZsfF0aOOG4bB1Yw5W1.yy	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
397	Wes Jones	wjones	wjones@embraport.net	$2y$10$jKBxiPpX6f5oIxDqTJ/haeAsROmjpIgx1sYdx/9M7NA9OMwHraL/i	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:34
398	Wilson da Silva Junior	wilsonjunior	wilsonjunior@embraport.com	$2y$10$GUlUNB6zh96T7gI51KVPOu2ZCfQ3v1GAGL5ajvSWBWb.s.tg/5nNO	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
399	Wagner de Andrade Silva	wagner.silva	wagner.silva@embraport.net	$2y$10$bnYNsBFM6r9Z2yf0TV8nrem/AlpVZydNv5FC5yTBSQh0tAkAoUSWC	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
400	Valeska Souza Watson	vwatson	vwatson@embraport.net	$2y$10$eG4ZT3/ExZAdOHqQF2WszOaB79P9sjKU77qCNn/cT1lTWBCbPgKN.	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
401	Valec SA	valec	valec@embraport.net	$2y$10$VUUWPLU6SC9IT/G5t4/.eeMJPTTFf6paXykBormuS90sxG53QPPyu	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
391	William Albino Ribeiro	wribeiro	wribeiro@embraport.net	$2y$10$xf.zPLTur4WhjGsMnVmpWun6ASr5OvoBQUVsUHU7nIICjSrej8AAG	\N	14	2018-08-06 13:29:06	2018-08-28 12:05:43
384	Wellington da Silva Santiago	wsantiago	wsantiago@embraport.com	$2y$10$jvzUGVDcRddL87ToSHbWMeVAJL1RukjZYdw3tl/9r5Q1msZuzW7UO	\N	5	2018-08-06 13:29:06	2018-08-14 14:27:14
404	Venicio Kawel Santos Oliveira	venicio.oliveira	venicio.oliveira@embraport.net	$2y$10$Iw5wb01aSqLkYGABnbOotuCRrABAyb0YMNuv0r/4nLoIAIYmWgOAa	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
405	VCENTER User	vcenter-adm	vcenter-adm@embraport.net	$2y$10$HUGetLw1mhzHo7D1uxYmN.OcMntDA60BUKlNxEiOwm/r8YleScOGi	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
406	Tatiana Valeria Cambiaghi Bueno	vbueno	vbueno@embraport.net	$2y$10$aiZwXZTF7uiOAX1oziGY2eICY4eP1BdPQxIgViKA0Z6IshWi7DK1G	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
407	vbs	vbs	vbs@embraport.com	$2y$10$vYpCKtJMP.svsSyYpXzK5.OfK9akcIB/jwDrk.YO4zOS316vVgduC	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
408	Vazios	vazios	vazios@embraport.com	$2y$10$mzst4AANoOz/JiXdyJbnm./6lLmYq9b/R7Dav.EO5GR3sdcxb7yE.	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
409	Vanessa Valerio Rodrigues	vanessarodrigues	vanessarodrigues@embraport.net	$2y$10$n6JLPXalL2QPSur2gJebnOCDWzz94Ptm8htwPZ45idd.HskNxpGui	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
410	Vivian Hubert	vhubert	vhubert@embraport.net	$2y$10$HNvXfxJRyZwKgxjs6k5RMuUK0Ff8hjECep50m0qMI7ES9bHsg6dD.	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
411	Vanessa Azevedo de Miranda	vanessa.miranda	vanessa.miranda@embraport.com	$2y$10$fcgNHBYwJGqUJ.RUu4Lo1e5hkeeThnFtHGMjdYgwXnYYs8MeuaING	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
413	Vanderson De Jesus Canuto	vanderson.canuto	vanderson.canuto@embraport.net	$2y$10$eTm.pbDctQrbEoprhhnDauStEtP3aYljg7bcEF4JoFMrB/ODMBrUa	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
414	Vanderlei dos Santos Pontes	vanderlei.pontes	vanderlei.pontes@embraport.net	$2y$10$BEIvdhwQAH7H.7kTEYW/fOcyxnTOWcKTFYjxEKcw4ocKZ8h2o931u	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
415	Vander Aparecido Valerio	vander.valerio	vander.valerio@embraport.net	$2y$10$n1x/qaIyl4HBx2a6yJWLrOcl3QhNLzD5LQJZk0FbwKJUosZnR0h1e	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
416	Valter Vieira De Menezes	valter.menezes	valter.menezes@embraport.net	$2y$10$H.AlznmnpXklUGnIbtY4iuiez1SKZqbEdJIXm1YfI9M8p2shwrj32	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
417	Versiant Navis	versiant-navis	versiant-navis@embraport.net	$2y$10$Pl0P.GWlVgVTcfhrQTgfJ.JvU.irmacOEwuaB8hI9../6XBg2X4v.	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
419	Victor Vargas	vvargas	vvargas@embraport.net	$2y$10$4NHx6/mQ3tMe8dm6/hQQXO6fKEBZsbpoTpqo4CcR2JfeqD1IR4WZy	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
420	Vita IT User	vitait	vitait@embraport.net	$2y$10$IGVNr6a.f8bByhTEo0oDhOr4JKp5.UXhq0lr3ESbqebE.ake599Y.	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
421	Vinicius de Oliveira Costa Santana	vsantana	vsantana@embraport.net	$2y$10$dZc3slbJcyx3JPqi4ilUgelk5ibEI.E9UXxO78UbalwGh8vxwtaiS	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
422	Vania Messias Rocha	vrocha	vrocha@embraport.com	$2y$10$W8rMNhbtQ0CBj/8L4Bu0bufawx0/zOWrimBwhfGhE8eQSPkRq5Cj2	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
423	Vessel Planner	vplanner	vplanner@embraport.com	$2y$10$rgfvK9szKGfgO395PUxExOHe0pXUHP4heS72pDely1ZdSSFuN151y	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
424	Vinicius Costa Nogueira da Silva	vnogueira	vnogueira@embraport.net	$2y$10$B.mtqPDUxwbuP368b6FYaO05y6KTEiNTNmg0f4FB3rLTS9OSGsfam	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
425	Victor Campos Lins	vlins	vlins@embraport.net	$2y$10$55AemHcNXJBs0R3Sj16pvObMavpRwfZOQcHsezqwnDaH2TciPK4EG	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:34
426	Veronica Lemos De Oliveira	vlemos	vlemos@embraport.net	$2y$10$tOsNU8g.VB23yiEq./JjZuw73pS4l2M//FF6FuQx7BOt/RO1mVtwS	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
427	Viviane Cristina de Oliveira	violiveira	violiveira@embraport.net	$2y$10$MuzAvV15DbveAGba0zwYKuZPja2125v/295UTu.ucKGSZzkzFPm/i	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
428	Victor Stallone Dos Santos	victor.santos	victor.santos@embraport.com	$2y$10$9kgmu/9ca/4EBxha6rF7o.TcttyfXs.YEWtqpDWxw8iApuxs0B4iG	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
429	Vinicius De Oliveira Costa Santana	vinicius.santana	vinicius.santana@embraport.net	$2y$10$SdurS971x4.bDzB8gBxv7.YcjF69AdMZz6Zn.GVlPEOCc.8ba7EXW	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
430	Vinicius Ferreira	vinicius.ferreira	vinicius.ferreira@embraport.net	$2y$10$O.Xy3xYEgneRXm/n7HDCNe6meWdo0aqLgqqNU6zSK2zulhQUXSXte	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
431	Vinicius Espuri Barboza	vinicius.espuri	vinicius.espuri@embraport.net	$2y$10$CVZ7o/fib6B1xjkLdxSD.usWl.mrtypyiIrJ22.EmuPpYsK..Lpxm	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:34
432	VINICIUS PINTO DE CASTILHO	vinicius.castilho	vinicius.castilho@embraport.net	$2y$10$fxusoBr5DhY.WZC.dqNEluBc2DzSLEv4Oi6Rjq.eCzu0zVBhL8JpW	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
433	Vinicius Pimentel Argello	vinicius.argello	vinicius.argello@embraport.com	$2y$10$dUHl0MUcl702zKdyCIYl1OgoNhZyjkDCEk0YY4dgopDfs4b.mtnIa	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
434	Victor Alex Moreira dos Santos	victormoreira	victormoreira@embraport.com	$2y$10$nowxNmw6diOrVLDPkz332eOgnSOTSoohya7Ye8TKbXCT.Ah6AqfF6	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
435	Victor Quirino de Almeida dos Santos	victoralmeida	victoralmeida@embraport.net	$2y$10$fAF.77tLXzLuKLFDN6iLPuFpxjldcOnfCONxY/YkZI28nifyXN2We	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
436	WMAS Store	store-wmas	store-wmas@embraport.net	$2y$10$1qp21PF4VimWpGycok2aD.CbCmr3aXUNV9cn7rrSju/dVh.xxHHF.	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
437	Sidney Severiano de Oliveira	sseveriano	sseveriano@embraport.com	$2y$10$BYp3W34hGKJQrJEUeWiGxOAQ0FJ.mDclwH6iAP36.XitKpCgYahAi	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
438	Qualitor Autenticação	qualitoradm	qualitoradm@embraport.net	$2y$10$fDhqvSFL7vIT0HbRVzUNmum8ZzUaVrWXzQnl58myDz6MnmZUAjXXG	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
439	Ronaldo Francisco dos Santos	rfrancisco	rfrancisco@embraport.net	$2y$10$OG0CMze1mhjOdSO1IBOg6Oj6ReDZaeXbL.UvkQsc.OGvrqH4SCzhC	\N	22	2018-08-06 13:29:09	2018-08-16 08:40:35
440	Ricardo Aparecido da Silva	ricardo.silva	ricardo.silva@embraport.net	$2y$10$xYUEagpoUo2W/KipnQPXseuFAxir/8FH/ZcxI5qMRrJib3mypqG5q	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
441	Ricardo Simoes Clemente	ricardo.clemente	ricardo.clemente@embraport.net	$2y$10$xU3Pg6uepy2I048DwIZ0IuUcF2V1h/DpD68SlMxZgAbAedLMGlyRW	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
442	Rafael Henrique Brito Silva dos Reis	rhbrito	rhbrito@embraport.net	$2y$10$MhXxCjodOru.kqCMl0HmjOy.RWffvnzRxt9RJaDw6HKsX6ooPavGm	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
412	Vanessa Campos Lins	vanessa.lins	vanessa.lins@embraport.com	$2y$10$PG1Z5Juy8eVNT8YLIyiD6On2vlNvAifybs24lJSczFmQ4VxPaU0Xa	5PBkdVuWpZggFTdnXvBOXVI2dk1Dh8ei6nXMgpxL56ToFLsiYQjoJnfGMkgF	22	2018-08-06 13:29:08	2018-08-16 08:40:34
403	Veronica Souza Mendonca	veronica.mendonca	veronica.mendonca@embraport.net	$2y$10$kpcNaA/gCswKOitYHbe6DuRQ4iztsLMyvjCh6DE/HMPp69lg/c44y	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:34
443	Rodrigo Gouveia Nunes	rgnunes	rgnunes@embraport.com	$2y$10$/mUdZXWVEaxbjzoH9hLs8.mh4SOh5KRHDZd78/ptVxt5ziEFi64S2	\N	21	2018-08-06 13:29:10	2018-08-14 15:35:16
444	Ricardo Generozo	rgenerozo	rgenerozo@embraport.com	$2y$10$jRHFu/ovXoa96GKtldFQ6eOj7C0uoISxIntOZzfxDTBMRR6rq5w4a	\N	13	2018-08-06 13:29:10	2018-08-14 15:31:15
447	Rubens Vera Pelegrino Junior	rjunior	rjunior@embraport.com	$2y$10$ntZDb.p6M6SMd90FNCYQCeGygqORMlZwC2Xu2SjWY.3ykUdd1/8HK	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
448	Report User SCCM	report_sccm	report_sccm@embraport.net	$2y$10$49NoJriE5QPlhKeN3yvJ2uBipOx2vMAgTorRtLFidhXJl0w3t4Zn2	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
449	Renato Raimundo da Silva	renatosilva	renatosilva@embraport.com	$2y$10$n7fdLoox5rm0LE75Uhi7QeG9ivmOlMtBYhmlv11mQRB./AkynJ9/m	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
450	Renato Wajchenberg	renato.wajchenberg	renato.wajchenberg@embraport.net	$2y$10$G9Ij2GSr6jNRE15sjjkgwudZU6.0qVTV4pIGmZ/n6hXi1kOGEDViK	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
489	Raquel Rafaelle Lima De Oliveira	r.oliveira	r.oliveira@embraport.com	$2y$10$0cRE/.kyDg7iqqu1N3CuDe7Y6oflsoIaX.yIfllUwCt86VgfEhivW	3BHNTfRq6yaglWqhOJpR2vJkUlmziObXn2mmKolll5CAaT1hgUh7JCP3bEZc	9	2018-08-06 13:29:13	2018-08-28 09:05:59
452	Renata Rocha de Lima	renatarocha	renatarocha@embraport.com	$2y$10$rtDl4GU2ewO3CO0/s8vbvOHEx9c6JHPZvckcBezXeEBGlbPEggtx.	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
453	Renata Silva de Jesus	renatajesus	renatajesus@embraport.com	$2y$10$EIGeQnQvBZXcFzwG7eLnS.wRcfSI93l4/CU/WtVHxX71.7Kn2dnne	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
454	Reginaldo Egertt Ishii	rishii	rishii@embraport.net	$2y$10$X8UWnIbOPtuQAo1j.kgGJObitzK1LnSh1/pJ8QH2G1ZcIVVziYdwa	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
455	Rafael dos Santos Mattos	rmattos	rmattos@embraport.net	$2y$10$.5zC8N6AA8zBUnW8R5UiauMfQJlXXTo5GodOxGyypifo4UvcOBJDa	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
456	Renata Henrique do Carmo	renatacarmo	renatacarmo@embraport.net	$2y$10$xa.MSwP/rWdH0G6y0e4wPOZIbw/8JURSiiaOFYUEhWrbsc/2IGBWS	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
457	Roberto Silva De Oliveira Archero	roberto.archero	roberto.archero@embraport.net	$2y$10$1IUFpAHU9GzNt3rUV76E3.tC50o.vR1C/Ll7eBv7L3I4PLN9TlTuu	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
458	Robson Tiburcio	robsontiburcio	robsontiburcio@embraport.net	$2y$10$d1SiELP22aq1GqKl1EYzIeo7hag/54znWgs9kDvd3EZWRXmMi5j26	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
459	Roberto Bezerra Vidal	roberto.vidal	roberto.vidal@embraport.com	$2y$10$i./SDjMb6JELl/nPAXsiWO.b/dwrIOZwYOFld9BOrxvbqCl9kHG9i	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
461	Roberto Morais Martins	roberto.martins	roberto.martins@embraport.com	$2y$10$tRNpuxQRk218RGklXxZWhecE6vGKGFtRfifQVEaFdI2y8B.FOVghq	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
462	Roberto Alves Dos Santos Junior	roberto.junior	roberto.junior@embraport.net	$2y$10$4z.5bWzUsTRANO6ez1axm.APCyTvBAJJFpeOXJDJuOUoYfK.3TAI6	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
463	Roberto Bomfim da Silva	roberto.bomfim	roberto.bomfim@embraport.net	$2y$10$NIoSUQn/j6syYJhOD47ES.kLHgakI25rQdIUN5x2iNWyGmq9GsUJ6	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
464	Roberta Alexandre Leal	roberta.leal	roberta.leal@embraport.net	$2y$10$RnGQH6YzrJes9MqQN1iaT.jKrHatcDBeTkbrpFAIDwQoT5QpVxOjG	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
465	Renan Pedro de Menezes	rmenezes	rmenezes@embraport.net	$2y$10$jSkazm3tx5AJwdiCXxYk2Ox79JBVQJDVnbtHFGIkXYx.OjTnzAFWi	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
467	Renato Barata Neto	rneto	rneto@embraport.net	$2y$10$ScsD5GPlWiJG.dIce8P9l.DhkYeqCqjWO0mhNcFdUgKnUT2cOWiFe	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:35
476	Raphael de Moura Ferreira Clarke	raphael.clarke	raphael.clarke@embraport.com	$2y$10$sFsgoSLcS74fD2UMUPZcV.xovMDkeLDl5qfAqsuaqQDVYwue2njui	\N	10	2018-08-06 13:29:12	2018-08-28 09:18:00
468	Rodrigo de Matos Ribeiro	rmribeiro	rmribeiro@embraport.net	$2y$10$CZ9x1rPZiRB1rOiNViLcnuXFiLqZq0sEhHq5FAydW1W7dhy4ivauO	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
469	Robert de Moura Paulino	rmpaulino	rmpaulino@embraport.com	$2y$10$9UoGiZ/hMEGRO5zR4eDrgu8VvN.JPGKRacHAXtgxP2uJG/qStsitO	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
470	Renan Monteiro	rmonteiro	rmonteiro@embraport.net	$2y$10$OxHr7eV3OeJWxy2u4auahOK/lkQcDmMH9H2OI6LRWa/hulml7w9aa	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
471	Rafael Marcos Nunes	rmnunes	rmnunes@embraport.com	$2y$10$TomjU7SCIMywwUY1zQ44yOsrtehZ4/kiHSnBYhayYccLpx/inoAFa	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
472	Renata de Oliveira Santos Ferreira	renataferreira	renataferreira@embraport.com	$2y$10$HqGPADX5pTX9KSuHptuW7uhGCpRIhwn2lS0MCiYcXthPrLGSAiWL6	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
474	Rodrigo Silva Batista	rodrigo.batista	rodrigo.batista@embraport.com	$2y$10$RcU3xtzWIs2Jrkf8xkQn2.YjG3pZW9aFgeH6B/Zrhk12L54usBbNC	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
466	Renato Nunes Ferreira	rnferreira	rnferreira@embraport.net	$2y$10$iubueaOlBed4zc0X50fsgOitjbCd.dNDShRm2xlya4KFO24dRWJVS	\N	21	2018-08-06 13:29:11	2018-08-14 15:35:16
475	Rafael Soares Carvalho Junior	rafaelsoares	rafaelsoares@embraport.net	$2y$10$QC.my2crtfruvz/2CQ7EG.TIMIavd3p030YtazRxKXNl4ZrHOohy2	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
477	Raphael Ferreira Cantarino	raphael.cantarino	raphael.cantarino@embraport.net	$2y$10$4dxw1nRwbSi57eD5/6e6buQyS5xsh5QzkxnnoyZ6aCZXhNpQ4DM5a	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
473	Renata Silva Beu	renatabeu	renatabeu@embraport.com	$2y$10$T79YuzeWR3zDja09AKtO8.MQGHTC1rZZfcpp/OQxWzEwkOEaY3Zum	\N	11	2018-08-06 13:29:12	2018-08-14 14:43:48
478	Raoni Azevedo Lima Santos	raoni.santos	raoni.santos@embraport.net	$2y$10$Vkl.A0NWO9ueYObapLsAy.Gdyzmp64OEbrGDMU2HPWRm12m.FjkJO	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
479	Ramesh Ramanath	ramesh.ramanath	ramesh.ramanath@embraport.net	$2y$10$OpqheiC9jrsVaQmDjDAyiOjTlfOFY4lVquNUH0H4.8XavCLSnzShe	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
480	raggix	raggix	raggix@embraport.net	$2y$10$vXdqHlhcaGljsH3XfihMve0/trUeRgAcHN0VlnV8bawCDswN5WF7W	\N	22	2018-08-06 13:29:12	2018-08-16 08:40:35
482	Rafael Matos de Matos	rafaelmatos	rafaelmatos@embraport.com	$2y$10$PWv5w1eMuVZqJBT7Zc7lcOzi4NOl984G.LlU0yCkBwmllCeMcN3Xm	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
484	Rafaelle Fernandes	rafaelle.fernandes	rafaelle.fernandes@embraport.com	$2y$10$AD34zu95JPW.V2tw39IDcOy64vLet1VKYzli9DjISKvLzgZ9yAG6W	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
486	Rafael Quadros Gouveia	rafael.gouveia	rafael.gouveia@embraport.com	$2y$10$8tQDfzrD0Vyhztl50mu/juj9p86W5SzVtayWQtPa8HGdLD/3UeWxq	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
487	Rafael Cintra Barreto	rafael.barreto	rafael.barreto@embraport.com	$2y$10$plpdLR7OqERSmezaGGIA..bKQWDjrAXGtlRi1H/.4UfvRv1yrDk1O	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
488	Renato Alexandre de Carvalho	racarvalho	racarvalho@embraport.com	$2y$10$s7errSYgzqqdAifoLGe8rOJ7JPHm2gcWuU4Nrnz8VKvbLopaQ3qXW	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
485	Rafael Martins de Lima	rafael.lima	rafael.lima@embraport.com	$2y$10$RlvwXpbZ0JMYfGvpgFsxneQ4zuhPeRgohLWiYBDv47d8vZSn/yv6O	uzeJHjFsGFzVNpTdcnyoi5BTaKUzcoLWDbGy9bdbHNkMsaFWszXCgMhAV5mm	22	2018-08-06 13:29:13	2018-08-16 08:40:35
446	Reserva Pool	reservapool	reservapool@embraport.net	$2y$10$B0gmEzorVvaQy5i3dhQ76eLVt5YRz3qJlpSLBB3g7R9PHghrWFD9a	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:35
451	Renato Paulo Goncalves Filho	renato.goncalves	renato.goncalves@embraport.net	$2y$10$u/d7eoNc3Aj0A/WSkuzer.ext6imt5of0WhtS/s9Zdfy11T3V2DJe	\N	22	2018-08-06 13:29:10	2018-08-29 11:49:17
493	Roberto Dias	rdias	rdias@embraport.net	$2y$10$LEMVg6xQgSi5bU.S83J6suEhhPbzQ9PFj/P92/bDpaJfPn5VNxWUa	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
494	Remoto	remoto	remoto@embraport.net	$2y$10$UDSR07LCOoghERpVlkD1iOPdz7pfLEFcWOzY5KkKJ3o/uC6/2gIXK	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
495	Remessa EBS	remessa-ebs	remessa-ebs@embraport.net	$2y$10$pjpDKnlqK3jZrZyRAQlLJ.tOUDuOrjx0GpC8kClKSZwGJY0.GP9Za	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:35
496	Regilson Pereira de Jesus	regilson.jesus	regilson.jesus@embraport.com	$2y$10$biqi.DoyO7z8gZspUwIW2ePZnGNa1Sx9Eys19Xy44PnpzisZjNIA6	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
497	Reefer	reefer	reefer@embraport.com	$2y$10$WPam1Jo6lUxgyNsYdhB0oeVdJf6aYXmtrEuhxwjrjDIosCCI7wofa	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
498	Recrutamento e Seleção	recrutamento	recrutamento@embraport.com	$2y$10$uGwY3Gu7Ew/qHRw34M2icu0TyVR1dczIe0AEGTeHLo.rZNfkeSmvG	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
499	Rodrigo Duarte de Queiroz	rdqueiroz	rdqueiroz@embraport.net	$2y$10$eGsrY1pcKp0wiC9tE5y4aunCoPrPouiMJkFUWhhW/ffyIGc7fBYTy	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
500	Raul De La Cruz	rcruz	rcruz@embraport.net	$2y$10$2Dz/kcUWMdy1x3EErspqqejUc8RXmWK2wHk6xg8jAfvpVSESgK/G6	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
501	Raphael Nunes - Odebrecht	raphael.nunes	raphael.nunes@embraport.net	$2y$10$WKHbLpn3QJ8L6fCcI9TLmu3H2gYM5W5PfjQsF7o3f3GJv5UnXryMm	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
502	Rodrigo Cipriano	rcipriano	rcipriano@embraport.net	$2y$10$.FS8ebtW0jWurN8vjwJPSuarrq0MTRiHK.mto1bznqtcYkuNAF4d2	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
504	Rayane Oliveira Andrade de Souza	rayane.souza	rayane.souza@embraport.net	$2y$10$sUzpRZmZfME2rANgnEs4ueK1nyHIfW83LXO4fjP4zL5Pmmc70UJj6	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
523	Daniel Dos Santos	santos.daniel	santos.daniel@embraport.com	$2y$10$ZmZiRfYsbl6BSKcJcMO0eeqa7NOiqRSbuRAgWAs1uknTXxd1WFsI6	\N	20	2018-08-06 13:29:15	2018-08-14 15:50:42
505	Rubens Faria de Araujo	raraujo	raraujo@embraport.net	$2y$10$Caq03CuhzwqBWwQR2kpqlO1zNaaI35ikwIbnW00RX7IO/8r.18.i2	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
506	Rapiscan User 2	rapiscan.2	rapiscan.2@embraport.net	$2y$10$J6wwiJSzI0zkpg6Vy.EuF.B9cHUn0QsJvYoXSlxS3GjXCUMwfmkLW	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
507	Rapiscan User 1	rapiscan.1	rapiscan.1@embraport.net	$2y$10$zlWWlf0XwaL4HJkAZ58i...Nea9UAxAZ6mbiF2iYTLtIZ4p.T3QsO	\N	22	2018-08-06 13:29:14	2018-08-16 08:40:35
510	Rodrigo Soares Correa	rodrigo.correa	rodrigo.correa@embraport.net	$2y$10$oHngmp7QkjKjaoF5x4um5e0zbVTCVGVPtn25XPa2ltwSPlOUHUZwy	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
503	Rafaella Gaudencio Mauro Carlan	rcarlan	rcarlan@embraport.com	$2y$10$EuVWsawRztIlGKTHYcu/kOZaVPFHuo/99WL3kzbN1WeUe3BbZAiCq	\N	13	2018-08-06 13:29:14	2018-08-14 15:31:15
512	System Center Admin	sccmadmin	sccmadmin@embraport.net	$2y$10$8CamQeQm6CZssHn.IJLPUOf0T7fG4xIU9mOUI/NsszU.rPARlSp32	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
509	Rodolfo Gimenez Lima	rodolfo.lima	rodolfo.lima@embraport.com	$2y$10$x.tPQ9zqJZJZOlIom0ChmOuqp./C2EtHBKffWxzwCMeYZwVmS9Z.6	\N	12	2018-08-06 13:29:14	2018-08-14 15:28:08
513	Share N4 Bug	sharen4	sharen4@embraport.net	$2y$10$nQtgCsQm3MD83Gu6GFxHLexEaugMDbuP4Ztn2qGapu51VI3ln6cOi	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
515	Security_Gate	security_gate	security_gate@embraport.net	$2y$10$pksHoqFplUV/0UG/O5X11e1WJdR79UrYIWw0TaHaJZplNZajekH4u	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
516	secadm	secadm	secadm@embraport.net	$2y$10$/eO2C9WaY.2aiJ.5H6vMGe8F9LoHAFUh6BAznYNeVzy8Ri2bzpcpy	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
517	SearchResults	SM_ed875a871b7343289	SearchResults@terminalembraport.com.br	$2y$10$sSQwNwkHMZOookLC4ZM7z.eDXRkyOYeIKL42ZyJ6Mju3QiUb7ESbK	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
518	SE138	se138	se138@embraport.net	$2y$10$.HXG4CN30ioU/yQcihvXI.02RNJ84j1e/3YRZfKJANrsLW1q6Ntvu	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
508	Raphael Soares Perez	raphael.perez	raphael.perez@embraport.com	$2y$10$G/RkUQiqn72KnpLoVZKwr.ptfLS1BWds6F0N58I7PtE1X2qeQgnqy	\N	22	2018-08-06 13:29:14	2018-08-29 11:49:17
520	SIDNEI JOSE GERMANO DE SANTANA	sidnei.santana	sidnei.santana@embraport.net	$2y$10$hNsCGWnfYGNjndSg90lt3ehSK5egMG38KsX66aZg9xbj8e/pNwNp.	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
521	Sarah Marcuche Goncalves	sarah.goncalves	sarah.goncalves@embraport.com	$2y$10$GSzm1bmHgZ37Q6ogeO57I.5za3nmFmVQh1iO2wX.GJ0p79Sisww1y	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
522	Sala Santos	santos	santos@embraport.com	$2y$10$gKaTqMW7zFnS1xU1gU4bS.46lbfq26ljSLrkdBWmqr1fBuXwOgsKW	\N	22	2018-08-06 13:29:15	2018-08-16 08:40:35
524	Sandro Afonso Fernandes	sandro.fernandes	sandro.fernandes@embraport.com	$2y$10$QRIio4babpfPH4Kd3tQOt.6Rcep/nKNEDD2Xs.TMINaHOpXLvcmzy	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
528	Sidney Esteves Veloso	sidneyveloso	sidneyveloso@embraport.com	$2y$10$kMasKGlcY012uJJO.Z0pJeLbInopbQYE8vGauRcQeVyQBfaDL/8uq	\N	13	2018-08-06 13:29:16	2018-08-28 11:38:19
525	Sala Sandi	sandi	sandi@embraport.com	$2y$10$NgbmMycXCp7/J6e6PqZPNefhv.SfTqfTdv8AkTyRdmUvgI04wWPeO	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
526	Sanderlan Soares Oliveira	sanderlan	sanderlan@embraport.net	$2y$10$7WS4jvXzdiOIWYB.0A9Tr.7T.aMoQ2V1HfSNx516fwcqGwlO96lEW	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
527	Fabio Medrano Siccherino	siccherino	siccherino@embraport.com	$2y$10$IpTsHrGQIERiKRW0J1Wg1OkaGsHfWQPT2htwqYj.t1DU1rKcDpNeC	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
529	Samanta Dos Santos Alves	samanta.alves	samanta.alves@embraport.com	$2y$10$U5rzvLSTEE2A8KZ8n6Y6yuPg6twk036UFHwuYP4M2VRIhAw70CvOW	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
530	Solicitações  Administrativas	solicitacao.adm	solicitacao.adm@embraport.net	$2y$10$cyRfSURJyUw8E4f.ktxIJehiyt11SiDORbG2/pCo.jZ4SR0KTiRAO	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
531	Pesquisa Satisfação Serv. ADM	ssadm	ssadm@embraport.net	$2y$10$/8/g.LSltwqni28J2P.rDuVrG4mx7zw5.n8KzJ3B.gWLgYBuKdLRO	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
532	Roberto dos Santos	sroberto	sroberto@embraport.net	$2y$10$syyAJkFnQ9blm0fU8ggzfOjFXMI/S9wpL8XP.4aoxTpV9P/TvwFL.	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
533	SRM User	srm	srm@embraport.net	$2y$10$ppSwsWGZbXGMRkX.maKB5OlU3BTfImRn4nypHttD4CBQDtBgGvZD6	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
534	Silvana Rocha de Almeida	sralmeida	sralmeida@embraport.com	$2y$10$7XYhw7282C707qtSfe0xqeDQFIx3cjx0nGm698b.LcmaG6tsCmwRy	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
535	Shirlei da Silva Petrechem Gonzalez	spgonzalez	spgonzalez@embraport.com	$2y$10$xkA9ATDBdS0Fbfzg5wWyf.J4PuXzoPY9nVas.mQW0hdFuSLKgk.ty	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
492	Renan de Mattos Gonçalves	renangoncalves	renangoncalves@embraport.com	$2y$10$h7qKAzlhOMlKlxL8taWHvucypSMbXTVdH5KETHGZ7PWcwkS4D0r7W	\N	16	2018-08-06 13:29:13	2018-08-28 11:28:13
511	Sergio Sampaio Garcia	ssampaio	SSAMPAIO@embraport.com	$2y$10$5aWqSAm2ZxuzSs57VI0JGueq.0zdTDQukbzXFQyKKTRKnT02etb/.	\N	8	2018-08-06 13:29:15	2018-08-14 14:34:16
543	Allan dos Anjos Silva	silvaallan	silvaallan@embraport.net	$2y$10$aZ0YPMfLk3Q1F52mtgmoHuZfkHsu/rSxs2TjcguVOw5kr9PeETAee	\N	15	2018-08-06 13:29:17	2018-08-28 12:19:33
540	Sidnei de Abreu Macedo Jr	smacedo	smacedo@embraport.net	$2y$10$DB/5.ByK5KUZLe9aAIkfMeB6g7BBa115grUPMCT1.yrbqnlf9ReBC	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
537	Seguranca Informacao User - ODB	siemb-odb	siemb-odb@embraport.net	$2y$10$rPFHMki7gUyaFP6zspsuu.YVZuuYbfggTKqYAzQMcOsvji4r3W84O	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:35
541	Sergio Ricardo Jerolamo	sjerolamo	sjerolamo@embraport.net	$2y$10$n4oqopOKkBXKi/cu7BaNZ.yxSckTv2l8SSAdWTc4qQpAK0kCxAwDS	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
542	Sinval De Aragao Lopes	sinval.lopes	sinval.lopes@embraport.net	$2y$10$gH9t2nHQ1pTZI691C/cNNOYsedhaBMc1BkEI7CSXKRvByZcBydXSa	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
579	Raquel Romero	rromero	rromero@embraport.net	$2y$10$djuk0Om2A11Y/sCAVcrJneWzDtzVlvPle9uxBj4hDF1sy6FayvGay	\N	15	2018-08-06 13:29:19	2018-08-28 12:19:33
545	Rodrigo Vergilio Leite	rvleite	rvleite@embraport.net	$2y$10$jP97TFNDEUzJFbPzhksV3uI781gIPF5Bp5BjGPJZnKXVZ.JBfx2z6	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
546	Rodrigo de Lima Oliveira	rodrigo.lima	rodrigo.lima@embraport.net	$2y$10$tFVE6hMPbAluvy5xgRXo7u17gYyxi5dwbBZFkoqHsUd7ahGCockpO	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
547	Ronaldo EBS-IT	ronaldo-ebs	ronaldo-ebs@embraport.net	$2y$10$qdU.srHBh502uV.CCDM7F.s3Yup5.ywm2rwGEZCUOI5apAJC8crGm	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
549	Rafael Pedrozo Cremasco	rpedrozo	rpedrozo@embraport.com	$2y$10$36HboKaJYrZSt8YEv7Lj5OqCvGiN3VtFX1UXRwETbHl0Pb3E7K/di	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
573	Rebeca Rossi Rispoli	rrispoli	rrispoli@embraport.com	$2y$10$jgvfNY6mpAbyFzRRLhqY2.AW9xo.UVhob0Hp/AZnyYQTfw83qXYvq	\N	7	2018-08-06 13:29:19	2018-08-14 14:32:44
550	Ricardo Pimentel Bandeira	rpbandeira	rpbandeira@embraport.net	$2y$10$9tQUA3qlhHZ7eMKFGsIKtOcTTlYWJzfoWZ3kA8YViso4KIlVVjFTm	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
551	Rosivaldo Pereira da Silva	rosivaldosilva	rosivaldosilva@embraport.net	$2y$10$Ql4uvTIlCYyxiVhZY.vpSOdWsjnuOD9tNSXeryQKw2deKyUMrf8aG	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:35
552	Ronaldo dos Santos Silva	ronaldosantos	ronaldosantos@embraport.com	$2y$10$ErZWymLPb.enhx.PceFvlOQR1lSGKZ2HRXf9O6VIoz0dpACTBdGjO	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
553	Ronaldo Dourado Dos Santos	ronaldo.santos	ronaldo.santos@embraport.net	$2y$10$Q.b.8VgSsM2ZEnXRlGKTH.z6mcqQD845R.NdW99MapxvkKGhWd4gy	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
554	Romario Ferreira Mendes de Paiva	romario.paiva	romario.paiva@embraport.net	$2y$10$MkOib5oszHvVc4Z7gOpoqufvWsbCV39eKsj0CYPKsrB9Za72/y/Ye	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
555	Ricardo de Azevedo Pinto	rpinto	rpinto@embraport.net	$2y$10$eoeCgWwqexwqc/NelIyEO.r2WuEXr7IKSUgtj22G7F5S8ik4XlXwS	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
556	Ricardo Zitelmann Santos de Oliva	roliva	roliva@embraport.net	$2y$10$6aJQRslCe9VbZCUieCVGp.GBaYeGzPQ66HkdVLJcUg9ffTOdlEAOa	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
557	Rogerio Batista Marcos da Silva	rogerio.silva	rogerio.silva@embraport.com	$2y$10$THEnAUn1f/7kp4/3in6qv.PAUVeN4iOoXOvjZzi9P.gNtPtpykQdu	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
558	Rodrigo Olivio	rodrigoolivio	rodrigoolivio@embraport.net	$2y$10$x85IKGmh71z6ljy670fY3.4UIUx521lDOS4uBxDSmhLBA.0YP/9wy	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
559	Rodrigo Lisboa Landiva Teixeira	rodrigo.teixeira	rodrigo.teixeira@embraport.com	$2y$10$E7zBhE1Bttbz5sZBfeHTouocpXmBXVHxpYneYEE8nDdL43QNN/dF6	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
560	Rodrigo Dos Santos	rodrigo.santos	rodrigo.santos@embraport.net	$2y$10$dsIjQ6T5oVS/y2NRFuDcD.A8KcQB.E0LV8ajYMBJFACzTTrfGiFgK	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
561	Rodrigo Ferreira Marques	rodrigo.marques	rodrigo.marques@embraport.net	$2y$10$f/b7RXaCJP6wKvF5.C7OnO1ZGHumDu5LY3NC47BezdPkVwOmnIaai	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
612	Carlos Gustavo Henrique S. F. Pereira Borges	cborges	cborges@embraport.net	$2y$10$GTkR12qDaNXPmf9baJeUz.nN4bCdeEHQjZJJxGkBuTd14jt6scP8S	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
538	Stephany Calderaro Milheiro	smilheiro	smilheiro@embraport.com	$2y$10$o1pbpV5KQA7nuQlwlI0Jb.zFVZx/5gUkjElSvqBxv3u7C.5wXHGYW	OautKBU3RzkmbKPz5l6WDjb56OI8scC7rfCV1hGE3yKKEEQCrHm6Kg4KIVnI	15	2018-08-06 13:29:17	2018-08-28 12:19:33
563	Rafael Pinto Sousa	rpsousa	rpsousa@embraport.com	$2y$10$kddG1haqVIvi0RkLyG.XMOoj9XCgFf3BJGEdwyLfGrZ8Dcyh1rofC	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
564	Ricardo Vitorino Soares	rvitorino	rvitorino@embraport.com	$2y$10$DGunlMMkl60ctG7Mkt0/t.krX2iBTm24fAZirt3KfWDRzhCHb.6Oa	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
565	Roberto Tenorio Suzano da Silva	rsuzano	rsuzano@embraport.net	$2y$10$jzcjE3MQIodrQgyRgbJc4OxYceiglnnBVix9sMAyv1ZzxuYKqd7Le	\N	22	2018-08-06 13:29:18	2018-08-16 08:40:35
566	Rodrigo Chaves Araujo Viana	rviana	rviana@embraport.net	$2y$10$OG8Ag1spr6/NoaGbCdfHaODAGgKxxBYh8kjWGuQHgEiyFdDHsUexi	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
567	Roberta Batista Vaz Tucano	rvaz	rvaz@embraport.com	$2y$10$oj/Da2YdLG4vQ1oU2EuTqutN/bAtds8JOhaTBEtduz4nfDjPasf3i	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
568	Raphaella Vasiliauskas	rvasiliauskas	rvasiliauskas@embraport.com	$2y$10$W8ZJorIbdA8xO86ViN.TNuf7Ms02p8tgneAFaJbeWZ2SLhP9z9yKS	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
570	Ruan Pablo de Oliveira Rocha	ruan.rocha	ruan.rocha@embraport.com	$2y$10$mRRvC.DYIqNhpJfKKG5oYOpogiBZ0tuyFSOIIajo6LQZXT5e/eMfi	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
571	Rebeca Teles de Souza	rtsouza	rtsouza@embraport.net	$2y$10$EKkoBtfOrxnj.oeXJUtLuOrJhdGYck15E3bq6Y00dtPEP5Hz1EcUe	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
572	Rafael Lopes F. Senna Patricio	rsenna	rsenna@embraport.net	$2y$10$NRfpJ/YC43q1ZwgRLZZQyetfRMwrqnlLnn12nX/Y7Dj2XXN7LqdWq	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
574	Rapiscan Scanner	rscanner	rscanner@embraport.net	$2y$10$dEtSNKgOM6uHl85slVzr4OaBLTpV4ViWUB20ggw/5a7JE85CmAcua	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
580	Rodrigo Robbi	rrobbi	rrobbi@embraport.com	$2y$10$o.NMTuQzXhvEeU0LLYQZkuFvb59PpsQuUb2uRG5bXV1o9Y.x1lAAq	\N	11	2018-08-06 13:29:20	2018-08-14 14:43:48
575	Rafael Samamede de Jesus	rsamamede	rsamamede@embraport.net	$2y$10$MM7nDF.O1D.C0m1vrM/KX.UN8FHNINn..33Lr.JPFqbMoqAWsM3HO	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
576	Ricardo de Souza Salles	rsalles	rsalles@embraport.com	$2y$10$S7.eybDDTg8SQ/7H6wtfl.9UaYCyDpYdYpUpwDG.RWzoo4pBxS6i.	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
577	Roberta Rutigliano Rodrigues	rrutigliano	rrutigliano@embraport.net	$2y$10$1hidMAxakAKTo1AZppy05uQ9GwMV/Vjzu9q/ny5ZqbqnFXmiWqZTe	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
578	Rosemary da Silva Rosa	rrosa	rrosa@embraport.com	$2y$10$wdsosXyoY3gXbkktOrYHeeXk9BKyH0oR38RJxgTdWMRINF0ebkSAy	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:35
562	Remio Petise Paz dos Santos	rpetise	rpetise@embraport.com	$2y$10$P/LObPtbvYoiefecT.Z6DemqaHG4YpZE9r225BoQfPAxq9WN21gy2	\N	19	2018-08-06 13:29:18	2018-08-28 14:45:24
539	Silmar Augusto Marques	smarques	smarques@embraport.com	$2y$10$GI0KgMi.0I3.eOU7V.eZRe9qqZP5ArNA0xor3mlRvEcXeON2uZg7S	\N	13	2018-08-06 13:29:17	2018-08-14 15:31:15
548	Roberta Penha	rpenha	rpenha@embraport.com	$2y$10$Bq5XXyyK8ZoU6BN.d.e2.OX1BZueqY6ewyCOvl1F01Nn9lpjMBLEq	\N	6	2018-08-06 13:29:17	2018-08-14 14:22:37
583	Alex Gomes de Azevedo	aazevedo	aazevedo@embraport.net	$2y$10$XZ/Wv3PuAPNtGhWEb4VgKu/2KuvGY5Q/TaHH3G7Urhdg5FYjKrpvq	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
584	Carlos Alberto De Jesus	carlos.jesus	carlos.jesus@embraport.net	$2y$10$gddGo/cY9fww936e3bksuuV3jeMyeP.8N1LjK.7zvSHShjlrpXphq	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
586	Carlos Soares Dias	carlos.soares	carlos.soares@embraport.net	$2y$10$jlZMKQmyva.49g6ETpePNOenvbFrxYZIoo1tJRcekb0nGLfj/OebS	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
588	Carlos Alberto Alves Quintas	carlos.quintas	carlos.quintas@embraport.net	$2y$10$EbnVuDJTVQaFswNrKJIRG../.w7WXg.bDCPEhBNWyYGV84/dh0SXO	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
606	Carlos Magno Domenech	cdomenech	cdomenech@embraport.com	$2y$10$ynNpoo0UGbo15zxS74x3jOWYA6K7bOiZMAV5T3sJrcbakUcyQvOmO	\N	20	2018-08-06 13:29:21	2018-08-14 15:50:42
589	Carlos Eduardo Da Silva Mendonca	carlos.mendonca	carlos.mendonca@embraport.net	$2y$10$i85ihoh5Ne3wnCrKdG8nPea78SIxdeo4CA45fFaIOTiSpQACFTeAi	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
590	Carlos Augusto Gaspar de Melo	carlos.melo	carlos.melo@embraport.com	$2y$10$Cuth4auHReWwGY7XzyMkz.Iyjfd6o7tv4Q00Y3GEiX7XBjNV72RTK	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
591	Carla Pereira Dos Santos	carla.santos	carla.santos@embraport.net	$2y$10$X9TslXNPY.z/e4/T0vxu6OVz1ZB7opChK3mVpdXjIGE4bEDQ9odIq	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
593	Carla Da Silva Gomes	carla.gomes	carla.gomes@embraport.net	$2y$10$r9lQKnXkZpPEoN82pGHK0uOXKlGe4ZCgEOaucYfAUmpRWaHOaVbqy	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
598	Cacio Douglas Amado Rosa	camado	camado@embraport.com	$2y$10$5ez.xGbIoVc0C2rVVElQR./ydTHRRBcgcu4nPn8q0/zCX.fqwb7ta	\N	18	2018-08-06 13:29:21	2018-08-28 12:50:31
594	Captação	captacao	captacao@embraport.com	$2y$10$psSa3oeS669p.YtWm5N0sOFDpe5ApM3WYQX.7XEFBObtslD0oP7ui	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
595	Carla de Jesus Antunes	cantunes	cantunes@embraport.net	$2y$10$Tmvu6fnP6RLD9UFAZsVNeeu8lKa.dQD1q4p4RPfGBZFIFFaHlEARW	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
597	Camilla Grossi de Oliveira Santos	camilla.santos	camilla.santos@embraport.net	$2y$10$GpAeV7cYl5emjVUN29jpzuxcfhu/QBmEIozM8YpqOXK/sGsPQveYi	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
592	Carolina Gondo dos Santos	carolina.santos	carolina.santos@embraport.net	$2y$10$J.Iqlc1FUotbGJhmcd5YluIS77rlCFG6pqtBleioCMuJ8ZVo15cR.	\N	11	2018-08-06 13:29:20	2018-08-14 14:43:48
599	Carlos Henrique Vasconcelos do Nascimento	carlosdo	carlosdo@embraport.net	$2y$10$xlvCaWnAwCEblR39lE.NKudRiLURRHP8uyvgs62dWAh0OalGR8Obm	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
601	Caio Henrique Ferreira Mesquita	caio.mesquita	caio.mesquita@embraport.net	$2y$10$rTDLtyYpWcunyWKnaW5nauJ4KNtc6r8tR2CMDgWt5s5eg/r98TepG	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
602	Carlos Eduardo de Souza Dantas	cdantas	cdantas@embraport.net	$2y$10$7tot9pfWXh8C6UvCklGdauIv0ipl6z4t5A7Tdf7ApDhXF2ov1Smga	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
603	Cesar De Souza Campos	cesar.campos	cesar.campos@embraport.com	$2y$10$XdAftXMixdAf.blErL3gLe0DfsO9PzfWQODScOa3kCHYWIwQUg6j2	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
604	Central SEP	centralsep	centralsep@embraport.com	$2y$10$Px9JnaV0qnSnEgveqCpZ3uulyJw7FiB0EqH3z9khG3nG0cp9TAlr6	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
605	Celso Campos Alonso	celso.alonso	celso.alonso@embraport.net	$2y$10$SWU0tKC3J9.N3.IycMlX0u1rFBgx9pIrYAE/Aux/h2vf4PYAFohtW	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
607	Central de Documentação Integrada	cdi	cdi@embraport.net	$2y$10$PKMPhu9XmFWK657aVF.8XuuPd3/nILwNaRnct2t1TpDk5bRMY/eBO	\N	22	2018-08-06 13:29:21	2018-08-16 08:40:35
582	Josiel Rodrigues da Silva	josiel.silva	josiel.silva@embraport.net	$2y$10$fSM7HK/.95XueOalTN3CW.IGgSTrKYG91BhbdFVYbStTayLC.KYsG	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:35
608	Carga Solta	cdc	cdc@embraport.com	$2y$10$sHO00WlJfgitXGxJrvYKsOOhtiKBYYR5w3pyGErGUQboNIJ6L9Nqi	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
609	Cosmin Carstea	ccarstea	ccarstea@embraport.net	$2y$10$m10T7Ih.7JIcfx3J/pmAv.PpzTYW2yvllEooRncOEUc4fYeSKfGpy	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
611	Cristian Briet Simplicio dos Santos	cbriet	cbriet@embraport.net	$2y$10$T5GgKKF5TYRg9CChYI2H1ugCcgamkgJAmByPq4XFyD2Y2qEPBJgra	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
613	Callil Alexandre Mangueira Assis	cassis	cassis@embraport.com	$2y$10$dzGBLfEsqs/9u0q41CntWufxlhm.4eVRS5Hf0MRrEVhYaRRwKaT2W	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
614	Cassia Bastos dos Santos	cassia.santos	cassia.santos@embraport.net	$2y$10$6gDmMe/YOzPx3rYn35vme.HOU8LnqZHE6Mklr.krLoCHUNAG5OLgC	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
615	Cheyne Aguiar Santana	casantana	casantana@embraport.net	$2y$10$1/QPBlZnk5XdgPnK11ljZ.R1A1hC7qb39RsUVOMcbkuXCl/vQSnR2	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
616	Caroline Ramos	carolineramos	carolineramos@embraport.com	$2y$10$i2zs1ewvEOENqSekkCuIYO3Y.suqrt5YAvKLpR7N1FlTDijM/6zhW	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
617	Carlos Eduardo Mendonça de Almeida	calmeida	calmeida@embraport.net	$2y$10$NC9aWnRlyOEdiX10HSvyYuYMO.n2IhjOOJwCdbS.IEHt7cEsT7fR2	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
618	Carlos Adriano Brasiliano dos Santos	cadriano	cadriano@embraport.net	$2y$10$QkkvhareanBFl1dVT01fDOucNMQ.hmXJpBlpKdXxoSJtGID/UC76a	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
619	Cezar Augusto Aguiar Pessoa	cezar.pessoa	cezar.pessoa@embraport.net	$2y$10$aP3ksIholIkr30bWVDigRODZNGLc2DJtnj/6tc9X9KSm02agY0fV.	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
620	BESAdmin	BESAdmin	BESAdmin@embraport.net	$2y$10$EOC5uyv6Tk8cf1vRceZywedlVKsk03rZL8y6iJ97O1kZ6lgj1Xsvy	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
621	Bruna dos Santos Izidoro	bizidoro	bizidoro@embraport.com	$2y$10$uKTpIj.kFVsM3BlrsKdXEu3kbRp7PgshhTyKMXvWpKuWWm34Nb7P.	\N	22	2018-08-06 13:29:22	2018-08-16 08:40:35
622	BI Embraport - Farm	bispfarm	bispfarm@embraport.net	$2y$10$urDdM..liWbAgZi4CCSr.Occ7iXG/7.jxFw7txfU68jLROnyJIRDa	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
623	BI Embraport - ADM	bispadm	bispadm@embraport.net	$2y$10$vPmRLCuv043OtfEL263co.gzIAHVxH0jJi2EgvUXG/2H8/ItiIJiG	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
624	BI DPW	bidpw	bidpw	$2y$10$NOF8hz7WO1KSwrnEbw9lR.SFTY2ydq1kdDthUtu664Wz96Ujqy6bq	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
1025	EDI User	edi	edi@embraport.net	$2y$10$ZMfqNGir/w4nDrYrcquxm.eeKxn4WCDccRVtXu97wJVNX9BITY9kW	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:35
596	Natalia Cristina Campioto	campioto	campioto@embraport.com	$2y$10$SVnxDCJtDqUi72z29/y7G.kBZgd141RqJxiiGxvcd/CF//WNea.a2	\N	10	2018-08-06 13:29:21	2018-08-28 09:18:00
587	Carlos Alberto Dos Santos	carlos.santos	carlos.santos@embraport.com	$2y$10$reGd47lAP3KnLWH1CYzu3eqgvP83Ys.jQJWvRm0EE9HarjSkLNatS	\N	6	2018-08-06 13:29:20	2018-08-14 14:22:37
627	BES 12 ADMIN	BES12Admin	BES12Admin@embraport.net	$2y$10$BOe1IP8h4aLAm3vgZBIRReoYcmsoYM0h.LU68rTep7O0dGhpbF5Wy	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
628	Bruno Lauria	blauria	blauria@embraport.com	$2y$10$4MPPKITPbmWucHiGEswN5uo7DPHjcOgiRC.eGSZMkiJrVRyDPj7QG	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
629	BES10Admin	bes10admin	bes10admin@embraport.net	$2y$10$.OYPpIGgcnYrJHSFSFHkEOnDz6kD0LojzraYpbwRN7ZelX0d/pXp.	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
630	Sala Bertioga	bertioga	bertioga@embraport.com	$2y$10$X15/P2IP7.LV8778/rmgfezJ2RcjrWsrb.X8JukTFJme5aCOVXvlK	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
631	Giovana Moraes Canno	beecorp.giovana	beecorp.giovana@embraport.com	$2y$10$dX4VOaGaw7KA6lQV/wywHOHkZ5kXSIJlhQ89aq8u7Mn9EFBtVi1WC	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
633	Alessandra Peixoto Diniz	beecorp.alessandra	beecorp.alessandra@embraport.com	$2y$10$PKRiXXVmq0rEE0bJ82MO.eB4UhcRZJh/6EF0Ug4A.5zYMuCFDb62q	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
634	Beatriz Messias Mônico	beatriz.monico	beatriz.monico@embraport.com	$2y$10$zLFnAWnqenq7GToHSfxpvOVnVFVa0Ue2FCbbn2GkQCV5Z9S11Bdk6	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
635	Bruno Jorge Salles	bjorge	bjorge@embraport.com	$2y$10$SNXADbt/A7n/vTZiIquSjuyFn8RTkSC4cZG4dpVEujSRN6FqgB/am	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
636	bloomberg	bloomberg	bloomberg@embraport.net	$2y$10$WBlRpsYpbtw.1W3dN8YWG.eZGbJsT9mBHr5.1NXxf6Th9S1Ch6Fme	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
637	Cadbook	cadbook	cadbook@embraport.com	$2y$10$lFxzrmMK4xzM6OpSH5KvJuHi8esHld2dJbrkjvJA9VN8wUso9awBG	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
638	Bruno Barreto dos Santos	bruno.santos	bruno.santos@embraport.net	$2y$10$dgfcSXuXuYEyz3QoB3aBVOSzfAiDJT/IGM8GP1gPBBUIGn95NeH8.	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
639	Cadastro Cliente	cadastro	cadastro@embraport.com	$2y$10$km5iPQA91cIHQK9qbphA3uad4Hv.a5h9kCLMpF/3yOtGooXlLHR4G	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
640	Jose Matheus Teixeira de Bulhoes	bulhoes	bulhoes@embraport.net	$2y$10$ep5dqr8BEY.H15PgRvPuB.s8PirX70R87TVS/CzSUzXsbViW5MwF6	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
641	Build IT	buildit	buildit@embraport.net	$2y$10$wX3Bfh6i3rgEGydXxnIlD.w3weNGbor7sOkSGY5sZwgvjI/lduW06	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
642	Bruno Souza Silva	bssilva	bssilva@embraport.net	$2y$10$aEbE7QEAZGmwuQ9bBYK3leayJwQ1jldNoM1yMge7Gjsp2aJo9Vopy	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
643	Bruno dos Santos Silva	brunoss	brunoss@embraport.net	$2y$10$6aMq65cp1bYrCHbGz4y5bOSlEoDCnFScGqVS64vRcpB1ZcwmaNPZW	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
644	Bruno Alves de Souza	brunosouza	brunosouza@embraport.net	$2y$10$VfkNocJM.hGWyIvbP4mvx.9wM9e3p8JLho.1UsL5DoAKrNZVfHxpW	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
645	Bruno de Oliveira Penteado	bruno.penteado	bruno.penteado@embraport.net	$2y$10$eSaJAvoiK9Win3O0Te8q1.Uad/fq5BSJngBI5CPqESzr5RAEzzA8a	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
655	Bruno Dias	bdias	bdias@embraport.net	$2y$10$XZJJItBvDUkIQzJS4FmgG./cbxX1Vne/vn.kMFKhaOHAcgUK2HUOK	\N	23	2018-08-06 13:29:25	2018-08-28 17:00:35
647	Bruno Guerra Ferreira	bruno.ferreira	bruno.ferreira@embraport.net	$2y$10$WmNjPBHV9rjFc1lepd6C6.XIPPPXYM96uAxmLpso1.yNEfAv.EOpa	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
648	Bruno Rafael De Assis Correia	bruno.correia	bruno.correia@embraport.com	$2y$10$atos7QHhH6gxlGVvQISM2OvpTxtWCdeUbOsCqueJBG2OXbGgbyCZy	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
649	Bruno Augusto P. R. de Almeida	bruno.almeida	bruno.almeida@embraport.com	$2y$10$MWP.e6dn5jqIH/uE.YeMtOU.b2RAToyhnxanCcq5neJ8hSfyr52hu	\N	22	2018-08-06 13:29:24	2018-08-16 08:40:35
650	Bruna Alves Almeida	bruna.almeida	bruna.almeida@embraport.net	$2y$10$qcqwIDVRQrqFVqgo928bb.GurYQFFebvoxKjR.i6tV8.UNdAYDghm	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
651	Brenda Cristina Aquino de Oliveira	brenda.oliveira	brenda.oliveira@embraport.com	$2y$10$c/udE2Qm2G2.X6DJhpgtOuy6bOIIGta1uGauEXZB91rfT4xSyjDB.	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
652	Boleto EBS	boleto-ebs	boleto-ebs@embraport.net	$2y$10$EUGKKgHn3CpdPD8Kc5hrPeTQfmCB.M9OfAcgeLH8V3rTXCd9l3wmu	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
653	Cesar Ferreira Fiorio	cesarfiorio	cesarfiorio@embraport.net	$2y$10$HrGhQDskACkmgRhymWRGcu.joxDoI4AL6k0oNTUqPSMdjREjudlYe	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
654	CEZARIO VAZ FERRIA DOS SANTOS	cezario.santos	cezario.santos@embraport.net	$2y$10$PCVYQOzB10xdROTrdc6FeOZi0ga7o44IFDkiL37FTDN1CjMlZr6wO	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
661	Danilo Moreira dos Santos	danilomoreira	danilomoreira@embraport.net	$2y$10$GtwXGztoy40TVzC4WGEbjOaDQ/R5YPy2QMoLKHki9rxchoW7iFyRS	jRzVEXmXtoy2F87NM0HJIG1WkPWuM0EOvecodeccL5I6H01DeSSxasZsupDC	13	2018-08-06 13:29:25	2018-08-14 15:31:15
656	Danilo Rafael Elvedosa	danilo.elvedosa	danilo.elvedosa@embraport.net	$2y$10$G3UHrcJ1I.pX.nno8FHB0.7glh443i0LZfusZJHNB1ZoghowBn0iq	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
659	Diego Alves Pereira	dapereira	dapereira@embraport.net	$2y$10$b1yQsSslxg8wMBrhqyERGOL1s9/K9txVSKNjCLmNxBp4Cf6q0qldG	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
626	Bruno Cristovao Ferretti	bferretti	bferretti@embraport.net	$2y$10$0uDTWERS2eWUtwHbJKRQPu1stJszQTPWyL4hZy35lXuSFzla8ZVpu	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:35
660	Danilo Silveira de Melo	danilosilveira	danilosilveira@embraport.com	$2y$10$Thtwr8q5F9ZfhXuAnhNqpOc4tldiqmwkJnUSIuF5rVSkDdhQNW/r2	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
657	Douglas Alexandre Soares	dasoares	dasoares@embraport.com	$2y$10$R5Xg964ql1ThuD/E8KiHpee4DxQ4qVky7Faskl9TakbAdBv27U6j.	\N	20	2018-08-06 13:29:25	2018-08-14 15:50:42
663	Daniel de Jesus dos Passos	danielpassos	danielpassos@embraport.com	$2y$10$pU57kNFTU3ajJ4RdwH1q0uJLVYQP5eOFDGbBbQOYr4dF..ngGMTt.	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:35
664	Datasul	datasul	datasul@embraport.net	$2y$10$UMCW/OlwtFH60wI3LGHcQ.xsdc7dREIR1u78Rpw6Gatd.D/OWigEi	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
665	Danielle Barroso De Vasconcelos	danielle.vasconcelos	danielle.vasconcelos@embraport.net	$2y$10$exfDSQzI.xOZmFJaRIW5fue7H/aeSN3wjTCcOd5jN5gvxHZWebDhC	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
666	Daniela Feijo Nobrega	daniela.nobrega	daniela.nobrega@embraport.net	$2y$10$gy7BLH2tyYjb9V7Q8Y7xNu1VlwoMJOJPHsqf6cqhJ2j0eips1Nhv2	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
667	Daniel Pereira Zitei	daniel.zitei	daniel.zitei@embraport.net	$2y$10$L7NPitZMcSWthtSRnqFbi.uAqonnURTy8XH0DeSqqQRmd9I38bjw6	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
668	Daniel Guimaraes dos Santos	daniel.santos	daniel.santos@embraport.net	$2y$10$TAxx4IydZ2OEjLF2vLcaveozd//gcyo8twF5cgF6E/7eL2DjEY9g2	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
669	Daniel Rodrigues	daniel.rodrigues	daniel.rodrigues@embraport.net	$2y$10$3yQS8juVF9M57dlcXR.vK.WMiHu44YFhZTzIGJ.UR6psmdq6WoC9S	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
646	Bento Batista Alves Neto	bneto	bneto@embraport.com	$2y$10$qWqnfrCreTGaOybDaa8hnOw8/1vSOZ.jjGuf9WzfAvZwzDC0hebOS	\N	15	2018-08-06 13:29:24	2018-08-28 12:19:33
671	datasetup	datasetup	datasetup@embraport.com	$2y$10$aKhfTk5qehmHAgIsFuU81uKfweeCVniF/45Syvf4crsLN9NmuEL2a	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
672	Portal Embraport - DB	db-share	db-share@embraport.net	$2y$10$kX/61Jgk8t4b9KQzArLnpe9Qi8pBO1NV.nb/Uqkk/0B2oBuUC5IM.	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
673	Danielle Andressa Goncalves	d.goncalves	D.GONCALVES@embraport.net	$2y$10$QfzuFRtCNNlloI9yMBrDIOfv9JtlBnUk3UGJ2v0aoGKC5FpQ87c0O	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
674	Denis Andre Garcia	denisgarcia	denisgarcia@embraport.net	$2y$10$pNPP.BPLgSYkn4qDaHRjJOpzQIQAT3gfHauI9FA5RNM.zsdWcxp/a	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
676	devaws Desenvolvedores	devaws	devaws@embraport.net	$2y$10$XQSAubOSVW9McrljcjJhnuAyLdaUVcZBjLkj8EryD04qPNTBIGTB2	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:35
706	Camilla Gouveia Simoes	cgouveia	cgouveia@embraport.com	$2y$10$8rG4RUKjQwNEvvtkmh.7c.DSYQoFdkNMaY7ROKMBONDKj10xoajqi	\N	9	2018-08-06 13:29:29	2018-08-28 09:05:59
678	Despachante	despachante	despachante@embraport.net	$2y$10$fOUG19oJg6N998l9k0ER2.40/NWkGgQt2MFqZ/7GN9DQXlBZLrqQS	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
679	Desconsolidacao	desconsolidacao	desconsolidacao@embraport.com	$2y$10$GtNnvzWDVLxkHKmaJ7821.r8WbucKKTcUC6hP4f1SaRPC0JQAioly	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
680	Denis Silva de Oliveira	denisoliveira	denisoliveira@embraport.com	$2y$10$OdcZVCl.FJdPr4HUulN3UejQLxecNxFcUkD2MHudhHl/07ORxxpfu	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
681	Denis Costa da Silva	denis.silva	denis.silva@embraport.net	$2y$10$Cz9L9ivZ0ba/PxRbffyWzO97iYJCrtTFX4DcEwZtj8tHZAsa39OO2	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
682	Diego Fernando Bassualdo Bento	dbento	dbento@embraport.net	$2y$10$kVg89fyaKX4b9.5U9lYBke5pPjAavNLjbhO7i7vzV5ezQmzKA4pnC	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
687	Daniely Campelo da Silva Mendes	dcampelo	dcampelo@embraport.net	$2y$10$MC2mTr2mcb75psyiNbSwKeKtzEzoVmWP5nWdBQYEKc4dAQtrFILDu	UEDlReXeo2s8FOozW8LK2UyNBfEH3kmI7TFSAjeNILDgDYuy2f7pBLvnJbKx	2	2018-08-06 13:29:27	2018-08-31 08:43:56
684	Demontrativo NFS-E	demonstrativonfse	demonstrativonfse@embraport.com	$2y$10$0CPqeDXoiTltyO.xWvNZMe.5ZZwlwmELWiif0Jadir/7eByHFrm1m	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
685	Danilo Baptista Dechiucio	ddechiucio	ddechiucio@embraport.com	$2y$10$R75vbIbTVuuAc3FnzeJVH.09g0NoXUeK8XMrFbdh7JcBy.qpd8odu	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
686	Duff Coombs	dcoombs	dcoombs@embraport.net	$2y$10$9Rko/rW9DU5mRdCCOTasYeXnynnGdqs4VeB5bk/p4w6cWjDq18pFy	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
670	Dallas Carlyle Hampton	dallas.hampton	dallas.hampton@embraport.com	$2y$10$uIDZ/NohgkO.rQIfUirgU.cJzdRn50LGaf08FDwe6OKztZvO0BFqi	\N	23	2018-08-06 13:29:26	2018-08-28 16:09:27
689	Dagson dos Santos Rocha	dagsonrocha	dagsonrocha@embraport.net	$2y$10$6/wA1.Ubagw1Nssr8Jdcpu4mF5q5C6VYNm8CaXfLfctczNuSqQqiK	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
691	Christyan Furente	cflorindo	cflorindo@embraport.net	$2y$10$ZgBTv6z05Z4Yj.SWbJlxjOM5s2.atYynlTFO4KX37XxwvQ/2W/SWW	\N	22	2018-08-06 13:29:27	2018-08-16 08:40:35
692	Claudemir Soares Ferreira	claudemir.ferreira	claudemir.ferreira@embraport.net	$2y$10$UPPiUqT7tlTAKXKhILPD2erP2epALwY.GYwJ3Yh9hrdeJy.mjQLDm	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
683	Denis Henrique dos Santos Barbosa	denis.barbosa	denis.barbosa@embraport.com	$2y$10$TNvjP97GHZklivPNx.EPNe7WWcMwUh7jfQvIJVY19qlJb12/Vlf8K	\N	14	2018-08-06 13:29:27	2018-08-28 12:05:43
694	Carlos Santos Macedo Castro	cmcastro	cmcastro@embraport.com	$2y$10$49GBdNRfHgaekpMWzG0f0.1y.6AVPqa3kVgx6LyK7MYbSOIdJm4gu	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
695	Climatempo	climatempo	climatempo@embraport.net	$2y$10$pSyN0UW4Q.FbtESxJ4R3TOJJX4u3uUDg8bG8muxgUhAG8NOHOhlUW	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
696	Cleber Marinho De Mello	cleber.mello	cleber.mello@embraport.net	$2y$10$av790LSPdvIIEXMzemct9uRSsYj8ijMV/r9F5EVMJFfISpNqxfhxm	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
697	Clayton dos Santos	clayton.santos	clayton.santos@embraport.net	$2y$10$22e17vwukz8gILOo6tq86OntPKEBEZlI.V2qS2XJ862il4Sct/Ym.	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
698	Claudinei Evaristo de Araujo	claudinei.araujo	claudinei.araujo@embraport.com	$2y$10$coFsV9GpuM6i2EFqhFENbuJAxRJaGj22gs4Np7lCkq8Q6BLILo7PS	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
699	Carlos Alberto Jose Junior	cjunior	cjunior@embraport.com	$2y$10$3J1UDvxbXl6/eHA.zJ6dE.ysXWdghUOh0ziE0081R0bou6oMaf7r6	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
700	Cofre Senhas	cofre_senha	cofre_senha@embraport.net	$2y$10$.Bkm2o1.XLnyWmDTkhSlD.aRdFzx5mzj1D6YytseoPXLToRozoAXa	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
701	Cintia Ariadne Alexandrino Costa	cintiaariadne	cintiaariadne@embraport.com	$2y$10$dPz.jbaPf8H78nvpOqIqJ.jBkjyo9JvmEnHcodQTx.4YfDhNUsYOW	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
702	Cicero Alexandre Claudio	cicero.claudio	cicero.claudio@embraport.net	$2y$10$p3WDd9PBN6AaAyDgqy.UPeWCyfGtS6qiSl2agiQMoki2ZmO.SDYI.	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
703	Cicero Jose Bomfim	cicero.bomfim	cicero.bomfim@embraport.net	$2y$10$OYGIzp6/djoszfKRqXP.nupFqkeReWs64C9MVKX.VYB6Xumx9mk2a	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
705	Chamados Gate	chamadosgate	chamadosgate@embraport.net	$2y$10$YCW2DMbQXmh2/XA3FWTpHuiriXMWzpXoDR0lqIGSU5yYroTMMOCXO	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:35
707	Christina Hartmann Neuffer	cneuffer	cneuffer@embraport.net	$2y$10$7FZwqzv5HF3hjAqbFzMWp./aLOC8QKYZfEjZPFyGIcP88voX3WNcy	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
693	Cristiane Santos Mossini	cmossini	cmossini@embraport.com	$2y$10$yhRDbFbPHp6YdCc5xLqhR.bG1CY9lw7vk2q05jkYXkWJjHKSOJLtm	\N	16	2018-08-06 13:29:28	2018-08-28 11:28:13
708	Clécio Borges de Oliveira	coliveira	coliveira@embraport.net	$2y$10$j8kkjJlA0UPc4sKbMULtdOkcMSmXXbxt2tfWt2mycBdVyXI69h64a	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
709	Cristiane Vicente Ricardo	cvicente	cvicente@embraport.com	$2y$10$zEBo0mLMc7WIKy9OQAbUM.UrVsVoh8tJeAKXFXKqhazE21Y.imjp2	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
710	Carolina Aparecida Meira Pece	cpece	cpece@embraport.com	$2y$10$iwvW7fpL6Dn.vGvkKoG8JeEbqBLbPPhVAv9h6NJ1Yq4xqUpT.HPwy	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
711	Cesar Valcarcel	cvalcarcel	cvalcarcel@embraport.net	$2y$10$rSHtVVqthQ2HXM1/H3ySm.L0LZUKdns9CMsOMFWIrhvrRLHyPSDSa	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
712	Alfandega Rapiscan	customs-br	customs-br@embraport.net	$2y$10$egdpSo08PEyhRyws25VCre5XBvuedT88mefnhvp0I1dSXF48kS352	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
713	Sala Cubatao	cubatao	cubatao@embraport.com	$2y$10$aI97Dx1lVjwT086wW3ajauQifjIct/K1MFudjoz0nYU4Omcq4DaQa	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
714	Carlos Roberto dos Santos Junior	crsantos	crsantos@embraport.com	$2y$10$arWnCayVP1hFsZVVNc1ZR.Pg/CNr2EsB/aZWDI7Rql94kYDUC1atK	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
675	Daniel Loren Fabris	dfabris	dfabris@embraport.com	$2y$10$JoSLHeW2z92YG1m.KWlSHeTMjlInVu/hvvLXvYRU6u/SPR8EoA/Iu	\N	9	2018-08-06 13:29:26	2018-08-28 09:05:59
688	Daniel Cesar de Alencar Braz	dbraz	dbraz@embraport.com	$2y$10$V4nPJ0ETFrytobJgZPxtZO2D5xO7zjE962P8.QNBH.h1I99AVxbRW	\N	6	2018-08-06 13:29:27	2018-08-14 14:22:37
718	Conferente	conferente	conferente@embraport.net	$2y$10$dkMB6xxqnQbubUJcx8h2MeLoTEcZ4fHr4IHLgwC47mRn6DFjFmFYC	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
719	Jose Cosme do Nascimento	cosme	cosme@embraport.net	$2y$10$T4yl4WD85DkghNFa8WNfp.VlZfCeEAq0QQ2lmydy73gBsgFtA.ZSC	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
720	Controle de Permissões	controledepermissoes	controledepermissoes@embraport.net	$2y$10$FXw.sDTGjyoLb1QQ1nI.veOH.VjXDk0qEeykD6m5JNIiZjUX6nC7y	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
721	Controle de Documentação	controlededocumentac	controlededocumentacao@embraport.com	$2y$10$v6dge25mddpPnIgzpNVNJ.CcE4/TyeRI0iZeoGfiNue3TYMksPEhi	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
722	Contas a Receber	contasareceber	contasareceber@embraport.net	$2y$10$UV534i7uOpwdFJwfQya9zuGwbX/vGhvzZSyvgENz.MifoEBLy5r52	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
723	Contas a Pagar	contasapagar	contasapagar@embraport.com	$2y$10$8pugczVveV9PfHXQ1JXd6.G/ebElABBCZ5aAJh4qVPT.XFJu9i4S.	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
724	Contas Receber EBS	contas_receber_ebs	contas_receber_ebs@embraport.net	$2y$10$Ax8pK3Aw1XGb006FatXvF.FW0OKQTj0GABLfEIl/FRikcNlS3OyJC	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
725	Consultor	consultor	consultor@embraport.net	$2y$10$qKtxyzXBjhcpu.mAcrJcM.oujurzYafHFwcEvWPVP7hU/.jl8Zn52	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
726	Beatriz Eduarda Lemos Hipolito	beatriz.hipolito	beatriz.hipolito@embraport.com	$2y$10$uB51JHDieBKcY/KYov9V0ORdWYGv/1BAX05IjzHly5weYqflwejdS	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
727	Blackberry Teste 2	bbtest2	bbtest2@embraport.net	$2y$10$widqKhnt5/1l1I./c3Z3sOneWJWFg7a74U2YhJrU8zQRDvya7vBtm	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
754	Alessandro Elias Santos	alessandrosantos	alessandrosantos@embraport.com	$2y$10$rTIQd1FqTU83eXcvK8jLtOBBI5/UiK2pHERya.UsI6rLhynBkGQ/C	\N	15	2018-08-06 13:29:32	2018-08-28 12:19:33
729	ADM Ronda	adm_ronda	adm_ronda@embraport.net	$2y$10$ADK84VyLTAFrDgBZI9kC.OfAhOD3gjPpwV69X.RMkl91tdCfA.uKK	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
731	André Danilo de Mattos Ferri	aferri	aferri@embraport.com	$2y$10$WMLbWl6Yr6Iogefz0nqe5.JUgj3KW1kZEUmC6rBA4ucl/PmXkqUfO	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
733	Adriana Lopes Melo Damasceno	adriana.damasceno	adriana.damasceno@embraport.net	$2y$10$Lq6R2gKWp7KgvI2JbhHiUOWSzUpogk5SkuUCo5mdcGWP3/zjp5J2K	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:35
716	Cristian Brennand Pauta	cristian.pauta	cristian.pauta@embraport.net	$2y$10$ByzLp2sks/4/DwevUK4MXOzh8kc4NRXoc3Klb6RZh9AF1GFLDJuFS	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:35
734	adminstorage Conta administracao EMB1ST008	adminstorage	adminstorage@embraport.net	$2y$10$HRAl5AlfPCW/tGjFJQnHgOkuNrTtHxU.imGUJ9BH2Pm/C09/UcVX2	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
735	Administrator	Administrator	Administrator@embraport.net	$2y$10$.5lkVe3bb9X3sJbl9SXdZOSIt4MrKxUkojhA3UNFe8PGcMXLbkJWG	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
736	adm-wtuler	adm-wtuler	adm-wtuler@embraport.net	$2y$10$muQsnbV0v8QUPGovWUMsUe2nZJzHKlBn7LRCG1jtnRzTOmHXPONOa	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
737	Agile 3 User	agile3	agile3@embraport.net	$2y$10$wROm7S9FllUTtWgSXVcU1eigQdNHXL2lsb8vubqdvnNILMP.0BitG	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
738	adm-vpn	adm-vpn	adm-vpn@embraport.net	$2y$10$XFdxPNK6kFzmNP9qMG4yl.v4fXBoMczXDmqax56lQwGbAg6TUEfEG	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
739	adm-vinicius.espuri	adm-vinicius.espuri	adm-vinicius.espuri@embraport.net	$2y$10$K1keCsznD5PuIlp3ojkece3A7km/ECHLM/3n2uOEkc5XXXVXyhjk2	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
740	adm-tbraiani	adm-tbraiani	adm-tbraiani@embraport.net	$2y$10$ctW9J65r8ueD1Kij7Gh90e4iI2PwIb.l7XZHo5WMnJ88Va/KqnXfa	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
741	adm-rafaria	adm-rafaria	adm-rafaria@embraport.net	$2y$10$jr8NIhOFtzYaVesVLR1WquCIgtpm3.U5VOfQfVqP4FFDEO.bLc19G	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
742	Proteus User	adm-prtemb	adm-prtemb@embraport.net	$2y$10$4jHIHKXfMDlaCpUw6QeSxOvleEVWWF2JX4hk2kPAg1GmIrZ6nHFSq	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
743	Projuris ADM	adm-projuris	adm-projuris@embraport.net	$2y$10$YYZ5pzonHwJJwVfThk/0WOebzxq8audw4Fq7Zq5Kos6.9pcqaeVA2	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
744	Agile User	agile2	agile2@embraport.net	$2y$10$CzJulgUUtRluBvG6OUsLjuPXphGt49jiiejvjwz5oYLkA7irvO/.O	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
745	Agile 4 User	agile4	agile4@embraport.net	$2y$10$bidkuFA4ymcnk14ToYmUq.p6ESmsP0nX6mk.SI1eCV.nmiGhdS2Hy	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
746	adm-mrsantos	adm-mrsantos	adm-mrsantos@embraport.net	$2y$10$fe4RdgqbBa2OfbODJe/tveq70z1TWqyGx6F.Srv.9b7T.lpG5M3nW	\N	22	2018-08-06 13:29:31	2018-08-16 08:40:35
728	Daniela Freitas Pereira Souza	dfreitas	dfreitas@embraport.com	$2y$10$06mtBW32WhXkm54HXd4h/.DQU6h0Mf8bFH6Ei4bCHrMrDuRmXteGW	\N	14	2018-08-06 13:29:30	2018-08-28 12:05:43
748	Alexandre Custodio Correia	alexandrecc	alexandrecc@embraport.net	$2y$10$aDf11aK8KNyCKddUCh4PhOCuUwWl6/vpwTAiLg9DFEkbXLhQP4aRa	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
749	ALEXANDRE GABRIEL DE SOUZA	alexandre.souza	alexandre.souza@embraport.net	$2y$10$qu8VTXiMtp3kHYncm0gZ9Ob9i9uDIqUXZeTICcQGJqeYI0Shjs2n.	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
750	Alexandre Alberto Soares Souza	alexandre.soares	alexandre.soares@embraport.com	$2y$10$vr5gej4O6akoA.a80e40yeZI5XOMoqtdCyrmxW79WKlbgeVNjjz3q	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
751	Alexandre Ferreira dos Anjos Junior	alexandre.junior	alexandre.junior@embraport.net	$2y$10$PW2Kwxgb1UbcBkeFBfeX/.ILND8laognWnb3KVjk2iwDg.tcvr7BK	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
752	Alex Vieira	alex.vieira	alex.vieira@embraport.net	$2y$10$dbUlNT/sPk/SpdFsfC32u.1d65gTIazFzFCRgBmXYb/GshnSYn5Hi	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
753	Alex Douglas da Silva	alex.silva	alex.silva@embraport.com	$2y$10$l4pGXTyja.xGHWxUPKB.qO.p.kfjJxXbC2.sISoq23YbzLhGf3/z.	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
717	Cezar Augusto Garcia Pires de Almeida	cpalmeida	cpalmeida@embraport.net	$2y$10$r.CpMK8sKG1xSC5VgUjwUOiR8rtQuO5IaTiJTl18/tNVaCQbMFp.S	\N	22	2018-08-06 13:29:29	2018-08-29 11:49:17
756	Alessandro de Carvalho Santana	alessandro.santana	alessandro.santana@embraport.com	$2y$10$rOKh/G6ZupTxOLSCaJoz6.9J4mDf8jn.7K54UEy69ee9m6jcLbZ3K	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
757	Alencar Carmona Ribeiro	alencar.ribeiro	alencar.ribeiro@embraport.com	$2y$10$YnFjkt3Yc23jtW7I3inkvuR6u7VdgmNeS5o0htvHLJ3UN7ZsHm8ru	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
758	Alcides Andre Muniz Folly	alcides.folly	alcides.folly@embraport.net	$2y$10$dLTGTyX/B0T.GFOcJ7ZSyusTb3grqsDuxQ8pFflcaaTmZpuRZ/w8O	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
747	Alex Aparecido Dos Santos Germano	alex.germano	alex.germano@embraport.com	$2y$10$Wzsz.MtUOBcgNwT1TPWLde2hVDQKal70Mjjf79.6Nbo5kyipV4Oui	\N	13	2018-08-06 13:29:31	2018-08-28 11:40:10
732	Adriana do Nascimento Garcia	adriana.garcia	adriana.garcia@embraport.com	$2y$10$lL91wyPKEk7zV5JQ9wq5JuuJJ4kKc1MaxkzTW7CPZxcs.VdbdZUMK	\N	8	2018-08-06 13:29:30	2018-08-14 14:34:16
761	André Correia Honorato	ahonorato	ahonorato@embraport.net	$2y$10$YiiFdrYtpCfKA59GRfuQ/.6TH2Cce5ytuDHtZqtTyxPvQJ2Q/YlbK	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
762	adm-nicholas.mattos	adm-nicholas.mattos	adm-nicholas.mattos@embraport.net	$2y$10$x7E/UZgMaV73QBncAmFdB.XzxFvmFNcZupSOmItakDkXCkN7krebu	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
763	adm-mroberto	adm-mroberto	adm-mroberto@embraport.net	$2y$10$MF77LPlHPg7XH2vzrkU8aeO0EtueNBcCzIWzEoKA0Tns0OFfcDsvm	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
764	Alexsander Silva Soares Costa	alexsander.costa	alexsander.costa@embraport.net	$2y$10$iKhFhneGhZJ1oMhlAk8jueGQdSxUucICMvXeHKBuosgrlKWoeknGG	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
765	Andre Carracedo	acarracedo	acarracedo@embraport.net	$2y$10$0q44avfyX1anpgeNJCePuO4bVrgJme3XqBWn6FQxUelo29/ojuptC	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
766	Altai User	adm-altai	adm-altai@embraport.net	$2y$10$VSc1CqmvgUDhxMPgkla1zeXbzHrbA26769jR9q1LXcGU6aKbhkHsm	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
767	adm-allan.motroni	adm-allan.motroni	adm-allan.motroni@embraport.net	$2y$10$2CGhehWj4GwLmpbLwdLb7ut9Sz607m2Pv44wl3V3W9ar8n9ELRym.	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
768	Adi Barbosa de Souza	adi.souza	adi.souza@embraport.net	$2y$10$XqgOpFBokAqJkNw8N5yd2eJdfQvIOVtbjj/N2w06pI1qFGY4Vf1x.	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
770	Antonio Domingos da Silva Abreu	adabreu	adabreu@embraport.com	$2y$10$Ezl.aEmMNyOdefbKjXf7a.2Bo6ADRScM3VL/aUgl6enQVB3vQqYh6	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
771	Augustin Cuevas	acuevas	acuevas@embraport.net	$2y$10$Rn5EXiJNUXf2zjoyKQbDPeXlZrNhVTih44YxcV3G1cjPK5sZ5skmW	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
773	adm-cdomenech	adm-cdomenech	adm-cdomenech@embraport.net	$2y$10$isNE0KIH3jxTy.8qjZ2iP.0SJP0ZyGp9fzZWvQGM2UhKukh5a1XAS	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
774	Arnaldo Caitano Filho	acaitano	acaitano@embraport.com	$2y$10$jJM6Zikz1TfHRI0PKPYqSeuyahmQA1bdnNeXBSPZ3qyUzTntuyZMG	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
775	André Luiz Braga	abraga	abraga@embraport.net	$2y$10$MU3d4F9aHzsRePr1F6xjAevJDrlX8WVzQtNZKfcZ2oboQ/BPvDNcW	\N	22	2018-08-06 13:29:33	2018-08-16 08:40:35
777	Anna Beatriz Alves Fontes	abfontes	abfontes@embraport.net	$2y$10$ElN8KI/DpiBvQL0IFZ3XCOX31YgGZ187LJ2AEgoYiqXKSXa1.HNRO	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
778	Andressa Alencar Benedito	abenedito	abenedito@embraport.com	$2y$10$CX6wBMAKnFqKTswJHaJLM.H6n7QyFUUM/DIx1F6T.e1yI141AOBZG	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
780	adm-bbarreto	adm-bbarreto	adm-bbarreto@embraport.net	$2y$10$JcMlL5Ws2X718QneMPJlLOhvaFa5RiQPnyGoy.wQzog0FyPz76pJi	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
760	Ailine Lopes Da Silva	ailine.silva	ailine.silva@embraport.com	$2y$10$RRtBZM3h3VDVhh/V8IoUN.uBCg6xNcu6IyWzD4s50iw1ZL2KLj5Wa	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:35
781	adm-cflorindo	adm-cflorindo	adm-cflorindo@embraport.net	$2y$10$jMC2JE9WaNTZmk5PHPTHSO2Do6fVbEslXNFo7fGRbb.4OpCYt3S26	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
782	adm-mauricioperez	adm-mauricioperez	adm-mauricioperez@embraport.net	$2y$10$NHsksShSLclzwkY7pWGSzOnf8Pzl1ujc3Aro.DMJUJvYspcNZbD3y	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
783	adm-haryel.assencao	adm-haryel.assencao	adm-haryel.assencao@embraport.net	$2y$10$qmv3ux6E4pT6m9hBVqWwjOY6AzbWCs.POi2eV.Broenpv8J1UisPK	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
784	adm-luiz.camargo	adm-luiz.camargo	adm-luiz.camargo@embraport.net	$2y$10$pv8aVm.Tep9WFpad535rwubNuiw1agi/kYOl4EmlTxOH80s5n3gLe	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
785	adm-lsteiner	adm-lsteiner	adm-lsteiner@embraport.net	$2y$10$Tknsr8VSKdabz1VsNCR98.Ms/TY0d3Zb2b7XdCKHca.ikbnFeoHE6	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
786	adm-lespuri	adm-lespuri	adm-lespuri@embraport.net	$2y$10$GCTi1T9KnkMqPOcG5.hH3uUcBIj7RWqjLG1NsK.ehsfWPKgW/tgQi	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
787	adm-jvelasco	adm-jvelasco	adm-jvelasco@embraport.net	$2y$10$HwNQxtGFIwmS1wIFXUVLVubF.uspf7WQjcARC.Km9lFic7NyJPqfq	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
788	adm-hsp	adm-hsp	adm-hsp@embraport.net	$2y$10$6MsZhdWS2MOvDDl7QTwpGuvurHBDPZY5bHthAmhwkwTAnwMe1H2Ci	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
789	adm-hassencao	adm-hassencao	adm-hassencao@embraport.net	$2y$10$x7W1xu5OrUqnUwwQUJJouOYIltLAeO4.ITP/91dueU.ctz.tDxiae	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:35
790	adm-gilvando.lima	adm-gilvando.lima	adm-gilvando.lima@embraport.net	$2y$10$.pZw07GDb8VNSlSsPxnJqO0OxK2wYux6SCxDKnZRyrKL7myE23TgK	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
791	Call Manager User Service	adm-cucm	adm-cucm@embraport.net	$2y$10$F5R6.ccABR4rsDFQouvvxeI.fLjGGwWUO1QSYZgoiRZtrOvzSEW8q	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
792	adm-flavioguimaraes	adm-flavioguimaraes	adm-flavioguimaraes@embraport.net	$2y$10$KdMiydQ1ODsABprj8bZ8teplZZ3KjTYLCzq82xX9eqfb8bLNLeZc.	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
793	adm-flavio.guimaraes	adm-flavio.guimaraes	adm-flavio.guimaraes@embraport.net	$2y$10$vDDGmWo0.Y0yfovdQ7VvteGt8lLiwhSJpBWw/JcWvyzKYM8UmOhRy	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
794	adm-emb	adm-emb	adm-emb@embraport.net	$2y$10$vn.Rzj/GSa.Wcvnzi3cfZetAQNNgXgM.XaNSVvHTdMKw7K/pym0JC	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
795	adm-ecoppi	adm-ecoppi	adm-ecoppi@embraport.net	$2y$10$4GFq73Q/KgLzpJ5i3pO3ZuUwL9GzUPO5z6jKi4AnUJkfEfzL5Ffgu	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
797	adm-dasoares	adm-dasoares	adm-dasoares@embraport.net	$2y$10$DYqGUTosSRCBskuuA8EIzO6diSiqLvfEw.8osvS5J3G2UEO.Ymy3C	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
798	adm-daniel.santos	adm-daniel.santos	adm-daniel.santos@embraport.net	$2y$10$TrRHfHpCIFNECB8QnSICte.AhRwAGaHFJ88v.Unx3Tf9iIN5W3ZSW	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
799	Alexis de Oliveira Santos	alexissantos	alexissantos@embraport.net	$2y$10$wCCgL9RUc2SrY13X7LsoVOtjrewQbearzddoKIko9uTSfsrzgGdSO	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
800	Alexsander Silva Soares Costa	alexsandercosta	alexsandercosta@embraport.net	$2y$10$oAYEj1LZigDHwvFn9x5O1.dcFy5Wx6Kc9WVwtldmoR3EZX/FxmPgm	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
801	Blackberry Support Test	bbtest	bbtest@embraport.net	$2y$10$0jrvByJBQAyb7rcONd4fCu0vnQC/KmQ7K8MMT.cRGHk98lcq10wAu	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
802	apstech1	apstech1	apstech1@embraport.net	$2y$10$buWcw6o2xcjTR/76zymx4utGYD19wxvY4E02H0AUMcj7oSogM81Vu	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
803	Arquivo	arquivo	arquivo@embraport.net	$2y$10$/ewcBsDgJpqRfcplx95z/eCda..hLgBLu7SmpMReNFoFzew7NWPxS	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:35
769	Ademir José Zanfolin Junior	ademir.junior	ademir.junior@embraport.com	$2y$10$IHO4vOtt8iG3Bp74k8HPqefCCeeE7GM6V8hYQg3mjHRa3hFT9.TGu	\N	18	2018-08-06 13:29:33	2018-08-28 12:50:31
779	Audrey Bastos Cortez	abcortez	abcortez@embraport.com	$2y$10$PxnRjih2Li3tXnY8M23OmeNVX.4IZOJtEztK9bPS0V3QiU7B.bha.	\N	12	2018-08-06 13:29:34	2018-08-14 15:28:08
806	Andre Resende Farias	arfarias	arfarias@embraport.com	$2y$10$7RMH/ZM0/kRXG5LNQp4I/OGFgcgzdxAE93jnMHzW3mWA4.qYtyqka	UpZEnNNJqH3DvPz5kmkhRaQ5XZIf81yP1IOuV0ePMJ3Ah7fAEjo5ZscqCLJz	13	2018-08-06 13:29:36	2018-08-14 15:31:15
815	Angelica Borges Sousa	angelicasousa	angelicasousa@embraport.com	$2y$10$QlsUxOWlHu3VEJfWAlAdM.7AY41y2RjEVigJUNBcai92jLzde.5sa	\N	17	2018-08-06 13:29:36	2018-08-28 12:37:15
808	apstech2	apstech2	apstech2@embraport.net	$2y$10$T.in4IwsXfwc/gFZktaMYOParSsdI7JxJLcMzBmj8PP4CHwG56hM6	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
810	Arthur Henrique Rodrigues Tavares	artavares	artavares@embraport.net	$2y$10$wWfCsoX4Bx.BcKWnpnGAROWnL/qolEn0fnN6yXC.I5pPRLlo8NKHm	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
811	APDATA User	apdata-adm	apdata-adm@embraport.net	$2y$10$xU0QODwDvyEIR0hPwRlVj.8ViFDWGNRr4yIhIvvoSTJx35KQfkf7e	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
812	Antonio Campos De Moraes Junior	antonio.moraes	antonio.moraes@embraport.net	$2y$10$1mI2giYXcko55gt0DFi5FOwkAdDlR1om8bxrJtlYnoQoPJqgZaLrO	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
813	Anselmo Correia Lopes	anselmo.lopes	anselmo.lopes@embraport.net	$2y$10$C0gK/xHjsnUnpcNCkUxh6efgYr4XvfZ2Dcjmk/OVopjDMjM5.zFBq	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
814	Angelo Andrade	angeloandrade	angeloandrade@embraport.net	$2y$10$x7X8SyjZJiAttzyjBy5wCuwgwEqIMx6hJMMLaMzEAL1FdUtfhmT4K	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
839	Ana Paula Mota Busatti	ana.busatti	ana.busatti@embraport.com	$2y$10$3l59yHVlanhDs814nbrH0ucCujaIFZnA4IcDYNQwyYdjan1DPCZgy	HoGORPNMhCrn0zNdzNeT4nS9508gErcZQB89bx4ihIGIpfneWpN5h0Iz90C4	18	2018-08-06 13:29:38	2018-08-28 12:50:31
816	Alex Dantas Neri	aneri	aneri@embraport.net	$2y$10$215x6Qc6GWMm8khaNV3U1Osqvi.7aObdyCL4KI3XAz6Ke2yatb3Hu	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:35
840	Ana Paula Schettino Moreira	amoreira	amoreira@embraport.com	$2y$10$Xb/RrZ44dB3aOeIOTZCrZOxNq8qIpKfpYdcaz7c0GIhcZUSykVOTK	\N	16	2018-08-06 13:29:38	2018-08-28 11:28:13
818	Andrew Martins Senne	asenne	asenne@embraport.net	$2y$10$4qXN9pGjyVZSDwlzPOSkiebnQTlS4.n7CMKEQg1oQcS6RjamdkibK	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
819	Andrews Gomes Fonseca	andrews.fonseca	andrews.fonseca@embraport.net	$2y$10$YC3pd8kCSBRRp9LP3TZA..mrqZfboe1vzSUqwMAf1UJnMU9hTpc.W	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
820	Automate 2 User	automate2	automate2@embraport.net	$2y$10$ZQNz1xMyZvivXgnZ/P0gM.DsbYF8utklTwfdQZ6hFwyoWnNr9acta	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
821	Bruno Barreto dos Santos	bbarreto	bbarreto@embraport.net	$2y$10$M8nDokLSkhlv3FDeec9WoeErWpciW6aicJNcRUsG7b/YuAu/OWirG	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
822	Sala Barnabe (Board)	barnabe	barnabe@embraport.com	$2y$10$ovfx1uZ9Q5d8smx.liDqSuEwFP7Bs.luTdZtw2/JGnh5Lw/Lr/5hi	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
823	Usuário de Backup	backupuser	backupuser@embraport.net	$2y$10$38j/obwvOaFQr.sCwszTiuJQWCoiAfF7PNXAgqKQR9WrCOz/3K7li	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
824	AWS Administrador	aws-adm	aws-adm@embraport.net	$2y$10$C3B/C9DWEPlhYVgJ11DSxOppBYteEW85j/kLLb72ORD05ay/iepMG	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
825	averbacao	averbacao	averbacao@embraport.net	$2y$10$4GIrJtE.W3cmETAlGSTkcON8l9K2FN/6cpGA6IUYYs3Bc.D.H6Zza	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
826	Antonio Valentim Perdiz Varella	avarella	avarella@embraport.net	$2y$10$Yg9TfBDSoZMvzvpZslS3weIFfkIBW72rHh6YSueFGwVtd1oK/fJN6	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
827	Automate User	automate	automate@embraport.net	$2y$10$vQOPE4avI1BBj6Q9pjDf7uK8oHCpr6ACHJFVzCbmzSy6C80EVo1Xa	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
828	Alessandro Santana de Freitas	asfreitas	asfreitas@embraport.com	$2y$10$h6iFF.YI497uAxl8llxf7udbbeldb4ivHbk.gIfU0f8mja/IIbsgm	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
829	Augusto Gabriel de Brito Almeida	augusto.almeida	augusto.almeida@embraport.com	$2y$10$FXarQnnSpvuh5/54FA5di.KyStM9PTnb57RaqtDLkJPm5oj8InOra	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
830	Alberto M. Ticianelli	aticianelli	aticianelli@embraport.net	$2y$10$ttF3XDwgrbmxfzC6ZQM2zOapf9i/cRwR6G6SXD3b9CY3yrpP.Rx2K	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
831	Atendimento	atendimento	atendimento@embraport.com	$2y$10$TppiPyZe7xQ2RjJZnlR6M.9nWycwu5f184CKJaVXSiP5IDmiHiahi	\N	22	2018-08-06 13:29:37	2018-08-16 08:40:35
833	Adriana San Martin Borges	asmartin	asmartin@embraport.com	$2y$10$m/mLKsK4328MIcOwD5J0BOZu40fD5wgsuf/8YnV3YnrkKMiKzx5hC	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
834	Aguinaldo Souza Silva Junior	asjunior	asjunior@embraport.net	$2y$10$m6nIMyDMJJ21.lRGnDAH6.dsXVypmoJifWH9KVHLTIRLSy2XnWjEO	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
835	Andreza Alves Monteiro	andrezamonteiro	andrezamonteiro@embraport.net	$2y$10$qIR.4.kNde9r57NMrJGIceRdZ7ZX.zaZ5NWMp9L8oNfGRRr7d9Ofi	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
836	Andressa Evelyn	andressa.evelyn	andressa.evelyn@embraport.net	$2y$10$6ANIvi2dILZGV1B.KkI7b.ypPGWvwwKViDUT2r3c04lKopcrs30ki	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
837	Alexssandro Dias Maria	alexssandrodias	alexssandrodias@embraport.net	$2y$10$AiYgSrlmG5DwZUThZxFpe.4M0yQfQ2/Wy9nhw1zfSGLkB0dXkN2gu	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
838	Almir Dos Santos Souza	almir.souza	almir.souza@embraport.net	$2y$10$Yjbw6FvC/u774ztMfHAAr.q5RHzBao.PDSu2/5ma3tSIHkk1AnLDG	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
843	Alyson Emanuel de Oliveira Cassiano	alyson.cassiano	alyson.cassiano@embraport.com	$2y$10$1jesdQE3AFxk99ND/Hv4iOdKAHn9nyk0GNve3oqbwL9xz9WS7gpUK	\N	18	2018-08-06 13:29:38	2018-08-28 12:50:31
805	Anderson Ribeiro da Silva	aribeiros	aribeiros@embraport.com	$2y$10$3fSG1qpKtgYOifbNVpzva.MCZLqGmYRIkSjXeDY9bLAiPBj5LXLpO	\N	15	2018-08-06 13:29:36	2018-08-28 12:19:33
841	Amilton Carlos do Nascimento Veronez	amilton.veronez	amilton.veronez@embraport.net	$2y$10$6nOSNpa0JWqXlyS5T41uNuBrViYyf8SdJOht59yHqMpLt.2U2KbkC	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
807	Andre Luiz Pinheiro Ramos	aramos	aramos@embraport.net	$2y$10$tXl2/XQGbjAy8gK/G2Ai2u9zsXnDWWrf8W65izue9egHzU5X9.1Iy	\N	22	2018-08-06 13:29:36	2018-08-29 11:49:17
848	Alison Alves dos Santos	alisonsantos	alisonsantos@embraport.com	$2y$10$gVIkxYqzRvZMJVn9cO6MrO/n4SFYFJJ1SU338XZLWNRd69RsOrzpu	\N	11	2018-08-06 13:29:39	2018-08-14 14:43:48
844	Andre Luiz de Souza	alsouza	alsouza@embraport.net	$2y$10$1uHoS3OwpTYKYKbq0hwp5.S7/i/ssyhT2y43mc9vslFdRgsF4TdeW	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
845	Almir Silva Santos	almir.santos	almir.santos@embraport.com	$2y$10$ypGi.gF/kEA5GCdyfPatNeXy5EqON3AlvnDd9wFo6STe0cLGa9C/i	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:35
847	Allan Rodrigo Motroni	allan.motroni	allan.motroni@embraport.com	$2y$10$5HX7/ZPRTX5jySYhtLRzruJz/iRbiifkpdJZDmW9IXsg/5YdT.q.6	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
846	Ana Victoria Andrade dos Santos	ana.victoria	ana.victoria@embraport.com	$2y$10$mzcu8xcu8dDStoifIYVu/Of1vFVBxeDqWEyj//fmT2iMsXk1BuNC6	\N	1	2018-08-06 13:29:39	2018-08-30 09:12:44
842	Amanda Lucia Ribeiro Ferreira	amanda.ferreira	amanda.ferreira@embraport.net	$2y$10$nuiQfoG2.z4lZUR1uf2jdeQDVcQ8rHo/pPNWM4rUzjuWbQas9gemC	\N	11	2018-08-06 13:29:38	2018-08-14 14:43:48
852	Aline Moreira Fernandes Gollega	aline.gollega	aline.gollega@embraport.net	$2y$10$LAhvyGuBYqzajRRGKLNVhuKz93NsJO1.G6t23v4CFpMUs0tMdVm5C	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
850	Aline Silva Alves	alinealves	alinealves@embraport.net	$2y$10$tTYwMaRrpO5tAVPkKx.iWe3puUMjI3VUaYpNDM7CxOVqekJ/tXmWG	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
853	Ana Carolina Rodrigues dos Santos	ana.santos	ana.santos@embraport.com	$2y$10$uxsDfgBJbgab.GCeI3TuxOjMy4dNL7S1BEePZg0aG0HWYzIDZyPmS	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
854	ANDERSON LUIZ PONTES DA COSTA	anderson.costa	anderson.costa@embraport.net	$2y$10$yeooC1.N2MDDHPW9zjytgeTj0Wpz1lfiJ.Jhw6IZaimOZvuOJu0hC	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
855	Andressa Bergmann	andressa.bergmann	andressa.bergmann@embraport.net	$2y$10$SuwscLhzSCqUNHF6xhA.rO2VDlz5v.Je8NHCgr8MIrEeIzELG3rLG	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
856	Andre Sales Dos Santos	andre.sales	andre.sales@embraport.net	$2y$10$kRIYF0Oukp8gGXlr.d.bwefMCaRTUPxQrBmYK25D6pc/WqFUds5qu	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
858	Andre Luiz dos Santos Lima	andrelima	andrelima@embraport.com	$2y$10$LnJivZkRFbPnmiNGS5a5D.qY2jIm/CFjh9kb/UwRV1EqHO8qPmT12	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:35
860	Francisco AB. Neto	andreamerican	andreamerican@embraport.net	$2y$10$BiFNryFIiC8sZB3tZRjgvOqGajH9D6t3cM5.QttJhMf0bVj8QxyzG	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
861	Andre Luiz Barroso Silva	andre.silva	andre.silva@embraport.com	$2y$10$mSkNIRldBr6Z9kbjoYDeW.P0gBjrZtqHZEQ4URI2SGjsq3/R6HQwu	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
862	ANDRE ANDRADE BISPO DOS SANTOS	andre.santos	andre.santos@embraport.com	$2y$10$y.EfLZWDY1IZ5dnzpAkiEe13kY3X.zDRgYnrROqprH4uE/m/s7XYW	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
863	Andre Goncalves De Oliveira Silva	andre.oliveira	andre.oliveira@embraport.net	$2y$10$xFft8FZCGJxKBkXIUpwIYO02t4IVN2RGHeBRqaC21F05bNPAA6x2O	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
864	Anderson Roberto Pereira	anderson.pereira	anderson.pereira@embraport.net	$2y$10$YtRMhdynR8R0EVbq.woMcu9OkyUNCJnPrCtDUPszbeHbJH64aGYUO	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
865	Andre Marques De Oliveira	andre.marques	andre.marques@embraport.com	$2y$10$IQTQUaPIR.FrsRr8CL7Hje9Va/OkqSKcu1zalRdgcPtjL9ncd9IQa	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
866	Andre Vieira Laureano	andre.laureano	andre.laureano@embraport.com	$2y$10$Ca.EsV6gm5uFFqEQLEQeRuHj9S1XX8II.ANbc340J1Sr92qXgehMi	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
867	Andre Sacramento Da Cruz	andre.cruz	andre.cruz@embraport.net	$2y$10$d2Yz9j59YTiiX6d1GyMRXemtg64RO4/rTjgp0A5DjgIYA/wQX8RnO	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
868	Andre Luiz Posse de Carvalho	andre.carvalho	andre.carvalho@embraport.net	$2y$10$IH6XTvuvBlCl8qizKT6q3.r/HWE923rvlGIGk4Ojkf1gymwEiqrva	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
869	Andre De Souza Cardoso	andre.cardoso	andre.cardoso@embraport.net	$2y$10$RFqmmhShP2VS5.PpgaDb9.wFR7Q6nqPN1KBXUT2N/TTX27qk.TtH6	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
870	ANDERSON DA SILVA SANTANA	anderson.santana	anderson.santana@embraport.net	$2y$10$IFME20S6SSR5Ru.14CsGROUtj0ZWT1Bo7xrQMDy5bizhYB.vdGoZy	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
871	Anderson Da Silva Ribeiro	anderson.ribeiro	anderson.ribeiro@embraport.com	$2y$10$7wO9b0vvNHoNMCfKHeq3.u8DPNQZHihDaXUlXPpbjhbUsWhik20ri	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
872	DFE XML	dfe.xml	dfe.xml@embraport.net	$2y$10$M/5Ycps8B.WuIXqaGG0GNu8LgLOA2PIpraNLDIyzgyd7oOtQ/5pPm	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
873	Douglas Germano Giroti	dgiroti	dgiroti@embraport.net	$2y$10$u3yw.kJciQLF4tHzZ3t9U.d3Ud75ba7hC9Uyc3sznnjKgcv8cOH/i	\N	22	2018-08-06 13:29:40	2018-08-16 08:40:35
874	Josiel de Sousa Moura	josiel.moura	josiel.moura@embraport.net	$2y$10$PjxDbopvO1nkHXxwDXkbwe7WB2Prq1z4XifiN4Ytf6isR.5bJ/x6a	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
875	Gregory de Souza Mattos	gregory.mattos	gregory.mattos@embraport.net	$2y$10$b.3pZSlNeTGld5oMtLLu5.4O0Y7paOVB7aORRwkPU0CgT7w6FwUi2	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
876	Sala Guaruja	guaruja	guaruja@embraport.com	$2y$10$mRAzcQBf/HBYFEstet7V6e3S1VNyYQK8oifRMskRUjLh3yC3cOaLi	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
877	Guardian GT. Toledo	guardian	guardian@embraport.net	$2y$10$CH3VrZEwRR/SK25BGQmz2euc8aLr02AZTq2yLY816pJz2vc59kuza	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
878	GTFROTA User	gtfrota	gtfrota@embraport.net	$2y$10$NvR5B5DS4QgRqj10ys7kIOrgT.6znAF7w6XbPHvB464SIFQzQIhua	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
880	Gustavo da Silva Martins	gsilva	gsilva@embraport.net	$2y$10$IrJUQ2bX1MpXNtysOPepmeJcUvjPqM9W07rAtAWtWVEixOOWJ5w0K	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
881	Gilson Santos de Deus	gsantos	gsantos@embraport.com	$2y$10$4gf7arXwNLmqm41ztKAdJuFZgX2NFkcGracux5Z9.vTwRNTF5.DM.	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
882	Graziela Melo	graziela.melo	graziela.melo@embraport.net	$2y$10$PA.wmPBh/UqU8O4njpJcROEbBu4HgCjCMFXPdx4PA35VvRy.0iwzO	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
883	Guilherme De Lima Santos	guilherme.santos	guilherme.santos@embraport.net	$2y$10$IL4/Kl3xiUwhTs8qXDIt7.Ffj7XsYfpL0yV619THAqwkNWuOO33YC	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
884	Guilherme de Souza Raposo	graposo	graposo@embraport.com	$2y$10$XSluF8Ad4L8bpPpeK0h49.bF9DTHdvqB3ijfVhIysltBRngoKI8ly	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
885	Guilherme Bissiato Pinheiro da Silva	gpsilva	gpsilva@embraport.net	$2y$10$onEMdkyS3WrULM6Rt/lEWu2Joy7pTQeaWyzWItx/UVONuHbiHtKAq	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
886	GPS ADM	gpsadm	gpsadm@embraport.net	$2y$10$soVYMAsWGdHcoahmAcX5qufrFC16jaI4SyHWEtzguN0Qi2dvXHMHS	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
887	GPS	gps	gps@embraport.net	$2y$10$dfRF.bkRMrexgHP/w2cM0u80580nUiQvjTGK7HuTTzXyeM5IWTawe	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:35
888	GoodAdmin	GoodAdmin	GoodAdmin@embraport.net	$2y$10$5vGvRpkO0C1H9nUlM1.OSuWyDhYlfRE7TUAICadw/3AOifpipef2u	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
889	Geison de Oliveira Campos	gocampos	gocampos@embraport.com	$2y$10$Q0/tsuQaC09Qp0S7Svcsie0/N3rM878.sNK.8KU/LzanA9rYQuZH2	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
890	Guilherme Righi	guilherme.righi	guilherme.righi@embraport.com	$2y$10$Z1WswkL5Z7gzf4wMnq/8OOF7K2Fzi4wh29sKXIJgFsftV0Bko7ppW	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
891	Guilherme Margarido Teixeira	guilherme.teixeira	guilherme.teixeira@embraport.net	$2y$10$CtdDze8tGiU2MjqH.zWUGubUMuBUApYr1CNXITDA7IPFP6acGiBdO	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
892	gmci	gmci	gmci@embraport.net	$2y$10$VdZppE7kQpLBXebimSC7iuXJfcL79sorltUpckoOUB0iQjXMcgzRS	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
893	Harley Carlos da Silva	hcarlos	hcarlos@embraport.net	$2y$10$UqqsIwYGa.ZbUcRCpQ5mlu0sae2.VnoVMOjrC8F73vO.VoLZQXGpa	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
859	Andre Carvalho de Azevedo	andreazevedo	andreazevedo@dpworld.com	$2y$10$7KVHzoDozTpjG8cZeyb1y.ypNRB6IXIP/.Vit7ZdMnlWefDQN2HoS	\N	18	2018-08-06 13:29:39	2018-08-28 12:50:31
988	InnoGate	innogate	innogate@embraport.net	$2y$10$sdvzbNrbJShlM5CjsSuGaOBbbxXOHs/0PzPeIou.Pwq2Y0GJl5rkG	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
896	Henrique Ribeiro Santos	henriqueribeiro	henriqueribeiro@embraport.net	$2y$10$0IZhzQEG5a43xDLCgHyjV.cKNCWbPhXNw3BEWJsoL5vnUooJBmz8C	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
897	Helen Priscila de Carvalho Guimarães	helen.carvalho	helen.carvalho@embraport.com	$2y$10$bJ0RKd1QHf5p62t.bcW.u..mhV91dvqv/PYtnlqbFrFCzYlTO8I2e	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
898	Hedgar Marinho Grem	hedgar.grem	hedgar.grem@embraport.net	$2y$10$yW5ZogZCvAx2Ww/aSAUuPeknkuyg.KduwiHefsJ5EIDtHCSLD.gzi	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
899	Henrique de Carvalho Nascimento	hcnascimento	hcnascimento@embraport.net	$2y$10$8TTDE6FA4VQjZLIosto6peRns3ov5fqpp3MwE3xzfT5rs89e6hVG6	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
900	Hugo Leonardo Bezerra	hbezerra	hbezerra@embraport.com	$2y$10$Aj6Q9UbFcn6TRF.yS4YMAuKbT283l4Bg4D2tzby9Wpv3r20VQZkvG	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
901	Guilherme Queiróz Garcia	guilhermegarcia	guilhermegarcia@embraport.com	$2y$10$bzCelX02hAqMSICzy4dGEe96qetT5ArgHVXH3Frmo9pAcDlGljv2K	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
902	Haryel Costa Assencao	haryel.assencao	haryel.assencao@embraport.net	$2y$10$yHYUtroXGQp8oLgNxcnyRutn5hfk1CzULNCc4sAGy/IJv/25RZUdm	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
904	Gustavo de Sousa Alves	gustavosousa	gustavosousa@embraport.com	$2y$10$zcc0S0vF4xIWR5sM1HGsH.hAOQGwU33Cto.wnGDr9x1V73Zd289Ma	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
905	Gustavo Carvalho Reis	gustavoreis	gustavoreis@embraport.net	$2y$10$oHzalAwdVEiVzn5y6D.1U.WBdzJDRaENAy5t5XdIb.YFARcojq2Ua	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
906	Gustavo Germano Dos Santos	gustavo.santos	gustavo.santos@embraport.com	$2y$10$1C821CyJsJp5gpQmTZ8p.uZo7D8HVSGW4xKCstXKIwGrI2YFgKmvK	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
907	Gustavo Ornelas Guenaga	gustavo.guenaga	gustavo.guenaga@embraport.net	$2y$10$XDMSC7/zLgMtCfBLLFVjP.b0nwULmiXjHnyPVdsNOGenjCf8LBBrO	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
908	Gustavo Moraes da Fonseca	gmfonseca	gmfonseca@embraport.com	$2y$10$pi0er4GFkB5fR0Lwn5JoE.XCCfPggn5QtTmGplRoBsjOd3Tjrfiju	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
909	GLEISON DO CARMO FERREIRA	gleison.ferreira	gleison.ferreira@embraport.com	$2y$10$x9mqUGZaQwIHS4yp3tE.KuQj7KHHHOxWhg/CvDyyCR56muUyOQjLS	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
910	Hilda Silva Souza	hsouza	hsouza@embraport.com	$2y$10$PgrFRlCzTcUFHbnFx8ysn.4DsKrqM7RlMmMcgtK6eTtYy0jdn44W6	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
911	Gabriel Neves Pinto	gabriel.pinto	gabriel.pinto@embraport.com	$2y$10$aXk9qY7kLxiqE4qfbXCQkucaOuMzfnEeG8VDVK3.AyfEs9HjSTtya	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
912	Gabrielli Christina Vilar	gabrielli.vilar	gabrielli.vilar@embraport.com	$2y$10$b5CS1WPUsF0DLEOXQFNt8.ozic5/5KJ2svwYBuKNDyE.6et7fCBVm	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
914	Gabriela Souza Muniz de Oliveira	gabriela.oliveira	gabriela.oliveira@embraport.com	$2y$10$/PI7VGBKDxHjqvYXnGeNLejCOZLf614CC7zg7ISZ8n0altsAobjMK	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:35
917	Gabriel Santana Santos	gabriel.rodrigues	gabriel.rodrigues@embraport.net	$2y$10$CUwUuphP5YxX7EJRvDRMbOBG8czSx.mO3JkxGc7rQk5L24dbLgqyG	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
913	Gabriela Pillilini	gabriela.pillilini	gabriela.pillilini@embraport.com	$2y$10$DoYDv9sFdTYVzx3IpGsiaOi0W0dL0dD2O9ztD7p7PHpTAMzTA8Vve	\N	2	2018-08-06 13:29:43	2018-08-28 08:22:09
918	Gabriel Felipe Da Encarnacao	gabriel.encarnacao	gabriel.encarnacao@embraport.com	$2y$10$MW3NqMykzMYCIwvW2ZTepu0OzNBBPbMrfiioMOA7jwWxjOzlLA0E6	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
919	Georgenor De Arruda	georgenor.arruda	georgenor.arruda@embraport.net	$2y$10$tHkbojJG8a/irVI7cRtGpexW8WoSbOUAomgbN5b1KPeKgJFwcUs0i	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
916	Gabriel Roberto da Silva	gabriel.silva	gabriel.silva@embraport.com	$2y$10$ligio3ITgbZUuJ0JNWVG2Ow1q0wmBMvFGpoyODQSrk2OwLubL1gGe	wjyYQOqaLyMFeLBRsbxsL7s4pHu6wV8i7Jsixmuu8jxOeA6YImrUczLenkVn	1	2018-08-06 13:29:44	2018-08-28 15:44:32
921	Flavio Tadeu de Oliveira Junior	ftadeu	ftadeu@embraport.com	$2y$10$PiGVfn00QHt0m3ChW505veY6.2xcGBIb9wPS255RkPbIbtbVA7oPu	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
922	Fernando Ribeiro da Silva	fsilva	fsilva@embraport.net	$2y$10$69WwhkgP3QkKnNlF5pPlfu4emQk6T1pHwv.1oUKybj62HcG5BQvUu	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
923	Felipe Sagaz de Sousa	fsagaz	fsagaz@embraport.net	$2y$10$Lzr.S2PpP9uU8n0TPwX8Q.OGHDVWg42/iGJsH2Oyich/jWhrGAzYW	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
925	Franclyns Felipe Silva E Souza	franclyns.souza	franclyns.souza@embraport.com	$2y$10$pHnh6QjObUCcBrV6yKMBkuY1UfM9jOkcF4K6IYDT.IcmmKykvPLR2	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
915	Gabriel Carvalho Verissimo dos Santos	gabriel.verissimo	gabriel.verissimo@embraport.net	$2y$10$j0jmpP2ENvLyNDHrUKVi6.Voj7Zs3zBlWViuGKi.zdAYxUSPmWJjm	\N	13	2018-08-06 13:29:43	2018-08-28 11:40:10
926	GEANINY CRISTINA DE SOUZA LEITE	geaniny.leite	geaniny.leite@embraport.net	$2y$10$/3tZQf9CyXy5dYCXFIk8Z.Xv/0muA9qbgQYST0VD18A9FgUWA6R3S	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
928	Gledson Ferreira de Oliveira	gledson	gledson@embraport.net	$2y$10$kzAmX00.46KHXtbPbHMmFeHzTURlXrteR0lLBlZkRzYMUkgn9ezVe	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
929	Guilherme Inacio da Silva	ginacio	ginacio@embraport.com	$2y$10$1ZC8W818NA6QCbzzFWALIukgXp8u4pnODTsR9KHjGzdeZ7S.ciiBi	\N	22	2018-08-06 13:29:44	2018-08-16 08:40:35
930	Gledson Dias Dos Santos	gledson.santos	gledson.santos@embraport.net	$2y$10$iGApgRO8EBeJgdZGKgj4zOsdtFBpShvhiUYe1aPIOmcOiKC5QXnCy	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
931	Gilliard Guedes Justino	gjustino	gjustino@embraport.net	$2y$10$iSCE3Ttqz3obxaYcNLSdwOUyNwIeWXvjPfAoj.ZyXHE4F6ovEXHl6	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
932	Givanildo Correia Da Silva	givanildo.silva	givanildo.silva@embraport.net	$2y$10$zI6fwNFYoV.c6Wbveo5tAepzaCx/zvbpWccSx4o3k22yjYYumiFPq	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
933	Giuliano De Brito Conceicao	giuliano.conceicao	giuliano.conceicao@embraport.com	$2y$10$jsPUIJt7e0Qhiz9Zosiqc.w.Whoo.jujeanC/kjR64X/HFjgJBQLG	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
935	Giovani Bachtold	giovani.bachtold	giovani.bachtold@embraport.net	$2y$10$La.KIaRk2VrBJlwwEvEGuOxKzlSstPjbnVpgSKx48u3lMzKxibJqy	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
924	Fernando Antonio Santiago Afonso	fsafonso	fsafonso@embraport.com	$2y$10$lnQqvvdaTVCQDT2HrbaLSeuTaqgTNU4Bl7L6WjD79O9JkHhOIAmg2	\N	11	2018-08-06 13:29:44	2018-08-14 14:43:48
936	Gilvando Ferreira Lima	gilvando.lima	gilvando.lima@embraport.net	$2y$10$EYM.iQIBPYRv9ptTzxZfCuJMqX0iSFPt9mD1o78nL.7q7sgjf2.zu	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
920	Fernando de Gouveia Tortorello	ftortorello	ftortorello@embraport.net	$2y$10$3zqx1ixJByMWIsc7Jvg48O/ecjdTghagmu9Y3I9DkO//aQW.1YcyS	\N	23	2018-08-06 13:29:44	2018-08-28 17:00:35
895	Hugo Lemos dos Santos	hlemos	hlemos@embraport.net	$2y$10$qSZZb6c2ECyoNbOsZsGMDunoi2qAEMfPdJZm4mDGLFNJnLM/mv42y	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:35
939	Giliarde Jacson da Silva	giliarde.silva	giliarde.silva@embraport.com	$2y$10$feYFhHDk4h7Pe9jP5/WdfOrI6tauX4VtqlbSv41q83ll7MEoQS9C.	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
940	Gilberto de Souza Junior	gilbertosouza	gilbertosouza@embraport.com	$2y$10$bEzyXDO4M2CHShcAXUWbH.q0k9H38Bqh9Cub3HuWAJhU37eqg/5Ky	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
941	Gil Vicente Freitas de Moura	gil.moura	gil.moura@embraport.com	$2y$10$Es8yRigmOdFPKle3LklcgOTTKHlV6yTwZxOYeY78IvEn7QE1u.3ju	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
943	Geovanni Joaquim da Silva	geovannisilva	geovannisilva@embraport.com	$2y$10$IZFoisxC3tVoqDjKbRyi8uuUTxljBEjCg3Nt.4NcPuAdIXcIPFV3m	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
937	Geovane dos Santos Gomes	geovane.gomes	geovane.gomes@embraport.com	$2y$10$JvV3kYmsdyJlJG.cu/abRuHfURfiCA87/vjvFTMpeNZ.nzasaPXDu	\N	11	2018-08-06 13:29:45	2018-08-14 14:43:48
944	Geovane Peres da Silva	geovane.silva	geovane.silva@embraport.com	$2y$10$hN9FWynj7mr/8h4xCtyPo.wq7WliGo9mGeTzictcqbhu/cZSs4MRO	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
945	honeywell	honeywell	honeywell@embraport.net	$2y$10$DFJZFA5X83IP0XfiinreGeG76mVUsjQPycel5PiAzZFc8rsbpj762	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
967	Jose Carlos Pereira da Silva	jose.pereira	jose.pereira@embraport.com	$2y$10$u4NXItjlHItkoy0m9vTUieEvjoo4EiXNzG4u6k5hGtdKOr4ZNnHT.	\N	19	2018-08-06 13:29:47	2018-08-28 14:45:24
947	Francine Inácio Sampaio	francine.sampaio	francine.sampaio@embraport.net	$2y$10$LMzuzW5idqkqJJQYtuX.oOOAVoJkMqTlcf17GwefmJFRuKHS.VbUW	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
948	Vpn Jlcp	jlcpvpn	jlcpvpn@embraport.net	$2y$10$qg5ZLpBz8.pPCGKgkN0KCezbSisd07OSIilBc/XFGbEd9x.9WhdVi	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
950	João Vitor Adad de Lima	joao.lima	joao.lima@embraport.net	$2y$10$0Mj9UAVddb8cnaj5Lleys.XO.h3vQRuKFyb3imfBspJTKJccKy0se	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
951	Joao Batista dos Santos Junior	joao.junior	joao.junior@embraport.com	$2y$10$X9IcZOIlxTClETyOCn9wRu9qsDGILo16xAsUt1c/4TTKYsohAl.TS	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
952	Joao Victor Ferreira Dos Santos	joao.ferreira	joao.ferreira@embraport.com	$2y$10$n/bhWp/yR36MxN7vR6XSPetKZt2/QmMbrohzUYXN6QGIOS4sm2iRC	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
953	Jorge Thiago Munhos	jmunhos	jmunhos@embraport.com	$2y$10$U/.tN254GhDedoW0fjUXAeRtZLzN3N3J7bHuSMuIoiARdvCu5wr.G	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
954	Julio Macavilca	jmacavilca	jmacavilca@embraport.net	$2y$10$F4LuNdwjFMexLihx/7xbbOaEqwNmJEtbxXHpjcEheyEgUyaU5rMYm	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
955	Jose Roberto Eugenio da Hora	jhora	jhora@embraport.net	$2y$10$Uo5yuhOJQoPBGIvD5awDcu0ym0gJ3BVECnInFkZEzuPDDaXjpUzbu	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
956	Joel Rosa Felipe	joel.felipe	joel.felipe@embraport.net	$2y$10$x6F4pqooZsEitcvyl983UunbyGoLrDM9BSQO7J/SBusC8/1.QGEDa	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
957	Jeferson Gustavo da Silva Pereira	jgpereira	jgpereira@embraport.net	$2y$10$4YgrA0wyMNMd62bOhVTJ1eHlkFqD5j4pjci4aBBNwJHqQTulnBCR2	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:35
959	Jessyca Domingues Vieira da Silva	jessyca.silva	jessyca.silva@embraport.com	$2y$10$TeJVrvIENktDdWRA5Z0JlOOVku8rqoAu5xkHq2ubCNL8wAFR4fqDG	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
938	Gilmar Santos	gilmarsantos	gilmarsantos@embraport.com	$2y$10$zhrwH1xZ7f8JQ444nAmDSeEMY8eeJr5.zgkjHpBuqHaFjQbxY68mG	\N	22	2018-08-06 13:29:45	2018-08-16 08:40:35
960	Jéssyca Rolemberg Gomes	jessyca.gomes	jessyca.gomes@embraport.net	$2y$10$ea914fGQJOZxYY4imvqvAO66ILYdjT71LbzvLAu7T5ZsgoMEXGoLS	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
961	Jessica Silva de Jesus	jessicajesus	jessicajesus@embraport.com	$2y$10$ynLPkigzwBNnueBzLRJ0E.VAbdcZbXcJ/2.b7RLleaCFmlGPbrL8m	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
963	Joaquim de Freitas Junior	joaquim.freitas	joaquim.freitas@embraport.com	$2y$10$wlgkfsIVgnrwUDjvXaaZXO6a1fN4lot.s5LITUE.TORp7pXLaHmbS	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
964	Joel dos Santos Junior	joeljunior	joeljunior@embraport.com	$2y$10$.wCZ9P5Z6c9nzVxbFKROKuWolNbO/vNVsjZQACi5jaVXBjIxTAnMW	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
965	Jefferson Silva	jefferson.silva	jefferson.silva@embraport.net	$2y$10$M/rKV4hJpRsW0pYF58cWJeMPIbhDg53dJJqHk7p6guaaVpxa/2/qK	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
966	Jorge Luiz de Angelis	jorgeangelis	jorgeangelis@embraport.net	$2y$10$V8H5yQq3EmxSo1eb/AAJUecni0XpVk7d7Xjpq.0lqhNIBGHpz5ItC	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
958	Jonathan Ferreira Soares	jferreiras	jferreiras@embraport.com	$2y$10$LGeMxuOvyWNfVZaqi1kY9uNflinOhGs99g4dwoD93hYxtGfjyNo.6	K2kF5vX11IL8yVS1VTGHW2Yohafyfrm8P5BsyrYW7d5cciIGKeNObKEcdq22	13	2018-08-06 13:29:47	2018-08-14 15:31:15
968	Jose Pasquali Sanchez Junior	jose.pasquali	jose.pasquali@embraport.com	$2y$10$tNK0JKeh0GFek3RtXecbqORG6y8.4I2D.dAXTJXdtj7gAfaVZwvBO	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
969	Jose Silva Queiroz Junior	jose.junior	jose.junior@embraport.net	$2y$10$GmXtzwL7anqLq7A/PxVupe6wuZM5IpeSoTSym6CnFVvGF/d4vX8Zi	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
970	Jose Luiz Gomes De Jesus	jose.jesus	jose.jesus@embraport.net	$2y$10$9OD4EwWuaL/JjdNTcW.B6uSuQNz1dLj02xY88/wTJ0vyAPVGA9eCK	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:35
972	Jackeline de Oliveira Santana	josantana	josantana@embraport.com	$2y$10$TnFO4FwZn5tj6Y/bU71quen2mFAjLqIGEaVrN5RZEC/kBDaZYlyta	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
973	Jonathan Silva Souza	jonathan.souza	jonathan.souza@embraport.com	$2y$10$8oWhlXkrD7eaFFin5EeHa.9e5QQ89bR0m8omgG7qGUUPrBw4cm17S	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
974	Juliana Priscili Ramos Ogaua	jogaua	jogaua@embraport.net	$2y$10$s7X5lA9OfEYKW4Vl3dmhp.y/smXnXoPGn1BGQyzbYvdkekt1shmlq	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
975	Jonatas Souza silva	jonatassilva	jonatassilva@embraport.net	$2y$10$.dZn8PKr1pZC/uMgi132eeI.5apFhZU6oUk9uCM22HwsfLyOO3koG	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
976	Jolsinaldo Barbosa da Silva	jolsinaldosilva	jolsinaldosilva@embraport.com	$2y$10$NM1.HnI.DPEpuhTEBAeRgOjJNGnjzeblI3tVJK1WKagyvvGoOIkCm	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
977	Jhonathas Oliveira de Lima	joliveira	joliveira@embraport.net	$2y$10$1uOKYWUZ5LfCG9kUI9yRfu3PZeLCvFXb3U.pEDlHguK.jCdzNY8lK	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
978	Johny Stevany Da Silva Santos	johny.santos	johny.santos@embraport.net	$2y$10$.2cWs7Y7wfbwnY7.xB0lg.hQpp5croPM6jxh/gvXuuzJeTfAYNDfO	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
979	John Darbyshire	john.darbyshire	john.darbyshire@embraport.net	$2y$10$iUscA5m/lqWLtJLkreYVpOymgvx.M3woLRfTQGSGt2XxeYPJ0BKPi	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
980	John Mayk Costa Barroso	john.barroso	john.barroso@embraport.net	$2y$10$fzX1bQd6LIdRxuRLD0c87e/.ub1r8iqv2hMCo4pdw.1TV4996I1DS	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
946	Hernanda de Souza Silva	hssilva	hssilva@embraport.net	$2y$10$Ibp03ywgbedM5O0A03irset5ZFxWfCkKW9Ro5KfXJbxewX4uwL3me	\N	15	2018-08-06 13:29:46	2018-08-28 12:19:33
942	Guilherme Fernandes do Nascimento	gfnascimento	gfnascimento@embraport.net	$2y$10$Ui76pWPLsJeA3Epd/c1AyeBkXDdszsb0a1P4ME0aiOEGaOs1FDIiW	\N	6	2018-08-06 13:29:45	2018-08-14 14:22:37
983	Jira ADM	jira	HTTP/servicedesk.embraport.net@EMBRAPORT.NET	$2y$10$tLcTagLNhVg/kkxQfr4ICupkBMBBXiy0FEJ/MdaMXZfuoGyFzIkxC	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
984	Impressora-user	impressora	impressora@embraport.net	$2y$10$LPJT/R2u.19u3qca9HIRA.s8lpyjqvQEWwYNuXBmVgHLZHxn1d.wa	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
985	Inventario Microsoft Odebrecht	invent-odb	invent-odb@embraport.net	$2y$10$WC8LCSUFCzSZZ7awFEgD.OuXASOutU3SMkyppeAsit4Tc/BmnuyiO	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
986	Portal Embraport	intra-share	intra-share@embraport.net	$2y$10$T.X/IhLIymMoLMHMncinDeOGWNvmLYBQfWneJttv0VxrhbeYGytDa	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
987	DPW Innovators	innovators	innovators@embraport.net	$2y$10$sigztsNnT3KMWhwOmWt5/.1e/fgik3gF1HziGt3vXDwsFY.zgGiZK	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
989	Ingrid Gafanha Perez	ingridperez	ingridperez@embraport.com	$2y$10$2pK8Ml2AUhCGm7/iMVUaHO979kFrzFYVNJL7auhZ8YWIVXAAZjWH.	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
991	Israel Mejía	imejia	imejia@embraport.net	$2y$10$N1QG94HrrS2zSFVHtBEoe.cJ8Wcp/5hdZvQkmlgy0Rb2QM/S7w8Wm	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
992	IportSolutions User	iportsolutions	iportsolutions@embraport.net	$2y$10$pIovau3d3ih5JUavKm3ybegFhyiT5XpNB5uYxh1i8H7HqVcm.w0im	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
993	Igor Corrales Martins	imartins	imartins@embraport.net	$2y$10$9Rg3gnghPzECn087cF.Z0umCQ9/1q1kpkMro2fX7Ps7kGmeSAPq42	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
994	Ivonete Marcolino dos Santos	imarcolino	imarcolino@embraport.net	$2y$10$ABvmkb3TfnhszqYdk4BwXetL0BKzNIqTH1uMoPn9tB8LVcObDYEQa	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
1003	Jeova Ferreira Cardoso Junior	jcardoso	jcardoso@embraport.com	$2y$10$R2cK3/zXbJHyX13XtcXlXuS01U5EV6JmZzbVrqv8mK.4W7sbOTYWa	\N	23	2018-08-06 13:29:50	2018-08-28 16:09:27
996	Igor Nascimento de Souza	igornascimento	igornascimento@embraport.com	$2y$10$MPsVE6FmzVIbD/Jo6K.LKeH5iVHvrDCRfuqBK2DBWsAmSX9zMMubG	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
997	Igor Francisco dos Santos	igorfrancisco	igorfrancisco@embraport.com	$2y$10$sPQoblAo5Y0i.kIa6CfML.MbJSZGup2Tp5ELbvcU..QLcq6Htr4KW	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
998	Italaney Helena de Belo	ibelo	ibelo@embraport.net	$2y$10$p1bUUgi8yGG4U53aCtC71ehtf7hRID9iDYK0kUf2mNiVUww4RU6.6	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
999	Izabel Cristina Silva de Oliveira	ioliveira	ioliveira@embraport.net	$2y$10$LfBTzgDN30EYxs01/F3fV.gCK/bi/nYbaSgm1.0ARmEYeMufXEeh6	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:35
1000	Isabel Pinheiro Carvalho	isabel.carvalho	isabel.carvalho@embraport.net	$2y$10$xg9s3o/WqIsM5/JEYHkkkOlRILOX/FAdbTyeAuYfZ5QGyjwSLuOrq	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:35
1001	Jeferson da Costa Macedo	jeferson.macedo	jeferson.macedo@embraport.com	$2y$10$Q3e8gauS2JMRBK.wMRkHsuKb9k05UX04351hHaV0xz2x2qI/FwvOq	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:35
1007	Juliana Sganzella Bambini	jbambini	jbambini@embraport.com	$2y$10$ibP/BTQa9NdvCnDJknB7xudFu.9WF4Aw97lAjmCsnHZQyDYEUYYt6	\N	10	2018-08-06 13:29:50	2018-08-28 09:18:00
1002	Jaqueline Lima de Oliveira	jaquelinelima	jaquelinelima@embraport.com	$2y$10$7IlKqc2zsyEJk2IYzvYFfeC/iLw2JSjq82RE/sThFOGu5/RDkA3fO	\N	6	2018-08-06 13:29:50	2018-08-14 14:22:37
982	Jefferson Rodrigues dos Santos	jefferson.rodrigues	jefferson.rodrigues@embraport.com	$2y$10$.lig1rj/4MDZQy0IA9XQsuScPCLTNYSn4FjWDt9H1AspIepXdJ0Nm	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:35
1015	Izaque de Sousa Cerqueira	izaque.cerqueira	izaque.cerqueira@embraport.com	$2y$10$FoI0bUSmC4fB40rGZmtoP.xjH0CXe2tHcTOjKGxBglxGX.odK9OAu	\N	12	2018-08-06 13:29:51	2018-08-14 15:28:08
995	Iracema Silva Alves Lopes	ilopes	ilopes@embraport.com	$2y$10$4BrImklsAtVYShJeO5gv1.KZYWpVOoXOcDwtaENf54IZNEuHUD1Km	\N	17	2018-08-06 13:29:49	2018-08-28 12:37:15
1004	Joao Bosco de Barbosa Junior	jboscojr	jboscojr@embraport.net	$2y$10$vJeXl4OrZfUfYH2vK1ZTXOzthMWSbHSn2fpboHEkmLMBqHh85wkTK	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1005	Jonathan Carpejiani de Bittencourt	jbittencourt	jbittencourt@embraport.com	$2y$10$nugwn/2S/6TkvV9fQ.N3seMA32gNaZJIb6v7r5p9zlM9NwdL5xV/q	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1006	José Mário Teixeira Barbosa	jbarbosa	jbarbosa@embraport.net	$2y$10$mDF70bcoLtiQ9zKKLe8.ceED2yUmCavalema1NmK8GEk2B5mpCN/S	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1008	Julio Cesar Salgado Arruda	jarruda	jarruda@embraport.net	$2y$10$2PDYG9YWe0e3esC..Y/SCOD5DywsBu6cCNVrKIu4VB1rHpbeqNB3G	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1009	Jaqueline Lopes	jaquelinel	jaquelinel@embraport.net	$2y$10$2MN4IfN5luga8O.zNeYwyeOEGZYtIrKhYPH9xQDovSNw/3w28eZPa	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1010	Isaque Souza	isaquebatista	isaquebatista@embraport.net	$2y$10$e6lfAP8ZUqd8EI/p0vJNduXtU6pqMcSI267Vwh/v8ZpHGdJNMGoqq	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1011	Jaqueline Santos Mendes	jaqueline.mendes	jaqueline.mendes@embraport.com	$2y$10$gq4.TQWmhrhlW5bqx8MiyeKxYvE6XG4upuT8wNqB5jZyIJmIH47jO	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1013	JANAINA APARECIDA NASCIMENTO DOS SANTOS	janaina.santos	janaina.santos@embraport.net	$2y$10$3qUF6kYwTBSaWxDEed3bAulORVt/4s3v64o4HEJvDYVlvps4qZvzu	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1014	Jacson Purificacao Nascimento	jacson.nascimento	jacson.nascimento@embraport.net	$2y$10$7KEOt1.dkrwpZ8i5PWfzjOlh4gl0XP1Mj/doTGZc90/qHOpO2JiKm	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1016	Ivan Jefferson Dos Santos	ivan.santos	ivan.santos@embraport.net	$2y$10$IKHNUzmTy1JAg8Jkph/oK.ZPz.w4Lk/yRo3SCkw5uitcdh7IDJGxq	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1017	Sala Itanhaem	itanhaém	itanhaém@embraport.net	$2y$10$T247JvqoJY5IO0b8iYaAWuLHGxlI3cIABukkf/24BWUNqS0k9T0G2	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1018	Francisco de Assis Primo de Oliveira	francisco.oliveira	francisco.oliveira@embraport.net	$2y$10$QIT/NQteRzYpuRK3EDtYCuMbCwgPhwXWYmOR78PJsT0YhTfJVIwqi	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1019	Fabricio Raimundo Alves	fraimundo	fraimundo@embraport.net	$2y$10$nLmPMwa9TyIKlxBD5yE/Huia1LS79natrjmIIcgF5q.UuVpcLkI66	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1020	DHCP User	dhcpupdate	dhcpupdate@embraport.net	$2y$10$5mVW8YqchZqrzaxw4n9.ienpITzgy7pLAO.rBfLaO34Kgr1IF6h7W	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1021	Edgar Batista	edgardbatista	edgardbatista@embraport.net	$2y$10$LuC2EzDM76e6lolI0p4Zv.EfiFMubgq1hcVYFRlXdOkU0KMltyai2	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1022	Ednilson Jose De Oliveira Silva	ednilson.silva	ednilson.silva@embraport.net	$2y$10$5RxDqJT7j6OdTE3zvFBEpOlOQ8AyEQ6cC6xapel7CYm4OI2BjpNdu	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1023	Edmilton Ribeiro dos Santos	edmilton.santos	edmilton.santos@embraport.com	$2y$10$M3IeDaGYtZy7J14nFMWVhewpwfZ2CR6ApnyGi2nAahIkpAmA6dLOy	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1024	Edison Ferreira Loes	edison.loes	edison.loes@embraport.net	$2y$10$lE.05uhaKKSfSsUWDC76.utLHRgtWm/ou/4lsamc4f74ym1DJG2QO	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1062	Djalma Severino Melo de Sousa Junior	djalma.junior	djalma.junior@embraport.com	$2y$10$AL6oyyuW3LNch8H4GjNxqeDn4JTvXQAcLI1U05j5doawe9GATZ5Ba	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1063	dispatcher	dispatcher	dispatcher@embraport.net	$2y$10$lbYxAAhA3QcN0.kXYhapEOVTBPOXeHkPZDV1CWKPC9Xq.rxSgxSki	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1064	Diogo Camilo Pereira dos Santos	diogo.pereira	diogo.pereira@embraport.net	$2y$10$gdiDpFAhCjIW/wppRFk1QuWoruta0kz2kNshg3Ln/lJpYMP1ADw26	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1065	Daiane Bernardo Omine Dias	domine	domine@embraport.com	$2y$10$JJwW.HILYg8RJNZdnIwKceUw/8CTyPnj6TSnAw1fjNt7g3wwvDH9G	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1066	Digilife User	digilife	digilife@embraport.net	$2y$10$6BIDOs7q7jsvryRZH7dtOe4bqtTM6S0lJYGcIvHh9xzNuIgWYctYu	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1067	Diego da Silva Silveira	diegosilveira	diegosilveira@embraport.net	$2y$10$QqgCE6ERfvGgqX/aQC1iF.XDpEuN9hhGB6vzndrHzdp4FokB4uu2G	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1068	Diego Cardoso Inacio	diego.inacio	diego.inacio@embraport.net	$2y$10$BiIBKQ9iL6kfDHDF/uDV1.REK2VtWTdlua9/H/ScLapk//INSt8p2	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1069	Diego Forjanes Rocha	diego.forjanes	diego.forjanes@embraport.com	$2y$10$pgIY6IH84gRYe70EyMLdO.iPH0Vrk7ku7LrOfPmk3m71lTRixMZxW	\N	\N	2018-08-06 13:29:54	2018-08-06 13:29:54
1026	Edgar de Freitas Martins	edgarfreitas	edgarfreitas@embraport.net	$2y$10$vbbN1wmxL/0d8pLo/t4hjuEaNFAFTwb37VDlH/7LR50N3OMm0D.Ie	\N	22	2018-08-06 13:29:51	2018-08-16 08:40:36
1028	Edgar De Lima Braz	edgar.braz	edgar.braz@embraport.net	$2y$10$YboSZtaBI5rPK7zOJ4pftOxYhRS4pHQRRperHKXMTuM.rAYO1DoIy	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1029	Eduardo Machado De Oliveira	eduardo.oliveira	eduardo.oliveira@embraport.net	$2y$10$/2Ss99SamMx2rCM2Lx8rJe3sDQChnkL4v0M/2gVZL90VSKV3L96r6	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1030	Eder Alves Candeias Franca	eder.franca	eder.franca@embraport.com	$2y$10$aDQge1EkI7o6vmj/tmACJuas9F7VGnX8KdTb5CylE925v3xRegbd2	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1031	Erick Douglas Cabral	edcabral	edcabral@embraport.net	$2y$10$fM04/xu2JBkKiFJUitY8EOHqc9chGsFwboDqHFgOShtOU/wSCdB9K	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1032	Eduardo Augusto Paiva da Costa	ecosta	ecosta@embraport.net	$2y$10$P3bPbk7QiXslA4HFDWFG3u8I0/FsWVQveGRf7WniktG6uYbzYAb7K	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1033	Edson Alexandre Gonçalves Cordeiro	ecordeiro	ecordeiro@embraport.com	$2y$10$guT/iJbxgfD2dSjnUs0nBeTyZ3kJYhe8EvUKoo9tzsSI9LICuH0nu	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1035	Eric Frossard	ecarvalho	ecarvalho@embraport.net	$2y$10$t1DXe.2GeQm8tDTu5yAXkuPKbIU9utObp4B/QhTReU4.PhlubOwfC	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1036	Edson De Arruda De Oliveira	edson.oliveira	edson.oliveira@embraport.com	$2y$10$dKycT.LPRpToQJKRFw3/WOusCcYdN9yeiRIPgA/kD/AMpb/HWC81e	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1037	Eduardo dos Santos Sousa	eduardo.sousa	eduardo.sousa@embraport.net	$2y$10$e.zRiPREYQ5kcZ2lqkObf.ytRCVcamoEjyrtUrZ1l6qiitSRwjIb2	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1038	Anderson de Souza Caires da Silva	ecaires	ecaires@embraport.com	$2y$10$QcLD7EtiA8f7hsTQWxzlt.3gg9vgiqaipcjLvooFzLSlyRz6MLnGi	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1039	Edson Luis Siqueira da Silva	elsilva	elsilva@embraport.net	$2y$10$x4z.TCl2BiApZOcu2WAbr.Xi7gmcXOJCgr8hTBqLRraKI/522AuUW	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1040	Embraport Teste	embraport_teste	embraport_teste@embraport.net	$2y$10$qu4V5JSpijzM161hbuQSZu.DL5mOqG0xhizNAauHzcqZaD1Um6N7u	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1041	NFE Compliance User	embraport-nfe	embraport-nfe@embraport.net	$2y$10$OH5BJZIeBNnO0BnU3T3UFuA..2JzPXJ09Hcu3qUk/1r1OHj.4fgo2	\N	22	2018-08-06 13:29:52	2018-08-16 08:40:36
1042	Embraportonline User	embonline	embonline@embraport.net	$2y$10$Wml9xvQ3sRHxQZHI.r6EgudNNtJEcGKWboj5a9QoWK01UBIS5WpXa	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1044	embcordova	embcordova	embcordova@embraport.net	$2y$10$CkN.5297ycUgne22zFPh9OnnppSE0fa7GFAq.a4WVyN.oBu4gaHiu	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1045	Eduardo Magalhaes	emagalhaes	emagalhaes@embraport.net	$2y$10$u4PNSwKzxSGGLiFQbBIYC.eFOFDnSLWwhFlov1z5u/Utg24ElVy3y	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1046	Elizângela Cristina Cassemiro Carneiro	elizangela.carneiro	elizangela.carneiro@embraport.com	$2y$10$atD800N1wZq.zlO1DXdF9epBw1fhUMvT3pa/R1uO4oWe/a3Lb2fXa	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1047	Eduardo Tavares	eduardo.tavares	eduardo.tavares@embraport.net	$2y$10$2iUjmD2YxRpbNwVHGvZCsudWWm39wsk.rvShcq3lTHMDmxBrQoKKa	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1048	Elizabette Alves de Souza	elizabette.souza	elizabette.souza@embraport.com	$2y$10$yIe.qX/nCiuBWyPHmDtxWO.cj9bWUOg3N.qdb6OXdqteMTanlzca.	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1049	Elias Ribeiro Ferreira	elias.ferreira	elias.ferreira@embraport.com	$2y$10$Qsc8A5DbTvR6f7yhrt3/UuaVxkPttpGcTrP7aQkU9HF3GXUT9GZfC	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1050	Eliane Lopes Pereira	eliane.pereira	eliane.pereira@embraport.com	$2y$10$ZdyZfFomTGbkaHiV7ZkWQeAAu2xOMbOQo2ULvxgjg1BzGx0jA2FnK	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1051	Eduardo Affonso Latrova	elatrova	elatrova@embraport.net	$2y$10$aTC4WZXAiqPlp4amRPZgkuRx/X0wWjqxsAf49NgxyA29aHB2BJWGW	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1052	Elaine Beatriz dos Santos	elaine.santos	elaine.santos@embraport.com	$2y$10$bfhvKNlo3qLosbxxOYmBcutcHXyMtreUUWrdaFW42uBZ3tyqSt.5u	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1053	Eric Fabiano Hiromassa Koshiba	ekoshiba	ekoshiba@embraport.net	$2y$10$K3pR5QXra8MdMfKZrjCq9.ynxwTocvud0WbX/BWd2MyCNDB/fQaBy	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1054	Erinaldo Amorim Campos	ecampos	ecampos@embraport.net	$2y$10$/X5s91ywfL.Wtd29pBqEXeXjoMD8B1WBQ5oBtK408LP9UEuLSOk6O	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1055	EBS-IT-4	ebs-it4	ebs-it4@embraport.net	$2y$10$A8E9T6n.F4elnQzWzv7DAO.Jt0/5mgLCm82uIOwbJUSatWVFOvt.W	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1056	embraapple	embrapple	embrapple@embraport.net	$2y$10$d9ufm/5TBEQme736jXD7u.euk4rAVUzI4zh3NwdxQrYW9POaLumea	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1058	Doc Exportacao	doc_exp	doc_exp@embraport.com	$2y$10$VTsOlxDTraqFlFBtoZXqAOdlBm6NbVsg1yRurOEtVlyPNK8K8j9Qa	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1059	Davi Ferreira Leite	dleite	dleite@embraport.net	$2y$10$B.dDQ0nznvZHc1mglvLyNenmv0qnmZMrc3gUlzHcganSODSiXFEsO	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1060	David Jose Freitas de Oliveira	djoliveira	djoliveira@embraport.com	$2y$10$MUaqa7Ho7NBuV68vbvzgnOa5UW6QOyjMKSs2db0xUWXGDd31D6DwS	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1061	Diego Joaquim de Oliveira	djoaquim	djoaquim@embraport.net	$2y$10$FGw/MemfgvRwXxs2IwIgReHIe0Gph6duIbXh8usSsf4UrX3FD8SzC	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1034	Elder de Oliveira Coppi	ecoppi	ecoppi@embraport.com	$2y$10$/3CpRd7HIUJw6O12WVXUPOFxdxKVVnkbrMk4J8i43eCLfvBUk3g6K	\N	23	2018-08-06 13:29:52	2018-08-28 17:00:35
1070	Diego Martins Araujo	diego.araujo	diego.araujo@embraport.com	$2y$10$24ZzTUR3rQ46BxMd1dwh1.lwpDHRYiqbLfS39hhuJymfUBOX5tj1q	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1071	Sala Diana	diana	diana@embraport.com	$2y$10$/JO7CZ2.96.N2RhIGpZRJOesTSqoN3otCoJWViEG0kqpL02903UX.	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1072	Documentação	documentacao	documentacao@embraport.com	$2y$10$WpxlopZtzpK.jQzDxaiTMOj5iWvfC2FDAZ6nxFv2Tk2muGvaxW82K	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1074	EBS-IT-3	ebs-it3	ebs-it3@embraport.net	$2y$10$1jzAyyZHsg6z4RCTllmK5esChFDYKVFbd3pMZiWsss2Wb9aUt5cdq	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1075	DTE	dte	dte@embraport.net	$2y$10$52r6YodR3OJGUHniN67jW.p.BYIXQcmFLBOYIiLeuuazMY50Vofw2	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1076	EBS-IT-2	ebs-it2	ebs-it2@embraport.net	$2y$10$e14m/2IF0OxE4QYUsLAT0emXvKRHgHttFBwNxx452LyBsOKuHxWBC	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1077	EBS-IT-1	ebs-it1	ebs-it1@embraport.net	$2y$10$xr8CVaTgOulhtwvm9ZhlsOHDYoStcsNObD9m0wirPa7wieRqbamea	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1078	Eduardo Barbosa de Oliveira	eboliveira	eboliveira@embraport.net	$2y$10$6IziPueJGiNnQjhBnozoTeC41Q3K.lnRsnhRCP9/urQCKv7f7U2Zi	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1079	Erick David dos Santos Balbino	ebalbino	ebalbino@embraport.com	$2y$10$0Nc9myJnh1U3EeL8l/0q7uF.4TH.41tR3BV8fD/5p9eY25XNyQCeC	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1080	Douglas de Santana Viscardi	dviscardi	dviscardi@embraport.com	$2y$10$6xoAsAoXDROsnBOrEHbbf.ytuxEGpvW2oKuzYhYhMu9InPkwJOcOC	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1081	Due	due	due@embraport.com	$2y$10$.mB2DPOBCZGiuNU5GRujNuBLAO7Rk8F9sdNRKSpiVT8263v1mLL5u	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1082	Devlin Silva dos Santos	dsilva	dsilva@embraport.net	$2y$10$imUqOp8KBkHUK..DtBbAM.F3bOqm9F1C13QNUd7fKxm5oZjUxR8dy	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1083	Daniel Guadagnino Oshiro	doshiro	doshiro@embraport.net	$2y$10$zj5rHHLwxypa87qLrEkiLO7ha521f4.Ede8gi2LSGl8/vuLpAtgKa	\N	\N	2018-08-06 13:29:55	2018-08-06 13:29:55
1084	Daniel Raimundo da Silva	drsilva	drsilva@embraport.net	$2y$10$tPP8to1pFLJB8dumDNf39.UwTllP.FExWFEaEK0iot2KGlRC9JliW	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1085	Diego do Prado Rodrigues	drodrigues	drodrigues@embraport.net	$2y$10$CPOnCOLL7qUlEDEc2eZENuBXbJcV.P0nVvjIzR4hZncJfEkBrhLw2	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1086	Driellie Florencio de Melo	drielliemelo	drielliemelo@embraport.net	$2y$10$46/3lFwsQ/bUOs.D85XIEue1J2vLwSLENCSEJh3TvENmU1QNA26cC	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1087	DPW Santos-Test	dpw-santos	dpw-santos@embraport.net	$2y$10$k74ov5lAkWl9eZeVOz3u9OQTQLQ7n4qES.PRekeB.rl0TvzDueT92	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1088	Douglas Dias Pferdekaemper Santos	douglassantos	douglassantos@embraport.com	$2y$10$N3LQLWzyXFmHbhKSvdmJVOZQCT2.I7BrdnvCCXqzVXXyAA67SVbtW	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1089	Douglas Freitas De Deus	douglas.deus	douglas.deus@embraport.com	$2y$10$djIhlAVMrzXGjn.AqkmFKuU2i9gwCIu.XFkl6tf4FECTN5c2b/6X6	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1090	Douglas Dantas da Silva	douglas.dantas	douglas.dantas@embraport.com	$2y$10$Gkaw/0ka4djsIFrgNNI0WOxLwbTVze6nYZZJFH.UIX1wyU/eNo7By	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1091	User Citrix	embraportcitrix	embraportcitrix@embraport.net	$2y$10$X6VIQ796gYBGTI8IF8T2hOf2rn3xHedxA76bOUtyaGjQoyqJ.Dr/6	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1092	Emerson Medeiros	emersonmedeiros	emersonmedeiros@embraport.net	$2y$10$c/OjRn5bW1kiFVmhkw2OM.cZc8MFtvnsCk5bTMATXOnzDV5gmmd72	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1093	Francisco Porfirio da Silva Junior	fporfirio	fporfirio@embraport.com	$2y$10$MNKekOjV/9urii6lN7Y1Menn.zSIf2gubSUFO.x4/VRJ98eTquBzu	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1094	Felipe William Laffront de A Bezerra	felipe.albuquerque	felipe.albuquerque@embraport.net	$2y$10$RJAWqaG7Y6USnR4qKmjWyOLpbeZBo6v7JhQveywoKqcDm/jUEDuHm	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1095	Felipe Otavio Mateus	felipemateus	felipemateus@embraport.com	$2y$10$LO4.dpEJ8gzl3NzCnXtT8O/udln7viNtW5P2sOljVh2GXGCXqsWk6	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1096	Felipe Gouveia de Souza	felipegouveia	felipegouveia@embraport.net	$2y$10$oC3yy1E8/XGg9fuf/0vs9OrpN1M5tXV1xdTEptaokHicp0DLKrq9y	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1097	Felipe Sampaio Garcia	felipegarcia	felipegarcia@embraport.net	$2y$10$ULuzabAiB3VkDu2HCH3QReg4AwM/i8yhxYQppyQIWn.2CY82BhCwW	\N	\N	2018-08-06 13:29:56	2018-08-06 13:29:56
1098	Felipe Cyrieco Silva	felipe.silva	felipe.silva@embraport.com	$2y$10$RGxp1e91PsbdAzWqj5QgSeQb7r6G2wfGj/5LqXrXfNdA52Qac3Rri	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1099	Felipe Nogueira Martins Dos Santos	felipe.santos	felipe.santos@embraport.net	$2y$10$q0tGORaok4XeRzYdgKQqxuQCBrZLkwPmYrx8iAtZ8sDP02MrEQhga	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1100	Felipe Lima Bezerra	felipe.bezerra	felipe.bezerra@embraport.com	$2y$10$KB1F4YcrK01Mau5rK9g8dOqfVM7TijRdGQ3rNITkN/lsTYnCsVU1u	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1101	FederatedEmail.4c1f4d8b-8179-4148-93bf-00a95fa1e042	SM_e807c6e7207344d68	FederatedEmail.4c1f4d8b-8179-4148-93bf-00a95fa1e042@embraport.net	$2y$10$R8gx4JFRkp1J4cB54jiet.4ZyUZT4YP/K8QkTIZHoqrypMKsvYzce	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1102	Fernanda de Souza Jacintho	fernanda.jacintho	fernanda.jacintho@embraport.com	$2y$10$hIqQTg3.6/gZbEt3XyDhGO2PZurJzlyeUQr.hhaXPJ9b4zkjGs1AC	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1103	Fabiola Renata Silva Delta	fdelta	fdelta@embraport.net	$2y$10$LJV0w0BHegsKepzpxK6YP.wpvvapYFKHj.jIyjkD.ME940M43OH12	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1104	Flávia Christina de S. V. da Costa	fcosta	fcosta@embraport.net	$2y$10$kKbPmM.XyC20A5jwgSx6w.r.guJCJMBMsCj2EPI0JcCWhRP1oGHhe	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1105	Francisco Clerton da Silva Freitas	fcfreitas	fcfreitas@embraport.net	$2y$10$QY0Kj5AvJtR6hdROG3tiz.DopZs0JJj7xD3XzHqNhX9kH40qBlbGu	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1106	Felipe da Silva Cavalcante	fcavalcante	fcavalcante@embraport.net	$2y$10$B3fAd0sc6O4TP8pHKuIY8eqHRlruOpy5c29irZkQXlu39y0yVXklG	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1107	Felipe Barreto Costa	fbcosta	fbcosta@embraport.com	$2y$10$klCwZzZmUsNsnjyux10QyuIicpIKWoSYn4WzbBxEmVaw0HuUqf4B.	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1108	Felipe Bruno Bezerra da Silva	fbbsilva	fbbsilva@embraport.net	$2y$10$3HtDYOup.sMdVi0Mw/VQBOhNlN4bqJgq5ApXGFSBL5HvuISqdTDnK	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1109	Felipe de Sousa Santos	felipessantos	felipessantos@embraport.com	$2y$10$ZHApFW0hSrRHoM.CWYjvN.9O.8.n3pzoqu4p0E3h4CA8EA9l1wzKK	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1110	Fernanda Nogueira do Nascimento	fernanda.nascimento	fernanda.nascimento@embraport.com	$2y$10$VZh.MC2OH2qlToxGVBQ0zOx6y87ck5zdMIuPXqvo7PoGTitoW4AhS	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1111	Faturamento Exportacao	faturamentoexportaca	faturamentoexportacao@embraport.com	$2y$10$S4VscmzehTfK1YaVty.aTeAlGlPAx3nZI78WXYe7PovtfmgqXQwYK	\N	\N	2018-08-06 13:29:57	2018-08-06 13:29:57
1112	Flavio Augusto Lopes de Oliveira	flaviolopes	flaviolopes@embraport.net	$2y$10$kJzcXHdUheOCtke2/8i4VuEAg2SoPEWd7f.YXqZLjXjr3kSx/Xt2a	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1113	Francisco F Pereira do Nascimento	fnascimento	fnascimento@embraport.net	$2y$10$F951sE3iP17gpXXF9Ov/8umuqtW16mIAvA6GhfS..llBL/xg3GzLi	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1114	Felipe Oliveira Modesto	fmodesto	fmodesto@embraport.net	$2y$10$odmE0zyMG6q2C0t1SIDl9eaFhohXf5GK4vng1GcLioPKkxN9/iXZa	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1115	Felipe Marinho de Almeida	fmalmeida	fmalmeida@embraport.net	$2y$10$66gsVHt6O9sAiP7nLI/w.uPQS.LD/vnjT4415YtHh9BlPU6zKlRym	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1116	Felipe Maionchi Nunes de Sousa	fmaionchi	fmaionchi@embraport.net	$2y$10$oPO.yZXpG0y5Z45EHPTMeuNBPIOFqmVrdL9Y1//okK6X.D1CJ2AEW	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1118	Flavio Luiz de Oliveira Ferraz	flferraz	flferraz@embraport.net	$2y$10$gdoAcH3PeXcFpVxQKKkeeOM9A7UoEGUu9ebudwpcpWrN0Z7xd4ely	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1119	Flavio Fonseca Guimaraes	flavioguimaraes	flavioguimaraes@embraport.net	$2y$10$6W0xBhWHKLH3w78jRpO2Junl/A8vgT517SPmwzA8BuRKVLxHvPxda	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1120	Fernanda Santos Rodrigues	fernandasr	fernandasr@embraport.com	$2y$10$r3zKcbufezcTO0lngUG.1eaYQc1dbY2Jh0nGGmzu9dnEbPRFU1HCC	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1121	Fiscal Receita	fiscalrf	fiscalrf@embraport.net	$2y$10$OKTBSldX2bMA5NIht4eBlOixrpXsomav/vafdn.bKFqovtjzSpSEW	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1122	Fiscal DP World	fiscalembraport	fiscalembraport@embraport.com	$2y$10$qWV9v8WMJwCTBMW6D79KrOkmYwZUVFMkI4wPNQLWlA.jWxhGYyTey	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1123	Felipe Guerra de Almeida	fgalmeida	fgalmeida@embraport.com	$2y$10$jfAgx8MmGRDfl0qB66PCxO0qKWiY3fvSD4PI9yoAT3COjSis01.XO	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1124	Fabio Jose Farias	ffarias	ffarias@embraport.com	$2y$10$D6FS87FKZ9F/2GPZ7.B7u.d0HBLiZ5NnnZhZLfgvkbrdm.8dHVGXi	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1125	Fernando Lopes Martins	fernando.martins	fernando.martins@embraport.com	$2y$10$tmy73N1xRDmEvWsjeEkW1u8S961nKi.b68QdgIwTA80A2vfP/Xwf6	\N	\N	2018-08-06 13:29:58	2018-08-06 13:29:58
1126	Fernando Simoes Alexandre	fernando.alexandre	fernando.alexandre@embraport.net	$2y$10$EVsfhZD4cpqgk799NSlVF.JONOAM/tmN/Nqd8/ivmAVOQ6U6Zi9sS	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1127	Faturamento Importacao	faturamentoimportaca	faturamentoimportacao@embraport.com	$2y$10$0tRFpDwo49KsVTcIb9CImuUex6QRmEZEakDLXGpJn5cB4yw9RhOZq	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1128	Faturamento Armador	faturamentoarmador	faturamentoarmador@embraport.com	$2y$10$xw3NkzExjYpkdX2I3U/2RuxkWClCDCveWF8DJSeFNS0peVQXOz5CC	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1129	Eliane Martinho de Oliveira	emoliveira	emoliveira@embraport.net	$2y$10$K/ZF61Rt5eYXAAATNDJsKu0cNdv3S9zHHCog.jzXRTSyitqCBGmsy	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1131	Evandro Theodoro Teixeira	evandro.teixeira	evandro.teixeira@embraport.com	$2y$10$qQTe8NYAPL1hXLwT6vxiXeVhWHtgdC4Jc43ANzxlmczVlfp2UJ9iG	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1132	EUDER MIRANDA DEODATO ASSIS	euder.assis	euder.assis@embraport.com	$2y$10$ObZwHvAmLOEB4mM2Fwv5bugHYnH.mISlrbqa78lG5c5eDr2jeiuPW	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1133	Edson Barbosa Celestino de Souza	esouza	esouza@embraport.com	$2y$10$6KDAnnwMXqxypmlA15SGh.qrC0qkypJNevi9qK3CZxzPXEZ0p.7X2	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1135	Ernst Theodoor Alexander Schulze	eschulze	eschulze@embraport.net	$2y$10$0jbHHPGr.mzcWdlno70OfO2JxnEr.ShZG8ukm9JltfNaBxjo6Qwua	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1136	Elsandro Santos da Silva	esantos	esantos@embraport.net	$2y$10$lGguwwT/ohT/K8DjgdPp/OSAckl8vQ7l4c6V7LeH69UjUcbASjujq	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1137	Ernanio Oliveira	ernanio.oliveira	ernanio.oliveira@embraport.net	$2y$10$rX4oc6IJWzlMrWi4k2VdZuZ374VmkBuvDz3E2EF.aSm3jd5IRjlca	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1138	Eros Costas Verde	everde	everde@embraport.net	$2y$10$8VA97cZcP8FiPN2M4aGjQO8Xp8HU3DZGaiwgSDINRUBvhRhrGDLUC	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1139	Erica Dias Delgado	erica.delgado	erica.delgado@embraport.com	$2y$10$eFOZSAtVcwlshW0lYu2u0.AmfHLG4CH6auFyk7WaVGBni/urzjhcy	\N	\N	2018-08-06 13:29:59	2018-08-06 13:29:59
1140	Eric Belda	eric.belda	eric.belda@embraport.com	$2y$10$nS19KflQO1F24PKvnl1awexOPNJW//Dv0s8ulZdnlDsY6rfdO29Ai	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1141	E-professional	eprofessional	eprofessional@embraport.net	$2y$10$HqCiieOnehYWLpwnl.sh1e641hxc8d8s0oBLPBOSEUoo7MkPVmFYi	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1142	Ewerton Orlandin dos Santos	eorlandin	eorlandin@embraport.com	$2y$10$6IeYObyNQLd0LUvXX3YcPuMlgNdTq1ohjAuME1yMJH91KcjnEGAly	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1143	Enrilson Giuliano Carvalho de Mattos	enrilson.mattos	enrilson.mattos@embraport.net	$2y$10$HGr5ug7zCWTIEghQafICU.r3bdarmbReUFhEW5J67BbiDbVwmIoca	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1144	Edson Natal	enatal	enatal@embraport.net	$2y$10$IzFvuGD0s0W6MAWjDhI.7Oyu3KR6G9mPlwXPN0KjL3s.hNTMEXs9u	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1145	Elton Venancio dos Santos	evenancio	evenancio@embraport.com	$2y$10$e/wWKetcpPGld7qvWL3H3O2A51oMOIjPmTEOvE1nbGZ7Fwnw/hccG	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1146	Everton Goncalves Formigheri	everton.formigheri	everton.formigheri@embraport.com	$2y$10$eoLfZGy/ph7p1TmHYli3U.tn8mRiCcUNfTGX3zhvpDp7VMG6mgmgu	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1147	Faturamento	faturamento	faturamento@embraport.net	$2y$10$B782FL1CgdUu1KSpa4ULYO7QzZ6fZdIRwLQkG9Khx0eqiR9bTF70G	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1148	Fabio Marcelo Pedroso Pereira	fabio.pereira	fabio.pereira@embraport.net	$2y$10$2G1DVuxmmVfTH1Ci0FN32.TZEE9Qa0K7sAg74wOMq6/J/8n7neBhe	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1149	Fagner	fagner.consuldata	fagner.consuldata@embraport.net	$2y$10$6lx7Q95vI0v4OPRb4wSKpeq21n79oj9/TpaQSg7ETgJliyG3puW0G	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1150	Fabiane Anjos do Santos	fabsantos	fabsantos@embraport.net	$2y$10$iTJilpR2PtTWvFSaYuku7u7DF.J1fwu1/NrvTc2N7E3kxur01iU7O	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1151	Fabricio Giovanni Da Silva	fabricio.silva	fabricio.silva@embraport.net	$2y$10$eNlbhIRTE096WjA1YCjZiu.OhwC2GoME4LtQ2NFP6ch68HiBWpjCK	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1152	Fabio Vinicius Rodrigues Reis	fabioreis	fabioreis@embraport.net	$2y$10$AULsB/eRCVQ/U5WjjEL1wuvmDCt1XntKye6moNel0Np86FkJ0QYau	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1153	Fabiola Souza da Silva	fabiola.silva	fabiola.silva@embraport.com	$2y$10$44nBri3GatcVZSCR2rYrLOoepLPp36st8i2B6AXk0HN8daaeG3RYe	\N	\N	2018-08-06 13:30:00	2018-08-06 13:30:00
1154	Fabio de Santana	fabio.santana	fabio.santana@embraport.com	$2y$10$vZGTPuE3Wqgru2i4.FUaneqONMqxHyayjt0ReE6FHy4J/E7pIlPda	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1155	Fabio Nogueira	fabio.nogueira	fabio.nogueira@embraport.net	$2y$10$iNgJY9MIzenMXZ09pCFjpuyHh1SFndhZCbZJBaYAATvtYJEbJhF1S	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1156	Everton Gonçalves Formignheri	everton.formignheri	everton.formignheri@embraport.net	$2y$10$O8RW6l9O8V61Y1BvRt9k.OSLKtGQHYP7TiF5sU.3XAQhlX2UHD132	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1157	Fabio Mendonça de Lima	fabio.lima	fabio.lima@embraport.com	$2y$10$x7vFPFnnext9vvbwgFYl6OaycXGUkDev9tPYYpS.WI6GKkyONy50S	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1130	Edvandro Sachs	esachs	esachs@embraport.com	$2y$10$YsmMZCY3lIYNFNSZclriKOoiz4SXUdp5UvEX6T7JSj/yiR/Bxjxea	\N	13	2018-08-06 13:29:59	2018-08-28 11:38:19
1117	Fernanda de Lima Garcia	flgarcia	flgarcia@embraport.com	$2y$10$fQjXvnLUy4HRUJC/0kyzJur.24KG5Q5xSUG4HsGVdbNydCX5MJ1C.	\N	15	2018-08-06 13:29:58	2018-08-28 12:19:33
1158	Fabio Junior Da Silva	fabio.junior	fabio.junior@embraport.com	$2y$10$6CCKqOj44ecRFhuxL.AhHed9HNKncygKXTp/nv2b7wpM1Wrh59ZoK	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1159	Fabio Roberto Rodrigues de Barros	fabio.barros	fabio.barros@embraport.com	$2y$10$SR/N1rCq0m3K6uw/zCO0r.fbONe.TQw6CfpYLcQ0NlnbyOpYJa9wC	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1160	Fabiano Gomes da Rosa	fabiano.rosa	fabiano.rosa@embraport.net	$2y$10$lqR8/7r2FQyrVOSOqXTF/OonBNqjyCUisOcO87rc/IVazi72h4lue	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1161	Fabiano De Carvalho Pereira	fabiano.pereira	fabiano.pereira@embraport.net	$2y$10$GQ0q5CUEx1LW/MXcYFrKBOHOWKlg7bpZwl29Lt8CCBimyahhJmFgW	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1162	Crossdocking Temporario	ext.crossdocking	ext.crossdocking@embraport.net	$2y$10$M7JLkXK/UXQPu9AhTo2xdu3A1WBESx702KBsSm83kq.2M8gGpHQ6a	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1163	Everton De Melo Goncalves	everton.goncalves	everton.goncalves@embraport.com	$2y$10$Nsk6eo0MLJINcALfX//DduF6XHopcjrS1xz4sYqESBJMRxnX0dp1a	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
1164	Zabbix Teste	zabbixteste	zabbixteste@embraport.net	$2y$10$OM02w.LvDhIXOqKVNX0H3e.VpowdsYpfEqyOUiKiA36T2JGMBBi3O	\N	\N	2018-08-06 13:30:01	2018-08-06 13:30:01
168	Luana Almeida dos Santos Manoel	luanaalmeida	luanaalmeida@embraport.com	$2y$10$SZMroMR.pH8gkKzufpbMwOyIjIurd/FtieHuCUoXdvGsPTfZgsDay	\N	4	2018-08-06 13:28:50	2018-08-14 14:19:10
962	Jessica de Oliveira Magalhaes	jessica.magalhaes	jessica.magalhaes@embraport.com	$2y$10$S3uaU8IV3sGhMHecCAYtOOH3AHRsKPIpqx2mIJ18qkgZMsKaTeHDK	Vzw4MGgXpaMumAwko9xJsSdfcXcVyynHqcH54o1sMKMtFWun3qQ6V7W7EzRx	14	2018-08-06 13:29:47	2018-08-31 08:49:49
24	noreply comunicado de infracao	noreply_comunicadode	noreply_comunicadodeinfracao@embraport.net	$2y$10$ofSm8wLeNbRWQFT6BDmmPeUDFptzzS3mahcqEwYNmBZNo6iaAaLAK	\N	22	2018-08-06 13:28:40	2018-08-16 08:40:36
68	Monaliza Magalhaes Brandao	monalizab	monalizab@embraport.com	$2y$10$gne9a48tHLpHLuSigoHuWuctky34xyAlyGusc6rtVmaZ1pKUMhFwq	\N	4	2018-08-06 13:28:43	2018-08-14 14:18:59
59	Motorista NOREPLY	motorista.noreply	motorista.noreply@embraport.net	$2y$10$VaGp/t/OuaCfX2ZMg6Cbw.Hn0s4zwhCe3rHWMYLipHCR3DHFghmJu	\N	22	2018-08-06 13:28:42	2018-08-16 08:40:36
481	Ricardo de Almeida Faria	rafaria	rafaria@embraport.com	$2y$10$u5XbH0NLsfIPqoQJlsMNreHgF.gsRlCE7XrrZLIwKptpCP6aydoWi	WkplSInvGOw0ovKk6M1HPiR50N4NoXQBQQe5VunlKhOQMibaJwAhW4XXcIQH	20	2018-08-06 13:29:12	2018-08-14 15:50:42
81	Planner TI2	plannerti2	plannerti2@embraport.net	$2y$10$QVadneoP/Iul/TRgxDkZAuMYu8Bbu72Bql5VNGYVI7XkupoT1SAnq	\N	22	2018-08-06 13:28:44	2018-08-16 08:40:36
91	POC DELL	poc_dell	poc_dell@embraport.net	$2y$10$9TojKfCmrhPmgjln7W23iOugVp51XFfdNEJrLiP4okxRYBJkhc7zm	\N	22	2018-08-06 13:28:45	2018-08-16 08:40:36
113	operador.qc6	operador.qc6	operador.qc6@embraport.net	$2y$10$nobfeL.xVmrJRMut8xHR8uraQNw2eqA/LNNbpFtYGbmsB/SUDmbQe	\N	22	2018-08-06 13:28:46	2018-08-16 08:40:36
131	Paula Beatriz Leal Ferreira	pbeatriz	pbeatriz@embraport.com	$2y$10$l/J98YfS/tQDcd9mcPcwhuRC7dSghw5TbY0n1S9nbJdsR6sx79pCS	\N	22	2018-08-06 13:28:47	2018-08-16 08:40:36
146	Meeting Junos Collaboration	meetcollaboration	meetcollaboration@embraport.net	$2y$10$7SkpTw5sJ23cTdBtV0cgYuUp95aFgSLIUp.xRkGIpT3XRV3NHtciS	\N	22	2018-08-06 13:28:49	2018-08-16 08:40:36
171	Luis Felipe Valentin Turbides Cepeda	lturbides	lturbides@embraport.net	$2y$10$rxlHRsFvmYvGGoV0kXfKiO3LXehp2ag.648sFFYe9CkOp4h7Piq.6	\N	22	2018-08-06 13:28:50	2018-08-16 08:40:36
180	Levi Lopes Pereira	lpereira	lpereira@embraport.net	$2y$10$SanjTJvKCwMM6cowIT1e/.aN2JRsJbYS8HYTZ133WX7.DHfe//dGm	\N	22	2018-08-06 13:28:51	2018-08-16 08:40:36
191	Julio Marcus Villela Blanco Neto	julio.blanco	julio.blanco@embraport.net	$2y$10$Giz8CX445X4.35adLusYJOyCLnSoo70EtLJwUoyAUdEBRsOEPBSpO	\N	22	2018-08-06 13:28:52	2018-08-16 08:40:36
212	Larissa De Oliveira Fortunato De Moraes	larissa.moraes	larissa.moraes@embraport.net	$2y$10$YOBz2j/ENBfxgBDl.jrdR.Y/Wp2Wyhq3CxNqnfIJBduESqTEARik.	\N	22	2018-08-06 13:28:53	2018-08-16 08:40:36
224	Mario Bueno da Silva Junior	mario.junior	mario.junior@embraport.net	$2y$10$pX4gOPmrUiBETgHppYFj7eTeUtWCg2sQ8L5oA0sZD.4VcfyLwT4We	\N	22	2018-08-06 13:28:54	2018-08-16 08:40:36
234	Marcos Roberto De Andrade	marcos.andrade	marcos.andrade@embraport.com	$2y$10$bKd5RQYl/e1QeXfslo3CH.rsqqBiUaROi089mVmpW4Uqn29xDsMoO	\N	22	2018-08-06 13:28:55	2018-08-16 08:40:36
258	Maira Felícia Dantas Pereira da Silva	maira.silva	maira.silva@embraport.com	$2y$10$jE.vi3sjO4XSh5XbAxiN6.sdKgPDgbR37EVj.Lxp.yZYu7yKVkcfa	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:36
268	Luiz Gustavo Agria Dos Santos	luiz.agria	luiz.agria@embraport.net	$2y$10$gs5s3MB7e8/mkT0HdpQSPONABsWxx9Gi3pV2K.kt/lJyw9LNjrwcO	\N	22	2018-08-06 13:28:57	2018-08-16 08:40:36
277	Marcio Guilherme Santos da Silva	marcio.santos	marcio.santos@embraport.net	$2y$10$JvcmyumehAJBTy4LfPDBAeNCi/KHDmh9koFXMan7ghlJsY2PeTXDi	\N	22	2018-08-06 13:28:58	2018-08-16 08:40:36
298	Tiago Cavalcante De Medeiros	tiago.medeiros	tiago.medeiros@embraport.com	$2y$10$CWxLFO2Cpcz9KADWZBv4iejIi7.PwYbP0EA85RzR0woqKuAulMWPC	\N	22	2018-08-06 13:28:59	2018-08-16 08:40:36
312	Thiago Soares Aveiro Rodrigues	trodrigues	trodrigues@embraport.net	$2y$10$TZNb/n.oOq5vW.jlVakTc.YkAr3f6SZn8E01KE8wt9rAENZ3pX/Zq	\N	22	2018-08-06 13:29:00	2018-08-16 08:40:36
326	Thamires do Nascimento Santos	tnsantos	tnsantos@embraport.net	$2y$10$dYIUXH96mR8mdKC6jUE3ZuYo88RhJre8VoCJH/NTijocroyXdWxqa	\N	22	2018-08-06 13:29:01	2018-08-16 08:40:36
355	Teste da Silva	teste.silva	teste.silva@embraport.net	$2y$10$ar10BetvFEkZLBrTd5.DQeNIXNPRSe6JWRQdtu8jHNpkeUE7Z4/ya	\N	22	2018-08-06 13:29:03	2018-08-16 08:40:36
32	Natalia Perez Broadbent Hoyer	nhoyer	nhoyer@embraport.com	$2y$10$5Y2xEsAFNa3pD4berZYfWuibs6.ulADrpVzmeNdgcQPE/C4Xo1Rdq	\N	1	2018-08-06 13:28:40	2018-08-16 08:41:45
690	Celise Salgado Zilli	czilli	czilli@embraport.com	$2y$10$x8/ItXRypmGJGW2IOW6dKOQcpwnBBfSj8x.RbDKCka0Yhs2E5Amu.	KTOG99SRGI6EViOdhE2lnNj50Lbc4rg7npua3GfE3tiduGOoaxLNecyG9RrS	1	2018-08-06 13:29:27	2018-08-16 08:41:45
581	Jorge Pires de Camargo	jpcamargo	jpcamargo@embraport.com	$2y$10$DuQncdK3Tz8AqVJKZ4l8buPewbT6LwL5YlksgsKMGnyAIO/sKqXGK	\N	6	2018-08-06 13:29:20	2018-08-14 14:22:37
1027	Edgard Antonio Moreira de Mattos	edgardmattos	edgardmattos@embraport.net	$2y$10$7dppP9DOpfi2LpLD7LWG9uPL139dHF6HMHv00K90rzINr5OSSAo2C	\N	11	2018-08-06 13:29:51	2018-08-14 14:43:48
357	Teste noreply	teste.noreply	teste.noreply@embraport.net	$2y$10$iOxMdj07.fkiOiacyPN3t.84ztzDmvtLCEyqS.ROTY339QhD4FKo6	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:36
388	Wellington Tuler Moraes	wtuler	wtuler@embraport.com	$2y$10$3waEr2Nodry1kwX5XutwGOcwZHtUqs/tBJAM8qaMgy2jqA.vjqLVq	\N	22	2018-08-06 13:29:06	2018-08-16 08:40:36
402	Varonis POC	varonis_poc	varonis_poc@embraport.net	$2y$10$IurUPd2XE2EbixoI.FaGk.qA0t6jldJfPcgvU9NuBJvHDEtIJQbeu	\N	22	2018-08-06 13:29:07	2018-08-16 08:40:36
418	Sala Vicente de Carvalho	vicentedecarvalho	vicentedecarvalho@embraport.com	$2y$10$Z6RXbNiLut4Yt9r/O.WY0eyzcoEAdpmut9wZEWB0KKYmbv8oZ033i	\N	22	2018-08-06 13:29:08	2018-08-16 08:40:36
445	Roberto Ferreira de Souza	rfsouza	rfsouza@embraport.com	$2y$10$9eM.zwQ8aCmWCysW8K9F9O.15W.xXWCi70r9e89yfC20klTokq53C	\N	22	2018-08-06 13:29:10	2018-08-16 08:40:36
460	Roberto Lopes Trimmel	roberto.trimmel	roberto.trimmel@embraport.com	$2y$10$RR2ZFhAlMvf3puEgxZoXROZbSuN4/m6j2XFaUrXkU1978CXBTysIG	\N	22	2018-08-06 13:29:11	2018-08-16 08:40:36
483	Raphael Nunes Machado	raphael.machado	raphael.machado@embraport.net	$2y$10$H2asytfDIzuq82DA/7lMieqlYiAIu.SXxygr052i78YpBfGAB74dO	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:36
490	Raphael Alves Fondello	raphael.fondello	raphael.fondello@embraport.com	$2y$10$NjBHlHZwwYWyM05gCJSO1uj/ZZmAFvodBj2UCzwpbdfXc3H4GjvJy	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:36
491	Raphael dos Santos Moraes	raphael.moraes	raphael.moraes@embraport.com	$2y$10$/jIXvemfnGaEBVdqJkSIRep3zsshgubmlJM49k11T7acB6hxmsUF2	\N	22	2018-08-06 13:29:13	2018-08-16 08:40:36
536	snowpdq	snowpdq	snowpdq@embraport.net	$2y$10$Db8CRbKOyXQhnGxx8v874u0wPL49C05M8pg8Fggf7MmTepp6qzjIW	\N	22	2018-08-06 13:29:16	2018-08-16 08:40:36
544	Samuel Henrique Batista Lopes	samuel.lopes	samuel.lopes@embraport.com	$2y$10$7vgjmOL21U7mDKU5HPcpVOXwUfP9nK.UKQpeYQQUWKRXN.PDrp0XO	\N	22	2018-08-06 13:29:17	2018-08-16 08:40:36
569	Rubian Nascimento De Castro	rubian.castro	rubian.castro@embraport.net	$2y$10$GpeZsw9fgLkpPoRNZHyCr.DJxTJSsLY/Hs3HUt133nNnLbtA6XyjK	\N	22	2018-08-06 13:29:19	2018-08-16 08:40:36
585	Carlos Bombardelli	carlosbombardelli	carlosbombardelli@embraport.net	$2y$10$cIkFZLPIdaQIAguiaFUNluZCQEAPWUy1RO0ewK/Qm1MRFrq/87xCa	\N	22	2018-08-06 13:29:20	2018-08-16 08:40:36
927	George Alam Freitas Oliveira	georgeoliveira	georgeoliveira@embraport.net	$2y$10$t3HWD.NLo3ZNlKa8r5UxQeQBws7EvDu44kSmK7fLMC8Yf8SqYoHtm	\N	15	2018-08-06 13:29:44	2018-08-28 12:19:33
625	Bianca Rodrigues	bianca.rodrigues	bianca.rodrigues@embraport.com	$2y$10$7QD6NYr9Jb8dlLslLMM31u5Gek5OMcElM3SbhJJesa.MTce4pv7TS	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:36
632	Fernando Henrique Siqueira Palma	beecorp.fernando	beecorp.fernando@embraport.com	$2y$10$LZqmQHK.bOOmgGmQQH2lY.Iwue4kBeKY.qKsXFv34FkYPkRJvmEU.	\N	22	2018-08-06 13:29:23	2018-08-16 08:40:36
658	Darlan Pascoal Marques	darlan.marques	darlan.marques@embraport.net	$2y$10$umr/w4PhDG8K60hlbkIjg.Ts4pfqfRMnNRVmR86uprh9fyUxLWSnu	\N	22	2018-08-06 13:29:25	2018-08-16 08:40:36
677	Devanice da Silva Fernandes	devanice.fernandes	devanice.fernandes@embraport.net	$2y$10$tRVuhX0XkGKLqCE6CUvBV.4pHkkllM7oJ9TqQV.9cJtSeHqofvggu	\N	22	2018-08-06 13:29:26	2018-08-16 08:40:36
704	Christian Fernandes	christianernandes	christianfernandes@embraport.net	$2y$10$NBwIZ15S/fXC8KxWhjovPOlCjv4WjXU3teRFiRNUzW8RF8hdetVO2	\N	22	2018-08-06 13:29:28	2018-08-16 08:40:36
715	Cristiano Correia Ferreira	cristiano.correia	cristiano.correia@embraport.com	$2y$10$.f8zEg2WEZxA0BJUsidNNuJl0eUEfRZVXgdW.To56hwMtFNAHDiZO	\N	22	2018-08-06 13:29:29	2018-08-16 08:40:36
730	Adriano da Fonte Fernando	affernando	affernando@embraport.com	$2y$10$B8ZMwaAyiRGNXmYz4Aq4v.01iHnFLxuTbZBfISkvRJtVkmIJDmIhq	\N	22	2018-08-06 13:29:30	2018-08-16 08:40:36
755	Aguinaldo Soares Leite Filho	aguinaldo.filho	aguinaldo.filho@embraport.net	$2y$10$YzgWyqoPcu7zIKRp.9n/6exXOklfBLGZkVusKBIqw2yEuqwDVaUZa	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:36
759	Aislan Antonio De Laia Costa	aislan.costa	aislan.costa@embraport.com	$2y$10$TKz982DrHppcWcG2xt7X4OQh/d7FSrDWVtF021qIqZ8zUp.0J8ePG	\N	22	2018-08-06 13:29:32	2018-08-16 08:40:36
776	Adeval Bispo do Santos	abispo	abispo@embraport.com	$2y$10$CrGZtgfVd1pp6M/vi8e7GucId.2WK.d14Hxp2K/0/zfa/rai3.JhC	\N	22	2018-08-06 13:29:34	2018-08-16 08:40:36
796	adm-douglassantos	adm-douglassantos	adm-douglassantos@embraport.net	$2y$10$VjZggZUo1D.4MrkguKQGAuZ8HgPLjQvXctcl2iwIdqXOMtn.it0T6	\N	22	2018-08-06 13:29:35	2018-08-16 08:40:36
809	Alexandre Pereira Sales	apsales	apsales@embraport.net	$2y$10$dRUJC6tXju5tgcz81wrElugn.p3g9VLM44eFvNmgQh1L8I8jcFVIu	\N	22	2018-08-06 13:29:36	2018-08-16 08:40:36
832	Andre Silva de Mendonça	asmendonca	asmendonca@embraport.com	$2y$10$I2fJn6Y0pcPvIv2hwx2NUuWdtvGrB3lV1fKW7hC7JxOtPXQkt7ENK	\N	22	2018-08-06 13:29:38	2018-08-16 08:40:36
849	Aline Fonseca Santos	alinesantos	alinesantos@embraport.com	$2y$10$qCGEwAYLuerZlJ3X/SvAGOFEgZfttrywnP6sPvdK/YRL41qH/hMKy	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:36
857	Andre Luis da Silva	andreluiss	andreluiss@embraport.net	$2y$10$C2no6v2OWdun94vYz6mDs.Z/P3lt2MJXPF5B5d9Cd6PiaxHpCtATG	\N	22	2018-08-06 13:29:39	2018-08-16 08:40:36
879	GSN Intranet User	gsn-intra	gsn-intra@embraport.net	$2y$10$65NBfkYtM6QeMxQMfuz9v.S5mPDyxvJ8FqnNKKCHRjXEcTogO/z46	\N	22	2018-08-06 13:29:41	2018-08-16 08:40:36
894	Homologação Sistemas	homologacao	homologacao@embraport.net	$2y$10$5ZKOpACZam2joTrrY9Ee4upM1rzDCkMo5TF2j35kctf3j6wIuVtkW	\N	22	2018-08-06 13:29:42	2018-08-16 08:40:36
903	Haroldo Junior dos Reis Oliveira	haroldo.oliveira	haroldo.oliveira@embraport.net	$2y$10$ySsN3ndr.ConNcKkesG1B.bHN.ZmEBOuCneCd.dXpaCtDMFTghEZK	\N	22	2018-08-06 13:29:43	2018-08-16 08:40:36
804	Alberto Robinson	arobinson	arobinson@embraport.com	$2y$10$YOL25aHuVeSBauF5BZkTFuNjFi7is0pTUhyTmDx/DwH6hLulTC38.	\N	23	2018-08-06 13:29:36	2018-08-28 17:00:35
949	Joao Paulo Santos de Andrade	joaoandrade	joaoandrade@embraport.com	$2y$10$9g3LUBL9OI7DmUz7ZlQhq./yaQViU7DFle/h8gVLHMIlmakpZy05.	\N	22	2018-08-06 13:29:46	2018-08-16 08:40:36
971	Jose Batista Da Silva	jose.batista	jose.batista@embraport.net	$2y$10$H.4Yq2cXRvM2kN8XqAhSreTj4EH3ldJNlYZlpkNHdR8/8qkjzUqrO	\N	22	2018-08-06 13:29:47	2018-08-16 08:40:36
981	Jerônimo Perez Domingues	jeronimoperez	jeronimoperez@embraport.net	$2y$10$cqUsRYJdflfFUedjAlikDuO0CUVHsAPT19esb5shs905OMLt6cqg2	\N	22	2018-08-06 13:29:48	2018-08-16 08:40:36
990	Informacoes Aduaneiras	informacoesaduaneira	informacoesaduaneiras@embraport.com	$2y$10$d8gjJFH1xzuCjUJL.cNvx.9PzcjCwzCJpPIbcFC213M5UPa6M/vbq	\N	22	2018-08-06 13:29:49	2018-08-16 08:40:36
610	Caroline Pagotti Gouveia	carolinegouveia	carolinegouveia@embraport.com	$2y$10$ElPbBBy.ziW6904r/DSH8.kYXRCGyxkOHqa8eCXdgPWj7ea.x0EwC	\N	15	2018-08-06 13:29:22	2018-08-28 12:19:33
514	Sergio Bravo Ramos Junior	sergio.junior	sergio.junior@embraport.com	$2y$10$yx5wdIllkktMo9KIw1rk8OKxBRZG51PMwaBcJSJAuAErHFHkTuFGy	\N	20	2018-08-06 13:29:15	2018-08-14 15:50:42
364	VALBER ADRIANO MARQUES NUNES	valber.nunes	valber.nunes@embraport.net	$2y$10$BdOLrxUs7KobikdshZ1i4OiXMDzrKrUaXWu.MBijCNrKl45eHQu0S	\N	22	2018-08-06 13:29:04	2018-08-16 08:40:36
1012	Janderson Apa Lima da Silva	janderson.silva	janderson.silva@embraport.net	$2y$10$zRF/6fefsrFZGrn6fJAGauyh2KCII1/MOm5vVYd5sPBUdr0mNd/ZS	\N	22	2018-08-06 13:29:50	2018-08-16 08:40:36
1043	Embraportonline Faturamento	embfat	embfat@embraport.net	$2y$10$Ix5Czmg2WsGLfCvYULNCheUpxP4o99WME9GPdPdMb.5d8TlFa7P0K	\N	22	2018-08-06 13:29:53	2018-08-16 08:40:36
1057	DiscoverySearchMailbox {D919BA05-46A6-415f-80AD-7E09334BB852}	SM_e76f07cf5fb64c828	DiscoverySearchMailbox {D919BA05-46A6-415f-80AD-7E09334BB852}@embraport.net	$2y$10$Qzw96EaOxF7iNiSCI5UhAuiE1e0s7HghDYieWLuK7HXWt6.dfsMnC	\N	22	2018-08-06 13:29:54	2018-08-16 08:40:36
1165	Leandro Batista dos Santos	leandro.santos	leandro.santos@dpworld.com	$2y$10$c0K9zvpTsr1t2c9qM7P6KOD3vvn7/Rnaq1.YWAXQPtv1Wm8Eka4de	\N	\N	2018-08-29 11:49:16	2018-08-29 11:49:16
1167	Karoline da Costa Lage	karoline.lage	karoline.lage@embraport.com	$2y$10$GDY6HaXYqhD0BoTZ.1KFyODdL8WWmkjXJ7jchaJgrqfoyGjSRz8M6	\N	\N	2018-08-29 11:49:17	2018-08-29 11:49:17
1168	Carta Protesto	cartaprotesto	cartaprotesto@embraport.com	$2y$10$bb4F7McHTdTHRO7FLODneeY4a0jv7N5GM9DUek4Og3pf8d7XPCDMi	\N	\N	2018-08-29 11:49:17	2018-08-29 11:49:17
1169	Fernando Yokoi Rodrigues	build.fernando	build.fernando@embraport.net	$2y$10$N/vQGEV8mVxrDE4n5jUks.uX4aD3c2URbFrd3/oXbhJQbkIDItGyi	\N	\N	2018-08-29 11:49:17	2018-08-29 11:49:17
1170	Gobi	gobi_dpw	gobi_dpw@embraport.net	$2y$10$jCt0H92gYuqV7xG4FOgFXeFCc7zySsPzEZTzZUf/QUnkUCPPKm23O	\N	\N	2018-08-29 11:49:18	2018-08-29 11:49:18
1172	Joao Carlos Alves Teixeira	joao.teixeira	joao.teixeira@embraport.net	$2y$10$EvBWUKAed1Z/zOiq4bVcke4t8mgCYG/ORjS2vRh.T8pLIDsUfqRv2	\N	\N	2018-08-29 11:49:18	2018-08-29 11:49:18
1173	Edson de Souza Ramos	edson.ramos	edson.ramos@embraport.com	$2y$10$Ih8tyLsLN69uPrlxTI8LieB8Y4FpW1e4mtPVcm6UWR8Dymvpke0aa	\N	\N	2018-08-29 11:49:18	2018-08-29 11:49:18
1171	Hellen Karina de Abreu	hellen.abreu	hellen.abreu@embraport.net	$2y$10$TuXQyDPhpYqVDV9Xnu1ia.V6sGgKJpMADR7CF3MPMIq2v.4t86F6a	\N	14	2018-08-29 11:49:18	2018-08-30 08:22:57
519	Samuel Fernandez de Barros	sbarros	sbarros@embraport.com	$2y$10$oMXlAjpuKb27czwtcdE.4ePyCdVkdinKeb5Qzicmu1kEevx4a0lL2	bWwOYUBwvnEctZOA7ErPHN43sF3VfGkvZSWVd1GGtvKAeoEOqo5xTqu38FQF	14	2018-08-06 13:29:15	2018-08-28 12:05:43
1166	Hellen Karina de Abreu	karina.abreu	karina.abreu@embraport.com	$2y$10$.HqxwfDfuSIX8Xh5kiePkOAqHE/ZDkzGPUNmVl5kqCZEcMsdvxABi	1eYHyQcDwdFMj3SRmAbxWqxsrL6g8giU8kO7PKQliYQbXQEOT4qMoH7dsdmc	14	2018-08-29 11:49:17	2018-08-30 08:22:57
851	Aline Soares	aline.soares	aline.soares@embraport.net	$2y$10$ep4Z0s1JKg.2C33jViU0aeQ3kJkd2vN34LqgwXTU64gO87864cezW	2G9igbnO9vjicq99Y5iKrYzwHycTC2ojpWfrYvJIrXWmPCLjorGL5Zsgbo9z	7	2018-08-06 13:29:39	2018-08-14 14:32:44
1134	Erica Gabriela Silva	esilva	esilva@embraport.com	$2y$10$O0L3ooPMnsc3ctU.g5sNauKi7PfbtDrX/I/.unRIuy5ysyn21Bgtu	z6oLsAluNRj8GdPCNq6PtREp2FLEs6kFHzwwGGjdaYphMzu2fVD5xf1bkXjV	13	2018-08-06 13:29:59	2018-08-14 15:43:49
772	Anderson Cardoso dos Santos	acardoso	acardoso@embraport.com	$2y$10$YG22ZsoNkGRnCxGWmUGBLuj.aDzPuoVsUp1tLMi4El67BVwSyjKGO	qRmGGctATaD1RyJM3M5gsF1uzMy9dn6VfNBVgRbEZpt0IfICpKEbV6DNgnq7	22	2018-08-06 13:29:33	2018-08-16 08:40:35
817	Alesandra Josefa Rocha Silva	arsilva	arsilva@embraport.com	$2y$10$zTbfFtiQ7XxEMA5Z1f2OF.zFSguwhXI43.gQInwNPcBCW/ZN2kxh.	1W5kyaEtloADYl801Xn1EuWssHRw5j4SdOqYH1kSc1VucZEJT13Q5CtxrHER	8	2018-08-06 13:29:36	2018-08-28 08:41:43
17	Mariana Andrade Spyer Lisboa	mspyer	mspyer@embraport.com	$2y$10$IeGvmpT1G3xquwJmy7ZfPO8hvV.kswr9w0jN1gT4YBcyEz0zIhGcC	dXhuVmY7KQDZUN5cLUjXnGD0xNEIPqT3vxT72t4yS4spnTA1yOLNEx3VGih4	22	2018-08-06 13:28:39	2018-08-16 08:40:34
934	Giovanna Machado dos Santos	giovanna.santos	giovanna.santos@embraport.com	$2y$10$YHoq4vBg8K0fLvTnfyMaVuDg61fP4NTZSIYF9ajfcjLqPTs63rWpm	i2S38JNuEwaiXCHGZDUMwA6eEY64cv7CkfruweLo1Kq2Zt2m0J6AjuAFzO1B	10	2018-08-06 13:29:45	2018-08-28 09:18:00
600	Carolina de Alencar Siqueira	carolina.siqueira	carolina.siqueira@embraport.com	$2y$10$L5WyPtppaSpwRkX7qKfnVum/uFBebxAH5VNU6PtyiscElfeyNy8l6	ixD5zFGOHkdZzlhVR7pGZP2ZdB5syZUoMq5pJI6eDqOGXmCY8Y78dvngUgYv	19	2018-08-06 13:29:21	2018-08-28 14:45:24
1073	Dominique Natália Osti	dominique.osti	dominique.osti@embraport.net	$2y$10$E.Ykym5hQqja6pst3RlQp.OOotO5SlE3NyvLz7hfJ.LCke3GRjUfy	foEvGKTdNCk0RkElGWj7o9EI04OdYO27ZJ3m9h7JOFFAvvWu5exSgtxXCIYi	16	2018-08-06 13:29:55	2018-08-28 11:32:38
662	Danilo Mendonça de Lima	danilolima	danilolima@embraport.com	$2y$10$GZErmZFUz5HmESCqQQ1uFe2B2Sz4biJ6SkdaJccEO9zaAE0q9s02q	XfbgYM1CciOINWpGS0sF1OBGS7URDao5PETVY0yiO13lytnPHLtvJTLCBzBa	22	2018-08-06 13:29:25	2018-08-16 08:40:35
1	Speed	speedsoft	speedsoft@embraport.net	$2y$10$7KsdITYsR45O4WVja0FLc.NlO.7t.c4NeYlhfX6yPfobq8NYO0jGu	2q9cvYSww6RbIYhYIIkV5vaXbdO963qWXU1u2iVRU82D8hR1AaVQlucFmbck	1	2018-08-06 13:28:02	2018-08-28 08:04:29
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1173, true);


--
-- Data for Name: workflow; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workflow (id, etapa_num, etapa, descricao, justificativa, documento_id, created_at, updated_at) FROM stdin;
81	7		Documento Importado Rotina Speed		81	2018-09-01 02:25:31	2018-09-01 02:25:31
82	7		Documento Importado Rotina Speed		82	2018-09-01 02:27:31	2018-09-01 02:27:31
83	7		Documento Importado Rotina Speed		83	2018-09-01 02:27:31	2018-09-01 02:27:31
84	7		Documento Importado Rotina Speed		84	2018-09-01 02:27:31	2018-09-01 02:27:31
85	7		Documento Importado Rotina Speed		85	2018-09-01 02:27:31	2018-09-01 02:27:31
86	7		Documento Importado Rotina Speed		86	2018-09-01 02:27:31	2018-09-01 02:27:31
87	7		Documento Importado Rotina Speed		87	2018-09-01 02:27:31	2018-09-01 02:27:31
88	7		Documento Importado Rotina Speed		88	2018-09-01 02:27:31	2018-09-01 02:27:31
89	7		Documento Importado Rotina Speed		89	2018-09-01 02:27:31	2018-09-01 02:27:31
90	7		Documento Importado Rotina Speed		90	2018-09-01 02:27:31	2018-09-01 02:27:31
91	7		Documento Importado Rotina Speed		91	2018-09-01 02:27:32	2018-09-01 02:27:32
92	7		Documento Importado Rotina Speed		92	2018-09-01 02:27:32	2018-09-01 02:27:32
93	7		Documento Importado Rotina Speed		93	2018-09-01 02:27:32	2018-09-01 02:27:32
94	7		Documento Importado Rotina Speed		94	2018-09-01 02:27:32	2018-09-01 02:27:32
95	7		Documento Importado Rotina Speed		95	2018-09-01 02:27:32	2018-09-01 02:27:32
96	7		Documento Importado Rotina Speed		96	2018-09-01 02:27:32	2018-09-01 02:27:32
97	7		Documento Importado Rotina Speed		97	2018-09-01 02:27:32	2018-09-01 02:27:32
98	7		Documento Importado Rotina Speed		98	2018-09-01 02:27:32	2018-09-01 02:27:32
99	7		Documento Importado Rotina Speed		99	2018-09-01 02:27:32	2018-09-01 02:27:32
100	7		Documento Importado Rotina Speed		100	2018-09-01 02:27:32	2018-09-01 02:27:32
101	7		Documento Importado Rotina Speed		101	2018-09-01 02:27:33	2018-09-01 02:27:33
102	7		Documento Importado Rotina Speed		102	2018-09-01 02:27:33	2018-09-01 02:27:33
103	7		Documento Importado Rotina Speed		103	2018-09-01 02:27:33	2018-09-01 02:27:33
104	7		Documento Importado Rotina Speed		104	2018-09-01 02:27:33	2018-09-01 02:27:33
105	7		Documento Importado Rotina Speed		105	2018-09-01 02:27:33	2018-09-01 02:27:33
106	7		Documento Importado Rotina Speed		106	2018-09-01 02:27:33	2018-09-01 02:27:33
107	7		Documento Importado Rotina Speed		107	2018-09-01 02:27:33	2018-09-01 02:27:33
108	7		Documento Importado Rotina Speed		108	2018-09-01 02:27:33	2018-09-01 02:27:33
109	7		Documento Importado Rotina Speed		109	2018-09-01 02:27:33	2018-09-01 02:27:33
110	7		Documento Importado Rotina Speed		110	2018-09-01 02:27:33	2018-09-01 02:27:33
111	7		Documento Importado Rotina Speed		111	2018-09-01 02:27:33	2018-09-01 02:27:33
112	7		Documento Importado Rotina Speed		112	2018-09-01 02:27:34	2018-09-01 02:27:34
113	7		Documento Importado Rotina Speed		113	2018-09-01 02:27:34	2018-09-01 02:27:34
114	7		Documento Importado Rotina Speed		114	2018-09-01 02:27:34	2018-09-01 02:27:34
115	7		Documento Importado Rotina Speed		115	2018-09-01 02:27:34	2018-09-01 02:27:34
116	7		Documento Importado Rotina Speed		116	2018-09-01 02:27:34	2018-09-01 02:27:34
117	7		Documento Importado Rotina Speed		117	2018-09-01 02:27:34	2018-09-01 02:27:34
118	7		Documento Importado Rotina Speed		118	2018-09-01 02:27:34	2018-09-01 02:27:34
119	7		Documento Importado Rotina Speed		119	2018-09-01 02:27:34	2018-09-01 02:27:34
120	7		Documento Importado Rotina Speed		120	2018-09-01 02:27:34	2018-09-01 02:27:34
121	7		Documento Importado Rotina Speed		121	2018-09-01 02:27:34	2018-09-01 02:27:34
122	7		Documento Importado Rotina Speed		122	2018-09-01 02:27:34	2018-09-01 02:27:34
123	7		Documento Importado Rotina Speed		123	2018-09-01 02:27:34	2018-09-01 02:27:34
124	7		Documento Importado Rotina Speed		124	2018-09-01 02:27:35	2018-09-01 02:27:35
125	7		Documento Importado Rotina Speed		125	2018-09-01 02:27:35	2018-09-01 02:27:35
126	7		Documento Importado Rotina Speed		126	2018-09-01 02:27:35	2018-09-01 02:27:35
127	7		Documento Importado Rotina Speed		127	2018-09-01 02:27:35	2018-09-01 02:27:35
128	7		Documento Importado Rotina Speed		128	2018-09-01 02:27:35	2018-09-01 02:27:35
129	7		Documento Importado Rotina Speed		129	2018-09-01 02:27:35	2018-09-01 02:27:35
130	7		Documento Importado Rotina Speed		130	2018-09-01 02:27:35	2018-09-01 02:27:35
131	7		Documento Importado Rotina Speed		131	2018-09-01 02:27:35	2018-09-01 02:27:35
132	7		Documento Importado Rotina Speed		132	2018-09-01 02:27:35	2018-09-01 02:27:35
133	7		Documento Importado Rotina Speed		133	2018-09-01 02:27:35	2018-09-01 02:27:35
134	7		Documento Importado Rotina Speed		134	2018-09-01 02:27:35	2018-09-01 02:27:35
135	7		Documento Importado Rotina Speed		135	2018-09-01 02:27:36	2018-09-01 02:27:36
136	7		Documento Importado Rotina Speed		136	2018-09-01 02:27:36	2018-09-01 02:27:36
137	7		Documento Importado Rotina Speed		137	2018-09-01 02:27:36	2018-09-01 02:27:36
138	7		Documento Importado Rotina Speed		138	2018-09-01 02:27:36	2018-09-01 02:27:36
139	7		Documento Importado Rotina Speed		139	2018-09-01 02:27:36	2018-09-01 02:27:36
140	7		Documento Importado Rotina Speed		140	2018-09-01 02:27:36	2018-09-01 02:27:36
141	7		Documento Importado Rotina Speed		141	2018-09-01 02:27:36	2018-09-01 02:27:36
142	7		Documento Importado Rotina Speed		142	2018-09-01 02:27:36	2018-09-01 02:27:36
143	7		Documento Importado Rotina Speed		143	2018-09-01 02:27:36	2018-09-01 02:27:36
144	7		Documento Importado Rotina Speed		144	2018-09-01 02:27:37	2018-09-01 02:27:37
145	7		Documento Importado Rotina Speed		145	2018-09-01 02:27:37	2018-09-01 02:27:37
146	7		Documento Importado Rotina Speed		146	2018-09-01 02:27:37	2018-09-01 02:27:37
147	7		Documento Importado Rotina Speed		147	2018-09-01 02:27:37	2018-09-01 02:27:37
148	7		Documento Importado Rotina Speed		148	2018-09-01 02:27:37	2018-09-01 02:27:37
149	7		Documento Importado Rotina Speed		149	2018-09-01 02:27:37	2018-09-01 02:27:37
150	7		Documento Importado Rotina Speed		150	2018-09-01 02:27:37	2018-09-01 02:27:37
151	7		Documento Importado Rotina Speed		151	2018-09-01 02:27:37	2018-09-01 02:27:37
152	7		Documento Importado Rotina Speed		152	2018-09-01 02:27:37	2018-09-01 02:27:37
153	7		Documento Importado Rotina Speed		153	2018-09-01 02:27:37	2018-09-01 02:27:37
154	7		Documento Importado Rotina Speed		154	2018-09-01 02:27:37	2018-09-01 02:27:37
155	7		Documento Importado Rotina Speed		155	2018-09-01 02:27:38	2018-09-01 02:27:38
156	7		Documento Importado Rotina Speed		156	2018-09-01 02:27:38	2018-09-01 02:27:38
157	7		Documento Importado Rotina Speed		157	2018-09-01 02:27:38	2018-09-01 02:27:38
158	7		Documento Importado Rotina Speed		158	2018-09-01 02:27:38	2018-09-01 02:27:38
159	7		Documento Importado Rotina Speed		159	2018-09-01 02:27:38	2018-09-01 02:27:38
160	7		Documento Importado Rotina Speed		160	2018-09-01 02:27:38	2018-09-01 02:27:38
161	7		Documento Importado Rotina Speed		161	2018-09-01 02:27:38	2018-09-01 02:27:38
162	7		Documento Importado Rotina Speed		162	2018-09-01 02:27:38	2018-09-01 02:27:38
163	7		Documento Importado Rotina Speed		163	2018-09-01 02:27:38	2018-09-01 02:27:38
164	7		Documento Importado Rotina Speed		164	2018-09-01 02:27:38	2018-09-01 02:27:38
165	7		Documento Importado Rotina Speed		165	2018-09-01 02:27:38	2018-09-01 02:27:38
166	7		Documento Importado Rotina Speed		166	2018-09-01 02:27:39	2018-09-01 02:27:39
167	7		Documento Importado Rotina Speed		167	2018-09-01 02:27:39	2018-09-01 02:27:39
168	7		Documento Importado Rotina Speed		168	2018-09-01 02:27:39	2018-09-01 02:27:39
169	7		Documento Importado Rotina Speed		169	2018-09-01 02:27:39	2018-09-01 02:27:39
170	7		Documento Importado Rotina Speed		170	2018-09-01 02:27:39	2018-09-01 02:27:39
171	7		Documento Importado Rotina Speed		171	2018-09-01 02:27:39	2018-09-01 02:27:39
172	7		Documento Importado Rotina Speed		172	2018-09-01 02:27:39	2018-09-01 02:27:39
173	7		Documento Importado Rotina Speed		173	2018-09-01 02:27:39	2018-09-01 02:27:39
174	7		Documento Importado Rotina Speed		174	2018-09-01 02:27:39	2018-09-01 02:27:39
175	7		Documento Importado Rotina Speed		175	2018-09-01 02:27:39	2018-09-01 02:27:39
176	7		Documento Importado Rotina Speed		176	2018-09-01 02:27:39	2018-09-01 02:27:39
177	7		Documento Importado Rotina Speed		177	2018-09-01 02:27:39	2018-09-01 02:27:39
178	7		Documento Importado Rotina Speed		178	2018-09-01 02:27:39	2018-09-01 02:27:39
179	7		Documento Importado Rotina Speed		179	2018-09-01 02:27:39	2018-09-01 02:27:39
180	7		Documento Importado Rotina Speed		180	2018-09-01 02:27:40	2018-09-01 02:27:40
181	7		Documento Importado Rotina Speed		181	2018-09-01 02:27:40	2018-09-01 02:27:40
182	7		Documento Importado Rotina Speed		182	2018-09-01 02:27:40	2018-09-01 02:27:40
183	7		Documento Importado Rotina Speed		183	2018-09-01 02:27:40	2018-09-01 02:27:40
184	7		Documento Importado Rotina Speed		184	2018-09-01 02:27:40	2018-09-01 02:27:40
185	7		Documento Importado Rotina Speed		185	2018-09-01 02:27:40	2018-09-01 02:27:40
186	7		Documento Importado Rotina Speed		186	2018-09-01 02:27:40	2018-09-01 02:27:40
187	7		Documento Importado Rotina Speed		187	2018-09-01 02:27:40	2018-09-01 02:27:40
188	7		Documento Importado Rotina Speed		188	2018-09-01 02:27:40	2018-09-01 02:27:40
189	7		Documento Importado Rotina Speed		189	2018-09-01 02:27:40	2018-09-01 02:27:40
190	7		Documento Importado Rotina Speed		190	2018-09-01 02:27:40	2018-09-01 02:27:40
191	7		Documento Importado Rotina Speed		191	2018-09-01 02:27:40	2018-09-01 02:27:40
192	7		Documento Importado Rotina Speed		192	2018-09-01 02:27:40	2018-09-01 02:27:40
193	7		Documento Importado Rotina Speed		193	2018-09-01 02:27:41	2018-09-01 02:27:41
194	7		Documento Importado Rotina Speed		194	2018-09-01 02:27:41	2018-09-01 02:27:41
195	7		Documento Importado Rotina Speed		195	2018-09-01 02:27:41	2018-09-01 02:27:41
196	7		Documento Importado Rotina Speed		196	2018-09-01 02:27:41	2018-09-01 02:27:41
197	7		Documento Importado Rotina Speed		197	2018-09-01 02:27:41	2018-09-01 02:27:41
198	7		Documento Importado Rotina Speed		198	2018-09-01 02:27:41	2018-09-01 02:27:41
199	7		Documento Importado Rotina Speed		199	2018-09-01 02:27:41	2018-09-01 02:27:41
200	7		Documento Importado Rotina Speed		200	2018-09-01 02:27:41	2018-09-01 02:27:41
201	7		Documento Importado Rotina Speed		201	2018-09-01 02:27:41	2018-09-01 02:27:41
202	7		Documento Importado Rotina Speed		202	2018-09-01 02:27:41	2018-09-01 02:27:41
203	7		Documento Importado Rotina Speed		203	2018-09-01 02:27:41	2018-09-01 02:27:41
204	7		Documento Importado Rotina Speed		204	2018-09-01 02:27:42	2018-09-01 02:27:42
205	7		Documento Importado Rotina Speed		205	2018-09-01 02:27:42	2018-09-01 02:27:42
206	7		Documento Importado Rotina Speed		206	2018-09-01 02:27:42	2018-09-01 02:27:42
207	7		Documento Importado Rotina Speed		207	2018-09-01 02:27:42	2018-09-01 02:27:42
208	7		Documento Importado Rotina Speed		208	2018-09-01 02:27:42	2018-09-01 02:27:42
209	7		Documento Importado Rotina Speed		209	2018-09-01 02:27:42	2018-09-01 02:27:42
210	7		Documento Importado Rotina Speed		210	2018-09-01 02:27:42	2018-09-01 02:27:42
211	7		Documento Importado Rotina Speed		211	2018-09-01 02:27:42	2018-09-01 02:27:42
212	7		Documento Importado Rotina Speed		212	2018-09-01 02:27:42	2018-09-01 02:27:42
213	7		Documento Importado Rotina Speed		213	2018-09-01 02:27:42	2018-09-01 02:27:42
214	7		Documento Importado Rotina Speed		214	2018-09-01 02:27:42	2018-09-01 02:27:42
215	7		Documento Importado Rotina Speed		215	2018-09-01 02:27:43	2018-09-01 02:27:43
216	7		Documento Importado Rotina Speed		216	2018-09-01 02:27:43	2018-09-01 02:27:43
217	7		Documento Importado Rotina Speed		217	2018-09-01 02:27:43	2018-09-01 02:27:43
218	7		Documento Importado Rotina Speed		218	2018-09-01 02:27:43	2018-09-01 02:27:43
219	7		Documento Importado Rotina Speed		219	2018-09-01 02:27:43	2018-09-01 02:27:43
220	7		Documento Importado Rotina Speed		220	2018-09-01 02:27:43	2018-09-01 02:27:43
221	7		Documento Importado Rotina Speed		221	2018-09-01 02:27:43	2018-09-01 02:27:43
222	7		Documento Importado Rotina Speed		222	2018-09-01 02:27:43	2018-09-01 02:27:43
223	7		Documento Importado Rotina Speed		223	2018-09-01 02:27:43	2018-09-01 02:27:43
224	7		Documento Importado Rotina Speed		224	2018-09-01 02:27:43	2018-09-01 02:27:43
225	7		Documento Importado Rotina Speed		225	2018-09-01 02:27:43	2018-09-01 02:27:43
226	7		Documento Importado Rotina Speed		226	2018-09-01 02:27:43	2018-09-01 02:27:43
227	7		Documento Importado Rotina Speed		227	2018-09-01 02:27:44	2018-09-01 02:27:44
228	7		Documento Importado Rotina Speed		228	2018-09-01 02:27:44	2018-09-01 02:27:44
229	7		Documento Importado Rotina Speed		229	2018-09-01 02:27:44	2018-09-01 02:27:44
230	7		Documento Importado Rotina Speed		230	2018-09-01 02:27:44	2018-09-01 02:27:44
231	7		Documento Importado Rotina Speed		231	2018-09-01 02:27:44	2018-09-01 02:27:44
232	7		Documento Importado Rotina Speed		232	2018-09-01 02:27:44	2018-09-01 02:27:44
233	7		Documento Importado Rotina Speed		233	2018-09-01 02:27:44	2018-09-01 02:27:44
234	7		Documento Importado Rotina Speed		234	2018-09-01 02:27:44	2018-09-01 02:27:44
235	7		Documento Importado Rotina Speed		235	2018-09-01 02:27:44	2018-09-01 02:27:44
236	7		Documento Importado Rotina Speed		236	2018-09-01 02:27:44	2018-09-01 02:27:44
237	7		Documento Importado Rotina Speed		237	2018-09-01 02:27:45	2018-09-01 02:27:45
238	7		Documento Importado Rotina Speed		238	2018-09-01 02:27:45	2018-09-01 02:27:45
239	7		Documento Importado Rotina Speed		239	2018-09-01 02:27:45	2018-09-01 02:27:45
240	7		Documento Importado Rotina Speed		240	2018-09-01 02:27:45	2018-09-01 02:27:45
241	7		Documento Importado Rotina Speed		241	2018-09-01 02:27:45	2018-09-01 02:27:45
242	7		Documento Importado Rotina Speed		242	2018-09-01 02:27:45	2018-09-01 02:27:45
243	7		Documento Importado Rotina Speed		243	2018-09-01 02:27:45	2018-09-01 02:27:45
244	7		Documento Importado Rotina Speed		244	2018-09-01 02:27:45	2018-09-01 02:27:45
245	7		Documento Importado Rotina Speed		245	2018-09-01 02:27:45	2018-09-01 02:27:45
246	7		Documento Importado Rotina Speed		246	2018-09-01 02:27:45	2018-09-01 02:27:45
247	7		Documento Importado Rotina Speed		247	2018-09-01 02:27:46	2018-09-01 02:27:46
248	7		Documento Importado Rotina Speed		248	2018-09-01 02:27:46	2018-09-01 02:27:46
249	7		Documento Importado Rotina Speed		249	2018-09-01 02:27:46	2018-09-01 02:27:46
250	7		Documento Importado Rotina Speed		250	2018-09-01 02:27:46	2018-09-01 02:27:46
251	7		Documento Importado Rotina Speed		251	2018-09-01 02:27:46	2018-09-01 02:27:46
252	7		Documento Importado Rotina Speed		252	2018-09-01 02:27:46	2018-09-01 02:27:46
253	7		Documento Importado Rotina Speed		253	2018-09-01 02:27:46	2018-09-01 02:27:46
254	7		Documento Importado Rotina Speed		254	2018-09-01 02:27:47	2018-09-01 02:27:47
255	7		Documento Importado Rotina Speed		255	2018-09-01 02:27:47	2018-09-01 02:27:47
256	7		Documento Importado Rotina Speed		256	2018-09-01 02:27:47	2018-09-01 02:27:47
257	7		Documento Importado Rotina Speed		257	2018-09-01 02:27:47	2018-09-01 02:27:47
258	7		Documento Importado Rotina Speed		258	2018-09-01 02:27:47	2018-09-01 02:27:47
259	7		Documento Importado Rotina Speed		259	2018-09-01 02:27:47	2018-09-01 02:27:47
260	7		Documento Importado Rotina Speed		260	2018-09-01 02:27:47	2018-09-01 02:27:47
261	7		Documento Importado Rotina Speed		261	2018-09-01 02:27:48	2018-09-01 02:27:48
262	7		Documento Importado Rotina Speed		262	2018-09-01 02:27:48	2018-09-01 02:27:48
263	7		Documento Importado Rotina Speed		263	2018-09-01 02:27:48	2018-09-01 02:27:48
264	7		Documento Importado Rotina Speed		264	2018-09-01 02:27:48	2018-09-01 02:27:48
265	7		Documento Importado Rotina Speed		265	2018-09-01 02:27:49	2018-09-01 02:27:49
266	7		Documento Importado Rotina Speed		266	2018-09-01 02:27:49	2018-09-01 02:27:49
267	7		Documento Importado Rotina Speed		267	2018-09-01 02:27:49	2018-09-01 02:27:49
268	7		Documento Importado Rotina Speed		268	2018-09-01 02:27:49	2018-09-01 02:27:49
269	7		Documento Importado Rotina Speed		269	2018-09-01 02:27:49	2018-09-01 02:27:49
270	7		Documento Importado Rotina Speed		270	2018-09-01 02:27:49	2018-09-01 02:27:49
271	7		Documento Importado Rotina Speed		271	2018-09-01 02:27:49	2018-09-01 02:27:49
272	7		Documento Importado Rotina Speed		272	2018-09-01 02:27:49	2018-09-01 02:27:49
273	7		Documento Importado Rotina Speed		273	2018-09-01 02:27:49	2018-09-01 02:27:49
274	7		Documento Importado Rotina Speed		274	2018-09-01 02:27:49	2018-09-01 02:27:49
275	7		Documento Importado Rotina Speed		275	2018-09-01 02:27:50	2018-09-01 02:27:50
276	7		Documento Importado Rotina Speed		276	2018-09-01 02:27:50	2018-09-01 02:27:50
277	7		Documento Importado Rotina Speed		277	2018-09-01 02:27:50	2018-09-01 02:27:50
278	7		Documento Importado Rotina Speed		278	2018-09-01 02:27:50	2018-09-01 02:27:50
279	7		Documento Importado Rotina Speed		279	2018-09-01 02:27:50	2018-09-01 02:27:50
280	7		Documento Importado Rotina Speed		280	2018-09-01 02:27:50	2018-09-01 02:27:50
281	7		Documento Importado Rotina Speed		281	2018-09-01 02:27:50	2018-09-01 02:27:50
282	7		Documento Importado Rotina Speed		282	2018-09-01 02:27:50	2018-09-01 02:27:50
283	7		Documento Importado Rotina Speed		283	2018-09-01 02:27:50	2018-09-01 02:27:50
284	7		Documento Importado Rotina Speed		284	2018-09-01 02:27:50	2018-09-01 02:27:50
285	7		Documento Importado Rotina Speed		285	2018-09-01 02:27:51	2018-09-01 02:27:51
286	7		Documento Importado Rotina Speed		286	2018-09-01 02:27:51	2018-09-01 02:27:51
287	7		Documento Importado Rotina Speed		287	2018-09-01 02:27:51	2018-09-01 02:27:51
288	7		Documento Importado Rotina Speed		288	2018-09-01 02:27:51	2018-09-01 02:27:51
289	7		Documento Importado Rotina Speed		289	2018-09-01 02:27:51	2018-09-01 02:27:51
290	7		Documento Importado Rotina Speed		290	2018-09-01 02:27:51	2018-09-01 02:27:51
291	7		Documento Importado Rotina Speed		291	2018-09-01 02:27:51	2018-09-01 02:27:51
292	7		Documento Importado Rotina Speed		292	2018-09-01 02:27:51	2018-09-01 02:27:51
293	7		Documento Importado Rotina Speed		293	2018-09-01 02:27:52	2018-09-01 02:27:52
294	7		Documento Importado Rotina Speed		294	2018-09-01 02:27:52	2018-09-01 02:27:52
295	7		Documento Importado Rotina Speed		295	2018-09-01 02:27:52	2018-09-01 02:27:52
296	7		Documento Importado Rotina Speed		296	2018-09-01 02:27:52	2018-09-01 02:27:52
297	7		Documento Importado Rotina Speed		297	2018-09-01 02:27:52	2018-09-01 02:27:52
298	7		Documento Importado Rotina Speed		298	2018-09-01 02:27:52	2018-09-01 02:27:52
299	7		Documento Importado Rotina Speed		299	2018-09-01 02:27:52	2018-09-01 02:27:52
300	7		Documento Importado Rotina Speed		300	2018-09-01 02:27:52	2018-09-01 02:27:52
301	7		Documento Importado Rotina Speed		301	2018-09-01 02:27:52	2018-09-01 02:27:52
302	7		Documento Importado Rotina Speed		302	2018-09-01 02:27:52	2018-09-01 02:27:52
303	7		Documento Importado Rotina Speed		303	2018-09-01 02:27:52	2018-09-01 02:27:52
304	7		Documento Importado Rotina Speed		304	2018-09-01 02:27:52	2018-09-01 02:27:52
305	7		Documento Importado Rotina Speed		305	2018-09-01 02:27:52	2018-09-01 02:27:52
306	7		Documento Importado Rotina Speed		306	2018-09-01 02:27:53	2018-09-01 02:27:53
307	7		Documento Importado Rotina Speed		307	2018-09-01 02:27:53	2018-09-01 02:27:53
308	7		Documento Importado Rotina Speed		308	2018-09-01 02:27:53	2018-09-01 02:27:53
309	7		Documento Importado Rotina Speed		309	2018-09-01 02:27:53	2018-09-01 02:27:53
310	7		Documento Importado Rotina Speed		310	2018-09-01 02:27:53	2018-09-01 02:27:53
311	7		Documento Importado Rotina Speed		311	2018-09-01 02:27:53	2018-09-01 02:27:53
312	7		Documento Importado Rotina Speed		312	2018-09-01 02:27:53	2018-09-01 02:27:53
313	7		Documento Importado Rotina Speed		313	2018-09-01 02:27:53	2018-09-01 02:27:53
314	7		Documento Importado Rotina Speed		314	2018-09-01 02:27:53	2018-09-01 02:27:53
315	7		Documento Importado Rotina Speed		315	2018-09-01 02:27:53	2018-09-01 02:27:53
316	7		Documento Importado Rotina Speed		316	2018-09-01 02:27:53	2018-09-01 02:27:53
317	7		Documento Importado Rotina Speed		317	2018-09-01 02:27:54	2018-09-01 02:27:54
318	7		Documento Importado Rotina Speed		318	2018-09-01 02:27:54	2018-09-01 02:27:54
319	7		Documento Importado Rotina Speed		319	2018-09-01 02:27:54	2018-09-01 02:27:54
320	7		Documento Importado Rotina Speed		320	2018-09-01 02:27:54	2018-09-01 02:27:54
321	7		Documento Importado Rotina Speed		321	2018-09-01 02:27:54	2018-09-01 02:27:54
322	7		Documento Importado Rotina Speed		322	2018-09-01 02:27:54	2018-09-01 02:27:54
323	7		Documento Importado Rotina Speed		323	2018-09-01 02:27:54	2018-09-01 02:27:54
324	7		Documento Importado Rotina Speed		324	2018-09-01 02:27:54	2018-09-01 02:27:54
325	7		Documento Importado Rotina Speed		325	2018-09-01 02:27:55	2018-09-01 02:27:55
326	7		Documento Importado Rotina Speed		326	2018-09-01 02:27:55	2018-09-01 02:27:55
327	7		Documento Importado Rotina Speed		327	2018-09-01 02:27:55	2018-09-01 02:27:55
328	7		Documento Importado Rotina Speed		328	2018-09-01 02:27:55	2018-09-01 02:27:55
329	7		Documento Importado Rotina Speed		329	2018-09-01 02:27:55	2018-09-01 02:27:55
330	7		Documento Importado Rotina Speed		330	2018-09-01 02:27:55	2018-09-01 02:27:55
331	7		Documento Importado Rotina Speed		331	2018-09-01 02:27:55	2018-09-01 02:27:55
332	7		Documento Importado Rotina Speed		332	2018-09-01 02:27:55	2018-09-01 02:27:55
333	7		Documento Importado Rotina Speed		333	2018-09-01 02:27:55	2018-09-01 02:27:55
334	7		Documento Importado Rotina Speed		334	2018-09-01 02:27:55	2018-09-01 02:27:55
335	7		Documento Importado Rotina Speed		335	2018-09-01 02:27:55	2018-09-01 02:27:55
336	7		Documento Importado Rotina Speed		336	2018-09-01 02:27:55	2018-09-01 02:27:55
337	7		Documento Importado Rotina Speed		337	2018-09-01 02:27:55	2018-09-01 02:27:55
338	7		Documento Importado Rotina Speed		338	2018-09-01 02:27:55	2018-09-01 02:27:55
339	7		Documento Importado Rotina Speed		339	2018-09-01 02:27:56	2018-09-01 02:27:56
340	7		Documento Importado Rotina Speed		340	2018-09-01 02:27:56	2018-09-01 02:27:56
341	7		Documento Importado Rotina Speed		341	2018-09-01 02:27:56	2018-09-01 02:27:56
342	7		Documento Importado Rotina Speed		342	2018-09-01 02:27:56	2018-09-01 02:27:56
343	7		Documento Importado Rotina Speed		343	2018-09-01 02:27:56	2018-09-01 02:27:56
344	7		Documento Importado Rotina Speed		344	2018-09-01 02:27:56	2018-09-01 02:27:56
345	7		Documento Importado Rotina Speed		345	2018-09-01 02:27:56	2018-09-01 02:27:56
346	7		Documento Importado Rotina Speed		346	2018-09-01 02:27:56	2018-09-01 02:27:56
347	7		Documento Importado Rotina Speed		347	2018-09-01 02:27:56	2018-09-01 02:27:56
348	7		Documento Importado Rotina Speed		348	2018-09-01 02:27:56	2018-09-01 02:27:56
349	7		Documento Importado Rotina Speed		349	2018-09-01 02:27:56	2018-09-01 02:27:56
350	7		Documento Importado Rotina Speed		350	2018-09-01 02:27:57	2018-09-01 02:27:57
351	7		Documento Importado Rotina Speed		351	2018-09-01 02:27:57	2018-09-01 02:27:57
352	7		Documento Importado Rotina Speed		352	2018-09-01 02:27:57	2018-09-01 02:27:57
353	7		Documento Importado Rotina Speed		353	2018-09-01 02:27:57	2018-09-01 02:27:57
354	7		Documento Importado Rotina Speed		354	2018-09-01 02:27:57	2018-09-01 02:27:57
355	7		Documento Importado Rotina Speed		355	2018-09-01 02:27:57	2018-09-01 02:27:57
356	7		Documento Importado Rotina Speed		356	2018-09-01 02:27:57	2018-09-01 02:27:57
357	7		Documento Importado Rotina Speed		357	2018-09-01 02:27:57	2018-09-01 02:27:57
358	7		Documento Importado Rotina Speed		358	2018-09-01 02:27:57	2018-09-01 02:27:57
359	7		Documento Importado Rotina Speed		359	2018-09-01 02:27:57	2018-09-01 02:27:57
360	7		Documento Importado Rotina Speed		360	2018-09-01 02:27:58	2018-09-01 02:27:58
361	7		Documento Importado Rotina Speed		361	2018-09-01 02:27:58	2018-09-01 02:27:58
362	7		Documento Importado Rotina Speed		362	2018-09-01 02:27:58	2018-09-01 02:27:58
363	7		Documento Importado Rotina Speed		363	2018-09-01 02:27:58	2018-09-01 02:27:58
364	7		Documento Importado Rotina Speed		364	2018-09-01 02:27:58	2018-09-01 02:27:58
365	7		Documento Importado Rotina Speed		365	2018-09-01 02:27:58	2018-09-01 02:27:58
366	7		Documento Importado Rotina Speed		366	2018-09-01 02:27:58	2018-09-01 02:27:58
367	7		Documento Importado Rotina Speed		367	2018-09-01 02:27:58	2018-09-01 02:27:58
368	7		Documento Importado Rotina Speed		368	2018-09-01 02:27:58	2018-09-01 02:27:58
369	7		Documento Importado Rotina Speed		369	2018-09-01 02:27:58	2018-09-01 02:27:58
370	7		Documento Importado Rotina Speed		370	2018-09-01 02:27:58	2018-09-01 02:27:58
371	7		Documento Importado Rotina Speed		371	2018-09-01 02:27:58	2018-09-01 02:27:58
372	7		Documento Importado Rotina Speed		372	2018-09-01 02:27:58	2018-09-01 02:27:58
373	7		Documento Importado Rotina Speed		373	2018-09-01 02:27:59	2018-09-01 02:27:59
374	7		Documento Importado Rotina Speed		374	2018-09-01 02:27:59	2018-09-01 02:27:59
375	7		Documento Importado Rotina Speed		375	2018-09-01 02:27:59	2018-09-01 02:27:59
376	7		Documento Importado Rotina Speed		376	2018-09-01 02:27:59	2018-09-01 02:27:59
377	7		Documento Importado Rotina Speed		377	2018-09-01 02:27:59	2018-09-01 02:27:59
378	7		Documento Importado Rotina Speed		378	2018-09-01 02:27:59	2018-09-01 02:27:59
379	7		Documento Importado Rotina Speed		379	2018-09-01 02:27:59	2018-09-01 02:27:59
380	7		Documento Importado Rotina Speed		380	2018-09-01 02:27:59	2018-09-01 02:27:59
381	7		Documento Importado Rotina Speed		381	2018-09-01 02:27:59	2018-09-01 02:27:59
382	7		Documento Importado Rotina Speed		382	2018-09-01 02:27:59	2018-09-01 02:27:59
383	7		Documento Importado Rotina Speed		383	2018-09-01 02:27:59	2018-09-01 02:27:59
384	7		Documento Importado Rotina Speed		384	2018-09-01 02:27:59	2018-09-01 02:27:59
385	7		Documento Importado Rotina Speed		385	2018-09-01 02:27:59	2018-09-01 02:27:59
386	7		Documento Importado Rotina Speed		386	2018-09-01 02:28:00	2018-09-01 02:28:00
387	7		Documento Importado Rotina Speed		387	2018-09-01 02:28:00	2018-09-01 02:28:00
388	7		Documento Importado Rotina Speed		388	2018-09-01 02:28:00	2018-09-01 02:28:00
389	7		Documento Importado Rotina Speed		389	2018-09-01 02:28:00	2018-09-01 02:28:00
390	7		Documento Importado Rotina Speed		390	2018-09-01 02:28:00	2018-09-01 02:28:00
391	7		Documento Importado Rotina Speed		391	2018-09-01 02:28:00	2018-09-01 02:28:00
392	7		Documento Importado Rotina Speed		392	2018-09-01 02:28:00	2018-09-01 02:28:00
\.


--
-- Data for Name: workflow_formulario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workflow_formulario (id, etapa_num, etapa, descricao, justificativa, formulario_id, created_at, updated_at) FROM stdin;
72	2	Em análise pela área de qualidade			72	2018-08-28 12:21:26	2018-08-28 12:21:26
73	2	Em análise pela área de qualidade			73	2018-08-28 12:21:58	2018-08-28 12:21:58
74	2	Em análise pela área de qualidade			74	2018-08-28 12:22:44	2018-08-28 12:22:44
5	2	Em análise pela área de qualidade			5	2018-08-27 13:30:36	2018-08-27 13:30:36
6	2	Em análise pela área de qualidade			6	2018-08-27 13:31:47	2018-08-27 13:31:47
7	2	Em análise pela área de qualidade			7	2018-08-27 13:40:53	2018-08-27 13:40:53
8	2	Em análise pela área de qualidade			8	2018-08-27 13:45:13	2018-08-27 13:45:13
9	2	Em análise pela área de qualidade			9	2018-08-27 13:47:32	2018-08-27 13:47:32
10	2	Em análise pela área de qualidade			10	2018-08-28 09:11:18	2018-08-28 09:11:18
11	2	Em análise pela área de qualidade			11	2018-08-28 09:12:15	2018-08-28 09:12:15
12	2	Em análise pela área de qualidade			12	2018-08-28 09:12:51	2018-08-28 09:12:51
13	2	Em análise pela área de qualidade			13	2018-08-28 09:31:24	2018-08-28 09:31:24
14	2	Em análise pela área de qualidade			14	2018-08-28 09:41:51	2018-08-28 09:41:51
15	2	Em análise pela área de qualidade			15	2018-08-28 09:43:34	2018-08-28 09:43:34
16	2	Em análise pela área de qualidade			16	2018-08-28 09:44:45	2018-08-28 09:44:45
17	2	Em análise pela área de qualidade			17	2018-08-28 09:46:18	2018-08-28 09:46:18
18	2	Em análise pela área de qualidade			18	2018-08-28 10:10:13	2018-08-28 10:10:13
19	2	Em análise pela área de qualidade			19	2018-08-28 10:11:00	2018-08-28 10:11:00
20	2	Em análise pela área de qualidade			20	2018-08-28 10:12:18	2018-08-28 10:12:18
21	2	Em análise pela área de qualidade			21	2018-08-28 10:14:37	2018-08-28 10:14:37
22	2	Em análise pela área de qualidade			22	2018-08-28 10:15:09	2018-08-28 10:15:09
23	2	Em análise pela área de qualidade			23	2018-08-28 10:15:53	2018-08-28 10:15:53
24	2	Em análise pela área de qualidade			24	2018-08-28 10:17:13	2018-08-28 10:17:13
25	2	Em análise pela área de qualidade			25	2018-08-28 10:19:56	2018-08-28 10:19:56
26	2	Em análise pela área de qualidade			26	2018-08-28 10:20:24	2018-08-28 10:20:24
27	2	Em análise pela área de qualidade			27	2018-08-28 10:21:50	2018-08-28 10:21:50
28	2	Em análise pela área de qualidade			28	2018-08-28 10:23:06	2018-08-28 10:23:06
29	2	Em análise pela área de qualidade			29	2018-08-28 10:23:43	2018-08-28 10:23:43
30	2	Em análise pela área de qualidade			30	2018-08-28 10:24:44	2018-08-28 10:24:44
31	2	Em análise pela área de qualidade			31	2018-08-28 10:25:17	2018-08-28 10:25:17
32	2	Em análise pela área de qualidade			32	2018-08-28 10:25:44	2018-08-28 10:25:44
33	2	Em análise pela área de qualidade			33	2018-08-28 10:26:21	2018-08-28 10:26:21
34	2	Em análise pela área de qualidade			34	2018-08-28 10:27:14	2018-08-28 10:27:14
35	2	Em análise pela área de qualidade			35	2018-08-28 10:28:54	2018-08-28 10:28:54
36	2	Em análise pela área de qualidade			36	2018-08-28 10:29:45	2018-08-28 10:29:45
37	2	Em análise pela área de qualidade			37	2018-08-28 10:31:38	2018-08-28 10:31:38
38	2	Em análise pela área de qualidade			38	2018-08-28 10:36:20	2018-08-28 10:36:20
39	2	Em análise pela área de qualidade			39	2018-08-28 10:36:57	2018-08-28 10:36:57
40	2	Em análise pela área de qualidade			40	2018-08-28 10:37:32	2018-08-28 10:37:32
41	2	Em análise pela área de qualidade			41	2018-08-28 10:38:06	2018-08-28 10:38:06
42	2	Em análise pela área de qualidade			42	2018-08-28 10:38:42	2018-08-28 10:38:42
43	2	Em análise pela área de qualidade			43	2018-08-28 10:41:08	2018-08-28 10:41:08
44	2	Em análise pela área de qualidade			44	2018-08-28 10:41:41	2018-08-28 10:41:41
45	2	Em análise pela área de qualidade			45	2018-08-28 10:43:31	2018-08-28 10:43:31
46	2	Em análise pela área de qualidade			46	2018-08-28 10:44:43	2018-08-28 10:44:43
47	2	Em análise pela área de qualidade			47	2018-08-28 10:45:08	2018-08-28 10:45:08
48	2	Em análise pela área de qualidade			48	2018-08-28 10:45:35	2018-08-28 10:45:35
49	2	Em análise pela área de qualidade			49	2018-08-28 10:48:03	2018-08-28 10:48:03
50	2	Em análise pela área de qualidade			50	2018-08-28 10:48:39	2018-08-28 10:48:39
51	2	Em análise pela área de qualidade			51	2018-08-28 11:04:47	2018-08-28 11:04:47
52	2	Em análise pela área de qualidade			52	2018-08-28 11:19:02	2018-08-28 11:19:02
53	2	Em análise pela área de qualidade			53	2018-08-28 11:20:10	2018-08-28 11:20:10
54	2	Em análise pela área de qualidade			54	2018-08-28 11:20:44	2018-08-28 11:20:44
55	2	Em análise pela área de qualidade			55	2018-08-28 11:21:23	2018-08-28 11:21:23
56	2	Em análise pela área de qualidade			56	2018-08-28 11:22:53	2018-08-28 11:22:53
57	2	Em análise pela área de qualidade			57	2018-08-28 11:23:24	2018-08-28 11:23:24
58	2	Em análise pela área de qualidade			58	2018-08-28 11:24:49	2018-08-28 11:24:49
59	2	Em análise pela área de qualidade			59	2018-08-28 11:25:29	2018-08-28 11:25:29
60	2	Em análise pela área de qualidade			60	2018-08-28 11:26:01	2018-08-28 11:26:01
61	2	Em análise pela área de qualidade			61	2018-08-28 11:26:49	2018-08-28 11:26:49
62	2	Em análise pela área de qualidade			62	2018-08-28 11:28:44	2018-08-28 11:28:44
63	2	Em análise pela área de qualidade			63	2018-08-28 11:30:24	2018-08-28 11:30:24
64	2	Em análise pela área de qualidade			64	2018-08-28 11:31:44	2018-08-28 11:31:44
65	2	Em análise pela área de qualidade			65	2018-08-28 11:34:31	2018-08-28 11:34:31
66	2	Em análise pela área de qualidade			66	2018-08-28 11:35:10	2018-08-28 11:35:10
67	2	Em análise pela área de qualidade			67	2018-08-28 11:37:27	2018-08-28 11:37:27
68	2	Em análise pela área de qualidade			68	2018-08-28 11:38:01	2018-08-28 11:38:01
69	2	Em análise pela área de qualidade			69	2018-08-28 11:38:46	2018-08-28 11:38:46
70	2	Em análise pela área de qualidade			70	2018-08-28 11:39:22	2018-08-28 11:39:22
71	2	Em análise pela área de qualidade			71	2018-08-28 12:20:05	2018-08-28 12:20:05
75	2	Em análise pela área de qualidade			75	2018-08-28 12:23:27	2018-08-28 12:23:27
76	2	Em análise pela área de qualidade			76	2018-08-28 12:24:28	2018-08-28 12:24:28
77	2	Em análise pela área de qualidade			77	2018-08-28 12:28:25	2018-08-28 12:28:25
78	2	Em análise pela área de qualidade			78	2018-08-28 12:29:36	2018-08-28 12:29:36
79	2	Em análise pela área de qualidade			79	2018-08-28 12:32:25	2018-08-28 12:32:25
80	2	Em análise pela área de qualidade			80	2018-08-28 12:38:11	2018-08-28 12:38:11
81	2	Em análise pela área de qualidade			81	2018-08-28 12:39:01	2018-08-28 12:39:01
82	2	Em análise pela área de qualidade			82	2018-08-28 12:40:20	2018-08-28 12:40:20
83	2	Em análise pela área de qualidade			83	2018-08-28 12:40:51	2018-08-28 12:40:51
84	2	Em análise pela área de qualidade			84	2018-08-28 12:41:58	2018-08-28 12:41:58
85	2	Em análise pela área de qualidade			85	2018-08-28 12:42:35	2018-08-28 12:42:35
86	2	Em análise pela área de qualidade			86	2018-08-28 12:43:02	2018-08-28 12:43:02
87	2	Em análise pela área de qualidade			87	2018-08-28 12:43:55	2018-08-28 12:43:55
88	2	Em análise pela área de qualidade			88	2018-08-28 12:44:30	2018-08-28 12:44:30
89	2	Em análise pela área de qualidade			89	2018-08-28 12:44:30	2018-08-28 12:44:30
90	2	Em análise pela área de qualidade			90	2018-08-28 14:49:52	2018-08-28 14:49:52
91	2	Em análise pela área de qualidade			91	2018-08-28 14:51:12	2018-08-28 14:51:12
92	2	Em análise pela área de qualidade			92	2018-08-28 14:51:47	2018-08-28 14:51:47
93	2	Em análise pela área de qualidade			93	2018-08-28 14:53:23	2018-08-28 14:53:23
94	2	Em análise pela área de qualidade			94	2018-08-28 14:55:06	2018-08-28 14:55:06
95	2	Em análise pela área de qualidade			95	2018-08-28 14:57:01	2018-08-28 14:57:01
96	2	Em análise pela área de qualidade			96	2018-08-28 14:57:49	2018-08-28 14:57:49
97	2	Em análise pela área de qualidade			97	2018-08-28 14:58:47	2018-08-28 14:58:47
98	2	Em análise pela área de qualidade			98	2018-08-28 15:00:16	2018-08-28 15:00:16
99	2	Em análise pela área de qualidade			99	2018-08-28 15:00:57	2018-08-28 15:00:57
100	2	Em análise pela área de qualidade			100	2018-08-28 15:09:28	2018-08-28 15:09:28
101	2	Em análise pela área de qualidade			101	2018-08-28 15:12:36	2018-08-28 15:12:36
102	2	Em análise pela área de qualidade			102	2018-08-28 15:13:05	2018-08-28 15:13:05
103	2	Em análise pela área de qualidade			103	2018-08-28 15:13:56	2018-08-28 15:13:56
105	2	Em análise pela área de qualidade			105	2018-08-28 15:17:14	2018-08-28 15:17:14
106	2	Em análise pela área de qualidade			106	2018-08-28 15:21:32	2018-08-28 15:21:32
107	2	Em análise pela área de qualidade			107	2018-08-28 15:22:20	2018-08-28 15:22:20
108	2	Em análise pela área de qualidade			108	2018-08-28 15:23:06	2018-08-28 15:23:06
109	2	Em análise pela área de qualidade			109	2018-08-28 15:23:55	2018-08-28 15:23:55
110	2	Em análise pela área de qualidade			110	2018-08-28 15:24:35	2018-08-28 15:24:35
111	2	Em análise pela área de qualidade			111	2018-08-28 15:25:08	2018-08-28 15:25:08
112	2	Em análise pela área de qualidade			112	2018-08-28 15:25:42	2018-08-28 15:25:42
113	2	Em análise pela área de qualidade			113	2018-08-28 15:26:10	2018-08-28 15:26:10
114	2	Em análise pela área de qualidade			114	2018-08-28 15:26:38	2018-08-28 15:26:38
115	2	Em análise pela área de qualidade			115	2018-08-28 15:27:16	2018-08-28 15:27:16
116	2	Em análise pela área de qualidade			116	2018-08-28 15:28:55	2018-08-28 15:28:55
117	2	Em análise pela área de qualidade			117	2018-08-28 15:29:31	2018-08-28 15:29:31
118	2	Em análise pela área de qualidade			118	2018-08-28 15:30:00	2018-08-28 15:30:00
119	2	Em análise pela área de qualidade			119	2018-08-28 15:30:43	2018-08-28 15:30:43
120	2	Em análise pela área de qualidade			120	2018-08-28 15:31:24	2018-08-28 15:31:24
121	2	Em análise pela área de qualidade			121	2018-08-28 15:31:57	2018-08-28 15:31:57
122	2	Em análise pela área de qualidade			122	2018-08-28 15:32:32	2018-08-28 15:32:32
4	1	Em revisão			4	2018-08-27 10:09:12	2018-08-30 09:49:55
104	2	Formulário divulgado			104	2018-08-28 15:16:33	2018-08-30 14:04:41
\.


--
-- Name: workflow_formulario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workflow_formulario_id_seq', 155, true);


--
-- Name: workflow_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workflow_id_seq', 392, true);


--
-- Name: anexo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anexo
    ADD CONSTRAINT anexo_pkey PRIMARY KEY (id);


--
-- Name: aprovador_setor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprovador_setor
    ADD CONSTRAINT aprovador_setor_pkey PRIMARY KEY (id);


--
-- Name: area_interesse_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.area_interesse_documento
    ADD CONSTRAINT area_interesse_documento_pkey PRIMARY KEY (id);


--
-- Name: configuracao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.configuracao
    ADD CONSTRAINT configuracao_pkey PRIMARY KEY (id);


--
-- Name: dados_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_pkey PRIMARY KEY (id);


--
-- Name: documento_formulario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_formulario
    ADD CONSTRAINT documento_formulario_pkey PRIMARY KEY (id);


--
-- Name: documento_observacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_observacao
    ADD CONSTRAINT documento_observacao_pkey PRIMARY KEY (id);


--
-- Name: documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento
    ADD CONSTRAINT documento_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: formulario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario
    ADD CONSTRAINT formulario_pkey PRIMARY KEY (id);


--
-- Name: formulario_revisao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_pkey PRIMARY KEY (id);


--
-- Name: grupo_divulgacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao
    ADD CONSTRAINT grupo_divulgacao_pkey PRIMARY KEY (id);


--
-- Name: grupo_divulgacao_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao_usuario
    ADD CONSTRAINT grupo_divulgacao_usuario_pkey PRIMARY KEY (id);


--
-- Name: grupo_treinamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento
    ADD CONSTRAINT grupo_treinamento_pkey PRIMARY KEY (id);


--
-- Name: grupo_treinamento_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento_usuario
    ADD CONSTRAINT grupo_treinamento_usuario_pkey PRIMARY KEY (id);


--
-- Name: historico_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_documento
    ADD CONSTRAINT historico_documento_pkey PRIMARY KEY (id);


--
-- Name: historico_formulario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_formulario
    ADD CONSTRAINT historico_formulario_pkey PRIMARY KEY (id);


--
-- Name: jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: lista_presenca_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_presenca
    ADD CONSTRAINT lista_presenca_pkey PRIMARY KEY (id);


--
-- Name: migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: notificacao_formulario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao_formulario
    ADD CONSTRAINT notificacao_formulario_pkey PRIMARY KEY (id);


--
-- Name: notificacao_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao
    ADD CONSTRAINT notificacao_pkey PRIMARY KEY (id);


--
-- Name: setor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setor
    ADD CONSTRAINT setor_pkey PRIMARY KEY (id);


--
-- Name: tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_documento
    ADD CONSTRAINT tipo_documento_pkey PRIMARY KEY (id);


--
-- Name: tipo_setor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_setor
    ADD CONSTRAINT tipo_setor_pkey PRIMARY KEY (id);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: workflow_formulario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_formulario
    ADD CONSTRAINT workflow_formulario_pkey PRIMARY KEY (id);


--
-- Name: workflow_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow
    ADD CONSTRAINT workflow_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: anexo_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anexo
    ADD CONSTRAINT anexo_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: aprovador_setor_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprovador_setor
    ADD CONSTRAINT aprovador_setor_setor_id_foreign FOREIGN KEY (setor_id) REFERENCES public.setor(id);


--
-- Name: aprovador_setor_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aprovador_setor
    ADD CONSTRAINT aprovador_setor_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: area_interesse_documento_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.area_interesse_documento
    ADD CONSTRAINT area_interesse_documento_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: area_interesse_documento_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.area_interesse_documento
    ADD CONSTRAINT area_interesse_documento_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: dados_documento_aprovador_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_aprovador_id_foreign FOREIGN KEY (aprovador_id) REFERENCES public.users(id);


--
-- Name: dados_documento_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: dados_documento_elaborador_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_elaborador_id_foreign FOREIGN KEY (elaborador_id) REFERENCES public.users(id);


--
-- Name: dados_documento_grupo_divulgacao_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_grupo_divulgacao_id_foreign FOREIGN KEY (grupo_divulgacao_id) REFERENCES public.grupo_divulgacao(id);


--
-- Name: dados_documento_grupo_treinamento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_grupo_treinamento_id_foreign FOREIGN KEY (grupo_treinamento_id) REFERENCES public.grupo_treinamento(id);


--
-- Name: dados_documento_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dados_documento
    ADD CONSTRAINT dados_documento_setor_id_foreign FOREIGN KEY (setor_id) REFERENCES public.setor(id);


--
-- Name: documento_formulario_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_formulario
    ADD CONSTRAINT documento_formulario_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: documento_formulario_formulario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_formulario
    ADD CONSTRAINT documento_formulario_formulario_id_foreign FOREIGN KEY (formulario_id) REFERENCES public.formulario(id);


--
-- Name: documento_observacao_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_observacao
    ADD CONSTRAINT documento_observacao_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: documento_observacao_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento_observacao
    ADD CONSTRAINT documento_observacao_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: documento_tipo_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documento
    ADD CONSTRAINT documento_tipo_documento_id_foreign FOREIGN KEY (tipo_documento_id) REFERENCES public.tipo_documento(id);


--
-- Name: formulario_elaborador_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario
    ADD CONSTRAINT formulario_elaborador_id_foreign FOREIGN KEY (elaborador_id) REFERENCES public.users(id);


--
-- Name: formulario_grupo_divulgacao_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario
    ADD CONSTRAINT formulario_grupo_divulgacao_id_foreign FOREIGN KEY (grupo_divulgacao_id) REFERENCES public.grupo_divulgacao(id);


--
-- Name: formulario_revisao_elaborador_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_elaborador_id_foreign FOREIGN KEY (elaborador_id) REFERENCES public.users(id);


--
-- Name: formulario_revisao_formulario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_formulario_id_foreign FOREIGN KEY (formulario_id) REFERENCES public.formulario(id);


--
-- Name: formulario_revisao_grupo_divulgacao_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_grupo_divulgacao_id_foreign FOREIGN KEY (grupo_divulgacao_id) REFERENCES public.grupo_divulgacao(id);


--
-- Name: formulario_revisao_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_setor_id_foreign FOREIGN KEY (setor_id) REFERENCES public.setor(id);


--
-- Name: formulario_revisao_tipo_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario_revisao
    ADD CONSTRAINT formulario_revisao_tipo_documento_id_foreign FOREIGN KEY (tipo_documento_id) REFERENCES public.tipo_documento(id);


--
-- Name: formulario_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario
    ADD CONSTRAINT formulario_setor_id_foreign FOREIGN KEY (setor_id) REFERENCES public.setor(id);


--
-- Name: formulario_tipo_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulario
    ADD CONSTRAINT formulario_tipo_documento_id_foreign FOREIGN KEY (tipo_documento_id) REFERENCES public.tipo_documento(id);


--
-- Name: grupo_divulgacao_usuario_grupo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao_usuario
    ADD CONSTRAINT grupo_divulgacao_usuario_grupo_id_foreign FOREIGN KEY (grupo_id) REFERENCES public.grupo_divulgacao(id);


--
-- Name: grupo_divulgacao_usuario_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_divulgacao_usuario
    ADD CONSTRAINT grupo_divulgacao_usuario_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: grupo_treinamento_usuario_grupo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento_usuario
    ADD CONSTRAINT grupo_treinamento_usuario_grupo_id_foreign FOREIGN KEY (grupo_id) REFERENCES public.grupo_treinamento(id);


--
-- Name: grupo_treinamento_usuario_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_treinamento_usuario
    ADD CONSTRAINT grupo_treinamento_usuario_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: historico_documento_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_documento
    ADD CONSTRAINT historico_documento_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: historico_formulario_formulario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historico_formulario
    ADD CONSTRAINT historico_formulario_formulario_id_foreign FOREIGN KEY (formulario_id) REFERENCES public.formulario(id);


--
-- Name: lista_presenca_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_presenca
    ADD CONSTRAINT lista_presenca_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: notificacao_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao
    ADD CONSTRAINT notificacao_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: notificacao_formulario_formulario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao_formulario
    ADD CONSTRAINT notificacao_formulario_formulario_id_foreign FOREIGN KEY (formulario_id) REFERENCES public.formulario(id);


--
-- Name: notificacao_formulario_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao_formulario
    ADD CONSTRAINT notificacao_formulario_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: notificacao_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacao
    ADD CONSTRAINT notificacao_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: setor_tipo_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.setor
    ADD CONSTRAINT setor_tipo_setor_id_foreign FOREIGN KEY (tipo_setor_id) REFERENCES public.tipo_setor(id);


--
-- Name: users_setor_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_setor_id_foreign FOREIGN KEY (setor_id) REFERENCES public.setor(id);


--
-- Name: workflow_documento_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow
    ADD CONSTRAINT workflow_documento_id_foreign FOREIGN KEY (documento_id) REFERENCES public.documento(id);


--
-- Name: workflow_formulario_formulario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_formulario
    ADD CONSTRAINT workflow_formulario_formulario_id_foreign FOREIGN KEY (formulario_id) REFERENCES public.formulario(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

