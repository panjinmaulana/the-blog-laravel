<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                {{-- alternatif menandakan tab active --}}
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                {{-- tanda '*' itu adalah sebuah wildcard, supaya dari setelahnya tetap akan dibaca --}}
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    My Posts
                </a>
            </li>
        </ul>

        {{-- untuk menghilangkan tab category dari admin, karena sudah di handle oleh gate authorization --}}
        @can('admin')
            {{-- Administrator --}}
            <h6 class="siderbar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Administrator</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                        <span data-feather="grid" class="align-text-bottom"></span>
                        Post Categories
                    </a>
                </li>
            </ul>
        @endcan

    </div>
</nav>