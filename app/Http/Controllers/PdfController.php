<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AiService;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\PdfToText\Exceptions\PdfNotFound;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Storage;

// http://localhost:8000/pdf
class PdfController extends Controller
{
    public function pdfForm()
    {
        return view('spatie_pdf');
    }
//http://127.0.0.1:8000/pdfo


    /**
     * @param Request $request
     * @param PdfService $pdf
     * @param AiService $ai
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function pdfSubmit(Request $request, PdfService $pdfService, AiService $aiServoce)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->route('pdf.form')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $uploadedFile = $request->file('file');

            $path = $uploadedFile->store('uploads');

            $fullPath = Storage::path($path);

            // store temporarily
            $path = $uploadedFile->store('uploads');

            //$fullPath = storage_path('app/' . $path);

            $text = $pdfService->extractText($fullPath);


            /*
             * $bullets = array_filter($lines, fn($line) =>
    preg_match('/^\s*[\•\-\*\o]\s+/', $line)
);Y
             */

            unset($fullPath);

        } catch (\Exception $e) {
            $text = 'Error processing PDF: ' . $e->getMessage();
        }

        return view('spatie_pdf', compact('text'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     *
     * @throws PdfNotFound
     */
    public function OLDpdfSubmit(Request $request)
    {

        $file = storage_path("app/" . basename($request->input('file')));

        try {
            $text = (new Pdf())
                ->setPdf($file)
                ->text();
        } catch (PdfNotFound $e) {
            $text = $e->getMessage();
        }

        return view('spatie_pdf', compact('text'));
    }
}
