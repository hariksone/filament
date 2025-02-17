@php
    $descriptionAbove = $getDescriptionAbove();
    $descriptionBelow = $getDescriptionBelow();

    $icon = $getIcon();
    $iconPosition = $getIconPosition();
    $iconClasses = 'w-4 h-4';
@endphp

<div
    {{ $attributes->merge($getExtraAttributes())->class([
        'filament-tables-text-column',
        'px-4 py-3' => ! $isInline(),
        'text-primary-600 transition hover:underline hover:text-primary-500 focus:underline focus:text-primary-500' => $getAction() || $getUrl(),
        match ($getColor()) {
            'danger' => 'text-danger-600',
            'primary' => 'text-primary-600',
            'secondary' => 'text-gray-500',
            'success' => 'text-success-600',
            'warning' => 'text-warning-600',
            default => null,
        } => ! ($getAction() || $getUrl()),
        match ($getColor()) {
            'secondary' => 'dark:text-gray-400',
            default => null,
        } => (! ($getAction() || $getUrl())) && config('tables.dark_mode'),
        match ($getSize()) {
            'sm' => 'text-sm',
            'lg' => 'text-lg',
            default => null,
        },
        match ($getWeight()) {
            'medium' => 'font-medium',
            'bold' => 'font-bold',
            default => null,
        },
        'whitespace-normal' => $canWrap(),
    ]) }}
>
    @if (filled($descriptionAbove))
        <p class="block text-sm text-gray-500">
            {{ $descriptionAbove instanceof \Illuminate\Support\HtmlString ? $descriptionAbove : \Illuminate\Support\Str::of($descriptionAbove)->markdown()->sanitizeHtml()->toHtmlString() }}
        </p>
    @endif

    <p class="flex items-center space-x-1 rtl:space-x-reverse">
        @if ($icon && $iconPosition === 'before')
            <x-dynamic-component :component="$icon" :class="$iconClasses" />
        @endif

        <span>
            {{ $getFormattedState() }}
        </span>

        @if ($icon && $iconPosition === 'after')
            <x-dynamic-component :component="$icon" :class="$iconClasses" />
        @endif
    </p>

    @if (filled($descriptionBelow))
        <p class="block text-sm text-gray-500">
            {{ $descriptionBelow instanceof \Illuminate\Support\HtmlString ? $descriptionBelow : \Illuminate\Support\Str::of($descriptionBelow)->markdown()->sanitizeHtml()->toHtmlString() }}
        </p>
    @endif
</div>
