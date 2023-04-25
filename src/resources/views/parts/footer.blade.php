<footer>
    <nav>
        <ul>
            <li>&copy; {{ config('silverowl.footer.copyright') }} {{ \Carbon\Carbon::now()->year }}</li>
            
            @foreach($footerLinks as $label => $link)
                <li><a href="{{ $link }}">{{ $label }}</a></li>
            @endforeach
            
            <li>Made using <a href="{{ route('silverowl') }}">SilverOwl</a></li>
        </ul>
    </nav>
    
    Logo
</footer>
