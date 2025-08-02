<flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>
    <flux:brand href="{{ route('home') }}"
                logo="https://fluxui.dev/img/demo/logo.png"
                name="Legal"
                class="px-4 py-4"/>

    <flux:separator vertical variant="subtle" class="my-4"/>

    <flux:navlist variant="outline">
        <flux:navlist.item href="{{ route('home') }}">Нүүр</flux:navlist.item>
        <flux:navlist.item href="{{ route('lawyers') }}">Хуульчид</flux:navlist.item>
        <flux:navlist.item href="{{ route('explanations') }}">Гэж Юу Вэ?</flux:navlist.item>
        <flux:navlist.item href="{{route('quizzes')}}">Хуулийн сорил</flux:navlist.item>
        <flux:navlist.item href="{{ route('chat') }}">AI Чат</flux:navlist.item>
    </flux:navlist>

    <flux:separator vertical variant="subtle" class="my-4"/>

    @if(Auth::check())
        <flux:navlist variant="outline">
            <flux:navlist.item href="{{ route('settings.profile') }}" icon="cog">
                Settings
            </flux:navlist.item>
            <flux:navlist.item as="form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-9V5m0 4h8" />
                    </svg>
                    Log Out
                </button>
            </flux:navlist.item>
        </flux:navlist>
    @else
        <div class="px-4 py-2">
            <flux:button variant="primary"
                         href="{{ route('login') }}"
                         icon:trailing="sparkles"
                         class="w-full">
                Нэвтрэх
            </flux:button>
        </div>
    @endif
</flux:sidebar>
