/**
 * Bloglo hover slider
 *
 * @since 1.0.0
 */
var blogloHoverSlider = function (el) {
  var current = 0,
    spinner = el.querySelector(".bloglo-spinner");

  // Hide spinner
  var hideSpinner = function () {
    spinner.classList.remove("visible");

    setTimeout(function () {
      spinner.style.display = "none";
    }, 300);

    el.querySelector(".hover-slider-backgrounds").classList.add("loaded");
  };

  el.querySelector(".hover-slide-bg").classList.add("active");

  // Set background images from data-background
  el.querySelectorAll(".hover-slider-backgrounds .hover-slide-bg").forEach(
    (item, i) => {
      item.style.backgroundImage =
        "url(" + item.getAttribute("data-background") + ")";

      el.querySelector(
        ".hover-slider-items > div:nth-child(" + (i + 1) + ")"
      ).style.setProperty(
        "--bg-image",
        'url("' + item.getAttribute("data-background") + '")'
      );

      item.removeAttribute("data-background");
    }
  );

  // Wait for images to load
  imagesLoaded(
    el.querySelectorAll(".hover-slider-backgrounds"),
    { background: ".hover-slide-bg" },
    function () {
      var preloader = document.getElementById("bloglo-preloader");

      // Wait for preloader to finish before we show fade in animation
      if (
        null !== preloader &&
        !document.body.classList.contains("bloglo-loaded")
      ) {
        document.body.addEventListener("bloglo-preloader-done", function () {
          setTimeout(function () {
            hideSpinner();
          }, 300);
        });
      } else {
        setTimeout(function () {
          hideSpinner();
        }, 300);
      }
    }
  );

  // Change backgrounds on hover
  el.querySelectorAll(".hover-slider-item-wrapper").forEach((item) => {
    item.addEventListener("mouseenter", function () {
      if (current !== blogloGetIndex(item)) {
        current = blogloGetIndex(item);

        el.querySelectorAll(".hover-slide-bg").forEach((item, i) => {
          item.classList.remove("active");

          if (i === current) {
            item.classList.add("active");
          }
        });
      }
    });
  });

  return el;
};

/**
 * Bloglo horizontal/vertical slider
 *
 * @since 1.0.0
 */
var blogloHorizontalSlider = function (el) {
  var current = 0,
    spinner = el.querySelector(".bloglo-spinner");

  // Hide spinner
  var hideSpinner = function () {
    spinner.classList.remove("visible");

    setTimeout(function () {
      spinner.style.display = "none";
    }, 300);
  };

  // Wait for images to load
  imagesLoaded(el.querySelectorAll(".hover-slider-backgrounds"), function () {
    var preloader = document.getElementById("bloglo-preloader");

    // Wait for preloader to finish before we show fade in animation
    if (
      null !== preloader &&
      !document.body.classList.contains("bloglo-loaded")
    ) {
      document.body.addEventListener("bloglo-preloader-done", function () {
        setTimeout(function () {
          hideSpinner();
        }, 300);
      });
    } else {
      setTimeout(function () {
        hideSpinner();
      }, 300);
    }
  });

  return el;
};

// Main
(function () {
  // On ready event
  document.addEventListener("DOMContentLoaded", function () {
    // Init sliders
    document.querySelectorAll(".bloglo-hover-slider").forEach((item) => {
      blogloHoverSlider(item);
    });

    document.querySelectorAll(".bloglo-horizontal-slider").forEach((item) => {
      blogloHorizontalSlider(item);
    });

    document.querySelectorAll(".bloglo-vertical-slider").forEach((item) => {
      blogloHorizontalSlider(item);
    });
  });
})();
