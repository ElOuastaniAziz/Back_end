-- *****************************Ejercicio2 ****************************************************************************
1. Crear procedimiento que muestre la suma de los primeros n números enteros.
DELIMITER //
DROP procedure if exists suma//
create procedure suma(num int)
begin
	declare suma int;
    declare i int;
    set i =0;
    set suma =0;
	while i<=num do
		set suma =suma+i;
        set i= i+1;
	end while;
    select suma;
end//
DELIMITER ;

call suma(5); --  cuando la variable dentro de procedure no esta iniclializada  de vuelve un null

2.Crear procedimiento mostrando la suma de los términos 1/n con n entre 1 y m, es decir ½ + 1/3 …. Siendo m el parámetro.
DELIMITER //
DROP procedure if exists sumaDivisiones//
create procedure sumaDivisiones(num int)
begin
	declare suma float;
    declare dividir float;
    declare i int;
    set dividir = 0;
    set i =1;
    set suma =0;
	while i<=num do
		set dividir = 1/i;
		set suma =suma+dividir;
        set i= i+1;
        
	end while;
    select suma;
end//
DELIMITER ;

call sumaDivisiones(3);

3. Crear funciona para determinar si un número es primo devolviendo 0 o 1.
DELIMITER //
DROP function if exists test.esPrimo//
create function esPrimo(num int) returns int deterministic
begin
	declare i int;
    declare primo int ;
    set i =2;
    set primo =0;
    
    
   
	while i <= num/2 do 
		if (num%i=0)then 
			set primo =1;
		end if;
        set i=i+1;
	end while;
    return primo;
end//
DELIMITER ;

set @num = esPrimo(971);

select @num as numero;


4. Usando la función anterior creamos otra que calcule la suma de todos primeros m números primos empezando en el 1.
DELIMITER //
DROP function if exists sumaPrimos//
create function sumaPrimos(num int) returns int deterministic
begin
	declare contador int;
    declare suma int;
    set suma =0, contador =2;
	while contador <= num do 
		if (esPrimo(contador))=0 then
			set suma = suma+contador;
		end if;
	set contador = contador+1;
	end while;
    return suma;
end//
DELIMITER ;

set @num = sumaPrimos(13);

select @num as numero;


5. Crear un procedimiento para generar y almacenar en la tabla primos (id, numero) de la base de datos test los primeros números primos comprendido entre 1 y m con Control de Errores.
create table primos(
	id int primary key,
    numero int
);
DELIMITER //
DROP procedure if exists test.tablaPrimos//
create procedure test.tablaPrimos(num int)
begin
	declare contador int;
    declare i int;
    set i = 0;
	set contador =2;
    
	while contador <= num do 
		if (esPrimo(contador))=0 then
			insert into test.primos value(i,contador);
            set i = i+1;
		end if;
	set contador = contador+1;
	end while;
end//
DELIMITER ;

call  tablaPrimos(13);
select * from primos;




6. Crear un procedimiento para generar n registros aleatorios en la tabla movimientos de la base de datos ebanca. 
Cada registro deberá contener datos de clientes y cuentas existentes. La cantidad deberá estar entre 1 y 10000 y la fecha será la actual con Control de Errores.
DELIMITER //
DROP procedure if exists ebanca.generaRegistros//
create procedure ebanca.generaRegistros(num int)
begin
	declare contador int;
    declare i int;
    set i = 0;
	set contador =2;
    
	while contador <= num do 
		if (esPrimo(contador))=0 then
			insert into test.primos value(i,contador);
            set i = i+1;
		end if;
	set contador = contador+1;
   
	end while;
end//
DELIMITER ;

call  generaRegistross(13);
