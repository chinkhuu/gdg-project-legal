<flux:header container
             class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 flex items-center">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <flux:brand href="{{route('home')}}" logo="https://fluxui.dev/img/demo/logo.png" name="Legal"
                class="max-lg:hidden dark:hidden"/>
    <flux:separator vertical variant="subtle" class="my-4 mx-3"/>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item href="{{route('home')}}">Нүүр</flux:navbar.item>

        <flux:navbar.item href="{{route('lawyers')}}">Хуульчид</flux:navbar.item>
        <flux:navbar.item href="{{route('explanations')}}">Гэж Юу Вэ?</flux:navbar.item>
        <flux:navbar.item href="{{route('quizzes')}}">Хуулийн сорил</flux:navbar.item>
        <flux:navbar.item href="{{route('chat')}}">AI Чат</flux:navbar.item>
        <flux:navbar.item href="#">Кейс тохиолдлууд</flux:navbar.item>

        <flux:dropdown>
            <flux:navbar.item icon:trailing="chevron-down">Coming Soon</flux:navbar.item>
            <flux:navmenu>
                <flux:navbar.item href="#">Хуульчид зөвлөж байна</flux:navbar.item>
                <flux:navbar.item href="#">Түгээмэл асуул</flux:navbar.item>
                <flux:navbar.item href="#">Гомдпол санал</flux:navbar.item>
                <flux:navbar.item href="#">Зөвлөгөөний цаг захиалга</flux:navbar.item>
                <flux:navbar.item href="#">Үнэгүй өмгөөлөл</flux:navbar.item>

            </flux:navmenu>
        </flux:dropdown>

    </flux:navbar>

    <flux:spacer/>
{{--    <div--}}
{{--        class="rounded-full bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-500 p-1 flex items-center p-1 pr-2.5 gap-2">--}}
{{--        <div class="relative rounded-full size-6">--}}
{{--            <img src="https://fluxui.dev/img/demo/prime.png" class="size-full rounded-full"/>--}}
{{--            <div--}}
{{--                class="absolute -bottom-px -right-px rounded-full size-2 border-2 border-red-50 dark:border-red-950 bg-red-600 dark:bg-red-500"></div>--}}
{{--        </div>--}}
{{--        <div class="text-sm font-medium text-red-600 dark:text-white">Live</div>--}}
{{--    </div>--}}
    <flux:separator vertical variant="subtle" class="my-4 mx-3"/>


    @if(\Illuminate\Support\Facades\Auth::check())
        <flux:dropdown position="top" align="end">
            <flux:profile class="cursor-pointer" avatar="https://fluxui.dev/img/demo/teej.png"/>
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <flux:avatar src="https://fluxui.dev/img/demo/teej.png" size="sm" class="shrink-0"/>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <flux:menu.radio.group>
                    <flux:menu.item href="{{route('settings.profile')}}" icon="cog">Settings</flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator/>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>

            </flux:menu>
        </flux:dropdown>
    @else
        <flux:button variant="primary" href="{{route('login')}}" icon:trailing="sparkles">Нэвтрэх</flux:button>
    @endif

</flux:header>
