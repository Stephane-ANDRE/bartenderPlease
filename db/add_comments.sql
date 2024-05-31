USE `partage_de_recettes`;

-- Create the `comments` table if it doesn't exist
CREATE TABLE IF NOT EXISTS `comments` (
    -- `comment_id` is the primary key, automatically incrementing
    `comment_id` int(11) NOT NULL AUTO_INCREMENT,
    
    -- `user_id` is a foreign key linking to the `users` table
    `user_id` int(11) NOT NULL,
    
    -- `recipe_id` is a foreign key linking to the `recipes` table
    `recipe_id` int(11) NOT NULL,
    
    -- `comment` is a long text field for storing the comment content
    `comment` longtext NOT NULL,
    
    -- Define `comment_id` as the primary key
    PRIMARY KEY (`comment_id`),
    
    -- Index for the `user_id` column to speed up lookups
    KEY `IDX_5F9E962A9D86650F` (`user_id`),
    
    -- Index for the `recipe_id` column to speed up lookups
    KEY `IDX_5F9E962A69574A48` (`recipe_id`),
    
    -- Define a foreign key constraint for `recipe_id` referencing the `recipe_id` in the `recipes` table
    -- When a recipe is deleted, all related comments will also be deleted (ON DELETE CASCADE)
    CONSTRAINT `FK_5F9E962A69574A48` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE,
    
    -- Define a foreign key constraint for `user_id` referencing the `user_id` in the `users` table
    CONSTRAINT `FK_5F9E962A9D86650F` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
