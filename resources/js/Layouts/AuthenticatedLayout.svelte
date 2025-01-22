<script>
    import { page, Link } from '@inertiajs/svelte'
    import ApplicationLogo from "@/Components/ApplicationLogo.svelte";
</script>

<div class="navbar bg-base-300 shadow-sm">
    <div class="flex-1">
        <ApplicationLogo class="block h-9 w-9 w-auto fill-current text-gray-800" />
    </div>
    <div class="flex-1">
        <Link href="{route('products.index')}" class="btn btn-ghost">Products</Link>
    </div>
    <div class="flex-1">
        <a class="btn btn-ghost">Cart</a>
    </div>
    <div class="flex-none gap-2">
        <div class="form-control">
            <h2>{$page.props.auth.user.name}</h2>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img
                        alt="Tailwind CSS Navbar component"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-300 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li>
                    <a class="justify-between">
                        Profile
                        <span class="badge">New</span>
                    </a>
                </li>
                <li><a>Settings</a></li>
                <li><Link
                    href="/logout"
                    method="post"
                    as="button"
                >Logout</Link ></li>
            </ul>
        </div>
    </div>
</div>
<main class="p-4">
    <slot></slot>
</main>
