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

    // Methods

    const openCreate = () => {
        showModal = true
    }
    const handleSubmit = () => {
        $form.post('/products', {
            onSuccess: () => {
                showModal = false
                form.reset()
                router.push('/products')
            }
        })
    }
</script>
<AuthenticatedLayout>
    <h1 class="text-2xl font-semibold">Products</h1>
    <div class="flex justify-end mt-4">
        <button class="btn btn-success" on:click="{openCreate}">
            Create
        </button>
    </div>

    <div class="p">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stocl</th>
                </tr>
                </thead>
                <tbody>
                {#each products as product}
                    <tr>
                        <th>{product.id}</th>
                        <td>{product.title}</td>
                        <td>{product.description}</td>
                        <td>{product.price}</td>
                        <td>{product.stock}</td>
                    </tr>
                {/each}
                </tbody>
            </table>
        </div>
    </div>

    <Modal bind:showModal>
        {#snippet header()}
        <h2>
            Create new product
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
