-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );

CREATE TABLE 'users' (
'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
"username" TEXT NOT NULL UNIQUE,
"password" TEXT NOT NULL UNIQUE
)

CREATE TABLE images (
"id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
"file_name" TEXT NOT NULL UNIQUE,
"recipe_name" TEXT NOT NULL UNIQUE,
"source" TEXT NOT NULL UNIQUE
)

CREATE TABLE tags (
'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
"tag" TEXT NOT NULL UNIQUE
)

CREATE TABLE image_tags (
'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
"image_id" TEXT NOT NULL UNIQUE,
"tag_id" TEXT NOT NULL UNIQUE
)

-- TODO: initial seed data
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (1, 'uploads/images/1.jpg', 'Overnight Oats',"https://i1.wp.com/kristineskitchenblog.com/wp-content/uploads/2016/06/our-favorite-overnight-oats-1200-8231.jpg?resize=600%2C900&ssl=1");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (2, 'uploads/images/2.jpg', 'Egg Muffins',"https://www.creativehealthyfamily.com/wp-content/uploads/2016/11/easy-breezy-super-healthy-breakfast-egg-muffins-2.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (3, 'uploads/images/3.jpg', 'Chocolate Almond Butter Granola Bars',"https://www.iheartnaptime.net/wp-content/uploads/2016/01/IHeartNaptime_GranolaBars-1200x857.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (4, 'uploads/images/4.jpg', 'Three Ingredient Banana Pancakes',"https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (5, 'uploads/images/5.jpg', 'Turkey Ranch Wrap',"https://life-in-the-lofthouse.com/wp-content/uploads/2015/07/Turkey_Ranch_Wraps2-1024x718.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (6, 'uploads/images/6.jpg', '16 Salad in a Jar Recipes',"https://cdn.tipjunkie.com/wp-content/uploads/cache/0c/43/0c4357b7c8f295b96a653f9ce4a42b46.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (7, 'uploads/images/7.jpg', 'Thai Chicken Bowl',"https://sweetpeasandsaffron.com/wp-content/uploads/2015/11/Peanut-Lime-Chicken-Lunch-Bowls-4-600x1067.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (8, 'uploads/images/8.jpg', 'Sheet Pan Roasted Sausage & Potatoes With Peppers',"https://joyfoodsunshine.com/wp-content/uploads/2017/03/Sheet-Pan-Roasted-Potatoes-Sausage-Peppers-recipe-gluten-free-paleo-3.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (9, 'uploads/images/9.jpg', 'Margherita Flatbread Pizza',"https://i1.wp.com/letthebakingbegin.com/wp-content/uploads/2015/01/MargheritaFlatbreadPizzaCaprese_2.jpg?resize=600%2C901&ssl=1");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (10, 'uploads/images/10.jpg', 'Vegetable Lo Mein',"https://pinchofyum.com/wp-content/uploads/Lo-Mein-1-2-600x900.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (11, 'uploads/images/11.jpg', ' Lemon & Basil Baked Salmon',"https://www.evolvingtable.com/wp-content/uploads/2017/06/Lemon-Basil-Salmon.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (12, 'uploads/images/12.jpg', 'No Bake Chocolate Chip Blondies',"https://www.laurafuentes.com/wp-content/uploads/2017/03/Healthy_Blondies_low_8.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (13, 'uploads/images/13.jpg', 'Peanut Butter Enery Bites',"https://chefsavvy.com/wp-content/uploads/energy-protein-peanut-butter-flax-bites.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (14, 'uploads/images/14.jpg', 'Strawberry Yogurt Bark',"https://www.hellowonderful.co/ckfinder/userfiles/images/3-strawberry-yogurt-bark.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (15, 'uploads/images/15.jpg', 'Chocolate Banana Cookies',"https://tipbuzz.com/wp-content/uploads/cookies1.jpg");
INSERT INTO `images` (id,file_name,recipe_name,source) VALUES (16, 'uploads/images/16.jpg', 'Banana Bread', "https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg");


INSERT INTO `tags` (id,tag) VALUES (1, 'breakfast');
INSERT INTO `tags` (id,tag) VALUES (2, 'lunch');
INSERT INTO `tags` (id,tag) VALUES (3, 'dinner');
INSERT INTO `tags` (id,tag) VALUES (4, 'snacks');
INSERT INTO `tags` (id,tag) VALUES (5, 'user_uploaded');

INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (1, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (2, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (3, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (4, 1);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (5, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (6, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (7, 2);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (8, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (9, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (10, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (11, 3);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (12, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (13, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (14, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (15, 4);
INSERT INTO `image_tags` (id,image_id,tag_id) VALUES (16, 4);



-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!
    -- username: user1, password: user1
    -- username: user2, password: user2
INSERT INTO `users` (id,username,password) VALUES (1, 'user1', 'user1');
INSERT INTO `users` (id,username,password) VALUES (2, 'user2', 'user2');

-- INSERT INTO `examples` (id,name) VALUES (1, 'example-1');
-- INSERT INTO `examples` (id,name) VALUES (2, 'example-2');

COMMIT;
