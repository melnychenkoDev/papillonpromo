document.addEventListener('DOMContentLoaded', () => {
    $infiniteScrollText = document.querySelector('.infinite-scroll-text');
    $opacityScrollText = document.querySelector('.opacity-scroll-text');

    let position;
    function scrollText() {
        let step= $infiniteScrollText.clientWidth > 992 ? 1 : 0.5;

        if (!position) {
            position = 0;
        }

        position -= step;

        if (Math.abs(position) < $infiniteScrollText.scrollWidth - $infiniteScrollText.clientWidth) {
            $infiniteScrollText.style.transform = `translateX(${position}px)`;
            requestAnimationFrame(scrollText);
        } else {
            $infiniteScrollText.querySelector('p').insertAdjacentHTML('beforeend', ' Welcome to Papillon Promo <span>Pool, where the power of music takes flight!</span>');
            position = position;
            requestAnimationFrame(scrollText);
        }
    }
    requestAnimationFrame(scrollText);

    const opacityScrollTextArr = $opacityScrollText.textContent.trim().split('');
    const opacityScrollTextNewArr = opacityScrollTextArr.map((itm) => {
        if (/^[a-zA-Z]+$/.test(itm)) {
            return `<span class="opacity_item">${itm}</span>`;
        } else if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(itm)) {
            return `<span class="opacity_item">${itm}</span>`;
        } else if (/\s/.test(itm)) {
            return `<span class="opacity_item">${itm}</span>`;
        }
    });

    $opacityScrollText.innerHTML = opacityScrollTextNewArr.join('');
    let onStart = false;
    let countOpacityScrollText = 0;
    window.addEventListener('scroll', function() {
        if (!onStart) {
            countOpacityScrollText = getLength();
        }

        let start = $opacityScrollText.offsetTop - (window.innerHeight - 50);
        let end = $opacityScrollText.offsetTop + ($opacityScrollText.scrollHeight - (window.innerHeight * 0.5));
        let scrollY = window.scrollY;
        let percentScrolled = 0;
        let more = false;
        let howMuch = 0;

        if (scrollY >= start && scrollY < end) {
            percentScrolled = ((scrollY - start) / (end - start)) * 100;
            howMuch = Math.ceil((Math.ceil(percentScrolled) / 100) * countOpacityScrollText);
            addClassesForElements(howMuch);
            more = false;
        }

        if (scrollY > end && !more) {
            percentScrolled = 100;
            howMuch = countOpacityScrollText;
            addClassesForElements(howMuch);
            more = true;
        }

        onStart = true;
    });

    function getLength() {
        return $opacityScrollText.querySelectorAll('.opacity_item').length;
    }

    function addClassesForElements($max,$class = 'active') {
        $opacityScrollText.querySelectorAll('.opacity_item').forEach((itm, i) => {
            let id = i+1;
            if (id <= $max) {
                itm.classList.add($class);
            } else {
                itm.classList.remove($class);
            }
        })
    }

});
