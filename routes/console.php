<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * PROTEÇÃO CONTRA COMANDOS DESTRUTIVOS
 * Bloqueia comandos perigosos e emite alerta
 */

// Comandos destrutivos bloqueados
$destructiveCommands = [
    'migrate:fresh',
    'migrate:reset',
    'migrate:rollback',
    'db:wipe',
    'db:seed',
    'queue:clear'
];

foreach ($destructiveCommands as $command) {
    Artisan::command($command, function () use ($command) {
        $this->error("❌ COMANDO DESTRUTIVO BLOQUEADO");
        $this->warn("O comando '$command' está bloqueado por segurança.");
        $this->info("Para executar, comente a proteção em routes/console.php");
        return 1;
    })->purpose("Comando $command bloqueado por segurança");
}
