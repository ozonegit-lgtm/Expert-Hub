$ErrorActionPreference = 'Stop'

Set-Location (Split-Path -Parent $PSScriptRoot)

if (-not (Test-Path '.env')) {
    Copy-Item '.env.example' '.env'
}

docker compose up -d --build
docker compose exec app php artisan key:generate --force
docker compose exec app php artisan migrate --force

Write-Host ''
Write-Host 'Expert-Hub is ready:' -ForegroundColor Green
Write-Host '  Web:        http://localhost:8080'
Write-Host '  phpMyAdmin: http://localhost:8081'
Write-Host '  DB user:    expert_hub'
