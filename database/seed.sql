USE bookstore_crm;

INSERT INTO users
(name,email,password_hash,role)
VALUES
('Administrator','admin@example.com','123456','admin');

INSERT INTO customers (name, email, phone, address) VALUES
('Nguyễn Văn An', 'an1@example.com', '0901000001', 'Quận 1, TP.HCM'),
('Trần Minh Bình', 'binh2@example.com', '0901000002', 'Quận 3, TP.HCM'),
('Lê Quốc Cường', 'cuong3@example.com', '0901000003', 'Quận 7, TP.HCM'),
('Phạm Gia Dũng', 'dung4@example.com', '0901000004', 'Thủ Đức, TP.HCM'),
('Hoàng Hải Đức', 'duc5@example.com', '0901000005', 'Hà Nội'),
('Võ Minh Huy', 'huy6@example.com', '0901000006', 'Đà Nẵng'),
('Đặng Tuấn Kiệt', 'kiet7@example.com', '0901000007', 'Cần Thơ'),
('Bùi Thành Long', 'long8@example.com', '0901000008', 'Hải Phòng'),
('Ngô Quốc Nam', 'nam9@example.com', '0901000009', 'Huế'),
('Phan Hoài Phúc', 'phuc10@example.com', '0901000010', 'Biên Hòa');

INSERT INTO book_orders 
(order_code,customer_id,book_title,quantity,unit_price,total_amount,status) 
VALUES
('ORD202607040001', 1, 'Clean Code', 2, 299000.00, 598000.00, 'completed'),
('ORD202607040002', 2, 'The Pragmatic Programmer', 1, 349000.00, 349000.00, 'paid'),
('ORD202607040003', 3, 'Design Patterns', 3, 450000.00, 1350000.00, 'shipping'),
('ORD202607040004', 4, 'Refactoring', 1, 399000.00, 399000.00, 'pending'),
('ORD202607040005', 5, 'Domain-Driven Design', 2, 520000.00, 1040000.00, 'completed'),
('ORD202607040006', 6, 'Head First Java', 4, 280000.00, 1120000.00, 'completed'),
('ORD202607040007', 7, 'Laravel Up & Running', 2, 320000.00, 640000.00, 'cancelled'),
('ORD202607040008', 8, 'Effective Java', 1, 560000.00, 560000.00, 'paid'),
('ORD202607040009', 9, 'You Don''t Know JS Yet', 5, 180000.00, 900000.00, 'shipping'),
('ORD202607040010', 10, 'Introduction to Algorithms', 1, 890000.00, 890000.00, 'completed'),
('ORD202607040011', 4, 'Atomic Habits', 2, 245000.00, 490000.00, 'completed'),
('ORD202607040012', 9, 'The Psychology of Money', 1, 210000.00, 210000.00, 'paid'),
('ORD202607040013', 2, 'Deep Work', 3, 195000.00, 585000.00, 'shipping'),
('ORD202607040014', 7, 'The Clean Coder', 1, 320000.00, 320000.00, 'pending'),
('ORD202607040015', 1, 'Clean Architecture', 2, 415000.00, 830000.00, 'completed'),
('ORD202607040016', 10, 'Spring in Action', 1, 530000.00, 530000.00, 'cancelled'),
('ORD202607040017', 6, 'Code Complete', 2, 480000.00, 960000.00, 'completed'),
('ORD202607040018', 3, 'Head First Design Patterns', 1, 390000.00, 390000.00, 'shipping'),
('ORD202607040019', 8, 'Database System Concepts', 4, 275000.00, 1100000.00, 'paid'),
('ORD202607040020', 5, 'Computer Networks', 2, 340000.00, 680000.00, 'completed');

