<?php declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;

class AiController extends Controller
{
    public ?string $content = null;

    public ?string $aiSelectedType = null;

    public function index(Request $request)
    {
        $prompt = $request->input('prompt');

        if (!$prompt) {
            // Display the form
            $content = "type a prompt";
            return view('ai-prompt-form', compact('content'));
        }

        if ($request->isMethod('post')) {
            // Handle form submission
            $validator = Validator::make($request->all(), [
                'prompt' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->route('ai-prompt-form')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $this->aiSelectedType = "open_api";

        switch ($this->aiSelectedType) {
            case 'open_api':
                $content = $this->openApi($prompt);
                break;

            case 'analyze':
                $content = $this->analyze($prompt);
                break;

            default:
                $content = "Not implemented yet";
        }

        // Display the form
        return view('ai-prompt-form', compact('content'));
    }

    /**
     * @param string|null $text
     * @return false|string|null
     */
    public function analyze(?string $text=null): false|string
    {
        if (!$text) {
            return false;
        }

        return json_encode([
            'entities' => ['John Doe'],
            'dates' => ['2024-01-01'],
            'amounts' => ['£100,000'],
            'issues' => ['Missing signature'],
            'summary' => 'Sample extracted summary'
        ], JSON_PRETTY_PRINT);
    }

    public function openApi(string $prompt): array
    {
        $apiKey = config('services.open_api.api_key');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        if (!$response->successful()) {
            throw new \Exception('API failed: '.$response->body());
        }

        return [
            'raw' => $response->json()
        ];
    }


}
