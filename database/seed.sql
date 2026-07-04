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
