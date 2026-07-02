const navToggle = document.getElementById("nav-toggle");
const navMenu = document.getElementById("nav-menu");

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.toggle("show-menu");
    navToggle.classList.toggle("show-icon");
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const dropdownItems = document.querySelectorAll(".dropdown__item");

  dropdownItems.forEach(item => {
    const link = item.querySelector(".nav__link");
    link.addEventListener("click", () => {
      dropdownItems.forEach(i => {
        if (i !== item) i.classList.remove("open");
      });
      item.classList.toggle("open");
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const slider = document.querySelector(".slider");
  const slides = document.querySelectorAll(".slide");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  if (!slider || slides.length === 0 || !prevBtn || !nextBtn) return;

  let currentIndex = 0;
  const totalSlides = slides.length;

  function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
  });

  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSlider();
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
  }, 5000);
});

document.addEventListener("DOMContentLoaded", () => {
  const hero = document.querySelector(".smi-heroLite");
  if (!hero) return;

  const viewport = hero.querySelector(".smi-liteViewport");
  const track = hero.querySelector(".smi-liteTrack");
  const slides = hero.querySelectorAll(".smi-liteSlide");
  const prevBtn = hero.querySelector(".smi-liteBtn.prev");
  const nextBtn = hero.querySelector(".smi-liteBtn.next");
  const dots = hero.querySelector(".smi-liteDots");

  if (!track || !viewport || slides.length === 0) return;

  const getGap = () => {
    const computedGap = getComputedStyle(track).gap || getComputedStyle(track).columnGap || "16px";
    return parseFloat(computedGap);
  };



  const setViewportWidth = () => {
    viewport.style.maxWidth = "100%";
  };

  if (slides.length <= 1) {
    prevBtn?.style.setProperty("display", "none");
    nextBtn?.style.setProperty("display", "none");
    if (dots) dots.innerHTML = "";
    setViewportWidth();
    return;
  }

  let currentIndex = 0;
  let autoSlide;

  const updateDots = () => {
    if (!dots) return;
    const dotButtons = dots.querySelectorAll("button");
    dotButtons.forEach((dot, index) => {
      dot.classList.toggle("active", index === currentIndex);
    });
  };

  const updateSlider = () => {
    const slideWidth = slides[0].getBoundingClientRect().width + getGap();
    track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    updateDots();
  };

  const createDots = () => {
    if (!dots) return;
    dots.innerHTML = "";

    slides.forEach((_, index) => {
      const button = document.createElement("button");
      button.type = "button";
      button.setAttribute("aria-label", `Pindah ke slide ${index + 1}`);
      button.addEventListener("click", () => {
        currentIndex = index;
        updateSlider();
        startAuto();
      });
      dots.appendChild(button);
    });

    updateDots();
  };

  const startAuto = () => {
    if (autoSlide) clearInterval(autoSlide);
    autoSlide = setInterval(() => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateSlider();
    }, 5000);
  };

  const stopAuto = () => {
    if (autoSlide) clearInterval(autoSlide);
  };

  prevBtn?.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlider();
    startAuto();
  });

  nextBtn?.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider();
    startAuto();
  });

  hero.addEventListener("mouseenter", stopAuto);
  hero.addEventListener("mouseleave", startAuto);

  window.addEventListener("resize", () => {
    setViewportWidth();
    updateSlider();
  });

  setViewportWidth();
  createDots();
  updateSlider();
  startAuto();
});


const tabs = document.querySelectorAll(".tab");
const cards = document.querySelectorAll(".network-card");

tabs.forEach(tab => {
  tab.addEventListener("click", () => {
    tabs.forEach(t => t.classList.remove("active"));
    tab.classList.add("active");

    const filter = tab.dataset.filter;

    cards.forEach(card => {
      if (filter === "all" || card.dataset.type === filter) {
        card.style.display = "";
      } else {
        card.style.display = "none";
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const slider = document.querySelector(".berita-slider");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  if (!slider || !prevBtn || !nextBtn) return;

  let autoSlideInterval;

  function getScrollAmount() {
    const card = slider.querySelector(".berita-card");
    const gap = 20;
    return card ? card.offsetWidth + gap : 300;
  }

  function slideNext() {
    const maxScroll = slider.scrollWidth - slider.clientWidth;

    if (slider.scrollLeft >= maxScroll - 5) {
      slider.scrollTo({ left: 0, behavior: "smooth" });
    } else {
      slider.scrollBy({ left: getScrollAmount(), behavior: "smooth" });
    }
  }

  function startAutoSlide() {
    stopAutoSlide();
    autoSlideInterval = setInterval(slideNext, 5000); 
  }

  function stopAutoSlide() {
    if (autoSlideInterval) clearInterval(autoSlideInterval);
  }

  nextBtn.addEventListener("click", () => {
    slideNext();
    startAutoSlide();
  });

  prevBtn.addEventListener("click", () => {
    slider.scrollBy({
      left: -getScrollAmount(),
      behavior: "smooth"
    });
    startAutoSlide();
  });

  slider.addEventListener("mouseenter", stopAutoSlide);
  slider.addEventListener("mouseleave", startAutoSlide);

  slider.addEventListener("touchstart", stopAutoSlide);
  slider.addEventListener("touchend", startAutoSlide);

  startAutoSlide();
});


document.addEventListener("DOMContentLoaded", () => {
  const slider = document.querySelector(".yuko-sldr");
  if (!slider) return;

  const items = slider.querySelectorAll(".yuko-item");
  const contents = slider.querySelectorAll(".yuko-content-item");
  const bg = slider.querySelector(".yuko-sldr-bg");
  const next = document.getElementById("next");
  const prev = document.getElementById("prev");

  let index = 0;
  let autoTimer;

  function loadImage(item) {
    const img = item.querySelector("img");
    if (img && !img.src) {
      img.src = img.dataset.src;
      img.loading = "lazy";
      img.decoding = "async";
    }
  }

  function showSlide(i) {
    items.forEach(el => el.classList.remove("active"));
    contents.forEach(el => el.classList.remove("active"));

    const item = items[i];
    item.classList.add("active");
    contents[i]?.classList.add("active");

    loadImage(item);

    bg.style.backgroundImage = `url(${item.dataset.bg})`;

    index = i;
  }

  function nextSlide() {
    showSlide((index + 1) % items.length);
  }

  function prevSlide() {
    showSlide((index - 1 + items.length) % items.length);
  }

  function startAuto() {
    stopAuto();
    autoTimer = setInterval(nextSlide, 5000);
  }

  function stopAuto() {
    if (autoTimer) clearInterval(autoTimer);
  }

  next?.addEventListener("click", () => {
    nextSlide();
    startAuto();
  });

  prev?.addEventListener("click", () => {
    prevSlide();
    startAuto();
  });

  slider.addEventListener("mouseenter", stopAuto);
  slider.addEventListener("mouseleave", startAuto);

  // INIT
  loadImage(items[0]);
  bg.style.backgroundImage = `url(${items[0].dataset.bg})`;
  startAuto();
});


document.addEventListener("DOMContentLoaded", () => {
  const video = document.querySelector(".hero-new video");
  if (!video) return;

  video.pause();
  setTimeout(() => video.play(), 500);
});

document.addEventListener('DOMContentLoaded', function () {
  const popup = document.getElementById('ppdb-popup');
  if (!popup) return;

  const popupClose = popup.querySelector('.close-btn');
  let popupTimer;

  function openPopup() {
    popup.classList.add('show');
  }

  function closePopup() {
    clearTimeout(popupTimer);
    popup.classList.remove('show');
  }

  popupTimer = setTimeout(openPopup, 1500);

  if (popupClose) {
    popupClose.addEventListener('click', closePopup);
  }

  popup.addEventListener('click', function (e) {
    if (e.target === popup) {
      closePopup();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closePopup();
    }
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const figuran = document.querySelector(".vt-vr");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          figuran.classList.add("is-visible");
          observer.unobserve(figuran);
        }
      });
    },
    { threshold: 0.3 }
  );

  observer.observe(figuran);
});


document.addEventListener("DOMContentLoaded", () => {
  const track = document.querySelector(".jg-track");
  const slides = document.querySelectorAll(".jg-slide");
  if (!track || slides.length === 0) return;

  let index = 0;
  let startX = 0;
  let isDragging = false;

  function slidesPerView() {
    if (window.innerWidth <= 600) return 1;
    if (window.innerWidth <= 992) return 2;
    return 4;
  }

  function updateSlider() {
    const slideWidth = slides[0].offsetWidth;
    track.style.transform = `translateX(-${index * slideWidth}px)`;
  }

  function next() {
    const maxIndex = slides.length - slidesPerView();
    if (index >= maxIndex) {
      index = 0; // BALIK KE AWAL
    } else {
      index++;
    }
    updateSlider();
  }

  function prev() {
    if (index <= 0) {
      index = slides.length - slidesPerView();
    } else {
      index--;
    }
    updateSlider();
  }

  track.addEventListener("touchstart", e => {
    startX = e.touches[0].clientX;
    isDragging = true;
  });

  track.addEventListener("touchend", e => {
    if (!isDragging) return;
    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;

    if (diff > 50) next();
    else if (diff < -50) prev();

    isDragging = false;
  });

  window.addEventListener("resize", updateSlider);
});

document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".nilai-item");

  if (!items.length) return;

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add("is-visible");
          }, index * 180);

          obs.unobserve(entry.target); 
        }
      });
    },
    {
      threshold: 0.35,
      rootMargin: "0px 0px -80px 0px",
    }
  );

  items.forEach(item => observer.observe(item));
});

const textarea = document.getElementById("msg");
const counter = document.getElementById("counter");

if (textarea && counter) {
  textarea.addEventListener("input", () => {
    counter.textContent = textarea.value.length + " / 500";
  });
}