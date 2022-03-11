<x-forms.form-card>
    <x-jet-validation-errors />
    <form action="{{ route('listings.store') }}" method="POST" class="px-3 py-2">
        @php(View::share('langKey', "form-input.$type.create"))
        @csrf
        <input type="hidden" id="type" name="type" value="{{ $type }}">

        <x-forms.fieldset legend="Required Fields">
            <x-forms.form-input property="subject"  maxlength="64" required
                :value="$listing->subject ?? old('subject')" />
            <x-forms.form-input property="location" maxlength="255" required
                :value="$listing->location ?? old('location')"
                hint="It's okay to just put a postal code. Though being specific makes the map more accurate." />
        </x-forms.fieldset>

        <x-forms.fieldset :legend='__("form-input.$type.create.resources")'>
            <x-forms.checkbox-group legend="Check all that apply and specify quantity in the Request Details"
                property="resources" :values="['water', 'food', 'money', 'shelter', 'other']"
                :checkedValues="$listing->resources ?? false" />
        </x-forms.fieldset>

        <x-forms.fieldset legend="Optional Fields">
            <x-forms.form-input property="contacts" maxlength="128"
                :value="$listing->contacts ?? old('contacts')"/>
            <x-forms.form-input-textarea property="body" maxlength="2048" rows="3"
                :value="$listing->body ?? old('body')"/>

            <x-forms.form-input type="date" property="expires_at" min="{{ date('Y-m-d') }}"
                :value="isset($listing) ? $listing->expires_at->format('Y-m-d') : old('expires_at')"/>

            @includeWhen($type === 'offer', 'listing.is_religious')
        </x-forms.fieldset>
    
        @include('components.forms.actions')
    </form>
</x-forms.form-card>