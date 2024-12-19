create table bookUser(
    userId int PRIMARY key,
    avatar VARCHAR(100),
    userEmail VARCHAR(50),
    userPass VARCHAR(30),
    joinDay INT,
    joinMonth INT,
    joinYear INT,
);
CREATE TABLE category (
    catId int PRIMARY KEY, 
    catName VARCHAR(10)
);
create table interestedIn (
    user_ID int,
    cat_Id int,
    PRIMARY KEY (user_ID,cat_Id),
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId),
    FOREIGN KEY (cat_Id) REFERENCES category(catId)
);
create TABLE fine(
    fineId int PRIMARY KEY, 
    fineAmount int, 
    fineStatus BINARY,
    user_ID INT
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId)
);
CREATE table contactNumbers (
    phoneNumber VARCHAR(20) PRIMARY key,
    user_ID int,
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId),
);
CREATE TABLE book(
    bookID int PRIMARY key,
    bookTitle VARCHAR(30),
    yearOfPublish int,
    authorFN VARCHAR(17),
    authorLN VARCHAR(17),
    bookLink VARCHAR(50),
    bookCover VARCHAR(50),
    bookDes VARCHAR(200),
);
create table belongsTo(
    cat_ID int,
    book_ID int,
    PRIMARY key (cat_Id, book_ID),
    FOREIGN KEY (cat_Id) REFERENCES category(catId),
    FOREIGN KEY (book_ID) REFERENCES book(bookID),
);
create table review(
    reviewId int PRIMARY key,
    reviewComment VARCHAR(200),
    reviewRating FLOAT,
    userID int,
    FOREIGN KEY (userID) REFERENCES bookUser(userId)
);
CREATE table bookAdmin(
    adminID int PRIMARY key,
    adminFN VARCHAR(17),
    adminLN VARCHAR(17),
    adminRole VARCHAR(20)
    );

create table editBook(
    book_Id int,
    admin_Id int,
    PRIMARY KEY (book_Id, admin_Id) ,
    FOREIGN KEY (admin_Id) REFERENCES bookAdmin(adminID) ,
    FOREIGN KEY (book_Id) REFERENCES book(bookID)
);
create table bookRate (
    book_Id int,
    review_Id int,
    PRIMARY KEY (book_Id, review_Id) ,
    FOREIGN KEY (review_Id) REFERENCES review(reviewId) ,
    FOREIGN KEY (book_Id) REFERENCES book(bookID)
);

create table addToFav(
    user_ID int,
    book_Id int,
    PRIMARY KEY (book_Id, user_ID) ,
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId),
    FOREIGN KEY (book_Id) REFERENCES book(bookID)
);
create table buy(
    user_ID int,
    book_Id int,
    PRIMARY KEY (book_Id, user_ID) ,
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId),
    FOREIGN KEY (book_Id) REFERENCES book(bookID)
);
create table borrow(
    user_ID int,
    book_Id int,
    ReturnStatus BINARY,
    PRIMARY KEY (book_Id, user_ID) ,
    FOREIGN KEY (user_ID) REFERENCES bookUser(userId),
    FOREIGN KEY (book_Id) REFERENCES book(bookID)
);
select * from bookUser, fine