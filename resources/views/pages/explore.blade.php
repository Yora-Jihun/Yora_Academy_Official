@extends('layouts.explore')

@section('content')
<div class="flex-1 flex flex-col min-w-0 bg-[#FAFAFB]">
    <div class="px-4 md:px-8 py-4 md:py-6 bg-white border-b border-gray-100">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-5">Explore Public Documentation</h1>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
            <div class="flex items-center gap-1.5 md:gap-2 flex-wrap">
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-white bg-[#5B5FEF] rounded-full">All Topics</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition">Web</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Backend</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Frontend</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition">AI</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">DevOps</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">API</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Mobile</button>
            </div>

            <div class="flex items-center gap-1.5 md:gap-2">
                <select class="text-[11px] md:text-[13px] text-gray-700 bg-gray-50 border border-gray-100 rounded-none px-2 md:px-3 py-1 md:py-1.5 focus:outline-none focus:border-[#5B5FEF] transition">
                    <option>Trending</option>
                    <option>Most Recent</option>
                    <option>Most Stars</option>
                </select>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Card 1 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#F7DF1E]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5zm-1 16v-4h2v4h3l-4-4-4 4z"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">JavaScript</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">Modern React Patterns</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        A comprehensive guide to modern React patterns, hooks, and best practices for building scalable applications.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">React</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none hidden sm:inline">Hooks</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none hidden sm:inline">Patterns</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/5B5FEF/white?text=S" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">Sarah Johnson</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                1.2k
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                8.4k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 2 days ago</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#3776AB]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">Python</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">Machine Learning Handbook</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        Complete guide to machine learning algorithms, model training, and deployment strategies.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">ML</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">AI</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/8B5CF6/white?text=M" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">Michael Zhang</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                2.8k
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                15.2k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 5 hours ago</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#00ADD8]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2v20"/>
                            <path d="M5 5h14"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">Go</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">Microservices Architecture</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        Building scalable microservices with Go, covering gRPC, Docker, Kubernetes.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">Microservices</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none hidden sm:inline">gRPC</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/EC4899/white?text=P" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">Priya Patel</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                856
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                4.3k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 1 week ago</span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow lg:hidden xl:inline">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#38BDF8]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2v20"/>
                            <path d="M5 10h14"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">TypeScript</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">Advanced TypeScript</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        Deep dive into TypeScript's advanced features including generics and utility types.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">Types</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none hidden sm:inline">Generics</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/F59E0B/white?text=D" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">David Kim</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                3.1k
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                12.7k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 3 days ago</span>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow sm:hidden lg:inline">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#FF6B6B]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2v8a4 4 0 0 0-4 4v8"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">API</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">REST API Design</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        Best practices for designing RESTful APIs, versioning, authentication.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">REST</span>
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none hidden sm:inline">HTTP</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/10B981/white?text=R" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">Robert Taylor</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                2.3k
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                9.1k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 4 days ago</span>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow">
                <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                    <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-[#4ADE80]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 5v14"/>
                            <path d="M5 10h14"/>
                        </svg>
                        <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">DevOps</span>
                    </div>
                    <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">CI/CD Pipeline</h3>
                    <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">
                        Complete CI/CD pipeline setup with GitHub Actions, Docker, and testing.
                    </p>
                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-4">
                        <span class="px-1.5 md:px-2 py-0.5 text-[10px] md:text-[11px] text-gray-600 bg-gray-100 rounded-none">CI/CD</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 md:gap-2">
                            <img src="https://placehold.co/24x24/818CF8/white?text=E" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                            <span class="text-[10px] md:text-[12px] text-gray-500">Emma Wilson</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-[12px] text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="12,2 15,8.5 21,9.3 16,14 18,21 12,17.8 6,21 8,14 3,9.3 9,8.5"/>
                                </svg>
                                1.5k
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 12s3-7 10-7 10 7 10 7"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                6.2k
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                    <span class="text-[10px] md:text-[11px] text-gray-400">Updated 6 days ago</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection