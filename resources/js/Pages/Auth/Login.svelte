<script>
    import { Link, useForm } from "@inertiajs/svelte";

    // TODO: Do this dynamically
    const canResetPassword = false

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    })

    const handleLogin = e => {
        $form.post('/login')
    }
</script>
<form on:submit|preventDefault="{handleLogin}">
    <div>
        <label for="email" value="Email" />

        <input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            bind:value="{$form.email}"
            required
            autofocus
            autocomplete="username"
        />

        <!-- TODO: become a component -->
        {#if $form.errors.email}
            <div class="mt-2" :message="" > { $form.errors.email } </div>
        {/if}
    </div>

    <div class="mt-4">
        <label for="password" value="Password" />

        <input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-full"
            bind:value="{$form.password}"
            required
            autocomplete="current-password"
        />
        {#if $form.errors.password}
            <div class="mt-2" :message="" >{$form.errors.password}</div>
        {/if}
    </div>

    <div class="mt-4 block">
        <label class="flex items-center">
            <input type="checkbox" bind:checked="{$form.remember}" name="remember" />
            <span class="ms-2 text-sm text-gray-600"
            >Remember me</span
            >
        </label>
    </div>

    <div class="mt-4 flex items-center justify-end">
        {#if canResetPassword }
            <Link
                :href="route('password.request')"
                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Forgot your password?
            </Link>
        {/if}

        <button
            class="btn btn-primary"
            class:opacity-25="{ $form.processing }"
            disabled="{$form.processing}"
            type="submit"
        >
            Log in
        </button>
    </div>
</form>
