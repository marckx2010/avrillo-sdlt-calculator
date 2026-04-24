<?php declare(strict_types=1);

namespace App\Services;
use Spatie\PdfToText\Exceptions\PdfNotFound;
use Spatie\PdfToText\Pdf;

class PdfService
{
    /**
     * @throws PdfNotFound
     */
    public function extractText(string $path): string
    {
        try {
            return (new Pdf())
                ->setPdf($path)
                ->text();

            // TODO: potentially useful
            /*
             *     ->setPdf($path)
    ->setOptions(['layout'])
    ->text();
             */


        } catch (PdfNotFound $e) {
            return $e->getMessage();
        }
    }
}
