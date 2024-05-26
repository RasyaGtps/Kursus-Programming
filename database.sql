-- Membuat database
CREATE DATABASE kursus;


-- Membuat tabel pengguna
CREATE TABLE pengguna (
    id_pengguna INT PRIMARY KEY,
    nama VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(50),
    alamat VARCHAR(255),
    email VARCHAR(255),
    login_time TIMESTAMP
);

-- Membuat tabel kursus
CREATE TABLE kursus (
    id_kursus INT PRIMARY KEY,
    nama_kursus VARCHAR(255),
    deskripsi_kursus VARCHAR(50),
    durasi_kursus INT,
    biaya_kursus DECIMAL(10, 2)
);

-- Membuat tabel peserta
CREATE TABLE peserta (
    nomor_telepon INT PRIMARY KEY,
    nama_pengguna VARCHAR(255),
    id_pengguna INT,
    id_kursus INT,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
    FOREIGN KEY (id_kursus) REFERENCES kursus(id_kursus)
);

-- Membuat tabel video
CREATE TABLE video (
    id_video INT PRIMARY KEY,
    id_kursus INT,
    judul_video VARCHAR(255),
    deskripsi_video TEXT,
    link_video VARCHAR(255),
    FOREIGN KEY (id_kursus) REFERENCES kursus(id_kursus)
);
CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    nomor_telepon INT,  
    FOREIGN KEY (nomor_telepon) REFERENCES peserta(nomor_telepon),
    FOREIGN KEY (id_kursus) REFERENCES kursus(id_kursus)
);


USE kursus;

INSERT INTO pengguna (`id_pengguna`, `nama`, `username`, `password`, `role`, `alamat`, `email`, `login_time`) VALUES
(21, '89', 'ray', '31', 'admin', '31', '31', '2024-04-26 03:31:09'),
(56, 'peju', 'dasdas', '123', 'user', 'dsadsad', 'rasya23darkness@gmail.com', '2024-03-28 03:03:43'),
(138, '3131', '665', '55', 'user', '55', '55@gmail.com', '2024-04-22 04:02:20'),
(578, 'tes', 'tes', 'tes', 'peserta', 'tes', 'tes@gmail.com', '2024-03-28 03:28:13'),
(607, '2131', '212131', '31', 'peserta', '21', '2121@gmail.com', '2024-02-23 02:22:27'),
(687, '21', '2121', '21', 'user', '21', '2121@gmail.com', '2024-03-15 03:38:34'),
(694, '21212', '2121', '21', 'peserta', '2121', '212121@gmail.com', '2024-03-15 03:40:40'),
(976, 'ray', 'ray31', '31', 'peserta', 'ray', 'ray31', '2024-02-24 04:31:00'),
(3114, '2139', '21', '21', 'peserta', '41', '414', '2024-03-15 03:38:13');


INSERT INTO kursus (`id_kursus`, `nama_kursus`, `durasi_kursus`, `biaya_kursus`, `deskripsi_kursus`) VALUES
(1, 'kursus', 15, 1650000.00, 'kursus programming'),
(31, '31', 31, 31.00, '31');
