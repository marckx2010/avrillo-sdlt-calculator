<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Form</title>
    <!-- Bootstrap 5 CSS (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">AI Form</h3>
                </div>
                <div class="card-body">

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (isset($contents))
                        @php(dump($contents))
                    @endif

                    @php($prompt = "")

                    <!-- The Form that submits to its own controller -->
                    <form action="{{ route('ai-prompt-form') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="prompt" class="form-label">Prompt *</label>
                            <textarea
                                class="form-control"
                                name="prompt"
                                rows="5">
                            </textarea>
                            @error('prompt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      id="content"
                                      name="content"
                                      rows="5">@if (isset($content)) {{ ($content) }} @endif</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $content }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
