@props(['type' => 'info'])

<div style="padding: 12px; margin-bottom: 15px; border-radius: 4px;
    background-color: {{ $type === 'warning' ? '#fff3cd' : '#d1e7dd' }};
    color: {{ $type === 'warning' ? '#664d03' : '#0f5132' }};">
    {{ $slot }}
</div>
