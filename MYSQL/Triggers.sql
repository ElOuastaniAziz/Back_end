1.Crea una nueva tabla nrojos asociada a la base de datos ebanca. Debe contener los campos cuenta,
fecha y saldo, que son del mismo tipo que los que se encuentran en tabla cuenta. 
	Crear un disparador que cree un registro en la tabla nrojos cada vez que una cuenta se quede en números rojos. 
    Verificar antes de insertar que el registro ya exista. En ese caso, hacer modificación en lugar de inserción.

create table nrojos(
	cuenta numeric,
    fecha date,
    saldo int(11));

DELIMITER $$
CREATE TRIGGER nrojos before update  on cuenta
	for each row 
	begin
		declare  total int;
		if new.saldo<0 then
            select count(cuenta) from nrojos where cuenta=new.cod_cuenta into total;
            if total > 0 then
            update nrojos set saldo=new.saldo where cuenta=new.cod_cuenta ;
            update nrojos set fecha=now() where cuenta=new.cod_cuenta ;
            else
			insert into nrojos values(new.cod_cuenta,new.saldo,new.fecha_creacion);
            end if;
		end if;
	end
$$
DELIMITER ;


update cuenta set saldo=-1223 where cod_cuenta=2;
select * from nrojos;
	
SHOW TRIGGERS;
drop trigger nrojos;
select * from cuenta;

2. Cree un disparador para que cada vez que se registre un partido, se actualice el atributo puntos de la
	tabla equipo, el equipo que ha ganado el partido. Usar función creada en ejercicios anteriores.
delimiter &&
DROP function IF EXISTS gana&&
create function gana(cadena text) returns int

begin
	declare longitut integer;
	declare tallar integer;
	declare var1 integer;
	declare var2 integer;
	declare total integer;
	
	set longitut = length(cadena);
	set tallar = INSTR(cadena, '-');
	set var1 = SUBSTRING(cadena, 1, tallar - 1);
	set var2 = SUBSTRING(cadena, tallar+1, longitut - tallar);
	if var1 > var2 then
		return '0';
	else 
		return '1';
	end if;
end&&

DELIMITER $$
CREATE TRIGGER partidos before insert on partido
	for each row 
    begin
    declare lov int;
		select gana(new.resultado) into lov;
        if lov = 0 then
			update equipo set puntos=puntos+1 where id_equipo = new.local;
		end if;
		if lov = 1 then 
			update equipo set puntos=puntos+1 where id_equipo = new.visitante;
        end if;
    end
    $$
DELIMITER ;


3. Cree un disparador que cada vez que se borre una noticia de la base de datos motorblog, registre en una
tabla log_borrados el titulo de la noticia, el usuario y la fecha y hora.

drop table  if exists Log_borrados ;
CREATE table Log_borrados (
	titulo varchar(45),
    usuario varchar(80),
    fecha datetime
);


DELIMITER $$
CREATE TRIGGER  trigger_borrados before delete on noticias
	for each row
    begin
		insert into  Log_borrados values(old.titulo,user(),sysdate());
    end 
    $$
DELIMITER ;

select *from noticias;

delete from noticias where id=66;

select * from Log_borrados; 
drop trigger trigger_borrados;

4. Haga lo necesario para que cada vez que se produzca un movimiento de ebanca, de un ingreso de más
de 1.000 euros se le bonifique con 100 (añadir 100 euros al importe del movimiento). Solo se le
aplicará a clientes con cuentas que superen tres años de antigüedad y durante el periodo comprendido
entre hoy menos un mes y hoy más un mes.
DELIMITER $$
CREATE TRIGGER trigger_ingresos before insert on movimiento
	for each row 
    begin
		declare anyo int;
        declare antiguidad int;
		select fecha from movimiento into anyo;
        set antiguidad = now() -anyo;
        if(antiguidad >3) then 
			if (new.cantidad>=1000) then
					set new.cantidad=new.cantidad+100;
			end if;
		end if;
    end$$
DELIMITER ;

update movimiento set cantidad=2111 where dni=117;
select * from movimiento ;
drop trigger trigger_ingresos;

5. Crea una nueva tabla de nombre posición. La tabla contendrá los atributos: idequipo, nombreequipo,
posición y puntos. Crea un trigger de manera que cada vez que se actualice el campo puntos de un
registro de la tabla equipo de la base liga se borre el contenido de la tabla posición y se inserten todos
los registros de nuevo calculando la posición de cada equipo. Usar un cursor y un order by. (opcional).
create table posicion(
	idequipo int(11),
    nombreequipo varchar(45),
    posicion int(11),
    puntos int(11)
	
);

drop table posicion;

DELIMITER $$
drop trigger if exists trigger_posicion$$
CREATE TRIGGER trigger_posicion before update on equipo 
	for each row
    begin
		delete from  posicion where idequipo=old.id_equipo;
		insert into posicion values(new.id_equipo, new.nombre,posicion,new.puntos);
    end$$
DELIMITER ;

select *  from equipo;
SELECT * FROM posicion;
