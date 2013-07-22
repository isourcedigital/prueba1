$(document).ready(function() {
    bignewsanimate();
});
function bignewsanimate() {
    bigNewsid();
    bigNewsTitleid();
    animateImgs();
   $(document).bind('current', function() {
        var current = $('#bigNews').hasClass('flipCurrent');
        //console.log(current);
        if (current) {
            animateImgs();
        } else {
            $('img').stop();
        }
    });
    function bigNewsid() {
        var bigNews = $('.bigNewsContent .img').find('img');
        var i = 1;
        var zindexBase = 1000;
        $.each(bigNews, function() {
            var img = $(this).attr('id', i);
            var img = $(this).css('z-index', zindexBase);
            //console.log(img);
            i++;
            zindexBase--;
            $(this).hide();
        });
        $('.bigNewsContent .img img:odd').css('left', '-50%'); //PARES
        $('.bigNewsContent .img img:even').css('left', '0%'); //IMPARES
    }
    function bigNewsTitleid() {
        var bigNewsTitles = $('.bigNewsContent .titles').find('div');
        var i = 1;
        var zindexBase = 2000;
        $.each(bigNewsTitles, function() {
            $(this).attr('id', 't' + i);
            $(this).css('z-index', zindexBase);
            i++;
            $('.bigNewsContent .titlesBox').css('z-index', (zindexBase - 1));
            zindexBase + 1;
            zindexBase--;
            $(this).hide();
            var text;
            text = $(this).text();
        });
        bigNewsTextsid();
    }
    function bigNewsTextsid() {
        var bigNewsTitles = $('.bigNewsContent .textBignews').find('p');
        var i = 1;
        var zindexBase = 2000;
        $.each(bigNewsTitles, function() {
            $(this).attr('id', 'text' + i);
            $(this).css('z-index', zindexBase);
            i++;
            zindexBase--;
            $(this).hide();

        });
    }
    function animateImgs() {
        var bigNews = $('.bigNewsContent .img').find('img');
        var i = 0;
        var h = bigNews.length;
        animation(i);
        function animation(i) {
            i++;
            $(this).hide();
            $('.titles div').hide();
            $('#t' + i).fadeIn();
            $('#' + i).fadeIn(3000, function() {
                if (i % 2 !== 0) {
                    $(this).animate({
                        left: '-50%'
                    }, 8000, function() {
                        $(this).fadeOut(3000, function() {
                            $('#t' + i).fadeOut();
                            $(this).hide();
                            $(this).css('left', '0%');
                            if (i !== h) {
                                animation(i);
                            } else {
                                animation(0);
                            }
                        });
                    });
                } else {
                    $(this).animate({
                        left: '0%'
                    }, 8000, function() {
                        $(this).fadeOut(3000, function() {
                            $('#t' + i).fadeOut();
                            $(this).css('left', '-50%');
                            if (i !== h) {
                                animation(i);
                            } else {
                                animation(0);
                            }
                        });
                    });
                }
            });
        }
    }
}
