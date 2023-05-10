# APLIKASI PENGADUAN MASYARAKAT

KELOMPOK 2 C1

Ardita Dyah Paramita (2109116089)

Elfrida Simanjuntak (210911093)

Muhammad Harist Illyasa (2109116101)


1. USE CASE

![alt text](![usecase](https://github.com/harist13/pa-web-kel2/assets/59532207/9a3b453c-d73c-4932-a79a-847dfb404b4c)


2. ERD

![relasi](https://github.com/harist13/pa-web-kel2/assets/59532207/bc41c01e-6375-4963-9725-ca381407a1a1)

Relasi One to One:

Tabel Pelapor dan Pengaduan: setiap pengaduan hanya dilaporkan oleh satu pelapor dan setiap pelapor hanya membuat satu pengaduan.

Relasi One to Many:

Tabel Pelapor dan Pengaduan: setiap pelapor dapat membuat banyak pengaduan, tetapi setiap pengaduan hanya dilaporkan oleh satu pelapor.

Relasi Many to Many:

Tabel Petugas dan Pengaduan: setiap petugas dapat menangani banyak pengaduan dan setiap pengaduan dapat ditangani oleh banyak petugas. Oleh karena itu, dibutuhkan tabel pivot atau tabel penghubung untuk merepresentasikan relasi ini. Tabel pivot ini dapat disebut "petugas_pengaduan" dan memiliki kolom id_petugas (foreign key) dan id_pengaduan (foreign key).



3. Masyarakat mengakses Web Pengaduan Masyarakat

![tampilan aawal](https://github.com/harist13/pa-web-kel2/assets/59532207/e122a8a5-5285-42b9-8790-db453b5a1d46)


4. Masyarakat pilih halaman login

![1](https://github.com/harist13/pa-web-kel2/assets/59532207/753bfdfc-9275-4a0a-ac2f-fdfbcbcd58dd)


5. Jika belum memiliki akun masyarakat harus melakukan registrasi terlebih dahulu

![2](https://github.com/harist13/pa-web-kel2/assets/59532207/bffcf01f-07f8-4655-9659-75fe1c405c75)


6. Setelah melakukan registrasi bisa kembali login dan melakukan login

![1](https://github.com/harist13/pa-web-kel2/assets/59532207/d99ab74a-d9e5-476c-af15-790f74ee3c5d)

7. Lalu setelah login masyarakat akan diarahkan dashboard masyarakat

![3](https://github.com/harist13/pa-web-kel2/assets/59532207/f7b4e9fb-5aab-40fb-84ed-be427a242b3e)

8. Pada dashboard masyarakat terdapat 3 pilihan yaitu “Home”, “Ajukan Pengaduan”, dan “Riwayat Pengaduan”

Untuk mengajukan pengaduan pilih “Ajukan Pengaduan”

![4](https://github.com/harist13/pa-web-kel2/assets/59532207/64213494-e4b3-4a68-874c-cc185be32403)

9. Kemudian Unggah Bukti Gambar dan menulis keluhan yang ingin diajukan dan dikirim

![4](https://github.com/harist13/pa-web-kel2/assets/59532207/ab3d3ea4-fb65-492d-9d50-33a5254cb054)

10. Lalu pada notifikasi akan muncul bahwa telat mengirim pengaduan

![7](https://github.com/harist13/pa-web-kel2/assets/59532207/e17d1be3-6806-4fc6-9b01-eead20032399)

11. Setelah dikirim menunggu tanggapan oleh petugas dan bisa melihat di “Riwayat Pengaduan”

![8](https://github.com/harist13/pa-web-kel2/assets/59532207/10e7ec9a-79a9-4724-bfa7-ba04799adb8c)

12. Jika ingin mengajukan pengaduan lebih dari sekali dalam sehari maka pengaduan dibatalkan secara otomatis karena hanya dapat mengajukan pengaduan sekali dalam 

![9](https://github.com/harist13/pa-web-kel2/assets/59532207/3d52721b-66a4-45b4-b50b-5141ddb44e27)


13. Kemudian petugas akan mengakses dashboard petugas untuk melakukan tanggapan yang telah diajukan oleh masyarakat

![Screenshot 2023-05-10 220436](https://github.com/harist13/pa-web-kel2/assets/59532207/f3cd1ba6-10ab-4940-8787-8afcca17b0ed)

14. Lalu petugas akan ke halaman tanggapi pengaduan

![Screenshot 2023-05-10 221059](https://github.com/harist13/pa-web-kel2/assets/59532207/09c8a7ab-41b2-4264-b6f2-503eec0d0a35)


15. Petugas bisa menanggapi keluhan masyarakat dengan klik tombol “Tanggapi” pada tabel pengaduan masyarakat

![Screenshot 2023-05-10 220218](https://github.com/harist13/pa-web-kel2/assets/59532207/434dbd0e-ed9d-4653-ab24-99c56cfa5374)


16.  Lalu petugas memasukkan tanggapan

![Screenshot 2023-05-10 220328](https://github.com/harist13/pa-web-kel2/assets/59532207/977821c4-ae3a-4c27-82d1-7782cca26d44)

17. Jika petugas sudah menanggapi maka akan masuk ke halaman “proses pengaduan”

![Screenshot 2023-05-10 221059](https://github.com/harist13/pa-web-kel2/assets/59532207/70847300-fc6f-4368-8607-6045597be580)


18. Jika pengaduan telah teratasi maka petugas bisa mengklik “Proses Selesai” pada tabel pengaduan diproses.

![Screenshot 2023-05-10 221134](https://github.com/harist13/pa-web-kel2/assets/59532207/81f0aa53-61d3-481e-9a46-ca1668950ca8)


19. Pada Dashboard Masyarakat, jika petugas telah memberikan tanggapan maka pengaduaan akan diproses
20. jika petugas memberikan solusi maka akan ada pemberitahuan “Pengaduan anda dengan ID ‘ ‘ telah Selesai diproses”

![Screenshot 2023-05-10 221305](https://github.com/harist13/pa-web-kel2/assets/59532207/fb95b4f3-f461-405b-87e9-382ed298c633)






