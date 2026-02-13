<div id="mobileOverlay"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden md:hidden glass-effect transition-opacity duration-300"></div>
<aside id="sidebar"
    class="fixed inset-y-0 left-0 md:sticky md:top-0 h-screen z-50 flex flex-col transition-all duration-300 ease-in-out w-64 bg-gradient-to-b from-[#1b5e20] to-[#2E973E] text-white shadow-2xl rounded-r-3xl border-r border-white/10 -translate-x-full md:translate-x-0 group/sidebar">
    <div id="toggleSidebar"
        class="hidden md:flex absolute top-8 -right-4 w-8 h-8 bg-[#EFEA62] text-green-900 rounded-full shadow-lg items-center justify-center cursor-pointer hover:scale-110 hover:bg-yellow-300 transition-all duration-300 z-50">
        <i id="toggleIcon" class="fa-solid fa-chevron-left text-xs font-bold transition-transform duration-300"></i>
    </div>
    <div
        class="h-24 flex items-center justify-center border-b border-white/10 mb-4 px-2 transition-all duration-300 relative overflow-hidden">
        <h2 id="sidebarTextLogo"
            class="text-3xl font-bold tracking-tight sidebar-text transition-all duration-300 whitespace-nowrap">
            Finger<span class="text-[#EFEA62]">Pay</span>
        </h2>
        <img id="sidebarImgLogo" src="{{ asset('image/logo.png') }}" alt="Logo"
            class="hidden w-10 h-10 object-contain transition-all duration-300 drop-shadow-md absolute inset-0 m-auto">
    </div>
    <div class="flex-1 overflow-y-auto custom-scrollbar px-2 space-y-1 pb-10 overflow-x-hidden">
        @foreach ($menus[null] ?? [] as $menu)
            @php
                $submenuid = $menu->menuid;
                $hassubmenu = isset($menus[$menu->menuid]);
                $isActive = false;
            @endphp
            @if ($hassubmenu)
                <div class="group relative">
                    <button type="button"
                        class="flex items-center justify-center w-full py-3 px-2 text-base font-medium rounded-xl transition-all duration-200 hover:bg-white/10 hover:text-white hover:shadow-inner group-hover:pl-2 {{ $isActive ? 'bg-[#EFEA62] text-green-900 shadow-md' : 'text-gray-100' }}"
                        data-collapse-toggle="submenu-<?= $submenuid ?>">
                        <div class="flex items-center justify-center w-8 h-8 shrink-0 transition-all">
                            <i class="<?= $menu->menuicon ?> text-xl"></i>
                        </div>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap sidebar-text transition-all duration-300">
                            <?= $menu->menunm ?>
                        </span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300 collapse-icon sidebar-text ml-auto"></i>
                    </button>
                    <ul id="submenu-<?= $submenuid ?>"
                        class="hidden py-1 space-y-1 mt-1 bg-black/10 rounded-xl overflow-hidden backdrop-blur-sm">
                        @foreach ($menus[$menu->menuid] as $sub)
                            <li>
                                <a href="{{ route($sub->menulink) }}"
                                    class="flex items-center w-full p-2 pl-14 text-sm font-medium text-gray-200 rounded-lg transition-all duration-200 hover:text-white hover:bg-white/10 hover:pl-16">
                                    <span
                                        class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-2 group-hover:bg-[#EFEA62]"></span>
                                    <span
                                        class="whitespace-nowrap overflow-hidden text-ellipsis"><?= $sub->menunm ?></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <a href="{{ route($menu->menulink) }}"
                    class="flex items-center justify-center py-3 px-2 text-base font-medium rounded-xl transition-all duration-200 group hover:bg-white/10 hover:text-white hover:shadow-inner {{ $isActive ? 'bg-[#EFEA62] text-green-900 shadow-md' : 'text-gray-100' }}">
                    <div class="flex items-center justify-center w-8 h-8 shrink-0 transition-all">
                        <i class="<?= $menu->menuicon ?> text-xl"></i>
                    </div>
                    <span
                        class="ml-3 w-full whitespace-nowrap sidebar-text transition-all duration-300 group-hover:translate-x-1 text-left">
                        <?= $menu->menunm ?>
                    </span>
                </a>
            @endif
        @endforeach
    </div>
</aside>
