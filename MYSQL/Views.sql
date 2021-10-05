1. Crea una vista de nom clients_paul per tal de mostrar només els clients d‟en Paul Cruz.
create  view clients_paul as select clientes.empresa as empresa_cliente,repventas.nombre from clientes inner join repventas on clientes.REP_CLIE=repventas.NUM_EMPL where repventas.nombre like 'Paul Cruz'; 
SELECT * FROM clients_paul;
2. Crea una vista de nom directius, on surti tota la información dels repventas que són directors.
create view directius  as select * from repventas where repventas.director is not null;
select * from directius;
3. Crea una vista de nom venedors on només surtin els 6 primers atributs (llevem la
información económica.
create or replace view vendedores as select repventas.num_empl, nombre, edad, oficina_rep, titulo, contrato from repventas;
select * from vendedores;
4. Crea una vista de nom venedors_ofi on surtin les dades de cada venedor complementades amb
les de l‟oficina on treballen. Cal que surtin tots els venedors (tinguin o no oficina).
create or replace view venderdores_ofi  as select * from vendedores inner join oficinas on oficinas.oficina=vendedores.oficina_rep;
select * from venderdores_ofi;


INSERT INTO clients_paul(empresa_cliente,nombre) values('TCP','Juan Ramus');

Exercicis 3. (damunt de la base de dades 3).
1. Crea una vista de Autores que la media de las páginas de sus libros es superior a 150
create view Autores as select idautor, avg(paginas) as numpag from libro group by idautor having numpag > 150; 
2. Crea una vista de Autores que la media de las páginas de sus libros es superior a 150,
create or replace view Autores as select idautor, avg(paginas) as numpag from libro  inner join formato on libro.tformato=formato.idfor where formato.tipo like '%Bolsillo' group by idautor having numpag > 150 ; 
solo teniendo en cuenta (para la media) aquellos libros que son de Bolsillo

3. Crea una vista de libros que se hayan escrito en 2018 y sean de Tapa Dura
create view libros as select libro.id from libro inner join formato on libro.tformato=formato.idfor  where  year(añoPublicacion)=2018 and formato.tipo LIKE 'TAPA DURA';

Exercicis 4. (damunt de la base de dades 4).
1. Crear una vista de persona de todas las personas que sus apellidos empiezan por P, R o S y contienen una A.
create or replace view personas as select * from persona where apellido1  like 'P%a%' or apellido1 like 'R%a%'  or apellido1  like 'S%a%';
select * from personas;
insert into personas(id,nombre,apellido1, apellido2, sexo, telefono, vip, fechanac) values(2224, 'Juan','sua','nores','M','654234789','0','2000-10-23');

2. Crear una vista de todas las personas que han viajado desde Barcelona en el último año.
create or replace view vista as select persona.id,count(persona.id)from persona inner join viaje on persona.id=viaje.idp inner join ciudad on viaje.ciudadOrigen=ciudad.idCiudad where ciudad.descCiudad like 'BARCELONA' order by year(fechaVuelta) desc;
select * from vista;
3. Crear una vista de todos los pasajeros residentes.
create  view vista2 as select * from persona inner join viaje on persona.id=viaje.idp where viaje.residente=1; 
select * from vista2;




Exercici 5. (damunt de la base de dades 4).
Intenta insertar un registre a cada una de les vistes anteriors. Que passa? Que passa a les taules a les
que están lligades?
La seguiente vista  me dejado  porque la vista pertenece a una unica tabla
insert into personas(id,nombre,apellido1, apellido2, sexo, telefono, vip, fechanac) values(2224, 'Juan','sua','nores','M','654234789','0','2000-10-23');
pero las que estan ligadas(innerJoin ) do dejas hacer inseciones.
Modifica també un registre i finalment elimina el registre insertar o bé un altre si
no has pogut insertar cap. Que passa a les taules vinculades?
Me ha dejado modificar un registro de  la vista personas ya que es de la misma tabla.
update  personas set id=2323 where id=6; 
delete from personas where id=2323;



