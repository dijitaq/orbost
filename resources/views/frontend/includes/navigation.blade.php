<ul class="navigation {{ $class }}">
    <li class="mt-nav {{ Request::is('listings/buy') ? 'active' : '' }}">
        <a href="{{ url('listings/buy') }}" class="text-sm text-black px-3 pt-5 pb-6 block">BUY</a>
    </li>

    <li class="mt-nav {{ Request::is('listings/rent') ? 'active' : '' }}">
        <a href="{{ url('listings/rent') }}" class="text-sm text-black px-3 pt-5 pb-6 block">RENT</a>
    </li>

    <li class="mt-nav {{ Request::is('sell') ? 'active' : '' }}">
        <a href="{{ route('sell') }}" class="text-sm text-black px-3 pt-5 pb-6 block">SELL</a>
    </li>

    <li class="mt-nav {{ Request::is('about') ? 'active' : '' }}">
        <a href="{{ route('about') }}" class="text-sm text-black px-3 pt-5 pb-6 block">ABOUT US</a>
    </li>

    <li class="mt-nav {{ Request::is('make-it-a-tree-change') ? 'active' : '' }}">
        <a href="{{ route('make-it-a-tree-change') }}" class="text-sm text-black px-3 pt-5 pb-6 block">MAKE IT A TREE CHANGE</a>
    </li>

    <li class="mt-nav {{ Request::is('contact') ? 'active' : '' }}">
        <a href="{{ route('contact') }}" class="text-sm text-black px-3 pt-5 pb-6 block">CONTACT</a>
    </li>
</ul>