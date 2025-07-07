<div class="h-screen flex sticky top-0 left-0 z-999">
    <aside class="bg-gradient-to-b from-sky-600 to-indigo-900 w-54 flex flex-col space-y-1">
        <div class="text-white text-3xl mt-4 pl-6 font-bold mb-8">R. DOSEN</div>

        @if (Request::is('admin*') || Request::is('author*'))
            <a href="{{ url('/admin') }}"
                class="{{ Request::is('admin') && !Request::is('admin/*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-gauge text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">Dashboard</span></a>
        @elseif (Request::is('user*'))
            <a href="{{ url('/user/home') }}"
                class="{{ Request::is('user/home*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-house text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">Home</span></a>
        @endif

        @if (Request::is('admin*'))
            <div class="text-xs text-white pl-8 border-t-1 border-white/50">Area Admin</div>
            <a href="{{ url('/admin/content') }}"
                class="{{ Request::is('admin/content*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-list text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">Content</span></a>
            <a href="{{ url('/admin/course') }}"
                class="{{ Request::is('admin/course*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-book-open-reader  text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">Course</span></a>
            <a href="{{ url('/admin/users') }}"
                class="{{ Request::is('admin/users*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-users-gear text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">User</span></a>
        @endif

        @if (Request::is('admin*'))
            <div class="text-xs text-white pl-8 mt-4 border-t-1 border-white/50">Area Saya</div>
            <a href="{{ url('/admin/mycontent') }}"
                class="{{ Request::is('admin/mycontent*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-sheet-plastic text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Content</span></a>
            <a href="{{ url('/admin/mycourse') }}"
                class="{{ Request::is('admin/mycourse*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-book text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Course</span></a>
            <a href="{{ url('/admin/myparticipant') }}"
                class="{{ Request::is('admin/myparticipant*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-user-gear text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Participant</span></a>
            <a href="{{ url('/admin/myprofile') }}"
                class="{{ Request::is('author/myprofile*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-user text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Profile</span></a>
        @endif

        @if (Request::is('author*'))
            <div class="text-xs text-white pl-8 mt-4 border-t-1 border-white/50">Area Saya</div>
            <a href="{{ url('/author/content') }}"
                class="{{ Request::is('author/content*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-sheet-plastic text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Content</span></a>
            <a href="{{ url('/author/course') }}"
                class="{{ Request::is('author/course*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-book text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Course</span></a>
            <a href="{{ url('/author/myparticipant') }}"
                class="{{ Request::is('author/myparticipant*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-user-gear text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Participant</span></a>
            <a href="{{ url('/author/myprofile') }}"
                class="{{ Request::is('author/myprofile*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-user text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Profile</span></a>
        @endif

        @if (Request::is('user*'))
            <div class="text-xs text-white pl-8 border-t-1 border-white/50"></div>
            <a href="{{ url('/user/course') }}"
                class="{{ Request::is('user/course*') && !Request::is('user/mycourse*') && request('from') != 'my-course' ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-book-open-reader  text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">Courses</span></a>
            <a href="{{ url('/user/mycourse') }}"
                class="{{ Request::is('user/mycourse*') || (Request::is('user/course*') && request('from') == 'my-course') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-book text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Course</span></a>
            <a href="{{ url('/user/history') }}"
                class="{{ Request::is('user/history*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fa-solid fa-clock-rotate-left text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">History</span></a>
            <a href="{{ url('/user/profile') }}"
                class="{{ Request::is('user/profile*') ? 'border-white bg-white/20 shadow-lg' : 'border-white/30 hover:inset-shadow-sm inset-shadow-black/20' }} ml-6 p-2 mr-2 rounded-lg border-l-8 hover:border-white hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-user text-white pl-1"></i>
                <span class="text-white pl-1 font-semibold text-20">My Profile</span></a>
        @endif

        <div class="p-4 mt-auto">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2 justify-center rounded-lg text-white bg-white/10 shadow-lg hover:bg-white/30 space-x-2 cursor-pointer transition-all duration-200">
                    <i class="fas fa-sign-out-alt text-white pl-1 fa-fw"></i>
                    <span class="font-bold text-20">Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>