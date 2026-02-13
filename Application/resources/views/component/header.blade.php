<nav class="sticky top-0 z-40 w-full p-3">
    <div
        class="flex justify-between items-center w-full h-16 px-4 bg-gradient-to-r from-[#F0FDF4] to-white/90 backdrop-blur-md border border-[#2E973E]/30 shadow-sm rounded-2xl transition-all duration-300">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-4 z-10">

                <button id="mobileMenuBtn"
                    class="md:hidden p-2 text-[#54834E] bg-green-50 rounded-full hover:bg-[#54834E] hover:text-white transition-all shadow-sm focus:outline-none">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <div class="flex flex-col">
                    <div class="flex items-baseline gap-1">
                        <span class="text-gray-500 font-medium text-sm md:text-base">Hi,</span>
                        <h1 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">
                            <?= $usernm ?>
                        </h1>
                    </div>
                    <span
                        class="text-xs font-semibold text-[#2E973E] bg-[#2E973E]/10 px-2 py-0.5 rounded-full w-fit border border-[#2E973E]/20">
                        @if ($user->roleid == 1)
                            Admin System
                        @elseif($user->roleid == 2)
                            <i class="fa-solid fa-store mr-1 text-[10px]"></i> <?= $user->storenm ?>
                        @elseif($user->roleid == 3)
                            Member
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2 md:gap-4">
            <div class="relative">
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                    class="flex items-center gap-2 md:gap-3 pl-2 pr-1 py-1 md:pr-4 md:py-1.5 rounded-full border border-transparent hover:border-[#54834E]/30 hover:bg-green-50 transition-all focus:ring-2 focus:ring-[#54834E]/50 group"
                    type="button">

                    <div class="relative">
                        <img class="w-9 h-9 md:w-10 md:h-10 rounded-full object-cover border-2 border-white shadow-md group-hover:scale-105 transition-transform"
                            src="{{ asset('uploads/default-avatar.png') }}" alt="User dropdown">
                        <div
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full">
                        </div>
                    </div>

                    <div class="hidden md:flex items-center gap-2">
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-700 leading-tight group-hover:text-[#2E973E]">
                                <?= $usernm ?></p>
                            <p class="text-[10px] text-gray-400 font-medium">Online</p>
                        </div>
                        <i
                            class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#2E973E] transition-colors"></i>
                    </div>
                </button>
                <div id="dropdownAvatarName"
                    class="z-50 hidden absolute right-0 mt-2 w-48 bg-white divide-y divide-gray-100 rounded-xl shadow-lg border border-gray-100 animate-fade-in-up origin-top-right">
                    <div class="px-4 py-2 text-xs text-gray-500 md:hidden">
                        Logged in as <span class="font-bold text-gray-800"><?= $usernm ?></span>
                    </div>
                    <ul class="py-1 text-sm text-gray-700">
                        <li>
                            <a href="@if ($user->roleid == 1) {{ route('admin_profile') }} @elseif ($user->roleid == 2) {{ route('penjual_profile') }} @elseif ($user->roleid == 3) {{ route('user_profile') }} @endif"
                                class="block px-4 py-2 hover:bg-green-50 hover:text-[#2E973E]">
                                <i class="fa-regular fa-user w-4 mr-1"></i> Profil
                            </a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                            class="open-confirm-modal block px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                            data-modal-target="global-confirm-modal" data-modal-toggle="global-confirm-modal"
                            data-url="{{ route('logout') }}" data-method="GET" data-title="Logout"
                            data-message="Keluar aplikasi?">
                            <i class="fa-solid fa-power-off w-4 mr-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
