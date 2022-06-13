<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Dto\CredentialsDto;
use App\Services\Specification\Sender\ISender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Email implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CredentialsDto $credentials;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CredentialsDto $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ISender $sender)
    {
        //
    }
}
