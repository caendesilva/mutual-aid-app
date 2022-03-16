<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<h1 class="text-3xl font-bold mb-8">Frequently asked Questions</h1>

				<article class="prose max-w-5xl prose-h2:mb-2 prose-h2:mt-8">
					<h2>How does someone sign-up to receive these free resources?</h2>

					<p>
						You <x-link :to="route('register', ['roles' => 'pin'])">register as a person in need</x-link> and enter your location (zip code or full address). A map will come up showing all the resources in your area. You can also filter these results by individual resource category. Each mutual aid provider listed can be directly contacted through the app or have their own contact information listed.
					</p>

					<blockquote>
						Note: Some mutual aid providers may require you to verify who you are.
					</blockquote>
				</article>

				<article class="prose max-w-5xl prose-h2:mb-2 prose-h2:mt-8">
					<h2>Why do I have to verify who I am to receive free resources?</h2>

					<p>
						We only use email or phone number for verification and do not require you to submit your personal information such as name or full address to register on the app. Individuals that offer resources may not feel comfortable meeting strangers without communicating first. We have no control over what qualifications mutual aid providers may require before they assist others.
					</p>
				</article>

				<article class="prose max-w-5xl prose-h2:mb-2 prose-h2:mt-8">
					<h2>What items or services are you able to offer through the app?</h2>

					<p>
						Food, water, shelter, financial services, legal services, etc. Anything legal being offered free of charge.
					</p>
				</article>

				<article class="prose max-w-5xl prose-h2:mb-2 prose-h2:mt-8">
					<h2>Does the app/service cost money to use?</h2>

					<p>
						No. But we may need to ask for donations if it becomes popular to keep it operational.
					</p>
				</article>

			</div>
		</div>
    </div>
</x-app-layout>
