<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="flex flex-col items-center pt-6 sm:pt-0">
            <section class="w-full sm:max-w-3xl mt-6 mb-10 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <nav class="w-full bg-slate-200 p-4">
                    <ul class="flex justify-center">
                        <li class="px-2 mx-2 md:px-3">
                            <a class="{{ request()->routeIs('guidelines.show') ? 'text-gray-900 underline' : 'text-gray-700' }}"
                                {{ request()->routeIs('guidelines.show') ? 'aria-current=true' : '' }}
                                href="{{ route('guidelines.show') }}">Community Guidelines
                            </a>
                        </li>
                        <li class="px-4 mx-2 md:px-6 md:border-l md:border-r border-gray-400">
                            <a class="{{ request()->routeIs('terms.show') ? 'text-gray-900 underline' : 'text-gray-700' }}"
                                {{ request()->routeIs('terms.show') ? 'aria-current=true' : '' }}
                                href="{{ route('terms.show') }}">Terms of Service</a>
                        </li>
                        <li class="px-2 mx-2 md:px-3">
                            <a class="{{ request()->routeIs('policy.show') ? 'text-gray-900 underline' : 'text-gray-700' }}"
                                {{ request()->routeIs('policy.show') ? 'aria-current=true' : '' }}
                                href="{{ route('policy.show') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </nav>
                <article class="prose w-full sm:max-w-3xl px-8 py-8">
                    {!! $policy !!}
                </article>
                <footer class="px-8 py-4">
                    <i>
                        This document was last updated <x-time :carbon="$lastModified" :niceDate="true" />
                    </i>
                </footer>
            </section>
        </div>
    </div>
</x-app-layout>
