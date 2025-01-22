<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import { Link } from '@inertiajs/svelte';
</script>

<div class="navbar bg-base-300 shadow-sm">
    <div class="flex-1">
        <ApplicationLogo />
    </div>
    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img
                        alt="Tailwind CSS Navbar component"
                        src="https://th.bing.com/th/id/OIP.lvzPu-WOW4Iv7QyjP-IkrgHaHa?rs=1&pid=ImgDetMain" />
                </div>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-300 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><Link
                    href="/login"
                    as="button"
                >Log in</Link ></li>
                <li>
                    <Link
                        href="/register"
                        as="button"
                    >Register</Link>
                </li>
            </ul>
        </div>
    </div>
</div>
<main class="p-4">
    <slot></slot>
</main>
