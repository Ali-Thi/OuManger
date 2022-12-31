DROP TRIGGER IF EXISTS note_restaurant_insert;
DROP TRIGGER IF EXISTS note_restaurant_update;
DROP TRIGGER IF EXISTS note_restaurant_delete;

CREATE TRIGGER note_restaurant_insert
AFTER INSERT ON commentaires
FOR EACH ROW
UPDATE Restaurant
SET Note=(SELECT (SUM(Note)+NEW.Note)/COUNT(Note) FROM commentaires WHERE IdResto=NEW.IdResto GROUP BY IdResto)
WHERE IdResto=NEW.IdResto;

CREATE TRIGGER note_restaurant_update
AFTER UPDATE ON commentaires
FOR EACH ROW
UPDATE Restaurant
SET Note=(SELECT (SUM(Note)+NEW.Note)/COUNT(Note) FROM commentaires WHERE IdResto=NEW.IdResto GROUP BY IdResto)
WHERE IdResto=NEW.IdResto;

CREATE TRIGGER note_restaurant_delete
AFTER DELETE ON commentaires
FOR EACH ROW
UPDATE Restaurant
SET Note=(SELECT (SUM(Note)-OLD.Note)/COUNT(Note)-1 FROM commentaires WHERE IdResto=OLD.IdResto GROUP BY IdResto)
WHERE IdResto=OLD.IdResto;


CREATE TRIGGER note_restaurant_delete AFTER DELETE ON commentaires FOR EACH ROW UPDATE Restaurant SET Note=(SELECT (SUM(Note)-SUM(OLD.Note))/(COUNT(Note)-COUNT(OLD.Note)) FROM commentaires WHERE IdResto=OLD.IdResto GROUP BY IdResto) WHERE IdResto=OLD.IdResto;