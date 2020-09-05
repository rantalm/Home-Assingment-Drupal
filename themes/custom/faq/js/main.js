"use strict";

(function () {
  const qHeadItems = document.querySelectorAll(".q-head__item");
  let qHeadActive = document.querySelector(".q-head__item--active");
  let activeAccordion = document.querySelector(".accordion--active");

  qHeadItems.forEach((el) =>
    el.addEventListener("click", (e) => {
      // same element - remove class
      if (e.target === qHeadActive || e.target.parentElement === qHeadActive) {
        qHeadActive.classList.remove("q-head__item--active");
        qHeadActive = null;
        activeAccordion.classList.remove("accordion--active");
        activeAccordion = null;
      } else {
        // different or no element
        qHeadActive && qHeadActive.classList.remove("q-head__item--active");
        qHeadActive = e.target.classList.contains("q-head__item")
          ? e.target
          : e.target.parentElement;
        qHeadActive.classList.add("q-head__item--active");
        showCorrespondAccordion(qHeadActive.dataset.category);
      }
    })
  );

  const showCorrespondAccordion = (id) => {
    activeAccordion && activeAccordion.classList.remove("accordion--active");
    const accordion = document.querySelector(
      `.accordion[data-category="${id}"]`
    );
    activeAccordion = accordion;
    activeAccordion.classList.add("accordion--active");
  };
})();
