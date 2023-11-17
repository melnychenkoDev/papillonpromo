document.addEventListener('DOMContentLoaded', () => {
	const equalizer = document.querySelector('.equalizer');
	const audio = document.getElementById('audio');
	let isPlaying = false;

	equalizer.addEventListener('click', () => {
		if (!isPlaying) {
			isPlaying = true;
			playAudio();
		} else {
			isPlaying = false;
			stopAudio();
		}
	});

	audio.addEventListener('ended', () => {
		equalizer.classList.remove('playing');
		audio.currentTime = 0;
		isPlaying = false;

	});

	function playAudio() {
		audio.play();
		equalizer.classList.add('playing');
	}

	function stopAudio() {
		audio.pause();
		equalizer.classList.remove('playing');
	}
});
