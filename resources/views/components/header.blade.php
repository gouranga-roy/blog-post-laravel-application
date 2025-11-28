<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('blog.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                @if(!Auth::guard('admin')->check())
                <div class="d-flex gap-2">
                    <a href="{{ route('login.create') }}" class="btn btn-dark">Login</a>
                    <a href="{{ route('register.create') }}" class="btn btn-primary">Register</a>
                </div>
                @endif
                @if(Auth::guard('admin')->check())
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-cener" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://placehold.co/30x30" alt="User Avatar" class="rounded-circle me-2">
                        <span>{{ Auth::guard('admin')->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <!-- <div class="d-flex gap-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div> -->
                @endif
            </div>
        </div>
    </nav>
</header>
