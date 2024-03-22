document.addEventListener('DOMContentLoaded', function() {
    const menu = document.querySelector('.menu');
    const openMenuContainer = document.querySelector('.open-menu-container');
    const closeButton = document.querySelector('.close-button');

    menu.addEventListener('click', function() {
        openMenuContainer.style.display = (openMenuContainer.style.display === 'block') ? 'none' : 'block';
    });

    closeButton.addEventListener('click', function() {
        openMenuContainer.style.display = 'none';
    });
});