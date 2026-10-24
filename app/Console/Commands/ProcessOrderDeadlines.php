<?php

namespace App\Console\Commands;

use App\Services\OrderWorkflowService;
use Illuminate\Console\Command;

class ProcessOrderDeadlines extends Command
{
    protected $signature = 'farmlink:process-order-deadlines';

    protected $description = 'Refund expired flagged orders and release unconfirmed deliveries after the allowed windows';

    public function handle(OrderWorkflowService $workflow): int
    {
        $workflow->processDeadlines();

        return self::SUCCESS;
    }
}
