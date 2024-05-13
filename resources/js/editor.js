import { Editor, rootCtx, defaultValueCtx } from "@milkdown/core";
import { listener, listenerCtx } from "@milkdown/plugin-listener";
import { commonmark } from "@milkdown/preset-commonmark";
import { gfm } from "@milkdown/preset-gfm";
import { history } from "@milkdown/plugin-history";
import { clipboard } from "@milkdown/plugin-clipboard";
import { listItemBlockComponent } from "@milkdown/components/list-item-block";
import { slashFactory } from "@milkdown/plugin-slash";
import { slashPluginView } from "./slash";

const slash = slashFactory("editor-slash");

export default function editor({ state }) {
  return {
    state,
    init: function () {
      Editor.make()
        .config((ctx) => {
          ctx.set(rootCtx, "#editor");
          ctx.set(defaultValueCtx, this.state);
          ctx.set(slash.key, {
            view: slashPluginView,
          });
          ctx
            .get(listenerCtx)
            .markdownUpdated((ctx, markdown, prevMarkdown) => {
              this.state = markdown;
            });
        })
        .use(commonmark)
        .use(gfm)
        .use(listItemBlockComponent)
        .use(history)
        .use(clipboard)
        .use(slash)
        .use(listener)
        .create();
    },
  };
}
