wp.domReady( () => {
    // taxonomy-panel-{taxonomy slug} が ID
    wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-category_style');
    wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-category_color');
});
