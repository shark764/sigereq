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
    id_user_reg integer
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
    id_user_reg integer
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
    id_user_reg integer
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
    id_user_reg integer
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
    id_user_reg integer
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
-- Name: ctl_centro_recoleccion; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_centro_recoleccion (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    telefono character varying(15) NOT NULL,
    fecha_hora_reg timestamp without time zone,
    id_user_reg integer
);


ALTER TABLE ctl_centro_recoleccion OWNER TO siblh;

--
-- Name: ctl_centro_recoleccion_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_centro_recoleccion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_centro_recoleccion_id_seq OWNER TO siblh;

--
-- Name: ctl_centro_recoleccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_centro_recoleccion_id_seq OWNED BY ctl_centro_recoleccion.id;


--
-- Name: ctl_departamento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_departamento (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    codigo_cnr character varying(5),
    abreviatura character varying(5)
);


ALTER TABLE ctl_departamento OWNER TO siblh;

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
-- Name: ctl_establecimiento; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_establecimiento (
    id integer NOT NULL,
    nombre character varying(150) NOT NULL,
    direccion character varying(250) NOT NULL,
    telefono character varying(15) NOT NULL,
    fax character varying(15)
);


ALTER TABLE ctl_establecimiento OWNER TO siblh;

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
-- Name: ctl_habito_toxico; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_habito_toxico (
    id integer NOT NULL,
    habito_toxico character varying(20) NOT NULL
);


ALTER TABLE ctl_habito_toxico OWNER TO siblh;

--
-- Name: ctl_habito_toxico_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE ctl_habito_toxico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ctl_habito_toxico_id_seq OWNER TO siblh;

--
-- Name: ctl_habito_toxico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE ctl_habito_toxico_id_seq OWNED BY ctl_habito_toxico.id;


--
-- Name: ctl_municipio; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_municipio (
    id integer NOT NULL,
    id_departamento integer NOT NULL,
    nombre character varying(150) NOT NULL,
    codigo_cnr character varying(5),
    abreviatura character varying(5)
);


ALTER TABLE ctl_municipio OWNER TO siblh;

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
    nacionalidad character varying(100) NOT NULL
);


ALTER TABLE ctl_nacionalidad OWNER TO siblh;

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
-- Name: ctl_patologia; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE ctl_patologia (
    id integer NOT NULL,
    patologia character varying(50) NOT NULL
);


ALTER TABLE ctl_patologia OWNER TO siblh;

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
-- Name: despacho; Type: VIEW; Schema: public; Owner: siblh
--

CREATE VIEW despacho AS
 SELECT DISTINCT fp.id,
    fp.codigo_frasco_procesado,
    fp.acidez_total,
    fp.kcalorias_totales,
    fp.observacion_frasco_procesado,
    (fp.volumen_frasco_pasteurizado - COALESCE(( SELECT sum(a.despachado) AS suma
           FROM ( SELECT max(fpss.volumen_despachado) AS despachado,
                    s.id_grupo_solicitud
                   FROM blh_frasco_procesado_solicitud fpss,
                    blh_solicitud s
                  WHERE ((fpss.id_solicitud = s.id) AND (fpss.id_frasco_procesado = fp.id))
                  GROUP BY s.id_grupo_solicitud) a), (0)::numeric)) AS volumen_restante
   FROM (blh_frasco_procesado fp
     LEFT JOIN blh_frasco_procesado_solicitud fps ON ((fp.id = fps.id_frasco_procesado)))
  WHERE (((fp.volumen_frasco_pasteurizado - COALESCE(( SELECT sum(a.despachado) AS suma
           FROM ( SELECT max(fpss.volumen_despachado) AS despachado,
                    s.id_grupo_solicitud
                   FROM blh_frasco_procesado_solicitud fpss,
                    blh_solicitud s
                  WHERE ((fpss.id_solicitud = s.id) AND (fpss.id_frasco_procesado = fp.id))
                  GROUP BY s.id_grupo_solicitud) a), (0)::numeric)) > (0)::numeric) AND (fp.id_estado = 2))
  ORDER BY fp.id;


ALTER TABLE despacho OWNER TO siblh;

--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text
);


ALTER TABLE fos_user_group OWNER TO siblh;

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
    id_rol integer,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255),
    password character varying(255),
    last_login timestamp without time zone,
    locked boolean,
    expired boolean,
    expires_at timestamp without time zone,
    confirmation_token character varying(255),
    password_requested_at timestamp without time zone,
    roles text,
    credentials_expired boolean,
    credentials_expire_at timestamp without time zone,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    date_of_birth timestamp without time zone,
    firstname character varying(64),
    lastname character varying(64),
    website character varying(64),
    biography character varying(255),
    gender character varying(1),
    locale character varying(8),
    timezone character varying(64),
    phone character varying(64),
    facebook_uid character varying(255),
    facebook_name character varying(255),
    facebook_data text,
    twitter_uid character varying(255),
    twitter_name character varying(255),
    twitter_data text,
    gplus_uid character varying(255),
    gplus_name character varying(255),
    gplus_data text,
    token character varying(255),
    two_step_code character varying(255),
    usuario integer,
    id_establecimiento integer,
    id_empleado integer
);


ALTER TABLE fos_user_user OWNER TO siblh;

--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE fos_user_user_group (
    id integer NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE fos_user_user_group OWNER TO siblh;

--
-- Name: fos_user_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: siblh
--

CREATE SEQUENCE fos_user_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_user_group_id_seq OWNER TO siblh;

--
-- Name: fos_user_user_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: siblh
--

ALTER SEQUENCE fos_user_user_group_id_seq OWNED BY fos_user_user_group.id;


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
-- Name: mnt_empleado; Type: TABLE; Schema: public; Owner: siblh; Tablespace: 
--

CREATE TABLE mnt_empleado (
    id integer NOT NULL
);


ALTER TABLE mnt_empleado OWNER TO siblh;

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
    id integer NOT NULL,
    numero character varying(10),
    id_paciente integer NOT NULL,
    id_establecimiento integer NOT NULL
);


ALTER TABLE mnt_expediente OWNER TO siblh;

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
    id integer NOT NULL,
    id_sexo integer NOT NULL,
    id_municipio_domicilio integer NOT NULL,
    hora_nacimiento time without time zone,
    fecha_nacimiento date NOT NULL,
    primer_nombre character varying(25) NOT NULL,
    segundo_nombre character varying(25),
    tercer_nombre character varying(25),
    primer_apellido character varying(25) NOT NULL,
    segundo_apellido character varying(25),
    direccion character varying(100) NOT NULL
);


ALTER TABLE mnt_paciente OWNER TO siblh;

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

ALTER TABLE ONLY ctl_centro_recoleccion ALTER COLUMN id SET DEFAULT nextval('ctl_centro_recoleccion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_departamento ALTER COLUMN id SET DEFAULT nextval('ctl_departamento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_establecimiento ALTER COLUMN id SET DEFAULT nextval('ctl_establecimiento_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_habito_toxico ALTER COLUMN id SET DEFAULT nextval('ctl_habito_toxico_id_seq'::regclass);


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

ALTER TABLE ONLY ctl_patologia ALTER COLUMN id SET DEFAULT nextval('ctl_patologia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_sexo ALTER COLUMN id SET DEFAULT nextval('ctl_sexo_id_seq'::regclass);


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

ALTER TABLE ONLY fos_user_user_group ALTER COLUMN id SET DEFAULT nextval('fos_user_user_group_id_seq'::regclass);


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
-- Data for Name: blh_acidez; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_acidez (id, id_frasco_recolectado, acidez1, acidez2, acidez3, factor, resultado, media_acidez, usuario, id_user_reg, fecha_hora_reg) FROM stdin;
1	1	3	3	3	0.9000	2.7000	3.0000	4	\N	\N
2	1	3	3	3	0.9000	2.7000	3.0000	4	\N	\N
3	2	10	10	10	0.9000	9.0000	10.0000	4	\N	\N
4	4	5	5	7	0.9000	5.1000	5.6700	4	\N	\N
5	9	5	5	5	1.0000	5.0000	5.0000	4	\N	\N
6	13	5	5	5	1.0000	5.0000	5.0000	4	\N	\N
\.


--
-- Name: blh_acidez_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_acidez_id_seq', 6, true);


--
-- Data for Name: blh_analisis_microbiologico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_analisis_microbiologico (id, id_frasco_procesado, codigo_analisis_microbiologico, coliformes_totales, control, situacion, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_analisis_microbiologico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_analisis_microbiologico_id_seq', 1, true);


--
-- Data for Name: blh_analisis_sensorial; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_analisis_sensorial (id, embalaje, suciedad, color, flavor, observacion, usuario, id_frasco_recolectado, fecha_hora_reg, id_user_reg) FROM stdin;
1	Aprobado	Aprobado	Aprobado	Aprobado	NA	4	1	\N	\N
2	Aprobado	Aprobado	Aprobado	Aprobado	B	4	2	\N	\N
3	Aprobado	Aprobado	Aprobado	Aprobado	B	4	4	\N	\N
4	Aprobado	Aprobado	Aprobado	Aprobado	na	4	13	\N	\N
5	Aprobado	Aprobado	Aprobado	Aprobado	na	4	9	\N	\N
\.


--
-- Name: blh_analisis_sensorial_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_analisis_sensorial_id_seq', 5, true);


--
-- Data for Name: blh_banco_de_leche; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_banco_de_leche (id, id_establecimiento, codigo_banco_de_leche, estado_banco, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
2	25	BLH-02	Activo	\N	\N	\N
3	49	BLH-03	Activo	\N	\N	\N
1	36	BLH-01	Activo	\N	\N	\N
5	1	BLH-04	Activo	\N	\N	\N
7	12	BLH-06	Activo	\N	\N	\N
8	12	BLH-07	Activo	\N	\N	\N
9	18	BLH-08	Activo	\N	\N	\N
6	12	BLH-05	Activo	\N	\N	\N
10	24	BLH-09	Activo	\N	\N	\N
11	14	BLH-10	Activo	\N	\N	\N
12	18	BLH-11	Activo	\N	\N	\N
\.


--
-- Name: blh_banco_de_leche_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_banco_de_leche_id_seq', 1, false);


--
-- Data for Name: blh_bitacora; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_bitacora (id, fecha_accion, codigo, tabla, usuario, accion, detalle, fecha_hora_reg, id_user_reg) FROM stdin;
1	2015-01-20	DATA BASE	fos_user_user	siblh	I	INSERT(11,1,admin_roberto,admin_roberto,veta6363@gmail.com,veta6363@gmail.com,t,3arvsnvl2qm8wc4c0ccsc8w08ck0o48,6DTflhChY9VIVVNwbuiGZDpyCKHOJ3IK7DiOTgyiYWfN9jT8h43700+J6aWd+KCwcd7Sanztv20E7/1GRb/G0A==,"2015-01-16 14:59:20",f,f,,nTO_91gHfPXeH0Hx2iUAsRiZsm36lGT_IsVbgeBLv_o,"2014-11-06 09:07:14","a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2014-10-06 10:02:59","2015-01-16 14:59:20",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
2	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(2,25,BLH-02,Activo,)	\N	\N
3	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(3,49,BLH-03,Activo,)	\N	\N
4	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(1,36,BLH-01,Activo,)	\N	\N
5	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(5,1,BLH-04,Activo,)	\N	\N
6	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(7,12,BLH-06,Activo,)	\N	\N
7	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(8,12,BLH-07,Activo,)	\N	\N
8	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(9,18,BLH-08,Activo,)	\N	\N
9	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(6,12,BLH-05,Activo,)	\N	\N
10	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(10,24,BLH-09,Activo,)	\N	\N
11	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(11,14,BLH-10,Activo,)	\N	\N
12	2015-01-20	DATA BASE	blh_banco_de_leche	siblh	I	INSERT(12,18,BLH-11,Activo,)	\N	\N
13	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(2,"Dr. Andres Fuentes",,36)	\N	\N
14	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(3,"Dr. Carlos Mendez",,36)	\N	\N
15	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(1,"Dra. Abigail Martinez",,36)	\N	\N
16	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(5,"Dr. Oscar Galdamez",,36)	\N	\N
17	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(4,"Dr. Ever Olivares",,36)	\N	\N
18	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(6,"Dra. Brenda Aguilar",,36)	\N	\N
19	2015-01-20	DATA BASE	blh_personal	siblh	I	INSERT(7,"Dra. Karla Rodriguez",,36)	\N	\N
20	2015-01-20	DATA BASE	fos_user_user	siblh	U	UPDATE(11,1,admin_roberto,admin_roberto,veta6363@gmail.com,veta6363@gmail.com,t,3arvsnvl2qm8wc4c0ccsc8w08ck0o48,6DTflhChY9VIVVNwbuiGZDpyCKHOJ3IK7DiOTgyiYWfN9jT8h43700+J6aWd+KCwcd7Sanztv20E7/1GRb/G0A==,"2015-01-20 11:04:02",f,f,,nTO_91gHfPXeH0Hx2iUAsRiZsm36lGT_IsVbgeBLv_o,"2014-11-06 09:07:14","a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2014-10-06 10:02:59","2015-01-20 11:04:02",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
21	2015-02-24	DATA BASE	fos_user_user	siblh	U	UPDATE(11,1,admin_roberto,admin_roberto,veta6363@gmail.com,veta6363@gmail.com,t,3arvsnvl2qm8wc4c0ccsc8w08ck0o48,6DTflhChY9VIVVNwbuiGZDpyCKHOJ3IK7DiOTgyiYWfN9jT8h43700+J6aWd+KCwcd7Sanztv20E7/1GRb/G0A==,"2015-02-24 15:57:07",f,f,,nTO_91gHfPXeH0Hx2iUAsRiZsm36lGT_IsVbgeBLv_o,"2014-11-06 09:07:14","a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2014-10-06 10:02:59","2015-02-24 15:57:07",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
22	2017-06-23	DATA BASE	fos_user_user	siblh	I	INSERT(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,,f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-23 15:15:03",,,,,,u,,,,,,null,,,null,,,null,,,,)	\N	\N
23	2017-06-23	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-23 14:15:25",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-23 14:15:25",,,,,,u,,,,,,null,,,null,,,null,,,,)	\N	\N
24	2017-06-23	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-23 14:15:25",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-23 14:15:25",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
25	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-26 08:00:34",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-26 08:00:34",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
26	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-26 08:48:44",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-26 08:48:44",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
27	2017-06-26	APLICACION	blh_personal	admin_farid	I	INSERT(8,farid,2,36)	\N	\N
28	2017-06-26	APLICACION	blh_personal	admin_farid	I	INSERT(9,marvin,2,36)	\N	\N
29	2017-06-26	DATA BASE	fos_user_user	siblh	I	INSERT(3,,Farid,farid,dfhernandez1@salud.gob.sv,dfhernandez1@salud.gob.sv,t,efkeoam41y0cwkwgwsgokkowwowkcg8,siF5uuV7JtnfLAwlVuvq+b2PcHAFFTaEZGefwJxMS/lZSQk/GH4TEOJZ/v3JzViuSC8B2aWqZWQyY3fkT99o5A==,,f,f,,,,"a:1:{i:0;s:18:""ROLE_LABORATORISTA"";}",f,,"2017-06-26 09:58:13","2017-06-26 09:58:13",,,,,,m,,,,,,null,,,null,,,null,,,,36)	\N	\N
30	2017-06-26	DATA BASE	fos_user_user	siblh	I	INSERT(4,,mpenate,mpenate,mpenate@salud.gob.sv,mpenate@salud.gob.sv,f,5s99fktqk1og8kwsswo8cs4g4844wsg,DEvztXULb0NP7/FGPlCeLjcLW+BVE18OGNQcnVllfOaMMnV6eSjWePqO1Av9USxjHstfAqQqTn70v+Hwe0OEZw==,,f,f,,,,"a:1:{i:0;s:17:""ROLE_SONATA_ADMIN"";}",f,,"2017-06-26 09:59:58","2017-06-26 09:59:58",,,,,,u,,,,,,null,,,null,,,null,,,,25)	\N	\N
31	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(3,,Farid,farid,dfhernandez1@salud.gob.sv,dfhernandez1@salud.gob.sv,t,efkeoam41y0cwkwgwsgokkowwowkcg8,siF5uuV7JtnfLAwlVuvq+b2PcHAFFTaEZGefwJxMS/lZSQk/GH4TEOJZ/v3JzViuSC8B2aWqZWQyY3fkT99o5A==,"2017-06-26 10:00:39",f,f,,,,"a:1:{i:0;s:18:""ROLE_LABORATORISTA"";}",f,,"2017-06-26 09:58:13","2017-06-26 10:00:39",,,,,,m,,,,,,null,,,null,,,null,,,,36)	\N	\N
32	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-26 10:01:33",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-26 10:01:33",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
33	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(4,,mpenate,mpenate,mpenate@salud.gob.sv,mpenate@salud.gob.sv,t,5s99fktqk1og8kwsswo8cs4g4844wsg,DEvztXULb0NP7/FGPlCeLjcLW+BVE18OGNQcnVllfOaMMnV6eSjWePqO1Av9USxjHstfAqQqTn70v+Hwe0OEZw==,,f,f,,,,"a:1:{i:0;s:17:""ROLE_SONATA_ADMIN"";}",f,,"2017-06-26 09:59:58","2017-06-26 10:01:48",,,,,,u,,,,,,null,,,null,,,null,,,,25)	\N	\N
84	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(11,1,1,1,1,02-FR00011-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
85	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(10,1,1,1,1,02-FR00010-2017,30.0000,Mecanica,1.0144,N,30.0000,4,)	\N	\N
34	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(4,,mpenate,mpenate,mpenate@salud.gob.sv,mpenate@salud.gob.sv,t,5s99fktqk1og8kwsswo8cs4g4844wsg,DEvztXULb0NP7/FGPlCeLjcLW+BVE18OGNQcnVllfOaMMnV6eSjWePqO1Av9USxjHstfAqQqTn70v+Hwe0OEZw==,"2017-06-26 10:02:06",f,f,,,,"a:1:{i:0;s:17:""ROLE_SONATA_ADMIN"";}",f,,"2017-06-26 09:59:58","2017-06-26 10:02:06",,,,,,u,,,,,,null,,,null,,,null,,,,25)	\N	\N
35	2017-06-26	APLICACION	blh_donante	mpenate	I	INSERT(1,1,2,02-D00001-2017,Maria,Lourdes,Flores,Argueta,1985-06-04,2017-06-26,2297-2145,7751-3121,"por AHI",,000001-0001,04207730-2,DUI,32,Estudiante,Soltera,1,Primaria,BLH,N/A,Activa,4)	\N	\N
36	2017-06-26	APLICACION	blh_donante	mpenate	I	INSERT(2,1,2,02-D00002-2017,Maria,Lourdes,Flores,Argueta,1985-06-04,2017-06-26,2297-2145,7751-3121,"por AHI",,000001-0001,04207730-2,DUI,32,Estudiante,Soltera,1,Primaria,BLH,N/A,Activa,4)	\N	\N
37	2017-06-26	APLICACION	blh_historial_clinico	mpenate	I	INSERT(1,Si,23.0000,Privado,7,2017-02-16,N/A,N/A,15,,3,3,4,4,5,5,4,1,)	\N	\N
38	2017-06-26	APLICACION	blh_historia_actual	mpenate	I	INSERT(1,50.0000,1.5000,,,"POR GUSTO",,22.2222,Apta,4,2)	\N	\N
39	2017-06-26	APLICACION	blh_historia_actual	mpenate	I	INSERT(2,50.0000,1.5000,,,"POR GUSTO",,22.2222,Apta,4,1)	\N	\N
40	2017-06-26	APLICACION	blh_historia_actual	mpenate	I	INSERT(3,50.0000,1.5000,,,"POR GUSTO",,22.2222,Apta,4,1)	\N	\N
41	2017-06-26	APLICACION	blh_donacion	mpenate	I	INSERT(1,2,,2017-06-26,farid,4,1,)	\N	\N
42	2017-06-26	APLICACION	blh_donacion	mpenate	I	INSERT(2,2,,2017-06-26,farid,4,1,)	\N	\N
43	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,1,,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
44	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(1,1,,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
45	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(2,1,,1,2,02-FR00002-2017,50.0000,Mecanica,1.6907,N/A,50.0000,4,)	\N	\N
46	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(2,1,,1,2,02-FR00002-2017,50.0000,Mecanica,1.6907,N/A,50.0000,4,)	\N	\N
47	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(3,4,,1,1,02-FR00003-2017,10.0000,Manual,0.3381,FG,10.0000,4,)	\N	\N
48	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(3,1,,1,1,02-FR00003-2017,10.0000,Manual,0.3381,FG,10.0000,4,)	\N	\N
49	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,1,,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
50	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(4,1,,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
51	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(5,4,,1,1,02-FR00005-2017,20.0000,Manual,0.6763,N,20.0000,4,)	\N	\N
52	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(5,1,,1,1,02-FR00005-2017,20.0000,Manual,0.6763,N,20.0000,4,)	\N	\N
53	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(6,1,,1,1,02-FR00006-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
54	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(6,1,,1,1,02-FR00006-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
55	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(7,1,,1,1,02-FR00007-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
56	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(7,1,,1,1,02-FR00007-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
57	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(8,1,,1,1,02-FR00008-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
58	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(8,1,,1,1,02-FR00008-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
59	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,1,,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
60	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(9,1,,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
61	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(10,1,,1,1,02-FR00010-2017,30.0000,Mecanica,1.0144,N,30.0000,4,)	\N	\N
62	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(10,1,,1,1,02-FR00010-2017,30.0000,Mecanica,1.0144,N,30.0000,4,)	\N	\N
63	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(11,1,,1,1,02-FR00011-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
64	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(11,1,,1,1,02-FR00011-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
65	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(12,1,,1,1,02-FR00012-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
66	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(12,1,,1,1,02-FR00012-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
67	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,1,,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
68	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(13,1,,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
69	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(14,1,,1,1,02-FR00014-2017,30.0000,Manual,1.0144,30,30.0000,4,)	\N	\N
70	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(14,1,,1,1,02-FR00014-2017,30.0000,Manual,1.0144,30,30.0000,4,)	\N	\N
71	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(15,1,,1,1,02-FR00015-2017,30.0000,Manual,1.0144,NH,30.0000,4,)	\N	\N
72	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(15,1,,1,1,02-FR00015-2017,30.0000,Manual,1.0144,NH,30.0000,4,)	\N	\N
73	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(16,1,,1,1,02-FR00016-2017,30.0000,Manual,1.0144,NG,30.0000,4,)	\N	\N
74	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(16,1,,1,1,02-FR00016-2017,30.0000,Manual,1.0144,NG,30.0000,4,)	\N	\N
75	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(17,1,,1,1,02-FR00017-2017,30.0000,Manual,1.0144,NA,30.0000,4,)	\N	\N
76	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	I	INSERT(17,1,,1,1,02-FR00017-2017,30.0000,Manual,1.0144,NA,30.0000,4,)	\N	\N
77	2017-06-26	APLICACION	blh_lote_analisis	mpenate	I	INSERT(1,02-001-2017,2017-06-26,marvin,4)	\N	\N
78	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(17,1,1,1,1,02-FR00017-2017,30.0000,Manual,1.0144,NA,30.0000,4,)	\N	\N
79	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(16,1,1,1,1,02-FR00016-2017,30.0000,Manual,1.0144,NG,30.0000,4,)	\N	\N
80	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(15,1,1,1,1,02-FR00015-2017,30.0000,Manual,1.0144,NH,30.0000,4,)	\N	\N
81	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(14,1,1,1,1,02-FR00014-2017,30.0000,Manual,1.0144,30,30.0000,4,)	\N	\N
82	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,1,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
83	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(12,1,1,1,1,02-FR00012-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
86	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,1,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
87	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(8,1,1,1,1,02-FR00008-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
88	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(7,1,1,1,1,02-FR00007-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
89	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(6,1,1,1,1,02-FR00006-2017,30.0000,Manual,1.0144,N,30.0000,4,)	\N	\N
90	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,1,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
91	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(2,1,1,1,2,02-FR00002-2017,50.0000,Mecanica,1.6907,N/A,50.0000,4,)	\N	\N
92	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,1,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
93	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,7,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
94	2017-06-26	APLICACION	blh_analisis_sensorial	mpenate	I	INSERT(1,Aprobado,Aprobado,Aprobado,Aprobado,NA,4,1)	\N	\N
95	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,5,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
96	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(1,1,3,3,3,0.9000,2.7000,3.0000,4)	\N	\N
97	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,5,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
98	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(2,1,3,3,3,0.9000,2.7000,3.0000,4)	\N	\N
99	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,6,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,)	\N	\N
100	2017-06-26	APLICACION	blh_crematocrito	mpenate	I	INSERT(1,4.0000,4.0000,4.0000,1.0000,1.0000,1.0000,4.0000,1.0000,0.0400,292.6700,4,1,)	\N	\N
101	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(2,7,1,1,2,02-FR00002-2017,50.0000,Mecanica,1.6907,N/A,50.0000,4,)	\N	\N
102	2017-06-26	APLICACION	blh_analisis_sensorial	mpenate	I	INSERT(2,Aprobado,Aprobado,Aprobado,Aprobado,B,4,2)	\N	\N
103	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(2,10,1,1,2,02-FR00002-2017,50.0000,Mecanica,1.6907,N/A,50.0000,4,)	\N	\N
104	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(3,2,10,10,10,0.9000,9.0000,10.0000,4)	\N	\N
105	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,7,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
106	2017-06-26	APLICACION	blh_analisis_sensorial	mpenate	I	INSERT(3,Aprobado,Aprobado,Aprobado,Aprobado,B,4,4)	\N	\N
107	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,5,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
108	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(4,4,5,5,7,0.9000,5.1000,5.6700,4)	\N	\N
109	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,6,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,)	\N	\N
110	2017-06-26	APLICACION	blh_crematocrito	mpenate	I	INSERT(2,7.0000,7.0000,7.0000,10.0000,10.0000,10.0000,7.0000,10.0000,0.0070,290.4700,4,4,)	\N	\N
111	2017-06-26	APLICACION	blh_curva	mpenate	I	INSERT(1,20.00,20.00,20.00,20.00,2017-06-26,10,500.0000,,4,5000)	\N	\N
112	2017-06-26	APLICACION	blh_curva	mpenate	I	INSERT(1,20.00,20.00,20.00,20.00,2017-06-26,10,500.0000,,4,5000)	\N	\N
113	2017-06-26	APLICACION	blh_curva	mpenate	I	INSERT(1,20.00,20.00,20.00,20.00,2017-06-26,10,500.0000,,4,5000)	\N	\N
114	2017-06-26	APLICACION	blh_pasteurizacion	mpenate	I	INSERT(1,1,02-001-2017,1,500.0000,10,2017-06-26,"Dr. Ever Olivares",4,5000)	\N	\N
115	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,7,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
116	2017-06-26	APLICACION	blh_analisis_sensorial	mpenate	I	INSERT(4,Aprobado,Aprobado,Aprobado,Aprobado,na,4,13)	\N	\N
117	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,7,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
118	2017-06-26	APLICACION	blh_analisis_sensorial	mpenate	I	INSERT(5,Aprobado,Aprobado,Aprobado,Aprobado,na,4,9)	\N	\N
119	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,5,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
120	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(5,9,5,5,5,1.0000,5.0000,5.0000,4)	\N	\N
121	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,5,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
122	2017-06-26	APLICACION	blh_acidez	mpenate	I	INSERT(6,13,5,5,5,1.0000,5.0000,5.0000,4)	\N	\N
123	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,6,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,)	\N	\N
124	2017-06-26	APLICACION	blh_crematocrito	mpenate	I	INSERT(3,5.0000,5.0000,5.0000,5.0000,5.0000,5.0000,5.0000,5.0000,0.0100,290.6700,4,9,)	\N	\N
125	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,6,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,)	\N	\N
126	2017-06-26	APLICACION	blh_crematocrito	mpenate	I	INSERT(4,10.0000,10.0000,10.0000,10.0000,10.0000,10.0000,10.0000,10.0000,0.0100,290.6700,4,13,)	\N	\N
127	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,6,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,400.0000,4,0.0000)	\N	\N
128	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,6,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,30.0000,4,20.0000)	\N	\N
129	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,6,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,40.0000,4,0.0000)	\N	\N
130	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,6,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,50.0000,4,0.0000)	\N	\N
131	2017-06-26	APLICACION	blh_frasco_procesado	mpenate	I	INSERT(1,3,1,02-FP00001-2017,500.0000,4.4500,291.1200,FP1,,4)	\N	\N
132	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,6,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,0.0000,4,0.0000)	\N	\N
133	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(1,15,1,1,2,02-FR00001-2017,400.0000,Manual,13.5256,N/A,0.0000,4,0.0000)	\N	\N
134	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(4,6,1,1,1,02-FR00004-2017,30.0000,Mecanica,1.0144,B,20.0000,4,20.0000)	\N	\N
135	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,6,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,0.0000,4,0.0000)	\N	\N
136	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(9,15,1,1,1,02-FR00009-2017,40.0000,Manual,1.3526,N,0.0000,4,0.0000)	\N	\N
137	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,6,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,0.0000,4,0.0000)	\N	\N
138	2017-06-26	APLICACION	blh_frasco_recolectado	mpenate	U	UPDATE(13,15,1,1,1,02-FR00013-2017,50.0000,Manual,1.6907,N,0.0000,4,0.0000)	\N	\N
139	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-26 11:56:38",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-26 11:56:38",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
140	2017-06-26	DATA BASE	fos_user_user	siblh	I	INSERT(5,,Marvin,marvin,marvin@salud.gob.sv,marvin@salud.gob.sv,t,gt9qimh3xjwwcokw80ock444kc0k8os,fQqVQDT1UX3dC9CF46aue53auul8hqkMMrNj6VMBvNIc/0jDDvs0bThgGVqHduSgnFoDdM1l4G2jOpT0rckVAQ==,,f,f,,,,"a:1:{i:0;s:13:""ROLE_PEDIATRA"";}",f,,"2017-06-26 11:57:46","2017-06-26 11:57:46",,,,,,m,es_SV,,,,,null,,,null,,,null,,,,32)	\N	\N
141	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(5,,Marvin,marvin,marvin@salud.gob.sv,marvin@salud.gob.sv,t,gt9qimh3xjwwcokw80ock444kc0k8os,fQqVQDT1UX3dC9CF46aue53auul8hqkMMrNj6VMBvNIc/0jDDvs0bThgGVqHduSgnFoDdM1l4G2jOpT0rckVAQ==,"2017-06-26 11:57:57",f,f,,,,"a:1:{i:0;s:13:""ROLE_PEDIATRA"";}",f,,"2017-06-26 11:57:46","2017-06-26 11:57:57",,,,,,m,es_SV,,,,,null,,,null,,,null,,,,32)	\N	\N
142	2017-06-26	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-26 11:58:48",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-26 11:58:48",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
143	2017-06-27	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-06-27 07:23:54",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-06-27 07:23:54",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
144	2017-06-30	DATA BASE	fos_user_user	siblh	I	INSERT(6,,adminblh,adminblh,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,c634iueottkwo0gw0wooo808w88ws44,QgMyoB1mz0mtG1PL7rEsI9MV45fVAuUZKXlP66i7M6EZVF6BA+dUa5bewbgUB3PHb572yZjiF1Yv4AiTmJUrpw==,,f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-30 16:01:43","2017-06-30 16:01:43",,,,,,u,,,,,,null,,,null,,,null,,,,)	\N	\N
145	2017-06-30	DATA BASE	fos_user_user	siblh	U	UPDATE(6,,adminblh,adminblh,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,c634iueottkwo0gw0wooo808w88ws44,QgMyoB1mz0mtG1PL7rEsI9MV45fVAuUZKXlP66i7M6EZVF6BA+dUa5bewbgUB3PHb572yZjiF1Yv4AiTmJUrpw==,"2017-06-30 15:01:54",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-30 16:01:43","2017-06-30 15:01:54",,,,,,u,,,,,,null,,,null,,,null,,,,)	\N	\N
146	2017-07-03	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-07-03 14:48:11",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-07-03 14:48:11",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
147	2017-07-03	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-07-03 15:04:17",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-07-03 15:04:17",,,,,,u,,,,,,null,,,null,,,null,,,,36)	\N	\N
148	2017-07-04	DATA BASE	fos_user_user	siblh	U	UPDATE(2,,admin_farid,admin_farid,dfhernandez@salud.gob.sv,dfhernandez@salud.gob.sv,t,nerbweigxv4s8oco88sgg8ss0o0g4ww,08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==,"2017-07-04 16:40:15",f,f,,,,"a:1:{i:0;s:16:""ROLE_SUPER_ADMIN"";}",f,,"2017-06-23 15:15:03","2017-07-04 16:40:15",,,,,,u,,,,,,null,,,null,,,null,,,,36,)	\N	\N
149	2017-07-04	APLICACION	blh_donante	admin_farid	I	INSERT(3,14,1,01-D00001-2017,Irma,Elena,Hernández,Cortez,1982-07-15,2017-07-04,2272-4516,7710-2360,,,,04207730-2,DUI,34,,Soltera,1,Superior,BLH,,Activa,2,,)	\N	\N
150	2017-07-04	APLICACION	blh_historial_clinico	admin_farid	I	INSERT(2,Si,25.0000,Minsal,1,2017-07-01,N/A,N/A,12,,4,2,0,0,2,0,2,3,6,,)	\N	\N
151	2017-07-04	APLICACION	blh_historia_actual	admin_farid	I	INSERT(4,90.0000,1.6700,,,"Ella queria",,32.2708,Apta,2,3,,)	\N	\N
152	2017-07-04	APLICACION	blh_donacion	admin_farid	I	INSERT(3,1,,2017-07-03,"Dr. Oscar Galdamez",2,3,,,)	\N	\N
153	2017-07-04	APLICACION	blh_donacion	admin_farid	I	INSERT(4,1,,2017-07-04,"Dr. Ever Olivares",2,3,,,)	\N	\N
154	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	U	UPDATE(18,1,,3,4,01-FR00001-2017,460.0000,Manual,15.5544,,460.0000,2,,,)	\N	\N
155	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	I	INSERT(18,1,,3,4,01-FR00001-2017,460.0000,Manual,15.5544,,460.0000,2,,,)	\N	\N
156	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	U	UPDATE(19,1,,3,4,01-FR00002-2017,234.0000,Mecanica,7.9125,,234.0000,2,,,)	\N	\N
157	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	I	INSERT(19,1,,3,4,01-FR00002-2017,234.0000,Mecanica,7.9125,,234.0000,2,,,)	\N	\N
158	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	U	UPDATE(20,1,,3,4,01-FR00003-2017,478.0000,Manual,16.1631,,478.0000,2,,,)	\N	\N
159	2017-07-04	APLICACION	blh_frasco_recolectado	admin_farid	I	INSERT(20,1,,3,4,01-FR00003-2017,478.0000,Manual,16.1631,,478.0000,2,,,)	\N	\N
\.


--
-- Name: blh_bitacora_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_bitacora_id_seq', 1, false);


--
-- Data for Name: blh_crematocrito; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_crematocrito (id, crema1, crema2, crema3, ct1, ct2, ct3, media_crema, media_ct, porcentaje_crema, kilocalorias, usuario, id_frasco_recolectado, id_frasco_procesado, fecha_hora_reg, id_user_reg) FROM stdin;
1	4.0000	4.0000	4.0000	1.0000	1.0000	1.0000	4.0000	1.0000	0.0400	292.6700	4	1	\N	\N	\N
2	7.0000	7.0000	7.0000	10.0000	10.0000	10.0000	7.0000	10.0000	0.0070	290.4700	4	4	\N	\N	\N
3	5.0000	5.0000	5.0000	5.0000	5.0000	5.0000	5.0000	5.0000	0.0100	290.6700	4	9	\N	\N	\N
4	10.0000	10.0000	10.0000	10.0000	10.0000	10.0000	10.0000	10.0000	0.0100	290.6700	4	13	\N	\N	\N
\.


--
-- Name: blh_crematocrito_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_crematocrito_id_seq', 4, true);


--
-- Data for Name: blh_curva; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_curva (id, tiempo1, tiempo2, tiempo3, valor_curva, fecha_curva, cantidad_frascos, volumen_por_frasco, hora_inicio_curva, usuario, volumen_total, fecha_hora_reg, id_user_reg) FROM stdin;
1	20.00	20.00	20.00	20.00	2017-06-26	10	500.0000	\N	4	5000	\N	\N
\.


--
-- Name: blh_curva_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_curva_id_seq', 1, true);


--
-- Data for Name: blh_donacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_donacion (id, id_banco_de_leche, codigo_donante, fecha_donacion, responsable_donacion, usuario, id_donante, id_centro_recoleccion, fecha_hora_reg, id_user_reg) FROM stdin;
1	2	\N	2017-06-26	farid	4	1	\N	\N	\N
2	2	\N	2017-06-26	farid	4	1	\N	\N	\N
3	1	\N	2017-07-03	Dr. Oscar Galdamez	2	3	\N	\N	\N
4	1	\N	2017-07-04	Dr. Ever Olivares	2	3	\N	\N	\N
\.


--
-- Name: blh_donacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_donacion_id_seq', 4, true);


--
-- Data for Name: blh_donante; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_donante (id, id_municipio, id_banco_de_leche, codigo_donante, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, fecha_registro_donante_blh, telefono_fijo, telefono_movil, direccion, procedencia, registro, numero_documento_identificacion, documento_identificacion, edad, ocupacion, estado_civil, nacionalidad, escolaridad, tipo_colecta, observaciones, estado, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
1	1	2	02-D00001-2017	Maria	Lourdes	Flores	Argueta	1985-06-04	2017-06-26	2297-2145	7751-3121	por AHI	\N	000001-0001	04207730-2	DUI	32	Estudiante	Soltera	1	Primaria	BLH	N/A	Activa	4	\N	\N
2	1	2	02-D00002-2017	Maria	Lourdes	Flores	Argueta	1985-06-04	2017-06-26	2297-2145	7751-3121	por AHI	\N	000001-0001	04207730-2	DUI	32	Estudiante	Soltera	1	Primaria	BLH	N/A	Activa	4	\N	\N
3	14	1	01-D00001-2017	Irma	Elena	Hernández	Cortez	1982-07-15	2017-07-04	2272-4516	7710-2360	\N	\N	\N	04207730-2	DUI	34	\N	Soltera	1	Superior	BLH	\N	Activa	2	\N	\N
\.


--
-- Name: blh_donante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_donante_id_seq', 3, true);


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
3	Pasteurizado	\N	\N	\N
1	Prealmacenado	\N	\N	\N
5	AnalizadoA	\N	\N	\N
6	AnalizadoC	\N	\N	\N
7	AnalizadoS	\N	\N	\N
2	Liberado	\N	\N	\N
8	AnalizadoM	\N	\N	\N
9	AnalizadoR	\N	\N	\N
15	ReprobadoEm	\N	\N	\N
16	ReprobadoSu	\N	\N	\N
17	ReprobadoCo	\N	\N	\N
18	ReprobadoOl	\N	\N	\N
10	ReprobadoA	\N	\N	\N
11	ReprobadoC	\N	\N	\N
12	ReprobadoS	\N	\N	\N
13	ReprobadoM	\N	\N	\N
14	ReprobadoR	\N	\N	\N
4	ReprobadoMI	\N	\N	\N
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
1	3	1	02-FP00001-2017	500.0000	4.4500	291.1200	FP1	\N	4	\N	\N
\.


--
-- Name: blh_frasco_procesado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_frasco_procesado_id_seq', 1, true);


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

COPY blh_frasco_recolectado (id, id_estado, id_lote_analisis, id_donante, id_donacion, codigo_frasco_recolectado, volumen_recolectado, forma_extraccion, onz_recolectado, observacion_frasco_recolectado, volumen_disponible_fr, usuario, volumen_real, fecha_hora_reg, id_user_reg) FROM stdin;
9	15	1	1	1	02-FR00009-2017	40.0000	Manual	1.3526	N	0.0000	4	0.0000	\N	\N
3	4	\N	1	1	02-FR00003-2017	10.0000	Manual	0.3381	FG	10.0000	4	\N	\N	\N
5	4	\N	1	1	02-FR00005-2017	20.0000	Manual	0.6763	N	20.0000	4	\N	\N	\N
13	15	1	1	1	02-FR00013-2017	50.0000	Manual	1.6907	N	0.0000	4	0.0000	\N	\N
18	1	\N	3	4	01-FR00001-2017	460.0000	Manual	15.5544	\N	460.0000	2	\N	\N	\N
19	1	\N	3	4	01-FR00002-2017	234.0000	Mecanica	7.9125	\N	234.0000	2	\N	\N	\N
20	1	\N	3	4	01-FR00003-2017	478.0000	Manual	16.1631	\N	478.0000	2	\N	\N	\N
17	1	1	1	1	02-FR00017-2017	30.0000	Manual	1.0144	NA	30.0000	4	\N	\N	\N
16	1	1	1	1	02-FR00016-2017	30.0000	Manual	1.0144	NG	30.0000	4	\N	\N	\N
15	1	1	1	1	02-FR00015-2017	30.0000	Manual	1.0144	NH	30.0000	4	\N	\N	\N
14	1	1	1	1	02-FR00014-2017	30.0000	Manual	1.0144	30	30.0000	4	\N	\N	\N
12	1	1	1	1	02-FR00012-2017	30.0000	Manual	1.0144	N	30.0000	4	\N	\N	\N
11	1	1	1	1	02-FR00011-2017	30.0000	Manual	1.0144	N	30.0000	4	\N	\N	\N
10	1	1	1	1	02-FR00010-2017	30.0000	Mecanica	1.0144	N	30.0000	4	\N	\N	\N
8	1	1	1	1	02-FR00008-2017	30.0000	Manual	1.0144	N	30.0000	4	\N	\N	\N
7	1	1	1	1	02-FR00007-2017	30.0000	Manual	1.0144	N	30.0000	4	\N	\N	\N
6	1	1	1	1	02-FR00006-2017	30.0000	Manual	1.0144	N	30.0000	4	\N	\N	\N
2	10	1	1	2	02-FR00002-2017	50.0000	Mecanica	1.6907	N/A	50.0000	4	\N	\N	\N
1	15	1	1	2	02-FR00001-2017	400.0000	Manual	13.5256	N/A	0.0000	4	0.0000	\N	\N
4	6	1	1	1	02-FR00004-2017	30.0000	Mecanica	1.0144	B	20.0000	4	20.0000	\N	\N
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

SELECT pg_catalog.setval('blh_frasco_recolectado_id_seq', 20, true);


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
1	50.0000	1.5000	\N	\N	POR GUSTO	\N	22.2222	Apta	4	2	\N	\N
2	50.0000	1.5000	\N	\N	POR GUSTO	\N	22.2222	Apta	4	1	\N	\N
3	50.0000	1.5000	\N	\N	POR GUSTO	\N	22.2222	Apta	4	1	\N	\N
4	90.0000	1.6700	\N	\N	Ella queria	\N	32.2708	Apta	2	3	\N	\N
\.


--
-- Name: blh_historia_actual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_historia_actual_id_seq', 4, true);


--
-- Data for Name: blh_historial_clinico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_historial_clinico (id, control_prenatal, edad_gest_fur, lugar_control, numero_control, fecha_parto, lugar_parto, patologia_embarazo, periodo_intergenesico, fecha_parto_anterior, formula_obstetrica_g, formula_obstetrica_p1, formula_obstetrica_p2, formula_obstetrica_a, formula_obstetrica_v, formula_obstetrica_m, usuario, id_donante, id_establecimiento, fecha_hora_reg, id_user_reg) FROM stdin;
1	Si	23.0000	Privado	7	2017-02-16	N/A	N/A	15	\N	3	3	4	4	5	5	4	1	\N	\N	\N
2	Si	25.0000	Minsal	1	2017-07-01	N/A	N/A	12	\N	4	2	0	0	2	0	2	3	6	\N	\N
\.


--
-- Name: blh_historial_clinico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_historial_clinico_id_seq', 2, true);


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

COPY blh_lote_analisis (id, codigo_lote_analisis, fecha_analisis_fisico_quimico, responsable_analisis, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
1	02-001-2017	2017-06-26	marvin	4	\N	\N
\.


--
-- Name: blh_lote_analisis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_lote_analisis_id_seq', 1, true);


--
-- Data for Name: blh_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_menu (id, nombre_menu, descripcion_menu, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
1	Donante	Menu para la gestion de donantes	\N	\N	\N
2	Receptor	Menu para la gestion de receptores	\N	\N	\N
3	Laboratorio	Menu para la gestion de actividades de laboratorio	\N	\N	\N
4	Pasteurizacion	Menu para la gestion de la de pasteurizacion	\N	\N	\N
5	Solicitudes	Menu de gestion de solicitudes de leche humana	\N	\N	\N
6	Gestion de Informacion	Menu para la gestion de informacion publica	\N	\N	\N
7	Reportes	Menu para la gestion de reportes	\N	\N	\N
8	Administracion	Menu para mantenimiento	\N	\N	\N
\.


--
-- Name: blh_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_menu_id_seq', 1, false);


--
-- Data for Name: blh_opcion_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_opcion_menu (id, id_menu, nombre_opcion, url_opcion, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
1	1	Registro Donante	_NewDonante	\N	\N	\N
2	1	Registro Historial Clinico	_NewHistorialClinico	\N	\N	\N
3	1	Registro Historia Actual	_NewHistoriaActual	\N	\N	\N
6	2	Seguimiento	_NewSeguimiento	\N	\N	\N
14	4	Pasteurizacion	_NewPasteurizacion	\N	\N	\N
19	6	Subir Informacion Publica	_NewInformacionPublica	\N	\N	\N
20	7	Reportes de Donantes	_NewReportesDonantes	\N	\N	\N
21	7	Reportes de Receptores	_NewReportesReceptores	\N	\N	\N
22	7	Reportes de Laboratorio	_NewReportesLaboratorio	\N	\N	\N
23	7	Estadisticas	_NewEstadisticas	\N	\N	\N
24	8	Usuarios	_MantenimientoUsuarios	\N	\N	\N
25	8	Registrar Banco de Leche	_NewBLH	\N	\N	\N
26	8	Editar Banco de Leche	_NewEditBLH	\N	\N	\N
27	1	Registrar Donacion	_NewDonacion	\N	\N	\N
12	3	Analisis Microbiologico	_NewAnalisisMicrobiologico	\N	\N	\N
28	4	Combinar Frascos	_NewCombinacion	\N	\N	\N
29	6	Mantenimiento Informacion	_NewInfoPublicaEdit	\N	\N	\N
31	1	Mantenimiento Donantes	_NewDonanteEdit	\N	\N	\N
32	2	Mantenimiento Receptores	_NewReceptorEdit	\N	\N	\N
33	3	Mantenimiento Laboratorio	_NewLaboratorioEdit	\N	\N	\N
34	4	Mantenimiento Pasteurizacion	_NewPasteurizacionEdit	\N	\N	\N
36	8	Registrar Personal	_NewPersonal	\N	\N	\N
37	8	Editar Personal	_NewEditPersonal	\N	\N	\N
35	5	Mantenimiento Solicitudes	_NewSolicitudEdit	\N	\N	\N
30	5	Despacho	_NewDespacho	\N	\N	\N
4	1	Registro de Leche donada	_NewFrascoRecolectado	\N	\N	\N
5	2	Ingreso de Receptor	_NewReceptor	\N	\N	\N
7	2	Egreso de Receptor	_NewEgreso	\N	\N	\N
8	3	Nuevo Lote Para Analisis	_NewLoteAnalisis	\N	\N	\N
9	3	Analisis Sensorial	_NewAnalisisSensorial	\N	\N	\N
10	3	Analisis de Acidez Dornic	_NewAnalisisAcidez	\N	\N	\N
11	3	Analisis de Crematocrito	_NewAnalisisCrematocrito	\N	\N	\N
13	4	Curva de Pasteurizacion	_NewCurva	\N	\N	\N
15	4	Temperatura de Pasteurizacion	_NewTemperaturaP	\N	\N	\N
16	4	Temperatura de Enfriamiento	_NewTemperaturaE	\N	\N	\N
17	5	Registro de Solicitudes	_NewSolicitudes	\N	\N	\N
18	5	Agrupar Solicitudes	_NewGrupoSolicitudes	\N	\N	\N
38	3	Agregar Frascos a Lote	_VerLotes	\N	\N	\N
\.


--
-- Name: blh_opcion_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_opcion_menu_id_seq', 1, false);


--
-- Data for Name: blh_pasteurizacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_pasteurizacion (id, id_curva, codigo_pasteurizacion, num_ciclo, volumen_pasteurizado, num_frascos_pasteurizados, fecha_pasteurizacion, responsable_pasteurizacion, usuario, volumen_total, fecha_hora_reg, id_user_reg) FROM stdin;
1	1	02-001-2017	1	500.0000	10	2017-06-26	Dr. Ever Olivares	4	5000	\N	\N
\.


--
-- Name: blh_pasteurizacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_pasteurizacion_id_seq', 1, true);


--
-- Data for Name: blh_personal; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_personal (id, nombre, usuario, id_establecimiento, fecha_hora_reg, id_user_reg) FROM stdin;
2	Dr. Andres Fuentes	\N	36	\N	\N
3	Dr. Carlos Mendez	\N	36	\N	\N
1	Dra. Abigail Martinez	\N	36	\N	\N
5	Dr. Oscar Galdamez	\N	36	\N	\N
4	Dr. Ever Olivares	\N	36	\N	\N
6	Dra. Brenda Aguilar	\N	36	\N	\N
7	Dra. Karla Rodriguez	\N	36	\N	\N
8	farid	2	36	\N	\N
9	marvin	2	36	\N	\N
\.


--
-- Name: blh_personal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_personal_id_seq', 9, true);


--
-- Data for Name: blh_receptor; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_receptor (id, id_banco_de_leche, id_paciente, codigo_receptor, fecha_registro_blh, procedencia, estado_receptor, edad_dias, peso_receptor, duracion_cpap, clasificacion_lubchengo, diagnostico_ingreso, duracion_npt, apgar_primer_minuto, edad_gest_fur, duracion_ventilacion, edad_gest_ballard, pc, talla_ingreso, apgar_quinto_minuto, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: blh_receptor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_receptor_id_seq', 1, true);


--
-- Data for Name: blh_rol; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_rol (id, nombre_rol, descripcion_rol, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
1	ROLE_LABORATORISTA	Rol para actividades de laboratorio	\N	\N	\N
2	ROLE_SECRETARIA	Rol para actividades de la secretaria	\N	\N	\N
3	ROLE_JEFE	Rol para actividades de jefe de banco de leche	\N	\N	\N
4	ROLE_PEDIATRA	Rol para actividades de pediatra de banco de leche	\N	\N	\N
5	ROLE_SONATA_ADMIN	Rol de administrador del sistema	\N	\N	\N
\.


--
-- Name: blh_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_rol_id_seq', 1, false);


--
-- Data for Name: blh_rol_menu; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_rol_menu (id, id_menu, id_rol, usuario, fecha_hora_reg, id_user_reg) FROM stdin;
5	1	3	\N	\N	\N
6	2	3	\N	\N	\N
7	3	3	\N	\N	\N
8	4	3	\N	\N	\N
9	5	3	\N	\N	\N
10	6	3	\N	\N	\N
11	7	3	\N	\N	\N
12	6	4	\N	\N	\N
13	1	5	\N	\N	\N
14	2	5	\N	\N	\N
15	3	5	\N	\N	\N
16	4	5	\N	\N	\N
17	5	5	\N	\N	\N
18	6	5	\N	\N	\N
19	7	5	\N	\N	\N
20	8	5	\N	\N	\N
1	3	1	1	\N	\N
2	4	1	1	\N	\N
3	7	1	3	\N	\N
4	1	2	2	\N	\N
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
1	5	4	1	\N	\N	\N	\N
\.


--
-- Name: blh_temperatura_enfriamiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_temperatura_enfriamiento_id_seq', 1, true);


--
-- Data for Name: blh_temperatura_pasteurizacion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY blh_temperatura_pasteurizacion (id, temperatura_p, usuario, id_pasteurizacion, hora_inicio_p, hora_final_p, fecha_hora_reg, id_user_reg) FROM stdin;
1	\N	4	1	08:00:00	12:00:00	\N	\N
2	62	4	1	\N	\N	\N	\N
\.


--
-- Name: blh_temperatura_pasteurizacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('blh_temperatura_pasteurizacion_id_seq', 2, true);


--
-- Data for Name: ctl_centro_recoleccion; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_centro_recoleccion (id, nombre, telefono, fecha_hora_reg, id_user_reg) FROM stdin;
\.


--
-- Name: ctl_centro_recoleccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_centro_recoleccion_id_seq', 1, false);


--
-- Data for Name: ctl_departamento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_departamento (id, nombre, codigo_cnr, abreviatura) FROM stdin;
1	Ahuachapán	1	AH
2	Santa Ana	2	SA
3	Sonsonate	3	SO
4	Chalatenango	4	CH
5	La Libertad	5	LI
6	San Salvador	6	SS
7	Cuscatlán	7	CU
8	La Paz	8	PA
9	Cabañas	9	CA
11	Usulután	11	US
12	San Miguel	12	SM
10	San Vicente	10	SV
13	Morazán	13	MO
14	La Unión	14	UN
\.


--
-- Name: ctl_departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_departamento_id_seq', 1, false);


--
-- Data for Name: ctl_establecimiento; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_establecimiento (id, nombre, direccion, telefono, fax) FROM stdin;
1	Región Occidental	\\N	\\N	\\N
2	Región Central	\\N	\\N	\\N
3	Región Metropolitana	\\N	\\N	\\N
4	Región Paracentral	\\N	\\N	\\N
5	Región Oriental	\\N	\\N	\\N
6	Sibasi Ahuachapán	\\N	\\N	\\N
7	Sibasi Santa Ana	\\N	\\N	\\N
8	Sibasi Sonsonate	\\N	\\N	\\N
9	Sibasi Chalatenango	\\N	\\N	\\N
10	Sibasi La Libertad	\\N	\\N	\\N
11	Sibasi Cuscatlán	\\N	\\N	\\N
12	Sibasi La Paz	\\N	\\N	\\N
13	Sibasi Cabañas	\\N	\\N	\\N
14	Sibasi San Vicente	\\N	\\N	\\N
15	Sibasi Usulután	\\N	\\N	\\N
16	Sibasi San Miguel	\\N	\\N	\\N
17	Sibasi Morazán	\\N	\\N	\\N
18	Sibasi La Unión	\\N	\\N	\\N
19	Sibasi Norte	\\N	\\N	\\N
20	Sibasi Sur	\\N	\\N	\\N
21	Sibasi Oriente	\\N	\\N	\\N
22	Sibasi Centro	\\N	\\N	\\N
24	Hospital Nacional Metapán SA Dr. Arturo Morales	\\N	\\N	\\N
26	Hospital Nacional Chalchuapa SA 	\\N	\\N	\\N
27	Hospital Nacional Sonsonate SO Dr. Jorge Mazzini Villacorta	\\N	\\N	\\N
28	Hospital Nacional Chalatenango CH  Dr. Luis Edmundo Vásquez	\\N	\\N	\\N
29	Hospital Nacional Nueva Concepción CH 	\\N	\\N	\\N
30	Hospital Nacional Santa Tecla LI  San Rafael	\\N	\\N	\\N
31	Hospital Nacional Ilopango SS  Enf. Angélica Vidal de Najarro	\\N	\\N	\\N
32	Hospital Nacional Mejicanos SS  (Zacamil) Dr. Juan José Fernández	\\N	\\N	\\N
33	Hospital Nacional San Salvador SS Neumológico Dr. José A. Saldaña	\\N	\\N	\\N
34	Hospital Nacional San Salvador SS Rosales	\\N	\\N	\\N
35	Hospital Nacional San Salvador SS Benjamin Bloom	\\N	\\N	\\N
37	Hospital Nacional Soyapango SS  Dr. José Molina Martínez	\\N	\\N	\\N
38	Hospital Nacional Cojutepeque CU  Nuestra Señora de Fátima	\\N	\\N	\\N
39	Hospital Nacional Suchitoto CU 	\\N	\\N	\\N
40	Hospital Nacional Zacatecoluca PA  Santa Teresa	\\N	\\N	\\N
41	Hospital Nacional Ilobasco CA  Dr. José Luis Saca	\\N	\\N	\\N
42	Hospital Nacional Sensuntepeque CA 	\\N	\\N	\\N
43	Hospital Nacional San Vicente SV   Santa Gertrudis	\\N	\\N	\\N
44	Hospital Nacional Jiquilisco US 	\\N	\\N	\\N
45	Hospital Nacional Santiago de María US Dr. Jorge Arturo Mena	\\N	\\N	\\N
46	Hospital Nacional Usulután US  San Pedro	\\N	\\N	\\N
47	Hospital Nacional Ciudad Barrios SM  Monseñor Oscar Arnulfo Romero	\\N	\\N	\\N
48	Hospital Nacional Nueva Guadalupe SM 	\\N	\\N	\\N
50	Hospital Nacional San Francisco Gotera MO Dr. Héctor Antonio Hernández Flores	\\N	\\N	\\N
51	Hospital Nacional La Unión UN 	\\N	\\N	\\N
52	Hospital Nacional Santa Rosa de Lima UN 	\\N	\\N	\\N
53	OSI Ahuachapán AH Frontera Las Chinamas	\\N	\\N	\\N
54	OSI San Francisco Menéndez AH Frontera La Hachadura	\\N	\\N	\\N
55	OSI Candelaria de La Frontera SA Frontera San Cristóbal	\\N	\\N	\\N
56	OSI Metapán SA Frontera Anguiatu	\\N	\\N	\\N
57	OSI Acajutla SO Puerto	\\N	\\N	\\N
58	OSI Citala CH Frontera el Poy	\\N	\\N	\\N
59	OSI San Juan Talpa LP Aeropuerto Internacional	\\N	\\N	\\N
60	OSI La Unión LU Puerto de la Unión	\\N	\\N	\\N
61	OSI Pasaquina LU Frontera el Amatillo	\\N	\\N	\\N
62	UCSF Acajutla SO Costa Azul	\\N	\\N	\\N
63	UCSF Acajutla SO Villa Centenario	\\N	\\N	\\N
64	UCSF Ahuachapan AH Ashapuco	\\N	\\N	\\N
65	UCSF Ahuachapan AH El Barro	\\N	\\N	\\N
66	UCSF Ahuachapan AH Llano la Laguna	\\N	\\N	\\N
67	UCSF Atiquizaya AH Rio Frio 1	\\N	\\N	\\N
68	UCSF Caluco SO	\\N	\\N	\\N
69	UCSF Caluco SO El Zapote	\\N	\\N	\\N
70	UCSF Caluco SO Plan de Amayo	\\N	\\N	\\N
71	UCSF Chalchuapa SA	\\N	\\N	\\N
72	UCSF Chalchuapa SA El Coco	\\N	\\N	\\N
73	UCSF Chalchuapa SA El Paste	\\N	\\N	\\N
74	UCSF Concepción de Ataco AH El Triunfo	\\N	\\N	\\N
75	UCSF El Porvenir SA	\\N	\\N	\\N
76	UCSF El Porvenir SA Amate Blanco	\\N	\\N	\\N
77	UCSF El Porvenir SA El Cerrón	\\N	\\N	\\N
78	UCSF El Porvenir SA San Juan Chiquito	\\N	\\N	\\N
79	UCSF El Refugio AH	\\N	\\N	\\N
80	UCSF Guaymango AH San Martin	\\N	\\N	\\N
81	UCSF Alegria US	\\N	\\N	\\N
82	UCSF Alegria US El Quebracho	\\N	\\N	\\N
83	UCSF Alegria US El Zapotillo	\\N	\\N	\\N
84	UCSF Alegria US Las Casitas	\\N	\\N	\\N
85	UCSF Arambala MO	\\N	\\N	\\N
86	UCSF Cacaopera MO	\\N	\\N	\\N
87	UCSF Cacaopera MO Agua Blanca	\\N	\\N	\\N
88	UCSF Cacaopera MO La Estancia	\\N	\\N	\\N
89	UCSF Cacaopera MO Sunsula	\\N	\\N	\\N
90	UCSF Carolina SM 1	\\N	\\N	\\N
91	UCSF Carolina SM La Ceibita	\\N	\\N	\\N
92	UCSF Carolina SM Rosa Nacaspilo	\\N	\\N	\\N
93	UCSF Concepcion Batres US	\\N	\\N	\\N
94	UCSF Concepcion Batres US El Cañal	\\N	\\N	\\N
95	UCSF Concepcion Batres US Hacienda Nueva	\\N	\\N	\\N
96	UCSF Concepcion Batres US San Felipe	\\N	\\N	\\N
97	UCSF Conchagua LU El Pilón	\\N	\\N	\\N
98	UCSF Conchagua LU Las Tunas	\\N	\\N	\\N
99	UCSF El Sauce LU	\\N	\\N	\\N
100	UCSF El Sauce LU Santa Rosita	\\N	\\N	\\N
101	UCSF El Sauce LU Talpetate	\\N	\\N	\\N
102	UCSF Guatajiagua MO San Bartolo	\\N	\\N	\\N
103	UCSF Jiquilisco US	\\N	\\N	\\N
104	UCSF Joateca MO La Laguna	\\N	\\N	\\N
105	UCSF Jocoaitique MO	\\N	\\N	\\N
106	UCSF Jocoaitique MO Quebrachos	\\N	\\N	\\N
49	Hospital Nacional San Miguel  SM San Juan de Dios	Calle al Hospital Barrio Roma	2435-9500	\\N
107	UCSF Jucuaran US	\\N	\\N	\\N
108	UCSF Jucuaran US El Espino	\\N	\\N	\\N
109	UCSF Jucuaran US El Jutal	\\N	\\N	\\N
110	UCSF Jucuaran US El Zapote	\\N	\\N	\\N
111	UCSF Lislique LU	\\N	\\N	\\N
112	UCSF Lislique LU El Derrumbado	\\N	\\N	\\N
113	UCSF Lislique LU Guajiniquil	\\N	\\N	\\N
114	UCSF Lislique LU Higueras	\\N	\\N	\\N
115	UCSF Apastepeque SV San Nicolas	\\N	\\N	\\N
116	UCSF Apastepeque SV San Pedro	\\N	\\N	\\N
117	UCSF Candelaria CU	\\N	\\N	\\N
118	UCSF Candelaria CU El Rosario	\\N	\\N	\\N
119	UCSF Candelaria CU Miraflores Arriba	\\N	\\N	\\N
120	UCSF Candlaria CU Concepción	\\N	\\N	\\N
121	UCSF Cinquera CA	\\N	\\N	\\N
122	UCSF Cuyultitan LP	\\N	\\N	\\N
123	UCSF Cuyultitan LP San Antonio	\\N	\\N	\\N
124	UCSF Santa Clara SV	\\N	\\N	\\N
125	UCSF Santa Clara SV Santa Rosa	\\N	\\N	\\N
126	UCSF Santa Cruz Analquito CU	\\N	\\N	\\N
127	UCSF Santa Cruz Michapa CU Buena Vista	\\N	\\N	\\N
128	UCSF Santa María Ostuma LP	\\N	\\N	\\N
129	UCSF Santa María Ostuma LP El Carrizal	\\N	\\N	\\N
130	UCSF Santa María Ostuma LP El Chaperno	\\N	\\N	\\N
131	UCSF Tapalhuaca LP	\\N	\\N	\\N
132	UCSF Victoria CA Azacualpa	\\N	\\N	\\N
134	UCSF Agua Caliente CH	\\N	\\N	\\N
135	UCSF Agua Caliente CH Cerro Grande	\\N	\\N	\\N
136	UCSF Agua Caliente CH El Carmen	\\N	\\N	\\N
137	UCSF Agua Caliente CH Obrajuelo	\\N	\\N	\\N
138	UCSF Arcatao CH	\\N	\\N	\\N
139	UCSF Azacualpa CH	\\N	\\N	\\N
140	UCSF Chalatenango CH Guarjila	\\N	\\N	\\N
141	UCSF Chiltiupán LL	\\N	\\N	\\N
142	UCSF Chiltiupán LL Taquillo Ing. Orlando Recinos	\\N	\\N	\\N
143	UCSF Chiltiupán LL Termophilas	\\N	\\N	\\N
144	UCSF Citala CH	\\N	\\N	\\N
145	UCSF Teotepeque LL El Angel	\\N	\\N	\\N
146	UCSF Teotepeque LL Mizata	\\N	\\N	\\N
147	UCSF Aguilares SS La Florida	\\N	\\N	\\N
148	UCSFE Ilobasco CA	\\N	\\N	\\N
149	UCSFE Olocuilta LP	\\N	\\N	\\N
150	UCSFE San Pedro Perulapan CU	\\N	\\N	\\N
151	UCSFE Sensuntepeque CA	\\N	\\N	\\N
152	UCSFE Verapaz SV	\\N	\\N	\\N
153	UCSFE Chalatenango CH Guarjila	\\N	\\N	\\N
154	UCSFE Colón LL Ciudad Mujer	\\N	\\N	\\N
155	UCSFE Concepción Quezaltepeque CH	\\N	\\N	\\N
156	UCSFE Dulce Nombre de Maria CH	\\N	\\N	\\N
157	UCSFE La Palma CH	\\N	\\N	\\N
158	UCSFE Puerto La Libertad LL	\\N	\\N	\\N
159	UCFS Cuscatancingo SS (P)	\\N	\\N	\\N
160	UCSF  Ilopango SS (P)	\\N	\\N	\\N
161	UCSF Aguilares SS (P)	\\N	\\N	\\N
162	UCSF Apopa SS (P)	\\N	\\N	\\N
163	UCSF Ciudad Delgado SS (P)	\\N	\\N	\\N
164	UCSF Ciudad Delgado SS Habitat Confien (P)	\\N	\\N	\\N
23	Hospital Nacional Ahuachapán AH Dr. Francisco Menéndez	\\N	\\N	\\N
36	Hospital Nacional San Salvador SS Maternidad Dr. Raúl Arguello Escolan 	Calle Arce y 25 Avenida Norte, San Salvador, \nDepartamento de San Salvador	2224-4073	\\N
25	Hospital Nacional Santa Ana SA San Juan de Dios	Trece Avenida Sur, Santa Ana, 503	2435-9500	\\N
133	UCSF Tejutla CH El Salitre	\\N	\\N	\\N
\.


--
-- Name: ctl_establecimiento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_establecimiento_id_seq', 1, false);


--
-- Data for Name: ctl_habito_toxico; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_habito_toxico (id, habito_toxico) FROM stdin;
1	Alcohol
\.


--
-- Name: ctl_habito_toxico_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_habito_toxico_id_seq', 1, false);


--
-- Data for Name: ctl_municipio; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_municipio (id, id_departamento, nombre, codigo_cnr, abreviatura) FROM stdin;
1	1	Ahuachapán AH	1	\\N
2	1	Apaneca AH	2	\\N
3	1	Atiquizaya AH	3	\\N
4	1	Concepción de Ataco AH	4	\\N
5	1	El Refugio AH	5	\\N
6	1	Guaymango AH	6	\\N
7	1	Jujutla AH	7	\\N
8	1	San Francisco Menéndez AH	8	\\N
9	1	San Lorenzo AH	9	\\N
10	1	San Pedro Puxtla AH	10	\\N
11	1	Tacuba AH	11	\\N
12	1	Turin AH	12	\\N
13	2	Candelaria de La Frontera SA	1	\\N
14	2	Coatepeque SA	2	\\N
15	2	Chalchuapa SA	3	\\N
16	2	El Congo SA	4	\\N
17	2	El Porvenir SA	5	\\N
18	2	Masahuat SA	6	\\N
19	2	Metapán SA	7	\\N
20	2	San Antonio Pajonal SA	8	\\N
21	2	San Sebastián Salitrillo SA	9	\\N
22	2	Santa Ana SA	10	\\N
23	2	Santa Rosa Guachipilin SA	11	\\N
24	2	Santiago de La Frontera SA	12	\\N
25	2	Texistepeque SA	13	\\N
26	3	Acajutla SO	1	\\N
27	3	Armenia SO	2	\\N
28	3	Caluco SO	3	\\N
29	3	Cuisnahuat SO	4	\\N
30	3	Santa Isabel Ishuatán SO	5	\\N
31	3	Izalco SO	6	\\N
32	3	Juayua SO	7	\\N
33	3	Nahuizalco SO	8	\\N
34	3	Nahuilingo SO	9	\\N
35	3	Salcoatitán SO	10	\\N
36	3	San Antonio del Monte SO	11	\\N
37	3	San Julián SO	12	\\N
38	3	Santa Catarina Masahuat SO	13	\\N
39	3	Santo Domingo de Guzmán SO	14	\\N
40	3	Sonsonate SO	15	\\N
41	3	Sonzacate SO	16	\\N
42	4	Agua Caliente CH	1	\\N
43	4	Arcatao CH	2	\\N
44	4	Azacualpa CH	3	\\N
45	4	Citalá CH	4	\\N
46	4	Comalapa CH	5	\\N
47	4	Concepción Quezaltepeque CH	6	\\N
48	4	Chalatenango CH	7	\\N
49	4	Dulce Nombre de María CH	8	\\N
50	4	El Carrizal CH	9	\\N
51	4	El Paraiso CH	10	\\N
52	4	La Laguna CH	11	\\N
53	4	La Palma CH	12	\\N
54	4	La Reina CH	13	\\N
55	4	Las Vueltas CH	14	\\N
56	4	Nombre de Jesús CH	15	\\N
57	4	Nueva Concepción CH	16	\\N
58	4	Nueva Trinidad CH	17	\\N
59	4	Ojos de Agua CH	18	\\N
60	4	Potonico CH	19	\\N
61	4	San Antonio de La Cruz CH	20	\\N
62	4	San Antonio Los Ranchos CH	21	\\N
63	4	San Fernando CH	22	\\N
64	4	San Francisco Lempa CH	23	\\N
65	4	San Francisco Morazán CH	24	\\N
66	4	San Ignacio CH	25	\\N
67	4	San Isidro Labrador CH	26	\\N
68	4	Cancasque CH	27	\\N
69	4	Las Flores CH	28	\\N
70	4	San Luis del Carmen CH	29	\\N
71	4	San Miguel de Mercedes CH	30	\\N
72	4	San Rafael CH	31	\\N
73	4	Santa Rita CH	32	\\N
74	4	Tejutla CH	33	\\N
75	5	Antiguo Cuscatlán LI	1	\\N
76	5	Ciudad Arce LI	2	\\N
77	5	Colón LI	3	\\N
78	5	Comasagua LI	4	\\N
79	5	Chiltiupán LI	5	\\N
80	5	Huizúcar LI	6	\\N
81	5	Jayaque LI	7	\\N
82	5	Jicalapa LI	8	\\N
83	5	La Libertad LI	9	\\N
84	5	Nuevo Cuscatlán LI	10	\\N
85	5	Santa Tecla LI	11	\\N
86	5	Quezaltepeque LI	12	\\N
87	5	Sacacoyo LI	13	\\N
88	5	San José Villanueva LI	14	\\N
89	5	San Juan Opico LI	15	\\N
90	5	San Matías LI	16	\\N
91	5	San Pablo Tacachico LI	17	\\N
92	5	Tamanique LI	18	\\N
93	5	Talnique LI	19	\\N
94	5	Teotepeque LI	20	\\N
95	5	Tepecoyo LI	21	\\N
96	5	Zaragoza LI	22	\\N
97	6	Aguilares SS	1	\\N
98	6	Apopa SS	2	\\N
99	6	Ayutuxtepeque SS	3	\\N
100	6	Cuscatancingo SS	4	\\N
101	6	El Paisnal SS	5	\\N
102	6	Guazapa SS	6	\\N
103	6	Ilopango SS	7	\\N
104	6	Mejicanos SS	8	\\N
105	6	Nejapa SS	9	\\N
106	6	Panchimalco SS	10	\\N
107	6	Rosario de Mora SS	11	\\N
108	6	San Marcos SS	12	\\N
109	6	San Martín SS	13	\\N
110	6	San Salvador SS	14	\\N
111	6	Santiago Texacuangos SS	15	\\N
112	6	Santo Tomás SS	16	\\N
113	6	Soyapango SS	17	\\N
114	6	Tonacatepeque SS	18	\\N
115	6	Delgado SS	19	\\N
116	7	Candelaria CU	1	\\N
117	7	Cojutepeque CU	2	\\N
118	7	El Carmen CU	3	\\N
119	7	El Rosario CU	4	\\N
120	7	Monte San Juan CU	5	\\N
121	7	Oratorio de Concepción CU	6	\\N
122	7	San Bartolome Perulapía CU	7	\\N
123	7	San Cristóbal CU	8	\\N
124	7	San José Guayabal CU	9	\\N
125	7	San Pedro Perulapán CU	10	\\N
126	7	San Rafael Cedros CU	11	\\N
127	7	San Ramón CU	12	\\N
128	7	Santa Cruz Analquito CU	13	\\N
129	7	Santa Cruz Michapa CU	14	\\N
130	7	Suchitoto CU	15	\\N
131	7	Tenancíngo CU	16	\\N
132	8	Cuyultitán PA	1	\\N
133	8	El Rosario PA	2	\\N
134	8	Jerusalén PA	3	\\N
135	8	Mercedes de La Ceiba PA	4	\\N
136	8	Olocuilta PA	5	\\N
137	8	Paraíso de Osorio PA	6	\\N
138	8	San Antonio Masahuat PA	7	\\N
139	8	San Emigdio PA	8	\\N
140	8	San Francisco Chinaméca PA	9	\\N
141	8	San Juan Nonualco PA	10	\\N
142	8	San Juan Talpa PA	11	\\N
143	8	San Juan Tepezontes PA	12	\\N
144	8	San Luis Talpa PA	13	\\N
145	8	San Miguel Tepezontes PA	14	\\N
146	8	San Pedro Masahuat PA	15	\\N
147	8	San Pedro Nonualco PA	16	\\N
148	8	San Rafael Obrajuelo PA	17	\\N
149	8	Santa María Ostuma PA	18	\\N
150	8	Santiago Nonualco PA	19	\\N
151	8	Tapalhuaca PA	20	\\N
152	8	Zacatecolúca PA	21	\\N
153	8	San Luis de La Herradura PA	22	\\N
154	9	Cinquera CA	1	\\N
155	9	Guacotecti CA	2	\\N
156	9	Ilobásco CA	3	\\N
157	9	Jutiapa CA	4	\\N
158	9	San Isidro CA	5	\\N
159	9	Sensuntepeque CA	6	\\N
160	9	Tejutepeque CA	7	\\N
161	9	Victoria CA	8	\\N
162	9	Dolores CA	9	\\N
163	10	Apastepeque SV	1	\\N
164	10	Guadalupe SV	2	\\N
165	10	San Cayetano Istepeque SV	3	\\N
166	10	Santa Clara SV	4	\\N
167	10	Santo Domingo SV	5	\\N
168	10	San Esteban Catarina SV	6	\\N
169	10	San Ildefonso SV	7	\\N
170	10	San Lorenzo SV	8	\\N
171	10	San Sebastián SV	9	\\N
172	10	San Vicente SV	10	\\N
173	10	Tecoluca SV	11	\\N
174	10	Tepetitán SV	12	\\N
175	10	Verapaz SV	13	\\N
176	11	Alegría US	1	\\N
177	11	Berlín US	2	\\N
178	11	California US	3	\\N
179	11	Concepción Batres US	4	\\N
180	11	El Triunfo US	5	\\N
181	11	Ereguayquín US	6	\\N
182	11	Estanzuelas US	7	\\N
183	11	Jiquilisco US	8	\\N
184	11	Jucuapa US	9	\\N
185	11	Jucuarán US	10	\\N
186	11	Mercedes Umana US	11	\\N
187	11	Nueva Granada US	12	\\N
188	11	Ozatlán US	13	\\N
189	11	Puerto El Triunfo US	14	\\N
190	11	San Agustín US	15	\\N
191	11	San Buenaventura US	16	\\N
192	11	San Dionisio US	17	\\N
193	11	Santa Elena US	18	\\N
194	11	San Francisco Javier US	19	\\N
195	11	Santa María US	20	\\N
196	11	Santiago de María US	21	\\N
197	11	Tecapán US	22	\\N
198	11	Usulután US	23	\\N
199	12	Carolina SM	1	\\N
200	12	Ciudad Barrios SM	2	\\N
201	12	Comacarán SM	3	\\N
202	12	Chapeltique SM	4	\\N
203	12	Chinameca SM	5	\\N
204	12	Chirilagua SM	6	\\N
205	12	El Tránsito SM	7	\\N
206	12	Lolotique SM	8	\\N
207	12	Moncagua SM	9	\\N
208	12	Nueva Guadalupe SM	10	\\N
209	12	Nuevo Edén de San Juan SM	11	\\N
210	12	Quelepa SM	12	\\N
211	12	San Antonio SM	13	\\N
212	12	San Gerardo SM	14	\\N
213	12	San Jorge SM	15	\\N
214	12	San Luis de La Reina SM	16	\\N
215	12	San Miguel SM	17	\\N
216	12	San Rafael Oriente SM	18	\\N
217	12	Sesori SM	19	\\N
218	12	Uluazapa SM	20	\\N
219	13	Arambala MO	1	\\N
220	13	Cacaopera MO	2	\\N
221	13	Corinto MO	3	\\N
222	13	Chilanga MO	4	\\N
223	13	Delicias de Concepción MO	5	\\N
224	13	El Divisadero MO	6	\\N
225	13	El Rosario MO	7	\\N
226	13	Gualococti MO	8	\\N
227	13	Guatajiagua MO	9	\\N
228	13	Joateca MO	10	\\N
229	13	Jocoaitique MO	11	\\N
230	13	Jocoro MO	12	\\N
231	13	Lolotiquillo MO	13	\\N
232	13	Meanguera MO	14	\\N
233	13	Osicala MO	15	\\N
234	13	Perquín MO	16	\\N
235	13	San Carlos MO	17	\\N
236	13	San Fernando MO	18	\\N
237	13	San Francisco Gotera MO	19	\\N
238	13	San Isidro MO	20	\\N
239	13	San Simón MO	21	\\N
240	13	Sensembra MO	22	\\N
241	13	Sociedad MO	23	\\N
242	13	Torola MO	24	\\N
243	13	Yamabal MO	25	\\N
244	13	Yoloaiquín MO	26	\\N
245	14	Anamorós UN	1	\\N
246	14	Bolívar UN	2	\\N
247	14	Concepción de Oriente UN	3	\\N
248	14	Conchagua UN	4	\\N
249	14	El Carmen UN	5	\\N
250	14	El Sauce UN	6	\\N
251	14	Intipucá UN	7	\\N
252	14	La Unión UN	8	\\N
253	14	Lislique UN	9	\\N
254	14	Nueva Esparta UN	11	\\N
255	14	Pasaquina UN	12	\\N
256	14	Polorós UN	13	\\N
257	14	San Alejo UN	14	\\N
258	14	San José UN	15	\\N
259	14	Santa Rosa de Lima UN	16	\\N
260	14	Yayantique UN	17	\\N
261	14	Yucuaiquín UN	18	\\N
262	14	Meanguera del Golfo UN	10	\\N
\.


--
-- Name: ctl_municipio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_municipio_id_seq', 1, false);


--
-- Data for Name: ctl_nacionalidad; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_nacionalidad (id, nacionalidad) FROM stdin;
1	Salvadoreña
2	Hondureña
3	Guatemalteca
4	Costarricense
5	Cubana
6	Mexicana
\.


--
-- Name: ctl_nacionalidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_nacionalidad_id_seq', 1, false);


--
-- Data for Name: ctl_patologia; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_patologia (id, patologia) FROM stdin;
1	Hipertension
2	Diabetes
\.


--
-- Name: ctl_patologia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_patologia_id_seq', 1, false);


--
-- Data for Name: ctl_sexo; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY ctl_sexo (id, nombre, abreviatura) FROM stdin;
1	Femenino	F
2	Masculino	M
\.


--
-- Name: ctl_sexo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('ctl_sexo_id_seq', 1, false);


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

COPY fos_user_user (id, id_rol, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code, usuario, id_establecimiento, id_empleado) FROM stdin;
11	1	admin_roberto	admin_roberto	veta6363@gmail.com	veta6363@gmail.com	t	3arvsnvl2qm8wc4c0ccsc8w08ck0o48	6DTflhChY9VIVVNwbuiGZDpyCKHOJ3IK7DiOTgyiYWfN9jT8h43700+J6aWd+KCwcd7Sanztv20E7/1GRb/G0A==	2015-02-24 15:57:07	f	f	\N	nTO_91gHfPXeH0Hx2iUAsRiZsm36lGT_IsVbgeBLv_o	2014-11-06 09:07:14	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2014-10-06 10:02:59	2015-02-24 15:57:07	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	36	\N
3	\N	Farid	farid	dfhernandez1@salud.gob.sv	dfhernandez1@salud.gob.sv	t	efkeoam41y0cwkwgwsgokkowwowkcg8	siF5uuV7JtnfLAwlVuvq+b2PcHAFFTaEZGefwJxMS/lZSQk/GH4TEOJZ/v3JzViuSC8B2aWqZWQyY3fkT99o5A==	2017-06-26 10:00:39	f	f	\N	\N	\N	a:1:{i:0;s:18:"ROLE_LABORATORISTA";}	f	\N	2017-06-26 09:58:13	2017-06-26 10:00:39	\N	\N	\N	\N	\N	m	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	36	\N
4	\N	mpenate	mpenate	mpenate@salud.gob.sv	mpenate@salud.gob.sv	t	5s99fktqk1og8kwsswo8cs4g4844wsg	DEvztXULb0NP7/FGPlCeLjcLW+BVE18OGNQcnVllfOaMMnV6eSjWePqO1Av9USxjHstfAqQqTn70v+Hwe0OEZw==	2017-06-26 10:02:06	f	f	\N	\N	\N	a:1:{i:0;s:17:"ROLE_SONATA_ADMIN";}	f	\N	2017-06-26 09:59:58	2017-06-26 10:02:06	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	25	\N
5	\N	Marvin	marvin	marvin@salud.gob.sv	marvin@salud.gob.sv	t	gt9qimh3xjwwcokw80ock444kc0k8os	fQqVQDT1UX3dC9CF46aue53auul8hqkMMrNj6VMBvNIc/0jDDvs0bThgGVqHduSgnFoDdM1l4G2jOpT0rckVAQ==	2017-06-26 11:57:57	f	f	\N	\N	\N	a:1:{i:0;s:13:"ROLE_PEDIATRA";}	f	\N	2017-06-26 11:57:46	2017-06-26 11:57:57	\N	\N	\N	\N	\N	m	es_SV	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	32	\N
6	\N	adminblh	adminblh	dfhernandez@salud.gob.sv	dfhernandez@salud.gob.sv	t	c634iueottkwo0gw0wooo808w88ws44	QgMyoB1mz0mtG1PL7rEsI9MV45fVAuUZKXlP66i7M6EZVF6BA+dUa5bewbgUB3PHb572yZjiF1Yv4AiTmJUrpw==	2017-06-30 15:01:54	f	f	\N	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2017-06-30 16:01:43	2017-06-30 15:01:54	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	\N	\N
2	\N	admin_farid	admin_farid	dfhernandez@salud.gob.sv	dfhernandez@salud.gob.sv	t	nerbweigxv4s8oco88sgg8ss0o0g4ww	08ELNR+c+AOg0d3cd9TKodfdMCBAX6aQvqtpO5PSBuuRN4UkV4MQoamv5bN4LqB6WkjZ9WlEf9huixiqKom3ag==	2017-07-04 16:40:15	f	f	\N	\N	\N	a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}	f	\N	2017-06-23 15:15:03	2017-07-04 16:40:15	\N	\N	\N	\N	\N	u	\N	\N	\N	\N	\N	null	\N	\N	null	\N	\N	null	\N	\N	\N	36	\N
\.


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY fos_user_user_group (id, user_id, group_id) FROM stdin;
\.


--
-- Name: fos_user_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('fos_user_user_group_id_seq', 1, false);


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('fos_user_user_id_seq', 6, true);


--
-- Data for Name: mnt_empleado; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_empleado (id) FROM stdin;
\.


--
-- Name: mnt_empleado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_empleado_id_seq', 1, false);


--
-- Data for Name: mnt_expediente; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_expediente (id, numero, id_paciente, id_establecimiento) FROM stdin;
2	1234-17	54	25
3	1204-17	67	25
\.


--
-- Name: mnt_expediente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_expediente_id_seq', 3, true);


--
-- Data for Name: mnt_paciente; Type: TABLE DATA; Schema: public; Owner: siblh
--

COPY mnt_paciente (id, id_sexo, id_municipio_domicilio, hora_nacimiento, fecha_nacimiento, primer_nombre, segundo_nombre, tercer_nombre, primer_apellido, segundo_apellido, direccion) FROM stdin;
54	2	1	\N	2017-06-01	ROSA			COCA	ORELLANA	cualquier tontera
52	2	1	\N	2017-06-01	JOHANA	MARSELA		MARROQUIN	VALENCIA	cualquier tontera
53	1	1	\N	2017-06-01	TEODORO			LUNA	GONZALEZ	cualquier tontera
55	2	1	\N	2017-06-01	CLAUDIA	LISSETH	\N	ALEMAN	\N	cualquier tontera
56	1	1	\N	2017-06-01	JOSUE	DANIEL	\N	MARTINEZ	BARRERA	cualquier tontera
57	2	1	\N	2017-06-01	DORA	ANTONIA	\N	ALVARADO	JUAREZ	cualquier tontera
58	2	1	\N	2017-06-01	KARLA	YESSENIA		BOLAÑOS	RIVAS	cualquier tontera
59	1	1	\N	2017-06-01	CRISTOPHER	ELIEL		BERNAL	ZAVALETA	cualquier tontera
60	1	1	\N	2017-06-01	MELVIN	JOHAN		TREJO	PINEDA	cualquier tontera
61	1	1	\N	2017-06-01	MATTEO	ISMAEL		PORTILLO	ORELLANA	cualquier tontera
62	2	1	\N	2017-06-01	MARLENE	ANTONIA		MORAN	ALARCON	cualquier tontera
63	2	1	\N	2017-06-01	RECIEN	NACIDO		VELIS	PINEDA	cualquier tontera
64	2	1	\N	2017-06-01	MAYRA	SULEYMA		CATOTA	RAMIREZ	cualquier tontera
65	2	1	\N	2017-06-01	ANDREA	GUADALUPE		RODRIGUEZ	SANTOS	cualquier tontera
66	1	1	\N	2017-06-01	OSCAR	ARMANDO	\N	AGUILAR	FLORES	cualquier tontera
67	2	1	\N	2017-06-01	FATIMA	YUSMARI		AQUINO	ESPINOZA	cualquier tontera
68	2	1	\N	2017-06-01	GLORIA	NAYELI		CATALAN	ALVAREZ	cualquier tontera
69	1	1	\N	2017-06-01	BRAYAN	MAURICIO	\N	FLORES	\N	cualquier tontera
70	1	1	\N	2017-06-01	SAMUEL			LOPEZ	GONZALEZ	cualquier tontera
71	2	1	\N	2017-06-01	KATHERINE	PATRICIA		AVILES	RIVERA	cualquier tontera
72	2	1	\N	2017-06-01	LISBETH	ALEJANDRA		PALACIOS	GARCIA	cualquier tontera
73	2	1	\N	2017-06-01	ELIDA	\N	\N	FARELA	ROSA	cualquier tontera
74	2	1	\N	2017-06-01	REYNA	GUADALUPE	\N	AYALA	IRAHETA	cualquier tontera
75	2	1	\N	2017-06-01	CECILIA	GUADALUPE	\N	PALACIOS	CRUZ	cualquier tontera
76	1	1	\N	2017-06-01	ALFREDO	JOSE	\N	BARILLAS	FABIAN	cualquier tontera
77	1	1	\N	2017-06-01	JOSE	EFRAIN	\N	DIAZ	FUENTES	cualquier tontera
78	2	1	\N	2017-06-01	ANA	ISABEL	\N	VARGAS	\N	cualquier tontera
79	1	1	06:05:00	2017-06-01	RECIEN	NACIDO		GUILLEN	MENDOZA	cualquier tontera
80	2	1	\N	2017-06-01	JACKELINE	NOEMY		MEJIA	CORTEZ	cualquier tontera
81	2	1	\N	2017-06-01	LIZ	BETHANIA		ALFARO	DECRUZ	cualquier tontera
82	2	1	\N	2017-06-01	NAELE	ELEANA		MARTINEZ	MARTINEZ	cualquier tontera
83	2	1	\N	2017-06-01	TIFFANY	ESMERALDA		ZEPEDA	LOPEZ	cualquier tontera
84	1	1	\N	2017-06-01	ISMAEL	ADALBERTO		RODRIGUEZ	ZEPEDA	cualquier tontera
85	1	1	\N	2017-06-01	SAMUEL	ANTONIO		RODRIGUEZ		cualquier tontera
86	1	1	\N	2017-06-01	RAFAEL			ROJAS		cualquier tontera
87	1	1	\N	2017-06-01	SANTIAGO			CISNEROS	MORALES	cualquier tontera
88	2	1	\N	2017-06-01	KARLA	MERCEDES		RAMIREZ	QUINTEROS	cualquier tontera
89	1	1	\N	2017-06-01	EDGAR	GERARDO		CALDERON	DUBON	cualquier tontera
90	2	1	\N	2017-06-01	RECIEN	NACIDO		PEREZ	AMAYA	cualquier tontera
91	2	1	\N	2017-06-01	ASHLY	NAYELI		CALDERON	FLORES	cualquier tontera
92	2	1	\N	2017-06-01	ROSA	HAYDEE		LAZO	DE HENRIQUEZ	cualquier tontera
93	2	1	\N	2017-06-01	RUTH	ANTONIETA		RIVERA	CHINCHILLA	cualquier tontera
94	1	1	\N	2017-06-01	JOSE LUIS	\N	\N	CABRERA	\N	cualquier tontera
95	2	1	\N	2017-06-01	SULMA	IVANIA		PINEDA	SALAZAR	cualquier tontera
96	1	1	\N	2017-06-01	OSCAR	ANIBAL		HERNANDEZ	CASTRO	cualquier tontera
97	2	1	\N	2017-06-01	EVELIN	ISELA		HERRERA	DE SANCHEZ	cualquier tontera
98	2	1	\N	2017-06-01	MARIA	JOAQUINA		ORELLANA	FRANCO	cualquier tontera
99	2	1	\N	2017-06-01	SONIA	DEL CARMEN		BARRERA	AQUINO	cualquier tontera
100	1	1	\N	2017-06-01	FRANCISCO			RIVAS	HIDALGO	cualquier tontera
101	1	1	\N	2017-06-01	ALCIDES			SANTAMARIA	GOMEZ	cualquier tontera
102	2	1	\N	2017-06-01	REVECA	MARISOL		MARTELL	RODRIGUEZ	cualquier tontera
103	2	1	\N	2017-06-01	ANA	DEL CARMEN		RAMOS	VALLE	cualquier tontera
104	1	1	\N	2017-06-01	ELMER	JAVIER		DE LA O	SANCHEZ	cualquier tontera
105	2	1	\N	2017-06-01	ANA	ELSA	\N	PACAS	DECORADO	cualquier tontera
106	1	1	\N	2017-06-01	GERSON	ALEXANDER	\N	GONZALEZ	MARTINEZ	cualquier tontera
107	1	1	\N	2017-06-01	RIGOBERTO	ALEXANDER	\N	HENRIQUEZ	AGUIRRE	cualquier tontera
108	2	1	\N	2017-06-01	SONIA	MARLENE	\N	AVILES	DEBEJARANA	cualquier tontera
109	1	1	\N	2017-06-01	CARLOS	HUMBERTO		HERNANDEZ	NAJARRO	cualquier tontera
110	1	1	\N	2017-06-01	ELKIN	DALY		TREJO	COCA	cualquier tontera
111	2	1	\N	2017-06-01	NORMA	ROSA	MARGARITA	NAVARRO	DEALVARENGA	cualquier tontera
112	2	1	\N	2017-06-01	JOHANA	SARAI		MARTINEZ	QUINTANILA	cualquier tontera
113	2	1	\N	2017-06-01	RECIEN	NACIDO		FUENTES	SIBRIAN	cualquier tontera
114	2	1	\N	2017-06-01	MARIA	ERNESTINA		RIVAS		cualquier tontera
115	1	1	\N	2017-06-01	RECIEN	NACIDO		FUENTES	GUEVARA	cualquier tontera
116	2	1	\N	2017-06-01	MARITZA	CRISTABEL		VASQUEZ	RAMOS	cualquier tontera
117	1	1	\N	2017-06-01	RECIEN	NACIDO		PORTILLO		cualquier tontera
118	2	1	\N	2017-06-01	MAGDALENA	NOEMY		PORTILLO	DE RAMIREZ	cualquier tontera
119	1	1	\N	2017-06-01	JORGE	ULISES		RODRIGUEZ	PINEDA	cualquier tontera
120	2	1	\N	2017-06-01	ALEXANDRA	ABIGAIL		CUBIAS	GUARDADO	cualquier tontera
121	2	1	\N	2017-06-01	HAILEY	ANAHI		RIVERA	CAPACHO	cualquier tontera
122	2	1	\N	2017-06-01	RECIEN	NACIDO		MANCIA	MEJIA	cualquier tontera
123	1	1	\N	2017-06-01	RECIEN	NACIDO		DELGADO		cualquier tontera
124	1	1	\N	2017-06-01	SIFREDO			RESINOS	SARMIENTOS	cualquier tontera
125	2	1	\N	2017-06-01	ANA	ARACELI		FIGUEROA	DE CONTRERAS	cualquier tontera
126	2	1	\N	2017-06-01	MARIA	SANTOS	\N	RIVAS	HERNANDEZ	cualquier tontera
127	2	1	\N	2017-06-01	CLARIBEL	ANTONIA		RODRIGUEZ	GUEVARA	cualquier tontera
128	2	1	\N	2017-06-01	FRANCISCA	OLGA	\N	MARTINEZ	GUTIERREZ	cualquier tontera
129	2	1	\N	2017-06-01	CECILIA	ELIZABETH	\N	LOPEZ	CRUZ	cualquier tontera
130	1	1	\N	2017-06-01	ALEJANDRA	MARIA	\N	MENJIVAR	MIRANDA	cualquier tontera
131	2	1	\N	2017-06-01	VICTORIA	\N	\N	ROSALES	\N	cualquier tontera
132	2	1	\N	2017-06-01	KEYRY	carolina	\N	SIBRIAN	MEDINA	cualquier tontera
133	1	1	\N	2017-06-01	MIGUEL	EMILIO		AREVALO	FIGUEROA	cualquier tontera
134	2	1	\N	2017-06-01	LILIANA			SILES	LEON	cualquier tontera
135	2	1	\N	2017-06-01	ALEJANDRA	GUADALUPE		GODINEZ	MARTINEZ	cualquier tontera
136	1	1	\N	2017-06-01	ELEUTERIO			ARTIGA	DE PAZ	cualquier tontera
137	2	1	\N	2017-06-01	TEODORA			JIMENEZ	DE MANCIA	cualquier tontera
138	1	1	\N	2017-06-01	JOSE	JOAQUIN		ROSA		cualquier tontera
139	2	1	\N	2017-06-01	MARIA	DEL CARMEN		TOBAR		cualquier tontera
140	2	1	\N	2017-06-01	JOSE	JEREMIAS		DIAZ	JIMENEZ	cualquier tontera
141	2	1	\N	2017-06-01	ASTRID	GUADALUPE	\N	AGUIAR	REINA	cualquier tontera
142	2	1	\N	2017-06-01	CIPRIANA	EMILDA		FUENTES	ARCE	cualquier tontera
143	2	1	\N	2017-06-01	MARIA	OFELIA		GUERRA	DE LOPEZ	cualquier tontera
144	2	1	\N	2017-06-01	MARIA	MAGDALENA	\N	VASQUEZ	AGUILAR	cualquier tontera
145	1	1	\N	2017-06-01	MARCIANA			GARCIA	GONZALEZ	cualquier tontera
146	1	1	\N	2017-06-01	VICENTE	\N	\N	AMAYA	TORRES	cualquier tontera
147	1	1	\N	2017-06-01	JOSE	LUIS		ZELAYA	ROMERO	cualquier tontera
148	1	1	\N	2017-06-01	JOSE	VLADIMIR		JANDRES	HIDALGO	cualquier tontera
149	2	1	\N	2017-06-01	LAURA	YAMILETH	\N	ACOSTA	BOLAñOS	cualquier tontera
150	1	1	\N	2017-06-01	JOSE	DAVID	\N	GONZALEZ	MONTERROSA	cualquier tontera
151	2	1	\N	2017-06-01	GLORIA	ESPERANZA	\N	CEDILLOS	MARQUEZ	cualquier tontera
\.


--
-- Name: mnt_paciente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: siblh
--

SELECT pg_catalog.setval('mnt_paciente_id_seq', 1, false);


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
-- Name: pk_blh_id; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_nacionalidad
    ADD CONSTRAINT pk_blh_id PRIMARY KEY (id);


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
-- Name: pk_blh_pat; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_patologia
    ADD CONSTRAINT pk_blh_pat PRIMARY KEY (id);


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
-- Name: pk_ctl_centro_recoleccion; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_centro_recoleccion
    ADD CONSTRAINT pk_ctl_centro_recoleccion PRIMARY KEY (id);


--
-- Name: pk_ctl_departamento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_departamento
    ADD CONSTRAINT pk_ctl_departamento PRIMARY KEY (id);


--
-- Name: pk_ctl_establecimiento; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_establecimiento
    ADD CONSTRAINT pk_ctl_establecimiento PRIMARY KEY (id);


--
-- Name: pk_ctl_municipio; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT pk_ctl_municipio PRIMARY KEY (id);


--
-- Name: pk_ctl_sexo; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_sexo
    ADD CONSTRAINT pk_ctl_sexo PRIMARY KEY (id);


--
-- Name: pk_fos_user_group; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_group
    ADD CONSTRAINT pk_fos_user_group PRIMARY KEY (id);


--
-- Name: pk_fos_user_user; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT pk_fos_user_user PRIMARY KEY (id);


--
-- Name: pk_fos_user_user_group; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT pk_fos_user_user_group PRIMARY KEY (id);


--
-- Name: pk_hab; Type: CONSTRAINT; Schema: public; Owner: siblh; Tablespace: 
--

ALTER TABLE ONLY ctl_habito_toxico
    ADD CONSTRAINT pk_hab PRIMARY KEY (id);


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
-- Name: fk_departamento_municipio; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_departamento_municipio ON ctl_municipio USING btree (id_departamento);


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
-- Name: fk_establecimiento_fos_user_use; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_establecimiento_fos_user_use ON fos_user_user USING btree (username);


--
-- Name: fk_estado_frasco_recolectado; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_estado_frasco_recolectado ON blh_frasco_recolectado USING btree (id_estado);


--
-- Name: fk_fos_user_group_fos_user_user; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_fos_user_group_fos_user_user ON fos_user_user_group USING btree (group_id);


--
-- Name: fk_fos_user_user_fos_user_user_; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_fos_user_user_fos_user_user_ ON fos_user_user_group USING btree (user_id);


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
-- Name: fk_municipio_paciente_domicilio; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_municipio_paciente_domicilio ON mnt_paciente USING btree (id_municipio_domicilio);


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
-- Name: fk_rol_for_user_usesr; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_rol_for_user_usesr ON fos_user_user USING btree (id_rol);


--
-- Name: fk_rol_rol_menu; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_rol_rol_menu ON blh_rol_menu USING btree (id_rol);


--
-- Name: fk_sexo_paciente; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_sexo_paciente ON mnt_paciente USING btree (id_sexo);


--
-- Name: fk_solicitud_frasco_procesado_s; Type: INDEX; Schema: public; Owner: siblh; Tablespace: 
--

CREATE INDEX fk_solicitud_frasco_procesado_s ON blh_frasco_procesado_solicitud USING btree (id_solicitud);


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
-- Name: trg_after_fos_user_user; Type: TRIGGER; Schema: public; Owner: siblh
--

CREATE TRIGGER trg_after_fos_user_user AFTER INSERT OR DELETE OR UPDATE ON fos_user_user FOR EACH ROW EXECUTE PROCEDURE fn_after_fos_user_user();


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
-- Name: ctl_centro_recoleccion_blh_donacion_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY blh_donacion
    ADD CONSTRAINT ctl_centro_recoleccion_blh_donacion_fk FOREIGN KEY (id_centro_recoleccion) REFERENCES ctl_centro_recoleccion(id);


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
-- Name: ctl_establecimiento_fos_user_user_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT ctl_establecimiento_fos_user_user_fk FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


--
-- Name: ctl_establecimiento_mnt_expediente_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT ctl_establecimiento_mnt_expediente_fk FOREIGN KEY (id_establecimiento) REFERENCES ctl_establecimiento(id);


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
    ADD CONSTRAINT fk_blh_his_hab FOREIGN KEY (habito_toxico) REFERENCES ctl_habito_toxico(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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
-- Name: fk_ctl_muni_fk_depart_ctl_depa; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY ctl_municipio
    ADD CONSTRAINT fk_ctl_muni_fk_depart_ctl_depa FOREIGN KEY (id_departamento) REFERENCES ctl_departamento(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_empleado_fos_user; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_empleado_fos_user FOREIGN KEY (id_empleado) REFERENCES mnt_empleado(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_fos_user_fk_fos_us_fos_group; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_fos_user_fk_fos_us_fos_group FOREIGN KEY (group_id) REFERENCES fos_user_user(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_fos_user_fk_fos_us_fos_user; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user_group
    ADD CONSTRAINT fk_fos_user_fk_fos_us_fos_user FOREIGN KEY (user_id) REFERENCES fos_user_group(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_fos_user_fk_rol_fo_blh_rol; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY fos_user_user
    ADD CONSTRAINT fk_fos_user_fk_rol_fo_blh_rol FOREIGN KEY (id_rol) REFERENCES blh_rol(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_paci_fk_munici_ctl_muni; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_mnt_paci_fk_munici_ctl_muni FOREIGN KEY (id_municipio_domicilio) REFERENCES ctl_municipio(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mnt_paci_fk_sexo_p_ctl_sexo; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_paciente
    ADD CONSTRAINT fk_mnt_paci_fk_sexo_p_ctl_sexo FOREIGN KEY (id_sexo) REFERENCES ctl_sexo(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


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

ALTER TABLE ONLY ctl_centro_recoleccion
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
-- Name: mnt_paciente_mnt_expediente_fk; Type: FK CONSTRAINT; Schema: public; Owner: siblh
--

ALTER TABLE ONLY mnt_expediente
    ADD CONSTRAINT mnt_paciente_mnt_expediente_fk FOREIGN KEY (id_paciente) REFERENCES mnt_paciente(id);


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

