document.querySelector('#openSidebar').addEventListener('click', () => {
    document.querySelector('.sidebar').classList.add('dynamic-width');
})

document.querySelector('#closeSidebar').addEventListener('click', () => {
    document.querySelector('.sidebar').classList.remove('dynamic-width');
})