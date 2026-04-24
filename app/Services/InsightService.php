<?php declare(strict_types=1);

namespace App\Services;

/**
 * Transforms extracted content into simple, structured insights.
 * Applies lightweight interpretation to highlight relevant information.
 */

class InsightService
{
    public function format(array $analysis): array
    {
        return [
            'summary' => $analysis['summary'] ?? '',
            'flags' => $analysis['issues'] ?? [],
            'key_entities' => $analysis['entities'] ?? [],
        ];
    }
}
