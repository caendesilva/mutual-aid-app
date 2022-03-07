<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form Input Language Lines
    |--------------------------------------------------------------------------
    |
    | The values here are used to inject text displayed to the user.
    |
    | The values are specified in this file which is a PHP array.
    | A Language Line follows the following format:
    |	'key.name' => 'The translated value',
    | In the frontend, the key is then referenced using
	|	{{ __(file-name.key.name) }}
	| which then gets replaced with the translated value.
    |
    */

	// Offer Create Values
	'offer.create.subject' => 'Enter a descriptive subject',
	'offer.create.subject.placeholder' => 'e.g. I need help with fighting Russia',
	'offer.create.location' => 'Enter a your location',
	'offer.create.location.placeholder' => 'e.g. Kyiv, Ukraine',
	'offer.create.resource.water.description' => 'Please specify quantity in the Request Details',
	'offer.create.resource.food.description' => 'Please specify any dietary restrictions in the Request Details',
	'offer.create.resource.money.description' => 'Please specify in the Request Details',
	'offer.create.resource.shelter.description' => 'Please specify in the Request Details',
	'offer.create.resource.other.description' => 'Please specify in the Request Details',
	'offer.create.body' => 'Request Details - Remember to specify your contact information here',
	'offer.create.body.placeholder' => 'e.g. We need food and shelter. Please contact us on 123-123-123 or hello@example.com.',
	'offer.create.expires_at' => 'Request Expiration - Do you need aid before a certain date?'
];
