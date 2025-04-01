<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class BrandDeleteJob implements ShouldQueue
{
    use Queueable;
    
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(): void
    {
        
    }
}
