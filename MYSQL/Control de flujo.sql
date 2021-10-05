-- Abdelaziz

-- 1. Crea una función que devuelva 1 ó 0 si un número es o no divisible por otro.

DELIMITER //
drop FUNCTION if exists esDevisible//
create function esDevisible(num int) returns int
begin
	if MOD(NUM,2) = 0 then
		return 0;
    else 
		return 1;
	end if;
end//
DELIMITER ;

set @num = esDevisible(15);

select @num;

-- 2 Usee las estructuras condicionales para mostrar el día de la semana según un valor de entrada
-- numérico, 1 para domingo, 2 lunes, etc.

DELIMITER //
drop FUNCTION if exists diasSemana//
create function diasSemana(num int) returns varchar(50)
begin
	case num
		when 0 then
			return 'Domingo';
		when 1 then
			return 'Lunes';
		when 2 then
			return 'Martes';
		when 3 then
			return 'Miercoles';
		when 4 then
			return 'Jueves';
		when 5 then
			return 'Viernes';
		when 6 then
			return 'Sábado';
	end case;
end//
DELIMITER ;

set @dia=diasSemana(6);
select @dia;

-- 3 Cree una función que devuelva el mayor de x números pasados como parámetros.
DELIMITER //
drop FUNCTION if exists numMayor//
create function numMayor(num1 int, num2 int,num3 int,num4 int,num5 int,num6 int,num7 int) 
returns int
begin
	Declare mayor int;
    set mayor =num1;
    if num2 > mayor then
		set mayor = num2 ;
	end if;
	if num3 > mayor then
		set mayor = num3 ;
	end if;
	if num4 > mayor then
		set mayor = num4 ;
	end if;
	if num5 > mayor then
		set mayor = num5 ;
	end if;
	if num6 > mayor then
		set mayor = num6 ;
	end if;
    if num7 > mayor then
		set mayor = num7 ;
	end if;
    return mayor;
end//
DELIMITER ;

drop function  numMayor

set @num = numMayor(1,2,3,4,5,6,7);

select @num;

-- 4. Sobre la base de datos ríos, cree una función que devuelva true si el rio pasa por alguna ciudad de la
-- base de datos y false si no es así. El parámetro de entrada es el nombre del rio.

DELIMITER //
drop FUNCTION if exists rius.pasaRios//
create function rius.pasaRios(nomRio varchar(45)) 
	returns boolean
	deterministic -- el resultano no cambia
begin
	declare pasa boolean ;
    SET pasa = false;
	if (select count(*) from  riu_ciutat where riu_ciutat.Riu like nomRio)=0 then
		set pasa = false;
	else 
		set pasa= true ;
    end if;
    
    return pasa;
end//
DELIMITER ;

select pasaRios('WAD');  select pasaRios('Duero'); 

-- 5. Cree un procedimiento que diga si una palabra, pasada como parámetro, es palíndroma.

DELIMITER //
drop procedure if exists esPalíndroma//
create procedure esPalíndroma(palabra varchar(45)) 
	begin
		declare resultado varchar(45);
        declare i int;
		declare palabra2 varchar(50);
        declare cadenaArreves varchar(45);
        set  cadenaArreves=reverse(palabra);
      
        if cadenaArreves = palabra then 
			set resultado = 'Es Palíndroma';
		else 
			set resultado = 'No es Palíndroma';
		end if;
        select resultado;
	end//
DELIMITER ;

call esPalíndroma('hola');


-- 7. Sobre la base test cree un procedimiento que muestre la suma de los primeros n números enteros,
-- siendo n un parámetro de entrada.

DELIMITER //
drop procedure if exists sumaNumeros//
create procedure sumaNumeros(numero int) 
	begin
		declare i int;
        declare suma int ;
        set suma = 0;
        set i =0;
        while i<numero do
			set i=i+1;
            set suma=suma+i;
		end while;
        select suma;
		
	end//
DELIMITER ;

call sumaNumeros(4);

-- Ejercicio 8
-- Sobre la base de datos liga crea una función que devuelva 1si ganó el visitante y 0 en caso contrario.
-- El parámetro de entrada es el resultado con el formato „xxx-xxx‟.

DELIMITER //
drop function if exists partido//
create function partido(res varchar(45)) 
returns int
	begin
	declare locale int;
    declare visitante int;
    declare result int;
    set locale = cast(substring_index(res,'-',1) as signed);
    set visitante = cast(substring_index(res,'-',-1)as signed);
	if visitante > locale then
		set result = 1;
	end if;
	if visitante < locale then
		set result = 0;  
	end if;
    return result;
	end//
DELIMITER ;
 
set @resu= partido('5-4');
select @resu as Resultado;
