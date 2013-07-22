
(function($) {
    $.fn.krioImageLoader = function(options) {
        //console.log('inicia');

        var opts = $.extend({}, $.fn.krioImageLoader.defaults, options);
        var imagesToLoad = $(this).find("img")
                .css({opacity: 0, visibility: "hidden"})
                .addClass("krioImageLoader");

//Title Hidden
        var titleToLoad = $(this).find(".titleBlog")
                .css({opacity: 0, visibility: "hidden"});

        var noteTitleToLoad = $(this).find(".noteTitle")
                .css({opacity: 0, visibility: "hidden"});

        var notesTitleToLoad = $(this).find(".title")
                .css({opacity: 0, visibility: "hidden"});

        var textToLoad = $(this).find("p")
                .css({opacity: 0, visibility: "hidden"});



        var imagesToLoadCount = imagesToLoad.size();

        var checkIfLoadedTimer = setInterval(function() {
            if (!imagesToLoadCount) {
                clearInterval(checkIfLoadedTimer);
                return;
            } else {
                imagesToLoad.filter(".krioImageLoader").each(function() {
                    if (this.complete) {
                        fadeImageIn(this);
                        imagesToLoadCount--;
                    }
                });
            }
        }, opts.loadedCheckEvery);

        var fadeImageIn = function(imageToLoad) {
            $(imageToLoad).css({visibility: "visible"})
                    .animate({opacity: 1},
            opts.imageEnterDelay,
                    removeKrioImageClass(imageToLoad));
        };

        //Title Fade IN
        var fadeTitleIn = function(titleToLoad) {
            $(titleToLoad).css({visibility: "visible"})
                    .animate({opacity: 1});

            //opts.imageEnterDelay,

        };

        var fadeNoteTitleIn = function(noteTitleToLoad) {
            $(noteTitleToLoad).css({visibility: "visible"})
                    .animate({opacity: 1});

            //opts.imageEnterDelay,

        };

        var fadeNotesTitleIn = function(notesTitleToLoad) {
            $(notesTitleToLoad).css({visibility: "visible"})
                    .animate({opacity: 1});

            //opts.imageEnterDelay,

        };

        var fadePIn = function(textToLoad) {
            $(textToLoad).css({visibility: "visible"})
                    .animate({opacity: 1});

        }


        var removeKrioImageClass = function(imageToRemoveClass) {
            $(imageToRemoveClass).removeClass("krioImageLoader");

            fadeTitleIn(titleToLoad);
            fadeNotesTitleIn(notesTitleToLoad);
            fadeNoteTitleIn(noteTitleToLoad);
            fadePIn(textToLoad);


        };


    };

    $.fn.krioImageLoader.defaults = {
        loadedCheckEvery: 350,
        imageEnterDelay: 900
    };

})(jQuery);