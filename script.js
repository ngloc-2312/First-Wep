const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const comment = document.querySelector('#list-comment');
const commentItems = document.querySelectorAll('#list-comment .item-comment');
var translateY = 0;
var count = 0;

next.addEventListener('click', function(event) {
    event.preventDefault();
    if (count == commentItems.length - 1) {
        translateY = 0;
        comment.style.transform = `translateY(${translateY}px)`;
        count = 0;
    } else {
        translateY += -400;
        comment.style.transform = `translateY(${translateY}px)`;
        count++;
    }
});

prev.addEventListener('click', function(event) {
    event.preventDefault();
    if (count == 0) {
        translateY = -(commentItems.length - 1) * 400;
        comment.style.transform = `translateY(${translateY}px)`;
        count = commentItems.length - 1;
    } else {
        translateY += 400;
        comment.style.transform = `translateY(${translateY}px)`;
        count--;
    }
});
