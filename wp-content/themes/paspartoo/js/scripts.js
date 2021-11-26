function validYT(url) {
   var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
  return (url.match(p)) ? RegExp.$1 : false;
}

function show_homepage_category_ajax(id)
{
    jQuery('ul.filter li').removeClass('current');
    jQuery('#show_category_'+id).addClass('current');
    if (id!=0) {
        jQuery(".catall").css("display","none");
        jQuery(".cat"+id).css("display","block");
    } else {
        jQuery(".catall").css("display","block");
    }

    //jQuery.ajax({url : ajax_web_url,type : 'post',data : {action : 'show_homepage_category_ajax', id : id},success : function(response){
   // alert(response);      }})

//jQuery('.portfolio_sticks').html(response);
}
jQuery(document).ready(function($) {
    $("a[href^=#]").on("click", function(e) {
        e.preventDefault();
        history.pushState({}, "", this.href);
    });
    if ($(window).width() < 576) {
        var mainbanner_height = $( '#mainbanner' ).height();
        var aftermainbanner_height = mainbanner_height - 150;
        $("#aftermainbanner").css("margin-top", aftermainbanner_height + "px");
    }
    $(".ads_img").mouseover(function(){$(".menu_banner_hover").css("display","block");$(".menu_banner_simple").css("display","none"); })
    $(".ads_img").mouseleave(function(){ $(".menu_banner_simple").css("display","block"); $(".menu_banner_hover").css("display","none");})
    $(window).scroll(function() {
        if (($(".header_line").length > 0)){
            tops=$('#header').offset().top;
            //if (jQuery(window).width()>1200){
                if ($('.header_line').hasClass('active'))
                {
                    $('.header_line').removeClass('active');
                }
                if ($(this).scrollTop()>=(tops+1)){
                    $('.header_line').addClass('active');
                } else $('.header_line').removeClass('active');
        }
        //else $('.header_line').removeClass('active');
        //}

        if (jQuery(window).height()>890) {
            $(".content_appform_show_over").css("overflow","hidden");
        } else {
            $(".content_appform_show_over").css("overflow","auto");
        }
    });
    $(window).resize(function() {
        $('.slider-small').slick('refresh');
        $('.slider-big').slick('refresh');
        var winWidth=jQuery(window).width();
        if (jQuery('.scroll-img').length > 0) {
            if (winWidth<=1200) {
                jQuery('.scroll-img .vc_single_image-wrapper').jScrollPane();
            }
        }
        if ($(window).width()<576) {
            var mainbanner_height = $( '#mainbanner' ).height();
            var aftermainbanner_height = mainbanner_height - 150;
            $("#aftermainbanner").css("margin-top",aftermainbanner_height + "px");
        } else {
            $("#aftermainbanner").css("margin-top","90vh");
        }
    });
    jQuery('.footer_logo').each(function(){
        var $img = jQuery(this);
        var attributes = $img.prop("attributes");
        var imgURL = $img.attr("src");
        $.get(imgURL, function (data) {
            var $svg = $(data).find('svg');
            $svg = $svg.removeAttr('xmlns:a');
            $.each(attributes, function() {
                $svg.attr(this.name, this.value);
            });
            $img.replaceWith($svg);
        });
    });


    $('.page_stick .image_container img').each(function(){
        var t = $(this),
            s = 'url(' + t.attr('src') + ')',
            p = t.parent(),
            d = $('<div></div>');
        t.hide();
        p.append(d);
        d.css({
            'height'                : '100%',
            'width'                : '100%',
            'background-size'       : 'cover',
            'background-repeat'     : 'no-repeat',
            'background-position'   : 'center',
            'background-image'      : s
        });
    });
    $('#myfile').change(function(e){

        var fileName = e.target.files[0].name;
        $('.attach_file span').html(fileName);
        $("#del").css("display","block");
        $imageFile.val('');
    });


    $("#del").on("click", function(){
        $("#myfile").val('');
        $('.attach_file span').html('Attach a file');
        $("#del").css("display","none");
    })

    $('#hamb_button').click(function(){
        if ( $('#hamb_button').hasClass('is-active'))
        {
            $('#hamb_button').removeClass('is-active');
            $('.mobile_menu').removeClass("active");
            $('.bg').removeClass("active");
            $("html,body").css("overflow","visible");
            $("header").css("position","absolute");

        } else {
            $('#hamb_button').addClass('is-active');
            $('.mobile_menu').addClass("active");
            $('.bg').addClass("active");
            $("html,body").css("overflow","hidden");
            $("header").css("position","inherit");
        }

    })
    $('.bg').click(function(){
            $('#hamb_button').removeClass('is-active');
            $('.mobile_menu').removeClass("active");
            $('.bg').removeClass("active");
            $("html,body").css("overflow","visible");
        }
    )
    $('li.has-child span').click(function(){
        if (
            $(this).closest("li.has-child").hasClass("active")){
            $(this).closest("li.has-child").removeClass("active");}
        else {
            $('li.has-child').removeClass("active");
            $(this).closest("li.has-child").toggleClass("active");
        }
    })
    var footerheight = $( '#footer' ).height();
    $(".page_content").css({
     //   'margin-bottom' : footerheight
    });


    var z=0;
    var act_id=act_li='';
    var timer;
    $( "#menu-services-block li.menu-item-has-children" ).each(function( i ) {
        if ($(this).hasClass('focus'))
        {
            act_id=$(this).attr('id');
        }
        if (z==0) act_li=$(this).attr('id');
        z++;
    });
    if (act_id=='') { act_id=act_li; $('#'+act_id).addClass('focus');}


    $( "#menu-services-block li.menu-item-has-children" ).mouseover(function(){
        var ids=$(this).attr('id');
        timer = setTimeout(function () {
            $( "#menu-services-block li.menu-item-has-children" ).removeClass('focus');
            $('#'+ids).addClass('focus');
        }, 200);

    })

    $( "#menu-services-block li" ).mouseout(function() {
        clearTimeout(timer);
    })

    $(".appform").on("click", function(){
        jQuery('#appform_show').css('display','block');
    });
    
   	var url = location.href, getaquote = 'https://paspartoo.com/#getaquote'; 
    if(url === getaquote) jQuery('#appform_show').css('display','block');
    
    $(".submitbutton").on("click", function(){
        jQuery('#appform_show').css('display','block');

    });
    $(".content_appform_show_close").on("click", function(){
        jQuery('#appform_show').css('display','none');

    });
    $(".bg_appform_show").on("click", function(){
        jQuery('#appform_show').css('display','none');
    })
    $("#appform_show form .wpcf7-submit").on("click", function(){
        var emailval=$("#email_appform").val();
        var milvalid = validateEmail(emailval);
        if(milvalid == false){$("#email_appform").addClass("wpcf7-not-valid"); $('#email_appform_tip').css('display','block');} else {$("#email_appform").removeClass("wpcf7-not-valid");$('.email_appform span').css('display','none');  $('#email_appform_tip').css('display','none');  }
    })

    function validateEmail(email) {
        var reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return reg.test(email);
    }

    $(document).on('blur', '#email_appform', function (e) {
        var emailval=$("#email_appform").val();
        if (emailval!='')
        {
            var milvalid = validateEmail(emailval);
            if(milvalid == false){$("#email_appform").addClass("wpcf7-not-valid"); $('#email_appform_tip').css('display','block');} else {$("#email_appform").removeClass("wpcf7-not-valid");$('.email_appform span').css('display','none');  $('#email_appform_tip').css('display','none');  }
        }
    })

    $(document).mouseup(function (e){
        var div = $(".content_appform_show");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            jQuery('#appform_show').css('display','none');
        }

    });

    $('#phone_appform').bind("change keydown input",function(e) {
        var strs =String.fromCharCode(e.keyCode);
        var regex = new RegExp("^[0-9-/+\b]*$");
        var val=$('#phone_appform').val();
        if (regex.test(strs)) {

        } else {
            val=val.replace(/[^0-9+-]/, "");
            $('#phone_appform').val(val);
        }
    })


    $(document).keyup(function(e) {if (e.keyCode == 27) {jQuery('#appform_show').css('display','none');}})



    $(".attach_file").on("click", function(){
        $('#myfile').trigger('click');
    });

    $(".white_stick").on("click", function(){
        var button = $(this).find('a.ubtn-link');
        button.simulateClick('click');
    });
    $(".page_stick").on("click", function(){
        var button = $(this).find('.link a');
        button.simulateClick('click');
    });

    jQuery.fn.simulateClick = function() {
        return this.each(function () {
            if ('createEvent' in document) {
                var doc = this.ownerDocument,
                    evt = doc.createEvent('MouseEvents');
                evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
                this.dispatchEvent(evt);
            } else {
                this.click(); // IE Boss!
            }
        });
    }

    $('.key_services .stick').click(function(){
        //var p_container = $(this).closest(".p_container");
        var width = $(window).width();
        if (width<= 576) {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).find(".links").slideUp('200')
            } else {
                $('.key_services .stick').removeClass("active");
                $(".links").slideUp('400');
                $(this).addClass("active");
                $(this).find(".links").slideDown('200');
            }
        }
    })
    $( "#services_first_stick" ).trigger( "click" );


$('.portfolio_content .carousel').slick({ 
        infinite: true, 
        speed: 270,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true, dots:true,autoplay: true,
        responsive: [
            
            {
                breakpoint: 768,
                settings: {
                   arrows: false
                }
            },
        ]
    });
$('.portfolio_projects_slider').slick({ 
    infinite: true,
	slidesToShow: 3,
	slidesToScroll: 1,
    speed: 270, 
	variableWidth: true,
    arrows: false, 
	dots:false,
	autoplay: false,
	swipeToSlide:true,
    centerMode:true
    });


    /*$('.slider_sticks').slick({
        centerMode: true,
        infinite: true,
        autoplay: true,
        speed: 270,
        slidesToShow: 5,
        slidesToScroll: 3,
        arrows: false,
        responsive: [
            {
                breakpoint: 1800,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 1480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 1360,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    //centerMode: false,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 730,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });*/


    if ($('.slider_sticks').length) {

        var elem = document.querySelector('.slider_sticks');
        var flkty = new Flickity( elem, {cellAlign: 'left',freeScroll: true, pageDots: false,percentPosition: false,prevNextButtons: false,adaptiveHeight: false,contain: true});
    }
});

jQuery(document).ready(function($) {

$('a[href^="mailto"]').click(function() {
 fbq('track', 'Contact');
});
$('a[href^="skype:live"]').click(function() {
 fbq('track', 'Contact');
});
$('a[href^="https://www.messenger.com"]').click(function() {
 fbq('track', 'Contact');
});
$('a[href^="https://api.whatsapp.com"]').click(function() {
 fbq('track', 'Contact');
});

document.addEventListener('wpcf7mailsent', function sendMail(event) {
	if ('1323' == event.detail.contactFormId) {
    	fbq('track', 'Lead');
    }
    if ('5' == event.detail.contactFormId) {
    	fbq('track', 'Lead');
    }
    if ('366' == event.detail.contactFormId) {
    	fbq('track', 'Lead');
    }
});


$('.popup_tips_btn').click(function() {
 $.fancybox.open({
	src  : '.popup_tips',
	type : 'inline'
});
});
$('.popup_check_list_btn').click(function() {
 $.fancybox.open({
	src  : '.popup_check_list',
	type : 'inline'
});
});


$('.video_block').click(function(){
	$(this).find('.wpb_single_image').css('z-index','0');
	if ($(this).find('iframe').length > 0) {
		var url=$(this).find('iframe').attr('src'); 
		if (validYT(url) !== false) { 
			if (url.indexOf("?") >= 0) {
				url=url+"&autoplay=1";             
			} else url=url+"?autoplay=1";   
			$(this).find('iframe').attr('src',url);			
		} 
	
	}
})

// 	var image = $('.thumbnail_parallax .vc_single_image-img');
//     new simpleParallax(image, {
// 	  delay: 1.1,
// //    orientation: 'down',
//    scale: 1.50
// });
});