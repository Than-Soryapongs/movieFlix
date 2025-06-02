use movieflix_db;

-- Genres
INSERT INTO genres (id, name, created_at, updated_at) VALUES
(1, 'Action', NOW(), NOW()),
(2, 'Drama', NOW(), NOW()),
(3, 'Comedy', NOW(), NOW());

-- Movies
INSERT INTO movies (id, title, description, release_date, duration, rating, created_at, updated_at) VALUES
(1, 'The Great Adventure', 'An epic action-packed journey.', '2023-05-01', 130, 'PG-13', NOW(), NOW()),
(2, 'Life and Laughs', 'A heartwarming comedy-drama about life.', '2022-11-15', 95, 'PG', NOW(), NOW());

-- Movie-Genre pivot
INSERT INTO movie_genre (movie_id, genre_id) VALUES
(1, 1), -- The Great Adventure = Action
(1, 2), -- The Great Adventure = Drama
(2, 2), -- Life and Laughs = Drama
(2, 3); -- Life and Laughs = Comedy

-- Actors
INSERT INTO actors (id, name, dob, bio, created_at, updated_at) VALUES
(1, 'John Smith', '1980-06-10', 'An award-winning actor.', NOW(), NOW()),
(2, 'Jane Doe', '1990-09-21', 'Known for comedy roles.', NOW(), NOW());

-- Movie-Actor pivot
INSERT INTO movie_actor (movie_id, actor_id, role) VALUES
(1, 1, 'Lead Hero'),
(1, 2, 'Supporting Role'),
(2, 2, 'Lead');

-- Directors
INSERT INTO directors (id, name, dob, bio, created_at, updated_at) VALUES
(1, 'Alice Johnson', '1975-02-14', 'Famous director of action movies.', NOW(), NOW());

-- Movie-Director pivot
INSERT INTO movie_director (movie_id, director_id) VALUES
(1, 1),
(2, 1);

-- Posters
INSERT INTO posters (id, movie_id, image_url, alt_text, created_at, updated_at) VALUES
(3, 1, 'posters/great_adventure.jpg', 'The Great Adventure Poster', NOW(), NOW()),
(4, 2, 'posters/life_and_laughs.jpg', 'Life and Laughs Poster', NOW(), NOW());

-- Trailers
INSERT INTO trailers (id, movie_id, youtube_url, title, created_at, updated_at) VALUES
(1, 1, 'https://www.youtube.com/watch?v=abcd1234', 'Official Trailer', NOW(), NOW()),
(2, 2, 'https://www.youtube.com/watch?v=wxyz5678', 'Trailer', NOW(), NOW());

-- Reviews
INSERT INTO reviews (id, movie_id, user_name, rating, comment, created_at, updated_at) VALUES
(1, 1, 'MovieFan123', 8, 'Amazing action sequences!', NOW(), NOW()),
(2, 2, 'ComedyLover', 7, 'Really made me laugh!', NOW(), NOW());
