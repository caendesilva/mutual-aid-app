# Helpers that can aid in and speed up development

## Blade Components

To create links that are automatically styled use the `<x-link>` blade tag
```blade
{{-- Internal Links --}}
<x-link :to="route('register')">Register</x-link>

{{-- External Links --}}
<x-link to="https://github.com/caendesilva/mutual-aid-app">GitHub</x-link>
```
Which results in the following
```html
<a class="text-indigo-500 hover:text-indigo-700" href="http://localhost:8000/register">Register</a>
<a class="text-indigo-500 hover:text-indigo-700" href="https://github.com/caendesilva/mutual-aid-app">GitHub</a>
```

You can also add the boolean attribute `external` to add a title to the `<a>` tag. Note that you may still need to specify the proper `rel=""` attributes yourself depending on use case.
`<x-link ... external` adds the following HTML `title="Opens an external website"`.


To create a data rich `<time>` element, use the `<x-time>` element.
```blade
<x-time :carbon="$model->created_at" :niceDate="true" />
```
Which results in
```html
<time datetime="2022-03-07T23:15:30+00:00" title="Mon, 07 Mar 2022 23:15 UTC">
    Yesterday at 11:15pm
</time>
```
> The `niceDate` parameter is optional and changes the output to "Today/Yesterday at... " if the date is today or yesterday. Without it it's displayed in the `2022-03-06 10:17` format instead.

## Blade Directives
To aid in collaborative editing we use Markdown for longer content sections. They are stored in the `resources/markdown/content/` directory. You can access the Markdown as parsed HTML using the directive
```blade
@markdownSection("welcome")

{{-- Or if the file is in a subdirectory: --}}
@markdownSection("welcome/header")

{{-- You can also pass custom classes in the second parameter: --}}
@markdownSection("welcome/header", "text-sm")
```