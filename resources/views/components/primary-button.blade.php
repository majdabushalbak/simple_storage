<link href="{{   asset('css/guest-btn.css') }}" rel="stylesheet">
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'guest-btn']) }}>
    {{ $slot }}
</button>
