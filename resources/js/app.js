import hljs from 'highlight.js/lib/common';

function highlightDocs(root = document) {
    root.querySelectorAll('pre code').forEach((block) => {
        if (block.dataset.highlighted) return;

        try {
            hljs.highlightElement(block);
        } catch (e) {
            return;
        }

        const pre = block.parentElement;
        if (pre && !pre.querySelector('.code-copy')) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'code-copy';
            btn.textContent = 'Copy';
            btn.addEventListener('click', () => {
                navigator.clipboard.writeText(block.textContent).then(() => {
                    btn.textContent = 'Copied';
                    setTimeout(() => (btn.textContent = 'Copy'), 1500);
                });
            });
            pre.appendChild(btn);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => highlightDocs());

// Re-highlight whenever Livewire swaps in new documentation content.
const observer = new MutationObserver(() => {
    if (window.__hljsPending) return;
    window.__hljsPending = true;
    requestAnimationFrame(() => {
        window.__hljsPending = false;
        highlightDocs();
    });
});

observer.observe(document.body, { childList: true, subtree: true });
