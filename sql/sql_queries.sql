USE IMDB;
SELECT * FROM ACTORS
where first_name like '%(%';
SELECT * FROM ACTORS a WHERE a.first_name='Kevin';

SELECT COUNT(*) FROM ACTORS;

SELECT * FROM movies;

select * from roles;

/* FIRST DEGREE RELATION */
SELECT a.first_name, a.last_name, r.movie_id
FROM actors a, roles r
WHERE a.id=r.actor_id AND r.actor_id <> 22591 AND r.movie_id IN (SELECT r1.movie_id 
										 FROM roles r1
										 WHERE r1.actor_id=22591); 
                                         
SELECT DISTINCT m.name
FROM actors a, roles r, movies m
WHERE a.id=r.actor_id AND m.id=r.movie_id AND a.first_name='' AND a.last_name='' AND r.movie_id IN (SELECT r1.movie_id 
																									FROM roles r1
select * from movies;                                                                                        WHERE r1.actor_id=22591);
								
                                
select * from actors where first_name="Ivan (1)";

SELECT DISTINCT m.name
FROM actors a, roles r, movies m
WHERE a.id=r.actor_id AND m.id=r.movie_id AND a.id=36005 AND r.movie_id IN (SELECT r1.movie_id 
																									FROM roles r1
                                                                                                    WHERE r1.actor_id=22591);
                                                                                                    
                                                                                                    
SELECT 
    total_movie, genre
FROM
    (SELECT 
        genre, COUNT(*) AS total_movie
    FROM
        movies_genres
    GROUP BY genre) AS max_genre
ORDER BY total_movie DESC
LIMIT 2; 

SELECT DISTINCT a.first_name, a.last_name
FROM actors a, directors d
WHERE a.first_name=d.first_name AND a.last_name=d.last_name;

SELECT DISTINCT a.first_name, a.last_name
FROM actors a, roles r, movies_genres mg
WHERE a.id=r.actor_id AND r.movie_id=mg.movie_id AND film_count = (SELECT MAX(film_count) FROM actors a1, roles r1, movies_genres mg1
WHERE a1.id=r1.actor_id AND r1.movie_id=mg1.movie_id AND mg1.genre='Crime');