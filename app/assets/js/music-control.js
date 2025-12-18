document.addEventListener("DOMContentLoaded", () => {
    const music = document.getElementById("bg-music");
    const button = document.getElementById("music-toggle");

    let isPlaying = false;

    button.addEventListener("click", () => {
        if (!isPlaying) {
            music.volume = 0.4;
            music.play();
            button.textContent = "🔇";
            isPlaying = true;
        } else {
            music.pause();
            button.textContent = "🔊";
            isPlaying = false;
        }
    });
});

