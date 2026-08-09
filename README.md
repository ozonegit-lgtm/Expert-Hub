# Expert-Hub

โปรเจกต์เริ่มต้น Laravel 13 สำหรับพัฒนาบน Windows ผ่าน Docker ประกอบด้วย PHP-FPM, Nginx, MySQL และ phpMyAdmin

## ความต้องการ

- Windows 10/11
- Docker Desktop (เปิดใช้ WSL 2)
- Git

ไม่จำเป็นต้องติดตั้ง PHP หรือ Composer บน Windows

## ติดตั้งที่ `E:\projects\Expert-Hub`

แตกไฟล์ ZIP แล้ววางโฟลเดอร์ `Expert-Hub` ไว้ที่ `E:\projects` จากนั้นเปิด PowerShell:

```powershell
cd E:\projects\Expert-Hub
Set-ExecutionPolicy -Scope Process Bypass
.\scripts\setup.ps1
```

การเริ่มครั้งแรกอาจใช้เวลาหลายนาที เพราะ Docker ต้องดาวน์โหลด image และ Composer packages

## URL และบัญชีฐานข้อมูล

| บริการ | URL / ค่า |
| --- | --- |
| เว็บไซต์ | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |
| MySQL host ภายใน Docker | `mysql` |
| Database | `expert_hub` |
| Username | `expert_hub` |
| Password | `expert_hub_secret` |

รหัสผ่านเหล่านี้ใช้สำหรับ development เท่านั้น เปลี่ยนได้ใน `.env` ก่อนนำระบบขึ้น production

## คำสั่งประจำวัน

```powershell
# เริ่มระบบ
docker compose up -d

# หยุดระบบ
docker compose down

# ดู log
docker compose logs -f

# รัน Artisan
docker compose exec app php artisan migrate

# รัน test
docker compose exec app php artisan test

# จัดรูปแบบโค้ด
docker compose exec app ./vendor/bin/pint
```

หากต้องการลบข้อมูลฐานข้อมูลทั้งหมด ให้ใช้ `docker compose down -v` (ข้อมูล MySQL จะถูกลบถาวร)

## GitHub

Repository ใช้ branch `main` และมี initial commit แล้ว หลังสร้าง repository เปล่าชื่อ `Expert-Hub` ใน GitHub ให้เชื่อม remote และ push:

```powershell
git remote add origin https://github.com/YOUR_USERNAME/Expert-Hub.git
git push -u origin main
```

ไฟล์ `.env`, dependencies และข้อมูล runtime ถูกกันออกจาก Git ด้วย `.gitignore`
