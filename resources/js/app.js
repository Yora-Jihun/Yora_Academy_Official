import hljs from 'highlight.js/lib/common';

const LANG_COLORS = {
    php: '#777BB4',
    javascript: '#E8A100',
    js: '#E8A100',
    typescript: '#3178C6',
    ts: '#3178C6',
    python: '#3776AB',
    py: '#3776AB',
    bash: '#4EAA25',
    sh: '#4EAA25',
    shell: '#4EAA25',
    json: '#C9A227',
    html: '#E34F26',
    xml: '#E34F26',
    css: '#1572B6',
    sql: '#E38C00',
    java: '#E76F00',
    c: '#6B7C93',
    cpp: '#00599C',
    'c++': '#00599C',
    csharp: '#68217A',
    cs: '#68217A',
    go: '#00ADD8',
    rust: '#C45508',
    ruby: '#CC342D',
    markdown: '#2563EB',
    md: '#2563EB',
    yaml: '#CB171E',
    yml: '#CB171E',
    dockerfile: '#2496ED',
    git: '#F05032',
    powershell: '#012456',
    swift: '#FA7343',
    kotlin: '#7F52FF',
    scala: '#DC322F',
    lua: '#1B3B8C',
    r: '#276DC3',
    plaintext: '#6B7280',
    text: '#6B7280',
    none: '#6B7280',
};

const LANG_LABELS = {
    php: 'PHP',
    javascript: 'JavaScript',
    js: 'JavaScript',
    typescript: 'TypeScript',
    ts: 'TypeScript',
    python: 'Python',
    py: 'Python',
    bash: 'Bash',
    sh: 'Shell',
    shell: 'Shell',
    json: 'JSON',
    html: 'HTML',
    xml: 'XML',
    css: 'CSS',
    sql: 'SQL',
    java: 'Java',
    c: 'C',
    cpp: 'C++',
    'c++': 'C++',
    csharp: 'C#',
    cs: 'C#',
    go: 'Go',
    rust: 'Rust',
    ruby: 'Ruby',
    markdown: 'Markdown',
    md: 'Markdown',
    yaml: 'YAML',
    yml: 'YAML',
    dockerfile: 'Docker',
    git: 'Git',
    powershell: 'PowerShell',
    swift: 'Swift',
    kotlin: 'Kotlin',
    scala: 'Scala',
    lua: 'Lua',
    r: 'R',
    plaintext: 'Text',
    text: 'Text',
    none: 'Text',
};

function langOf(codeEl) {
    const m = (codeEl.className || '').match(/language-([\w-]+)/);
    return m ? m[1].toLowerCase() : 'plaintext';
}

function buildCodeToolbar(pre, block) {
    const lang = langOf(block);
    const accent = LANG_COLORS[lang] || '#5B5FEF';
    pre.style.setProperty('--code-accent', accent);
    pre.classList.add('code-block');

    const editable = !!(pre.closest('#pageContent') && pre.closest('#pageContent').getAttribute('contenteditable') === 'true');

    const bar = document.createElement('div');
    bar.className = 'code-actions';

    const label = document.createElement('span');
    label.className = 'code-lang';
    label.textContent = LANG_LABELS[lang] || lang.toUpperCase();
    bar.appendChild(label);

    const copyBtn = document.createElement('button');
    copyBtn.type = 'button';
    copyBtn.className = 'code-copy';
    copyBtn.textContent = 'Copy';
    copyBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(block.textContent).then(() => {
            copyBtn.textContent = 'Copied';
            setTimeout(() => (copyBtn.textContent = 'Copy'), 1500);
        });
    });
    bar.appendChild(copyBtn);

    if (editable) {
        pre.setAttribute('contenteditable', 'false');
        pre.classList.add('code-block-locked');

        const editBtn = document.createElement('button');
        editBtn.type = 'button';
        editBtn.className = 'code-edit';
        editBtn.textContent = 'Edit';
        editBtn.addEventListener('click', () => {
            window.dispatchEvent(new CustomEvent('code:edit', { detail: { pre } }));
        });
        bar.appendChild(editBtn);

        const delBtn = document.createElement('button');
        delBtn.type = 'button';
        delBtn.className = 'code-delete';
        delBtn.textContent = 'Delete';
        delBtn.addEventListener('click', () => {
            if (window.confirm('Delete this code block?')) {
                window.dispatchEvent(new CustomEvent('code:delete', { detail: { pre } }));
            }
        });
        bar.appendChild(delBtn);
    }

    pre.appendChild(bar);
}

function highlightDocs(root = document) {
    root.querySelectorAll('pre code').forEach((block) => {
        const pre = block.parentElement;
        if (!pre) return;

        if (!block.dataset.highlighted) {
            try {
                hljs.highlightElement(block);
            } catch (e) {
                return;
            }
        }

        if (pre && !pre.querySelector('.code-actions')) {
            buildCodeToolbar(pre, block);
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
