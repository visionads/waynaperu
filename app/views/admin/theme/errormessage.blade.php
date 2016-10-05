<message>
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{--set some message after action--}}
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get("message") }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-warning">{{ Session::get("error") }}</div>
    @elseif(Session::has('info'))
        <div class="alert alert-info">{{ Session::get("info") }}</div>
    @elseif(Session::has('danger'))
        <div class="alert alert-danger">{{ Session::get("danger") }}</div>
    @endif
</message>