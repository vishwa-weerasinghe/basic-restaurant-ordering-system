create table food_items(
    food_id int auto_increment primary key,
    name varchar(25) not null,
    category varchar(50),
    price decimal(10, 2) not null
);

INSERT INTO food_items(name, category, price) VALUES
('Cheeseburger', 'Main', 900),
('Margherita Pizza', 'Main', 1200),
('Caesar Salad', 'Starter', 725),
('Chocolate Brownie', 'Dessert', 400),
('Iced Latte', 'Drink', 400);

create table cart(
    order_id int auto_increment primary key,
    food_id int,
    quantity int,
    subtotal decimal(10, 2),
    foreign key (food_id) references food_items(food_id)
);