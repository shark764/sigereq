--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
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

--
-- Name: fn_actualizar_donante(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_actualizar_donante() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare vedad integer;
begin
 select fn_calcular_edad(new.fecha_nacimiento::date) into vedad ;
new.edad = vedad;

return new;
end;
$$;


ALTER FUNCTION public.fn_actualizar_donante() OWNER TO siblh;

--
-- Name: fn_after_acidez(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_acidez() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN

		IF NEW.resultado < 8    THEN
			UPDATE blh_frasco_recolectado SET ID_ESTADO = 5,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		ELSE
			UPDATE blh_frasco_recolectado SET ID_ESTADO = 10,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		END IF;	
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN

		IF NEW.resultado < 8    THEN
			UPDATE blh_frasco_recolectado SET ID_ESTADO = 5,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		ELSE
			UPDATE blh_frasco_recolectado SET ID_ESTADO = 10,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		END IF;	
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_acidez() OWNER TO siblh;

--
-- Name: fn_after_analisis_microbiologico(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_analisis_microbiologico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;

	ELSIF (TG_OP = 'UPDATE') THEN
		--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
			IF new.situacion = 'Acepta' THEN

				UPDATE blh_frasco_procesado SET ID_ESTADO=2, USUARIO = user_id  where 
				id =(select new.id_frasco_procesado from blh_analisis_microbiologico
				where ID=NEW.ID);
				    
			     END IF;

			     IF new.situacion = 'Rechaza' THEN

				UPDATE blh_frasco_procesado SET ID_ESTADO=4, USUARIO = user_id  where 
				id =(select new.id_frasco_procesado from blh_analisis_microbiologico
				where ID=NEW.ID);

			    END IF;

			     IF new.situacion = 'Resiembra' THEN

				UPDATE blh_frasco_procesado SET ID_ESTADO=9, USUARIO = user_id  where 
				id =(select new.id_frasco_procesado from blh_analisis_microbiologico
				where ID=NEW.ID);
			      END IF;
			  
			      IF new.control=  'Positivo' THEN
			      UPDATE blh_frasco_procesado SET ID_ESTADO=14, USUARIO = user_id  where 
				id =(select new.id_frasco_procesado from blh_analisis_microbiologico
				where ID=NEW.ID);
			    END IF;
			  
				 IF new.control=  'Negativo' THEN
			      UPDATE blh_frasco_procesado SET ID_ESTADO=2, USUARIO = user_id where 
				id =(select new.id_frasco_procesado from blh_analisis_microbiologico
				where ID=NEW.ID);     
				    
			     END IF;
				    
			   
			--TABLA ESTADO.              
			--estado 2;"liberado"
			--estado 3;"pasteurizado"
			--estado 4; "RechazadoMI"
			--estado 14;"RechazadoR"
			--estado 9; "AnalizadoR"





			--En estado 3 debe estar los frascos de tabla frasco procesado
		--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;

	ELSIF (TG_OP = 'INSERT') THEN
		--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		    IF new.situacion = 'Acepta' THEN

			UPDATE blh_frasco_procesado SET ID_ESTADO=2, USUARIO = user_id  where 
			id =(select new.id_frasco_procesado from blh_analisis_microbiologico
			where ID=NEW.ID);
			    
		     END IF;

		     IF new.situacion = 'Rechaza' THEN

			UPDATE blh_frasco_procesado SET ID_ESTADO=4, USUARIO = user_id  where 
			id =(select new.id_frasco_procesado from blh_analisis_microbiologico
			where ID=NEW.ID);

		    END IF;

		     IF new.situacion = 'Resiembra' THEN

			UPDATE blh_frasco_procesado SET ID_ESTADO=9, USUARIO = user_id  where 
			id =(select new.id_frasco_procesado from blh_analisis_microbiologico
			where ID=NEW.ID);
		      END IF;
		  
		    
		--TABLA ESTADO.              
		--estado 2;"liberado"
		--estado 1;"pasteurizado"
		--estado 4; "RechazadoMI"
		--estado 14;"RechazadoR"
		--estado 9; "AnalizadoR"


		--En estado 3 debe estar los frascos de tabla frasco procesado

        
		--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_analisis_microbiologico() OWNER TO siblh;

--
-- Name: fn_after_analisis_sensorial(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_analisis_sensorial() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		--Obtenemos el id a usar en el registro a insertar en la bitacora
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		IF ((NEW.embalaje = 'Aprobado') AND (NEW.suciedad = 'Aprobado')  AND (NEW.color = 'Aprobado') AND (NEW.flavor = 'Aprobado'))   THEN
		    UPDATE blh_frasco_recolectado SET ID_ESTADO = 7,USUARIO = NEW.usuario WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		ELSE
		    IF NEW.embalaje = 'Reprobado'
		    THEN
		      UPDATE blh_frasco_recolectado SET ID_ESTADO = 15,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
		    ELSE
			IF NEW.suciedad = 'Reprobado'
			THEN
			 UPDATE blh_frasco_recolectado SET ID_ESTADO = 16,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			ELSE
			   IF NEW.color = 'Reprobado'
			THEN
			 UPDATE blh_frasco_recolectado SET ID_ESTADO = 17,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			ELSE
			   IF NEW.flavor = 'Reprobado'
			   THEN
			     UPDATE blh_frasco_recolectado SET ID_ESTADO = 18,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			   END IF;
			  END IF; 
			END IF;
		     END IF;     
		END IF;
		--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--

		--Obtenemos el id a usar en el registro a insertar en la bitacora
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		IF ((NEW.embalaje = 'Aprobado') AND (NEW.suciedad = 'Aprobado')  AND (NEW.color = 'Aprobado') AND (NEW.flavor = 'Aprobado'))   THEN
		    UPDATE blh_frasco_recolectado SET ID_ESTADO = 7,USUARIO = NEW.usuario WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		ELSE
		    IF NEW.embalaje = 'Reprobado'
		    THEN
		      UPDATE blh_frasco_recolectado SET ID_ESTADO = 15,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
		    ELSE
			IF NEW.suciedad = 'Reprobado'
			THEN
			 UPDATE blh_frasco_recolectado SET ID_ESTADO = 16,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			ELSE
			   IF NEW.color = 'Reprobado'
			THEN
			 UPDATE blh_frasco_recolectado SET ID_ESTADO = 17,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			ELSE
			   IF NEW.flavor = 'Reprobado'
			   THEN
			     UPDATE blh_frasco_recolectado SET ID_ESTADO = 18,USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO; 
			   END IF;
			  END IF; 
			END IF;
		     END IF;     
		END IF;
		--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
		--Obtenemos el id a usar en el registro a insertar en la bitacora
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_analisis_sensorial() OWNER TO siblh;

--
-- Name: fn_after_banco_de_leche(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_banco_de_leche() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_banco_de_leche() OWNER TO siblh;

--
-- Name: fn_after_crematocrito(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_crematocrito() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		UPDATE blh_frasco_recolectado SET ID_ESTADO = 6, USUARIO = user_id WHERE ID=NEW.ID_FRASCO_RECOLECTADO;
		--Obtenemos el id a usar en el registro a insertar en la bitacora
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_crematocrito() OWNER TO siblh;

--
-- Name: fn_after_curva(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_curva() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_curva() OWNER TO siblh;

--
-- Name: fn_after_donacion(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_donacion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_donacion() OWNER TO siblh;

--
-- Name: fn_after_donante(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_donante() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_donante() OWNER TO siblh;

--
-- Name: fn_after_egreso_receptor(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_egreso_receptor() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_egreso_receptor() OWNER TO siblh;

--
-- Name: fn_after_examen(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_examen() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_examen() OWNER TO siblh;

--
-- Name: fn_after_examen_donante(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_examen_donante() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_examen_donante() OWNER TO siblh;

--
-- Name: fn_after_fos_user_user(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_fos_user_user() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_fos_user_user() OWNER TO siblh;

--
-- Name: fn_after_frasco_procesado(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_frasco_procesado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_frasco_procesado() OWNER TO siblh;

--
-- Name: fn_after_frasco_procesado_solicitud(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_frasco_procesado_solicitud() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_frasco_procesado_solicitud() OWNER TO siblh;

--
-- Name: fn_after_frasco_recolectado(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_frasco_recolectado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		----------Antigua funcion estado
					-- Verifica que el volumen se haya dado
					IF NEW.onz_recolectado ISNULL THEN
					    RAISE EXCEPTION 'volumen no puede ser NULL';
				      
					END IF;

					-- Que no tenga volumen menor a 1 onz 
					IF NEW.onz_recolectado >= 1 THEN
					    UPDATE blh_frasco_recolectado SET ID_ESTADO = 1, USUARIO = user_id WHERE ID=NEW.ID;
					ELSE
					    UPDATE blh_frasco_recolectado SET ID_ESTADO = 4, USUARIO = user_id WHERE ID=NEW.ID;

					    --Estado 1= prealmacenado
					    --Estado 2= rechazado
					    --Estado 3= inactivo 
					END IF;
					-- Ahora actualizamos o almacenamos.
					--NEW.id_estado := 1;
		----------Fin funcion estado
		SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_frasco_recolectado() OWNER TO siblh;

--
-- Name: fn_after_frasco_recolectado_frasco_p(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_frasco_recolectado_frasco_p() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_frasco_recolectado_frasco_p() OWNER TO siblh;

--
-- Name: fn_after_grupo_solicitud(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_grupo_solicitud() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_grupo_solicitud() OWNER TO siblh;

--
-- Name: fn_after_historia_actual(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_historia_actual() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_historia_actual() OWNER TO siblh;

--
-- Name: fn_after_historial_clinico(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_historial_clinico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_historial_clinico() OWNER TO siblh;

--
-- Name: fn_after_lote_analisis(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_lote_analisis() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_lote_analisis() OWNER TO siblh;

--
-- Name: fn_after_pasteurizacion(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_pasteurizacion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_pasteurizacion() OWNER TO siblh;

--
-- Name: fn_after_personal(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_personal() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_personal() OWNER TO siblh;

--
-- Name: fn_after_receptor(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_receptor() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	codigo = 'APLICACION';
	
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		codigo = 'DATA BASE';
	END IF;
	
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; -- result is ignored since this is an AFTER trigger

end;

$$;


ALTER FUNCTION public.fn_after_receptor() OWNER TO siblh;

--
-- Name: fn_after_seguimiento_receptor(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_seguimiento_receptor() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_seguimiento_receptor() OWNER TO siblh;

--
-- Name: fn_after_solicitud(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_solicitud() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_solicitud() OWNER TO siblh;

--
-- Name: fn_after_temperatura_enfriamiento(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_temperatura_enfriamiento() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_temperatura_enfriamiento() OWNER TO siblh;

--
-- Name: fn_after_temperatura_pasteurizacion(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_after_temperatura_pasteurizacion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare contador integer;
  declare user_name varchar(20);
  declare user_id integer;
  declare codigo varchar(20);
begin
	--El cambio fue realizado desde la aplicación, aplica para INSERT y UPDATE ya que desde la aplicación no se puede eliminar nada
	codigo = 'APLICACION';
	IF (TG_OP = 'UPDATE') OR (TG_OP = 'INSERT') THEN
		user_id = COALESCE(NEW.usuario,-1);
		SELECT COALESCE(username,user) INTO user_name FROM fos_user_user WHERE ID = NEW.usuario;
	ELSE
		user_id = -1;
	END IF;
		
	IF user_id = -1 THEN
		--El cambio fue realizado dede la base de datos, aplica para eliminación ya que desde la aplicación no se permite eliminar nada
		codigo = 'DATA BASE';
	END IF;
	
	--Obtenemos el id a usar en el registro a insertar en la bitacora
	SELECT COALESCE(MAX(id),0)+1 INTO contador FROM blh_bitacora;
	
	--Obtenemos el usuario que esta realizando el cambio, INSERT y UPDATE se toma de la aplicación mientras que para eliminación es un usuario de la base de datos
	user_name =  COALESCE(user_name,user);
	
	IF (TG_OP = 'DELETE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'D', 'DELETE' || OLD);
		RETURN NEW;
	ELSIF (TG_OP = 'UPDATE') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'U', 'UPDATE' || NEW);
		RETURN NEW;
	ELSIF (TG_OP = 'INSERT') THEN
		INSERT INTO blh_bitacora(id, fecha_accion, codigo, tabla, usuario, accion, detalle)
		VALUES (contador, now(), codigo, TG_TABLE_NAME , user_name, 'I', 'INSERT' || NEW);
		RETURN NEW;
	END IF;
	RETURN NULL; 

end;
$$;


ALTER FUNCTION public.fn_after_temperatura_pasteurizacion() OWNER TO siblh;

--
-- Name: fn_calcular_edad(date); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_calcular_edad(p_fecha_nacimiento date) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare 
edad integer;
BEGIN
edad := FLOOR(((DATE_PART('YEAR',CURRENT_DATE)-DATE_PART('YEAR',p_fecha_nacimiento))* 365 + 
(DATE_PART('MONTH',CURRENT_DATE) - DATE_PART('MONTH',p_fecha_nacimiento))*31 + 
(DATE_PART('DAY',CURRENT_DATE)-DATE_PART('DAY',p_fecha_nacimiento)))/365);
return edad;
END;

$$;


ALTER FUNCTION public.fn_calcular_edad(p_fecha_nacimiento date) OWNER TO siblh;

--
-- Name: fn_calcularcurva(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_calcularcurva() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

declare evalor numeric(3,1);
    BEGIN

select fn_curva(new.tiempo1::numeric(3,1),new.tiempo2::numeric(3,1),new.tiempo3::numeric(3,1)) into evalor;
new.valor_curva=evalor;

        RETURN NEW;
    END;
  $$;


ALTER FUNCTION public.fn_calcularcurva() OWNER TO siblh;

--
-- Name: fn_curva(numeric, numeric, numeric); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_curva(tiempo1 numeric, tiempo2 numeric, tiempo3 numeric) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
declare 
valor numeric(3,1);
BEGIN
valor:= ROUND(((tiempo1 + tiempo2 +tiempo3)/3 ),1);
return valor;
END;
$$;


ALTER FUNCTION public.fn_curva(tiempo1 numeric, tiempo2 numeric, tiempo3 numeric) OWNER TO siblh;

--
-- Name: fn_estado_receptor(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_estado_receptor() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    BEGIN
      

        UPDATE blh_receptor SET estado_receptor='Egreso' where
        id =(select id_receptor from blh_egreso_receptor
        where ID=NEW.ID); 
      
       -- Ahora actualizamos o almacenamos.
        RETURN NEW;
    END;
$$;


ALTER FUNCTION public.fn_estado_receptor() OWNER TO siblh;

--
-- Name: fn_generar_cod_donante(integer, integer); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_donante(id_blh integer, anio integer) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare
codigo varchar (14);
 maximo varchar(5);
 siguiente integer;
 siguiente2 integer;
 id_blh2 varchar(3);
begin
id_blh2 = LPAD(id_blh::text,2,'0')||'%';
select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from  (select to_number(substring(codigo_donante,5,6),'99999') correlativo from blh_donante 
where
codigo_donante like id_blh2
and to_number(substring(codigo_donante,11,4),'99999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo = (select LPAD(id_blh::text,2,'0'))|| '-' || 'D' || maximo || '-' || anio;
return codigo;
end;
$$;


ALTER FUNCTION public.fn_generar_cod_donante(id_blh integer, anio integer) OWNER TO siblh;

--
-- Name: fn_generar_cod_frasco_procesado(integer, integer); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_frasco_procesado(id_blh integer, anio integer) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare
codigo varchar (15);
 maximo varchar(5);
 siguiente integer;
 siguiente2 integer;
 id_blh2 varchar(3);
begin
id_blh2 = LPAD(id_blh::text,2,'0')||'%';
select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from  (select to_number(substring(codigo_frasco_procesado,6,5),'99999') correlativo from blh_frasco_procesado 
where
codigo_frasco_procesado like id_blh2
and to_number(substring(codigo_frasco_procesado,12,4),'99999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo = (select LPAD(id_blh::text,2,'0'))|| '-' || 'FP' || maximo || '-' || anio;
return codigo;
end;
$$;


ALTER FUNCTION public.fn_generar_cod_frasco_procesado(id_blh integer, anio integer) OWNER TO siblh;

--
-- Name: fn_generar_cod_frasco_recolectado(integer, integer); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_frasco_recolectado(id_blh integer, anio integer) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare
codigo varchar (15);
 maximo varchar(5);
 siguiente integer;
 siguiente2 integer;
 id_blh2 varchar(3);
begin
id_blh2 = LPAD(id_blh::text,2,'0')||'%';
select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from  (select to_number(substring(codigo_frasco_recolectado,6,5),'99999') correlativo from blh_frasco_recolectado 
where
codigo_frasco_recolectado like id_blh2
and to_number(substring(codigo_frasco_recolectado,12,4),'99999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo = (select LPAD(id_blh::text,2,'0'))|| '-' || 'FR' || maximo || '-' || anio;
return codigo;
end;
$$;


ALTER FUNCTION public.fn_generar_cod_frasco_recolectado(id_blh integer, anio integer) OWNER TO siblh;

--
-- Name: fn_generar_cod_microbiologico(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_microbiologico() RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare codigo varchar (13);      
declare maximo varchar(5);
declare anio2 varchar (4);       
declare anio integer;
begin

anio2 = extract(year from current_date);
anio = to_number (anio2, '9999');

select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from
(select to_number(substring(codigo_analisis_microbiologico,4,5),'99999') correlativo from blh_analisis_microbiologico
where
to_number(substring(codigo_analisis_microbiologico,10,4),'9999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo =  'AM-'|| maximo || '-' || anio;
return codigo;
end;
$$;


ALTER FUNCTION public.fn_generar_cod_microbiologico() OWNER TO siblh;

--
-- Name: fn_generar_cod_receptor(integer, integer); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_receptor(id_blh integer, anio integer) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare codigo varchar (14);
 declare maximo varchar(5);
 declare siguiente integer;
 declare siguiente2 integer;
 declare id_blh2 varchar(3);
begin
id_blh2 = LPAD(id_blh::text,2,'0')||'%';
select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from  (select to_number(substring(codigo_receptor,5,6),'99999') correlativo from blh_receptor 
where
codigo_receptor like id_blh2
and to_number(substring(codigo_receptor,11,4),'99999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo = (select LPAD(id_blh::text,2,'0'))|| '-' || 'R' || maximo || '-' || anio;
return codigo;
end;
$$;


ALTER FUNCTION public.fn_generar_cod_receptor(id_blh integer, anio integer) OWNER TO siblh;

--
-- Name: fn_generar_cod_solicitud(integer, integer); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_generar_cod_solicitud(id_blh integer, anio integer) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
declare
codigo varchar (14);
 maximo varchar(5);
 siguiente integer;
 siguiente2 integer;
 id_blh2 varchar(3);
begin
id_blh2 = LPAD(id_blh::text,2,'0')||'%';
select LPAD((max(h.correlativo)+1)::text,5,'0') as max_corr into maximo from  (select to_number(substring(codigo_solicitud,5,6),'99999') correlativo from blh_solicitud 
where
codigo_solicitud like id_blh2
and to_number(substring(codigo_solicitud,11,4),'99999') = anio) as h;

if maximo is null
then 
    maximo = '00001';
end if;

codigo = (select LPAD(id_blh::text,2,'0'))|| '-' || 'S' || maximo || '-' || anio;
return codigo;
end;$$;


ALTER FUNCTION public.fn_generar_cod_solicitud(id_blh integer, anio integer) OWNER TO siblh;

--
-- Name: fn_insertar_donante(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_donante() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare codigo varchar(14);
  declare vedad integer;
begin
 select fn_generar_cod_donante(new.id_banco_de_leche::integer,extract(year from current_date)::integer) into codigo ;
new.codigo_donante = codigo;
select fn_calcular_edad(new.fecha_nacimiento::date) into vedad ;
new.edad = vedad;

return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_donante() OWNER TO siblh;

--
-- Name: fn_insertar_fprocesado(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_fprocesado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare codigo varchar(15);
   declare cod integer;
   declare pasteurizacion integer;
begin
pasteurizacion= new.id_pasteurizacion::integer;
select substring(codigo_pasteurizacion from 1 for 2)::integer as codi from blh_pasteurizacion where id = pasteurizacion into cod;
select fn_generar_cod_frasco_procesado
(cod,extract(year from current_date)::integer) into codigo ;
new.codigo_frasco_procesado = codigo;
return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_fprocesado() OWNER TO siblh;

--
-- Name: fn_insertar_frecolectado(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_frecolectado() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare codigo varchar(15);
   declare cod integer;
   declare donante integer;
begin
donante = new.id_donante::integer;
select substring(codigo_donante from 1 for 2)::integer as codi from blh_donante where id = donante into cod;
select fn_generar_cod_frasco_recolectado
(cod,extract(year from current_date)::integer) into codigo ;
new.codigo_frasco_recolectado = codigo;
new.volumen_disponible_fr = new.volumen_recolectado;
return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_frecolectado() OWNER TO siblh;

--
-- Name: fn_insertar_frecolectado_ciclo(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_frecolectado_ciclo() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
   declare ciclo integer;
   declare curva integer;
  begin
curva = new.id_curva::integer;
select coalesce(max(num_ciclo), 0) from blh_pasteurizacion where id_curva = curva into ciclo;
new.num_ciclo = ciclo +1;
return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_frecolectado_ciclo() OWNER TO siblh;

--
-- Name: fn_insertar_receptor(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_receptor() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare codigo varchar(14);

begin
 select fn_generar_cod_receptor(new.id_banco_de_leche::integer,extract(year from current_date)::integer) into codigo ;
new.codigo_receptor = codigo;
return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_receptor() OWNER TO siblh;

--
-- Name: fn_insertar_solicitud(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION fn_insertar_solicitud() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
  declare codigo varchar(14);
  declare idblh varchar(2);
  
begin
select substring(blh_receptor.codigo_receptor from 1 for 2) from blh_receptor where blh_receptor.id = new.id_receptor into idblh;
select fn_generar_cod_solicitud(idblh::integer,extract(year from current_date)::integer) into codigo ;
new.codigo_solicitud = codigo;
return new;
end;
$$;


ALTER FUNCTION public.fn_insertar_solicitud() OWNER TO siblh;

--
-- Name: generar_codigo_microbiologico(); Type: FUNCTION; Schema: public; Owner: siblh
--

CREATE FUNCTION generar_codigo_microbiologico() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

declare codigo varchar(13);
    BEGIN


select fn_generar_cod_microbiologico() into codigo;
new.codigo_analisis_microbiologico=codigo;

        
        -- Ahora actualizamos o almacenamos.
        RETURN NEW;
    END;
$$;


ALTER FUNCTION public.generar_codigo_microbiologico() OWNER TO siblh;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: blh_acidez; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_acidez (
    id integer NOT NULL,
    id_frasco_recolectado integer NOT NULL,
    acidez1 integer NOT NULL,
    acidez2 integer NOT NULL,
    acidez3 integer NOT NULL,
    factor numeric(6,4) NOT NULL,
    resultado numeric(6,4) NOT NULL,
    media_acidez numeric(6,4) NOT NULL,
    usuario integer,
    id_user_reg integer,
    fecha_hora_reg timestamp without time zone
);


ALTER TABLE blh_acidez OWNER TO siblh;

--
-- Name: blh_acidez_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_acidez_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_acidez_id_seq OWNER TO siblh;

--
-- Name: blh_acidez_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_acidez_id_seq OWNED BY blh_acidez.id;


--
-- Name: blh_analisis_microbiologico; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_analisis_microbiologico (
    id integer NOT NULL,
    id_frasco_procesado integer NOT NULL,
    codigo_analisis_microbiologico character varying(13) NOT NULL,
    coliformes_totales character varying(8),
    control character varying(8),
    situacion character varying(9),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_analisis_microbiologico OWNER TO siblh;

--
-- Name: blh_analisis_microbiologico_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_analisis_microbiologico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_analisis_microbiologico_id_seq OWNER TO siblh;

--
-- Name: blh_analisis_microbiologico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_analisis_microbiologico_id_seq OWNED BY blh_analisis_microbiologico.id;


--
-- Name: blh_analisis_sensorial; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_analisis_sensorial (
    id integer NOT NULL,
    embalaje character varying(9),
    suciedad character varying(9),
    color character varying(9),
    flavor character varying(9),
    observacion character varying(150),
    usuario integer,
    id_frasco_recolectado integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_analisis_sensorial OWNER TO siblh;

--
-- Name: blh_analisis_sensorial_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_analisis_sensorial_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_analisis_sensorial_id_seq OWNER TO siblh;

--
-- Name: blh_analisis_sensorial_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_analisis_sensorial_id_seq OWNED BY blh_analisis_sensorial.id;


--
-- Name: blh_banco_de_leche; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_banco_de_leche (
    id integer NOT NULL,
    id_establecimiento integer NOT NULL,
    codigo_banco_de_leche character varying(6) NOT NULL,
    estado_banco character varying(8) NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_banco_de_leche OWNER TO siblh;

--
-- Name: blh_banco_de_leche_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_banco_de_leche_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_banco_de_leche_id_seq OWNER TO siblh;

--
-- Name: blh_banco_de_leche_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_banco_de_leche_id_seq OWNED BY blh_banco_de_leche.id;


--
-- Name: blh_bitacora; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_bitacora (
    id integer NOT NULL,
    fecha_accion date NOT NULL,
    codigo character varying(14) NOT NULL,
    tabla character varying(40) NOT NULL,
    usuario character varying(20) NOT NULL,
    accion character varying(10) NOT NULL,
    detalle character varying(500),
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_bitacora OWNER TO siblh;

--
-- Name: blh_bitacora_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_bitacora_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_bitacora_id_seq OWNER TO siblh;

--
-- Name: blh_bitacora_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_bitacora_id_seq OWNED BY blh_bitacora.id;


--
-- Name: blh_crematocrito; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_crematocrito (
    id integer NOT NULL,
    crema1 numeric(6,4),
    crema2 numeric(6,4),
    crema3 numeric(6,4),
    ct1 numeric(6,4),
    ct2 numeric(6,4),
    ct3 numeric(6,4),
    media_crema numeric(6,4),
    media_ct numeric(6,4),
    porcentaje_crema numeric(6,4),
    kilocalorias numeric(7,4),
    usuario integer,
    id_frasco_recolectado integer,
    id_frasco_procesado integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_crematocrito OWNER TO siblh;

--
-- Name: blh_crematocrito_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_crematocrito_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_crematocrito_id_seq OWNER TO siblh;

--
-- Name: blh_crematocrito_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_crematocrito_id_seq OWNED BY blh_crematocrito.id;


--
-- Name: blh_ctl_centro_recoleccion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_ctl_centro_recoleccion (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    telefono character varying(15) NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_establecimiento integer,
    codigo character varying(6),
    direccion character varying(250),
    id_banco_de_leche integer
);


ALTER TABLE blh_ctl_centro_recoleccion OWNER TO siblh;

--
-- Name: blh_ctl_centro_recoleccion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_ctl_centro_recoleccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_ctl_centro_recoleccion_id_seq OWNER TO siblh;

--
-- Name: blh_ctl_centro_recoleccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_ctl_centro_recoleccion_id_seq OWNED BY blh_ctl_centro_recoleccion.id;


--
-- Name: blh_ctl_escolaridad; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_ctl_escolaridad (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL,
    codigo character(3)
);


ALTER TABLE blh_ctl_escolaridad OWNER TO siblh;

--
-- Name: blh_ctl_escolaridad_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_ctl_escolaridad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_ctl_escolaridad_id_seq OWNER TO siblh;

--
-- Name: blh_ctl_escolaridad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_ctl_escolaridad_id_seq OWNED BY blh_ctl_escolaridad.id;


--
-- Name: blh_ctl_forma_extraccion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_ctl_forma_extraccion (
    id smallint NOT NULL,
    nombre character varying(25) NOT NULL,
    codigo character(3)
);


ALTER TABLE blh_ctl_forma_extraccion OWNER TO siblh;

--
-- Name: blh_ctl_forma_extraccion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_ctl_forma_extraccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_ctl_forma_extraccion_id_seq OWNER TO siblh;

--
-- Name: blh_ctl_forma_extraccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_ctl_forma_extraccion_id_seq OWNED BY blh_ctl_forma_extraccion.id;


--
-- Name: blh_ctl_habito_toxico; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_ctl_habito_toxico (
    id integer NOT NULL,
    habito_toxico character varying(20) NOT NULL
);


ALTER TABLE blh_ctl_habito_toxico OWNER TO siblh;

--
-- Name: blh_ctl_habito_toxico_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_ctl_habito_toxico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_ctl_habito_toxico_id_seq OWNER TO siblh;

--
-- Name: blh_ctl_habito_toxico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_ctl_habito_toxico_id_seq OWNED BY blh_ctl_habito_toxico.id;


--
-- Name: blh_ctl_tipo_colecta; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_ctl_tipo_colecta (
    id smallint NOT NULL,
    nombre character varying(50) NOT NULL,
    codigo character(3)
);


ALTER TABLE blh_ctl_tipo_colecta OWNER TO siblh;

--
-- Name: blh_ctl_tipo_colecta_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_ctl_tipo_colecta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_ctl_tipo_colecta_id_seq OWNER TO siblh;

--
-- Name: blh_ctl_tipo_colecta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_ctl_tipo_colecta_id_seq OWNED BY blh_ctl_tipo_colecta.id;


--
-- Name: blh_curva; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_curva (
    id integer NOT NULL,
    tiempo1 numeric(4,2),
    tiempo2 numeric(4,2),
    tiempo3 numeric(4,2),
    valor_curva numeric(4,2),
    fecha_curva date NOT NULL,
    cantidad_frascos integer NOT NULL,
    volumen_por_frasco numeric(7,4) NOT NULL,
    hora_inicio_curva time without time zone,
    usuario integer,
    volumen_total numeric(20,0),
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_curva OWNER TO siblh;

--
-- Name: blh_curva_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_curva_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_curva_id_seq OWNER TO siblh;

--
-- Name: blh_curva_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_curva_id_seq OWNED BY blh_curva.id;


--
-- Name: blh_donacion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_donacion (
    id integer NOT NULL,
    id_banco_de_leche integer NOT NULL,
    codigo_donante character varying(15),
    fecha_donacion date NOT NULL,
    responsable_donacion character varying(60) NOT NULL,
    usuario integer,
    id_donante integer,
    id_centro_recoleccion integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_responsable_donacion integer
);


ALTER TABLE blh_donacion OWNER TO siblh;

--
-- Name: blh_donacion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_donacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_donacion_id_seq OWNER TO siblh;

--
-- Name: blh_donacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_donacion_id_seq OWNED BY blh_donacion.id;


--
-- Name: blh_donante; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_donante (
    id integer NOT NULL,
    id_municipio integer NOT NULL,
    id_banco_de_leche integer NOT NULL,
    codigo_donante character varying(14) NOT NULL,
    primer_nombre character varying(15) NOT NULL,
    segundo_nombre character varying(15),
    primer_apellido character varying(15) NOT NULL,
    segundo_apellido character varying(15),
    fecha_nacimiento date NOT NULL,
    fecha_registro_donante_blh date,
    telefono_fijo character varying(9),
    telefono_movil character varying(9),
    direccion character varying(100),
    procedencia character varying(20),
    registro character varying(12),
    numero_documento_identificacion character varying(10) NOT NULL,
    documento_identificacion character varying(20) NOT NULL,
    edad integer,
    ocupacion character varying(15),
    estado_civil character varying(10) NOT NULL,
    nacionalidad integer,
    escolaridad character varying(15),
    tipo_colecta character varying(10) NOT NULL,
    observaciones character varying(150),
    estado character varying(8),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_estado_civil smallint,
    id_ocupacion smallint,
    id_escolaridad smallint,
    id_tipo_colecta smallint,
    id_doc_ide_donante integer
);


ALTER TABLE blh_donante OWNER TO siblh;

--
-- Name: blh_donante_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_donante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_donante_id_seq OWNER TO siblh;

--
-- Name: blh_donante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_donante_id_seq OWNED BY blh_donante.id;


--
-- Name: blh_egreso_receptor; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_egreso_receptor (
    id integer NOT NULL,
    id_receptor integer NOT NULL,
    diagnostico_egreso character varying(50) NOT NULL,
    madre_canguro character varying(2) NOT NULL,
    tipo_egreso character varying(6) NOT NULL,
    comentario_egreso character varying(150),
    traslado_periferico character varying(2) NOT NULL,
    permanencia_ucin integer,
    hospital_seguimiento_egreso character varying(80),
    fecha_egreso date NOT NULL,
    estancia_hospitalaria integer,
    usuario integer,
    dias_permanencia integer,
    id_establecimiento integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_egreso_receptor OWNER TO siblh;

--
-- Name: blh_egreso_receptor_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_egreso_receptor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_egreso_receptor_id_seq OWNER TO siblh;

--
-- Name: blh_egreso_receptor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_egreso_receptor_id_seq OWNED BY blh_egreso_receptor.id;


--
-- Name: blh_estado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_estado (
    id integer NOT NULL,
    nombre_estado character varying(13) NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_estado OWNER TO siblh;

--
-- Name: blh_estado_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_estado_id_seq OWNER TO siblh;

--
-- Name: blh_estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_estado_id_seq OWNED BY blh_estado.id;


--
-- Name: blh_examen; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_examen (
    id integer NOT NULL,
    nombre_examen character varying(30) NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_examen OWNER TO siblh;

--
-- Name: blh_examen_donante; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_examen_donante (
    id integer NOT NULL,
    id_examen integer NOT NULL,
    resultado_examen character varying(8) NOT NULL,
    usuario integer,
    id_donante integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_examen_donante OWNER TO siblh;

--
-- Name: blh_examen_donante_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_examen_donante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_examen_donante_id_seq OWNER TO siblh;

--
-- Name: blh_examen_donante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_examen_donante_id_seq OWNED BY blh_examen_donante.id;


--
-- Name: blh_examen_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_examen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_examen_id_seq OWNER TO siblh;

--
-- Name: blh_examen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_examen_id_seq OWNED BY blh_examen.id;


--
-- Name: blh_frasco_procesado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_frasco_procesado (
    id integer NOT NULL,
    id_estado integer NOT NULL,
    id_pasteurizacion integer NOT NULL,
    codigo_frasco_procesado character varying(15) DEFAULT 1,
    volumen_frasco_pasteurizado numeric(7,4) NOT NULL,
    acidez_total numeric(7,4) NOT NULL,
    kcalorias_totales numeric(7,4) NOT NULL,
    observacion_frasco_procesado character varying(150),
    volumen_disponible_fp numeric(7,4),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_frasco_procesado OWNER TO siblh;

--
-- Name: blh_frasco_procesado_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_frasco_procesado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_frasco_procesado_id_seq OWNER TO siblh;

--
-- Name: blh_frasco_procesado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_frasco_procesado_id_seq OWNED BY blh_frasco_procesado.id;


--
-- Name: blh_frasco_procesado_solicitud; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_frasco_procesado_solicitud (
    id integer NOT NULL,
    id_solicitud integer NOT NULL,
    volumen_despachado numeric(6,4) NOT NULL,
    usuario integer,
    id_frasco_procesado integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_frasco_procesado_solicitud OWNER TO siblh;

--
-- Name: blh_frasco_procesado_solicitud_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_frasco_procesado_solicitud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_frasco_procesado_solicitud_id_seq OWNER TO siblh;

--
-- Name: blh_frasco_procesado_solicitud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_frasco_procesado_solicitud_id_seq OWNED BY blh_frasco_procesado_solicitud.id;


--
-- Name: blh_frasco_recolectado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_frasco_recolectado (
    id integer NOT NULL,
    id_estado integer NOT NULL,
    id_lote_analisis integer,
    id_donante integer,
    id_donacion integer NOT NULL,
    codigo_frasco_recolectado character varying(15) NOT NULL,
    volumen_recolectado numeric(7,4) NOT NULL,
    forma_extraccion character varying(8) NOT NULL,
    onz_recolectado numeric(6,4),
    observacion_frasco_recolectado character varying(150),
    volumen_disponible_fr numeric(7,4),
    usuario integer,
    volumen_real numeric(7,4),
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_forma_extraccion smallint NOT NULL
);


ALTER TABLE blh_frasco_recolectado OWNER TO siblh;

--
-- Name: blh_frasco_recolectado_frasco_p; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_frasco_recolectado_frasco_p (
    id integer NOT NULL,
    volumen_agregado numeric(7,4) NOT NULL,
    usuario integer,
    id_frasco_recolectado integer NOT NULL,
    id_frasco_procesado integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_frasco_recolectado_frasco_p OWNER TO siblh;

--
-- Name: blh_frasco_recolectado_frasco_p_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_frasco_recolectado_frasco_p_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_frasco_recolectado_frasco_p_id_seq OWNER TO siblh;

--
-- Name: blh_frasco_recolectado_frasco_p_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_frasco_recolectado_frasco_p_id_seq OWNED BY blh_frasco_recolectado_frasco_p.id;


--
-- Name: blh_frasco_recolectado_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_frasco_recolectado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_frasco_recolectado_id_seq OWNER TO siblh;

--
-- Name: blh_frasco_recolectado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_frasco_recolectado_id_seq OWNED BY blh_frasco_recolectado.id;


--
-- Name: blh_grupo_solicitud; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_grupo_solicitud (
    id integer NOT NULL,
    codigo_grupo_solicitud character varying(13) NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_grupo_solicitud OWNER TO siblh;

--
-- Name: blh_grupo_solicitud_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_grupo_solicitud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_grupo_solicitud_id_seq OWNER TO siblh;

--
-- Name: blh_grupo_solicitud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_grupo_solicitud_id_seq OWNED BY blh_grupo_solicitud.id;


--
-- Name: blh_historia_actual; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_historia_actual (
    id integer NOT NULL,
    peso_donante numeric(7,4) NOT NULL,
    talla_donante numeric(7,4) NOT NULL,
    medicamento character varying(50),
    habito_toxico integer,
    motivo_donacion character varying(50) NOT NULL,
    patologia integer,
    imc numeric(7,4) NOT NULL,
    estado_donante character varying(12) NOT NULL,
    usuario integer,
    id_donante integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_historia_actual OWNER TO siblh;

--
-- Name: blh_historia_actual_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_historia_actual_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_historia_actual_id_seq OWNER TO siblh;

--
-- Name: blh_historia_actual_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_historia_actual_id_seq OWNED BY blh_historia_actual.id;


--
-- Name: blh_historial_clinico; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_historial_clinico (
    id integer NOT NULL,
    control_prenatal character varying(2) NOT NULL,
    edad_gest_fur numeric(6,4),
    lugar_control character varying(25),
    numero_control integer,
    fecha_parto date NOT NULL,
    lugar_parto character varying(150) NOT NULL,
    patologia_embarazo character varying(20),
    periodo_intergenesico integer NOT NULL,
    fecha_parto_anterior date,
    formula_obstetrica_g character varying(2),
    formula_obstetrica_p1 character varying(2),
    formula_obstetrica_p2 character varying(2),
    formula_obstetrica_a character varying(2),
    formula_obstetrica_v character varying(2),
    formula_obstetrica_m character varying(2),
    usuario integer,
    id_donante integer NOT NULL,
    id_establecimiento integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_historial_clinico OWNER TO siblh;

--
-- Name: blh_historial_clinico_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_historial_clinico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_historial_clinico_id_seq OWNER TO siblh;

--
-- Name: blh_historial_clinico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_historial_clinico_id_seq OWNED BY blh_historial_clinico.id;


--
-- Name: blh_informacion_publica; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_informacion_publica (
    id integer NOT NULL,
    id_banco_de_leche integer NOT NULL,
    path character varying(255) NOT NULL,
    tipo character varying(15) NOT NULL,
    nombre_documento character varying(30) NOT NULL,
    fecha_publicacion date NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_informacion_publica OWNER TO siblh;

--
-- Name: blh_informacion_publica_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_informacion_publica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_informacion_publica_id_seq OWNER TO siblh;

--
-- Name: blh_informacion_publica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_informacion_publica_id_seq OWNED BY blh_informacion_publica.id;


--
-- Name: blh_lote_analisis; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_lote_analisis (
    id integer NOT NULL,
    codigo_lote_analisis character varying(11) NOT NULL,
    fecha_analisis_fisico_quimico date NOT NULL,
    responsable_analisis character varying(60) NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_responsable_analisis integer
);


ALTER TABLE blh_lote_analisis OWNER TO siblh;

--
-- Name: blh_lote_analisis_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_lote_analisis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_lote_analisis_id_seq OWNER TO siblh;

--
-- Name: blh_lote_analisis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_lote_analisis_id_seq OWNED BY blh_lote_analisis.id;


--
-- Name: blh_menu; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_menu (
    id integer NOT NULL,
    nombre_menu character varying(50) NOT NULL,
    descripcion_menu character varying(50),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_menu OWNER TO siblh;

--
-- Name: blh_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_menu_id_seq OWNER TO siblh;

--
-- Name: blh_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_menu_id_seq OWNED BY blh_menu.id;


--
-- Name: blh_opcion_menu; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_opcion_menu (
    id integer NOT NULL,
    id_menu integer NOT NULL,
    nombre_opcion character varying(50) NOT NULL,
    url_opcion character varying(100),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_opcion_menu OWNER TO siblh;

--
-- Name: blh_opcion_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_opcion_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_opcion_menu_id_seq OWNER TO siblh;

--
-- Name: blh_opcion_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_opcion_menu_id_seq OWNED BY blh_opcion_menu.id;


--
-- Name: blh_pasteurizacion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_pasteurizacion (
    id integer NOT NULL,
    id_curva integer NOT NULL,
    codigo_pasteurizacion character varying(11) DEFAULT 1 NOT NULL,
    num_ciclo integer,
    volumen_pasteurizado numeric(7,4) NOT NULL,
    num_frascos_pasteurizados integer NOT NULL,
    fecha_pasteurizacion date NOT NULL,
    responsable_pasteurizacion character varying(60) NOT NULL,
    usuario integer,
    volumen_total numeric(8,0),
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer,
    id_responsable_pasteurizacion integer
);


ALTER TABLE blh_pasteurizacion OWNER TO siblh;

--
-- Name: blh_pasteurizacion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_pasteurizacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_pasteurizacion_id_seq OWNER TO siblh;

--
-- Name: blh_pasteurizacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_pasteurizacion_id_seq OWNED BY blh_pasteurizacion.id;


--
-- Name: blh_personal; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_personal (
    id integer NOT NULL,
    nombre character varying(50),
    usuario integer,
    id_establecimiento integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_personal OWNER TO siblh;

--
-- Name: blh_personal_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_personal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_personal_id_seq OWNER TO siblh;

--
-- Name: blh_personal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_personal_id_seq OWNED BY blh_personal.id;


--
-- Name: blh_receptor; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_receptor (
    id integer NOT NULL,
    id_banco_de_leche integer,
    id_paciente integer NOT NULL,
    codigo_receptor character varying(14),
    fecha_registro_blh date,
    procedencia character varying(20),
    estado_receptor character varying(8),
    edad_dias integer NOT NULL,
    peso_receptor numeric(8,4) NOT NULL,
    duracion_cpap integer,
    clasificacion_lubchengo character varying(3) NOT NULL,
    diagnostico_ingreso character varying(50),
    duracion_npt integer,
    apgar_primer_minuto numeric(6,4),
    edad_gest_fur numeric(6,4) NOT NULL,
    duracion_ventilacion integer,
    edad_gest_ballard numeric(6,4) NOT NULL,
    pc numeric(6,4) NOT NULL,
    talla_ingreso numeric(7,4),
    apgar_quinto_minuto numeric(6,4),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_receptor OWNER TO siblh;

--
-- Name: blh_receptor_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_receptor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_receptor_id_seq OWNER TO siblh;

--
-- Name: blh_receptor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_receptor_id_seq OWNED BY blh_receptor.id;


--
-- Name: blh_rol; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_rol (
    id integer NOT NULL,
    nombre_rol character varying(30) NOT NULL,
    descripcion_rol character varying(50),
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_rol OWNER TO siblh;

--
-- Name: blh_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_rol_id_seq OWNER TO siblh;

--
-- Name: blh_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_rol_id_seq OWNED BY blh_rol.id;


--
-- Name: blh_rol_menu; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_rol_menu (
    id integer NOT NULL,
    id_menu integer NOT NULL,
    id_rol integer NOT NULL,
    usuario integer,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_rol_menu OWNER TO siblh;

--
-- Name: blh_rol_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_rol_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_rol_menu_id_seq OWNER TO siblh;

--
-- Name: blh_rol_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_rol_menu_id_seq OWNED BY blh_rol_menu.id;


--
-- Name: blh_seguimiento_receptor; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_seguimiento_receptor (
    id integer NOT NULL,
    talla_receptor numeric(7,4) NOT NULL,
    peso_seguimiento numeric(8,4) NOT NULL,
    pc_seguimiento numeric(6,4) NOT NULL,
    ganancia_dia_peso numeric(7,4) NOT NULL,
    semana integer NOT NULL,
    fecha_seguimiento date NOT NULL,
    ganancia_dia_talla numeric(7,4) NOT NULL,
    complicaciones character varying(50) NOT NULL,
    observacion character varying(150),
    periodo_evaluacion integer,
    ganancia_dia_pc numeric(7,4),
    usuario integer,
    id_receptor integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_seguimiento_receptor OWNER TO siblh;

--
-- Name: blh_seguimiento_receptor_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_seguimiento_receptor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_seguimiento_receptor_id_seq OWNER TO siblh;

--
-- Name: blh_seguimiento_receptor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_seguimiento_receptor_id_seq OWNED BY blh_seguimiento_receptor.id;


--
-- Name: blh_solicitud; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_solicitud (
    id integer NOT NULL,
    id_grupo_solicitud integer,
    codigo_solicitud character varying(14) DEFAULT 1,
    volumen_por_dia numeric(7,4) NOT NULL,
    acidez_necesaria character varying(9) NOT NULL,
    calorias_necesarias character varying(15) NOT NULL,
    peso_dia numeric(8,4) NOT NULL,
    volumen_por_toma numeric(7,4) NOT NULL,
    toma_por_dia integer NOT NULL,
    fecha_solicitud date NOT NULL,
    cuna integer NOT NULL,
    estado character varying(10) NOT NULL,
    responsable character varying(60),
    usuario integer,
    id_receptor integer NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_solicitud OWNER TO siblh;

--
-- Name: blh_solicitud_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_solicitud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_solicitud_id_seq OWNER TO siblh;

--
-- Name: blh_solicitud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_solicitud_id_seq OWNED BY blh_solicitud.id;


--
-- Name: blh_temperatura_enfriamiento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_temperatura_enfriamiento (
    id integer NOT NULL,
    temperatura_e integer NOT NULL,
    usuario integer,
    id_pasteurizacion integer NOT NULL,
    hora_inicio_e time without time zone,
    hora_final_e time without time zone,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_temperatura_enfriamiento OWNER TO siblh;

--
-- Name: blh_temperatura_enfriamiento_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_temperatura_enfriamiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_temperatura_enfriamiento_id_seq OWNER TO siblh;

--
-- Name: blh_temperatura_enfriamiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_temperatura_enfriamiento_id_seq OWNED BY blh_temperatura_enfriamiento.id;


--
-- Name: blh_temperatura_pasteurizacion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE blh_temperatura_pasteurizacion (
    id integer NOT NULL,
    temperatura_p integer,
    usuario integer,
    id_pasteurizacion integer NOT NULL,
    hora_inicio_p time without time zone,
    hora_final_p time without time zone,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE blh_temperatura_pasteurizacion OWNER TO siblh;

--
-- Name: blh_temperatura_pasteurizacion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE blh_temperatura_pasteurizacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE blh_temperatura_pasteurizacion_id_seq OWNER TO siblh;

--
-- Name: blh_temperatura_pasteurizacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE blh_temperatura_pasteurizacion_id_seq OWNED BY blh_temperatura_pasteurizacion.id;


--
-- Name: ctl_area_geografica; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_area_geografica (
    id integer NOT NULL,
    nombre character varying(15) NOT NULL,
    abreviatura character(2) NOT NULL
);


ALTER TABLE ctl_area_geografica OWNER TO siblh;

--
-- Name: TABLE ctl_area_geografica; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_area_geografica IS 'Tabla que representa el área geográfica en la que se encuentra clasificada una persona';


--
-- Name: COLUMN ctl_area_geografica.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_area_geografica.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_area_geografica.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_area_geografica.nombre IS 'Nombre del área geográfica';


--
-- Name: COLUMN ctl_area_geografica.abreviatura; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_area_geografica.abreviatura IS 'Letra con la que se presentan el área geográfica';


--
-- Name: ctl_area_geografica_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_area_geografica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_area_geografica_id_seq OWNER TO siblh;

--
-- Name: ctl_area_geografica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_area_geografica_id_seq OWNED BY ctl_area_geografica.id;


--
-- Name: ctl_atencion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_atencion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    id_atencion_padre integer,
    id_tipo_atencion integer,
    codigo_busqueda character varying(6)
);


ALTER TABLE ctl_atencion OWNER TO siblh;

--
-- Name: TABLE ctl_atencion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_atencion IS 'Contiene todas la atenciones que un paciente puede recibir como especiales u otras atenciones en salud';


--
-- Name: COLUMN ctl_atencion.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_atencion.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN ctl_atencion.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_atencion.nombre IS 'Nombre de la atención a recibir por el paciente';


--
-- Name: COLUMN ctl_atencion.id_atencion_padre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_atencion.id_atencion_padre IS 'Llave recursiva para determinar a que área superior pertenece.';


--
-- Name: COLUMN ctl_atencion.id_tipo_atencion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_atencion.id_tipo_atencion IS 'Foránea para representar el tipo de atención';


--
-- Name: COLUMN ctl_atencion.codigo_busqueda; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_atencion.codigo_busqueda IS 'Codigo de busqueda de la atención en un paciente. Que se utiliza en Laboratorio y Citas';


--
-- Name: ctl_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_atencion_id_seq OWNER TO siblh;

--
-- Name: ctl_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_atencion_id_seq OWNED BY ctl_atencion.id;


--
-- Name: ctl_canton; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_canton (
    id integer NOT NULL,
    nombre character varying(150),
    codigo_digestyc character varying(5),
    id_municipio smallint
);


ALTER TABLE ctl_canton OWNER TO siblh;

--
-- Name: TABLE ctl_canton; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_canton IS 'Lista de los cantones que conforman un municipio';


--
-- Name: COLUMN ctl_canton.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_canton.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_canton.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_canton.nombre IS 'Nombre del cantón';


--
-- Name: COLUMN ctl_canton.codigo_digestyc; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_canton.codigo_digestyc IS 'Codigo asignado por la Digestyc para un cantón en especifico';


--
-- Name: COLUMN ctl_canton.id_municipio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_canton.id_municipio IS 'Representa la llave foranea que proviene de ctl_municipio';


--
-- Name: ctl_canton_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_canton_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_canton_id_seq OWNER TO siblh;

--
-- Name: ctl_canton_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_canton_id_seq OWNED BY ctl_canton.id;


--
-- Name: ctl_condicion_persona; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_condicion_persona (
    id integer NOT NULL,
    nombre character varying NOT NULL,
    descripcion text,
    abreviatura character varying(5)
);


ALTER TABLE ctl_condicion_persona OWNER TO siblh;

--
-- Name: TABLE ctl_condicion_persona; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_condicion_persona IS 'Contiene los tipos de condicion que puede tener una persona en un determinado momento.';


--
-- Name: COLUMN ctl_condicion_persona.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_condicion_persona.id IS 'Identificador o Llave Primaria';


--
-- Name: COLUMN ctl_condicion_persona.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_condicion_persona.nombre IS 'Nombre de la Condicion de la Persona';


--
-- Name: COLUMN ctl_condicion_persona.descripcion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_condicion_persona.descripcion IS 'Descripcion de la Condicion de la Persona';


--
-- Name: COLUMN ctl_condicion_persona.abreviatura; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_condicion_persona.abreviatura IS 'abreviatura para identificar a la persona';


--
-- Name: ctl_condicion_persona_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_condicion_persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_condicion_persona_id_seq OWNER TO siblh;

--
-- Name: ctl_condicion_persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_condicion_persona_id_seq OWNED BY ctl_condicion_persona.id;


--
-- Name: ctl_creacion_expediente; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_creacion_expediente (
    id integer NOT NULL,
    area character varying(25) NOT NULL
);


ALTER TABLE ctl_creacion_expediente OWNER TO siblh;

--
-- Name: TABLE ctl_creacion_expediente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_creacion_expediente IS 'Lugar del establecimiento en donde se crea el expediente';


--
-- Name: COLUMN ctl_creacion_expediente.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_creacion_expediente.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_creacion_expediente.area; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_creacion_expediente.area IS 'Nombre del área de creación del expediente';


--
-- Name: ctl_creacion_expediente_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_creacion_expediente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_creacion_expediente_id_seq OWNER TO siblh;

--
-- Name: ctl_creacion_expediente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_creacion_expediente_id_seq OWNED BY ctl_creacion_expediente.id;


--
-- Name: ctl_departamento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_departamento (
    id integer NOT NULL,
    nombre character varying(150),
    codigo_cnr character varying(5),
    abreviatura character varying(5),
    id_pais integer,
    id_establecimiento_region integer,
    iso31662 character varying(5)
);


ALTER TABLE ctl_departamento OWNER TO siblh;

--
-- Name: TABLE ctl_departamento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_departamento IS 'Lista de los departamentos que conforman un pais';


--
-- Name: COLUMN ctl_departamento.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_departamento.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.nombre IS 'Nombre del departamento';


--
-- Name: COLUMN ctl_departamento.codigo_cnr; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.codigo_cnr IS 'Codigo asignado por la Digestyc para un departamento en especifico';


--
-- Name: COLUMN ctl_departamento.abreviatura; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.abreviatura IS 'Abreviatura asignada al departamento';


--
-- Name: COLUMN ctl_departamento.id_pais; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.id_pais IS 'Representa la llave foranea que proviene de ctl_pais';


--
-- Name: COLUMN ctl_departamento.id_establecimiento_region; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.id_establecimiento_region IS 'Foránea que representa el la región a la que pertenece administrativamente el departamento';


--
-- Name: COLUMN ctl_departamento.iso31662; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_departamento.iso31662 IS 'Código de departamento según norma ISO 3166-2 ';


--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_departamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_departamento_id_seq OWNER TO siblh;

--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_departamento_id_seq OWNED BY ctl_departamento.id;


--
-- Name: ctl_documento_identidad; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_documento_identidad (
    id integer NOT NULL,
    nombre character varying(20)
);


ALTER TABLE ctl_documento_identidad OWNER TO siblh;

--
-- Name: TABLE ctl_documento_identidad; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_documento_identidad IS 'Lista de todos los documentos de identidad permitidos';


--
-- Name: COLUMN ctl_documento_identidad.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_documento_identidad.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_documento_identidad.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_documento_identidad.nombre IS 'Descripción o nombre del documento';


--
-- Name: ctl_documento_identidad_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_documento_identidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_documento_identidad_id_seq OWNER TO siblh;

--
-- Name: ctl_documento_identidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_documento_identidad_id_seq OWNED BY ctl_documento_identidad.id;


--
-- Name: ctl_establecimiento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_establecimiento (
    id integer NOT NULL,
    id_tipo_establecimiento integer NOT NULL,
    nombre character varying(150) NOT NULL,
    direccion character varying(250),
    telefono character varying(15),
    fax character varying(15),
    latitud numeric(10,4),
    longitud numeric(10,4),
    id_municipio integer,
    id_nivel_minsal integer,
    cod_ucsf integer,
    activo boolean,
    id_establecimiento_padre integer,
    tipo_expediente character(1),
    configurado boolean,
    id_institucion integer
);


ALTER TABLE ctl_establecimiento OWNER TO siblh;

--
-- Name: TABLE ctl_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_establecimiento IS 'Contiene los tipos de establecimiento que conforman el MINSAL';


--
-- Name: COLUMN ctl_establecimiento.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_establecimiento.id_tipo_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.id_tipo_establecimiento IS 'Llave foránea del tipo de establecimiento';


--
-- Name: COLUMN ctl_establecimiento.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.nombre IS 'Nombre del establecimiento de salud';


--
-- Name: COLUMN ctl_establecimiento.direccion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.direccion IS 'Lugar físico del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.telefono; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.telefono IS 'Teléfono de contacto del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.fax; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.fax IS 'Fax del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.latitud; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.latitud IS 'Coordenadas de latitud para sistema georeferencial';


--
-- Name: COLUMN ctl_establecimiento.longitud; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.longitud IS 'Coordenadas de longitud para sistema georeferencial';


--
-- Name: COLUMN ctl_establecimiento.id_municipio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.id_municipio IS 'Llave foránea del municipio al que pertenece el establecimiento';


--
-- Name: COLUMN ctl_establecimiento.id_nivel_minsal; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.id_nivel_minsal IS 'Representa el nivel del establecimiento, pueden ser 1,2,3';


--
-- Name: COLUMN ctl_establecimiento.cod_ucsf; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.cod_ucsf IS 'Código asignados a la Unidad Comunitaria de Salud Familiar.';


--
-- Name: COLUMN ctl_establecimiento.activo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.activo IS 'Estado del establecimiento';


--
-- Name: COLUMN ctl_establecimiento.id_establecimiento_padre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.id_establecimiento_padre IS 'Llave foránea del establecimiento que es su supervisor';


--
-- Name: COLUMN ctl_establecimiento.tipo_expediente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.tipo_expediente IS 'Los tipos de expedientes son: G = Utiliza guión (xxx-xx); I = Infinito';


--
-- Name: COLUMN ctl_establecimiento.configurado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_establecimiento.configurado IS 'Determina cual es el establecimiento que esta configurado ';


--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_establecimiento_id_seq OWNER TO siblh;

--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_establecimiento_id_seq OWNED BY ctl_establecimiento.id;


--
-- Name: ctl_estado_civil; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_estado_civil (
    id smallint NOT NULL,
    nombre character varying(15) NOT NULL
);


ALTER TABLE ctl_estado_civil OWNER TO siblh;

--
-- Name: TABLE ctl_estado_civil; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_estado_civil IS 'Contiene los estados civiles permitidos';


--
-- Name: COLUMN ctl_estado_civil.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_estado_civil.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_estado_civil.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_estado_civil.nombre IS 'Nombre del estado civil';


--
-- Name: ctl_estado_civil_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_estado_civil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_estado_civil_id_seq OWNER TO siblh;

--
-- Name: ctl_estado_civil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_estado_civil_id_seq OWNED BY ctl_estado_civil.id;


--
-- Name: ctl_institucion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_institucion (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    id_pais integer,
    logo character varying(35),
    rectora character varying(10),
    categoria integer,
    sigla character varying(14),
    estado integer NOT NULL
);


ALTER TABLE ctl_institucion OWNER TO siblh;

--
-- Name: TABLE ctl_institucion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_institucion IS 'Catálogo que contiene las instituciones  utilizadas en los sistemas de salud';


--
-- Name: COLUMN ctl_institucion.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_institucion.id IS 'Identificador código maestro institución';


--
-- Name: COLUMN ctl_institucion.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_institucion.nombre IS 'Descripción nombre de la Institución';


--
-- Name: COLUMN ctl_institucion.id_pais; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_institucion.id_pais IS 'Identificador pais al que pertenece la institución';


--
-- Name: COLUMN ctl_institucion.logo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_institucion.logo IS 'nombre archivo de imagen utilizada como logo de la institución';


--
-- Name: COLUMN ctl_institucion.sigla; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_institucion.sigla IS 'Sigla de la institución';


--
-- Name: ctl_institucion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_institucion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_institucion_id_seq OWNER TO siblh;

--
-- Name: ctl_institucion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_institucion_id_seq OWNED BY ctl_institucion.id;


--
-- Name: ctl_municipio; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_municipio (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    codigo_cnr character varying(5),
    abreviatura character varying(5),
    id_departamento integer NOT NULL
);


ALTER TABLE ctl_municipio OWNER TO siblh;

--
-- Name: TABLE ctl_municipio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_municipio IS 'Lista de los municipios que conforman un departamento';


--
-- Name: COLUMN ctl_municipio.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_municipio.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_municipio.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_municipio.nombre IS 'Nombre del municipio';


--
-- Name: COLUMN ctl_municipio.codigo_cnr; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_municipio.codigo_cnr IS 'Codigo asignado por la Digestyc para un municipio en especifico';


--
-- Name: COLUMN ctl_municipio.abreviatura; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_municipio.abreviatura IS 'Abreviatura asignada al municipio';


--
-- Name: COLUMN ctl_municipio.id_departamento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_municipio.id_departamento IS 'Representa la llave foranea que proviene de ctl_departamento';


--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_municipio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_municipio_id_seq OWNER TO siblh;

--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_municipio_id_seq OWNED BY ctl_municipio.id;


--
-- Name: ctl_nacionalidad; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_nacionalidad (
    id integer NOT NULL,
    nacionalidad character varying(50) NOT NULL
);


ALTER TABLE ctl_nacionalidad OWNER TO siblh;

--
-- Name: TABLE ctl_nacionalidad; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_nacionalidad IS 'Catálogo de las nacionalidades existentes';


--
-- Name: COLUMN ctl_nacionalidad.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_nacionalidad.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_nacionalidad.nacionalidad; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_nacionalidad.nacionalidad IS 'Nombre de la nacionalidad';


--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_nacionalidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_nacionalidad_id_seq OWNER TO siblh;

--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_nacionalidad_id_seq OWNED BY ctl_nacionalidad.id;


--
-- Name: ctl_ocupacion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_ocupacion (
    id smallint NOT NULL,
    nombre character varying(100) NOT NULL
);


ALTER TABLE ctl_ocupacion OWNER TO siblh;

--
-- Name: TABLE ctl_ocupacion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_ocupacion IS 'Lista de las ocupaciones que un paciente puede tener';


--
-- Name: COLUMN ctl_ocupacion.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_ocupacion.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_ocupacion.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_ocupacion.nombre IS 'Nombre de la ocupación';


--
-- Name: ctl_ocupacion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_ocupacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_ocupacion_id_seq OWNER TO siblh;

--
-- Name: ctl_ocupacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_ocupacion_id_seq OWNED BY ctl_ocupacion.id;


--
-- Name: ctl_pais; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_pais (
    id integer NOT NULL,
    nombre character varying(150),
    activo boolean
);


ALTER TABLE ctl_pais OWNER TO siblh;

--
-- Name: TABLE ctl_pais; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_pais IS 'Lista del pais originario del paciente';


--
-- Name: COLUMN ctl_pais.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_pais.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_pais.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_pais.nombre IS 'Nombre del pais';


--
-- Name: COLUMN ctl_pais.activo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_pais.activo IS 'Si el país está activo para ser presentado en las aplicaciones del sistema';


--
-- Name: ctl_pais_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_pais_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_pais_id_seq OWNER TO siblh;

--
-- Name: ctl_pais_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_pais_id_seq OWNED BY ctl_pais.id;


--
-- Name: ctl_parentesco; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_parentesco (
    id integer NOT NULL,
    parentesco character varying(15) NOT NULL
);


ALTER TABLE ctl_parentesco OWNER TO siblh;

--
-- Name: TABLE ctl_parentesco; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_parentesco IS 'Lista de los parentesco que una persona puede tener dentro de su grupo familiar';


--
-- Name: COLUMN ctl_parentesco.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_parentesco.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_parentesco.parentesco; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_parentesco.parentesco IS 'Parentesco del paciente';


--
-- Name: ctl_parentesco_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_parentesco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_parentesco_id_seq OWNER TO siblh;

--
-- Name: ctl_parentesco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_parentesco_id_seq OWNED BY ctl_parentesco.id;


--
-- Name: ctl_patologia; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_patologia (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    id_patologia_padre integer,
    id_tipo_patologia integer NOT NULL,
    notificacion boolean DEFAULT false NOT NULL
);


ALTER TABLE ctl_patologia OWNER TO siblh;

--
-- Name: TABLE ctl_patologia; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_patologia IS 'Determina las diferentes patologías que pueden existir que se aplicarán a un paciente';


--
-- Name: COLUMN ctl_patologia.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_patologia.id IS 'Llave primaria de tabla ctl_patologia';


--
-- Name: COLUMN ctl_patologia.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_patologia.nombre IS 'Almacena nombres de patologias';


--
-- Name: COLUMN ctl_patologia.id_patologia_padre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_patologia.id_patologia_padre IS 'Llave foránea que hace referencia a ctl_patologia ';


--
-- Name: COLUMN ctl_patologia.id_tipo_patologia; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_patologia.id_tipo_patologia IS 'Llave foránea que hace referencia a ctl_tipo_patologia';


--
-- Name: COLUMN ctl_patologia.notificacion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_patologia.notificacion IS 'Indica si la patologia es de notificacion o no ';


--
-- Name: ctl_patologia_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_patologia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_patologia_id_seq OWNER TO siblh;

--
-- Name: ctl_patologia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_patologia_id_seq OWNED BY ctl_patologia.id;


--
-- Name: ctl_sexo; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_sexo (
    id integer NOT NULL,
    nombre character varying(20) NOT NULL,
    abreviatura character(1) NOT NULL
);


ALTER TABLE ctl_sexo OWNER TO siblh;

--
-- Name: TABLE ctl_sexo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_sexo IS 'Catálogo del sexo del paciente';


--
-- Name: COLUMN ctl_sexo.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_sexo.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_sexo.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_sexo.nombre IS 'Nombre del sexo de la persona';


--
-- Name: COLUMN ctl_sexo.abreviatura; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_sexo.abreviatura IS 'Letra con la que se representara el sexo de una persona';


--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_sexo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_sexo_id_seq OWNER TO siblh;

--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_sexo_id_seq OWNED BY ctl_sexo.id;


--
-- Name: ctl_tipo_atencion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_tipo_atencion (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    id_tipo_atencion_padre integer
);


ALTER TABLE ctl_tipo_atencion OWNER TO siblh;

--
-- Name: TABLE ctl_tipo_atencion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_tipo_atencion IS 'Determina las divisiones en las cuales se agrupan las atención en un establecimiento de salud';


--
-- Name: COLUMN ctl_tipo_atencion.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_atencion.id IS 'Llave primaria ';


--
-- Name: COLUMN ctl_tipo_atencion.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_atencion.nombre IS 'Nombre del tipo de atención';


--
-- Name: COLUMN ctl_tipo_atencion.id_tipo_atencion_padre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_atencion.id_tipo_atencion_padre IS 'Llave foranéa a ctl_tipo_atencion para determinar a que división pertenece ';


--
-- Name: ctl_tipo_atencion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_tipo_atencion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_atencion_id_seq OWNER TO siblh;

--
-- Name: ctl_tipo_atencion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_tipo_atencion_id_seq OWNED BY ctl_tipo_atencion.id;


--
-- Name: ctl_tipo_establecimiento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_tipo_establecimiento (
    id integer NOT NULL,
    nombre character varying(150),
    codigo character varying(6),
    id_institucion integer
);


ALTER TABLE ctl_tipo_establecimiento OWNER TO siblh;

--
-- Name: TABLE ctl_tipo_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_tipo_establecimiento IS 'Contiene los tipos de establecimiento que conforman el MINSAL';


--
-- Name: COLUMN ctl_tipo_establecimiento.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_establecimiento.id IS 'Llave primaria';


--
-- Name: COLUMN ctl_tipo_establecimiento.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_establecimiento.nombre IS 'Nombre del tipo de establecimiento';


--
-- Name: COLUMN ctl_tipo_establecimiento.codigo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_establecimiento.codigo IS 'Código que distingue al tipo establecimiento';


--
-- Name: ctl_tipo_establecimiento_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_tipo_establecimiento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_establecimiento_id_seq OWNER TO siblh;

--
-- Name: ctl_tipo_establecimiento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_tipo_establecimiento_id_seq OWNED BY ctl_tipo_establecimiento.id;


--
-- Name: ctl_tipo_patologia; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_tipo_patologia (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion text
);


ALTER TABLE ctl_tipo_patologia OWNER TO siblh;

--
-- Name: TABLE ctl_tipo_patologia; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE ctl_tipo_patologia IS 'Almacena los tipos de patologías';


--
-- Name: COLUMN ctl_tipo_patologia.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_patologia.id IS 'Llave primaria de la tabla ctl_tipo_patologia';


--
-- Name: COLUMN ctl_tipo_patologia.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_patologia.nombre IS 'Almacena los nombres de los distintos tipos de patologia';


--
-- Name: COLUMN ctl_tipo_patologia.descripcion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN ctl_tipo_patologia.descripcion IS 'Almacena la descripcion de los tipos de patologias';


--
-- Name: ctl_tipo_patologia_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_tipo_patologia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_tipo_patologia_id_seq OWNER TO siblh;

--
-- Name: ctl_tipo_patologia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_tipo_patologia_id_seq OWNED BY ctl_tipo_patologia.id;


--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text NOT NULL
);


ALTER TABLE fos_user_group OWNER TO siblh;

--
-- Name: TABLE fos_user_group; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE fos_user_group IS 'Maneja los grupo de roles para el BUNDLE SONATAADMINBUNDLE de symfony';


--
-- Name: COLUMN fos_user_group.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_group.id IS 'Llave Primaria';


--
-- Name: COLUMN fos_user_group.name; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_group.name IS 'Nombre del grupo. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_group.roles; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_group.roles IS '(DC2Type:array) Roles de usuarios, formando un arreglo que reconoce Doctrine2. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE fos_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_group_id_seq OWNER TO siblh;

--
-- Name: fos_user_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE fos_user_group_id_seq OWNED BY fos_user_group.id;


--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE fos_user_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255),
    email character varying(255),
    email_canonical character varying(255),
    enabled boolean,
    salt character varying(255),
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean,
    expired boolean,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text,
    credentials_expired boolean,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    date_of_birth timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    firstname character varying(64) DEFAULT NULL::character varying,
    lastname character varying(64) DEFAULT NULL::character varying,
    website character varying(64) DEFAULT NULL::character varying,
    biography character varying(255) DEFAULT NULL::character varying,
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
    id_establecimiento integer,
    id_empleado integer
);


ALTER TABLE fos_user_user OWNER TO siblh;

--
-- Name: TABLE fos_user_user; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE fos_user_user IS 'Maneja los usuarios tanto para los módulos en Symfony como para los de PHP puro';


--
-- Name: COLUMN fos_user_user.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.id IS 'Llave Primaria';


--
-- Name: COLUMN fos_user_user.username; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.username IS 'Nombre del usuario. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.username_canonical; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.username_canonical IS 'Nombre del usuario utilizado para la encriptación de la seguridad. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.email; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.email IS 'Correo del usuarios. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.email_canonical; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.email_canonical IS 'Correo utilizado para la encriptación. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.enabled; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.enabled IS 'Para saber si esta habilitado el usuario. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.salt; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.salt IS 'Texto utilizado para la encriptación de la contraseña. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.password; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.password IS 'Contraseña encriptada por la aplicación. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.last_login; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.last_login IS 'Ultimo logueo del usuario. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.locked; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.locked IS 'Si es usuario esta bloqueado tomará el valor de TRUE. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.expired; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.expired IS 'Para determinar si la contraseña puede expirar.Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.expires_at; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.expires_at IS 'Fecha en que finaliza la expiración de la contraseña. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.confirmation_token; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.confirmation_token IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.password_requested_at; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.password_requested_at IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.roles; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.roles IS '(DC2Type:array)Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.credentials_expired; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.credentials_expired IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.credentials_expire_at; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.credentials_expire_at IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.created_at; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.created_at IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.updated_at; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.updated_at IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.date_of_birth; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.date_of_birth IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.firstname; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.firstname IS 'Nombre del usuario. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.lastname; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.lastname IS 'Apellidos del usuarios. Se encuentra en ingles porque fue generada por la aplicación FosUserBundle';


--
-- Name: COLUMN fos_user_user.website; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.website IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.biography; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.biography IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.gender; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.gender IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.locale; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.locale IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.timezone; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.timezone IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.phone; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.phone IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.facebook_uid; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.facebook_uid IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.facebook_name; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.facebook_name IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.facebook_data; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.facebook_data IS '(DC2Type:json)Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.twitter_uid; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.twitter_uid IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.twitter_name; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.twitter_name IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.twitter_data; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.twitter_data IS '(DC2Type:json)Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.gplus_uid; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.gplus_uid IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.gplus_name; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.gplus_name IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.gplus_data; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.gplus_data IS '(DC2Type:json)Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.token; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.token IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.two_step_code; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.two_step_code IS 'Son atributos agregados por el FosUserBundle como parte del registro de usuario que este Bundle maneja';


--
-- Name: COLUMN fos_user_user.id_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.id_establecimiento IS 'Foranea que indica el establecimiento al que pertenece el usuario';


--
-- Name: COLUMN fos_user_user.id_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user.id_empleado IS 'Foranea que indica el id_empleado que posee este usuario';


--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE fos_user_user_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE fos_user_user_group OWNER TO siblh;

--
-- Name: TABLE fos_user_user_group; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE fos_user_user_group IS 'Tabla intermedia para saber que usuarios poseen que grupos dentro de los modulos con Symfony';


--
-- Name: COLUMN fos_user_user_group.user_id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user_group.user_id IS 'Llave foranea que determina el usuario a agregarle el grupo de roles';


--
-- Name: COLUMN fos_user_user_group.group_id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN fos_user_user_group.group_id IS 'Llave foranea que determina que grupo se le asignará a un determinado usuario';


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE fos_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_user_id_seq OWNER TO siblh;

--
-- Name: fos_user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE fos_user_user_id_seq OWNED BY fos_user_user.id;


--
-- Name: mnt_cargoempleados; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_cargoempleados (
    id integer NOT NULL,
    cargo character varying(50),
    id_atencion integer
);


ALTER TABLE mnt_cargoempleados OWNER TO siblh;

--
-- Name: COLUMN mnt_cargoempleados.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_cargoempleados.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN mnt_cargoempleados.cargo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_cargoempleados.cargo IS 'Almacena el cargo';


--
-- Name: COLUMN mnt_cargoempleados.id_atencion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_cargoempleados.id_atencion IS 'Foranea que almacena el servicio al que pertenece el empleado';


--
-- Name: mnt_cargoempleados_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE mnt_cargoempleados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_cargoempleados_id_seq OWNER TO siblh;

--
-- Name: mnt_cargoempleados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE mnt_cargoempleados_id_seq OWNED BY mnt_cargoempleados.id;


--
-- Name: mnt_empleado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_empleado (
    id integer NOT NULL,
    nombre character varying(100),
    apellido character varying(100),
    fecha_nacimiento date,
    dui character varying(12),
    numero_junta_vigilancia character varying(20),
    numero_celular character varying(10),
    correo_electronico character varying(50),
    id_establecimiento integer,
    correlativo smallint,
    id_cargo_empleado integer,
    firma_digital text,
    id_tipo_empleado integer,
    id_user_reg smallint,
    fecha_hora_reg timestamp without time zone,
    id_user_mod smallint,
    fecha_hora_mod timestamp without time zone,
    nombre_empleado character varying(200),
    habilitado boolean DEFAULT true,
    id_establecimiento_externo integer,
    residente boolean DEFAULT false,
    id_nuevo_empleado integer
);


ALTER TABLE mnt_empleado OWNER TO siblh;

--
-- Name: TABLE mnt_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE mnt_empleado IS 'Contiene los empleados del sistema';


--
-- Name: COLUMN mnt_empleado.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id IS 'Llave Primaria';


--
-- Name: COLUMN mnt_empleado.nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.nombre IS 'Nombre del empleado';


--
-- Name: COLUMN mnt_empleado.apellido; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.apellido IS 'Apellidos del Empleado';


--
-- Name: COLUMN mnt_empleado.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.fecha_nacimiento IS 'Fecha de nacimiento del empleado';


--
-- Name: COLUMN mnt_empleado.dui; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.dui IS 'DUI del empleado';


--
-- Name: COLUMN mnt_empleado.numero_junta_vigilancia; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.numero_junta_vigilancia IS 'Numero de junta de vigilancia en caso de que sea medico';


--
-- Name: COLUMN mnt_empleado.numero_celular; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.numero_celular IS 'Telefono celular de contacto';


--
-- Name: COLUMN mnt_empleado.correo_electronico; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.correo_electronico IS 'Correo electronico';


--
-- Name: COLUMN mnt_empleado.id_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_establecimiento IS 'Llave foranea del establecimiento';


--
-- Name: COLUMN mnt_empleado.correlativo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.correlativo IS 'UTILIZADO PARA LOS QUE POSEE VERSIÓN ANTIGUA DE CODIGO SIAP';


--
-- Name: COLUMN mnt_empleado.id_cargo_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_cargo_empleado IS 'Cargo del empleado para el modulo de laboratorio';


--
-- Name: COLUMN mnt_empleado.firma_digital; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.firma_digital IS 'Campo para setearle el hash de la firma digital del empleado';


--
-- Name: COLUMN mnt_empleado.id_tipo_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_tipo_empleado IS 'Almacena el tipo de empleado de la persona para el SIAP';


--
-- Name: COLUMN mnt_empleado.id_user_reg; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_user_reg IS 'Almacena el id del usuario que ingresa el registro';


--
-- Name: COLUMN mnt_empleado.fecha_hora_reg; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.fecha_hora_reg IS 'almacena la fecha y hora de ingreso del registro';


--
-- Name: COLUMN mnt_empleado.id_user_mod; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_user_mod IS 'Almacena el id del usuario que modifico el registro';


--
-- Name: COLUMN mnt_empleado.fecha_hora_mod; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.fecha_hora_mod IS 'almacena la fecha y hora de modificacion del registro';


--
-- Name: COLUMN mnt_empleado.nombre_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.nombre_empleado IS 'Nombre Unido para los modulos de PHP Puro y POstgresql';


--
-- Name: COLUMN mnt_empleado.habilitado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.habilitado IS 'Almacena si el registro esta habilitado';


--
-- Name: COLUMN mnt_empleado.id_establecimiento_externo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_empleado.id_establecimiento_externo IS 'ID para empleados externos al establecimiento, se usa para el modulo de laboratorio';


--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE mnt_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_empleado_id_seq OWNER TO siblh;

--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE mnt_empleado_id_seq OWNED BY mnt_empleado.id;


--
-- Name: mnt_expediente; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_expediente (
    id bigint NOT NULL,
    numero character varying(12) NOT NULL,
    id_paciente bigint NOT NULL,
    id_establecimiento integer,
    habilitado boolean DEFAULT true NOT NULL,
    id_creacion_expediente integer,
    fecha_creacion date,
    hora_creacion time without time zone,
    numero_temporal boolean DEFAULT false,
    expediente_fisico_eliminado boolean DEFAULT false,
    cun boolean DEFAULT false
);


ALTER TABLE mnt_expediente OWNER TO siblh;

--
-- Name: TABLE mnt_expediente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE mnt_expediente IS 'Tabla que guarda los números de expediente clinico';


--
-- Name: COLUMN mnt_expediente.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.id IS 'Expediente generado para el paciente';


--
-- Name: COLUMN mnt_expediente.numero; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.numero IS 'Número de expediente de un paciente en el SIAPS local';


--
-- Name: COLUMN mnt_expediente.id_paciente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.id_paciente IS 'Foránea que representa el identificador único del paciente dentro de la base de datos local';


--
-- Name: COLUMN mnt_expediente.id_establecimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.id_establecimiento IS 'Foránea que se relaciona con el establecimiento para saber a que establecimiento pertenece ese expediente';


--
-- Name: COLUMN mnt_expediente.habilitado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.habilitado IS 'Para determinar si el expediente esta habilitado. TRUE=Habilitado; FALSE= Deshabilitado';


--
-- Name: COLUMN mnt_expediente.id_creacion_expediente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.id_creacion_expediente IS 'Fóranea que representa el área en donde se creo el expediente del paciente';


--
-- Name: COLUMN mnt_expediente.fecha_creacion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.fecha_creacion IS 'almacena la fecha de creacion';


--
-- Name: COLUMN mnt_expediente.hora_creacion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.hora_creacion IS 'almacena la hora de creacion';


--
-- Name: COLUMN mnt_expediente.numero_temporal; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.numero_temporal IS 'Boolean que determina si es un expediente temporal. Cuando el expediente sea eliminado fisicamente el número quedará como temporal';


--
-- Name: COLUMN mnt_expediente.expediente_fisico_eliminado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.expediente_fisico_eliminado IS 'Boolean que determina si un expediente ha sido eliminado fisicamente del establecimiento';


--
-- Name: COLUMN mnt_expediente.cun; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_expediente.cun IS 'Si el número de expediente es un Código Único de Nacimiento';


--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE mnt_expediente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_expediente_id_seq OWNER TO siblh;

--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE mnt_expediente_id_seq OWNED BY mnt_expediente.id;


--
-- Name: mnt_paciente; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_paciente (
    id bigint NOT NULL,
    primer_nombre character varying(25) NOT NULL,
    segundo_nombre character varying(25),
    tercer_nombre character varying(25),
    primer_apellido character varying(25) NOT NULL,
    segundo_apellido character varying(25),
    apellido_casada character varying(25),
    fecha_nacimiento date,
    hora_nacimiento time without time zone,
    id_pais_nacimiento integer,
    id_departamento_nacimiento integer,
    id_municipio_nacimiento integer,
    id_doc_ide_paciente integer,
    numero_doc_ide_paciente character varying(20),
    direccion character varying(200),
    telefono_casa character varying(10),
    id_departamento_domicilio integer,
    id_municipio_domicilio integer,
    id_canton_domicilio integer,
    area_geografica_domicilio integer,
    lugar_trabajo character varying(50),
    telefono_trabajo character varying(10),
    nombre_padre character varying(80),
    nombre_madre character varying(80),
    nombre_responsable character varying(80),
    direccion_responsable character varying(200),
    telefono_responsable character varying(10),
    id_parentesco_responsable integer,
    id_doc_ide_responsable integer,
    numero_doc_ide_responsable character varying(20),
    nombre_proporciono_datos character varying(80),
    id_doc_ide_proporciono_datos integer,
    numero_doc_ide_propor_datos character varying(20),
    observacion text,
    conocido_por character varying(70),
    estado integer DEFAULT 1 NOT NULL,
    id_paciente_inicial bigint,
    id_nacionalidad integer,
    id_sexo integer NOT NULL,
    id_parentesco_propor_datos integer,
    fecha_registro timestamp without time zone,
    id_user_reg integer,
    id_user_mod integer,
    fecha_mod timestamp without time zone,
    id_condicion_persona integer DEFAULT 4 NOT NULL,
    cotizante boolean,
    nombre_completo_fonetico text,
    apellido_completo_fonetico text,
    id_ocupacion smallint,
    id_estado_civil smallint
);


ALTER TABLE mnt_paciente OWNER TO siblh;

--
-- Name: TABLE mnt_paciente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE mnt_paciente IS 'Datos generales del paciente';


--
-- Name: COLUMN mnt_paciente.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id IS 'Este será considerado como el identificador único del paciente a nivel local; dentro de cada establecimiento';


--
-- Name: COLUMN mnt_paciente.primer_nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.primer_nombre IS 'Primer nombre del paciente';


--
-- Name: COLUMN mnt_paciente.segundo_nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.segundo_nombre IS 'Segundo nombre del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.tercer_nombre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.tercer_nombre IS 'Tercer nombre del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.primer_apellido; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.primer_apellido IS 'Primer apellido del paciente';


--
-- Name: COLUMN mnt_paciente.segundo_apellido; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.segundo_apellido IS 'Segundo apellido del paciente es opcional';


--
-- Name: COLUMN mnt_paciente.apellido_casada; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.apellido_casada IS 'Apellido de casada para paciente mujer';


--
-- Name: COLUMN mnt_paciente.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.fecha_nacimiento IS 'Fecha de nacimiento del paciente';


--
-- Name: COLUMN mnt_paciente.hora_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.hora_nacimiento IS 'Hora de nacimiento en caso se conociera';


--
-- Name: COLUMN mnt_paciente.id_pais_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_pais_nacimiento IS 'Foránea que representa el pais de nacimiento';


--
-- Name: COLUMN mnt_paciente.id_departamento_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_departamento_nacimiento IS 'Foránea que representa el departamento de nacimiento';


--
-- Name: COLUMN mnt_paciente.id_municipio_nacimiento; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_municipio_nacimiento IS 'Foránea que representa el municipio de nacimiento; sinonimo de Lugar de Nacimiento';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_paciente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_paciente IS 'Foránea que representa el tipo de documento de identidad del paciente';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_paciente; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_paciente IS 'Número del documento de identidad seleccionado para el paciente';


--
-- Name: COLUMN mnt_paciente.direccion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.direccion IS 'Direccion de donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.telefono_casa; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.telefono_casa IS 'Teléfono de contacto de casa en caso existiera';


--
-- Name: COLUMN mnt_paciente.id_departamento_domicilio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_departamento_domicilio IS 'Foránea que representa el departamento de domicilio del paciente';


--
-- Name: COLUMN mnt_paciente.id_municipio_domicilio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_municipio_domicilio IS 'Foránea que representa el municipio en donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.id_canton_domicilio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_canton_domicilio IS 'Foránea que representa el cantón en donde vive el paciente';


--
-- Name: COLUMN mnt_paciente.area_geografica_domicilio; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.area_geografica_domicilio IS 'Determina si vive en un área rural o urbana. 1=Rural; 2=Urbana';


--
-- Name: COLUMN mnt_paciente.lugar_trabajo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.lugar_trabajo IS 'Lugar donde trabaja el paciente, En caso trabajara';


--
-- Name: COLUMN mnt_paciente.telefono_trabajo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.telefono_trabajo IS 'Teléfono del trabajo, en caso existiera';


--
-- Name: COLUMN mnt_paciente.nombre_padre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.nombre_padre IS 'Nombre del padre, en caso lo conozca';


--
-- Name: COLUMN mnt_paciente.nombre_madre; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.nombre_madre IS 'Nombre de la madre, en caso lo conozca';


--
-- Name: COLUMN mnt_paciente.nombre_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.nombre_responsable IS 'Nombre del responsable del paciente';


--
-- Name: COLUMN mnt_paciente.direccion_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.direccion_responsable IS 'Direccion del responsable';


--
-- Name: COLUMN mnt_paciente.telefono_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.telefono_responsable IS 'Telefono del responsable del paciente en caso existiera';


--
-- Name: COLUMN mnt_paciente.id_parentesco_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_parentesco_responsable IS 'Foránea que representa el parentesco del paciente con el responsable';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_responsable IS 'Foránea que representa el documento de identidad del responsable';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_responsable; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_responsable IS 'Número del documento de identidad seleccionado para el responsable';


--
-- Name: COLUMN mnt_paciente.nombre_proporciono_datos; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.nombre_proporciono_datos IS 'Persona que proporciono los datos del paciente';


--
-- Name: COLUMN mnt_paciente.id_doc_ide_proporciono_datos; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_doc_ide_proporciono_datos IS 'Foránea que representa el documento de identidad del que proporciono datos';


--
-- Name: COLUMN mnt_paciente.numero_doc_ide_propor_datos; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.numero_doc_ide_propor_datos IS 'Número del documento de identidad seleccionado para el proporciono datos';


--
-- Name: COLUMN mnt_paciente.observacion; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.observacion IS 'Observaciones del expediente del paciente, Fusiones de expedientes, etc';


--
-- Name: COLUMN mnt_paciente.conocido_por; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.conocido_por IS 'Sobre-Nombre con el que es conocido popularmente el paciente';


--
-- Name: COLUMN mnt_paciente.estado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.estado IS 'Estado del paciente. 1=Vivo; 2= Fallecido; 3=Inactivo ';


--
-- Name: COLUMN mnt_paciente.id_paciente_inicial; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_paciente_inicial IS 'Número global del paciente';


--
-- Name: COLUMN mnt_paciente.id_nacionalidad; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_nacionalidad IS 'Foránea para la nacionalidad del paciente';


--
-- Name: COLUMN mnt_paciente.id_sexo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_sexo IS 'Foránea que representa el sexo del paciente';


--
-- Name: COLUMN mnt_paciente.id_parentesco_propor_datos; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_parentesco_propor_datos IS 'Foránea que representa el parentesco del paciente con la persona que proporionó los datos';


--
-- Name: COLUMN mnt_paciente.fecha_registro; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.fecha_registro IS 'Fecha en que fue creado el registro del paciente';


--
-- Name: COLUMN mnt_paciente.id_user_reg; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_user_reg IS 'Foránea que representa el usuario que registro los datos por primera vez del paciente';


--
-- Name: COLUMN mnt_paciente.id_user_mod; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.id_user_mod IS 'Foránea que representa el usuario que ha realizado la última modificación a los datos del paciente';


--
-- Name: COLUMN mnt_paciente.fecha_mod; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_paciente.fecha_mod IS 'Fecha de última modificación de datos de paciente
';


--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE mnt_paciente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_paciente_id_seq OWNER TO siblh;

--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE mnt_paciente_id_seq OWNED BY mnt_paciente.id;


--
-- Name: mnt_tipo_empleado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_tipo_empleado (
    id integer NOT NULL,
    codigo character varying(3) NOT NULL,
    tipo character varying(50) DEFAULT NULL::character varying,
    prescribe_medicamento boolean DEFAULT false NOT NULL
);


ALTER TABLE mnt_tipo_empleado OWNER TO siblh;

--
-- Name: TABLE mnt_tipo_empleado; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON TABLE mnt_tipo_empleado IS 'Almacena tipo de empleado';


--
-- Name: COLUMN mnt_tipo_empleado.id; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_tipo_empleado.id IS 'Llave primaria de la tabla';


--
-- Name: COLUMN mnt_tipo_empleado.codigo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_tipo_empleado.codigo IS 'Codigo del empleado';


--
-- Name: COLUMN mnt_tipo_empleado.tipo; Type: COMMENT; Schema: public; Owner: siblh
--

COMMENT ON COLUMN mnt_tipo_empleado.tipo IS 'Tipo de empleado';


--
-- Name: mnt_tipo_empleado_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE mnt_tipo_empleado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mnt_tipo_empleado_id_seq OWNER TO siblh;

--
-- Name: mnt_tipo_empleado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE mnt_tipo_empleado_id_seq OWNED BY mnt_tipo_empleado.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_acidez ALTER COLUMN id SET DEFAULT nextval('blh_acidez_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_microbiologico ALTER COLUMN id SET DEFAULT nextval('blh_analisis_microbiologico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_sensorial ALTER COLUMN id SET DEFAULT nextval('blh_analisis_sensorial_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_banco_de_leche ALTER COLUMN id SET DEFAULT nextval('blh_banco_de_leche_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_bitacora ALTER COLUMN id SET DEFAULT nextval('blh_bitacora_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_crematocrito ALTER COLUMN id SET DEFAULT nextval('blh_crematocrito_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_centro_recoleccion ALTER COLUMN id SET DEFAULT nextval('blh_ctl_centro_recoleccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_escolaridad ALTER COLUMN id SET DEFAULT nextval('blh_ctl_escolaridad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_forma_extraccion ALTER COLUMN id SET DEFAULT nextval('blh_ctl_forma_extraccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_habito_toxico ALTER COLUMN id SET DEFAULT nextval('blh_ctl_habito_toxico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_tipo_colecta ALTER COLUMN id SET DEFAULT nextval('blh_ctl_tipo_colecta_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_curva ALTER COLUMN id SET DEFAULT nextval('blh_curva_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion ALTER COLUMN id SET DEFAULT nextval('blh_donacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante ALTER COLUMN id SET DEFAULT nextval('blh_donante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_egreso_receptor ALTER COLUMN id SET DEFAULT nextval('blh_egreso_receptor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_estado ALTER COLUMN id SET DEFAULT nextval('blh_estado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen ALTER COLUMN id SET DEFAULT nextval('blh_examen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen_donante ALTER COLUMN id SET DEFAULT nextval('blh_examen_donante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado ALTER COLUMN id SET DEFAULT nextval('blh_frasco_procesado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado_solicitud ALTER COLUMN id SET DEFAULT nextval('blh_frasco_procesado_solicitud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado ALTER COLUMN id SET DEFAULT nextval('blh_frasco_recolectado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado_frasco_p ALTER COLUMN id SET DEFAULT nextval('blh_frasco_recolectado_frasco_p_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_grupo_solicitud ALTER COLUMN id SET DEFAULT nextval('blh_grupo_solicitud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historia_actual ALTER COLUMN id SET DEFAULT nextval('blh_historia_actual_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historial_clinico ALTER COLUMN id SET DEFAULT nextval('blh_historial_clinico_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_informacion_publica ALTER COLUMN id SET DEFAULT nextval('blh_informacion_publica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_lote_analisis ALTER COLUMN id SET DEFAULT nextval('blh_lote_analisis_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_menu ALTER COLUMN id SET DEFAULT nextval('blh_menu_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_opcion_menu ALTER COLUMN id SET DEFAULT nextval('blh_opcion_menu_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_pasteurizacion ALTER COLUMN id SET DEFAULT nextval('blh_pasteurizacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_personal ALTER COLUMN id SET DEFAULT nextval('blh_personal_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_receptor ALTER COLUMN id SET DEFAULT nextval('blh_receptor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol ALTER COLUMN id SET DEFAULT nextval('blh_rol_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol_menu ALTER COLUMN id SET DEFAULT nextval('blh_rol_menu_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_seguimiento_receptor ALTER COLUMN id SET DEFAULT nextval('blh_seguimiento_receptor_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_solicitud ALTER COLUMN id SET DEFAULT nextval('blh_solicitud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_enfriamiento ALTER COLUMN id SET DEFAULT nextval('blh_temperatura_enfriamiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_pasteurizacion ALTER COLUMN id SET DEFAULT nextval('blh_temperatura_pasteurizacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_area_geografica ALTER COLUMN id SET DEFAULT nextval('ctl_area_geografica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_atencion ALTER COLUMN id SET DEFAULT nextval('ctl_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_canton ALTER COLUMN id SET DEFAULT nextval('ctl_canton_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_condicion_persona ALTER COLUMN id SET DEFAULT nextval('ctl_condicion_persona_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_creacion_expediente ALTER COLUMN id SET DEFAULT nextval('ctl_creacion_expediente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_departamento ALTER COLUMN id SET DEFAULT nextval('ctl_departamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_documento_identidad ALTER COLUMN id SET DEFAULT nextval('ctl_documento_identidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento ALTER COLUMN id SET DEFAULT nextval('ctl_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_estado_civil ALTER COLUMN id SET DEFAULT nextval('ctl_estado_civil_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_institucion ALTER COLUMN id SET DEFAULT nextval('ctl_institucion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_municipio ALTER COLUMN id SET DEFAULT nextval('ctl_municipio_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_nacionalidad ALTER COLUMN id SET DEFAULT nextval('ctl_nacionalidad_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_ocupacion ALTER COLUMN id SET DEFAULT nextval('ctl_ocupacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_pais ALTER COLUMN id SET DEFAULT nextval('ctl_pais_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_parentesco ALTER COLUMN id SET DEFAULT nextval('ctl_parentesco_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_patologia ALTER COLUMN id SET DEFAULT nextval('ctl_patologia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_sexo ALTER COLUMN id SET DEFAULT nextval('ctl_sexo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_tipo_atencion ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_atencion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_tipo_establecimiento ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_tipo_patologia ALTER COLUMN id SET DEFAULT nextval('ctl_tipo_patologia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_group ALTER COLUMN id SET DEFAULT nextval('fos_user_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user ALTER COLUMN id SET DEFAULT nextval('fos_user_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_cargoempleados ALTER COLUMN id SET DEFAULT nextval('mnt_cargoempleados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_empleado ALTER COLUMN id SET DEFAULT nextval('mnt_empleado_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente ALTER COLUMN id SET DEFAULT nextval('mnt_expediente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente ALTER COLUMN id SET DEFAULT nextval('mnt_paciente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_tipo_empleado ALTER COLUMN id SET DEFAULT nextval('mnt_tipo_empleado_id_seq'::regclass);


--
-- Data for Name: blh_acidez; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_acidez (id, id_frasco_recolectado, acidez1, acidez2, acidez3, factor, resultado, media_acidez, usuario, id_user_reg, fecha_hora_reg) FROM stdin;
\.


--
-- Name: blh_acidez_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_acidez_id_seq', 1, false);


--
-- Data for Name: blh_analisis_microbiologico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_analisis_microbiologico (id, id_frasco_procesado, codigo_analisis_microbiologico, coliformes_totales, control, situacion, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_analisis_microbiologico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_analisis_microbiologico_id_seq', 1, false);


--
-- Data for Name: blh_analisis_sensorial; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_analisis_sensorial (id, embalaje, suciedad, color, flavor, observacion, usuario, id_frasco_recolectado, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_analisis_sensorial_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_analisis_sensorial_id_seq', 1, false);


--
-- Data for Name: blh_banco_de_leche; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_banco_de_leche (id, id_establecimiento, codigo_banco_de_leche, estado_banco, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_banco_de_leche_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_banco_de_leche_id_seq', 1, false);


--
-- Data for Name: blh_bitacora; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_bitacora (id, fecha_accion, codigo, tabla, usuario, accion, detalle, fecha_hora_reg, id_user_reg) FROM stdin;
1	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(1,4.00,5.00,6.00,5.00,2017-07-06,44,344.0000,15:08:00,,600,"2017-07-06 15:09:16",1)	\N	\N
2	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(1,4.00,5.00,6.00,5.00,2017-07-06,44,344.0000,15:08:00,,600,"2017-07-06 15:09:16",1)	\N	\N
3	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(1,4.00,5.00,6.00,5.00,2017-07-06,44,344.0000,15:08:00,,600,"2017-07-06 15:09:16",1)	\N	\N
4	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,15:12:00,,240,"2017-07-06 15:13:10",1)	\N	\N
5	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,15:12:00,,240,"2017-07-06 15:13:10",1)	\N	\N
6	2017-07-06	DATA BASE	blh_curva	siblh	I	INSERT(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,15:12:00,,240,"2017-07-06 15:13:10",1)	\N	\N
7	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,05:12:00,,540,"2017-07-06 15:13:10",1)	\N	\N
8	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,05:12:00,,540,"2017-07-06 15:13:10",1)	\N	\N
9	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,30.00,10.00,20.00,20.00,2017-07-04,11,200.0000,05:12:00,,540,"2017-07-06 15:13:10",1)	\N	\N
10	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,05:19:00,,440,"2017-07-06 15:13:10",1)	\N	\N
11	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,05:19:00,,440,"2017-07-06 15:13:10",1)	\N	\N
12	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,05:19:00,,440,"2017-07-06 15:13:10",1)	\N	\N
13	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
14	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
15	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
16	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
17	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
18	2017-07-06	DATA BASE	blh_curva	siblh	U	UPDATE(2,36.00,10.00,20.00,22.00,2017-11-24,18,390.0000,18:45:00,,440,"2017-07-06 15:13:10",1)	\N	\N
\.


--
-- Name: blh_bitacora_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_bitacora_id_seq', 1, false);


--
-- Data for Name: blh_crematocrito; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_crematocrito (id, crema1, crema2, crema3, ct1, ct2, ct3, media_crema, media_ct, porcentaje_crema, kilocalorias, usuario, id_frasco_recolectado, id_frasco_procesado, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_crematocrito_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_crematocrito_id_seq', 1, false);


--
-- Data for Name: blh_ctl_centro_recoleccion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_ctl_centro_recoleccion (id, nombre, telefono, fecha_hora_reg, id_user_reg, id_establecimiento, codigo, direccion, id_banco_de_leche) FROM stdin;
\.


--
-- Name: blh_ctl_centro_recoleccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_ctl_centro_recoleccion_id_seq', 1, false);


--
-- Data for Name: blh_ctl_escolaridad; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_ctl_escolaridad (id, nombre, codigo) FROM stdin;
\.


--
-- Name: blh_ctl_escolaridad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_ctl_escolaridad_id_seq', 1, false);


--
-- Data for Name: blh_ctl_forma_extraccion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_ctl_forma_extraccion (id, nombre, codigo) FROM stdin;
\.


--
-- Name: blh_ctl_forma_extraccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_ctl_forma_extraccion_id_seq', 1, false);


--
-- Data for Name: blh_ctl_habito_toxico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_ctl_habito_toxico (id, habito_toxico) FROM stdin;
\.


--
-- Name: blh_ctl_habito_toxico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_ctl_habito_toxico_id_seq', 1, false);


--
-- Data for Name: blh_ctl_tipo_colecta; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_ctl_tipo_colecta (id, nombre, codigo) FROM stdin;
\.


--
-- Name: blh_ctl_tipo_colecta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_ctl_tipo_colecta_id_seq', 1, false);


--
-- Data for Name: blh_curva; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_curva (id, tiempo1, tiempo2, tiempo3, valor_curva, fecha_curva, cantidad_frascos, volumen_por_frasco, hora_inicio_curva, usuario, volumen_total, fecha_hora_reg, id_user_reg) FROM stdin;
1	4.00	5.00	6.00	5.00	2017-07-06	44	344.0000	15:08:00	\N	600	2017-07-06 15:09:16	1
2	36.00	10.00	20.00	22.00	2017-11-24	18	390.0000	18:45:00	\N	440	2017-07-06 15:13:10	1
\.


--
-- Name: blh_curva_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_curva_id_seq', 2, true);


--
-- Data for Name: blh_donacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_donacion (id, id_banco_de_leche, codigo_donante, fecha_donacion, responsable_donacion, usuario, id_donante, id_centro_recoleccion, fecha_hora_reg, id_user_reg, id_responsable_donacion) FROM stdin;
\.


--
-- Name: blh_donacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_donacion_id_seq', 1, false);


--
-- Data for Name: blh_donante; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_donante (id, id_municipio, id_banco_de_leche, codigo_donante, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, fecha_registro_donante_blh, telefono_fijo, telefono_movil, direccion, procedencia, registro, numero_documento_identificacion, documento_identificacion, edad, ocupacion, estado_civil, nacionalidad, escolaridad, tipo_colecta, observaciones, estado, usuario, fecha_hora_reg, id_user_reg, id_estado_civil, id_ocupacion, id_escolaridad, id_tipo_colecta, id_doc_ide_donante) FROM stdin;
\.


--
-- Name: blh_donante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_donante_id_seq', 1, false);


--
-- Data for Name: blh_egreso_receptor; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_egreso_receptor (id, id_receptor, diagnostico_egreso, madre_canguro, tipo_egreso, comentario_egreso, traslado_periferico, permanencia_ucin, hospital_seguimiento_egreso, fecha_egreso, estancia_hospitalaria, usuario, dias_permanencia, id_establecimiento, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_egreso_receptor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_egreso_receptor_id_seq', 1, false);


--
-- Data for Name: blh_estado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_estado (id, nombre_estado, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_estado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_estado_id_seq', 1, false);


--
-- Data for Name: blh_examen; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_examen (id, nombre_examen, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Data for Name: blh_examen_donante; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_examen_donante (id, id_examen, resultado_examen, usuario, id_donante, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_examen_donante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_examen_donante_id_seq', 1, false);


--
-- Name: blh_examen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_examen_id_seq', 1, false);


--
-- Data for Name: blh_frasco_procesado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_frasco_procesado (id, id_estado, id_pasteurizacion, codigo_frasco_procesado, volumen_frasco_pasteurizado, acidez_total, kcalorias_totales, observacion_frasco_procesado, volumen_disponible_fp, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_frasco_procesado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_frasco_procesado_id_seq', 1, false);


--
-- Data for Name: blh_frasco_procesado_solicitud; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_frasco_procesado_solicitud (id, id_solicitud, volumen_despachado, usuario, id_frasco_procesado, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_frasco_procesado_solicitud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_frasco_procesado_solicitud_id_seq', 1, false);


--
-- Data for Name: blh_frasco_recolectado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_frasco_recolectado (id, id_estado, id_lote_analisis, id_donante, id_donacion, codigo_frasco_recolectado, volumen_recolectado, forma_extraccion, onz_recolectado, observacion_frasco_recolectado, volumen_disponible_fr, usuario, volumen_real, fecha_hora_reg, id_user_reg, id_forma_extraccion) FROM stdin;
\.


--
-- Data for Name: blh_frasco_recolectado_frasco_p; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_frasco_recolectado_frasco_p (id, volumen_agregado, usuario, id_frasco_recolectado, id_frasco_procesado, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_frasco_recolectado_frasco_p_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_frasco_recolectado_frasco_p_id_seq', 1, false);


--
-- Name: blh_frasco_recolectado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_frasco_recolectado_id_seq', 1, false);


--
-- Data for Name: blh_grupo_solicitud; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_grupo_solicitud (id, codigo_grupo_solicitud, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_grupo_solicitud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_grupo_solicitud_id_seq', 1, false);


--
-- Data for Name: blh_historia_actual; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_historia_actual (id, peso_donante, talla_donante, medicamento, habito_toxico, motivo_donacion, patologia, imc, estado_donante, usuario, id_donante, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_historia_actual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_historia_actual_id_seq', 1, false);


--
-- Data for Name: blh_historial_clinico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_historial_clinico (id, control_prenatal, edad_gest_fur, lugar_control, numero_control, fecha_parto, lugar_parto, patologia_embarazo, periodo_intergenesico, fecha_parto_anterior, formula_obstetrica_g, formula_obstetrica_p1, formula_obstetrica_p2, formula_obstetrica_a, formula_obstetrica_v, formula_obstetrica_m, usuario, id_donante, id_establecimiento, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_historial_clinico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_historial_clinico_id_seq', 1, false);


--
-- Data for Name: blh_informacion_publica; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_informacion_publica (id, id_banco_de_leche, path, tipo, nombre_documento, fecha_publicacion, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_informacion_publica_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_informacion_publica_id_seq', 1, false);


--
-- Data for Name: blh_lote_analisis; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_lote_analisis (id, codigo_lote_analisis, fecha_analisis_fisico_quimico, responsable_analisis, usuario, fecha_hora_reg, id_user_reg, id_responsable_analisis) FROM stdin;
\.


--
-- Name: blh_lote_analisis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_lote_analisis_id_seq', 1, false);


--
-- Data for Name: blh_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_menu (id, nombre_menu, descripcion_menu, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_menu_id_seq', 1, false);


--
-- Data for Name: blh_opcion_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_opcion_menu (id, id_menu, nombre_opcion, url_opcion, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_opcion_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_opcion_menu_id_seq', 1, false);


--
-- Data for Name: blh_pasteurizacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_pasteurizacion (id, id_curva, codigo_pasteurizacion, num_ciclo, volumen_pasteurizado, num_frascos_pasteurizados, fecha_pasteurizacion, responsable_pasteurizacion, usuario, volumen_total, fecha_hora_reg, id_user_reg, id_responsable_pasteurizacion) FROM stdin;
\.


--
-- Name: blh_pasteurizacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_pasteurizacion_id_seq', 1, false);


--
-- Data for Name: blh_personal; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_personal (id, nombre, usuario, id_establecimiento, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_personal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_personal_id_seq', 1, false);


--
-- Data for Name: blh_receptor; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_receptor (id, id_banco_de_leche, id_paciente, codigo_receptor, fecha_registro_blh, procedencia, estado_receptor, edad_dias, peso_receptor, duracion_cpap, clasificacion_lubchengo, diagnostico_ingreso, duracion_npt, apgar_primer_minuto, edad_gest_fur, duracion_ventilacion, edad_gest_ballard, pc, talla_ingreso, apgar_quinto_minuto, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_receptor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_receptor_id_seq', 1, false);


--
-- Data for Name: blh_rol; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_rol (id, nombre_rol, descripcion_rol, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_rol_id_seq', 1, false);


--
-- Data for Name: blh_rol_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_rol_menu (id, id_menu, id_rol, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_rol_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_rol_menu_id_seq', 1, false);


--
-- Data for Name: blh_seguimiento_receptor; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_seguimiento_receptor (id, talla_receptor, peso_seguimiento, pc_seguimiento, ganancia_dia_peso, semana, fecha_seguimiento, ganancia_dia_talla, complicaciones, observacion, periodo_evaluacion, ganancia_dia_pc, usuario, id_receptor, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_seguimiento_receptor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_seguimiento_receptor_id_seq', 1, false);


--
-- Data for Name: blh_solicitud; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_solicitud (id, id_grupo_solicitud, codigo_solicitud, volumen_por_dia, acidez_necesaria, calorias_necesarias, peso_dia, volumen_por_toma, toma_por_dia, fecha_solicitud, cuna, estado, responsable, usuario, id_receptor, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_solicitud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_solicitud_id_seq', 1, false);


--
-- Data for Name: blh_temperatura_enfriamiento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_temperatura_enfriamiento (id, temperatura_e, usuario, id_pasteurizacion, hora_inicio_e, hora_final_e, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_temperatura_enfriamiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_temperatura_enfriamiento_id_seq', 1, false);


--
-- Data for Name: blh_temperatura_pasteurizacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_temperatura_pasteurizacion (id, temperatura_p, usuario, id_pasteurizacion, hora_inicio_p, hora_final_p, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_temperatura_pasteurizacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_temperatura_pasteurizacion_id_seq', 1, false);


--
-- Data for Name: ctl_area_geografica; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_area_geografica (id, nombre, abreviatura) FROM stdin;
\.


--
-- Name: ctl_area_geografica_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_area_geografica_id_seq', 1, false);


--
-- Data for Name: ctl_atencion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_atencion (id, nombre, id_atencion_padre, id_tipo_atencion, codigo_busqueda) FROM stdin;
\.


--
-- Name: ctl_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_atencion_id_seq', 1, false);


--
-- Data for Name: ctl_canton; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_canton (id, nombre, codigo_digestyc, id_municipio) FROM stdin;
\.


--
-- Name: ctl_canton_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_canton_id_seq', 1, false);


--
-- Data for Name: ctl_condicion_persona; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_condicion_persona (id, nombre, descripcion, abreviatura) FROM stdin;
\.


--
-- Name: ctl_condicion_persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_condicion_persona_id_seq', 1, false);


--
-- Data for Name: ctl_creacion_expediente; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_creacion_expediente (id, area) FROM stdin;
\.


--
-- Name: ctl_creacion_expediente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_creacion_expediente_id_seq', 1, false);


--
-- Data for Name: ctl_departamento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_departamento (id, nombre, codigo_cnr, abreviatura, id_pais, id_establecimiento_region, iso31662) FROM stdin;
\.


--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_departamento_id_seq', 1, false);


--
-- Data for Name: ctl_documento_identidad; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_documento_identidad (id, nombre) FROM stdin;
\.


--
-- Name: ctl_documento_identidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_documento_identidad_id_seq', 1, false);


--
-- Data for Name: ctl_establecimiento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_establecimiento (id, id_tipo_establecimiento, nombre, direccion, telefono, fax, latitud, longitud, id_municipio, id_nivel_minsal, cod_ucsf, activo, id_establecimiento_padre, tipo_expediente, configurado, id_institucion) FROM stdin;
\.


--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_establecimiento_id_seq', 1, false);


--
-- Data for Name: ctl_estado_civil; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_estado_civil (id, nombre) FROM stdin;
1	Soltero(a)
2	Casado(a)
3	Divorciado(a)
4	Viudo(a)
5	Acompañado(a)
\.


--
-- Name: ctl_estado_civil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_estado_civil_id_seq', 5, true);


--
-- Data for Name: ctl_institucion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_institucion (id, nombre, id_pais, logo, rectora, categoria, sigla, estado) FROM stdin;
\.


--
-- Name: ctl_institucion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_institucion_id_seq', 1, false);


--
-- Data for Name: ctl_municipio; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_municipio (id, nombre, codigo_cnr, abreviatura, id_departamento) FROM stdin;
\.


--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_municipio_id_seq', 1, false);


--
-- Data for Name: ctl_nacionalidad; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_nacionalidad (id, nacionalidad) FROM stdin;
\.


--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_nacionalidad_id_seq', 1, false);


--
-- Data for Name: ctl_ocupacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_ocupacion (id, nombre) FROM stdin;
1	PROFESIONAL
2	TECNICO
3	FUNCIONARIO PUBLICO
4	PERSONAL ADMINISTRATIV
5	COMERCIANTE Y VENDEDOR
6	SERVICIO PROFESIONAL
7	CONDUCTOR DE MAQUINA
8	MOTORISTA
9	NINGUNA ACTIVIDAD
10	ALBAÑIL
11	SASTRE
12	DOMESTICO
13	LIC EN LAB CLINICO
14	PROFESOR@
15	PASTOR
16	RELIGIOS@
17	COSTURERA
18	MECANICO
19	MECANICO EN OBRA DE BC
20	AYUDANTE DE MECANICO
21	COSMETOLOGA
22	JORNALERO
23	SECRETARIA
24	MODISTA
25	MECANICO DELTAL
26	BARBERO
27	CARPINTERO
28	VENDEDOR
29	AGRICULTOR EN PEQUEÑO
30	EMPLEADO INFORMAL
31	CUERPOS UNIFORMADOS
32	DESEMPLEADO(A)
33	NO APLICA
34	AMA DE CASA
35	ESTUDIANTE
36	TRABAJADOR AGRICOLA
37	OBREROS NO AGRICOLAS
38	OTROS
39	EMPLEADO
40	PENSIONADO/JUBILADO
41	COMERCIANTE
\.


--
-- Name: ctl_ocupacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_ocupacion_id_seq', 41, true);


--
-- Data for Name: ctl_pais; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_pais (id, nombre, activo) FROM stdin;
\.


--
-- Name: ctl_pais_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_pais_id_seq', 1, false);


--
-- Data for Name: ctl_parentesco; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_parentesco (id, parentesco) FROM stdin;
\.


--
-- Name: ctl_parentesco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_parentesco_id_seq', 1, false);


--
-- Data for Name: ctl_patologia; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_patologia (id, nombre, id_patologia_padre, id_tipo_patologia, notificacion) FROM stdin;
\.


--
-- Name: ctl_patologia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_patologia_id_seq', 1, false);


--
-- Data for Name: ctl_sexo; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_sexo (id, nombre, abreviatura) FROM stdin;
\.


--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_sexo_id_seq', 1, false);


--
-- Data for Name: ctl_tipo_atencion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_tipo_atencion (id, nombre, id_tipo_atencion_padre) FROM stdin;
\.


--
-- Name: ctl_tipo_atencion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_tipo_atencion_id_seq', 1, false);


--
-- Data for Name: ctl_tipo_establecimiento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_tipo_establecimiento (id, nombre, codigo, id_institucion) FROM stdin;
\.


--
-- Name: ctl_tipo_establecimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_tipo_establecimiento_id_seq', 1, false);


--
-- Data for Name: ctl_tipo_patologia; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_tipo_patologia (id, nombre, descripcion) FROM stdin;
\.


--
-- Name: ctl_tipo_patologia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_tipo_patologia_id_seq', 1, false);


--
-- Data for Name: fos_user_group; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY fos_user_group (id, name, roles) FROM stdin;
\.


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('fos_user_group_id_seq', 1, false);


--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, id_establecimiento, id_empleado) FROM stdin;
1	admin_farid	admin_farid	dfhernandez@salud.gob.sv	dfhernandez@salud.gob.sv	t	kdshk09nra8kgwgo4k4w4ow40s88c44	R4jCF1idD1yaAh6aPN0Ob37o3VdomJx6MRq917w7CacJ3fkJStxlOaMqb49ihpuV96sHuYxbyC4KAPpNti/LFQ==	2017-07-06 15:49:15	f	f	\N	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2017-07-04 13:51:30	2017-07-06 15:49:15	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	\N
\.


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY fos_user_user_group (user_id, group_id) FROM stdin;
\.


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('fos_user_user_id_seq', 1, true);


--
-- Data for Name: mnt_cargoempleados; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_cargoempleados (id, cargo, id_atencion) FROM stdin;
\.


--
-- Name: mnt_cargoempleados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_cargoempleados_id_seq', 1, false);


--
-- Data for Name: mnt_empleado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_empleado (id, nombre, apellido, fecha_nacimiento, dui, numero_junta_vigilancia, numero_celular, correo_electronico, id_establecimiento, correlativo, id_cargo_empleado, firma_digital, id_tipo_empleado, id_user_reg, fecha_hora_reg, id_user_mod, fecha_hora_mod, nombre_empleado, habilitado, id_establecimiento_externo, residente, id_nuevo_empleado) FROM stdin;
\.


--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_empleado_id_seq', 1, false);


--
-- Data for Name: mnt_expediente; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_expediente (id, numero, id_paciente, id_establecimiento, habilitado, id_creacion_expediente, fecha_creacion, hora_creacion, numero_temporal, expediente_fisico_eliminado, cun) FROM stdin;
\.


--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_expediente_id_seq', 1, false);


--
-- Data for Name: mnt_paciente; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_paciente (id, primer_nombre, segundo_nombre, tercer_nombre, primer_apellido, segundo_apellido, apellido_casada, fecha_nacimiento, hora_nacimiento, id_pais_nacimiento, id_departamento_nacimiento, id_municipio_nacimiento, id_doc_ide_paciente, numero_doc_ide_paciente, direccion, telefono_casa, id_departamento_domicilio, id_municipio_domicilio, id_canton_domicilio, area_geografica_domicilio, lugar_trabajo, telefono_trabajo, nombre_padre, nombre_madre, nombre_responsable, direccion_responsable, telefono_responsable, id_parentesco_responsable, id_doc_ide_responsable, numero_doc_ide_responsable, nombre_proporciono_datos, id_doc_ide_proporciono_datos, numero_doc_ide_propor_datos, observacion, conocido_por, estado, id_paciente_inicial, id_nacionalidad, id_sexo, id_parentesco_propor_datos, fecha_registro, id_user_reg, id_user_mod, fecha_mod, id_condicion_persona, cotizante, nombre_completo_fonetico, apellido_completo_fonetico, id_ocupacion, id_estado_civil) FROM stdin;
\.


--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_paciente_id_seq', 1, false);


--
-- Data for Name: mnt_tipo_empleado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_tipo_empleado (id, codigo, tipo, prescribe_medicamento) FROM stdin;
\.


--
-- Name: mnt_tipo_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_tipo_empleado_id_seq', 1, false);


--
-- Name: fos_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_group
    ADD CONSTRAINT fos_user_group_pkey PRIMARY KEY (id);


--
-- Name: fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- Name: fos_user_user_pkey; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fos_user_user_pkey PRIMARY KEY (id);


--
-- Name: idx_codigo_escolaridad; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_escolaridad
    ADD CONSTRAINT idx_codigo_escolaridad UNIQUE (codigo);


--
-- Name: idx_codigo_forma_extraccion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_forma_extraccion
    ADD CONSTRAINT idx_codigo_forma_extraccion UNIQUE (codigo);


--
-- Name: idx_codigo_tipo_colecta; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_tipo_colecta
    ADD CONSTRAINT idx_codigo_tipo_colecta UNIQUE (codigo);


--
-- Name: idx_id_id_paciente; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT idx_id_id_paciente UNIQUE (id, id_paciente);


--
-- Name: idx_numero_expediente; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT idx_numero_expediente UNIQUE (numero);


--
-- Name: pk_blh_acidez; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_acidez
    ADD CONSTRAINT pk_blh_acidez PRIMARY KEY (id);


--
-- Name: pk_blh_analisis_microbiologico; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_analisis_microbiologico
    ADD CONSTRAINT pk_blh_analisis_microbiologico PRIMARY KEY (id);


--
-- Name: pk_blh_analisis_sensorial; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_analisis_sensorial
    ADD CONSTRAINT pk_blh_analisis_sensorial PRIMARY KEY (id);


--
-- Name: pk_blh_banco_de_leche; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_banco_de_leche
    ADD CONSTRAINT pk_blh_banco_de_leche PRIMARY KEY (id);


--
-- Name: pk_blh_bitacora; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_bitacora
    ADD CONSTRAINT pk_blh_bitacora PRIMARY KEY (id);


--
-- Name: pk_blh_crematocrito; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_crematocrito
    ADD CONSTRAINT pk_blh_crematocrito PRIMARY KEY (id);


--
-- Name: pk_blh_ctl_centro_recoleccion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_centro_recoleccion
    ADD CONSTRAINT pk_blh_ctl_centro_recoleccion PRIMARY KEY (id);


--
-- Name: pk_blh_ctl_escolaridad; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_escolaridad
    ADD CONSTRAINT pk_blh_ctl_escolaridad PRIMARY KEY (id);


--
-- Name: pk_blh_ctl_forma_extraccion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_forma_extraccion
    ADD CONSTRAINT pk_blh_ctl_forma_extraccion PRIMARY KEY (id);


--
-- Name: pk_blh_ctl_tipo_colecta; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_tipo_colecta
    ADD CONSTRAINT pk_blh_ctl_tipo_colecta PRIMARY KEY (id);


--
-- Name: pk_blh_curva; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_curva
    ADD CONSTRAINT pk_blh_curva PRIMARY KEY (id);


--
-- Name: pk_blh_donacion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT pk_blh_donacion PRIMARY KEY (id);


--
-- Name: pk_blh_donante; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT pk_blh_donante PRIMARY KEY (id);


--
-- Name: pk_blh_egreso_receptor; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_egreso_receptor
    ADD CONSTRAINT pk_blh_egreso_receptor PRIMARY KEY (id);


--
-- Name: pk_blh_estado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_estado
    ADD CONSTRAINT pk_blh_estado PRIMARY KEY (id);


--
-- Name: pk_blh_examen; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_examen
    ADD CONSTRAINT pk_blh_examen PRIMARY KEY (id);


--
-- Name: pk_blh_examen_donante; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_examen_donante
    ADD CONSTRAINT pk_blh_examen_donante PRIMARY KEY (id);


--
-- Name: pk_blh_frasco_procesado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_frasco_procesado
    ADD CONSTRAINT pk_blh_frasco_procesado PRIMARY KEY (id);


--
-- Name: pk_blh_frasco_procesado_solici; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_frasco_procesado_solicitud
    ADD CONSTRAINT pk_blh_frasco_procesado_solici PRIMARY KEY (id);


--
-- Name: pk_blh_frasco_recolectado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT pk_blh_frasco_recolectado PRIMARY KEY (id);


--
-- Name: pk_blh_frasco_recolectado_fras; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_frasco_recolectado_frasco_p
    ADD CONSTRAINT pk_blh_frasco_recolectado_fras PRIMARY KEY (id);


--
-- Name: pk_blh_grupo_solicitud; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_grupo_solicitud
    ADD CONSTRAINT pk_blh_grupo_solicitud PRIMARY KEY (id);


--
-- Name: pk_blh_historia_actual; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_historia_actual
    ADD CONSTRAINT pk_blh_historia_actual PRIMARY KEY (id);


--
-- Name: pk_blh_historial_clinico; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_historial_clinico
    ADD CONSTRAINT pk_blh_historial_clinico PRIMARY KEY (id);


--
-- Name: pk_blh_informacion_publica; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_informacion_publica
    ADD CONSTRAINT pk_blh_informacion_publica PRIMARY KEY (id);


--
-- Name: pk_blh_lote_analisis; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_lote_analisis
    ADD CONSTRAINT pk_blh_lote_analisis PRIMARY KEY (id);


--
-- Name: pk_blh_menu; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_menu
    ADD CONSTRAINT pk_blh_menu PRIMARY KEY (id);


--
-- Name: pk_blh_opcion_menu; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_opcion_menu
    ADD CONSTRAINT pk_blh_opcion_menu PRIMARY KEY (id);


--
-- Name: pk_blh_pasteurizacion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_pasteurizacion
    ADD CONSTRAINT pk_blh_pasteurizacion PRIMARY KEY (id);


--
-- Name: pk_blh_personal; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_personal
    ADD CONSTRAINT pk_blh_personal PRIMARY KEY (id);


--
-- Name: pk_blh_receptor; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_receptor
    ADD CONSTRAINT pk_blh_receptor PRIMARY KEY (id);


--
-- Name: pk_blh_rol; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_rol
    ADD CONSTRAINT pk_blh_rol PRIMARY KEY (id);


--
-- Name: pk_blh_rol_menu; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_rol_menu
    ADD CONSTRAINT pk_blh_rol_menu PRIMARY KEY (id);


--
-- Name: pk_blh_seguimiento_receptor; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_seguimiento_receptor
    ADD CONSTRAINT pk_blh_seguimiento_receptor PRIMARY KEY (id);


--
-- Name: pk_blh_solicitud; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_solicitud
    ADD CONSTRAINT pk_blh_solicitud PRIMARY KEY (id);


--
-- Name: pk_blh_temperatura_enfriamient; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_temperatura_enfriamiento
    ADD CONSTRAINT pk_blh_temperatura_enfriamient PRIMARY KEY (id);


--
-- Name: pk_blh_temperatura_pasteurizac; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_temperatura_pasteurizacion
    ADD CONSTRAINT pk_blh_temperatura_pasteurizac PRIMARY KEY (id);


--
-- Name: pk_condicion_persona; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_condicion_persona
    ADD CONSTRAINT pk_condicion_persona PRIMARY KEY (id);


--
-- Name: pk_ctl_area_geografica; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_area_geografica
    ADD CONSTRAINT pk_ctl_area_geografica PRIMARY KEY (id);


--
-- Name: pk_ctl_canton; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_canton
    ADD CONSTRAINT pk_ctl_canton PRIMARY KEY (id);


--
-- Name: pk_ctl_creacion_establecimiento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_creacion_expediente
    ADD CONSTRAINT pk_ctl_creacion_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_departamento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT pk_ctl_departamento PRIMARY KEY (id);


--
-- Name: pk_ctl_especialidad; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT pk_ctl_especialidad PRIMARY KEY (id);


--
-- Name: pk_ctl_establecimiento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT pk_ctl_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_estado_civil; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_estado_civil
    ADD CONSTRAINT pk_ctl_estado_civil PRIMARY KEY (id);


--
-- Name: pk_ctl_institucion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_institucion
    ADD CONSTRAINT pk_ctl_institucion PRIMARY KEY (id);


--
-- Name: pk_ctl_municipio; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT pk_ctl_municipio PRIMARY KEY (id);


--
-- Name: pk_ctl_nacionalidad; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_nacionalidad
    ADD CONSTRAINT pk_ctl_nacionalidad PRIMARY KEY (id);


--
-- Name: pk_ctl_ocupacion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_ocupacion
    ADD CONSTRAINT pk_ctl_ocupacion PRIMARY KEY (id);


--
-- Name: pk_ctl_pais; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_pais
    ADD CONSTRAINT pk_ctl_pais PRIMARY KEY (id);


--
-- Name: pk_ctl_parentesco; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_parentesco
    ADD CONSTRAINT pk_ctl_parentesco PRIMARY KEY (id);


--
-- Name: pk_ctl_patologia; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_patologia
    ADD CONSTRAINT pk_ctl_patologia PRIMARY KEY (id);


--
-- Name: pk_ctl_tipo_atencion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_atencion
    ADD CONSTRAINT pk_ctl_tipo_atencion PRIMARY KEY (id);


--
-- Name: pk_ctl_tipo_establecimiento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_establecimiento
    ADD CONSTRAINT pk_ctl_tipo_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_tipo_patologia; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_tipo_patologia
    ADD CONSTRAINT pk_ctl_tipo_patologia PRIMARY KEY (id);


--
-- Name: pk_hab; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY blh_ctl_habito_toxico
    ADD CONSTRAINT pk_hab PRIMARY KEY (id);


--
-- Name: pk_id_ctl_sexo; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_sexo
    ADD CONSTRAINT pk_id_ctl_sexo PRIMARY KEY (id);


--
-- Name: pk_mnt_cargo_empleado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_cargoempleados
    ADD CONSTRAINT pk_mnt_cargo_empleado PRIMARY KEY (id);


--
-- Name: pk_mnt_documento_identidad; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_documento_identidad
    ADD CONSTRAINT pk_mnt_documento_identidad PRIMARY KEY (id);


--
-- Name: pk_mnt_empleado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT pk_mnt_empleado PRIMARY KEY (id);


--
-- Name: pk_mnt_expediente; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT pk_mnt_expediente PRIMARY KEY (id);


--
-- Name: pk_mnt_paciente; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT pk_mnt_paciente PRIMARY KEY (id);


--
-- Name: pk_mnt_tipo_empleado; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY mnt_tipo_empleado
    ADD CONSTRAINT pk_mnt_tipo_empleado PRIMARY KEY (id);


--
-- Name: fk__donante_examen_donante; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk__donante_examen_donante ON blh_examen_donante USING btree (id_examen);


--
-- Name: fk_banco_de_leche_donacion; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_banco_de_leche_donacion ON blh_donacion USING btree (id_banco_de_leche);


--
-- Name: fk_banco_de_leche_donante; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_banco_de_leche_donante ON blh_donante USING btree (id_banco_de_leche);


--
-- Name: fk_banco_de_leche_informacion_p; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_banco_de_leche_informacion_p ON blh_informacion_publica USING btree (id_banco_de_leche);


--
-- Name: fk_banco_de_leche_receptor; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_banco_de_leche_receptor ON blh_receptor USING btree (id_banco_de_leche);


--
-- Name: fk_curva_pasteurizacion; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_curva_pasteurizacion ON blh_pasteurizacion USING btree (id_curva);


--
-- Name: fk_donacion_frasco_recolectado; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_donacion_frasco_recolectado ON blh_frasco_recolectado USING btree (id_donacion);


--
-- Name: fk_donante_frasco_recolectado; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_donante_frasco_recolectado ON blh_frasco_recolectado USING btree (id_donante);


--
-- Name: fk_establecimiento_banco_de_lec; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_establecimiento_banco_de_lec ON blh_banco_de_leche USING btree (id_establecimiento);


--
-- Name: fk_estado_frasco_recolectado; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_estado_frasco_recolectado ON blh_frasco_recolectado USING btree (id_estado);


--
-- Name: fk_frasco_procesado_analisis_mi; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_frasco_procesado_analisis_mi ON blh_analisis_microbiologico USING btree (id_frasco_procesado);


--
-- Name: fk_frasco_reco_acid; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_frasco_reco_acid ON blh_acidez USING btree (id_frasco_recolectado);


--
-- Name: fk_frasco_recolectado_lote_anal; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_frasco_recolectado_lote_anal ON blh_frasco_recolectado USING btree (id_lote_analisis);


--
-- Name: fk_grupo_solicitud_solicitud; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_grupo_solicitud_solicitud ON blh_solicitud USING btree (id_grupo_solicitud);


--
-- Name: fk_menu_opcion_menu; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_menu_opcion_menu ON blh_opcion_menu USING btree (id_menu);


--
-- Name: fk_menu_rol_menu; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_menu_rol_menu ON blh_rol_menu USING btree (id_menu);


--
-- Name: fk_municipio_donante; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_municipio_donante ON blh_donante USING btree (id_municipio);


--
-- Name: fk_paciente_receptor; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_paciente_receptor ON blh_receptor USING btree (id_paciente);


--
-- Name: fk_pasteurizacion_frasco_proces; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_pasteurizacion_frasco_proces ON blh_frasco_procesado USING btree (id_pasteurizacion);


--
-- Name: fk_receptor_egreso_receptor; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_receptor_egreso_receptor ON blh_egreso_receptor USING btree (id_receptor);


--
-- Name: fk_rol_rol_menu; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_rol_rol_menu ON blh_rol_menu USING btree (id_rol);


--
-- Name: fk_solicitud_frasco_procesado_s; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_solicitud_frasco_procesado_s ON blh_frasco_procesado_solicitud USING btree (id_solicitud);


--
-- Name: fki_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_b3c77447a76ed395 ON fos_user_user_group USING btree (user_id);


--
-- Name: fki_blh_dona_fk_naciona_blh; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_blh_dona_fk_naciona_blh ON blh_donante USING btree (nacionalidad);


--
-- Name: fki_blh_dona_fk_nacionalidad_blh; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_blh_dona_fk_nacionalidad_blh ON blh_donante USING btree (nacionalidad);


--
-- Name: fki_blh_his_fk_hab_tox; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_blh_his_fk_hab_tox ON blh_historia_actual USING btree (habito_toxico);


--
-- Name: fki_blh_his_fk_pat; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_blh_his_fk_pat ON blh_historia_actual USING btree (patologia);


--
-- Name: fki_blh_his_hab; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_blh_his_hab ON blh_historia_actual USING btree (habito_toxico);


--
-- Name: fki_patologia_patologia; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_patologia_patologia ON ctl_patologia USING btree (id_patologia_padre);


--
-- Name: fki_tipo_patologia_patologia; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fki_tipo_patologia_patologia ON ctl_patologia USING btree (id_tipo_patologia);


--
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX idx_b3c77447fe54d947 ON fos_user_user_group USING btree (group_id);


--
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE UNIQUE INDEX uniq_583d1f3e5e237e06 ON fos_user_group USING btree (name);


--
-- Name: trg_actualizar_curva; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_actualizar_curva BEFORE UPDATE ON blh_curva FOR EACH ROW EXECUTE PROCEDURE fn_calcularcurva();


--
-- Name: trg_actualizar_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_actualizar_donante BEFORE UPDATE ON blh_donante FOR EACH ROW EXECUTE PROCEDURE fn_actualizar_donante();


--
-- Name: trg_after_acidez; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_acidez AFTER INSERT OR DELETE OR UPDATE ON blh_acidez FOR EACH ROW EXECUTE PROCEDURE fn_after_acidez();


--
-- Name: trg_after_analisis_microbiologico; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_analisis_microbiologico AFTER INSERT OR DELETE OR UPDATE ON blh_analisis_microbiologico FOR EACH ROW EXECUTE PROCEDURE fn_after_analisis_microbiologico();


--
-- Name: trg_after_analisis_sensorial; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_analisis_sensorial AFTER INSERT OR DELETE OR UPDATE ON blh_analisis_sensorial FOR EACH ROW EXECUTE PROCEDURE fn_after_analisis_sensorial();


--
-- Name: trg_after_banco_de_leche; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_banco_de_leche AFTER INSERT OR DELETE OR UPDATE ON blh_banco_de_leche FOR EACH ROW EXECUTE PROCEDURE fn_after_banco_de_leche();


--
-- Name: trg_after_crematocrito; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_crematocrito AFTER INSERT ON blh_crematocrito FOR EACH ROW EXECUTE PROCEDURE fn_after_crematocrito();


--
-- Name: trg_after_curva; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_curva AFTER INSERT OR DELETE OR UPDATE ON blh_curva FOR EACH ROW EXECUTE PROCEDURE fn_after_curva();


--
-- Name: trg_after_donacion; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_donacion AFTER INSERT OR DELETE OR UPDATE ON blh_donacion FOR EACH ROW EXECUTE PROCEDURE fn_after_donacion();


--
-- Name: trg_after_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_donante AFTER INSERT OR DELETE OR UPDATE ON blh_donante FOR EACH ROW EXECUTE PROCEDURE fn_after_donante();


--
-- Name: trg_after_egreso_receptor; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_egreso_receptor AFTER INSERT OR DELETE OR UPDATE ON blh_egreso_receptor FOR EACH ROW EXECUTE PROCEDURE fn_after_egreso_receptor();


--
-- Name: trg_after_examen; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_examen AFTER INSERT OR DELETE OR UPDATE ON blh_examen FOR EACH ROW EXECUTE PROCEDURE fn_after_examen();


--
-- Name: trg_after_examen_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_examen_donante AFTER INSERT OR DELETE OR UPDATE ON blh_examen_donante FOR EACH ROW EXECUTE PROCEDURE fn_after_examen_donante();


--
-- Name: trg_after_frasco_procesado; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_frasco_procesado AFTER INSERT OR DELETE OR UPDATE ON blh_frasco_procesado FOR EACH ROW EXECUTE PROCEDURE fn_after_frasco_procesado();


--
-- Name: trg_after_frasco_procesado_solicitud; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_frasco_procesado_solicitud AFTER INSERT OR DELETE OR UPDATE ON blh_frasco_procesado_solicitud FOR EACH ROW EXECUTE PROCEDURE fn_after_frasco_procesado_solicitud();


--
-- Name: trg_after_frasco_recolectado; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_frasco_recolectado AFTER INSERT OR DELETE OR UPDATE ON blh_frasco_recolectado FOR EACH ROW EXECUTE PROCEDURE fn_after_frasco_recolectado();


--
-- Name: trg_after_frasco_recolectado_frasco_p; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_frasco_recolectado_frasco_p AFTER INSERT OR DELETE OR UPDATE ON blh_frasco_recolectado_frasco_p FOR EACH ROW EXECUTE PROCEDURE fn_after_frasco_recolectado_frasco_p();


--
-- Name: trg_after_grupo_solicitud; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_grupo_solicitud AFTER INSERT OR DELETE OR UPDATE ON blh_grupo_solicitud FOR EACH ROW EXECUTE PROCEDURE fn_after_grupo_solicitud();


--
-- Name: trg_after_historia_actual; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_historia_actual AFTER INSERT OR DELETE OR UPDATE ON blh_historia_actual FOR EACH ROW EXECUTE PROCEDURE fn_after_historia_actual();


--
-- Name: trg_after_historial_clinico; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_historial_clinico AFTER INSERT OR DELETE OR UPDATE ON blh_historial_clinico FOR EACH ROW EXECUTE PROCEDURE fn_after_historial_clinico();


--
-- Name: trg_after_lote_analisis; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_lote_analisis AFTER INSERT OR DELETE OR UPDATE ON blh_lote_analisis FOR EACH ROW EXECUTE PROCEDURE fn_after_lote_analisis();


--
-- Name: trg_after_pasteurizacion; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_pasteurizacion AFTER INSERT OR DELETE OR UPDATE ON blh_pasteurizacion FOR EACH ROW EXECUTE PROCEDURE fn_after_pasteurizacion();


--
-- Name: trg_after_personal; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_personal AFTER INSERT OR DELETE OR UPDATE ON blh_personal FOR EACH ROW EXECUTE PROCEDURE fn_after_personal();


--
-- Name: trg_after_receptor; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_receptor AFTER INSERT OR DELETE OR UPDATE ON blh_receptor FOR EACH ROW EXECUTE PROCEDURE fn_after_receptor();


--
-- Name: trg_after_seguimiento_receptor; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_seguimiento_receptor AFTER INSERT OR DELETE OR UPDATE ON blh_seguimiento_receptor FOR EACH ROW EXECUTE PROCEDURE fn_after_seguimiento_receptor();


--
-- Name: trg_after_solicitud; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_solicitud AFTER INSERT OR DELETE OR UPDATE ON blh_solicitud FOR EACH ROW EXECUTE PROCEDURE fn_after_solicitud();


--
-- Name: trg_after_temperatura_enfriamiento; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_temperatura_enfriamiento AFTER INSERT OR DELETE OR UPDATE ON blh_curva FOR EACH ROW EXECUTE PROCEDURE fn_after_temperatura_enfriamiento();


--
-- Name: trg_after_temperatura_pasteurizacion; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_temperatura_pasteurizacion AFTER INSERT OR DELETE OR UPDATE ON blh_curva FOR EACH ROW EXECUTE PROCEDURE fn_after_temperatura_pasteurizacion();


--
-- Name: trg_calcular_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_calcular_donante BEFORE INSERT ON blh_donante FOR EACH ROW EXECUTE PROCEDURE fn_insertar_donante();


--
-- Name: trg_calcular_solicitud; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_calcular_solicitud BEFORE INSERT ON blh_solicitud FOR EACH ROW EXECUTE PROCEDURE fn_insertar_solicitud();


--
-- Name: trg_ciclo_past; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_ciclo_past BEFORE INSERT ON blh_pasteurizacion FOR EACH ROW EXECUTE PROCEDURE fn_insertar_frecolectado_ciclo();


--
-- Name: trg_curva; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_curva BEFORE INSERT ON blh_curva FOR EACH ROW EXECUTE PROCEDURE fn_calcularcurva();


--
-- Name: trg_estado_am; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_estado_am BEFORE INSERT ON blh_analisis_microbiologico FOR EACH ROW EXECUTE PROCEDURE generar_codigo_microbiologico();


--
-- Name: trg_estado_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_estado_donante AFTER INSERT ON blh_egreso_receptor FOR EACH ROW EXECUTE PROCEDURE fn_estado_receptor();


--
-- Name: trg_generar_cod_donante; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_generar_cod_donante BEFORE INSERT ON blh_donante FOR EACH ROW EXECUTE PROCEDURE fn_insertar_donante();


--
-- Name: trg_generar_cod_receptor; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_generar_cod_receptor BEFORE INSERT ON blh_receptor FOR EACH ROW EXECUTE PROCEDURE fn_insertar_receptor();


--
-- Name: trg_generar_cod_solicitud; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_generar_cod_solicitud BEFORE INSERT ON blh_solicitud FOR EACH ROW EXECUTE PROCEDURE fn_insertar_solicitud();


--
-- Name: trg_nuevo_fprocesado; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_nuevo_fprocesado BEFORE INSERT ON blh_frasco_procesado FOR EACH ROW EXECUTE PROCEDURE fn_insertar_fprocesado();


--
-- Name: trg_nuevo_frecolectado; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_nuevo_frecolectado BEFORE INSERT ON blh_frasco_recolectado FOR EACH ROW EXECUTE PROCEDURE fn_insertar_frecolectado();


--
-- Name: blh_ctl_centro_recoleccion_blh_donacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT blh_ctl_centro_recoleccion_blh_donacion_fk FOREIGN KEY (id_centro_recoleccion) REFERENCES blh_ctl_centro_recoleccion(id);


--
-- Name: blh_donante_blh_donacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT blh_donante_blh_donacion_fk FOREIGN KEY (id_donante) REFERENCES blh_donante(id);


--
-- Name: blh_donante_blh_examen_donante_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen_donante
    ADD CONSTRAINT blh_donante_blh_examen_donante_fk FOREIGN KEY (id_donante) REFERENCES blh_donante(id);


--
-- Name: blh_donante_blh_historia_actual_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historia_actual
    ADD CONSTRAINT blh_donante_blh_historia_actual_fk FOREIGN KEY (id_donante) REFERENCES blh_donante(id);


--
-- Name: blh_donante_blh_historial_clinico_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historial_clinico
    ADD CONSTRAINT blh_donante_blh_historial_clinico_fk FOREIGN KEY (id_donante) REFERENCES blh_donante(id);


--
-- Name: blh_estado_blh_frasco_procesado_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado
    ADD CONSTRAINT blh_estado_blh_frasco_procesado_fk FOREIGN KEY (id_estado) REFERENCES blh_estado(id);


--
-- Name: blh_frasco_procesado_blh_crematocrito_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_crematocrito
    ADD CONSTRAINT blh_frasco_procesado_blh_crematocrito_fk FOREIGN KEY (id_frasco_procesado) REFERENCES blh_frasco_procesado(id);


--
-- Name: blh_frasco_procesado_blh_frasco_procesado_solicitud_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado_solicitud
    ADD CONSTRAINT blh_frasco_procesado_blh_frasco_procesado_solicitud_fk FOREIGN KEY (id_frasco_procesado) REFERENCES blh_frasco_procesado(id);


--
-- Name: blh_frasco_procesado_blh_frasco_recolectado_frasco_p_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado_frasco_p
    ADD CONSTRAINT blh_frasco_procesado_blh_frasco_recolectado_frasco_p_fk FOREIGN KEY (id_frasco_procesado) REFERENCES blh_frasco_procesado(id);


--
-- Name: blh_frasco_recolectado_blh_analisis_sensorial_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_sensorial
    ADD CONSTRAINT blh_frasco_recolectado_blh_analisis_sensorial_fk FOREIGN KEY (id_frasco_recolectado) REFERENCES blh_frasco_recolectado(id);


--
-- Name: blh_frasco_recolectado_blh_crematocrito_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_crematocrito
    ADD CONSTRAINT blh_frasco_recolectado_blh_crematocrito_fk FOREIGN KEY (id_frasco_recolectado) REFERENCES blh_frasco_recolectado(id);


--
-- Name: blh_frasco_recolectado_blh_frasco_recolectado_frasco_p_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado_frasco_p
    ADD CONSTRAINT blh_frasco_recolectado_blh_frasco_recolectado_frasco_p_fk FOREIGN KEY (id_frasco_recolectado) REFERENCES blh_frasco_recolectado(id);


--
-- Name: blh_pasteurizacion_blh_temperatura_enfriamiento_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_enfriamiento
    ADD CONSTRAINT blh_pasteurizacion_blh_temperatura_enfriamiento_fk FOREIGN KEY (id_pasteurizacion) REFERENCES blh_pasteurizacion(id);


--
-- Name: blh_pasteurizacion_blh_temperatura_pasteurizacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_pasteurizacion
    ADD CONSTRAINT blh_pasteurizacion_blh_temperatura_pasteurizacion_fk FOREIGN KEY (id_pasteurizacion) REFERENCES blh_pasteurizacion(id);


--
-- Name: blh_receptor_blh_seguimiento_receptor_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_seguimiento_receptor
    ADD CONSTRAINT blh_receptor_blh_seguimiento_receptor_fk FOREIGN KEY (id_receptor) REFERENCES blh_receptor(id);


--
-- Name: blh_receptor_blh_solicitud_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_solicitud
    ADD CONSTRAINT blh_receptor_blh_solicitud_fk FOREIGN KEY (id_receptor) REFERENCES blh_receptor(id);


--
-- Name: ctl_establecimiento_blh_egreso_receptor_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_egreso_receptor
    ADD CONSTRAINT ctl_establecimiento_blh_egreso_receptor_fk FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: ctl_establecimiento_blh_historial_clinico_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historial_clinico
    ADD CONSTRAINT ctl_establecimiento_blh_historial_clinico_fk FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: ctl_establecimiento_blh_personal_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_personal
    ADD CONSTRAINT ctl_establecimiento_blh_personal_fk FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_3123f0d4f57d32fd; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_institucion
    ADD CONSTRAINT fk_3123f0d4f57d32fd FOREIGN KEY (id_pais) REFERENCES ctl_pais(id);


--
-- Name: fk_area_geografica_domicio; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_area_geografica_domicio FOREIGN KEY (area_geografica_domicilio) REFERENCES ctl_area_geografica(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_atencion_atencion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT fk_atencion_atencion FOREIGN KEY (id_atencion_padre) REFERENCES ctl_atencion(id);


--
-- Name: fk_atencion_cargo_empleado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_cargoempleados
    ADD CONSTRAINT fk_atencion_cargo_empleado FOREIGN KEY (id_atencion) REFERENCES ctl_atencion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES fos_user_group(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_banco_leche_centro_recoleccion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_centro_recoleccion
    ADD CONSTRAINT fk_banco_leche_centro_recoleccion FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_acid_fk_frasc_rec; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_acidez
    ADD CONSTRAINT fk_blh_acid_fk_frasc_rec FOREIGN KEY (id_frasco_recolectado) REFERENCES blh_frasco_recolectado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_anal_fk_frasco_blh_fras; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_microbiologico
    ADD CONSTRAINT fk_blh_anal_fk_frasco_blh_fras FOREIGN KEY (id_frasco_procesado) REFERENCES blh_frasco_procesado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_banc_fk_establ_ctl_esta; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_banco_de_leche
    ADD CONSTRAINT fk_blh_banc_fk_establ_ctl_esta FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_dona_fk_banco__blh_banc; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT fk_blh_dona_fk_banco__blh_banc FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_dona_fk_banco__blh_banc; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_blh_dona_fk_banco__blh_banc FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_dona_fk_munici_ctl_muni; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_blh_dona_fk_munici_ctl_muni FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_dona_fk_nacionalidad_blh; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_blh_dona_fk_nacionalidad_blh FOREIGN KEY (nacionalidad) REFERENCES ctl_nacionalidad(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_egre_receptor__blh_rece; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_egreso_receptor
    ADD CONSTRAINT fk_blh_egre_receptor__blh_rece FOREIGN KEY (id_receptor) REFERENCES blh_receptor(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_exam_examen_do_blh_exam; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen_donante
    ADD CONSTRAINT fk_blh_exam_examen_do_blh_exam FOREIGN KEY (id_examen) REFERENCES blh_examen(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_estado_fr_blh_esta; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_blh_fras_estado_fr_blh_esta FOREIGN KEY (id_estado) REFERENCES blh_estado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_fk_donaci_blh_dona; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_blh_fras_fk_donaci_blh_dona FOREIGN KEY (id_donacion) REFERENCES blh_donacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_fk_donant_blh_dona; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_blh_fras_fk_donant_blh_dona FOREIGN KEY (id_donante) REFERENCES blh_donante(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_fk_solici_blh_soli; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado_solicitud
    ADD CONSTRAINT fk_blh_fras_fk_solici_blh_soli FOREIGN KEY (id_solicitud) REFERENCES blh_solicitud(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_frasco_re_blh_lote; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_blh_fras_frasco_re_blh_lote FOREIGN KEY (id_lote_analisis) REFERENCES blh_lote_analisis(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_fras_pasteuriz_blh_past; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado
    ADD CONSTRAINT fk_blh_fras_pasteuriz_blh_past FOREIGN KEY (id_pasteurizacion) REFERENCES blh_pasteurizacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_his_fk_pat; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historia_actual
    ADD CONSTRAINT fk_blh_his_fk_pat FOREIGN KEY (patologia) REFERENCES ctl_patologia(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_his_hab; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historia_actual
    ADD CONSTRAINT fk_blh_his_hab FOREIGN KEY (habito_toxico) REFERENCES blh_ctl_habito_toxico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_info_fk_banco__blh_banc; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_informacion_publica
    ADD CONSTRAINT fk_blh_info_fk_banco__blh_banc FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_opci_fk_menu_o_blh_menu; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_opcion_menu
    ADD CONSTRAINT fk_blh_opci_fk_menu_o_blh_menu FOREIGN KEY (id_menu) REFERENCES blh_menu(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_past_pasteuriz_blh_curv; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_pasteurizacion
    ADD CONSTRAINT fk_blh_past_pasteuriz_blh_curv FOREIGN KEY (id_curva) REFERENCES blh_curva(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_rece_fk_banco__blh_banc; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_receptor
    ADD CONSTRAINT fk_blh_rece_fk_banco__blh_banc FOREIGN KEY (id_banco_de_leche) REFERENCES blh_banco_de_leche(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_rece_fk_pacien_mnt_paci; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_receptor
    ADD CONSTRAINT fk_blh_rece_fk_pacien_mnt_paci FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_rol__rol_menu2_blh_rol; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol_menu
    ADD CONSTRAINT fk_blh_rol__rol_menu2_blh_rol FOREIGN KEY (id_rol) REFERENCES blh_rol(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_rol__rol_menu_blh_menu; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol_menu
    ADD CONSTRAINT fk_blh_rol__rol_menu_blh_menu FOREIGN KEY (id_menu) REFERENCES blh_menu(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_blh_soli_fk_grupo__blh_grup; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_solicitud
    ADD CONSTRAINT fk_blh_soli_fk_grupo__blh_grup FOREIGN KEY (id_grupo_solicitud) REFERENCES blh_grupo_solicitud(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_canton_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_canton_paciente_domicilio FOREIGN KEY (id_canton_domicilio) REFERENCES ctl_canton(id);


--
-- Name: fk_cargoempleados_empleado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_cargoempleados_empleado FOREIGN KEY (id_cargo_empleado) REFERENCES mnt_cargoempleados(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_condicion_persona_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_condicion_persona_paciente FOREIGN KEY (id_condicion_persona) REFERENCES ctl_condicion_persona(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_creacion_expediente_expediente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_creacion_expediente_expediente FOREIGN KEY (id_creacion_expediente) REFERENCES ctl_creacion_expediente(id);


--
-- Name: fk_ctl_institucion_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_ctl_institucion_establecimiento FOREIGN KEY (id_institucion) REFERENCES ctl_institucion(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_departamento_municipio; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT fk_departamento_municipio FOREIGN KEY (id_departamento) REFERENCES ctl_departamento(id);


--
-- Name: fk_departamento_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_departamento_paciente_domicilio FOREIGN KEY (id_departamento_domicilio) REFERENCES ctl_departamento(id);


--
-- Name: fk_departamento_paciente_nacimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_departamento_paciente_nacimiento FOREIGN KEY (id_departamento_nacimiento) REFERENCES ctl_departamento(id);


--
-- Name: fk_documente_identidad_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_documente_identidad_donante FOREIGN KEY (id_doc_ide_donante) REFERENCES ctl_documento_identidad(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_documente_identidad_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documente_identidad_paciente FOREIGN KEY (id_doc_ide_paciente) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_documento_identidad_proporciono_datos; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documento_identidad_proporciono_datos FOREIGN KEY (id_doc_ide_proporciono_datos) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_documento_identidad_responsable; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_documento_identidad_responsable FOREIGN KEY (id_doc_ide_responsable) REFERENCES ctl_documento_identidad(id);


--
-- Name: fk_empleado_fos_user; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_empleado_fos_user FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_escolaridad_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_escolaridad_donante FOREIGN KEY (id_escolaridad) REFERENCES blh_ctl_escolaridad(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT fk_establecimiento FOREIGN KEY (id_establecimiento_region) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_centro_recoleccion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_centro_recoleccion
    ADD CONSTRAINT fk_establecimiento_centro_recoleccion FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_empleado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_establecimiento_empleado FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_establecimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_establecimiento_establecimiento FOREIGN KEY (id_establecimiento_padre) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_expediente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_establecimiento_expediente FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: fk_establecimiento_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_establecimiento_fos_user_user FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_establecmiento_empleado_ext; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_establecmiento_empleado_ext FOREIGN KEY (id_establecimiento_externo) REFERENCES ctl_establecimiento(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_estado_civil_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_estado_civil_donante FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id);


--
-- Name: fk_estado_civil_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_estado_civil_paciente FOREIGN KEY (id_estado_civil) REFERENCES ctl_estado_civil(id);


--
-- Name: fk_forma_extraccion_frasco_recolectado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_forma_extraccion_frasco_recolectado FOREIGN KEY (id_forma_extraccion) REFERENCES blh_ctl_forma_extraccion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_municipio_canton; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_canton
    ADD CONSTRAINT fk_municipio_canton FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_municipio_establecimiento FOREIGN KEY (id_municipio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_paciente_domicilio; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_municipio_paciente_domicilio FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id);


--
-- Name: fk_municipio_paciente_nacimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_municipio_paciente_nacimiento FOREIGN KEY (id_municipio_nacimiento) REFERENCES ctl_municipio(id);


--
-- Name: fk_nacionalidad_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_nacionalidad_paciente FOREIGN KEY (id_nacionalidad) REFERENCES ctl_nacionalidad(id);


--
-- Name: fk_ocupacio_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_ocupacio_donante FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_ocupacion_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_ocupacion_paciente FOREIGN KEY (id_ocupacion) REFERENCES ctl_ocupacion(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_paciente_expediente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT fk_paciente_expediente FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id);


--
-- Name: fk_pais_departamento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT fk_pais_departamento FOREIGN KEY (id_pais) REFERENCES ctl_pais(id);


--
-- Name: fk_pais_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_pais_paciente FOREIGN KEY (id_pais_nacimiento) REFERENCES ctl_pais(id);


--
-- Name: fk_parentesco_paciente_propor_datos; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_parentesco_paciente_propor_datos FOREIGN KEY (id_parentesco_propor_datos) REFERENCES ctl_parentesco(id);


--
-- Name: fk_parentesco_paciente_responsable; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_parentesco_paciente_responsable FOREIGN KEY (id_parentesco_responsable) REFERENCES ctl_parentesco(id);


--
-- Name: fk_patologia_patologia; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_patologia
    ADD CONSTRAINT fk_patologia_patologia FOREIGN KEY (id_patologia_padre) REFERENCES ctl_patologia(id);


--
-- Name: fk_responsable_analisis_lote_analisis; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_lote_analisis
    ADD CONSTRAINT fk_responsable_analisis_lote_analisis FOREIGN KEY (id_responsable_analisis) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_responsable_donacion_donacion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT fk_responsable_donacion_donacion FOREIGN KEY (id_responsable_donacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_responsable_pasteurizacion_pasteurizacion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_pasteurizacion
    ADD CONSTRAINT fk_responsable_pasteurizacion_pasteurizacion FOREIGN KEY (id_responsable_pasteurizacion) REFERENCES mnt_empleado(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_sexo__paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_sexo__paciente FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id);


--
-- Name: fk_tipo_atencion_atencion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_atencion
    ADD CONSTRAINT fk_tipo_atencion_atencion FOREIGN KEY (id_tipo_atencion) REFERENCES ctl_tipo_atencion(id);


--
-- Name: fk_tipo_colecta_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_tipo_colecta_donante FOREIGN KEY (id_tipo_colecta) REFERENCES blh_ctl_tipo_colecta(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tipo_empleado_empleado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_empleado
    ADD CONSTRAINT fk_tipo_empleado_empleado FOREIGN KEY (id_tipo_empleado) REFERENCES mnt_tipo_empleado(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_tipo_establecimiento_establecimiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT fk_tipo_establecimiento_establecimiento FOREIGN KEY (id_tipo_establecimiento) REFERENCES ctl_tipo_establecimiento(id);


--
-- Name: fk_tipo_patologia_patologia; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_patologia
    ADD CONSTRAINT fk_tipo_patologia_patologia FOREIGN KEY (id_tipo_patologia) REFERENCES ctl_tipo_patologia(id);


--
-- Name: fk_user_paciente; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_user_paciente FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_paciente_mod; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_user_paciente_mod FOREIGN KEY (id_user_mod) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_acidez; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_acidez
    ADD CONSTRAINT fk_user_reg_acidez FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_analisis_microbiologico; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_microbiologico
    ADD CONSTRAINT fk_user_reg_analisis_microbiologico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_analisis_sensorial; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_analisis_sensorial
    ADD CONSTRAINT fk_user_reg_analisis_sensorial FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_banco_de_leche; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_banco_de_leche
    ADD CONSTRAINT fk_user_reg_banco_de_leche FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_bitacora; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_bitacora
    ADD CONSTRAINT fk_user_reg_bitacora FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_centro_recoleccion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_ctl_centro_recoleccion
    ADD CONSTRAINT fk_user_reg_centro_recoleccion FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_crematocrito; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_crematocrito
    ADD CONSTRAINT fk_user_reg_crematocrito FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_curva; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_curva
    ADD CONSTRAINT fk_user_reg_curva FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_donacion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT fk_user_reg_donacion FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donante
    ADD CONSTRAINT fk_user_reg_donante FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_egreso_receptor; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_egreso_receptor
    ADD CONSTRAINT fk_user_reg_egreso_receptor FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_estado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_estado
    ADD CONSTRAINT fk_user_reg_estado FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_examen; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen
    ADD CONSTRAINT fk_user_reg_examen FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_examen_donante; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_examen_donante
    ADD CONSTRAINT fk_user_reg_examen_donante FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_frasco_procesado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado
    ADD CONSTRAINT fk_user_reg_frasco_procesado FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_frasco_procesado_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_procesado_solicitud
    ADD CONSTRAINT fk_user_reg_frasco_procesado_solicitud FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_frasco_recolectado; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado
    ADD CONSTRAINT fk_user_reg_frasco_recolectado FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_frasco_recolectado_frasco_p; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_frasco_recolectado_frasco_p
    ADD CONSTRAINT fk_user_reg_frasco_recolectado_frasco_p FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_grupo_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_grupo_solicitud
    ADD CONSTRAINT fk_user_reg_grupo_solicitud FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_historia_actual; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historia_actual
    ADD CONSTRAINT fk_user_reg_historia_actual FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_historial_clinico; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_historial_clinico
    ADD CONSTRAINT fk_user_reg_historial_clinico FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_informacion_publica; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_informacion_publica
    ADD CONSTRAINT fk_user_reg_informacion_publica FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_lote_analisis; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_lote_analisis
    ADD CONSTRAINT fk_user_reg_lote_analisis FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_menu; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_menu
    ADD CONSTRAINT fk_user_reg_menu FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_opcion_menu; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_opcion_menu
    ADD CONSTRAINT fk_user_reg_opcion_menu FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_pasteurizacion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_pasteurizacion
    ADD CONSTRAINT fk_user_reg_pasteurizacion FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_personal; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_personal
    ADD CONSTRAINT fk_user_reg_personal FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_receptor; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_receptor
    ADD CONSTRAINT fk_user_reg_receptor FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_rol; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol
    ADD CONSTRAINT fk_user_reg_rol FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_rol_menu; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_rol_menu
    ADD CONSTRAINT fk_user_reg_rol_menu FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_seguimiento_receptor; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_seguimiento_receptor
    ADD CONSTRAINT fk_user_reg_seguimiento_receptor FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_solicitud
    ADD CONSTRAINT fk_user_reg_solicitud FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_temperatura_enfriamiento; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_enfriamiento
    ADD CONSTRAINT fk_user_reg_temperatura_enfriamiento FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_reg_temperatura_pasteurizacion; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_temperatura_pasteurizacion
    ADD CONSTRAINT fk_user_reg_temperatura_pasteurizacion FOREIGN KEY (id_user_reg) REFERENCES fos_user_user(id) ON UPDATE CASCADE ON DELETE RESTRICT;


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

