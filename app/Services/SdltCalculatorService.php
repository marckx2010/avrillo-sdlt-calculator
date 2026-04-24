<?php declare(strict_types=1);

namespace App\Services;

class SdltCalculatorService
{
    public function calculate(
        float $price,
        bool $isFirstTimeBuyer,
        bool $isAdditionalProperty
    ): array {

        $config = config('sdlt');

        // Choose correct bands
        if ($isFirstTimeBuyer && $price <= $config['first_time']['max_price']) {
            $bands = $config['first_time']['bands'];
        } else {
            $bands = $config['standard'];
        }

        $totalTax = 0;
        $breakdown = [];

        $previousLimit = 0;

        foreach ($bands as $band) {

            $limit = $band['limit'] ?? $price;
            $rate = $band['rate'];

            $taxable = min($price, $limit) - $previousLimit;

            if ($taxable <= 0) {
                continue;
            }

            $tax = $taxable * $rate;
            $totalTax += $tax;

            $breakdown[] = sprintf(
                '£%s–£%s at %.0f%% = £%s',
                number_format($previousLimit, 0),
                number_format($limit, 0),
                $rate * 100,
                number_format($tax, 2)
            );

            $previousLimit = $limit;

            if ($price <= $limit) {
                break;
            }
        }

        // Additional property surcharge (applies to full price)
        if ($isAdditionalProperty) {
            $surcharge = $price * $config['surcharge'];
            $totalTax += $surcharge;

            $breakdown[] = sprintf(
                'Additional property surcharge (%.0f%%): £%s',
                $config['surcharge'] * 100,
                number_format($surcharge, 2)
            );
        }

        return [
            'total' => round($totalTax, 2),
            'breakdown' => $breakdown,
            'effective_rate' => round(($totalTax / $price) * 100, 2),
        ];
    }
}
