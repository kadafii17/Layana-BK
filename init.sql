CREATE TABLE konseling (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT,
    topik VARCHAR(255),
    deskripsi TEXT,
    status ENUM('menunggu', 'dijadwalkan', 'selesai') DEFAULT 'menunggu',
    jadwal DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES users(id)
);