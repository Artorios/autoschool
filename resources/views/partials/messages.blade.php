@if (session('messages'))
    <div class="alert alert-success">
        <ul>
            @foreach (session('messages') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif