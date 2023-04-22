@extends('silverowl::layout.page')

@section('content')
    <form
        action="{{ route('sign-in') }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('post')
        
        <input name="username" />
        <input name="password" />
        
        <button>Submit</button>
    </form>
@endsection
