<form
    action="{{ route('sign-in') }}"
>
    @csrt
    @method('post')
    
    <input name="username" />
    <input name="password" />
</form>
