<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment('Build knowledge. Share expertise.');
})->purpose('Display an inspiring quote');
