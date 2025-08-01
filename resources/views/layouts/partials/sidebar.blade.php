<flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand name="Podium" href="#" class="px-2">
        <div class="flex aspect-square items-center justify-center rounded-md bg-accent text-accent-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mic-vocal">
                <path d="m11 7.601-5.994 8.19a1 1 0 0 0 .1 1.298l.817.818a1 1 0 0 0 1.314.087L15.09 12"/>
                <path d="M16.5 21.174C15.5 20.5 14.372 20 13 20c-2.058 0-3.928 2.356-6 2-2.072-.356-2.775-3.369-1.5-4.5"/>
                <circle cx="16" cy="7" r="5"/>
            </svg>
        </div>
    </flux:brand>
    <flux:navlist variant="outline">
        <flux:navlist.group>
            <flux:navlist.item href="#">Questions</flux:navlist.item>
            <flux:navlist.item href="#">Leaderboard</flux:navlist.item>
            <flux:navlist.item href="#">Announcements</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
    <flux:spacer />
</flux:sidebar>
