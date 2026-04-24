<?php declare(strict_types=1);

namespace App\Services;

/**
 * These services allow for easy replacement in the code when sources of information change
 */

/**
 *
 */
class AiService
{
    public function analyze(string $text): array
    {
        return [
            'summary' => '...',
            'entities' => [],
            'issues' => []
        ];
    }
}
