<svg {{ $attributes->merge(['class' => 'w-5 h-5', 'xmlns' => 'http://www.w3.org/2000/svg', 'fill' => 'none', 'viewBox' => '0 0 24 24', 'stroke-width' => '2', 'stroke' => 'currentColor']) }}>
    @switch($icon)
        @case('home')
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            @break
        @case('document')
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625A2.625 2.625 0 0 0 16.875 9h-7.5A2.625 2.625 0 0 0 6.75 11.625v2.625m13.5 0H19.5m0 0h2.25m-2.25 0v2.25m0-2.25v2.25m-2.25 0V19.5m0-2.25v2.25M9 15V9.75m0 0v2.25m0-2.25v2.25M6.75 9.75v2.25m0 0v2.25m0-2.25v2.25"/>
            @break
        @case('folder')
            <path stroke-linecap="round" stroke-linejoin="round" d="M2 12c.552 0 1.088-.04 1.61-.117.533-.078 1.05-.188 1.548-.328.48-.136.94-.304 1.37-.498.41-.186.79-.397 1.13-.629.32-.223.606-.46 1.01-.512-.404-.052-.69-.22-.913-.396-.21-.17-.38-.368-.54-.56-.15-.18-.28-.37-.4-.55-.11-.17-.21-.34-.29-.51-.08-.16-.15-.33-.21-.5-.06-.17-.11-.34-.15-.51-.04-.17-.06-.34-.08-.51-.02-.17-.03-.34-.04-.51 0-.17.02-.34.04-.51.02-.17.06-.34.11-.51.04-.17.11-.34.19-.51.06-.17.16-.34.26-.51.09-.17.2-.36.31-.53.11-.17.26-.36.44-.52.18-.16.39-.31.62-.43.23-.12.49-.21.77-.26.28-.05.58-.07 1.11-.07s.83.02 1.11.07c.28.05.54.14.77.26.23.12.44.27.62.43.18.16.34.35.47.56.12.21.22.44.3.69.08.25.19.52.33.8.14.28.3.59.48.9.18.31.38.66.6.99.22.33.48.68.8.99.22.34.47.66.76.96.18.22.35.43.54.62.11.12.23.22.22.4.34.22.4.34.64.44.88.6.99.16.22.34.42.34.62.42.82.62 1.01.24.22.39.38.51.11.12.24.2.22.4.26.4.22.4.22.62.22.82.22 1.01.22.22.38.42.51.62.62.82.62 1.01.62.22.82.68.99.22.34.42.51.62.62.82.62 1.01.51.22.34.26.22.34.22.42.22.64.22.99.22.42.22.62.22.82.22 1.01.22.22.42.44.51.62.62.82.62 1.01.51.22.34.26.22.22.22.22.22.42.22.64.22.99.22.42.22.62.22.82.22 1.01.22.22.42.44.51.62.62.82.62 1.01.51.22.34.26.22.22.22.22.22.42.22.64.22.99.22.42.22.62.22.82.22 1.01.22.22.42.44.51.62.62.82.62 1.01.51.22.34.26.22.22.22.22.22.42.22.64.22.99.22.42.22.62.22.82.22 1.01.22.22.42.44.51.62.62.82.62 1.01.51.22.34.26.22.22.22.22.42.22.64.22.99.22.42.22.62.22.82.22 1.01.22.22.42.44.51.62.62.82.62 1.01.51.22.34.26.22"/>
            @break
        @case('star')
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.495a.75.75 0 0 1 1.048 0l6.5 9A.75.75 0 0 1 17 14.25h-4.5v5.25a.75.75 0 0 1-1.5 0v-5.25H5.5a.75.75 0 0 1-.545-1.285l6.5-9ZM12 12h3.75"/>
            @break
        @case('clock')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            @break
        @case('share')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v.75m0 10.5v.75m4.5-5.25v.75M7.5 12v.75m9-6.75h.75A2.25 2.25 0 0 1 21 7.5v.75c0 .414-.336.75-.75.75h-.75m-10.5 0h.75c.414 0 .75-.336.75-.75v-.75m0 10.5v-.75c0-.414.336-.75.75-.75h.75m-10.5 0h.75A2.25 2.25 0 0 1 9 16.5v.75c0 .414-.336.75-.75.75H6.75"/>
            @break
        @case('upload')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5v-11.25m4.5 4.5L12 6.75m0 0L7.5 11m4.5-4.5V3m9 3v13.5A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75V6c0-1.25.99-2.25 2.25-2.25h4.5"/>
            @break
        @case('globe')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25c-5.523 0-10 4.477-10 10s4.477 10 10 10 10-4.477 10-10S17.523 2.25 12 2.25zM2.25 12c0-2.21.896-4.21 2.357-5.651m14.486 0C19.004 7.79 20 9.79 20 12s-.996 4.21-2.657 5.651M2.25 12c0 2.21.896 4.21 2.357 5.651m14.486 0C19.004 16.21 20 14.21 20 12s-.996-4.21-2.657-5.651"/>
            @break
        @case('bookmark')
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.495a.75.75 0 0 1 0 0l2.02 2.7.375-.5-.575.766M12 6.75v10.5m0 0l-2.25-3 2.25 3 2.25-3L12 17.25"/>
            @break
        @case('bold')
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.75 4.75v14.5M9.25 4.75v14.5M13.75 4.75v14.5M18.25 4.75v14.5"/>
            @break
        @case('italic')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.75v14.5"/>
            @break
        @case('underline')
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.75h16M6.75 4.75v2.25"/>
            @break
        @case('list')
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.75 5.75h8.5M7.75 12h8.5m-8.5 6.25h8.5"/>
            <circle cx="4" cy="6" r="1"/>
            <circle cx="4" cy="12" r="1"/>
            <circle cx="4" cy="18" r="1"/>
            @break
        @case('code')
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.25v13.5h13.5V5.25H5.25Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l6 6M15 9l-6 6"/>
            @break
        @case('table')
            <rect width="18" height="18" x="3" y="3" rx="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18"/>
            @break
        @case('image')
            <rect width="18" height="18" x="3" y="3" rx="2"/>
            <circle cx="9" cy="9" r="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 15-3-3L5 21"/>
            @break
        @case('link')
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12H19.5m-3.75 3.75v-7.5a3.75 3.75 0 0 0-3.75-3.75H9a3.75 3.75 0 0 0-3.75 3.75v7.5a3.75 3.75 0 0 0 3.75 3.75h3"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75"/>
            @break
        @case('quote')
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.25v13.5h13.5V5.25H5.25Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2"/>
            @break
        @case('markdown')
            <rect width="18" height="18" x="3" y="3" rx="2"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6m-6 6h6"/>
            @break
        @case('ai')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 0 0-4 4v8h8"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v5m7.5 4.5a8 8 0 0 1-15 0"/>
            @break
        @case('profile')
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20a7.963 7.963 0 0 1 15 0"/>
            @break
        @case('settings')
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.02-.522.706-1.164 1.647-1.426"/>
            @break
        @case('logout')
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m0 0 3-3m-3 3 3 3" />
            @break
        @case('search')
            <circle cx="11" cy="11" r="8"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"/>
            @break
        @case('menu')
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            @break
        @case('chevron-down')
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            @break
        @case('close')
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            @break
        @case('theme')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 18v1m9-9h-1M4 12h-1m15.364 6.364l-.364.364M6.364 6.364l.364-.364m12.728 0l-.364.364M6.364 17.636l.364-.364"/>
            @break
        @case('eye')
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.5v-1.25c0-.414.336-.75.75-.75h4.072c.414 0 .75.336.75.75v1.25m0-2.5v2.5m0-2.5v2.5m0-2.5v2.5"/>
            @break
        @case('help')
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.753c1.018 1.25 1.371 2.653 1.371 3.25v.75a3 3 0 0 0 3 3v.75c0 1.25-.252 2.25-1.371 3.25"/>
            @break
        @case('document-text')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.8 5.4 9.2 5 7 5c-2.2 0-4 .4-5 1.15C2.4 7.1 2 8.6 2 10c0 2.2.4 3.8 1 5 .6 1.4 1.5 2.5 2.5 3.25.9 1 2 1.5 3.25 1.5"/>
            @break
        @case('folder-open')
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 0 1 2-2h5l2 2h9a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z"/>
            @break
        @case('chevron-right')
            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 2 6-2"/>
            @break
        @default
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12m-10 0a10 10 0 1 0 20 0a10 10 0 1 0-20 0"/>
    @endswitch
</svg>