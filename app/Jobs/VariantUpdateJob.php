<?php

namespace App\Jobs;

use App\Models\Variant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class VariantUpdateJob implements ShouldQueue
{
    use Queueable;

    private $data;
   
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $variant = Variant::find($this->data["id"]);
        if ($variant) {
            $variant->update([
                'stock' => $this->data['stock'],
            ]);
        }
    }
}
