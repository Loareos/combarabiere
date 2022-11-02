function addPrice(e){
    const collectionHolder = e.closest('.pricings');
    const item = document.createElement('div');
    item.className = 'price-row';
    item.innerHTML = collectionHolder.dataset.prototype.replace(/__pricing__/g, collectionHolder.dataset.index);
    collectionHolder.insertBefore(item, e);
    collectionHolder.dataset.index++;
}