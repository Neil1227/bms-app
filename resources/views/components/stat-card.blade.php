@props([
'title',
'value',
'icon',
'iconColor' => 'text-gray-500',
'valueColor' => 'text-gray-900',
'subtitle' => null,
])

@php
$bgColor = match ($iconColor) {
'text-red-600' => 'bg-red-100',
'text-green-600' => 'bg-green-100',
'text-teal-500' => 'bg-teal-100',
'text-yellow-500' => 'bg-yellow-100',
'text-violet-600' => 'bg-violet-100',
default => 'bg-gray-100',
};
$accentColor = match ($iconColor) {
'text-red-600' => 'bg-red-600',
'text-green-600' => 'bg-green-600',
'text-teal-500' => 'bg-teal-500',
'text-yellow-500' => 'bg-yellow-500',
'text-violet-600' => 'bg-violet-600',
default => 'bg-gray-300',
};

@endphp
<div class="stat-card relative animate-fade-in">
    <!-- Accent bar -->
    <div class="stat-card__accent {{ $accentColor }}"></div>

    <div class="stat-card__body">
        <div class="stat-card__content">
            <p class="stat-card__title">{{ $title }}</p>
            <h2 class="stat-card__amount {{ $valueColor }}">{{ $value }}</h2>
            @if ($subtitle)
            <p class="stat-card__subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        <div class="w-12 h-12 flex items-center justify-center rounded-full {{ $bgColor }}">
            <i class="bi {{ $icon }} {{ $iconColor }}"></i>
        </div>
    </div>
</div>