<script>
    import { useForm, router } from "@inertiajs/svelte";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.svelte";
    import Modal from "@/Components/Modal.svelte";

    // Props
    const { products } = $props();

    // Data
    let showModal = $state(false)
    const form = useForm({
        title: null,
        description: null,
        price: 0,
        stock: 0
    })
    // [...new Array(length_to_populate_to)].map((_, i) => (i+1)) // In case you need to populate an array with numbers

    // Methods

    const openCreate = () => {
        showModal = true
    }
    const handleSubmit = () => {
        $form.post('/products', {
            preserveScroll: true,
            onSuccess: () => {
                showModal = false
                $form.reset()
            },
        })
    }

    const hideModal = () => {
        showModal = false
    }

    const goToLink = (url) => {
        if (url) {
            router.visit(url)
        }
    }
</script>
<AuthenticatedLayout>
    <h1 class="text-2xl font-semibold">Products {showModal}</h1>
    <div class="flex justify-end mt-4">
        <button class="btn btn-success" on:click="{openCreate}">
            Create
        </button>
    </div>

    <div class="mx-4">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody>
                {#each products.data as product}
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img
                                            src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                            alt="Avatar Tailwind CSS Component" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{product.title}</div>
                                    <div class="text-sm opacity-50">{product.description}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-bold">
                                {product.price}
                            </div>
                        </td>
                        <td>
                            <input type="number" name="stock" class="input" bind:value={product.stock}>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4">
            <div class="join">
                {#each products.links as link }
                    <input
                        class="join-item btn btn-square"
                        type="radio"
                        name="options"
                        aria-label="{link.label}"
                        checked={link.active}
                        disabled={link.active || link.url == null}
                        on:click="{() => goToLink(link.url)}"
                    />
                {/each}
            </div>
        </div>
    </div>

    <Modal bind:showModal>
        {#snippet header()}
        <h2>
            Create new product
            <button on:click={hideModal} >close</button>
        </h2>
        <hr>
        {/snippet}

        <h2 class="text-lg">
            <form on:submit|preventDefault="{handleSubmit}" class="my-3">
                <div>
                    <label for="title">Title</label>

                    <input
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        bind:value="{$form.title}"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <!-- TODO: become a component -->
                    {#if $form.errors.title}
                        <div class="mt-2 text-error" :message="" > { $form.errors.title } </div>
                    {/if}
                </div>
                <div>
                    <label for="description" >Description</label>

                    <input
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        bind:value="{$form.description}"
                        autofocus
                        autocomplete="username"
                    />

                    <!-- TODO: become a component -->
                    {#if $form.errors.description}
                        <div class="mt-2 text-error" :message="" > { $form.errors.description } </div>
                    {/if}
                </div>

                <div class="mt-4">
                    <label for="price"  >Price</label>

                    <input
                        id="price"
                        type="number"
                        class="mt-1 block w-full"
                        bind:value="{$form.price}"
                        required
                    />
                    {#if $form.errors.price}
                        <div class="mt-2 text-error" :message="" >{$form.errors.price}</div>
                    {/if}
                </div>

                <div class="mt-4">
                    <label for="stock" >Stock</label>

                    <input
                        id="stock"
                        type="number"
                        class="mt-1 block w-full"
                        bind:value="{$form.stock}"
                        required
                        autocomplete="current-password"
                    />
                    {#if $form.errors.stock}
                        <div class="mt-2 text-error" :message="" >{$form.errors.stock}</div>
                    {/if}
                </div>

                <div class="mt-4 flex items-center justify-end">

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
        </h2>

    </Modal>

</AuthenticatedLayout>
