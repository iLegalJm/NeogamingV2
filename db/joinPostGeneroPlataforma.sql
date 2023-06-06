SELECT * FROM neog.post;

select p.*, pg.genero_id, g.nombre as nombreGenero, pp.plataformas_id, pl.nombre as nombrePlataforma from post p 
	inner join post_has_genero pg on pg.post_id = p.id
    inner join post_has_plataformas pp on pp.post_id = p.id
    inner join genero g on g.id = pg.genero_id
    inner join plataformas pl on pl.id = pp.plataformas_id
    where p.id = 8;
