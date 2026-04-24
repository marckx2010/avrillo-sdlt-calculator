<div class="container mt-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <h3>PDF Test</h3>

    <form action="/pdf" method="POST" enctype="multipart/form-data">
        @csrf

        @if (0)
        <label for="file" class="form-label">File: </label>
        <input
            type="text"
            name="filename"
            value="Mark Arnum CV c1.pdf"
            class="form-control mb-3"
        />
        @endif

        <input type="file" name="file" accept="application/pdf">

        <button type="submit" class="btn btn-primary">
            Extract PDF Text
        </button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(isset($text))
        <hr>
        <pre>{{ $text }}</pre>
    @endif

</div>
