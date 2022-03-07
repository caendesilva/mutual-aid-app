<form action="{{ $formActionURL }}" method="POST" class="max-w-lg p-4">
    @csrf
    @method($formMethod)
    <fieldset name="required-fields" class="mb-1">
        <legend class="font-bold">Required Fields</legend>

        <x-project-form-input property="subject" required maxlength="64"/>
        <x-project-form-input property="location" required maxlength="255" focusHint="It's okay to just put country and postal code. Though specificity helps the map."/>
    </fieldset>

    <fieldset name="resources" class="mb-3">
        <legend class="font-bold">Resources in Request</legend>

        <div class="flex flex-col m-3 max-w-lg">
            <legend>Check all that apply</legend>
            <fieldset class="m-2">

                <x-project-form-resource-checkbox value="water"/>
                <x-project-form-resource-checkbox value="food"/>
                <x-project-form-resource-checkbox value="money"/>
                <x-project-form-resource-checkbox value="shelter"/>
                <x-project-form-resource-checkbox value="other"/>
        
            </fieldset>
        </div>
    </fieldset>

    <fieldset name="optional-fields" class="mb-3">
        <legend class="font-bold">Optional Fields</legend>
        
        <div class="mt-4">
        	<x-jet-label for="body" value="{{ __($langKey . 'body') }}" class="text-base" />
            <textarea name="body" id="body" cols="30" rows="5"
            class="border-gray-600 focus:border-indigo-600 focus:ring focus:ring-indigo-500 focus:ring-opacity-75 rounded-md shadow-sm block mt-1 w-full peer"
                placeholder="{{ __($langKey . 'body' . '.placeholder') }}">{{ $model->body }}</textarea>
        </div>

        <x-project-form-input type="date" property="expires_at" min="{{ date('Y-m-d') }}" :placeholder="null" :value="optional($model->expires_at)->format('Y-m-d')"/>
    </fieldset>


    <div class="flex flex-row -mx-1 mt-5 justify-end">
        <x-jet-secondary-button type="reset" class="m-2">
            Reset
        </x-jet-secondary-button>
        <x-jet-button type="submit" class="m-2">
            Submit
        </x-jet-button>
    </div>
</form>