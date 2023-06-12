SELECT * FROM neoga.post;

select p.*, pg.genero_id, g.nombre as nombreGenero, pp.plataformas_id, pl.nombre as nombrePlataforma from post p 
	inner join post_has_genero pg on pg.post_id = p.id
    inner join post_has_plataformas pp on pp.post_id = p.id
    inner join genero g on g.id = pg.genero_id
    inner join plataformas pl on pl.id = pp.plataformas_id
    where p.id = 11;
    
select g.id, g.nombre from genero g 
inner join post_has_genero pg on pg.genero_id =  g.id
inner join post p on p.id = pg.post_id
where p.id = 13;

select pl.id, pl.nombre from plataformas pl
inner join post_has_plataformas pp on pp.plataformas_id =  pl.id
inner join post p on p.id = pp.post_id
where p.id = 14; 

select g.id, g.nombre from post p
inner join post_has_genero pg on pg.post_id = p.id
inner join genero g on g.id = pg.genero_id;

select pg.post_id, g.nombre as generoNombre, pg.genero_id from post_has_genero pg
inner join genero g on g.id = pg.genero_id;

select * from post where titulo like ("%%") or month(lanzamiento) = 06;
 
 
