<?php

namespace App\Jobs;

use Goutte\Client;
use Illuminate\Foundation\Bus\Dispatchable;

class ScrapePayments
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
        // Create new Goutte client.
        $client = new Client();

        // Login to mydivisions.com.
        $crawler = $client->request('GET', 'https://mydivisions.com');
        $form = $crawler->selectButton('Log In')->form();
        $crawler = $client->submit($form, [
            'Username' => $this->user->divisions_username,
            'Password' => $this->user->divisions_password,
        ]);

        // Go to the invoices page.
        $crawler = $client->click($crawler->selectLink('Invoices')->link());

        // Go to the paid invoices tab.
        $crawler = $client->click($crawler->selectLink('PAID INVOICES')->link());

        // Get all unpaid workorders.
        $workorders = \App\Models\Workorder::whereNotIn('status', ['PO Paid', 'Cancelled'])->get();

        // Load form values.
        $form = $crawler->filter('form')->form();
        $formValues = $form->getValues();

        // Loop through every unpaid workorder.
        foreach ($workorders as $w) {
            $crawler = $client->submit($form, [
                'ctl00$MainContentAjax$PaidInvoicesGrid$InvoiceRadGrid$ctl00$ctl02$ctl02$FilterTextBox_PONumber' => $w->po,
                'ctl00$MainContentAjax$PaidInvoicesGrid$InvoiceRange' => '1095',
                '__VIEWSTATE' => $formValues['__VIEWSTATE'] ? $formValues['__VIEWSTATE'] : '',
                '__EVENTVALIDATION' => $formValues['__EVENTVALIDATION'] ? $formValues['__EVENTVALIDATION'] : '',
            ]);

            try {
                $payout = $crawler->filter('tr.rgRow > td:nth-child(9)')->text();

                $region = 'en_US';
                $currency = 'USD';
                $formatter = new \NumberFormatter($region, \NumberFormatter::CURRENCY);
                $amountPaid = $formatter->parseCurrency($payout, $currency);

                // Save payment to workorder.
                $w->payout = $amountPaid;
                $w->save();
            } catch (\Exception $e) {
                \Log::debug('Exception: (Timeout) searching payment for '.$w->po);
            }
            sleep(rand(1, 10));
        }
    }
}
