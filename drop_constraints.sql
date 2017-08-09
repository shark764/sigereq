ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_area_geografica_domicio";-- FOREIGN KEY (area_geografica_domicilio) REFERENCES ctl_area_geografica(id) ON UPDATE RESTRICT ON DELETE RESTRICT

ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_canton_paciente_domicilio";-- FOREIGN KEY (id_canton_domicilio) REFERENCES ctl_canton(id)

ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_condicion_persona_paciente";-- FOREIGN KEY (id_condicion_persona) REFERENCES ctl_condicion_persona(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "ctl_municipio" DROP CONSTRAINT "fk_departamento_municipio";-- FOREIGN KEY (id_departamento) REFERENCES ctl_departamento(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_departamento_paciente_domicilio";-- FOREIGN KEY (id_departamento_domicilio) REFERENCES ctl_departamento(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_departamento_paciente_nacimiento";-- FOREIGN KEY (id_departamento_nacimiento) REFERENCES ctl_departamento(id)

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_documente_identidad_donante";-- FOREIGN KEY (id_doc_ide_donante) REFERENCES ctl_documento_identidad(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_documente_identidad_paciente";-- FOREIGN KEY (id_doc_ide_paciente) REFERENCES ctl_documento_identidad(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_documento_identidad_proporciono_datos";-- FOREIGN KEY (id_doc_ide_proporciono_datos) REFERENCES ctl_documento_identidad(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_documento_identidad_responsable";-- FOREIGN KEY (id_doc_ide_responsable) REFERENCES ctl_documento_identidad(id)

ALTER TABLE "blh_egreso_receptor" DROP CONSTRAINT "ctl_establecimiento_blh_egreso_receptor_fk";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
ALTER TABLE "blh_historial_clinico" DROP CONSTRAINT "ctl_establecimiento_blh_historial_clinico_fk";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
ALTER TABLE "blh_personal" DROP CONSTRAINT "ctl_establecimiento_blh_personal_fk";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
ALTER TABLE "blh_banco_de_leche" DROP CONSTRAINT "fk_blh_banc_fk_establ_ctl_esta";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "ctl_departamento" DROP CONSTRAINT "fk_establecimiento";-- FOREIGN KEY (id_establecimiento_region) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_ctl_centro_recoleccion" DROP CONSTRAINT "fk_establecimiento_centro_recoleccion";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_empleado" DROP CONSTRAINT "fk_establecimiento_empleado";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "ctl_establecimiento" DROP CONSTRAINT "fk_establecimiento_establecimiento";-- FOREIGN KEY (id_establecimiento_padre) REFERENCES ctl_establecimiento(id)
ALTER TABLE "mnt_expediente" DROP CONSTRAINT "fk_establecimiento_expediente";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id)
ALTER TABLE "fos_user_user" DROP CONSTRAINT "fk_establecimiento_fos_user_user";-- FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_empleado" DROP CONSTRAINT "fk_establecmiento_empleado_ext";-- FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_estado_civil_donante";-- FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_estado_civil_paciente";-- FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id)

ALTER TABLE "ctl_establecimiento" DROP CONSTRAINT "fk_ctl_institucion_establecimiento";-- FOREIGN KEY (id_institucion) REFERENCES ctl_institucion(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_blh_dona_fk_munici_ctl_muni";-- FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "ctl_canton" DROP CONSTRAINT "fk_municipio_canton";-- FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id)
ALTER TABLE "ctl_establecimiento" DROP CONSTRAINT "fk_municipio_establecimiento";-- FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_municipio_paciente_domicilio";-- FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_municipio_paciente_nacimiento";-- FOREIGN KEY (id_municipio_nacimiento) REFERENCES ctl_municipio(id)

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_blh_dona_fk_nacionalidad_blh";-- FOREIGN KEY (nacionalidad) REFERENCES ctl_nacionalidad(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_nacionalidad_paciente";-- FOREIGN KEY (id_nacionalidad) REFERENCES ctl_nacionalidad(id)

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_ocupacio_donante";-- FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_ocupacion_paciente";-- FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT

ALTER TABLE "ctl_institucion" DROP CONSTRAINT "fk_3123f0d4f57d32fd";-- FOREIGN KEY (id_pais) REFERENCES ctl_pais(id)
ALTER TABLE "ctl_departamento" DROP CONSTRAINT "fk_pais_departamento";-- FOREIGN KEY (id_pais) REFERENCES ctl_pais(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_pais_paciente";-- FOREIGN KEY (id_pais_nacimiento) REFERENCES ctl_pais(id)

ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_parentesco_paciente_propor_datos";-- FOREIGN KEY (id_parentesco_propor_datos) REFERENCES ctl_parentesco(id)
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_parentesco_paciente_responsable";-- FOREIGN KEY (id_parentesco_responsable) REFERENCES ctl_parentesco(id)

ALTER TABLE "blh_historia_actual" DROP CONSTRAINT "fk_blh_his_fk_pat";-- FOREIGN KEY (patologia) REFERENCES ctl_patologia(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "blh_historial_clinico" DROP CONSTRAINT "fk_patologia_embarazo_historial_clinico";-- FOREIGN KEY (id_patologia_embarazo) REFERENCES ctl_patologia(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "ctl_patologia" DROP CONSTRAINT "fk_patologia_patologia";-- FOREIGN KEY (id_patologia_padre) REFERENCES ctl_patologia(id)

ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_sexo__paciente";-- FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id)

ALTER TABLE "ctl_establecimiento" DROP CONSTRAINT "fk_tipo_establecimiento_establecimiento";-- FOREIGN KEY (id_tipo_establecimiento) REFERENCES ctl_tipo_establecimiento(id)

ALTER TABLE "ctl_patologia" DROP CONSTRAINT "fk_tipo_patologia_patologia";-- FOREIGN KEY (id_tipo_patologia) REFERENCES ctl_tipo_patologia(id)

ALTER TABLE "mnt_empleado" DROP CONSTRAINT "fk_cargoempleados_empleado";-- FOREIGN KEY (id_cargo_empleado) REFERENCES mnt_cargoempleados(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "fos_user_user" DROP CONSTRAINT "fk_empleado_fos_user";-- FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE
ALTER TABLE "blh_lote_analisis" DROP CONSTRAINT "fk_responsable_analisis_lote_analisis";-- FOREIGN KEY (id_responsable_analisis) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "blh_donacion" DROP CONSTRAINT "fk_responsable_donacion_donacion";-- FOREIGN KEY (id_responsable_donacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "blh_pasteurizacion" DROP CONSTRAINT "fk_responsable_pasteurizacion_pasteurizacion";-- FOREIGN KEY (id_responsable_pasteurizacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "blh_solicitud" DROP CONSTRAINT "fk_responsable_solicitud";-- FOREIGN KEY (id_responsable_solicitud) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT

ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_expediente_donante";-- FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "blh_receptor" DROP CONSTRAINT "fk_expediente_receptor";-- FOREIGN KEY (id_expediente) REFERENCES mnt_expediente(id) ON UPDATE RESTRICT ON DELETE RESTRICT

ALTER TABLE "mnt_empleado" DROP CONSTRAINT "fk_tipo_empleado_empleado";-- FOREIGN KEY (id_tipo_empleado) REFERENCES mnt_tipo_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "blh_receptor" DROP CONSTRAINT "fk_blh_rece_fk_pacien_mnt_paci";-- FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT
ALTER TABLE "mnt_expediente" DROP CONSTRAINT "fk_paciente_expediente";-- FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id)

ALTER TABLE "fos_user_user_group" DROP CONSTRAINT "fk_b3c77447fe54d947";-- FOREIGN KEY (group_id) REFERENCES fos_user_group(id) ON UPDATE CASCADE ON DELETE RESTRICT

ALTER TABLE "fos_user_user_group" DROP CONSTRAINT "fk_b3c77447a76ed395";-- FOREIGN KEY (user_id) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE CASCADE
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_user_paciente";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "mnt_paciente" DROP CONSTRAINT "fk_user_paciente_mod";-- FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_acidez" DROP CONSTRAINT "fk_user_reg_acidez";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_analisis_microbiologico" DROP CONSTRAINT "fk_user_reg_analisis_microbiologico";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_analisis_sensorial" DROP CONSTRAINT "fk_user_reg_analisis_sensorial";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_banco_de_leche" DROP CONSTRAINT "fk_user_reg_banco_de_leche";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_bitacora" DROP CONSTRAINT "fk_user_reg_bitacora";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_ctl_centro_recoleccion" DROP CONSTRAINT "fk_user_reg_centro_recoleccion";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_crematocrito" DROP CONSTRAINT "fk_user_reg_crematocrito";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_curva" DROP CONSTRAINT "fk_user_reg_curva";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_donacion" DROP CONSTRAINT "fk_user_reg_donacion";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_donante" DROP CONSTRAINT "fk_user_reg_donante";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_egreso_receptor" DROP CONSTRAINT "fk_user_reg_egreso_receptor";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_estado" DROP CONSTRAINT "fk_user_reg_estado";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_examen" DROP CONSTRAINT "fk_user_reg_examen";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_examen_donante" DROP CONSTRAINT "fk_user_reg_examen_donante";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_frasco_procesado" DROP CONSTRAINT "fk_user_reg_frasco_procesado";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_frasco_procesado_solicitud" DROP CONSTRAINT "fk_user_reg_frasco_procesado_solicitud";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_frasco_recolectado" DROP CONSTRAINT "fk_user_reg_frasco_recolectado";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_frasco_recolectado_frasco_p" DROP CONSTRAINT "fk_user_reg_frasco_recolectado_frasco_p";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_grupo_solicitud" DROP CONSTRAINT "fk_user_reg_grupo_solicitud";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_historia_actual" DROP CONSTRAINT "fk_user_reg_historia_actual";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_historial_clinico" DROP CONSTRAINT "fk_user_reg_historial_clinico";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_informacion_publica" DROP CONSTRAINT "fk_user_reg_informacion_publica";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_lote_analisis" DROP CONSTRAINT "fk_user_reg_lote_analisis";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_menu" DROP CONSTRAINT "fk_user_reg_menu";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_opcion_menu" DROP CONSTRAINT "fk_user_reg_opcion_menu";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_pasteurizacion" DROP CONSTRAINT "fk_user_reg_pasteurizacion";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_personal" DROP CONSTRAINT "fk_user_reg_personal";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_receptor" DROP CONSTRAINT "fk_user_reg_receptor";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_rol" DROP CONSTRAINT "fk_user_reg_rol";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_rol_menu" DROP CONSTRAINT "fk_user_reg_rol_menu";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_seguimiento_receptor" DROP CONSTRAINT "fk_user_reg_seguimiento_receptor";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_solicitud" DROP CONSTRAINT "fk_user_reg_solicitud";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_temperatura_enfriamiento" DROP CONSTRAINT "fk_user_reg_temperatura_enfriamiento";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT
ALTER TABLE "blh_temperatura_pasteurizacion" DROP CONSTRAINT "fk_user_reg_temperatura_pasteurizacion";-- FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT




