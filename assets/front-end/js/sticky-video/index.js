var eaelsvPosition = "";
var eaelsvWidth = 0;
var eaelsvHeight = 0;
var eaelsvDomHeight = 0;
var videoIsActive = 0;

jQuery(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/eael-sticky-video.default', function ($scope, $) {
        $('.eaelsv-sticky-player-close', $scope).hide();

        var element = $scope.find(".eael-sticky-video-player2"); //$(".eael-sticky-video-player2", $scope);
        var sticky = '';
        var autoplay = '';
        var overlay = '';

        sticky = element.data('sticky');
        autoplay = element.data('autoplay');
        eaelsvPosition = element.data('position');
        eaelsvHeight = element.data('sheight');
        eaelsvWidth = element.data('swidth');
        overlay = element.data('overlay');
        
        var playerAbc = new Plyr('#eaelsv-player-' + $scope.data('id'));
        
        // If element is Sticky video
        if (sticky === 'yes') {
            // If autoplay is enable
            if (('yes' === autoplay) && (overlay === 'no')) {
                eaelsvDomHeight = GetDomElementHeight(element);
                element.parent().attr('id', 'videobox');
                
                if (videoIsActive == 0) {
                    videoIsActive = 1;
                }
            }

            // When play event is cliked
            // Do the sticky process
            PlayerPlay(playerAbc, element);
        }

        // Overlay Operation Started
        if (overlay === 'yes') {
            var ovrlyElmnt = element.prev();
            element.find('div, video').attr('id', 'eaelsv-player-' + $scope.data('id'));

            $(ovrlyElmnt).on('click', function() {
                $(this).css('display', 'none');

                if (($(this).next().data('autoplay')) === 'yes') {
                    var a1 = $(this).next().find('div, video').attr('id');
                    //alert($(this).next().find('div').attr('class'));
                    //RunStickyPlayer(a1);
                    playerAbc.restart();
                    eaelsvDomHeight = GetDomElementHeight(this);
                    $(this).parent().attr('id', 'videobox');
                    videoIsActive = 1;
                }
            });
        }
        /*
        playerAbc.on('pause', function (event) {
            alert('Paused');
            if (videoIsActive == 1) {
                videoIsActive = 0;
            }
        });
        */
        $('.eaelsv-sticky-player-close').on('click', function () {
            element.parent().removeClass('out').addClass('in');
            $('.eael-sticky-video-wrapper').removeAttr('style');
            videoIsActive = 0;
        });
        /*
        $('#videobox').on('inview', function(event, isInView) {
            if (isInView) {
                alert('Video is inview');
            } else {
                alert('Video is not inview');
            }
        });
        */
    });
});

jQuery(document).scroll(function(){
    var scrollTop = jQuery(this).scrollTop();
    if (scrollTop > eaelsvDomHeight) {
        if (videoIsActive == 1) {
            jQuery('#videobox').find('.eaelsv-sticky-player-close').css('display', 'block');
            jQuery('#videobox').removeClass('in').addClass('out');
            PositionStickyPlayer(eaelsvPosition, eaelsvHeight, eaelsvWidth);
        }
    } else {
        jQuery('.eaelsv-sticky-player-close').hide();
        jQuery('#videobox').removeClass('out').addClass('in');
        jQuery('.eael-sticky-video-wrapper').removeAttr('style');
    }
});

function GetDomElementHeight(elem) {
    var hght = (jQuery(elem).parent().offset().top + jQuery(elem).parent().height());
    return hght;
}

function PositionStickyPlayer(p, h, w) {
    if (p == 'top-left') {
        jQuery('.eael-sticky-video-wrapper.out').css('top', '40px');
        jQuery('.eael-sticky-video-wrapper.out').css('left', '40px');
    }
    if (p == 'top-right') {
        jQuery('.eael-sticky-video-wrapper.out').css('top', '40px');
        jQuery('.eael-sticky-video-wrapper.out').css('right', '40px');
    }
    if (p == 'bottom-right') {
        jQuery('.eael-sticky-video-wrapper.out').css('bottom', '40px');
        jQuery('.eael-sticky-video-wrapper.out').css('right', '40px');
    }
    if (p == 'bottom-left') {
        jQuery('.eael-sticky-video-wrapper.out').css('bottom', '40px');
        jQuery('.eael-sticky-video-wrapper.out').css('left', '40px');
    }
    jQuery('.eael-sticky-video-wrapper.out').css('width', w + 'px');
    jQuery('.eael-sticky-video-wrapper.out').css('height', h + 'px');
}

function PlayerPlay(a, b) {
    a.on('play', function (event) {
        eaelsvDomHeight = GetDomElementHeight(b);
        jQuery('.eael-sticky-video-wrapper').removeAttr('id');
        jQuery('.eael-sticky-video-wrapper').removeClass('out');
        b.parent().attr('id', 'videobox');
        
        videoIsActive = 1;
        eaelsvPosition  = b.data('position');
        eaelsvHeight    = b.data('sheight');
        eaelsvWidth     = b.data('swidth');
    });
}

function RunStickyPlayer(elem) {
    var ovrplyer = new Plyr('#' + elem);
    ovrplyer.start();
}