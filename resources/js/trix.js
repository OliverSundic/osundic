document.addEventListener('trix-initialize', function(event) {
    const content = event.target.editor.element.dataset.initialValue;
    if(content) {
        event.target.editor.loadHTML(content);
    }
});