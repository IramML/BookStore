CREATE TABLE IF NOT EXISTS admin_user(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    email varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    password varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
)ENGINE=InnoDB CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS client_user(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    last_name varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    email varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    password varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
)ENGINE=InnoDB CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS client_user_token(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    access_token varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES client_user(id) ON DELETE CASCADE
)ENGINE=InnoDB CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS book_category(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    is_archived boolean NOT NULL
)ENGINE=InnoDB CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS book(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    author varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    editorial varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    num_pages varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    description text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    cost double NOT NULL,
    stock int NOT NULL,
    is_archived boolean NOT NULL,
    pdf varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    image varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    category_id int NULL,
    FOREIGN KEY (category_id) REFERENCES book_category(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS client_user_domicile(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    postal_code int NOT NULL,
    country varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    state varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    city varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    street varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    outdoor_number varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    is_archived boolean NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES client_user(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS client_user_order(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    is_pdf boolean NOT NULL,
    datetime timestamp NOT NULL,
    user_id int NOT NULL,
    domicile_id int NULL,
    book_id int NULL,
    FOREIGN KEY (user_id) REFERENCES client_user(id) ON DELETE CASCADE,
    FOREIGN KEY (domicile_id) REFERENCES client_user_domicile(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (book_id) REFERENCES book(id) ON DELETE SET NULL ON UPDATE CASCADE
);