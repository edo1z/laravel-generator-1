<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('posts.index') }}" class="nav-link {{ Request::is('posts*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Posts</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('authors.index') }}" class="nav-link {{ Request::is('authors*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Authors</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('tags.index') }}" class="nav-link {{ Request::is('tags*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tags</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('comments.index') }}" class="nav-link {{ Request::is('comments*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Comments</p>
    </a>
</li>
