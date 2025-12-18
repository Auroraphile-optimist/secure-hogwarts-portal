document.addEventListener("DOMContentLoaded", () => {
    const count = 50;

    for (let i = 0; i < count; i++) {
        let spark = document.createElement("div");
        spark.className = "magic-spark";
        document.body.appendChild(spark);

        let size = Math.random() * 6 + 2;
        spark.style.width = size + "px";
        spark.style.height = size + "px";

        spark.style.left = Math.random() * 100 + "vw";
        spark.style.top = Math.random() * 100 + "vh";

        spark.style.animationDuration = (3 + Math.random() * 4) + "s";
        spark.style.opacity = 0.6;
    }
});

