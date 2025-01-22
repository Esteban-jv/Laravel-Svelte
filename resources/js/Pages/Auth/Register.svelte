<script>
    import { Link, useForm } from "@inertiajs/svelte";

    // TODO: Do this dynamically
    const canResetPassword = false

    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        remember: false,
    })

    const handleLogin = e => {
        $form.post('/register', {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
</script>
<form on:submit|preventDefault="{handleLogin}">
    <div>
        <label for="email" value="Email" />

        <input
            id="name"
            type="text"
            class="mt-1 block w-full"
            bind:value="{$form.name}"
            required
            autofocus
            autocomplete="username"
        />

        <!-- TODO: become a component -->
        {#if $form.errors.name}
            <div class="mt-2" :message="" > { $form.errors.name } </div>
        {/if}
    </div>
    <div>
        <label for="email" value="Email" />

        <input
            id="email"
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
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            bind:value="{$form.password_confirmation}"
            required
            autocomplete="current-password"
        />
        {#if $form.errors.password}
            <div class="mt-2" :message="" >{$form.errors.password}</div>
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
                :href="route('login')"
                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Already have an account?
            </Link>
        {/if}

        <button
            class="btn btn-primary"
            class:opacity-25="{ $form.processing }"
            disabled="{$form.processing}"
            type="submit"
        >
            Register
        </button>
    </div>
</form>

