<div  
x-data="{{ json_encode(['show' => true]) }}"
x-show="show"
x-init="
                document.addEventListener('banner-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                });
            " class="bg-orange-500">
    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg bg-orange-600">
                    <svg class="h-5 w-5 fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>
                </span>

                <p class="mx-3 font-medium text-gray-700">Heads up! You are currently using the Canary site.</p>
                <strong>You might be looking for <a href="https://aidus.us/" class="underline">https://aidus.us/</a></strong>
            </div>

            <div class="shrink-0 sm:ml-3">
                <button type="button" class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition hover:bg-orange-600 focus:bg-orange-600" aria-label="Dismiss" x-on:click="show = false">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>