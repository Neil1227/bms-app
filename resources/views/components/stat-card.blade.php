@props([
'title',
'value',
'icon',
'iconColor' => 'bg-gray-200',
'subtitle' => null
])

<div class="stat-card relative">
    <!-- Accent bar -->
    <div class="stat-card__accent {{ $iconColor }}"></div>

    <div class="stat-card__body">
        <div class="stat-card__content">
            <p class="stat-card__title">{{ $title }}</p>
            <h2 class="stat-card__amount">{{ $value }}</h2>
            @if ($subtitle)
            <p class="stat-card__subtitle">{{ $subtitle }}</p>
            @endif
        </div>

        <div class="stat-card__icon">
            <i class="bi {{ $icon }}"></i>
        </div>
    </div>
</div>