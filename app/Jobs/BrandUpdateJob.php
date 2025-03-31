<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class BrandUpdateJob implements ShouldQueue
{
    use Queueable;
    
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        
    }
}
