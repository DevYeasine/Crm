{{-- <header class="admin-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <!-- Logo/Brand - Now first on the left -->
            <a class="navbar-brand d-flex align-items-center" href="{{ asset('./index.html') }}">
                <img src="{{ asset('/assets/images/logo.svg') }}"
                    alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
            </a>

            <!-- Search Bar with Alpine.js -->
            <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                <div class="position-relative">
                    <input type="search" 
                            class="form-control" 
                            placeholder="Search... (Ctrl+K)"
                            x-model="query"
                            @input="search()"
                            data-search-input
                            aria-label="Search">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    
                    <!-- Search Results Dropdown -->
                    <div x-show="results.length > 0" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                        <template x-for="result in results" :key="result.title">
                            <a :href="{{ asset('result.url') }}" class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-2 text-muted"></i>
                                    <span x-text="result.title"></span>
                                    <small class="ms-auto text-muted" x-text="result.type"></small>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Right Side Icons -->
            <div class="navbar-nav flex-row">
                <!-- Theme Toggle with Alpine.js -->
                <div x-data="themeSwitch">
                    <button class="btn btn-outline-secondary me-2" 
                            type="button" 
                            @click="toggle()"
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom"
                            title="Toggle theme">
                        <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                        <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                    </button>
                </div>

                <!-- Fullscreen Toggle -->
                <button class="btn btn-outline-secondary me-2" 
                        type="button" 
                        data-fullscreen-toggle
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        title="Toggle fullscreen">
                    <i class="bi bi-arrows-fullscreen icon-hover"></i>
                </button>

                <!-- Notifications -->
                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary position-relative" 
                            type="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="{{ asset('#') }}">New user registered</a></li>
                        <li><a class="dropdown-item" href="{{ asset('#') }}">Server status update</a></li>
                        <li><a class="dropdown-item" href="{{ asset('#') }}">New message received</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="{{ asset('#') }}">View all notifications</a></li>
                    </ul>
                </div>

                <!-- User Menu -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary d-flex align-items-center" 
                            type="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        <img src="{{ asset('/assets/images/avatar-placeholder.svg') }}"

                                alt="User Avatar" 
                                width="24" 
                                height="24" 
                                class="rounded-circle me-2">
                        <span class="d-none d-md-inline">John Doe</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ asset('#') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="{{ asset('#') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ asset('#') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header> --}}

<header class="admin-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <!-- Logo/Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('/assets/images/logo.svg') }}" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
            </a>

            <!-- Search Bar -->
            <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                <div class="position-relative">
                    <input type="search" class="form-control" placeholder="Search... (Ctrl+K)" x-model="query" @input="search()" data-search-input>
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>

                    <!-- Search Results -->
                    <div x-show="results.length > 0" class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                        <template x-for="result in results" :key="result.title">
                            <a :href="result.url" class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-2 text-muted"></i>
                                    <span x-text="result.title"></span>
                                    <small class="ms-auto text-muted" x-text="result.type"></small>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Right Side Icons & Dropdowns -->
            <div class="navbar-nav flex-row align-items-center">

                <!-- Theme Toggle -->
                <div x-data="themeSwitch" class="me-2">
                    <button class="btn btn-outline-secondary" type="button" @click="toggle()" data-bs-toggle="tooltip" title="Toggle theme">
                        <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                        <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                    </button>
                </div>

                <!-- Fullscreen -->
                <button class="btn btn-outline-secondary me-2" type="button" data-fullscreen-toggle data-bs-toggle="tooltip" title="Toggle fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                <!-- Notifications -->
                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">New user registered</a></li>
                        <li><a class="dropdown-item" href="#">Server status update</a></li>
                        <li><a class="dropdown-item" href="#">New message received</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                    </ul>
                </div>

                <!-- Team Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->currentTeam->name }}
                            <i class="bi bi-chevron-down ms-1"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><strong class="dropdown-header">Manage Team</strong></li>
                            <li><a class="dropdown-item" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">Team Settings</a></li>
                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <li><a class="dropdown-item" href="{{ route('teams.create') }}">Create New Team</a></li>
                            @endcan
                            @if(Auth::user()->allTeams()->count() > 1)
                                <li><hr class="dropdown-divider"></li>
                                <li><strong class="dropdown-header">Switch Teams</strong></li>
                                @foreach(Auth::user()->allTeams() as $team)
                                    <li>
                                        <form method="POST" action="{{ route('current-team.update') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="team_id" value="{{ $team->id }}">
                                            <button type="submit" class="dropdown-item">{{ $team->name }}</button>
                                        </form>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endif

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" width="24" height="24">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        @if(Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <li><a class="dropdown-item" href="{{ route('api-tokens.index') }}">API Tokens</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
</header>
