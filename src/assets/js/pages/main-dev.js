import '../modules/equalizer';

document.addEventListener('DOMContentLoaded', () => {
   const $btnMenuOpen = document.querySelector('.mob_menu-open');
   const $btnMenuClose = document.querySelector('.mob_menu-close');
   const $menu = document.querySelector('.mob_menu_content');
   const $overlay = document.querySelector('.overlay');

   $btnMenuOpen.addEventListener('click', () => {
      menuOpen();
   });

   $btnMenuClose.addEventListener('click', () => {
      menuClose();
   });

   $overlay.addEventListener('click', () => {
      menuClose();
   });

   function menuOpen() {
      $menu.classList.add('active');
      $overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
   }

   function menuClose() {
      $menu.classList.remove('active');
      $overlay.classList.remove('active');
      document.body.style.overflow = '';
      document.body.style.overflowX = 'hidden';
   }
});