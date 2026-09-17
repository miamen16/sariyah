(() => {
  const initGallery = (root) => {
    const mainImage = root.querySelector('.sariyah-single-product__gallery > img');
    const thumbnails = root.querySelectorAll('.sariyah-single-product__thumb');

    if (!mainImage || !thumbnails.length) {
      return;
    }

    thumbnails.forEach((button) => {
      button.addEventListener('click', () => {
        const thumbnail = button.querySelector('img');
        if (!thumbnail) {
          return;
        }

        const fullImage = thumbnail.dataset.fullImage || thumbnail.currentSrc || thumbnail.src;
        const fullSrcset = thumbnail.dataset.fullSrcset || '';
        const fullSizes = thumbnail.dataset.fullSizes || '';
        const alt = thumbnail.alt || mainImage.alt;

        mainImage.src = fullImage;
        if (fullSrcset) {
          mainImage.srcset = fullSrcset;
        } else {
          mainImage.removeAttribute('srcset');
        }
        if (fullSizes) {
          mainImage.sizes = fullSizes;
        } else {
          mainImage.removeAttribute('sizes');
        }
        mainImage.alt = alt;

        thumbnails.forEach((item) => {
          item.classList.remove('is-active');
          item.setAttribute('aria-pressed', 'false');
        });
        button.classList.add('is-active');
        button.setAttribute('aria-pressed', 'true');
      });
    });
  };

  document.querySelectorAll('.sariyah-single-product').forEach(initGallery);
})();
