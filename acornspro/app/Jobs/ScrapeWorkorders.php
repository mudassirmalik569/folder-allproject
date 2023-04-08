<?php

namespace App\Jobs;

use Goutte\Client;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ScrapeWorkorders
{
    use Dispatchable;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();

        $crawler = $client->request('GET', 'https://mydivisions.com');
        $form = $crawler->selectButton('Log In')->form();
        $crawler = $client->submit($form, [
            'Username' => $this->user->divisions_username,
            'Password' => $this->user->divisions_password,
        ]);

        $crawler = $client->click($crawler->selectLink('UPCOMING SERVICES')->link());

        $crawler->filter('tr.UpcomingServiceRow input[name="providerJobId"]')->each(function ($node) {
            $job = $node->attr('value');

            // Extract the po values into the proper format.
            $pdfURL = "https://mydivisions.com/Home/PrintServiceCasePdf?jobId={$job}";

            // Temporarily store PDF for processing.
            $contents = Http::get($pdfURL)->body();
            Storage::disk('local')->put("livewire-tmp/{$job}.pdf", $contents);
            \App\Models\Workorder::createFromPdf(storage_path()."/app/livewire-tmp/{$job}.pdf");
        });
    }
}
