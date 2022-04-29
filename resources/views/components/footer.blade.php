<footer class="mt-auto text-center py-3">
    <p>
        {{ $name }}
    </p>
    <small>
    {{ $version }}        
    </small>
    <div>
        <ul class="flex flex-wrap mx-auto justify-center text-center text-sm mt-3 mb-2">
            <li>
                <a href="{{ route('guidelines.show') }}" class="text-gray-500 hover:text-gray-900 m-2">Community Guidelines</a>
            </li>
            <li>
                <a href="{{ route('terms.show') }}" class="text-gray-500 hover:text-gray-900 m-2">Terms of Service</a>
            </li>
            <li>
                <a href="{{ route('policy.show') }}" class="text-gray-500 hover:text-gray-900 m-2">Privacy Policy</a>
            </li>
        </ul>
    </div>
</footer>