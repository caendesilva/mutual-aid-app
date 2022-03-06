<x-app-layout>
    <x-slot name="header">
        <div class="flex row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Submit Request') }}
            </h2>
            <a href="{{ route('requests.index') }}">
                <x-jet-secondary-button>
                    Go back
                </x-jet-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-6 lg:p-8 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf

                    <fieldset name="required-fields" class="mb-3">
                        <legend class="font-bold">Required Fields</legend>

                        <div class="flex flex-col m-3 max-w-lg">
                            <label for="subject">Enter a descriptive subject</label>
                            <input id="subject" name="subject" type="text" maxlength="64"
                                placeholder="e.g. I need help with fighting Russia" required>
                        </div>

                        <div class="flex flex-col m-3 max-w-lg">
                            <label for="location">Enter a your location</label>
                            <input id="location" name="location" type="text" maxlength="255"
                                placeholder="e.g. Kyiv, Ukraine" required>
                            <label for="location" class="text-sm">If you want to retain privacy,
                                you can just write your postal (ZIP) code and country.</label>
                        </div>
                    </fieldset>

                    <fieldset name="resources" class="mb-3">
                        <legend class="font-bold">Resources in Request</legend>

                        <div class="flex flex-col m-3 max-w-lg">
                            <legend>Check all that apply</legend>
                            <fieldset class="m-2">
                                <div class="m-1">
                                    <input type="checkbox" name="resources[]" value="water" id="resources.water"
                                        class="cursor-pointer peer">
                                    <label for="resources.water" class="cursor-pointer">Water</label>
                                    <small class="invisible peer-checked:visible">Please specify
                                        quantity in the Request Details</small>
                                </div>
                                <div class="m-1">
                                    <input type="checkbox" name="resources[]" value="food" id="resources.food"
                                        class="cursor-pointer peer">
                                    <label for="resources.food" class="cursor-pointer">Food</label>
                                    <small class="invisible peer-checked:visible">Please specify
                                        any dietary restrictions in the Request Details</small>
                                </div>
                                <div class="m-1">
                                    <input type="checkbox" name="resources[]" value="money" id="resources.money"
                                        class="cursor-pointer peer">
                                    <label for="resources.money" class="cursor-pointer">Money</label>
                                    <small class="invisible peer-checked:visible">Please specify
                                        in the Request Details</small>
                                </div>
                                <div class="m-1">
                                    <input type="checkbox" name="resources[]" value="shelter" id="resources.shelter"
                                        class="cursor-pointer peer">
                                    <label for="resources.shelter" class="cursor-pointer">Shelter</label>
                                    <small class="invisible peer-checked:visible">Please specify
                                        in the Request Details</small>
                                </div>
                                <div class="m-1">
                                    <input type="checkbox" name="resources[]" value="other" id="resources.other"
                                        class="cursor-pointer peer">
                                    <label for="resources.other" class="cursor-pointer">Other</label>
                                    <small class="invisible peer-checked:visible">Please specify
                                        in the Request Details</small>
                                </div>
                            </fieldset>
                        </div>

                    </fieldset>


                    <fieldset name="optional-fields" class="mb-3">
                        <legend class="font-bold">Optional Fields</legend>

                        <div class="flex flex-col m-3 max-w-lg">
                            <label for="body">Request Details</label>
                            <textarea name="body" id="body" cols="30" rows="2"
                                placeholder="e.g. We need food and shelter."></textarea>
                        </div>

                        <div class="flex flex-col m-3 max-w-lg">
                            <label for="expires_at">Request Expiration</label>
                            <input type="date" name="expires_at" id="expires_at" min="{{ date('Y-m-d') }}">
                            <label for="expires_at" class="text-sm">Do you need aid before a certain date?</label>
                        </div>
                    </fieldset>

                    <div class="flex flex-row m-4 max-w-lg justify-end">

                    <x-jet-secondary-button type="reset" class="m-2">
                        Reset
                    </x-jet-secondary-button>
                    <x-jet-button type="submit" class="m-2">
                        Submit
                    </x-jet-button>
                </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>