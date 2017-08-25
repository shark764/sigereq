-- Function: fn_trg_anexar_pendiente_lectura_estudio()

-- DROP FUNCTION fn_trg_anexar_pendiente_lectura_estudio();

CREATE OR REPLACE FUNCTION fn_trg_anexar_pendiente_lectura_estudio()
  RETURNS trigger AS
$BODY$
        declare diag_insertado integer;     --id del registro de diagnóstico
                diag_estado integer;        --estado del diagnóstico
                pndL_insertado integer[] = '{}';--id del registro en lista de lectura
                pndT_insertado integer;     --id del registro en lista de transcripción
                post_estudio boolean := false;  --representa si la solicitud fue post-estudio
                est_leidos integer[] = '{}';    --id del registro de estudios leidos
                lct_estado integer;         -- estado de la lectura
                lct_estab integer;      -- establecimiento en el que se da lectura
                envio_radiologo boolean := false; --representa si la solicitud fue por radiólogo
                radiologo_solicita integer; --radiólogo que ingresa en lista
                est_principal integer;      --id del estudio principal
                solicitud_diagnostico integer;  --id de la solicitud de diagnóstico
                
                status_lct_cod character(3);    --código del estado del registro de lectura

                worklist_data_RECORD RECORD;    --registro utilizado para portabilidad, almacena lo que contendrán las listas de trabajo
                -- procesando boolean := false; --se encuentra activo el registro
                -- empleado_procesando integer;         --id del empleado procesando

        begin

            --Obtener el objeto del registro de lectura padre
            select case when ("solcmpl"."id" is not null) then "solcmpl"."id_area_servicio_diagnostico" else "prc"."id_area_servicio_diagnostico" end as "id_area_servicio_diagnostico",
                    "lct"."id_expediente" as "id_expediente",
                    "lct"."id_expediente_referido" as "id_expediente_referido",
                    "prc"."id_aten_area_mod_estab" as "id_aten_area_mod_estab",
                    case when ("solcmpl"."id" is not null) then "solcmpl"."id_establecimiento_solicitado" else "prc"."id_establecimiento_origen" end as "id_establecimiento_origen",
                    case when ("solcmpl"."id" is not null) then "solcmpl"."id_prioridad_atencion" else "prc"."id_prioridad_atencion" end as "id_prioridad_atencion"
                into worklist_data_RECORD
            from "ryx_lectura_radiologica" as "lct"
                inner join "ryx_estudio_por_imagenes" as "est" on "est"."id" = "lct"."id_estudio"
                inner join "ryx_procedimiento_radiologico_realizado" as "prz" on "prz"."id" = "est"."id_procedimiento_realizado"
                inner join "ryx_solicitud_estudio" as "prc" on "prc"."id" = "prz"."id_solicitud_estudio"
                left join "ryx_solicitud_estudio_complementario" as "solcmpl" on "solcmpl"."id" = "prz"."id_solicitud_estudio_complementario"
            where "lct"."id" = new.id_lectura;

            --Obtener el id y estado del registro de diagnóstico, si existe
            select "lct"."id_establecimiento", "lct"."id_estado_lectura", "lct"."solicitada_por_radiologo",
                "lct"."id_radiologo_solicita", "lct"."id_estudio", "lct"."id_solicitud_diagnostico", "statusLct"."codigo"
                into lct_estab, lct_estado, envio_radiologo, radiologo_solicita, est_principal, solicitud_diagnostico, status_lct_cod
            from "ryx_lectura_radiologica" as "lct"
            inner join "ryx_ctl_estado_lectura" as "statusLct"
                on "statusLct"."id" = "lct"."id_estado_lectura"
            where "lct"."id" = new.id_lectura;
            
            if est_principal is null then
                est_principal := new.id_estudio;
            end if;

            --Obtener el id del registro en lista de lectura, si existe
            pndL_insertado := array(
                select "pndL"."id"
                from "ryx_estudio_pendiente_lectura" as "pndL"
                where "pndL"."id_estudio" = est_principal
            );
            
            --Solicitud pre o post-estudio
            if (exists (
                    select "id"
                    from "ryx_solicitud_diagnostico_post_estudio"
                    where "id_estudio" = est_principal)) or envio_radiologo is true then
                post_estudio := true;
            end if;
            
            if status_lct_cod <> 'LDO' then
                if (array_length(pndL_insertado, 1) is not null) then
                    --Actualizar lista de trabajo
                    update ryx_estudio_pendiente_lectura
                    set fecha_ingreso_lista = now()::timestamp(0),
                        id_establecimiento = lct_estab,
                        anexado_por_radiologo = envio_radiologo,
                        id_radiologo_anexa = radiologo_solicita,
                        id_radiologo_asignado = radiologo_solicita,
                        id_asigna_radiologo = radiologo_solicita,
                        id_solicitud_diagnostico = solicitud_diagnostico,
                        solicitud_post_estudio = post_estudio
                    where ("id" = any(pndL_insertado::integer[]) and "id_estudio" = est_principal) or "id_estudio" = new.id_estudio;
                else
                    --Ingresar a lista de pendientes del establecimiento diagnosticante
                    insert into ryx_estudio_pendiente_lectura
                        (
                            id_establecimiento,
                            id_estudio,
                            solicitud_post_estudio,
                            anexado_por_radiologo,
                            id_radiologo_anexa,
                            id_radiologo_asignado,
                            id_solicitud_diagnostico,
                            id_asigna_radiologo,
                            id_area_servicio_diagnostico,
                            id_expediente,
                            id_expediente_referido,
                            id_aten_area_mod_estab,
                            id_establecimiento_origen,
                            id_prioridad_atencion
                        )
                        values
                        (
                            lct_estab,
                            est_principal,
                            post_estudio,
                            envio_radiologo,
                            radiologo_solicita,
                            radiologo_solicita,
                            solicitud_diagnostico,
                            radiologo_solicita,
                            worklist_data_RECORD.id_area_servicio_diagnostico,
                            worklist_data_RECORD.id_expediente,
                            worklist_data_RECORD.id_expediente_referido,
                            worklist_data_RECORD.id_aten_area_mod_estab,
                            worklist_data_RECORD.id_establecimiento_origen,
                            worklist_data_RECORD.id_prioridad_atencion
                        );
                end if;
            else
                --Extraer de lista de Lectura (Se ha confirmado como leido)
                delete from ryx_estudio_pendiente_lectura where ("id" = any(pndL_insertado::integer[]) and "id_estudio" = est_principal) or "id_estudio" = new.id_estudio;
            end if;
            
            return new;
        end;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_trg_anexar_pendiente_lectura_estudio()
  OWNER TO siap;
