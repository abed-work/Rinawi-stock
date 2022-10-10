import './bootstrap';

let removeBtns = document.querySelectorAll('.product-image .remove');
let hiddenDiv = document.querySelector('.hidden');

removeBtns.forEach((removeBtn)=>{
    removeBtn.addEventListener('click',()=>{
        let removedImageId = removeBtn.parentElement.getAttribute('data-image-id');
        let elemet = document.createElement('div');
        let childElement =`<input name='removed_images[]' value='${removedImageId}' />`;
        elemet.innerHTML = childElement;
        hiddenDiv.appendChild(elemet);
        removeBtn.parentElement.remove();
    })
})