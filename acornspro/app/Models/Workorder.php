<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class Workorder extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'service_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'po',
        'location',
        'service_date',
        'nte',
        'payout',
        'store',
        'rep',
        'rep_number',
        'sow',
        'status',
    ];

    public static function createFromPdf($pdf): void
    {
        $text = Pdf::getText($pdf, null, ['raw']);

        if (! str_contains($text, 'Error.')) {
            // String manipulation to extract values from our PDF.
            $po = trim(explode("\n", explode('PO Number: ', $text)[1])[0]);
            $location = implode(' ', array_slice(explode("\n", explode('Divisions Contact:', explode('Property:', $text)[1])[0]), 3, 2));
            $date = \Carbon\Carbon::parse(explode("IfthisETAchangescall\n", explode("TECH DUE ON-SITE / ETA\n", $text)[1])[0])->toDateTimeString();
            $store = str_replace("\n", '', explode(':', explode('Property:', $text)[1])[0]);
            $rep = explode("\n", explode("Divisions Contact:\n", $text)[1])[0];
            $rep_number = explode("\n", explode("Divisions Contact:\n", $text)[1])[1];
            $nte = str_replace(',', '', str_replace('$', '', explode("\n", explode('NTE Amt: ', $text)[1])[0]));

            // Remove SOW lines that start with two **.
            $sow = explode("\n", explode("On-Site Activity Requirements\n", explode("Scope of Work\n", $text)[1])[0]);
            $output = [];
            foreach ($sow as $s) {
                if (! (preg_match("/^\*{2}(?!\*)|^\*{3}MANDATORY/", $s))) {
                    $output[] = $s;
                }
            }
            $sow = implode("\n", $output);

            $workorder = self::firstOrnew([
                'po' => $po,
            ]);

            $workorder->location = $location;
            $workorder->service_date = $date;
            $workorder->store = $store;
            $workorder->rep = $rep;
            $workorder->rep_number = $rep_number;
            $workorder->sow = $sow;
            $workorder->nte = $nte;

            // If workorder exists but is about to be updated.
            if ($workorder->exists && $workorder->isDirty()) {
                $workorder->statuses()->create([
                    'name' => $workorder->status,
                    'note' => 'PO updated from vendor.',
                ]);
            }

            // If workorder exists but is about to be updated or does not exist.
            if (($workorder->exists && $workorder->isDirty()) || ! $workorder->exists) {
                // Upload PDF to S3.
                Storage::disk('s3')->putFileAs('PDFs', $pdf, "{$workorder->po}.pdf", 'public');

                $workorder->save();
            }
        }
    }

    /**
     * The statuses that belong to the workorder.
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(WorkorderStatus::class);
    }

    /**
     * The items that belong to the workorder.
     */
    public function items(): HasMany
    {
        return $this->hasMany(WorkorderItem::class);
    }
}
