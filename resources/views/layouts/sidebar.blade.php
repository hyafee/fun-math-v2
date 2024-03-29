<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-700 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="separator-sidebar"
    class="bg-secondary fixed left-0 top-16 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/admin-quiz"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group {{ \Request::route()->getName() == 'admin-quiz' ? '!text-black bg-gray-100' : '' }}">
                    <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75  group-hover:text-green {{ \Request::route()->getName() == 'admin-quiz' ? '!text-green' : '' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ms-3 gray-700space-nowrap">Quiz</span>
                </a>
            </li>
            <li>
                <a href="admin-result-quiz"
                    class="flex items-center p-2 text-white rounded-lg  hover:bg-gray-700 {{ \Request::route()->getName() == 'admin-result-quiz' ? '!text-black bg-gray-100' : '' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75  group-hover:text-green {{ \Request::route()->getName() == 'admin-result-quiz' ? '!text-green' : '' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="flex-1 ms-3 gray-700space-nowrap">Result Quiz</span>
                </a>
            </li>
            <li>
                <a href="admin-all-user"
                    class="flex items-center p-2 text-white rounded-lg  hover:bg-gray-700 {{ \Request::route()->getName() == 'admin-all-user' ? '!text-black bg-gray-100' : '' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75  group-hover:text-green {{ \Request::route()->getName() == 'admin-all-user' ? '!text-green' : '' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 gray-700space-nowrap">Users</span>
                </a>
            </li>

            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
                <li>
                    <a href="profile"
                        class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-gray-700 {{ \Request::route()->getName() == 'profile' ? '!text-black bg-gray-100' : '' }}  group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75  group-hover:text-green {{ \Request::route()->getName() == 'profile' ? '!text-green' : '' }}"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 17 20">
                            <path
                                d="M7.958 19.393a7.7 7.7 0 0 1-6.715-3.439c-2.868-4.832 0-9.376.944-10.654l.091-.122a3.286 3.286 0 0 0 .765-3.288A1 1 0 0 1 4.6.8c.133.1.313.212.525.347A10.451 10.451 0 0 1 10.6 9.3c.5-1.06.772-2.213.8-3.385a1 1 0 0 1 1.592-.758c1.636 1.205 4.638 6.081 2.019 10.441a8.177 8.177 0 0 1-7.053 3.795Z" />
                        </svg>
                        <span class="ms-3">Profile</span>
                    </a>
                </li>
                <li class="text-gray-700 hover:text-black">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                            class="cursor-pointer flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-gray-700  group">
                            <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75  group-hover:text-green"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 20">
                                <path
                                    d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                            </svg>
                            <span class="ms-3">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
    </div>

</aside>
