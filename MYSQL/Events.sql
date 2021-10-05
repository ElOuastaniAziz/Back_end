1.Cree un evento que cargue una comisión del 2% sobre las cuentas en números rojos cada primero de mes comenzando el 1 del próximo mes.
Para esto deberá mirarse que cuentas hay en la tabla nrojos y hacer un update en el saldo de la cuenta de la tabla cuenta.
 Para probarlo, crealo para que empiece en 2 o tres minutos y se repita cada 20 segundos. 
 (Mírate como se puede parar la ejecución del evento antes de hacerlo).
 
DELIMITER $$
DROP EVENT IF EXISTS ebanca.comision$$
 create event ebanca.comision  on schedule every 20 second
	starts '2019-06-01 00:00:00' +interval  1 month enable
    do  
    begin
		DECLARE comision_ double;
        DECLARE cuenta int;
       	if (select cuenta from nrojos)=cuenta.cod_cuenta then
				update cuenta set saldo=saldo+(saldo*0.2)  ;
			end if;
        end$$
 DELIMITER ;   
 ALTER EVENT ebanca.comision disable;
 
2. Cree un evento que registre diariamente los movimientos superiores a 1.000 euros en una tabla temp.
 Créelo deshabilitado.
CREATE TEMPORARY TABLE temporal(
    movimiento_id  int
    );
    
DELIMITER $$
DROP EVENT if exists registro$$
 create event registro  on schedule every 1 minute
	do 
    begin
		declare VALOR INT;
		declare fin int;
        DECLARE cursor1 CURSOR FOR select CANTIDAD FROM MOVIMIENTO where canitdad>1000; -- decalarar cursor antes de handler
        DECLARE continue handler  FOR NOT FOUND SET FIN=1;
		
        OPEN  cursor1;
        bucle1:LOOP
			if fin then 
				leave bucle1;
			end if;
					FETCH cursor1 into valor ;
		end loop ;
       insert into temporal values(valor);
		close cursor1;
			 
      end$$
DELIMITER ;  
  
 ALTER EVENT registro  disable;
 select * from temporal;
 SHOW EVENTS;
 
 
3. Programe un evento que cuatro veces al año elimine los usuarios del blog que no publican hace más de tres meses 
(puede crear un procedimiento que devuelva el número de noticias de un autor a partir de una fecha dada).
DELIMITER $$
DROP EVENT if exists motorblog.eliminaUsuario $$
 create event motorblog.eliminaUsuario  on schedule every 2 second enable
	do 
    begin
		declare fin int;
		declare id_autor_  int;
        DECLARE cursor1 CURSOR FOR select id_autor from noticias where (noticias=noticias.fecha-now())<=90;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;
		
		open cursor1 ;
        bucle1:LOOP
			fetch cursor1 into  id_autor_ ;
				if fin then
					leave bucle1;
				end if;
		end loop bucle1;
        close cursor1;
		delete from autores where autores.id_autor=id_autor_;
   end$$
DELIMITER ;  

select * from noticias;

4. Programe un análisis (ANALYZE) de las tablas de la base liga para el primer día del próximo mes.

DELIMITER $$
DROP EVENT if exists liga.analisis$$
 create event liga.analisis  on schedule 
	at '2019-06-01 00:00:00' + interval 1 month enable
	do 
	begin 
		ANALYZE TABLE EQUIPO ;
		ANALYZE TABLE FUENTES ;
		ANALYZE TABLE JUGADOR;
		ANALYZE TABLE PARTIDO;
        ANALYZE TABLE NOMBRE_POSICION;
   end$$
DELIMITER ;  
 ALTER EVENT liga.analisis disable;

