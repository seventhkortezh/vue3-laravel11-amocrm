<?php
// app/Console/Commands/ImportDeals.php

namespace App\Console\Commands;

use App\Services\DealService;
use Illuminate\Console\Command;
use App\Services\AmoCrmService;

class ImportDeals extends Command
{
    protected $signature = 'import:deals';
    protected $description = 'Импорт сделок из AmoCRM';

    protected $amoCrmService;
    protected $dealService;

    public function __construct(AmoCrmService $amoCrmService, DealService $dealService)
    {
        parent::__construct();
        $this->amoCrmService = $amoCrmService;
        $this->dealService = $dealService;
    }

    public function handle()
    {
        $this->info('Получаем сделки из AmoCRM...');

        $dealsData = $this->amoCrmService->fetchDeals();

        $this->dealService->importMany($dealsData);

        $this->info('Сделки успешно импортированы.');
    }
}
