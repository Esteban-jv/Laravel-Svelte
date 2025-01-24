<script>
    // Props
    let { showModal = $bindable(), header, children } = $props() // destructuring props

    // Data
    let dialog = $state(); // HtmlDialogElement

    // Watchers
    $effect(() => {
        if (showModal) dialog.showModal();
        else dialog.close();
    })
</script>

<dialog
    class="rounded-box shadow-md base-content"
    bind:this={dialog}
    onclose={() => (showModal = false)}
    onclick={ e => { if (e.target === dialog) dialog.close(); } }
    onkeyup="{e => { if (e.key === 'Escape') dialog.close(); }}"
>
    <div class="min-w-[400px] p-2">
        {@render header?.() }

        {@render children?.() }
        <hr>
        <div class="flex justify-end mt-3">
            <!-- Svelte ifnore autofocus? -->
            <button class="btn btn-ghost"
                    onclick={() => dialog.close() }
            >
                Close
            </button>
        </div>
    </div>
</dialog>

<style>
    dialog {
        border-radius: 0.2em;
        border: none;
        padding: 0;
    }
    dialog::backdrop {
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(2px);
    }
    dialog[open] {
        animation: zoom 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes zoom {
        from {
            transform: scale(0.75);
        }
        to {
            transform: scale(1);
        }
    }
    dialog[open]::backdrop {
        animation: fade 0.2s ease-out;
    }
    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    button {
        display: block;
    }
</style>
