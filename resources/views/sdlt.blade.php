@extends('layouts.app')

@section('content')

    <h2 class="mb-4">Stamp Duty Calculator</h2>

    <form method="POST" action="{{ route('sdlt.calculate') }}">
        @csrf

        <div class="mb-3 w-25">
            <label class="form-label">Property Price (£)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $price ?? '') }}" required>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="first_time_buyer"
                       class="form-check-input"
                       id="ftb"
                    {{ old('first_time_buyer', $first_time_buyer ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="ftb">
                    First-time buyer
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" name="additional_property"
                       class="form-check-input"
                       id="add"
                    {{ old('additional_property', $additional_property ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="add">
                    Additional property
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Result --}}
    @if(isset($result))
        <div class="alert alert-success mt-4">
            <h4>Total SDLT: £{{ number_format($result['total'], 2) }}</h4>

            <ul>
                @foreach ($result['breakdown'] as $line)
                    <li>{{ $line }}</li>
                @endforeach
            </ul>

            <strong>Effective rate: {{ $result['effective_rate'] }}%</strong>
        </div>
    @endif

@endsection


