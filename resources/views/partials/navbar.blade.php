<div class="bg-nav"></div>
<div class="navbar">
    <a href="{{ route('home') }}" class="home">
        <i data-feather="home"
            style="stroke: {{ Request::is('/') || Request::is('plant*') ? '#b0a1fe' : '#848384' }}; width: 22px"></i>
    </a>
    <a href="{{ route('home') }}" class="home">
        <i data-feather="archive" style="stroke: #848384; width: 22px"></i>
    </a>
    <a href="{{ route('home') }}" class="home">
        <i data-feather="settings" style="stroke: #848384; width: 22px"></i>
    </a>
</div>
