-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `partage_de_recettes`;
USE `partage_de_recettes`;

-- Create the `recipes` table
CREATE TABLE IF NOT EXISTS `recipes` (
    `recipe_id` int(11) NOT NULL AUTO_INCREMENT,  -- Primary key, auto-incremented
    `title` varchar(128) NOT NULL,  -- Recipe title
    `recipe` TEXT NOT NULL,  -- Recipe description
    `author` varchar(255) NOT NULL,  -- Author's email
    `is_enabled` BOOLEAN NOT NULL,  -- Recipe status (enabled/disabled)
    PRIMARY KEY (`recipe_id`)  -- Define `recipe_id` as the primary key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the `users` table
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,  -- Primary key, auto-incremented
    `full_name` varchar(64) NOT NULL,  -- Full name of the user
    `email` varchar(255) NOT NULL,  -- Email address of the user
    `password` varchar(255) NOT NULL,  -- User's password
    `age` INT NOT NULL,  -- User's age
    PRIMARY KEY (`user_id`)  -- Define `user_id` as the primary key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Delete all entries from `users` table
DELETE FROM `users`;

-- Insert sample data into the `users` table
INSERT INTO `users` (`age`, `email`, `full_name`, `password`, `user_id`) VALUES (34, "james.bond@exemple.com", "James Bond", "SuperCocktail9+", 1);
INSERT INTO `users` (`age`, `email`, `full_name`, `password`, `user_id`) VALUES (34, "donato.antone@exemple.com", "Donato Antone", "SuperCocktail9+", 2);
INSERT INTO `users` (`age`, `email`, `full_name`, `password`, `user_id`) VALUES (28, "jerry.thomas@exemple.com", "Jerry Thomas", "SuperCocktail9+", 3);
INSERT INTO `users` (`age`, `email`, `full_name`, `password`, `user_id`) VALUES (45, "martin.morgan@exemple.com", "John Martin & Jack Morgan", "SuperCocktail9+", 4);

-- Delete all entries from `recipes` table
DELETE FROM `recipes`;

-- Insert sample data into the `recipes` table
INSERT INTO `recipes` (`author`, `is_enabled`, `recipe`, `recipe_id`, `title`) VALUES ("james.bond@exemple.com", 1, "This cocktail was invented by secret agent James Bond 007 in his first spy novel Casino Royale by Ian Fleming in 1953. In a champagne flute, mix 3 measures of Gordon's gin, 1 measure of vodka, and 1/2 measure of Kina Lillet.", 1, "Vesper");
INSERT INTO `recipes` (`author`, `is_enabled`, `recipe`, `recipe_id`, `title`) VALUES ("donato.antone@exemple.com", 1, "The Godfather, also known as the Parrain in French, is an essential cocktail but often unknown to novices. This drink, based on whisky and Amaretto (an Italian almond liqueur), was created in 1954 by Donato Antone, a double world champion mixologist.", 2, "Godfather");
INSERT INTO `recipes` (`author`, `is_enabled`, `recipe`, `recipe_id`, `title`) VALUES ("jerry.thomas@exemple.com", 1, "The first publication about the Whisky Sour dates back to the 1860s, attributed to master shaker Jerry Thomas, the Yoda of cocktails. Alcohol and citrus juice mixtures were invented somewhere at sea long before this period.", 4, "Whisky Sour");
INSERT INTO `recipes` (`author`, `is_enabled`, `recipe`, `recipe_id`, `title`) VALUES ("martin.morgan@exemple.com", 1, "The Moscow Mule is a cocktail made with vodka, lime juice, and ginger beer. This drink was invented in 1941 by John Martin & Jack Morgan at the Cock 'n' Bull bar in Los Angeles. The origin of this famous cocktail is tied to their desire to clear out some of their stock.", 3, "Moscow Mule");
