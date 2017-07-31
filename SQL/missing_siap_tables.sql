siblh_sonata=# \d ctl_establecimiento
                                               Tabla «public.ctl_establecimiento»
         Columna          |          Tipo          |                               Modificadores                                
--------------------------+------------------------+----------------------------------------------------------------------------
 id                       | integer                | not null valor por omisión nextval('ctl_establecimiento_id_seq'::regclass)
 id_tipo_establecimiento  | integer                | not null
 nombre                   | character varying(150) | not null
 direccion                | character varying(250) | 
 telefono                 | character varying(15)  | 
 fax                      | character varying(15)  | 
 latitud                  | numeric(10,4)          | 
 longitud                 | numeric(10,4)          | 
 id_municipio             | integer                | 
 id_nivel_minsal          | integer                | 
 cod_ucsf                 | integer                | 
 activo                   | boolean                | 
 id_establecimiento_padre | integer                | 
 tipo_expediente          | character(1)           | 
 configurado              | boolean                | 
 id_institucion           | integer                | 
Índices:
    "pk_ctl_establecimiento" PRIMARY KEY, btree (id)
Restricciones de llave foránea:
    "fk_ctl_institucion_establecimiento" FOREIGN KEY (id_institucion) REFERENCES ctl_institucion(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_establecimiento_establecimiento" FOREIGN KEY (id_establecimiento_padre) REFERENCES ctl_establecimiento(id)
    "fk_municipio_establecimiento" FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id)
    "fk_tipo_establecimiento_establecimiento" FOREIGN KEY (id_tipo_establecimiento) REFERENCES ctl_tipo_establecimiento(id)
Referenciada por:
    TABLE "blh_egreso_receptor" CONSTRAINT "ctl_establecimiento_blh_egreso_receptor_fk" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
    TABLE "blh_historial_clinico" CONSTRAINT "ctl_establecimiento_blh_historial_clinico_fk" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
    TABLE "blh_personal" CONSTRAINT "ctl_establecimiento_blh_personal_fk" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
    TABLE "blh_banco_de_leche" CONSTRAINT "fk_blh_banc_fk_establ_ctl_esta" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "ctl_departamento" CONSTRAINT "fk_establecimiento" FOREIGN KEY (id_establecimiento_region) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_ctl_centro_recoleccion" CONSTRAINT "fk_establecimiento_centro_recoleccion" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "mnt_empleado" CONSTRAINT "fk_establecimiento_empleado" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "ctl_establecimiento" CONSTRAINT "fk_establecimiento_establecimiento" FOREIGN KEY (id_establecimiento_padre) REFERENCES ctl_establecimiento(id)
    TABLE "mnt_expediente" CONSTRAINT "fk_establecimiento_expediente" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
    TABLE "fos_user_user" CONSTRAINT "fk_establecimiento_fos_user_user" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "mnt_empleado" CONSTRAINT "fk_establecmiento_empleado_ext" FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT


siblh_sonata=# \d mnt_expediente
                                                Tabla «public.mnt_expediente»
           Columna           |          Tipo          |                             Modificadores                             
-----------------------------+------------------------+-----------------------------------------------------------------------
 id                          | bigint                 | not null valor por omisión nextval('mnt_expediente_id_seq'::regclass)
 numero                      | character varying(12)  | not null
 id_paciente                 | bigint                 | not null
 id_establecimiento          | integer                | 
 habilitado                  | boolean                | not null valor por omisión true
 id_creacion_expediente      | integer                | 
 fecha_creacion              | date                   | 
 hora_creacion               | time without time zone | 
 numero_temporal             | boolean                | valor por omisión false
 expediente_fisico_eliminado | boolean                | valor por omisión false
 cun                         | boolean                | valor por omisión false
Índices:
    "pk_mnt_expediente" PRIMARY KEY, btree (id)
    "idx_id_id_paciente" UNIQUE CONSTRAINT, btree (id, id_paciente)
    "idx_numero_expediente" UNIQUE CONSTRAINT, btree (numero)
Restricciones de llave foránea:
    "fk_creacion_expediente_expediente" FOREIGN KEY (id_creacion_expediente) REFERENCES ctl_creacion_expediente(id)
    "fk_establecimiento_expediente" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
    "fk_paciente_expediente" FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id)
Referenciada por:
    TABLE "blh_donante" CONSTRAINT "fk_expediente_donante" FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "blh_receptor" CONSTRAINT "fk_expediente_receptor" FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT


                                                   Tabla «public.mnt_paciente»
           Columna            |            Tipo             |                            Modificadores                            
------------------------------+-----------------------------+---------------------------------------------------------------------
 id                           | bigint                      | not null valor por omisión nextval('mnt_paciente_id_seq'::regclass)
 primer_nombre                | character varying(25)       | not null
 segundo_nombre               | character varying(25)       | 
 tercer_nombre                | character varying(25)       | 
 primer_apellido              | character varying(25)       | not null
 segundo_apellido             | character varying(25)       | 
 apellido_casada              | character varying(25)       | 
 fecha_nacimiento             | date                        | 
 hora_nacimiento              | time without time zone      | 
 id_pais_nacimiento           | integer                     | 
 id_departamento_nacimiento   | integer                     | 
 id_municipio_nacimiento      | integer                     | 
 id_doc_ide_paciente          | integer                     | 
 numero_doc_ide_paciente      | character varying(20)       | 
 direccion                    | character varying(200)      | 
 telefono_casa                | character varying(10)       | 
 id_departamento_domicilio    | integer                     | 
 id_municipio_domicilio       | integer                     | 
 id_canton_domicilio          | integer                     | 
 area_geografica_domicilio    | integer                     | 
 lugar_trabajo                | character varying(50)       | 
 telefono_trabajo             | character varying(10)       | 
 nombre_padre                 | character varying(80)       | 
 nombre_madre                 | character varying(80)       | 
 nombre_responsable           | character varying(80)       | 
 direccion_responsable        | character varying(200)      | 
 telefono_responsable         | character varying(10)       | 
 id_parentesco_responsable    | integer                     | 
 id_doc_ide_responsable       | integer                     | 
 numero_doc_ide_responsable   | character varying(20)       | 
 nombre_proporciono_datos     | character varying(80)       | 
 id_doc_ide_proporciono_datos | integer                     | 
 numero_doc_ide_propor_datos  | character varying(20)       | 
 observacion                  | text                        | 
 conocido_por                 | character varying(70)       | 
 estado                       | integer                     | not null valor por omisión 1
 id_paciente_inicial          | bigint                      | 
 id_nacionalidad              | integer                     | 
 id_sexo                      | integer                     | not null
 id_parentesco_propor_datos   | integer                     | 
 fecha_registro               | timestamp without time zone | 
 id_user_reg                  | integer                     | 
 id_user_mod                  | integer                     | 
 fecha_mod                    | timestamp without time zone | 
 id_condicion_persona         | integer                     | not null valor por omisión 4
 cotizante                    | boolean                     | 
 nombre_completo_fonetico     | text                        | 
 apellido_completo_fonetico   | text                        | 
 id_ocupacion                 | smallint                    | 
 id_estado_civil              | smallint                    | 
Índices:
    "pk_mnt_paciente" PRIMARY KEY, btree (id)
Restricciones de llave foránea:
    "fk_area_geografica_domicio" FOREIGN KEY (area_geografica_domicilio) REFERENCES ctl_area_geografica(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    "fk_canton_paciente_domicilio" FOREIGN KEY (id_canton_domicilio) REFERENCES ctl_canton(id)
    "fk_condicion_persona_paciente" FOREIGN KEY (id_condicion_persona) REFERENCES ctl_condicion_persona(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_departamento_paciente_domicilio" FOREIGN KEY (id_departamento_domicilio) REFERENCES ctl_departamento(id)
    "fk_departamento_paciente_nacimiento" FOREIGN KEY (id_departamento_nacimiento) REFERENCES ctl_departamento(id)
    "fk_documente_identidad_paciente" FOREIGN KEY (id_doc_ide_paciente) REFERENCES ctl_documento_identidad(id)
    "fk_documento_identidad_proporciono_datos" FOREIGN KEY (id_doc_ide_proporciono_datos) REFERENCES ctl_documento_identidad(id)
    "fk_documento_identidad_responsable" FOREIGN KEY (id_doc_ide_responsable) REFERENCES ctl_documento_identidad(id)
    "fk_estado_civil_paciente" FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id)
    "fk_municipio_paciente_domicilio" FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id)
    "fk_municipio_paciente_nacimiento" FOREIGN KEY (id_municipio_nacimiento) REFERENCES ctl_municipio(id)
    "fk_nacionalidad_paciente" FOREIGN KEY (id_nacionalidad) REFERENCES ctl_nacionalidad(id)
    "fk_ocupacion_paciente" FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    "fk_pais_paciente" FOREIGN KEY (id_pais_nacimiento) REFERENCES ctl_pais(id)
    "fk_parentesco_paciente_propor_datos" FOREIGN KEY (id_parentesco_propor_datos) REFERENCES ctl_parentesco(id)
    "fk_parentesco_paciente_responsable" FOREIGN KEY (id_parentesco_responsable) REFERENCES ctl_parentesco(id)
    "fk_sexo__paciente" FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id)
    "fk_user_paciente" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_user_paciente_mod" FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
Referenciada por:
    TABLE "blh_receptor" CONSTRAINT "fk_blh_rece_fk_pacien_mnt_paci" FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "mnt_expediente" CONSTRAINT "fk_paciente_expediente" FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id)


siblh_sonata=# \d mnt_empleado
                                                  Tabla «public.mnt_empleado»
          Columna           |            Tipo             |                            Modificadores                            
----------------------------+-----------------------------+---------------------------------------------------------------------
 id                         | integer                     | not null valor por omisión nextval('mnt_empleado_id_seq'::regclass)
 nombre                     | character varying(100)      | 
 apellido                   | character varying(100)      | 
 fecha_nacimiento           | date                        | 
 dui                        | character varying(12)       | 
 numero_junta_vigilancia    | character varying(20)       | 
 numero_celular             | character varying(10)       | 
 correo_electronico         | character varying(50)       | 
 id_establecimiento         | integer                     | 
 correlativo                | smallint                    | 
 id_cargo_empleado          | integer                     | 
 firma_digital              | text                        | 
 id_tipo_empleado           | integer                     | 
 id_user_reg                | smallint                    | 
 fecha_hora_reg             | timestamp without time zone | 
 id_user_mod                | smallint                    | 
 fecha_hora_mod             | timestamp without time zone | 
 nombre_empleado            | character varying(200)      | 
 habilitado                 | boolean                     | valor por omisión true
 id_establecimiento_externo | integer                     | 
 residente                  | boolean                     | valor por omisión false
 id_nuevo_empleado          | integer                     | 
Índices:
    "pk_mnt_empleado" PRIMARY KEY, btree (id)
Restricciones de llave foránea:
    "fk_cargoempleados_empleado" FOREIGN KEY (id_cargo_empleado) REFERENCES mnt_cargoempleados(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_establecimiento_empleado" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_establecmiento_empleado_ext" FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
    "fk_tipo_empleado_empleado" FOREIGN KEY (id_tipo_empleado) REFERENCES mnt_tipo_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT
Referenciada por:
    TABLE "fos_user_user" CONSTRAINT "fk_empleado_fos_user" FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE
    TABLE "blh_lote_analisis" CONSTRAINT "fk_responsable_analisis_lote_analisis" FOREIGN KEY (id_responsable_analisis) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "blh_donacion" CONSTRAINT "fk_responsable_donacion_donacion" FOREIGN KEY (id_responsable_donacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "blh_pasteurizacion" CONSTRAINT "fk_responsable_pasteurizacion_pasteurizacion" FOREIGN KEY (id_responsable_pasteurizacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    TABLE "blh_solicitud" CONSTRAINT "fk_responsable_solicitud" FOREIGN KEY (id_responsable_solicitud) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT


                                                 Tabla «public.fos_user_user»
        Columna        |              Tipo              |                            Modificadores                             
-----------------------+--------------------------------+----------------------------------------------------------------------
 id                    | integer                        | not null valor por omisión nextval('fos_user_user_id_seq'::regclass)
 username              | character varying(255)         | not null
 username_canonical    | character varying(255)         | 
 email                 | character varying(255)         | 
 email_canonical       | character varying(255)         | 
 enabled               | boolean                        | 
 salt                  | character varying(255)         | 
 password              | character varying(255)         | not null
 last_login            | timestamp(0) without time zone | valor por omisión NULL::timestamp without time zone
 locked                | boolean                        | 
 expired               | boolean                        | 
 expires_at            | timestamp(0) without time zone | valor por omisión NULL::timestamp without time zone
 confirmation_token    | character varying(255)         | valor por omisión NULL::character varying
 password_requested_at | timestamp(0) without time zone | valor por omisión NULL::timestamp without time zone
 roles                 | text                           | 
 credentials_expired   | boolean                        | 
 credentials_expire_at | timestamp(0) without time zone | valor por omisión NULL::timestamp without time zone
 created_at            | timestamp(0) without time zone | 
 updated_at            | timestamp(0) without time zone | 
 date_of_birth         | timestamp(0) without time zone | valor por omisión NULL::timestamp without time zone
 firstname             | character varying(64)          | valor por omisión NULL::character varying
 lastname              | character varying(64)          | valor por omisión NULL::character varying
 website               | character varying(64)          | valor por omisión NULL::character varying
 biography             | character varying(255)         | valor por omisión NULL::character varying
 gender                | character varying(1)           | valor por omisión NULL::character varying
 locale                | character varying(8)           | valor por omisión NULL::character varying
 timezone              | character varying(64)          | valor por omisión NULL::character varying
 phone                 | character varying(64)          | valor por omisión NULL::character varying
 facebook_uid          | character varying(255)         | valor por omisión NULL::character varying
 facebook_name         | character varying(255)         | valor por omisión NULL::character varying
 facebook_data         | text                           | 
 twitter_uid           | character varying(255)         | valor por omisión NULL::character varying
 twitter_name          | character varying(255)         | valor por omisión NULL::character varying
 twitter_data          | text                           | 
 gplus_uid             | character varying(255)         | valor por omisión NULL::character varying
 gplus_name            | character varying(255)         | valor por omisión NULL::character varying
 gplus_data            | text                           | 
 token                 | character varying(255)         | valor por omisión NULL::character varying
 two_step_code         | character varying(255)         | valor por omisión NULL::character varying
 id_establecimiento    | integer                        | 
 id_empleado           | integer                        | 
 id_banco_de_leche     | integer                        | 
 id_centro_recoleccion | integer                        | 
Índices:
    "fos_user_user_pkey" PRIMARY KEY, btree (id)
Restricciones de llave foránea:
    "fk_banco_de_leche_user_user" FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    "fk_centro_recoleccion_user_user" FOREIGN KEY (id_centro_recoleccion) REFERENCES blh_ctl_centro_recoleccion(id) ON UPDATE RESTRICT ON DELETE RESTRICT
    "fk_empleado_fos_user" FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE
    "fk_establecimiento_fos_user_user" FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
Referenciada por:
    TABLE "fos_user_user_group" CONSTRAINT "fk_b3c77447a76ed395" FOREIGN KEY (user_id) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE CASCADE
    TABLE "mnt_paciente" CONSTRAINT "fk_user_paciente" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "mnt_paciente" CONSTRAINT "fk_user_paciente_mod" FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_acidez" CONSTRAINT "fk_user_reg_acidez" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_analisis_microbiologico" CONSTRAINT "fk_user_reg_analisis_microbiologico" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_analisis_sensorial" CONSTRAINT "fk_user_reg_analisis_sensorial" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_banco_de_leche" CONSTRAINT "fk_user_reg_banco_de_leche" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_bitacora" CONSTRAINT "fk_user_reg_bitacora" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_ctl_centro_recoleccion" CONSTRAINT "fk_user_reg_centro_recoleccion" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_crematocrito" CONSTRAINT "fk_user_reg_crematocrito" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_curva" CONSTRAINT "fk_user_reg_curva" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_donacion" CONSTRAINT "fk_user_reg_donacion" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_donante" CONSTRAINT "fk_user_reg_donante" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_egreso_receptor" CONSTRAINT "fk_user_reg_egreso_receptor" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_estado" CONSTRAINT "fk_user_reg_estado" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_examen" CONSTRAINT "fk_user_reg_examen" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_examen_donante" CONSTRAINT "fk_user_reg_examen_donante" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_frasco_procesado" CONSTRAINT "fk_user_reg_frasco_procesado" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_frasco_procesado_solicitud" CONSTRAINT "fk_user_reg_frasco_procesado_solicitud" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_frasco_recolectado" CONSTRAINT "fk_user_reg_frasco_recolectado" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_frasco_recolectado_frasco_p" CONSTRAINT "fk_user_reg_frasco_recolectado_frasco_p" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_grupo_solicitud" CONSTRAINT "fk_user_reg_grupo_solicitud" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_historia_actual" CONSTRAINT "fk_user_reg_historia_actual" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_historial_clinico" CONSTRAINT "fk_user_reg_historial_clinico" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_informacion_publica" CONSTRAINT "fk_user_reg_informacion_publica" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_lote_analisis" CONSTRAINT "fk_user_reg_lote_analisis" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_menu" CONSTRAINT "fk_user_reg_menu" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_opcion_menu" CONSTRAINT "fk_user_reg_opcion_menu" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_pasteurizacion" CONSTRAINT "fk_user_reg_pasteurizacion" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_personal" CONSTRAINT "fk_user_reg_personal" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_receptor" CONSTRAINT "fk_user_reg_receptor" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_rol" CONSTRAINT "fk_user_reg_rol" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_rol_menu" CONSTRAINT "fk_user_reg_rol_menu" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_seguimiento_receptor" CONSTRAINT "fk_user_reg_seguimiento_receptor" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_solicitud" CONSTRAINT "fk_user_reg_solicitud" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_temperatura_enfriamiento" CONSTRAINT "fk_user_reg_temperatura_enfriamiento" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
    TABLE "blh_temperatura_pasteurizacion" CONSTRAINT "fk_user_reg_temperatura_pasteurizacion" FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT


                                      Tabla «public.fos_user_group»
 Columna |          Tipo          |                             Modificadores                             
---------+------------------------+-----------------------------------------------------------------------
 id      | integer                | not null valor por omisión nextval('fos_user_group_id_seq'::regclass)
 name    | character varying(255) | not null
 roles   | text                   | not null
Índices:
    "fos_user_group_pkey" PRIMARY KEY, btree (id)
    "uniq_583d1f3e5e237e06" UNIQUE, btree (name)
Referenciada por:
    TABLE "fos_user_user_group" CONSTRAINT "fk_b3c77447fe54d947" FOREIGN KEY (group_id) REFERENCES fos_user_group(id) ON UPDATE CASCADE ON DELETE RESTRICT


\d mnt_cargoempleados
                                        Tabla «public.mnt_cargoempleados»
   Columna   |         Tipo          |                               Modificadores                               
-------------+-----------------------+---------------------------------------------------------------------------
 id          | integer               | not null valor por omisión nextval('mnt_cargoempleados_id_seq'::regclass)
 cargo       | character varying(50) | 
 id_atencion | integer               | 
Índices:
    "pk_mnt_cargo_empleado" PRIMARY KEY, btree (id)
Restricciones de llave foránea:
    "fk_atencion_cargo_empleado" FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT


\d mnt_tipo_empleado
                                             Tabla «public.mnt_tipo_empleado»
        Columna        |         Tipo          |                              Modificadores                               
-----------------------+-----------------------+--------------------------------------------------------------------------
 id                    | integer               | not null valor por omisión nextval('mnt_tipo_empleado_id_seq'::regclass)
 codigo                | character varying(3)  | not null
 tipo                  | character varying(50) | valor por omisión NULL::character varying
 prescribe_medicamento | boolean               | not null valor por omisión false
Índices:
    "pk_mnt_tipo_empleado" PRIMARY KEY, btree (id)


-- ////////////////////////////////////////////////////////////////////
pg_dump -U siap -a -t mnt_expediente -t mnt_paciente -t ctl_establecimiento -t ctl_tipo_establecimiento -t mnt_empleado -t mnt_tipo_empleado -d siap_karen > /tmp/data_siap_karen_siblh.sql
-- ////////////////////////////////////////////////////////////////////
