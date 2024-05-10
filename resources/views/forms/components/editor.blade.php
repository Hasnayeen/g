<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-ignore
        ax-load
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('editor') }}"
        x-data="editor({
            state: $wire.{{ $applyStateBindingModifiers(" \$entangle('data.note')") }},
        })"
    >
        <div id="editor" class="whitespace-pre-wrap"></div>
    </div>
</x-dynamic-component>
