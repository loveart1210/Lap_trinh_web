-- Tạo database
-- CREATE DATABASE book_management;
-- USE book_management;

-- Bảng Authors
-- CREATE TABLE Authors (
--     Author_id INT(11) PRIMARY KEY,
--     Author_name VARCHAR(100) NOT NULL
-- );

-- Bảng Publishers
-- CREATE TABLE Publishers (
--     Publisher_id INT(11) PRIMARY KEY,
--     Publisher_name VARCHAR(100) NOT NULL
-- );

-- Bảng Books
-- CREATE TABLE Books (
--     Book_id INT(11) PRIMARY KEY,
--     Title VARCHAR(200) NOT NULL,
--     Author_id INT(11),
--     Publisher_id INT(11),
--     Publication_year INT(11),
--     CONSTRAINT fk_author FOREIGN KEY (Author_id) REFERENCES Authors(Author_id),
--     CONSTRAINT fk_publisher FOREIGN KEY (Publisher_id) REFERENCES Publishers(Publisher_id)
-- );

-- Thêm dữ liệu vào Authors
-- INSERT INTO Authors (Author_id, Author_name) VALUES
-- (1, 'J.K.Rowling'),
-- (2, 'Harper Lee'),
-- (3, 'George Orwell'),
-- (4, 'Jane Austen'),
-- (5, 'F. Scott Fitzgerald');

-- Thêm dữ liệu vào Publishers
-- INSERT INTO Publishers (Publisher_id, Publisher_name) VALUES
-- (1, 'Publisher A'),
-- (2, 'Publisher B'),
-- (3, 'Publisher C'),
-- (4, 'Publisher D'),
-- (5, 'Publisher E');

-- Thêm dữ liệu vào Books
-- INSERT INTO Books (Book_id, Title, Author_id, Publisher_id, Publication_year) VALUES
-- (1, 'Harry Potter and the Sorcerer''s Stone', 1, 1, 1997),
-- (2, 'To Kill a Mockingbird', 2, 2, 1960),
-- (3, '1984', 3, 3, 1949),
-- (4, 'Pride and Prejudice', 4, 4, 1813),
-- (5, 'The Great Gatsby', 5, 5, 1925);

-- 1. Lấy danh sách thông tin tất cả cuốn sách
SELECT * FROM Books;

-- 2. Lấy danh sách thông tin tất cả tác giả
SELECT * FROM Authors;

-- 3. Lấy thông tin cuốn sách 1984
SELECT * FROM Books WHERE Title = '1984';

-- 4. Lấy danh sách cuốn sách của tác giả Harper Lee
SELECT b.Title, a.Author_name
FROM Books b
JOIN Authors a ON b.Author_id = a.Author_id
WHERE a.Author_name = 'Harper Lee';

-- 5. Lấy danh sách cuốn sách của nhà xuất bản D
SELECT b.Title, p.Publisher_name
FROM Books b
JOIN Publishers p ON b.Publisher_id = p.Publisher_id
WHERE p.Publisher_name = 'Publisher D';

-- 6. Lấy tên tác giả của cuốn sách Pride and Prejudice
SELECT a.Author_name
FROM Books b
JOIN Authors a ON b.Author_id = a.Author_id
WHERE b.Title = 'Pride and Prejudice';

-- 7. Lấy tên cuốn sách và năm xuất bản của cuốn sách có nhà xuất bản là "Publisher A"
SELECT b.Title, b.Publication_year
FROM Books b
JOIN Publishers p ON b.Publisher_id = p.Publisher_id
WHERE p.Publisher_name = 'Publisher A';

-- 8. Lấy danh sách cuốn sách có năm xuất bản sau 1950
SELECT Title, Publication_year
FROM Books
WHERE Publication_year > 1950;

-- 9. Lấy số lượng cuốn sách thuộc mỗi nhà xuất bản
SELECT p.Publisher_name, COUNT(b.Book_id) AS total_books
FROM Publishers p
LEFT JOIN Books b ON p.Publisher_id = b.Publisher_id
GROUP BY p.Publisher_id, p.Publisher_name;

-- 10. Lấy số lượng cuốn sách của mỗi tác giả và sắp xếp theo số lượng giảm dần
SELECT a.Author_name, COUNT(b.Book_id) AS total_books
FROM Authors a
LEFT JOIN Books b ON a.Author_id = b.Author_id
GROUP BY a.Author_id, a.Author_name
ORDER BY total_books DESC;

-- 11. Lấy tên tác giả và tổng số cuốn sách của mỗi tác giả có năm xuất bản sau 1900
SELECT a.Author_name, COUNT(b.Book_id) AS total_books
FROM Authors a
JOIN Books b ON a.Author_id = b.Author_id
WHERE b.Publication_year > 1900
GROUP BY a.Author_name;

-- 12. Lấy danh sách cuốn sách và tên nhà xuất bản của cuốn sách có tên bắt đầu bằng "The Great"
SELECT b.Title, p.Publisher_name
FROM Books b
JOIN Publishers p ON b.Publisher_id = p.Publisher_id
WHERE b.Title LIKE 'The Great%';

-- 13. Lấy tên cuốn sách và tên tác giả của cuốn sách có năm xuất bản sau 1950
SELECT b.Title, a.Author_name
FROM Books b
JOIN Authors a ON b.Author_id = a.Author_id
WHERE b.Publication_year > 1950;

-- 14. Lấy tên cuốn sách và tên nhà xuất bản của cuốn sách có tên kết thúc bằng "Mockingbird"
SELECT b.Title, p.Publisher_name
FROM Books b
JOIN Publishers p ON b.Publisher_id = p.Publisher_id
WHERE b.Title LIKE '%Mockingbird';

-- 15. Lấy danh sách cuốn sách và tên tác giả của cuốn sách có năm xuất bản sau 2000
SELECT b.Title, a.Author_name
FROM Books b
JOIN Authors a ON b.Author_id = a.Author_id
WHERE b.Publication_year > 2000;
