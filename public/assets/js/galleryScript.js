$('.gallery').imagesLoaded(function() {
    $('.gallery').masonry({
        // options
        itemSelector: '.grid-item',
        isFitWidth: true,
        isAnimated: true
    });
});