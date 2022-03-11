{{--
    A component intended to collect checkbox values using the checkbox component.
    The backend is expected to save the information as an array.

    The component expects an array of the possible option values
    and the property name for the resulting array. 
--}}

@props([
    'legend' => 'Check all that apply',
    'property',
    'values',
])

<fieldset>
    <legend>{{ __($legend) }}</legend>

    <div class="ml-3">
        @foreach ($values as $value)
            <x-forms.checkbox :property="$property" :value="$value" />
        @endforeach
    </div>
</fieldset>