import { SlashProvider } from "@milkdown/plugin-slash";

const htmlMarkup = `
<div x-transition:enter-start="opacity-0" x-transition:leave-end="opacity-0" class="slash-menu fi-dropdown-panel z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10 !max-w-[14rem]">
    <div class="fi-dropdown-list p-1">
        <button style=";" class="fi-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 fi-dropdown-list-item-color-gray fi-color-gray" type="button" wire:loading.attr="disabled" wire:target="openViewModal" wire:click="openViewModal">
            <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="animate-spin fi-dropdown-list-item-icon h-5 w-5 text-gray-400 dark:text-gray-500" style=";" wire:loading.delay.default="" wire:target="openViewModal">
                <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
            </svg>
            <span class="fi-dropdown-list-item-label flex-1 truncate text-start text-gray-700 dark:text-gray-200" style="">
                View
            </span>
        </button>
    </div>
</div>
`;

export function slashPluginView(view) {
  const content = document.createElement("div");
  content.innerHTML = htmlMarkup;

  const provider = new SlashProvider({
    content,
  });

  return {
    update: (updatedView, prevState) => {
      provider.update(updatedView, prevState);
    },
    destroy: () => {
      provider.destroy();
      content.remove();
    },
  };
}
