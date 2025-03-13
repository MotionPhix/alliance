<x-dynamic-component
  :component="$getFieldWrapperView()"
  :id="$getId()"
  :label="$getLabel()"
  :label-sr-only="$isLabelHidden()"
  :helper-text="$getHelperText()"
  :hint="$getHint()"
  :hint-action="$getHintAction()"
  :hint-color="$getHintColor()"
  :hint-icon="$getHintIcon()"
  :required="$isRequired()"
  :state-path="$getStatePath()">
  <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }">
    <img src="{{ $getState() }}" style="height: 185px;" class="object-cover" />
  </div>
</x-dynamic-component>
