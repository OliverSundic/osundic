<div class="offcanvas-body">
    <nav class="nav flex-column">
        <!-- Existing links -->
        
        @auth
            <div class="nav-item dropdown">
                <a class="nav-link nav-link-custom dropdown-toggle" 
                   href="#" 
                   role="button" 
                   data-bs-toggle="dropdown"
                >
                    <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="fas fa-user-cog me-2"></i>Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>
</div>