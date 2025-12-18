</div> <!-- .container -->

<!-- ✨ Existing magic effects -->
<script src="magic.js"></script>

<!-- 🎵 Hogwarts Ambient Music -->
<audio id="hogwarts-music" loop>
    <source src="/hogwarts/assets/audio/hogwarts-ambient.mp3" type="audio/mpeg">
</audio>

<!-- 🎵 Music Toggle Button -->
<button id="music-toggle" class="music-btn">🔊</button>

<script>
    const hogwartsMusic = document.getElementById("hogwarts-music");
    const musicBtn = document.getElementById("music-toggle");
    let isPlaying = false;

    // Start music on first user interaction (browser-safe)
    document.addEventListener("click", () => {
        if (!isPlaying) {
            hogwartsMusic.volume = 0.25;
            hogwartsMusic.play().catch(() => {});
            isPlaying = true;
            musicBtn.textContent = "🔇";
        }
    }, { once: true });

    // Toggle play / pause
    musicBtn.addEventListener("click", (e) => {
        e.stopPropagation(); // prevent double-trigger
        if (hogwartsMusic.paused) {
            hogwartsMusic.play();
            musicBtn.textContent = "🔇";
        } else {
            hogwartsMusic.pause();
            musicBtn.textContent = "🔊";
        }
    });
</script>

</body>
</html>

