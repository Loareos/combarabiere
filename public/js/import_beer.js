function addType(e){
    const collectionHolder = e.closest('.types');
    const item = document.createElement('div');
    item.className = 'type-row';
    item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    collectionHolder.insertBefore(item, e);
    collectionHolder.dataset.index++;
}