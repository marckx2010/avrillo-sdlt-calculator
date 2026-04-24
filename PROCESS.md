# PROCESS

This task was completed within the intended 2–3 hour timeframe, focusing on correctness and clarity rather than over-engineering.

## Approach

- Implemented a simple Laravel application with a single form for input and a service-based calculation.
- Stored SDLT rate bands in configuration (`config/sdlt.php`) as required, rather than hardcoding them.
- Kept controllers thin and placed all calculation logic in a dedicated `SdltCalculatorService`.

## Use of AI

- Used ChatGPT to assist with structuring the application, validating approach, and reviewing edge cases.
- Did not rely on generated code blindly; all logic was reviewed and adjusted where necessary.

## Verification

- SDLT calculations were implemented based on HMRC guidance.
- Outputs were manually verified against HMRC’s official calculator using several test cases, including:
    - Standard purchase
    - First-time buyer relief
    - Additional property surcharge
    - Boundary values between tax bands

## Notes

- Chose a simple, single-page interface to prioritise functionality over UI complexity.
- Made small UX improvements such as validation feedback and preserving user input.
- Removed unused or experimental code before submission to keep the repository focused.
