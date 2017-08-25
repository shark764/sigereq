-- Function: fn_trg_actualizar_inventario_material_utilizado()

-- DROP FUNCTION fn_trg_actualizar_inventario_material_utilizado();

CREATE OR REPLACE FUNCTION fn_trg_actualizar_inventario_material_utilizado()
  RETURNS trigger AS
$BODY$
		declare mtrLc_id 	integer;	-- id de registro de material en local
				std_rz 		integer;	-- Establecimiento donde se realizó el estudio
				rz_id 		integer;	-- id de registro de examen, basado en TG_OP

		begin

			--establecer caso de desencadenado
			if (TG_OP = 'DELETE') then
			    rz_id := old.id_procedimiento_realizado;
			else
			    rz_id := new.id_procedimiento_realizado;
			end if;
			
			--Consultar establecimiento donde se realiza estudio
			std_rz := (
				select
					case
					    when "prz"."id_solicitud_estudio" is not null then
							"prc"."id_establecimiento_referido"
					    when "prz"."id_solicitud_estudio_complementario" is not null then
							"solcmpl"."id_establecimiento_solicitado"
					    when "prz"."id_cita_programada" is not null then
							"cit"."id_establecimiento"
					    when "prz"."id_user_reg" is not null then
							"usRg"."id_establecimiento"
					    else
							null
					end
			    from "ryx_procedimiento_radiologico_realizado" "prz"
					left join "ryx_solicitud_estudio" "prc" on "prc"."id" = "prz"."id_solicitud_estudio"
					left join "ryx_solicitud_estudio_complementario" "solcmpl" on "solcmpl"."id" = "prz"."id_solicitud_estudio_complementario"
					left join "ryx_cita_programada" "cit" on "cit"."id" = "prz"."id_cita_programada"
					left join "fos_user_user" "usRg" on "usRg"."id" = "prz"."id_user_reg"
			    where "prz"."id" = rz_id
			);
			
			--Aumentar cantidad en DELETE
			if (TG_OP = 'DELETE') then
			    --Actualizar cantidad en inventario
			    update "ryx_ctl_material_establecimiento"
			    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) + coalesce(old.utilizado, 0)
			    where "id_material" = old.id_material and "id_establecimiento" = std_rz;

			    return old;
			--Actualizar cantidad en UPDATE
			elsif (TG_OP = 'UPDATE') then
			    --Actualizar cantidad en inventario
			    update "ryx_ctl_material_establecimiento"
			    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) + coalesce(old.utilizado, 0) - coalesce(new.utilizado, 0)
			    where "id_material" = new.id_material and "id_establecimiento" = std_rz;

			    return new;
			--Actualizar cantidad en INSERT
			elsif (TG_OP = 'INSERT') then
			    --Actualizar cantidad en inventario
			    update "ryx_ctl_material_establecimiento"
			    set "cantidad_disponible" = coalesce("cantidad_disponible", 0) - coalesce(new.utilizado, 0)
			    where "id_material" = new.id_material and "id_establecimiento" = std_rz;

			    return new;
			end if;
			
			return null; -- result is ignored since this is an AFTER trigger
		end;
	$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_trg_actualizar_inventario_material_utilizado()
  OWNER TO siap;
