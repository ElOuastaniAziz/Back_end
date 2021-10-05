-- ******************** Abdelaziz *********************************************
create database test;
drop table libros;

create table libros(
titulo varchar(40),
autor varchar(30),
editorial varchar(20),
precio numeric(5,2)
);

insert into libros values ('Uno','Richard Bach','Planeta',15);
insert into libros values ('Ilusiones','Richard Bach','Planeta',12);
insert into libros values ('El aleph','Borges','Emece',25);
insert into libros values ('Aprenda PHP','Mario Molina','Nuevo siglo',50);
insert into libros values ('Matematica estas ahi','Paenza','Nuevo siglo',18);
insert into libros values ('Puente al infinito','Bach Richard','Sudamericana',14);
insert into libros values ('Antología','J. L. Borges','Paidos',24);
insert into libros values ('Java en 10 minutos','Mario Molina','Siglo XXI',45);
insert into libros values ('Cervantes y el quijote','Borges- Casares','Planeta',34);

-- **************************************** EJERCICIOS *********************************

-- 1 Creamos un procedimiento que recibe el nombre de una editorial y luego aumenta en un 10% los precios de los libros de tal editorial

DELIMITER //
drop procedure if exists test.aumentaPercio//
CREATE PROCEDURE test.aumentaPrecio(editorial1 varchar(20))
	begin
		
		update test.libros set test.libros.precio= (test.libros.precio+test.libros.precio*0.10) where test.libros.editorial like  editorial1;
		
	end//
DELIMITER ;

call aumentaPrecio('Planeta');
SELECT * FROM LIBROS;

drop procedure aumentaPrecio;

-- 2. Creamos otro procedimiento que recibe 2 parámetros, el nombre de una editorial y el valor de incremento (que tiene por defecto el valor 10)

DELIMITER //
drop procedure if exists test.actualizarPrecio//
CREATE PROCEDURE test.actualizarPrecio(nomEditorial varchar(45),numIncremento int )
	begin
		declare num int default 10;
		  update  test.libros set test.libros.precio=test.libros.precio+num where test.libros.editorial like nomEditorial;
	end//
DELIMITER ;

call actualizarPrecio('Emece',0);
select * from libros;

-- 3. Definimos un procedimiento almacenado que ingrese un nuevo libro en la tabla "libros"

DELIMITER //
drop procedure if exists test.crearLibro//
CREATE PROCEDURE test.crearLibro(title varchar(40),autor1 varchar(30),editorial1 varchar(20), price numeric)
	begin
		  	insert into test.libros values(title,autor1,editorial1,price);
	end//
DELIMITER ;

call crearLibro('Kotlin','Jet','JeatBrains',35);
select * from libros;




SET SQL_SAFE_UPDATES=0;
