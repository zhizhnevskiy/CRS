const header = document.querySelector('.header');
const headerOverlay = document.querySelector('.header-overlay');
const burgerMenu = header.querySelector('.burger-menu');
const navItemsWithHiddenList = header.querySelectorAll('.with-hidden-list');
let isAdded = false;

if (document.body.clientWidth < 1400) {
  navItemsWithHiddenList.forEach((navItem) => {
    navItem.querySelector('.nav-link').addEventListener('click', (event) => {
      toggleClassOnHiddenList(event, navItem);
    });
  });
  isAdded = true;
}

const listener = (event) => {
  toggleClassOnHiddenList(event, navItem);
};

window.addEventListener('resize', (e) => {
  if (document.body.clientWidth < 1400 && !isAdded) {
    navItemsWithHiddenList.forEach((navItem) => {
      navItem.querySelector('.nav-link').addEventListener('click', listener);
    });
  } else {
    navItemsWithHiddenList.forEach((navItem) => {
      navItem.querySelector('.nav-link').removeEventListener('click', listener);
    });
  }
});

burgerMenu.addEventListener('click', toggleBurgerMenu);

headerOverlay.addEventListener('click', () => {
  burgerMenu.classList.remove('open');
  headerOverlay.classList.remove('show');
  document.body.style.overflow = 'auto';
});

function toggleClassOnHiddenList(event, navItem) {
  const hiddenList = navItem.querySelector('.hidden-list');
  if (hiddenList.classList.contains('open')) {
    hiddenList.classList.remove('open');
  } else {
    event.preventDefault();
    hiddenList.classList.add('open');
  }
}

function toggleBurgerMenu(event) {
  event.preventDefault();
  if (burgerMenu.classList.contains('open')) {
    burgerMenu.classList.remove('open');
    headerOverlay.classList.remove('show');
    document.body.style.overflow = 'auto';
  } else {
    burgerMenu.classList.add('open');
    headerOverlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }
}

(function () {
  var header = document.getElementById('header');
  var headerHeight = header.getBoundingClientRect().height;

  // The debounce function receives our function as a parameter
  const debounce = (fn) => {
    // This holds the requestAnimationFrame reference, so we can cancel it if we wish
    let frame;

    // The debounce function returns a new function that can receive a variable number of arguments
    return (...params) => {
      // If the frame variable has been defined, clear it now, and queue for next frame
      if (frame) {
        cancelAnimationFrame(frame);
      }

      // Queue our function call for the next frame
      frame = requestAnimationFrame(() => {
        // Call our function and pass any params we received
        fn(...params);
      });
    };
  };

  // Reads out the scroll position and stores it in the data attribute
  // so we can use it in our stylesheets
  const storeScroll = () => {
    document.documentElement.dataset.scroll = window.scrollY;

    let showSticky = Math.abs(document.documentElement.getBoundingClientRect().top) > headerHeight + 50;

    if (showSticky) {
      document.documentElement.dataset.stickyHeader = 'yes';
      header.classList.add('sticky', 'animate__animated', 'animate__fadeInDown');
      headerHeight = header.getBoundingClientRect().height;
    } else {
      header.classList.remove('sticky', 'animate__animated', 'animate__fadeInDown');
      headerHeight = header.getBoundingClientRect().height;
    }
  };

  // Listen for new scroll events, here we debounce our `storeScroll` function
  document.addEventListener('scroll', debounce(storeScroll), { passive: true });

  // Update scroll position for first time
  storeScroll();
})();
