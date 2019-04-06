-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );

--Users Table
CREATE TABLE users (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

-- Sessions Table
CREATE TABLE sessions (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	session TEXT NOT NULL UNIQUE
);

--Images Table
CREATE TABLE images (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    user_id INTEGER,
    file_name TEXT NOT NULL,
    file_ext TEXT NOT NULL,
    recipe_name TEXT NOT NULL,
    source TEXT
);

--Tags Table
CREATE TABLE 'tags' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'tag' TEXT NOT NULL UNIQUE
);

--Image tags Table
CREATE TABLE 'image_tags' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'image_id' INTEGER NOT NULL,
    'tag_id' INTEGER NOT NULL
);

-- TODO: initial seed data
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (1, NULL,'1.jpg', 'jpg', 'Overnight Oats',"https://i1.wp.com/kristineskitchenblog.com/wp-content/uploads/2016/06/our-favorite-overnight-oats-1200-8231.jpg?resize=600%2C900&ssl=1");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (2, NULL, '2.jpg', 'jpg', 'Egg Muffins',"https://www.creativehealthyfamily.com/wp-content/uploads/2016/11/easy-breezy-super-healthy-breakfast-egg-muffins-2.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (3, NULL,'3.jpg', 'jpg', 'Chocolate Almond Butter Granola Bars',"https://www.iheartnaptime.net/wp-content/uploads/2016/01/IHeartNaptime_GranolaBars-1200x857.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (4, NULL,'4.jpg', 'jpg', 'Three Ingredient Banana Pancakes',"https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (5, NULL, '5.jpg', 'jpg', 'Turkey Ranch Wrap',"https://life-in-the-lofthouse.com/wp-content/uploads/2015/07/Turkey_Ranch_Wraps2-1024x718.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (6, NULL,'6.jpg', 'jpg', '16 Salad in a Jar Recipes',"https://cdn.tipjunkie.com/wp-content/uploads/cache/0c/43/0c4357b7c8f295b96a653f9ce4a42b46.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (7, NULL,'7.jpg', 'jpg', 'Thai Chicken Bowl',"https://sweetpeasandsaffron.com/wp-content/uploads/2015/11/Peanut-Lime-Chicken-Lunch-Bowls-4-600x1067.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (8, NULL,'8.jpg','jpg', 'Sheet Pan Roasted Sausage & Potatoes With Peppers',"https://joyfoodsunshine.com/wp-content/uploads/2017/03/Sheet-Pan-Roasted-Potatoes-Sausage-Peppers-recipe-gluten-free-paleo-3.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (9, NULL,'9.jpg', 'jpg', 'Margherita Flatbread Pizza',"https://i1.wp.com/letthebakingbegin.com/wp-content/uploads/2015/01/MargheritaFlatbreadPizzaCaprese_2.jpg?resize=600%2C901&ssl=1");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (10, NULL,'10.jpg', 'jpg', 'Vegetable Lo Mein',"https://pinchofyum.com/wp-content/uploads/Lo-Mein-1-2-600x900.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (11, NULL,'11.jpg', 'jpg', 'Lemon & Basil Baked Salmon',"https://www.evolvingtable.com/wp-content/uploads/2017/06/Lemon-Basil-Salmon.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (12, NULL,'12.jpg', 'jpg', 'No Bake Chocolate Chip Blondies',"https://www.laurafuentes.com/wp-content/uploads/2017/03/Healthy_Blondies_low_8.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (13, NULL,'13.jpg', 'jpg', 'Peanut Butter Enery Bites',"https://chefsavvy.com/wp-content/uploads/energy-protein-peanut-butter-flax-bites.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (14, NULL,'14.jpg', 'jpg', 'Strawberry Yogurt Bark',"https://www.hellowonderful.co/ckfinder/userfiles/images/3-strawberry-yogurt-bark.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (15, NULL,'15.jpg', 'jpg', 'Chocolate Banana Cookies',"https://tipbuzz.com/wp-content/uploads/cookies1.jpg");
INSERT INTO images (id, user_id, file_name, file_ext, recipe_name, source) VALUES (16, NULL, '16.jpg', 'jpg', 'Banana Bread', "https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg");


INSERT INTO `tags` (id,tag) VALUES (1, 'breakfast');
INSERT INTO `tags` (id,tag) VALUES (2, 'lunch');
INSERT INTO `tags` (id,tag) VALUES (3, 'dinner');
INSERT INTO `tags` (id,tag) VALUES (4, 'snacks');
INSERT INTO `tags` (id,tag) VALUES (5, 'user_uploaded');
INSERT INTO 'tags' (id,tag) VALUES (6, '15mins');

INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (1, 1, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (2, 1, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (3, 2, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (4, 3, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (5, 4, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (6, 4, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (7, 5, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (8, 6, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (9, 6, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (10, 7, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (11, 8, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (12, 9, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (13, 9, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (14, 10, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (15, 10, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (16, 11, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (17, 12, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (18, 13, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (19, 13, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (20, 14, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (21, 14, 6);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (22, 15, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (23, 16, 4);


-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!
INSERT INTO users (id,username,password) VALUES (1, 'user1', '$2y$10$BAJ3Zglrt49eztL4l1LlUeG0k75zi4J2JTtrjognFyiD8RYR1Yb0K'); --password: user1
INSERT INTO users (id,username,password) VALUES (2, 'user2', '$2y$10$h5SXw2BWV6Lp25HRrWrjruktNQaHjhkwTWYyatRK9XSV4ZOsglsCC'); --password: user2

-- INSERT INTO `examples` (id,name) VALUES (1, 'example-1');
-- INSERT INTO `examples` (id,name) VALUES (2, 'example-2');

COMMIT;
