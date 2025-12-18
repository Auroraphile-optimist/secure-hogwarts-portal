document.addEventListener("DOMContentLoaded", () => {
    const quill = document.querySelector(".magic-quill");
    const inputs = document.querySelectorAll(".scroll-input");

    inputs.forEach((input, index) => {
        input.addEventListener("focus", () => {
            const rect = input.getBoundingClientRect();
            const wrapperRect = input.closest(".register-wrapper").getBoundingClientRect();

            quill.style.top = (rect.top - wrapperRect.top + 10) + "px";
            quill.style.left = "-70px";
            quill.style.transform = "rotate(-10deg)";
        });

        input.addEventListener("blur", () => {
            quill.style.transform = "rotate(0deg)";
        });
    });
});

