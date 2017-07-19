 ?_switch_user=_exit
 ?_switch_user=test


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
php app/console doctrine:mapping:convert xml ./src/siblh/mantenimientoBundle/Resources/config/doctrine/metadata/orm --from-database --force


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
php app/console doctrine:generate:entities MinsalSiapsBundle --no-backup
php app/console doctrine:generate:entities MinsalSiblhBundle --no-backup
php app/console cache:clear
php app/console cache:clear --env=dev --no-warmup
php app/console cache:clear --env=prod
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console assets:install
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm/*
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiapsBundle/Entity/*

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiblhBundle/Resources/config/doctrine/metadata/orm/*
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiblhBundle/Entity/*

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
php app/console doctrine:mapping:convert xml ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Ctl"
php app/console doctrine:mapping:convert xml ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Mnt"
php app/console doctrine:mapping:import MinsalSiapsBundle annotation --filter="Ctl"
php app/console doctrine:mapping:import MinsalSiapsBundle annotation --filter="Mnt"
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm/FosUser*
rm -rf /home/farid/NetBeansProjects/siblh_sonata/src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm/Blh*
rm -rf src/Minsal/SiapsBundle/Entity/FosUser*
rm -rf src/Minsal/SiapsBundle/Entity/Blh*
php app/console doctrine:mapping:convert xml ./src/Minsal/SiblhBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Blh"
php app/console doctrine:mapping:import MinsalSiblhBundle annotation  --filter="Blh"

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Please choose a username:admin_farid
Please choose an email:dfhernandez@salud.gob.sv
Please choose a password:admincentral



****************************************************************************************************************************************************************
****************************************************************************************************************************************************************
select p.primer_nombre, p.primer_apellido, x.numero, xp.primer_nombre, xp.primer_apellido, xx.numero, s.fecha_hora_reg, s.programar_cita as cita, m.nombrearea from ryx_solicitud_estudio s left join mnt_expediente x on x.id = s.id_expediente left join mnt_paciente p on p.id = x.id_paciente left join mnt_expediente_referido xx on xx.id = s.id_expediente_referido left join mnt_paciente_referido xp on xp.id = xx.id_referido inner join ctl_area_servicio_diagnostico m on m.id = s.id_area_servicio_diagnostico order by s.id desc limit 10;
 
 select u.username, u.id_establecimiento as l_id, l.nombre as locale, u.id_empleado as e_id, e.nombre, e.apellido, t.tipo, t.codigo from fos_user_user u left join mnt_empleado e on e.id = u.id_empleado left join ctl_establecimiento l on l.id = u.id_establecimiento left join mnt_tipo_empleado t on t.id = e.id_tipo_empleado order by u.id desc limit 10;
 
 select p.primer_nombre, p.primer_apellido, x.numero, xp.primer_nombre, xp.primer_apellido, xx.numero, s.fecha_hora_reg, s.programar_cita as cita, m.nombrearea from ryx_solicitud_estudio s left join mnt_expediente x on x.id = s.id_expediente left join mnt_paciente p on p.id = x.id_paciente left join mnt_expediente_referido xx on xx.id = s.id_expediente_referido left join mnt_paciente_referido xp on xp.id = xx.id_referido inner join ctl_area_servicio_diagnostico m on m.id = s.id_area_servicio_diagnostico where s.programar_cita is true and not exists (select c.id from ryx_cita_programada c where s.id = c.id_solicitud_estudio) order by m.idarea, s.id desc limit 10;
 
 select s.id as s_id, s.fecha_hora_reg as s_fecha, concat(p.primer_nombre, ' ', p.primer_apellido) as p_nombre, x.numero as x_num, concat(xp.primer_nombre, ' ', xp.primer_apellido) as xp_nombre, xx.numero as xx_num, s.programar_cita as cita, c.id as c_id, c.fecha_hora_inicio as f_ini, c.fecha_hora_fin as f_fin, t.id as t_id, concat(t.nombre, ' ', t.apellido) as t_nombre, m.nombrearea from ryx_cita_programada c left join ryx_solicitud_estudio s on s.id = c.id_solicitud_estudio left join mnt_empleado t on t.id = c.id_tecnologo_programado left join mnt_expediente x on x.id = s.id_expediente left join mnt_paciente p on p.id = x.id_paciente left join mnt_expediente_referido xx on xx.id = s.id_expediente_referido left join mnt_paciente_referido xp on xp.id = xx.id_referido left join ctl_area_servicio_diagnostico m on m.id = s.id_area_servicio_diagnostico where s.programar_cita is true order by c.id desc limit 10;
 
 select s.id as s_id, s.fecha_hora_reg as s_fecha, concat(p.primer_nombre, ' ', p.primer_apellido) as p_nombre, x.numero as x_num, s.programar_cita as cita, c.id as c_id, c.fecha_hora_inicio as f_ini, c.fecha_hora_fin as f_fin, trim(both from sc.nombre) as estado, t.id as t_id, concat(t.nombre, ' ', t.apellido) as t_nombre, m.idarea from ryx_cita_programada c left join ryx_solicitud_estudio s on s.id = c.id_solicitud_estudio left join mnt_empleado t on t.id = c.id_tecnologo_programado left join mnt_expediente x on x.id = s.id_expediente left join mnt_paciente p on p.id = x.id_paciente left join ctl_area_servicio_diagnostico m on m.id = s.id_area_servicio_diagnostico inner join ryx_ctl_estado_cita sc on sc.id = c.id_estado_cita where s.programar_cita is true order by c.id desc limit 20;


 //////////////// RECEPTORES
 select id_banco_de_leche as blh, id_paciente as pct, fecha_registro_blh as fecha_reg, procedencia as proc, estado_receptor as std, edad_dias as dias, peso_receptor as peso, duracion_cpap as cpap, clasificacion_lubchengo as lubch, diagnostico_ingreso, duracion_npt as npt, apgar_primer_minuto as apgar1, edad_gest_fur as gest_fur, duracion_ventilacion as vent, edad_gest_ballard as ballard, pc, talla_ingreso as talla, apgar_quinto_minuto as apgar5, usuario as usr from blh_receptor;



/****************************************************************************************************************************************************************
****************************************************************************************************************************************************************/
php app/console doctrine:mapping:convert xml ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Ctl"
php app/console doctrine:mapping:convert xml ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Mnt"
rm -rf ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm/FosUser*
rm -rf ./src/Minsal/SiapsBundle/Resources/config/doctrine/metadata/orm/Blh*
rm -rf src/Minsal/SiapsBundle/Entity/FosUser*
rm -rf src/Minsal/SiapsBundle/Entity/Blh*
php app/console doctrine:mapping:convert xml ./src/Minsal/SiblhBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Blh"
php app/console doctrine:generate:entities MinsalSiapsBundle --no-backup
php app/console doctrine:generate:entities MinsalSiblhBundle --no-backup
