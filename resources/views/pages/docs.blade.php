@extends('layouts.docs')

@section('content')
<div class="flex-1 flex flex-col min-w-0 bg-white">
    <div class="px-4 md:px-8 py-4 md:py-6 border-b border-gray-100">
        <div class="flex items-center gap-1.5 md:gap-2 text-[11px] md:text-[13px] text-gray-500 mb-2 md:mb-3">
            <a href="#" class="hover:text-[#5B5FEF]">Documentation</a>
            <x-icon name="chevron-right" class="w-2.5 h-2.5 md:w-3 md:h-3" />
            <a href="#" class="hover:text-[#5B5FEF]">Getting Started</a>
            <x-icon name="chevron-right" class="w-2.5 h-2.5 md:w-3 md:h-3" />
            <span class="text-gray-700">Installation</span>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Installation Guide</h1>
    </div>

    <div class="px-4 md:px-8 py-3 md:py-4 border-b border-gray-100 overflow-x-auto">
        <div class="flex items-center gap-0.5 min-w-max">
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Heading 1">
                <x-icon name="heading-1" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Heading 2">
                <x-icon name="heading-2" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <div class="w-px h-4 md:h-5 bg-gray-200 mx-0.5 md:mx-1"></div>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Bold">
                <x-icon name="bold" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Italic">
                <x-icon name="italic" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Underline">
                <x-icon name="underline" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <div class="w-px h-4 md:h-5 bg-gray-200 mx-0.5 md:mx-1"></div>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="List">
                <x-icon name="list" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Code Block">
                <x-icon name="code" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Table">
                <x-icon name="table" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Image">
                <x-icon name="image" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Link">
                <x-icon name="link" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Quote">
                <x-icon name="quote" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <div class="w-px h-4 md:h-5 bg-gray-200 mx-0.5 md:mx-1"></div>
            <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Markdown">
                <x-icon name="markdown" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
            <button class="ml-auto p-1.5 md:p-2 rounded-none bg-[#F5F6FF] text-[#5B5FEF] hover:bg-[#EDEFFF]" title="AI Assistant">
                <x-icon name="ai" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            </button>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-8">
        <article class="prose prose-gray max-w-none text-[13px] md:text-[15px]">
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-4 md:mb-6">
                Welcome to the installation guide. This comprehensive tutorial will walk you through setting up your documentation environment step by step. Follow along to get up and running quickly.
            </p>

            <h2 class="text-[18px] md:text-[20px] font-semibold text-gray-900 mt-4 md:mt-8 mb-2 md:mb-4">Prerequisites</h2>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                Before you begin, ensure you have the following requirements met:
            </p>

            <ul class="space-y-1 md:space-y-2 mb-4 md:mb-6">
                <li class="text-[13px] md:text-[15px] text-gray-700">Node.js version 18 or higher installed</li>
                <li class="text-[13px] md:text-[15px] text-gray-700">A valid API key from your account</li>
                <li class="text-[13px] md:text-[15px] text-gray-700">Access to your workspace</li>
            </ul>

            <div class="bg-blue-50 border border-blue-100 rounded-none p-3 md:p-5 my-3 md:my-6">
                <div class="flex items-start gap-2 md:gap-3">
                    <x-icon name="info" class="w-4 h-4 md:w-5 md:h-5 text-blue-600 flex-shrink-0 mt-0.5" />
                    <div>
                        <h4 class="text-[12px] md:text-[14px] font-semibold text-blue-900 mb-1">Tip</h4>
                        <p class="text-[12px] md:text-[14px] text-blue-800 mb-0">You can verify your Node.js installation by running <code class="bg-blue-100 px-1 md:px-1.5 py-0.5 rounded-none text-blue-900 text-[11px] md:text-[13px]">node --version</code> in your terminal.</p>
                    </div>
                </div>
            </div>

            <h2 class="text-[18px] md:text-[20px] font-semibold text-gray-900 mt-4 md:mt-8 mb-2 md:mb-4">Installation Steps</h2>

            <h3 class="text-[15px] md:text-[17px] font-semibold text-gray-800 mt-4 md:mt-6 mb-2 md:mb-3">Step 1: Install the CLI</h3>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                Open your terminal and run the following command to install the CLI globally:
            </p>

            <pre class="bg-gray-900 rounded-none p-3 md:p-5 overflow-x-auto mb-3 md:mb-6"><code class="text-[11px] md:text-[13px] text-gray-100 font-mono">npm install -g @docuflow/cli</code></pre>

            <h3 class="text-[15px] md:text-[17px] font-semibold text-gray-800 mt-4 md:mt-6 mb-2 md:mb-3">Step 2: Authenticate</h3>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                Run the authentication command with your API key:
            </p>

            <pre class="bg-gray-900 rounded-none p-3 md:p-5 overflow-x-auto mb-3 md:mb-6"><code class="text-[11px] md:text-[13px] text-gray-100 font-mono">docuflow login --api-key YOUR_API_KEY</code></pre>

            <div class="bg-amber-50 border border-amber-100 rounded-none p-3 md:p-5 my-3 md:my-6">
                <div class="flex items-start gap-2 md:gap-3">
                    <x-icon name="warning" class="w-4 h-4 md:w-5 md:h-5 text-amber-600 flex-shrink-0 mt-0.5" />
                    <div>
                        <h4 class="text-[12px] md:text-[14px] font-semibold text-amber-900 mb-1">Warning</h4>
                        <p class="text-[12px] md:text-[14px] text-amber-800 mb-0">Keep your API key secure and never commit it to version control.</p>
                    </div>
                </div>
            </div>

            <h3 class="text-[15px] md:text-[17px] font-semibold text-gray-800 mt-4 md:mt-6 mb-2 md:mb-3">Step 3: Initialize your project</h3>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                Navigate to your project directory and initialize:
            </p>

            <pre class="bg-gray-900 rounded-none p-3 md:p-5 overflow-x-auto mb-3 md:mb-6"><code class="text-[11px] md:text-[13px] text-gray-100 font-mono">cd my-project
docuflow init</code></pre>

            <h2 class="text-[18px] md:text-[20px] font-semibold text-gray-900 mt-4 md:mt-8 mb-2 md:mb-4">Configuration Options</h2>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                The config file supports the following options:
            </p>

            <div class="overflow-x-auto">
                <table class="w-full md:w-auto border border-gray-200 rounded-none overflow-hidden mb-3 md:mb-6">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-3 md:px-4 py-2 md:py-3 text-left text-[10px] md:text-[12px] font-semibold text-gray-600 uppercase tracking-wider">Option</th>
                            <th class="px-3 md:px-4 py-2 md:py-3 text-left text-[10px] md:text-[12px] font-semibold text-gray-600 uppercase tracking-wider hidden sm:table-cell">Description</th>
                            <th class="px-3 md:px-4 py-2 md:py-3 text-left text-[10px] md:text-[12px] font-semibold text-gray-600 uppercase tracking-wider">Default</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] font-mono text-gray-800">title</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600 hidden sm:table-cell">Documentation title</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600">My Docs</td>
                        </tr>
                        <tr>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] font-mono text-gray-800">theme</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600 hidden sm:table-cell">Color theme</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600">default</td>
                        </tr>
                        <tr>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] font-mono text-gray-800">version</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600 hidden sm:table-cell">Documentation version</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-[11px] md:text-[14px] text-gray-600">1.0.0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="text-[18px] md:text-[20px] font-semibold text-gray-900 mt-4 md:mt-8 mb-2 md:mb-4">Next Steps</h2>
            <p class="text-[13px] md:text-[15px] leading-relaxed text-gray-700 mb-2 md:mb-4">
                Your documentation is now set up. Continue to:
            </p>

            <ul class="space-y-1 md:space-y-2 mb-4 md:mb-6">
                <li class="text-[13px] md:text-[15px] text-gray-700"><a href="#" class="text-[#5B5FEF] hover:underline">Quickstart Guide →</a></li>
                <li class="text-[13px] md:text-[15px] text-gray-700"><a href="#" class="text-[#5B5FEF] hover:underline">API Reference →</a></li>
            </ul>
        </article>
    </div>
</div>
@endsection