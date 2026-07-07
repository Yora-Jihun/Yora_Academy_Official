@props([
'name',
'icon',
])

@php
$icons = [
'menu' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
',

'x' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
',

'search' => '
<circle cx="11" cy="11" r="7" />
<path stroke-linecap="round" stroke-linejoin="round" d="m20 20-3.5-3.5" />
',

'document-text' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 3H6.75A2.25 2.25 0 0 0 4.5 5.25v13.5A2.25 2.25 0 0 0 6.75 21h10.5A2.25 2.25 0 0 0 19.5 18.75V6.75L15.75 3Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h7.5M8.25 13.5h7.5M8.25 17.25h4.5" />
',

'book-open' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75C10.5 5.6 8.4 5.25 6.75 5.25A2.25 2.25 0 0 0 4.5 7.5v10.5A2.25 2.25 0 0 1 6.75 15.75c1.65 0 3.75.35 5.25 1.5m0-10.5c1.5-1.15 3.6-1.5 5.25-1.5A2.25 2.25 0 0 1 19.5 7.5v10.5a2.25 2.25 0 0 0-2.25-2.25c-1.65 0-3.75.35-5.25 1.5" />
',

'home' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 10.5 12 3l8.25 7.5" />
<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 9.75v9A2.25 2.25 0 0 0 7.5 21h9A2.25 2.25 0 0 0 18.75 18.75v-9" />
',

'bookmark' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 21 12 17.25 6.75 21V5.25A2.25 2.25 0 0 1 9 3h6a2.25 2.25 0 0 1 2.25 2.25V21Z" />
',
'clock' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
',

'code' => '
<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 9-3 3 3 3" />
<path stroke-linecap="round" stroke-linejoin="round" d="m15.75 9 3 3-3 3" />
<path stroke-linecap="round" stroke-linejoin="round" d="m13.5 6-3 12" />
',

'settings' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a1.724 1.724 0 0 1 3.35 0 1.724 1.724 0 0 0 2.573 1.066 1.724 1.724 0 0 1 2.36 2.36 1.724 1.724 0 0 0 1.066 2.573 1.724 1.724 0 0 1 0 3.35 1.724 1.724 0 0 0-1.066 2.573 1.724 1.724 0 0 1-2.36 2.36 1.724 1.724 0 0 0-2.573 1.066 1.724 1.724 0 0 1-3.35 0 1.724 1.724 0 0 0-2.573-1.066 1.724 1.724 0 0 1-2.36-2.36 1.724 1.724 0 0 0-1.066-2.573 1.724 1.724 0 0 1 0-3.35 1.724 1.724 0 0 0 1.066-2.573 1.724 1.724 0 0 1 2.36-2.36 1.724 1.724 0 0 0 2.573-1.066Z" />
<circle cx="12" cy="12" r="3" />
',

'help' => '
<circle cx="12" cy="12" r="9" />
<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9a2.25 2.25 0 1 1 3.77 1.65c-.86.74-1.52 1.3-1.52 2.35" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 17.25h.008" />
',

'trash' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
<path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
<path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6M14 11v6" />
',

'chevron-right' => '
<path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
',
'chevron-down' => '
<path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
',

'folder-open' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 0 1 5.25 5.25H9l2.25 2.25H18.75A2.25 2.25 0 0 1 21 9.75v7.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V7.5Z" />
',

'folder' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 0 1 5.25 5.25H9l2.25 2.25H18.75A2.25 2.25 0 0 1 21 9.75v7.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V7.5Z" />
',

'folder-plus' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 0 1 5.25 5.25H9l2.25 2.25H18.75A2.25 2.25 0 0 1 21 9.75v7.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V7.5Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6M9 12h6" />
',

'document-plus' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 3H6.75A2.25 2.25 0 0 0 4.5 5.25v13.5A2.25 2.25 0 0 0 6.75 21h10.5A2.25 2.25 0 0 0 19.5 18.75V6.75L15.75 3Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M15 3v4.5h4.5" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 12v4.5" />
<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 14.25h4.5" />
<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 17.25h7.5" />
',

'bold' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M8 5h5a3 3 0 0 1 0 6H8V5Zm0 6h6a3.5 3.5 0 0 1 0 7H8v-7Z" />
',

'italic' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M14 5h-4M14 19h-4M13 5l-2 14" />
',

'underline' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M8 5v6a4 4 0 0 0 8 0V5" />
<path stroke-linecap="round" stroke-linejoin="round" d="M5 19h14" />
',

'list' => '
<circle cx="5" cy="6" r="1" />
<circle cx="5" cy="12" r="1" />
<circle cx="5" cy="18" r="1" />
<path stroke-linecap="round" stroke-linejoin="round" d="M9 6h10M9 12h10M9 18h10" />
',
'table' => '
<rect x="3" y="4" width="18" height="16" rx="2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18M9 4v16M15 4v16M3 15h18" />
',

'image' => '
<rect x="3" y="4" width="18" height="16" rx="2" />
<circle cx="9" cy="9" r="1.5" />
<path stroke-linecap="round" stroke-linejoin="round" d="m21 16-5-5-4 4-2-2-7 7" />
',

'link' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M10 13a5 5 0 0 1 0-7l1-1a5 5 0 1 1 7 7l-1 1" />
<path stroke-linecap="round" stroke-linejoin="round" d="M14 11a5 5 0 0 1 0 7l-1 1a5 5 0 1 1-7-7l1-1" />
',

'quote' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M8 10a3 3 0 0 0-3 3v2h4v-2H7a2 2 0 0 1 2-2V8H8Zm8 0a3 3 0 0 0-3 3v2h4v-2h-2a2 2 0 0 1 2-2V8h-1Z" />
',

'markdown' => '
<rect x="3" y="4" width="18" height="16" rx="2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M7 15V9l2 3 2-3v6M13 9h4l-4 6h4" />
',

'ai' => '
<circle cx="12" cy="12" r="8" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v2M12 18v2M4 12h2M18 12h2" />
<circle cx="12" cy="12" r="3" />
',
'theme' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1 1 11.21 3c0 .42.03.83.09 1.24A7 7 0 0 0 19.76 12.7c.41.06.82.09 1.24.09Z" />
',

'profile' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0 1 15 0" />
',

'logout' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15" />
<path stroke-linecap="round" stroke-linejoin="round" d="M18 12H9" />
<path stroke-linecap="round" stroke-linejoin="round" d="m15 9 3 3-3 3" />
',

'plus' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
',

'info' => '
<circle cx="12" cy="12" r="9" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 10v5" />
<circle cx="12" cy="7.5" r=".5" fill="currentColor" stroke="none" />
',

'warning' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 3 2.5 19.5h19L12 3Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v5" />
<circle cx="12" cy="17" r=".5" fill="currentColor" stroke="none" />
',

'pencil' => '
<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Z" />
',

'share' => '
<circle cx="18" cy="5" r="2" />
<circle cx="6" cy="12" r="2" />
<circle cx="18" cy="19" r="2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M8 11l8-5M8 13l8 5" />
',
'heading-1' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M5 5v14M11 5v14" />
<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h6" />
<path stroke-linecap="round" stroke-linejoin="round" d="M16 7h3v10" />
<path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5" />
',

'heading-2' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M5 5v14M11 5v14" />
<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h6" />
<path stroke-linecap="round" stroke-linejoin="round" d="M15 8a2 2 0 0 1 4 0c0 1.2-.8 2-2 3.2-1.3 1.2-2 2-2 3.8h4" />
',

'security' => '
<rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
<path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0 1 10 0v4" />
',

'bell' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17H9.143A2.143 2.143 0 0 1 7 14.857V10a5 5 0 1 1 10 0v4.857A2.143 2.143 0 0 1 14.857 17Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M9.5 17a2.5 2.5 0 0 0 5 0" />
',

'align-left' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5M3.75 12h10.5M3.75 18h13.5" />
',
'align-center' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5M7.5 12h9M5.25 18h13.5" />
',
'align-right' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5M10.5 12h10.5M7.5 18h13.5" />
',
'align-justify' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5M3.75 12h16.5M3.75 18h16.5" />
',
'text-size' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h9M8.5 6v13M15 9h5M17.5 9v10" />
',

'highlighter' => '
<path stroke-linecap="round" stroke-linejoin="round" d="M12 2v16a5 5 0 0 0-5 5h10a5 5 0 0 0-5-5V2" />
',

];
@endphp

<svg {{ $attributes->merge(['class' => '']) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
    {!! $icons[$name ?? $icon] ?? '' !!}
</svg>
